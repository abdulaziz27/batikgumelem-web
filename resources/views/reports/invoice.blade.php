<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $transaction->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Invoice #{{ $transaction->id }}</h1>
    <p>Date: {{ $transaction->created_at->format('d/m/Y') }}</p>
    <p>Name: {{ $transaction->name }}</p>
    <p>Address: {{ $transaction->address }}</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->transactionItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>IDR {{ number_format($item->price) }}</td>
                <td>IDR {{ number_format($item->quantity * $item->price) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>IDR {{ number_format($transaction->total_price) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
