<h1>Terima kasih, {{ $order->name }}!</h1>
<p>Pesanan Anda telah kami terima dengan nomor order <b>#{{ $order->id }}</b>.</p>
<p>Total pembayaran: <b>Rp {{ number_format($order->total, 0, ',', '.') }}</b></p>
<p>Status saat ini: <b>{{ ucfirst($order->status) }}</b></p>
