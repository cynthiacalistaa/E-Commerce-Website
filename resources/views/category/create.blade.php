@extends('admin.main')

@section('admin.content')
    <div class="container mt-1">
        <div class="row">
            <!-- Create Product Form (on the left) -->
            <div class="col-lg-6">
                <div class="container-fluid py-4">
                    <div class="card mb-4">
                        <div class="card-header bg-red text-center">
                            <h6 class="mb-0 text-black">Create Category</h6>
                        </div>
                        <div class="card-body px-4 pt-0 pb-2">
                            <form method="POST" action="{{ route('category.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group px-5 py-1">
                                            <label for="name" class="text">Name</label>
                                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" required autofocus>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Category Table (on the right) -->
            <div class="col-lg-6">
                <div class="container-fluid py-4">
                    <div class="card mb-4">
                        <div class="card-header bg-red text-center">
                            <h6 class="mb-0 text-black">Category</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Category</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $i => $v)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $v->name }}</span>
                                                </td>
                                                <td>
                                                    <form action="{{ route('category.destroy', $v->id) }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <a href="{{ route('category.edit', $v->id) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
