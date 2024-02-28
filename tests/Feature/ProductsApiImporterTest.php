<?php
declare(strict_types=1);

namespace Feature;

use App\Adapters\ProductMockApiImporterAdapter;
use App\Models\Product;
use App\Actions\ProductImportAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 *
 */
class ProductsApiImporterTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->productApiAdapter = new ProductMockApiImporterAdapter();
    }

    /**
     * Test Can Import Products From API
     */
    public function testCanImportProductsFromApi(): void
    {
        (new ProductImportAction($this->productApiAdapter))->import();
        $products = Product::all();
        $this->assertNotEmpty($products);
    }

}
