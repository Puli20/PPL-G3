<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_weight',
        'price',
        'description',
        'image',
        'stock'
    ];

    public function transaction_detail(){
        return $this->hasOne(TransactionDetail::class, 'products_id');
    }
    public function gallery(){
        return $this->hasMany(Gallery::class, 'product_id');
    }
    public function review(){
        return $this->hasMany(Review::class, 'product_id');
    }
}
