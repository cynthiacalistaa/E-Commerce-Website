<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'categoryid',
        'price',
        'stock',
        'image',
        'desc'
    ];

    protected $table = 'products';

    public function Category()
    {
        return $this->belongsTo(Category::class, 'categoryid');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'productsid');
    }
}
