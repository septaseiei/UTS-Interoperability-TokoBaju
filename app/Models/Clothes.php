<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    protected $table = 'clothes';

    protected $fillable = [
        'brand_id',
        'sku',
        'item_name',
        'category',
        'size',
        'color',
        'material',
        'price',
        'stock'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}