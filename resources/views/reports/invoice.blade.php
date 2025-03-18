<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $transaction->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .store-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .store-info {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details td {
            padding: 5px;
            vertical-align: top;
        }
        .customer-info {
            margin-bottom: 20px;
        }
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.items th, table.items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table.items th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .total-line {
            margin-bottom: 5px;
        }
        .total-amount {
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="store-name">Batik Gumelem</div>
        <div class="store-info">FCX5+8C3, Karangpule, Gumelem Kulon, Susukan</div>
        <div class="store-info">Banjarnegara, Jawa Tengah 53475</div>
        <div class="store-info">Phone: +62 852-1155-3430 | Email: info@batikgumelem.com</div>
    </div>

    <div class="invoice-details">
        <table>
            <tr>
                <td width="50%">
                    <strong>INVOICE TO:</strong><br>
                    {{ $transaction->name }}<br>
                    {{ $transaction->email }}<br>
                    {{ $transaction->phone }}<br>
                    {{ $transaction->address }}
                </td>
                <td width="50%" style="text-align: right;">
                    <strong>INVOICE #:</strong> {{ $transaction->id }}<br>
                    <strong>DATE:</strong> {{ $transaction->created_at->format('d/m/Y') }}<br>
                    <strong>STATUS:</strong> {{ $transaction->status }}<br>
                    <strong>PAYMENT METHOD:</strong> {{ $transaction->payment }}
                </td>
            </tr>
        </table>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Product</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->transactionItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->size_name ?? '-' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>IDR {{ number_format($item->price) }}</td>
                <td>IDR {{ number_format($item->quantity * $item->price) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Subtotal:</strong></td>
                <td>IDR {{ number_format($transaction->total_price) }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Shipping:</strong></td>
                <td>IDR 20,000</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Discount:</strong></td>
                <td>- IDR 20,000</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                <td><strong>IDR {{ number_format($transaction->total_price) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Thank you for your purchase at Batik Gumelem!</p>
        <p>This is a computer-generated document. No signature is required.</p>
    </div>
</body>
</html>
