@extends('layouts.customer')

@section('title', 'Checkout')

@section('content')
  <section class="py-12 min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-2xl sm:text-3xl font-bold mb-8 text-gray-800">Order Details</h1>

      @if ($cart)
        <form action="{{ route('checkout.process') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          @csrf

          {{-- Form Pemesanan --}}
          <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary text-sm">
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary text-sm">
            </div>

            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
              <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary text-sm">
            </div>

            <div>
              <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
              <textarea id="address" name="address" rows="3" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary text-sm">{{ old('address') }}</textarea>
            </div>
          </div>

          {{-- Ringkasan Pesanan --}}
          <div class="flex flex-col justify-between bg-white p-6 rounded-lg shadow space-y-4">
            <div class="">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Order Summary</h2>
                
                <ul class="space-y-4">
                @foreach ($cart as $item)
                    <li class="flex justify-between items-start">
                    <div class="w-2/3">
                        <p class="font-medium text-gray-800 line-clamp-1">{{ $item['name'] }}</p>
                        <p class="text-sm text-gray-500">x{{ $item['quantity'] }}</p>
                    </div>
                    <div class="text-gray-700 font-semibold">
                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                        </div>
                    </li>
                    @endforeach
                </ul>
                
                <div class="border-t pt-4 mt-4 flex justify-between font-bold text-gray-800 text-lg">
                    <span>Total</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

            <button type="submit"
              class="w-full mt-6 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded transition cursor-pointer">
              Place Order
            </button>
          </div>
        </form>
      @else
        <div class="text-center text-gray-600 py-16">
          <p class="text-lg">Your cart is empty.</p>
          <a href="{{ route('product.index') }}" class="mt-4 inline-block text-blue-500 hover:underline text-sm">
            Shop Now
          </a>
        </div>
      @endif
    </div>
  </section>
@endsection
