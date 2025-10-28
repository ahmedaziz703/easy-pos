<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'barcode',
        'price',
        'tax',
        'quantity',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function getImageUrl()
{
    return $this->image 
        ? asset('storage/' . $this->image) 
        : asset('images/default-product.png');
}


}
