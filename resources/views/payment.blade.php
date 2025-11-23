@extends('layouts.customer')

@section('title', 'Bayar Pesanan #' . $order->id)

@section('content')
<div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">Order Details #{{ $order->id }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column: Order Details -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">Order Information</h2>
                    <p class="mb-2"><span class="font-medium">Name:</span> {{ $order->name }}</p>
                    <p class="mb-2"><span class="font-medium">Email:</span> {{ $order->email }}</p>
                    <p class="mb-2"><span class="font-medium">Status:</span> <span class="px-2 py-1 rounded-full text-sm font-semibold {{ $order->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : ($order->status == 'paid' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800') }}">{{ ucfirst($order->status) }}</span></p>
                    <p class="mb-2"><span class="font-medium">Total:</span> Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                    <p class="mb-4"><span class="font-medium">Order Date:</span> {{ $order->created_at->format('d M Y H:i') }}</p>

                    <h3 class="text-lg font-semibold mb-3">Order Items</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Product</th>
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Price</th>
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Quantity</th>
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr class="border-b border-gray-200 last:border-b-0">
                                        <td class="py-3 px-4 text-sm text-gray-800">{{ $item->product->name }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-800">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-800">{{ $item->quantity }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-800">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right Column: Payment Button -->
                {{-- <div class="flex flex-col items-center justify-center bg-gray-50 p-6 rounded-lg shadow-inner">
                    <p class="text-lg font-medium mb-4 text-gray-700">Want to make a payment?</p>
                    <button id="pay-button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-xl transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 cursor-pointer">
                        Pay Now
                    </button>
                    <p class="text-sm text-gray-500 mt-4">Total to be paid: <span class="font-semibold text-gray-800">Rp{{ number_format($order->total, 0, ',', '.') }}</span></p>
                </div> --}}
                <div class="flex flex-col items-center justify-center bg-gray-50 p-6 rounded-lg shadow-inner">
                    <p class="text-lg font-medium mb-4 text-gray-700">Want to make a payment?</p>
                    <button 
                        class="bg-gray-400 text-white font-bold py-3 px-6 rounded-lg text-xl cursor-not-allowed opacity-60" 
                        disabled>
                        Payment Disabled
                    </button>

                    <p class="text-red-600 text-sm mt-3 text-center">
                        We’re sorry, online payment is not available at the moment. Your order has been received, and we will reach out to you for the next steps.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{-- <script>
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Payment Successful!',
                    text: 'Your payment was completed successfully.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = "{{ route('product.index') }}";
                });
            },
            onPending: function(result) {
                Swal.fire({
                    icon: 'info',
                    title: 'Payment Pending',
                    text: 'Your payment is still pending. Please complete the payment as instructed.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = "{{ route('product.index') }}";
                });
            },
            onError: function(result) {
                Swal.fire({
                    icon: 'error',
                    title: 'Payment Failed',
                    text: 'Something went wrong during the payment process. Please try again later.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            },
            onClose: function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Payment Cancelled',
                    text: 'You closed the payment popup before completing the transaction.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#f59e0b'
                });
            }
        });
    };
</script> --}}
<script>
    Swal.fire({
        title: "Order Placed Successfully!",
        text: "Order details have been sent to {{ $order->email }}.",
        icon: "success",
        confirmButtonText: "OK"
    });
</script>
@endpush
