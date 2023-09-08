<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MethodPayment extends Model
{
    protected $table = 'methods_payment';

    protected $fillable = [
        'name',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'method_payment_id', 'id');
    }
}