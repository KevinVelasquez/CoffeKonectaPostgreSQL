<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'sale_id' => 'required|exists:sales,id', 
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        // Crear el detalle de venta
        $saleDetail = SaleDetail::create([
            'sale_id' => $request->input('sale_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'subtotal' => $request->input('subtotal'),
        ]);

        return redirect()->route('sale-details.index')->with('success', 'Detalle de venta registrado exitosamente.');
    }


    public function show($id)
    {
    }
}
