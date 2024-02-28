<?php

namespace App\Imports;

use App\Enums\ProductStatusEnum;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class ProductsImport implements
    ToCollection, WithUpsertColumns, WithUpserts, SkipsOnError,
    SkipsOnFailure, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{

    use Importable, SkipsErrors, SkipsFailures;

    public function collection(Collection $collection): void
    {
        foreach($collection as $row) {
            $product = Product::withTrashed()->whereId($row['id'])->whereName($row['name']);
            // To Do: to use destroy method
            if(!empty($product)) {
                $product->forceDelete();
            }

            $validator = Validator::make($row->toArray(), $this->rules());
            if(!$validator->fails()) {
                // To Do: Use ProductVariations, ProductsVariationOptions Morph Relations
                Product::updateOrCreate(
                    [
                        'name' => $row['name']
                    ],
                    $row->toArray()
                );
//                Product::create($row->toArray());
            }
        }

        $this->softDeleteProducts($collection);

    }

    private function softDeleteProducts(Collection $collection)
    {
        $productsIds = $collection->pluck('id')->toArray();
        if(!empty($productsIds)) {
            Product::whereNotIn('id', $productsIds)
                ->orWhere('status', ProductStatusEnum::DELETED->value)
                ->get()
                ->each(function ($product) {
                    Log::channel('stderr')
                        ->info("Product ID #{$product->id} was deleted due to synchronization");
                    $product->delete();
                });
        }
    }

    public function onError(Throwable $e): void
    {
        Log::error($e->getMessage());
    }

    public function onFailure(Failure ...$failures): void
    {
        Log::error($failures);
    }



    public function upsertColumns()
    {
        return ['id', 'name'];
    }

    public function uniqueBy()
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => 'nullable|string', // |unique:products,name
            'price' => 'nullable|numeric',
            'currency' => 'nullable|string',
            'sku' => 'nullable|unique:products,name',
            'variations' => 'nullable',
            'status' => 'required|string',
        ];
    }

    public function batchSize(): int
    {
        return 20;
    }

    public function chunkSize(): int
    {
        return 20;
    }
}
