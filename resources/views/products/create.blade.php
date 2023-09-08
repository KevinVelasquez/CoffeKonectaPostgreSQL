@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2 class="my-4">Crear Producto</h2>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <!-- Campo para el nombre del producto -->
                <div class="form-group">
                    <label for="name_product">Nombre del Producto</label>
                    <input type="text" class="form-control @error('name_product') is-invalid @enderror" id="name_product" name="name_product" value="{{ old('name_product') }}" required>
                    @error('name_product')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Campo para la referencia -->
                <div class="form-group">
                    <label for="reference">Referencia</label>
                    <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference" name="reference" value="{{ old('reference') }}" required>
                    @error('reference')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Campo para el precio -->
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Campo para el peso (weight) -->
                <div class="form-group">
                    <label for="weight">Peso</label>
                    <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight') }}" required>
                    @error('weight')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Campo para la categoría -->
                <div class="form-group">
                    <label for="category">Categoría</label>
                    <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" required>
                    @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Campo para el stock -->
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" required>
                    @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Agrega más campos según lo requieras -->

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a type="button" href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>

            </form>
        </div>
    </div>
</div>

@endsection