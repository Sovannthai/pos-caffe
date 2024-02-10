<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'barcode',
        'price',
        'quantity',
        'status',
        'category_id',
        'unit_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function transactionsaleline()
    {
        return $this->belongsTo(Transactionsaleline::class);
    }
}
