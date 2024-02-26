@extends('admin.main')

@section('admin.content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="container text-right">
            <div class="center">
                <a class="btn btn-white" href="{{ route('cetaklaporan') }}" target="_blank">
                    <i class="fa fa-print"></i> Print Report
                </a>
            </div>
        </div>
        @foreach ($transactions as $transaction)
            @if($transaction->status == 3)
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <div class="card-header bg-red text-center">
                            <h6 class="mb-0 text-black">History</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $transaction->name }}</h6>
                                        <span class="mb-2 text-xs">Address: <span class="text-dark font-weight-bold ms-sm-2">{{ $transaction->alamat }}</span></span>
                                        <span class="mb-2 text-xs">Phone: <span class="text-dark ms-sm-2 font-weight-bold">{{ $transaction->no_telp }}</span></span>
                                        <span class="mb-2 text-xs">Transaction ID: <span class="text-dark ms-sm-2 font-weight-bold">{{ 'TRX-' . str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}</span></span>
                                        <span class="mb-2 text-xs">Status: 
                                            @if($transaction->status == 1)
                                                <span class="text-warning ms-sm-2 font-weight-bold">Sudah dibayar</span>
                                            @elseif($transaction->status == 2)
                                                <span class="text-primary ms-sm-2 font-weight-bold">Pesanan dikirim</span>
                                            @elseif($transaction->status == 3)
                                                <span class="text-success ms-sm-2 font-weight-bold">Pesanan Selesai</span>
                                            @else
                                                <span class="text-danger ms-sm-2 font-weight-bold">Belum dibayar</span>
                                            @endif
                                        </span>
                                    </div>
                                </li>
                                @foreach ($transaction->details as $transactionDetail)
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-0 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-3 text-sm">Product: {{ $transactionDetail->product->name }}</h6>
                                            <span class="mb-2 text-xs">Price: <span class="text-dark ms-sm-2 font-weight-bold">{{ $transactionDetail->product->price }}</span></span>
                                            <span class="mb-2 text-xs">Quantity: <span class="text-dark ms-sm-2 font-weight-bold">{{ $transactionDetail->qty }}</span></span>
                                            <!-- Tambah bagian ini untuk menampilkan total -->
                                            <span class="mb-2 text-xs">Total: <span class="text-dark ms-sm-2 font-weight-bold">{{ $transactionDetail->product->price * $transactionDetail->qty }}</span></span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
