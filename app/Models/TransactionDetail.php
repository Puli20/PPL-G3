<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactions_id',
        'products_id',
        'order_quantity',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'products_id');
    }
    public function transaction(){
        return $this->belongsTo(Transaction::class, 'transactions_id');
    }
}
