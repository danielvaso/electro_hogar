<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductDetail extends Model
{
    

    protected $fillable = [
        'product_id',
        'sku',
        'barcode',
        'size',
        'color',
        'material',
        'location',
        'price',
        'stock',
        'date_manufactured',
        'notes'
    ];

    protected $dates = ['date_manufactured', 'deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
