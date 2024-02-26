@extends('admin.main')

@section('admin.content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card mb-4">
                <div class="card-header bg-red text-center">
                    <h6 class="mb-0 text-black">Update Product</h6>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form method="POST" action="{{ route('product.update', ['id' => $product->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group px-5 py-1">
                                    <label for="name" class="text">Name</label>
                                    <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}"
                                        class="form-control" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group px-5 py-1">
                                    <label for="category" class="text">Category</label>
                                    <select class="form-control" name="categoryid">
                                        <option value="">Choose Category</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}"
                                                {{ $c->id == $product->categoryid ? 'selected' : '' }}>
                                                {{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group px-5 py-1">
                                    <label for="price" class="text">Price</label>
                                    <input id="price" type="number" name="price"
                                        value="{{ old('price', $product->price) }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group px-5 py-1">
                                    <label for="stock" class="text">Stock</label>
                                    <input id="stock" type="number" name="stock"
                                        value="{{ old('stock', $product->stock) }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group px-5 py-1">
                                    <label for="desc" class="text">Description</label>
                                    <textarea id="desc" name="desc" class="form-control"
                                        required>{{ old('desc', $product->desc) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group px-5 py-1">
                                    <label for="image">{{ __('Image') }}</label>
                                    <input id="image" type="file" class="form-control" name="image">

                                    @if ($product->image)
                                        <p class="mt-2">Existing Image: {{ $product->image }}</p>
                                    @else
                                        <p class="mt-2">No existing image for this product.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
