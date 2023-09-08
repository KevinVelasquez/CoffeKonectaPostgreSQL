@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Producto con más Stock</h2>
    @if ($product)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nombre del Producto: {{ $product->name_product }}</h5>
            <p class="card-text">Stock: {{ $product->stock }} Unidades</p>
        </div>
    </div>
    @else
    <p>No hay productos disponibles.</p>
    @endif
    <a href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection


