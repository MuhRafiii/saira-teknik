@extends('layouts.customer')

@section('title', 'Bayar Pesanan #' . $order->id)

@section('content')
<div class="max-w-lg mx-auto text-center py-10">
    <h1 class="text-2xl font-bold mb-6">Bayar Pesanan #{{ $order->id }}</h1>
    <button id="pay-button" 
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
        Bayar Sekarang
    </button>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Pembayaran berhasil!");
                window.location.href = "/";
            },
            onPending: function(result){
                alert("Menunggu pembayaran...");
            },
            onError: function(result){
                alert("Pembayaran gagal!");
            },
            onClose: function(){
                alert('Anda menutup popup pembayaran tanpa menyelesaikan proses.');
            }
        });
    };
</script>
@endpush
