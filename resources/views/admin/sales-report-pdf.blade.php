<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background: #eee; }
        h2 { text-align: center; margin-bottom: 10px; }
        .name { text-align: left; }
        .name-header { width: 384px; }
    </style>
</head>
<body>
    <h2>Sales Report ({{ $startDateFormatted }} - {{ $endDateFormatted }})</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th class="name-header">Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="name">{{ $item->product->name ?? '-' }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->total_quantity }}</td>
                    <td>Rp {{ number_format($item->price * $item->total_quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">TOTAL</th>
                <th>Rp {{ number_format($totalIncome, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>