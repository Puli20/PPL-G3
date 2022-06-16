<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalProduction extends Model
{
    use HasFactory;

    protected $table = 'modal_produksi';
    protected $fillable = [
        'product_id',
        'tanggal',
        'berat',
        'harga',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
