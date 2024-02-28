<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\ProductImportAction;
use App\Adapters\ProductFileImporterAdapter;
use http\Exception\RuntimeException;
use Illuminate\Console\Command;

/**
 *
 */
class ImportProducts extends Command
{
    /**
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * @var string
     */
    protected $description = 'Imports products into database';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->line('');
        $this->line('--------------------------------------------');
        $this->line('Importing Products From CSV File');
        $this->line('--------------------------------------------');

        try {
            $productFileAdapter = new ProductFileImporterAdapter();
            (new ProductImportAction($productFileAdapter))->import();
            $this->info('Products imported successfully!');
        } catch (RuntimeException $e) {
            $this->error('An error occurred while importing products: ' . $e->getMessage());
        }
    }
}
