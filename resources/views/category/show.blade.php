<h2>Products in {{ $selectedCategory->name }}</h2>
@foreach($products as $product)
    <div class="product">
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->description }}</p>
        <!-- Add more details as needed -->
    </div>
@endforeach