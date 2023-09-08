@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Crear Nueva Venta</h2>
    <form action="{{ route('sales.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="methodPayments">Método de Pago:</label>
                    <select class="form-control" name="methodPayments[]" id="methodPaymentSelect">
                        @foreach($methodPayments as $methodPayment)
                        <option value="{{ $methodPayment->id }}">{{ $methodPayment->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="products">Producto:</label>
                    <select class="form-control" name="products[]" id="productSelect">
                        <option value="" disabled selected>Selecciona un producto</option>
                        @foreach($products as $product)
                        @if ($product->stock > 0)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">{{ $product->name_product }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Precio:</label>
                    <input type="text" class="form-control" id="price" readonly>
                </div>
                <div class="form-group">
                    <label for="quantity">Cantidad:</label>
                    <input type="number" class="form-control" name="quantities[]" min="1">
                </div>
                <button type="button" class="btn btn-primary" id="addProduct">Agregar Producto</button>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-striped" id="productsList">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <label for="total">Total:</label>
            <input type="text" class="form-control" id="total" name="total" readonly>
        </div>
        <button type="submit" class="btn btn-success btn-block mt-3">Guardar Venta</button>
    </form>
</div>



<script>
    let totalInput = document.getElementById('total');
    let hasProducts = false;
    document.addEventListener('DOMContentLoaded', function() {
        const addProductButton = document.getElementById('addProduct');
        const productFields = document.getElementById('productFields');
        const selectProduct = document.querySelector('select[name="products[]"]');
        const productsList = document.getElementById('productsList').getElementsByTagName('tbody')[0];

        addProductButton.addEventListener('click', function() {
            const selectedProduct = selectProduct.options[selectProduct.selectedIndex];
            const priceInput = price.value;
            // Obtener la cantidad ingresada
            const quantityInput = document.querySelector('input[name="quantities[]"]');
            const quantity = quantityInput.value;

            if (selectedProduct && quantity > 0) {
                // Crear una nueva fila en la tabla
                const newRow = productsList.insertRow();
                const stock = parseFloat(selectedProduct.getAttribute('data-stock'));

                if (quantity > stock) {
                    alert("La cantidad a vender no puede ser mayor que el stock del producto.");
                } else {
                    const newRow = productsList.insertRow();


                    // Insertar celdas en la nueva fila
                    const cellName = newRow.insertCell(0);
                    const cellPrice = newRow.insertCell(1);
                    const cellQuantity = newRow.insertCell(2);
                    const cellSubtotal = newRow.insertCell(3);
                    const cellActions = newRow.insertCell(4);
                    cellSubtotal.classList.add('subtotal');

                    // Establecer el contenido de las celdas
                    cellName.textContent = selectedProduct.textContent;
                    cellPrice.textContent = priceInput; // Reemplaza con el precio real
                    cellQuantity.textContent = quantity;

                    // Calcular el subtotal y mostrarlo
                    const subtotal = parseFloat(priceInput) * parseInt(quantity);
                    cellSubtotal.textContent = subtotal;

                    // Agregar un botón de eliminar
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Eliminar';
                    deleteButton.classList.add('btn', 'btn-danger', 'delete-product'); // Agregar clases al botón
                    cellActions.appendChild(deleteButton);

                    //Actualizar el total
                    updateTotal();
                }

            } else {
                alert("Selecciona un producto y especifica una cantidad válida.");
            }
        });

        // Agregar un evento de clic a los botones de eliminar
        productsList.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-product')) {
                // Obtener la fila del producto a eliminar
                const row = event.target.closest('tr');
                if (row) {
                    // Obtener el subtotal de la fila
                    const subtotalCell = row.querySelector('.subtotal');
                    if (subtotalCell) {
                        //Obtener el subtotal
                        const subtotal = parseFloat(subtotalCell.textContent);
                        // Eliminar la fila
                        row.remove();

                        // Restar el subtotal al total
                        const currentTotal = parseFloat(totalInput.value) || 0;
                        totalInput.value = (currentTotal - subtotal);
                    }

                }
            }
            hasProducts = false;

        });

        // Obtener referencia al select y al campo de precio
        const productSelect = document.getElementById('productSelect');
        const priceInput = document.getElementById('price');

        // Agregar un evento de cambio al select
        productSelect.addEventListener('change', function() {
            // Obtener la opción seleccionada
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            if (selectedOption) {
                // Obtener el precio desde el atributo data-precio
                const priceProduct = selectedOption.getAttribute('data-price');
                // Mostrar el precio en el campo de precio
                priceInput.value = priceProduct;
            } else {
                // Limpiar el campo de precio si no se selecciona ninguna opción
                priceInput.value = '';
            }
        });

        //Funcion para actualizar el total

        function updateTotal() {
            const rows = productsList.getElementsByTagName('tr');
            let total = 0;
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const subtotalCell = row.getElementsByTagName('td')[3];
                if (subtotalCell) {
                    total += parseFloat(subtotalCell.textContent);
                }

            }
            totalInput.value = total;

            // Verificar si hay productos en la lista y habilitar/deshabilitar el botón
            // if (!hasProducts) {
            //     const addProductButton = document.getElementById('addProduct');
            //     addProductButton.disabled = rows.length > 0; // Deshabilitar si hay al menos un producto
            //     hasProducts = rows.length > 0; // Actualizar el estado de hasProducts
            // }
            //esta validación se hace por falta de tiempo para terminar y así poder agregar varios productos enuna venta
        };
    });
</script>
@endsection