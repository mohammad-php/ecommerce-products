<?php
declare(strict_types=1);

namespace App\Casts;

use App\Enums\ProductCurrencyEnum;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class ProductCurrencyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ProductCurrencyEnum
    {
        return ProductCurrencyEnum::from($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        return [
            $key => $value,
        ];
    }

}
