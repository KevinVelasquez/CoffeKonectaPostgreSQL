<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_product',
        'reference',
        'price',
        'weight',
        'category',
        'stock',
    ];

    public function salesDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    // Reglas de validación (asumí que quisieras tenerlas aquí basándome en tu controlador anterior)
    public static $rules = [
        'name_product' => 'required|string|max:255',
        // ... puedes continuar con las reglas para los otros campos.
    ];
}
