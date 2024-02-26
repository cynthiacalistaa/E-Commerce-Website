@extends('main')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 px-5">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>History Transaction</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No Transaksi</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transactionDetail)
                                <tr>
                                    <td>{{ 'TRX-' . str_pad($transactionDetail->transactionid, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $transactionDetail->product->image) }}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
                                        <small>{{ $transactionDetail->product->name }}</small>
                                    </td>
                                    <td>{{ $transactionDetail->product->price * $transactionDetail->qty }}</td>
                                    <td>
                                        @if($transactionDetail->transaction->status == 1)
                                            <span class="text-warning ms-sm-2 font-weight-bold">Sudah dibayar</span>
                                        @elseif($transactionDetail->transaction->status == 2)
                                            <span class="text-primary ms-sm-2 font-weight-bold">Pesanan dikirim</span>
                                        @elseif($transactionDetail->transaction->status == 3)
                                            <span class="text-sucsess ms-sm-2 font-weight-bold">Pesanan Selesai</span>
                                        @else
                                            <span class="text-danger ms-sm-2 font-weight-bold">Belum dibayar</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($transactionDetail->transaction->status == 0)
                                        <form method="POST" action="{{ route('transaction.update', ['id' => $transactionDetail->id]) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="file" name="image" required>
                                            <input type="hidden" name="transaction_id" value="{{ $transactionDetail->transactionid }}">
                                    
                                            <button type="submit" class="btn btn-primary mt-2">Send</button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                    @if($transactionDetail->transaction->status != 3 && 0)
                                    <form method="post" action="{{ route('transaction.done', $transactionDetail->id) }}">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-success">Pesanan diterima</button>
                                    </form>
                                    @endif
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
@endsection
