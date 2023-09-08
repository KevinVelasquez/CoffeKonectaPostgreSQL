@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Editar producto: {{ $product->name_product }}</h2>
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Campo para el nombre del producto -->
                <div class="form-group">
                    <label for="name_product">Nombre</label>
                    <input type="text" class="form-control" id="name_product" name="name_product" value="{{ $product->name_product }}" required>
                </div>
                <!-- Campo para la referencia -->
                <div class="form-group">
                    <label for="reference">Referencia</label>
                    <input type="text" class="form-control" id="reference" name="reference" value="{{ $product->reference }}" required>
                </div>
                <!-- Campo para el precio -->
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                </div>
                <!-- Campo para el peso (weight) -->
                <div class="form-group">
                    <label for="weight">Peso</label>
                    <input type="number" class="form-control" id="weight" name="weight" value="{{ $product->weight }}" required>
                </div>
                <!-- Campo para la categoría -->
                <div class="form-group">
                    <label for="category">Categoría</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ $product->category }}" required>
                </div>
                <!-- Campo para el stock -->
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                </div>
                <!-- Agrega más campos según lo requieras -->
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a type="button" href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>

            </form>
        </div>
    </div>
</div>
@endsection
