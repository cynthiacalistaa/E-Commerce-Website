@extends('main')
@section('content')
<form method="POST" action="{{ route('category.update', ['id' => $category->id]) }}">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" required autofocus>
    </div>
    <div>
        <button type="submit">Update</button>
    </div>
</form>
@endsection
