@extends('admin.main')

@section('admin.content')
<div class="container-fluid py-4">
    <div class="row">
        @foreach ($transactions as $transaction)
        @if($transaction->status != 3)
            <div class="col-md-7 mt-4 mx-auto">
                <div class="card">
                    <div class="card-header bg-red text-center">
                        <h6 class="mb-0 text-black">Detail Orders</h6>
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
                                        @switch($transaction->status)
                                            @case(1)
                                                <span class="text-warning ms-sm-2 font-weight-bold">Sudah dibayar</span>
                                                @break
                                            @case(2)
                                                <span class="text-primary ms-sm-2 font-weight-bold">Pesanan dikirim</span>
                                                @break
                                            @case(3)
                                                <span class="text-success ms-sm-2 font-weight-bold">Pesanan Selesai</span>
                                                @break
                                            @default
                                                <span class="text-danger ms-sm-2 font-weight-bold">Belum dibayar</span>
                                        @endswitch
                                    </span>
                                </div>
                            </li>
                            @foreach ($transaction->details as $transactionDetail)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-0 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Product: {{ $transactionDetail->product->name }}</h6>
                                        <span class="mb-2 text-xs">Price: <span class="text-dark ms-sm-2 font-weight-bold">{{ $transactionDetail->product->price }}</span></span>
                                        <span class="mb-2 text-xs">Quantity: <span class="text-dark ms-sm-2 font-weight-bold">{{ $transactionDetail->qty }}</span></span>
                                        <span class="mb-2 text-xs">Total: <span class="text-dark ms-sm-2 font-weight-bold">{{ $transactionDetail->product->price * $transactionDetail->qty }}</span></span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="ms-auto text-end w-45 mt-2">
                            <form method="post" action="{{ route('transactions.updateStatusToShipped', $transaction->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-primary float-start">Kirim Pesanan</button>
                            </form>
                            <form method="post" action="{{ route('transaction.done', $transaction->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-primary float-end">Pesanan Terkirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
