@extends('main')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center mb-5">{{ $product->name }}</h1>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" class="img-fluid mb-3" style="max-width: 300px;">
                    </div>
                    <div class="col-md-6">
                        <p><strong>Price:</strong> {{ $product->price }}</p>
                        <p><strong>Stock:</strong> {{ $product->stock }}</p>
                        <p><strong>Description:</strong> {{ $product->desc }}</p>
                        <!-- Tambahan informasi lainnya sesuai kebutuhan -->

                        <!-- Form untuk menambahkan produk ke keranjang -->
                        <form method="post" action="{{ route('cart.add', ['product' => $product->id]) }}">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" value="1" min="1" class="form-control">
                            </div>
                            <a href="{{ route('product.show') }}" class="btn btn-light mt-2">
                                <i class="fas fa-arrow-left"></i> Back 
                            </a>
                            <button type="submit" class="btn btn-success mt-2">Add to Cart</button> 
                        </form>
                        <!-- End of Form untuk menambahkan produk ke keranjang -->

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function showQuantityForm(productId) {
        // Hide all quantity forms
        document.querySelectorAll('[id^="add-to-cart-form-"]').forEach(form => form.style.display = 'none');
        // Show the quantity form for the selected product
        document.getElementById('add-to-cart-form-' + productId).style.display = 'block';
    }
</script>
@endsection
