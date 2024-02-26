<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'usersid',
        'alamat',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'kodepos',
        'transaction_date',
        'status',
    ];

    protected $table = 'transaction';

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transactionid', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usersid', 'id');
    }


}
