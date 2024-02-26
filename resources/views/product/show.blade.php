@extends('main')
@section('content')
<div class="row px-xl-5 pb-3">
        @foreach ($product as $p)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-3 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border-3 p-0">
                        <img class="img-fluid w-100" src="{{ asset('storage/images/' . $p->image) }}" alt="Product Image">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $p->name }}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>${{ $p->price }}</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border-3">
                        <a href="{{ route('product.detail', ['id' => $p->id]) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <button onclick="showQuantityForm({{ $p->id }})" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                        <!-- Form untuk menambahkan produk ke keranjang -->
                        
                        <!-- End of Form untuk menambahkan produk ke keranjang -->
                    </div>
                    <form method="post" action="{{ route('cart.add', ['product' => $p->id]) }}" id="add-to-cart-form-{{ $p->id }}" style="display: none;">
                                @csrf
                                <div class="quantity-container text-left">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" name="quantity" value="1" min="1">
                                </div>
                            <button type="submit" class="btn btn-primary text-left btn-xs">Add to Cart</button>
                        </form>
                </div>
            </div>
        @endforeach
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