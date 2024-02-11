<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Transactionsaleline extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'transaction_id');
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function unit()
    {
        return $this->hasMany(Unit::class);
    }
}
