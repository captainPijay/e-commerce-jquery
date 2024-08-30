@extends('back_office.layouts.index')
@section('content')
<div class="container mt-5">
    <h1>Order Products</h1>
    <form id="orderForm">
        <div id="orderItemsContainer">
            <!-- Produk akan ditambahkan di sini -->
        </div>
        <button type="button" id="addProduct" class="btn btn-primary mb-3 my-2">Add Product</button>
        <div class="mb-3">
            <h4>Total Price: <span id="totalPrice">0</span></h4>
        </div>
        <button type="submit" class="btn btn-success">Submit Order</button>
    </form>
</div>
@endsection
@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let productCounter = 0;
            let products = [];
            products = @json($data);

            function addProductRow() {
                productCounter++;
                let productOptions = products.map(product => `
            <option value="${product.id}" data-price="${product.price}">${product.name}</option>
        `).join('');

                $('#orderItemsContainer').append(`
                    <div class="card shadow order-item p-3 mt-3">
                        <div class="form-group">
                            <label for="product_${productCounter}">Product ${productCounter}</label>
                            <select class="form-control product-select" id="product_${productCounter}" name="products[]">
                                <option value="" data-price="0">Select Product</option>
                                ${productOptions}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity_${productCounter}">Quantity</label>
                            <input type="number" class="form-control quantity-input" id="quantity_${productCounter}" name="quantities[]" value="1" min="1">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control price-input" id="price_${productCounter}" name="prices[]" readonly>
                        </div>
                        <button type="button" class="btn btn-danger remove-product mt-2">Remove</button>
                    </div>
                `);
            }

            $('#addProduct').on('click', function() {
                addProductRow();
            });

            function calculateTotal() {
                let total = 0;
                $('.order-item').each(function() {
                    let price = $(this).find('.price-input').val().replace(/\D/g, '') || 0;
                    total += parseFloat(price);
                });
                $('#totalPrice').text(total.toLocaleString());
            }

            $('#orderItemsContainer').on('change', '.product-select, .quantity-input', function() {
                let row = $(this).closest('.order-item');
                let price = row.find('.product-select option:selected').data('price') || 0;
                let quantity = row.find('.quantity-input').val() || 1;
                let totalPrice = price * quantity;
                row.find('.price-input').val(totalPrice.toLocaleString());
                calculateTotal();
            });

            $('#orderItemsContainer').on('click', '.remove-product', function() {
                $(this).closest('.order-item').remove();
                calculateTotal();
            });

            $('#orderForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serializeArray();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/front-office/save-order',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to submit order.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    }
                });

            });
        });
    </script>
@endsection
