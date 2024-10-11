<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($reportType) }} Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .summary { margin-top: 30px; }
        .summary h2 { color: #333; }
        .summary p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>{{ ucfirst($reportType) }} Report</h1>
    <p>Period: {{ $startDate->format('Y-m-d') }} to {{ $endDate->format('Y-m-d') }}</p>

    <table>
        <thead>
            <tr>
                @if($reportType === 'users')
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered On</th>
                @elseif($reportType === 'transactions')
                    <th>ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Date</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    @if($reportType === 'users')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                    @elseif($reportType === 'transactions')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                        <td>IDR {{ number_format($item->total_price, 0, ',', '.') }}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="4">No data available for the selected period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <h2>Kesimpulan</h2>
        @if($reportType === 'users')
            <p>Jumlah Pengguna Baru di periode ini: {{ $summary['totalUsers'] }}</p>
            <p>Total Pengguna: {{ $summary['totalAllUsers'] }}</p>
        @elseif($reportType === 'transactions')
            <p>Banyak Transaksi: {{ $summary['totalTransactions'] }}</p>
            <p>Total Jumlah Transaksi : IDR {{ number_format($summary['totalAmount'], 0, ',', '.') }}</p>
            <p>Rata-Rata Jumlah Transaksi: IDR {{ number_format($summary['averageAmount'], 2, ',', '.') }}</p>
        @endif
    </div>
</body>
</html>
