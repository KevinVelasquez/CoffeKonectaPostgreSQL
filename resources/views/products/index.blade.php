@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-3">
                <h2>Listado de productos</h2>
                <a href="{{ route('products.create') }}" class="btn btn-primary">Nuevo producto</a>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('products.maxStock') }}" class="btn btn-primary">Producto con más Stock</a>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('products.mostSold') }}" class="btn btn-primary">Producto más Vendido</a>
            </div>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Referencia</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name_product }}</td>
                        <td>{{ $product->reference }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->created_at}}</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $products->links() }} <!-- Paginación -->
            </div>
        </div>
    </div>
</div>
@endsection