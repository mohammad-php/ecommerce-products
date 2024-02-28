<?php

namespace App\Http\Controllers;

use App\Actions\ProductImportAction;
use App\Adapters\ProductFileImporterAdapter;
use App\Adapters\ProductMockApiImporterAdapter;
use App\Http\Controllers\Controller;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $productApiAdapter = new ProductMockApiImporterAdapter();
        (new ProductImportAction($productApiAdapter))->import();

    }

}
