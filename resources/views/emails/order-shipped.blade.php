<h1>Pesanan Anda Sedang Dikirim</h1>
<p>Halo {{ $order->name }}, pesanan <b>#{{ $order->id }}</b> telah kami kirim.</p>
<p>Nomor resi: {{ $order->tracking_number ?? '-' }}</p>
