<?php

namespace Tests\Feature;

use App\Adapters\ProductFileImporterAdapter;
use App\Models\Product;
use App\Actions\ProductImportAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsFileImporterTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productFileAdapter = new ProductFileImporterAdapter();
    }

    /**
     * Test Can Import Products From File
     */
    public function testCanImportProductsFromCsvFile(): void
    {
        (new ProductImportAction($this->productFileAdapter))->import();
        $products = Product::all();
        $this->assertNotEmpty($products);
    }

}
