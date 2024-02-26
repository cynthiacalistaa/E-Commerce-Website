@extends('main')
@section('content')
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-4 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="img-fluid w-60" src="{{ asset('storage/images/' . $product->image) }}"
                                alt="Product Image">
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h1 class="font-weight-semi-bold">{{ $product->name }}</h1>
                <h3 class="font-weight-semi-bold mb-4">${{ $product->price }}</h3>
                <p class="mb-4">Stock: {{ $product->stock }}</p>
                <p class="mb-4">{{ $product->desc }}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <form method="post" action="{{ route('cart.add', ['product' => $product->id]) }}"
                        id="add-to-cart-form-{{ $product->id }}" style="display: none;">
                        @csrf
                        <div class="quantity-container text-left">
                            <label for="quantity">Qty:</label>
                            <input type="number" name="quantity" value="1" min="1">
                        </div>
                        <button type="submit" class="btn btn-primary px-3">
                            <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                        </button>
                    </form>
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
        <!-- Shop Detail End -->


        <!-- Products Start -->
        <div class="container-fluid py-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
            </div>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="owl-carousel related-carousel">
                        @foreach ($products as $p)
                            <div class="card product-item border-0">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="{{ asset('storage/images/' . $p->image) }}"
                                        alt="Product Image">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{ $p->name }}t</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>${{ $p->price }}</h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{ route('product.detail', ['id' => $p->id]) }}"
                                        class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                        Detail</a>
                                    <button onclick="showQuantityForm({{ $p->id }})"
                                        class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                                </div>
                            </div>
                            <form method="post" action="{{ route('cart.add', ['product' => $p->id]) }}"
                                id="add-to-cart-form-{{ $p->id }}" style="display: none;">
                                @csrf
                                <div class="quantity-container text-left">
                                    <label for="quantity">Jumlah:</label>
                                    <input type="number" name="quantity" value="1" min="1">
                                </div>
                                <button type="submit" class="btn btn-default text-left btn-xs">Add to Cart</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection
