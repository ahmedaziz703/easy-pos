<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {   
        $product = Product::where('name', $row['name'])->first();

        if ($product) {
            $product->quantity = $row['quantity'] ?? 0;
            $product->save();
            return null; 
        }

        return new Product([
            'name'        => $row['name'] ?? null,
            'barcode'     => $row['barcode'] ?? null,
            'price'       => $row['price'] ?? 0,
            'quantity'    => $row['quantity'] ?? 0,
        ]);
    }
}
