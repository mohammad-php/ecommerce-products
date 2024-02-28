<?php
declare(strict_types=1);

namespace App\Adapters;

use App\Enums\ProductStatusEnum;
use App\Interfaces\ProductImporterInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use JsonException;

/**
 *
 */
class ProductMockApiImporterAdapter implements ProductImporterInterface
{

    /**
     * @return void
     */
    public function import(): void
    {
        $apiUrl = config('import.products.mockApiUrl');

        try {
            $response = Http::get($apiUrl);
            if (!$response->successful()) {
                throw new JsonException("Error while reading API Data!");
            }

            $productsList = $response->json();
            foreach($productsList as $productItem) {
                Product::updateOrCreate(
                    [
                        'name' => $productItem['name']
                    ],
                    [
                        'name' => $productItem['name'],
                        'price' => $productItem['price'],
                        'status' => ProductStatusEnum::HIDDEN->value,
                        'image_url' => $productItem['image'],
                        'variations' => json_encode($productItem['variations'], JSON_THROW_ON_ERROR),
                    ]
                );
            }
            Log::channel('stderr')
                ->info('Products imported successfully!');
        } catch (JsonException $e) {
            Log::channel('stderr')
                ->info('An error occurred while importing products: ' . $e->getMessage());
        }

    }
}
