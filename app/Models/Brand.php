<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'brand_code',
        'brand_name',
        'origin_country',
        'founder_name',
        'established_year',
        'contact_email',
        'phone_number',
        'headquarters_address',
        'website_url'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function clothes()
    {
        return $this->hasMany(Clothes::class, 'brand_id', 'id');
    }
}