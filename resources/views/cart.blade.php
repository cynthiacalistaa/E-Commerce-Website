@extends('main')
@section('content')
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <form action="{{ route('transaction.create') }}" method="post" id="checkoutForm" class="shopping-cart">
                @csrf
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>====</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($keranjang as $item)
                            <tr>
                                <td class="align-middle">
                                    <input type="hidden" name="cart[]" value="{{ $item->id }}">
                                    <input type="hidden" name="product_id[]" value="{{ $item->productsid }}">
                                    <input type="hidden" name="qty[]" value="{{ $item->qty }}">
                                    <label for="product_{{ $item->id }}"></label>
                                    <input type="checkbox" name="selected_products[]" id="product_{{ $item->id }}" class="product-checkbox" data-price="{{ $item->product->price }}" data-name="{{ $item->product->name }}" data-qty="{{ $item->qty }}" value="{{ $item->id }}">
                                </td>
                                <td class="align-middle">
                                    <img src="{{ asset('storage/images/' . $item->product->image) }}" alt="Product Image" style="width: 50px;" class="mr-5">
                                    {{ $item->product->name }}
                                </td>
                                <td class="align-middle">$ {{ $item->product->price }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">$ {{ $item->product->price * $item->qty }}</td>
            
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Your cart is empty.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
                    <div class="col-lg-4">
                        <div class="card border-secondary mb-5">
                            <div class="card-header bg-secondary border-0">
                                <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                            </div>
                            <div class="card-body">
                                @php
                                    $subtotal = 0;
                                    foreach ($keranjang as $item) {
                                        $subtotal += $item->product->price * $item->qty;
                                    }
                                @endphp

                                <div class="d-flex justify-content-between mb-3 pt-1">
                                    <h6 class="font-weight-medium">Subtotal</h6>
                                    <h6 class="font-weight-medium">$ {{ $item->product->price }}</h6>
                                </div>
                            </div>
                            <div class="card-footer border-secondary bg-transparent">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5 class="font-weight-bold">Total</h5>
                                    <h5 class="font-weight-bold" id="total">$ {{ $subtotal }}</h5>
                                </div>
                                <input type="hidden" name="selected_products_json" id="selected_products_json" value="">
                                <button type="button" class="btn btn-primary btn-sm text-light" onclick="prepareCheckout()">Check Out</button>
                            </div>
                        </div>
                    </div>
                    </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var checkboxes = document.querySelectorAll('.product-checkbox');
        var selectedProductsInput = document.getElementById('selected_products_json');
        var checkoutForm = document.getElementById('checkoutForm');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateTotal();
            });
        });

        function updateTotal() {
            var total = 0;
            var selectedProducts = [];

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var price = parseFloat(checkbox.dataset.price);
                    var qty = parseFloat(checkbox.dataset.qty);
                    var itemTotalPrice = price * qty;

                    total += itemTotalPrice;

                    // Menambahkan produk yang dipilih ke dalam array
                    selectedProducts.push({
                        id: checkbox.id,
                        name: checkbox.dataset.name,
                        price: price,
                        qty: qty,
                        itemTotalPrice: itemTotalPrice,
                    });
                }
            });

            selectedProductsInput.value = JSON.stringify(selectedProducts);

            // Menampilkan total dengan 2 angka di belakang koma
            document.getElementById('total').textContent = total.toFixed(0);
        }

        // Pemanggilan fungsi pertama kali untuk menginisialisasi total
        updateTotal();
    });

    // Fungsi untuk menyiapkan checkout
    function prepareCheckout() {
        // Menyubmit formulir
        checkoutForm.submit();
    }
</script>
@endsection

