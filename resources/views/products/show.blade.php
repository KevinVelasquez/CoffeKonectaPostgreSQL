@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Detalles del producto: {{ $product->name_product }}</h2>
                    <p class="card-text"><strong>Referencia:</strong> {{ $product->reference }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ $product->price }}</p>
                    <p class="card-text"><strong>Peso:</strong> {{ $product->weight }} mg</p>
                    <p class="card-text"><strong>Categoría:</strong> {{ $product->category }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $product->stock }} Unidades</p>
                </div>
            </div>
            <a type="button" href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>

@endsection