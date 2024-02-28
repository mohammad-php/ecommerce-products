<?php

namespace App\Console\Commands;

use App\Actions\ProductImportAction;
use App\Adapters\ProductMockApiImporterAdapter;
use http\Exception\RuntimeException;
use Illuminate\Console\Command;

class ImportProductsFromMockApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports products from API (https://5fc7a13cf3c77600165d89a8.mockapi.io/api/v5/products) into database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('');
        $this->line('--------------------------------------------');
        $this->line('Importing Products From API');
        $this->line('--------------------------------------------');

        try {
            $productApiAdapter = new ProductMockApiImporterAdapter();
            (new ProductImportAction($productApiAdapter))->import();
            $this->info('Products imported successfully!');
        } catch (RuntimeException $e) {
            $this->error('An error occurred while importing products: ' . $e->getMessage());
        }

    }
}
