<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    protected $fillable = [
        'product_id',
        'comment',
        'rate_value',
        'user_id',
        'reply_admin',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
