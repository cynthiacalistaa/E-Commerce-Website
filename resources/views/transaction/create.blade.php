@extends('main')
@section('content')
<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <form action="{{ route('transaction.store') }}" method="post" id="checkoutForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" value="{{ auth()->user()->email}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="number" value="{{ auth()->user()->no_telp }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <textarea type="text" name="alamat" id="alamat" class="form-control" required></textarea>
                        </div>

                        <!-- Address Details -->
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="province_id" class="form-control-label">Provinsi</label>
                                <select id="province_id" class="form-control @error('province_id') is-invalid @enderror" name="province_id">
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="regency_id" class="form-control-label">Kabupaten/Kota</label>
                                <select id="regency_id" class="form-control @error('regency_id') is-invalid @enderror" name="regency_id"></select>
                                @error('regency_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror   
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="district_id" class="form-control-label">Kecamatan</label>
                                <select id="district_id" class="form-control @error('district_id') is-invalid @enderror" name="district_id"></select>
                                @error('district_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="village_id" class="form-control-label">Desa</label>
                                <select id="village_id" class="form-control @error('village_id') is-invalid @enderror" name="village_id"></select>
                                @error('village_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" name="kodepos" id="kodepos" type="text">
                        </div>
                    </div>
                
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Products</h5>

                    <!-- Loop through selected products -->
                    @php
                        $subtotal = 0; // Initialize subtotal
                    @endphp

                    @foreach ($products as $key => $v)
                        <div class="d-flex justify-content-between">
                            <p>{{ $v->name }}</p>
                            <p>Rp {{ $v->price * $qty[$key] }}</p> <!-- Calculate and display product total price -->
                            <input type="hidden" name="product_id[]" value="{{ $v->id }}">
                        </div>

                        @php
                            $subtotal += $v->price * $qty[$key]; // Update subtotal based on each product's price and quantity
                        @endphp
                    @endforeach

                    @foreach ($qty as $v)
                                <input type="hidden" name="qty[]" value="{{ $v }}">
                            @endforeach


                    <hr class="mt-0">

                    <!-- Display Subtotal -->
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">Rp {{ $subtotal }}</h6>
                    </div>
                </div>

                <!-- Display Total -->
                <div class="card-footer border-secondary bg-transparent">
                    @php
                        $total = $subtotal; // Calculate total
                    @endphp

                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">Rp {{ $total }}</h5>
                    </div>
                </div>
            </div>

            <div class="card border-secondary mb-5">
    <div class="card-header bg-secondary border-0">
        <h4 class="font-weight-semi-bold m-0">Payment</h4>
    </div>
    <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
        <h6 class="mb-0">4562   1122   4594   7852</h6>
    </div>
    <div class="card-footer border-secondary bg-transparent">
        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
    </div>
</div>

        </div>
        </form>
    </div>
</div>
<!-- Checkout End -->


    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $(function() {
                    $('#province_id').on('change', function() {
                        let province_id = $('#province_id').val();
    
                        console.log(province_id);
    
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('getkota') }}",
                            data: {
                                province_id: province_id
                            },
                            cache: false,
    
                            success: function(message) {
                                $('#regency_id').html(message);
                                $('#district_id').html('');
                                $('#village_id').html('');
                            },
                            error: function(data) {
                                console.log(`Error on ${data}`);
                            }
                        });
                    });
    
                    $('#regency_id').on('change', function() {
                        let regency_id = $('#regency_id').val();
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('getkecamatan') }}",
                            data: {
                                regency_id: regency_id
                            },
                            cache: false,
    
                            success: function(message) {
                                $('#district_id').html(message);
                                $('#village_id').html('');
                            },
    
                            error: function(data) {
                                console.log(`Error on ${data}`);
                            }
                        });
                    });
    
                    $('#district_id').on('change', function() {
                        let district_id = $('#district_id').val();
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('getdesa') }}",
                            data: {
                                district_id: district_id
                            },
                            cache: false,
    
                            success: function(message) {
                                $('#village_id').html(message);
                            },
                            error: function(data) {
                                console.log(`Error on ${data}`);
                            }
    
                        })
                    })
                })
            });
        </script>



@endsection
