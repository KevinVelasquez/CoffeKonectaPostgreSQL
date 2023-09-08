@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Producto más Vendido</h2>
    @if ($mostSoldProduct)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nombre del Producto: {{ $mostSoldProduct->name_product }}</h5>
            <p class="card-text">Cantidad Vendida: {{ $mostSoldProduct->total_sold }} Unidades</p>
        </div>
    </div>
    @else
    <p>No hay productos vendidos.</p>
    @endif
    <a href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
