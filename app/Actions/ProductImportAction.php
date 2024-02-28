<?php
declare(strict_types=1);

namespace App\Actions;

use App\Interfaces\ProductImporterInterface;

/**
 * Action for importing products from multiple sources File/Api
 *
 */
class ProductImportAction implements ProductImporterInterface
{

    /**
     * @var ProductImporterInterface
     */
    private ProductImporterInterface $productImporter;

    /**
     * @param ProductImporterInterface $productImporter
     */
    public function __construct(ProductImporterInterface $productImporter)
    {
        $this->productImporter = $productImporter;
    }

    /**
     * @return void
     */
    public function import(): void
    {
        $this->productImporter->import();
    }
}
