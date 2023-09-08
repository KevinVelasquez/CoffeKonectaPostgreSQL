<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{

   

    public function index()
    {
        $products = Product::paginate(10); // Pagina los productos, 10 por página

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name_product' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:products',
            'price' => 'required|integer',
            'weight' => 'required|integer',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer|gt:0', // Asegura que 'stock' sea superior a 0
        ]);

        // Crear el producto
        Product::create([
            'name_product' => $request->input('name_product'),
            'reference' => $request->input('reference'),
            'price' => $request->input('price'),
            'weight' => $request->input('weight'),
            'category' => $request->input('category'),
            'stock' => $request->input('stock'),
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Usamos findOrFail para lanzar un error 404 si no se encuentra el producto

        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $this->validate($request, Product::$rules);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function maxStock()
    {
        // Consulta para obtener el producto con más stock
        $product = Product::orderBy('stock', 'desc')->first();

        return view('products.maxStock', compact('product'));
    }

    public function mostSoldProduct()
    {
        // Consulta para obtener el producto más vendido
        $mostSoldProduct = DB::table('products')
            ->join('sales_details', 'products.id', '=', 'sales_details.product_id')
            ->select('products.*', DB::raw('SUM(sales_details.quantity) as total_sold'))
            ->groupBy('products.name_product', 'products.id', 'products.reference', 'products.price', 'products.weight', 'products.category', 'products.stock' , 'products.created_at', 'products.updated_at')
            ->orderByDesc('total_sold')
            ->first();

        return view('products.mostSold', compact('mostSoldProduct'));
    }


}
