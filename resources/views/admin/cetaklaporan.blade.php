<h3><center>Report Transaction</center></h3>
<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>#</th>
    <th>Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
  </tr>
  @foreach ($transactions as $transaction)
    @foreach ($transaction->details as $transactionDetail)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $transaction->name }}</td>
        <td>{{ $transaction->alamat }}</td>
        <td>{{ $transaction->no_telp }}</td>
        <td>{{ $transactionDetail->product->name }}</td>
        <td>{{ $transactionDetail->product->price }}</td>
        <td>{{ $transactionDetail->qty }}</td>
        <td>{{ $transactionDetail->product->price * $transactionDetail->qty }}</td>
      </tr>
    @endforeach
  @endforeach
</table>
