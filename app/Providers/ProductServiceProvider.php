<?php

namespace App\Providers;

use App\Adapters\ProductFileImporterAdapter;
use App\Interfaces\ProductImporterInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProductImporterInterface::class => ProductFileImporterAdapter::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
