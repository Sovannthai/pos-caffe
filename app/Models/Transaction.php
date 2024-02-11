<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class


Transaction extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'total_qty',
        'subtotal',
        'discount',
        'total',
        'status',
        'table_id',
        'customer_id',
        'saler_id',
    ];

    public function Transactionsaleline(){
        return $this->hasMany(Transactionsaleline::class);
    }
     public function customer()
     {
        return $this->belongsTo(Customer::class);
     }
     public function table()
     {
        return $this->belongsTo(Table::class);
     }
     public function saler()
     {
        return $this->belongsTo(User::class);
     }
}
