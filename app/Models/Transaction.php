<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'transaction_total',
        'invoice_number',
        'transaction_status',
        'total_weight',
        'product_id',
        'transaction_date'
    ];


    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function transaction_detail(){
        return $this->hasMany(TransactionDetail::class, 'transactions_id');
    }
    public function expedition(){
        return $this->hasOne(Expedition::class, 'transaction_id');
    }
}
