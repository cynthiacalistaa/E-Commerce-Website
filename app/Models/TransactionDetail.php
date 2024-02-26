<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = ['transactionid', 'productsid', 'qty', 'bukti_bayar'];
    protected $table = ('TransactionDetail');

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactionid');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productsid', 'id');
    }
}
