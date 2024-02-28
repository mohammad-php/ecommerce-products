<?php
declare(strict_types=1);

namespace App\Adapters;

use App\Imports\ProductsImport;
use App\Interfaces\ProductImporterInterface;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Storage;

/**
 *
 */
class ProductFileImporterAdapter implements ProductImporterInterface
{
    /**
     * @return void
     */
    public function import(): void
    {
        $filePath = config('import.products.csvPath');
        if(!Storage::disk('local')->exists($filePath)) {
            throw new RuntimeException("File not found!");
        }
        (new ProductsImport())->import(storage_path('app/'.$filePath));
    }
}
