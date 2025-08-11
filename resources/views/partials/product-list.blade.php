@if ($products->count())
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
        @foreach ($products as $product)
            <div class="bg-white border border-gray-400 rounded-lg shadow hover:shadow-md transition overflow-hidden p-4">
                <a href="{{ route('product.show', $product->id) }}">
                    <div class="flex justify-center">
                        <img
                            src="{{ $product->image ?? 'https://res.cloudinary.com/dypiyksms/image/upload/v1754490991/placeholder_dvwraw.png' }}"
                            alt="{{ $product->name }}"
                            class="h-25 md:h-40 object-cover rounded"
                        />
                    </div>
                </a>
                <div class="mt-2">
                    <h2 class="text-sm sm:text-base font-semibold text-gray-700 truncate">
                        {{ $product->name }}
                    </h2>
                    <p class="text-sm text-gray-500 mt-1 mb-2 truncate">
                        {{ $product->category->name ?? '-' }}
                    </p>
                    <p class="text-base font-bold text-primary">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    <a 
                        href="{{ route('product.show', $product->id) }}"
                        class="block mt-4 text-center bg-blue-500 hover:bg-blue-600 text-white py-1.5 rounded text-sm hover:bg-primary/90 transition"
                    >
                        Lihat Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>
@else
    <div class="text-center text-gray-600 py-10">
        Produk tidak ditemukan.
    </div>
@endif
