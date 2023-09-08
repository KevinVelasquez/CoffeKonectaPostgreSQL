@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Información de la Venta</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="text-right">Total:</th>
                        <td>${{ $sale->total }}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Método de Pago:</th>
                        <td>{{ $sale->methodPayment->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h3>Productos Vendidos</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th class="text-right">Precio</th>
                        <th class="text-right">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name_product }}</td>
                        <td class="text-right">${{ $product->price }}</td>
                        @endforeach
                        @foreach($saleDetails as $saleDetail)
                        <td class="text-right">{{ $saleDetail->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ route('sales.index') }}" class="btn btn-primary">Volver</a>
</div>

@endsection