<?php
declare(strict_types=1);

namespace App\Interfaces;

interface ProductImporterInterface
{

    /**
     * @return void
     */
    public function import(): void;

}
