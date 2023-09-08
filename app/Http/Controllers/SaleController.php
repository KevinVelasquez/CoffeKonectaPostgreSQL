<?php

namespace App\Http\Controllers;

use App\Models\MethodPayment;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {

        $products = Product::all();
        $methodPayments = MethodPayment::all();
        $sale = new Sale();

        return view('sales.create', compact('products', 'methodPayments', 'sale'));
    }

    public function store(Request $request)
    {
        // Validar la entrada, incluyendo el total de la venta
        $request->validate([
            'total' => 'required|numeric',
            'products' => 'required|array|min:1',
            'products.*' => 'integer|min:1', // Validar que todas las cantidades sean enteros positivos
        ]);

        // Crear una nueva venta
        $sale = Sale::create([
            'total' => $request->input('total'),
            'method_payment_id' => $request->input('methodPayments')[0], // Suponiendo que solo hay un método de pago seleccionado
        ]);

        // Obtener los productos y cantidades seleccionados
        $selectedProducts = $request->input('products');
        $quantities = $request->input('quantities');

        // Recorrer los productos seleccionados y crear detalles de venta
        for ($i = 0; $i < count($selectedProducts); $i++) {
            $productId = $selectedProducts[$i];
            $quantity = $quantities[$i];
        
            $product = Product::find($productId);
        
            if ($product && $product->stock >= $quantity) {
                // Crear el detalle de venta
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
        
                // Actualizar el stock del producto
                $product->decrement('stock', $quantity);
            }
        }
        return redirect()->route('sales.index')
        ->with('success', 'Exitos.');
    }


    public function show($id)
    {
        // Obtener la venta específica por su ID
        $sale = Sale::findOrFail($id);

        // Obtener los productos vendidos relacionados con esta venta
        $saleDetails = SaleDetail::where('sale_id', $id)->get();
        // Puedes obtener los productos relacionados a través de los detalles de venta si lo necesitas
        $products = [];

        foreach ($saleDetails as $saleDetail) {
            $product = $saleDetail->product;
            $products[] = $product;
        }

        return view('sales.show', compact('sale', 'saleDetails', 'products'));
    }
}
