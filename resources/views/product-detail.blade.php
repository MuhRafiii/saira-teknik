@extends('layouts.customer')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:py-10">
        
        {{-- Gambar Produk --}}
        <div class="flex justify-center items-start">
            <img src="{{ $product->image ?? 'https://res.cloudinary.com/dypiyksms/image/upload/v1754490991/placeholder_dvwraw.png' }}"
                 alt="{{ $product->name }}"
                 class="w-full max-w-sm rounded-lg shadow-md object-cover">
        </div>

        {{-- Detail Produk --}}
        <div class="flex flex-col gap-4 sm:w-1/2 sm:items-center lg:items-baseline lg:w-full sm:mx-auto lg:pr-10">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
            <p class="text-gray-500 text-sm sm:text-base">{{ $product->category->name ?? '-' }}</p>
            <p class="text-gray-500 text-sm sm:text-base">Stock: {{ $product->stock?? '-' }}</p>
            <p class="text-blue-600 font-bold text-xl sm:text-2xl">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            
            <p class="text-gray-700 leading-relaxed text-sm sm:text-base text-justify prose prose-sm sm:prose lg:prose-lg whitespace-pre-line">
                {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}
            </p>

            {{-- Form jumlah & tombol --}}
            <div x-data="{ buyNowOpen: false, quantity: 1 }">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4 flex flex-col sm:flex-row gap-3 sm:items-center">
                    @csrf
                    <div class="flex gap-3 w-full sm:w-auto">
                        <button type="submit"
                            class="flex-1 sm:flex-none bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                            Add to Cart
                        </button>

                        <button type="button" @click="buyNowOpen = true"
                            class="flex-1 sm:flex-none bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition text-center cursor-pointer">
                            Buy Now
                        </button>
                    </div>
                </form>
                

                    {{-- Modal Buy Now --}}
                    <div x-show="buyNowOpen" x-transition
                        class="fixed inset-0 bg-opacity-50 flex items-center justify-center z-50">
                        <div @click.away="buyNowOpen = false" class="bg-white rounded-lg shadow-lg w-3/4 sm:w-1/2 lg:w-1/3 p-6">
                            <div class="flex gap-4">
                                <img src="{{ $product->image ?? 'https://res.cloudinary.com/dypiyksms/image/upload/v1754490991/placeholder_dvwraw.png' }}" alt="{{ $product->name }}"
                                    class="h-20 object-cover rounded">
                                <div>
                                    <h2 class="font-bold text-lg">{{ $product->name }}</h2>
                                    <p class="text-blue-600 font-semibold">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <form action="{{ route('checkout.buyNow', $product->id) }}" method="POST" class="mt-4">
                                @csrf
                                <label class="block text-sm font-medium">Quantity</label>
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    x-model.number="quantity" 
                                    min="1" 
                                    :max="{{ $product->stock }}" 
                                    class="w-full border rounded px-2 py-1 mt-1"
                                >

                                <template x-if="quantity > {{ $product->stock }}">
                                    <p class="mt-2 text-sm text-red-500">Out of stock!</p>
                                </template>

                                <div class="mt-6 flex justify-end gap-2">
                                    <button type="button" @click="buyNowOpen = false"
                                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded cursor-pointer">Cancel</button>
                                    <button
                                        type="submit"
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded cursor-pointer disabled:opacity-50 disabled:pointer-events-none"
                                        :disabled="quantity > {{ $product->stock }} || quantity < 1"
                                        >
                                        Checkout
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@if (session('add-success'))
    @push('scripts')
    <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('add-success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endpush
@endif
