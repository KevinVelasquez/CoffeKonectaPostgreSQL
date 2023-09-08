<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'total',
        'method_payment_id',
    ];

    public function methodPayment()
    {
        return $this->belongsTo(MethodPayment::class, 'method_payment_id', 'id');
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
