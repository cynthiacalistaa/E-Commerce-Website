<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'usersid',
        'productsid',
        'qty'
    ];

    protected $table = 'cart';

    // Di dalam model Cart
public function product()
{
    return $this->belongsTo(Product::class, 'productsid', 'id');
}

}
