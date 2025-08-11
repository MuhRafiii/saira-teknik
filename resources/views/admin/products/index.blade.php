@extends('layouts.admin')

@section('title', 'Product List')
@section('header', 'Product List')

@section('content')
    <div id="page-content" class="bg-white p-4 sm:p-6 rounded shadow w-full overflow-x-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-2 sm:mb-0">All Products</h2>
            <a href="{{ route('admin.products.create') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md text-sm transition"
               >
                + Create Product
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm sm:text-base border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr class="text-center">
                        <th class="px-4 py-3 border-b">No</th>
                        <th class="px-4 py-3 border-b">Name</th>
                        <th class="px-4 py-3 border-b">Category</th>
                        <th class="px-4 py-3 border-b">Price</th>
                        <th class="px-4 py-3 border-b">Stock</th>
                        <th class="px-4 py-3 border-b">Image</th>
                        <th class="px-4 py-3 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $i => $product)
                        <tr class="h-20 hover:bg-gray-50 text-center">
                            <td class="px-4 py-3 border-b">{{ ($products->currentPage() - 1) * $products->perPage() + ($i + 1) }}</td>
                            <td class="px-4 py-3 border-b">{{ $product->name }}</td>
                            <td class="px-4 py-3 border-b">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-4 py-3 border-b">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 border-b">{{ $product->stock }}</td>
                            <td class="px-4 py-3 border-b">
                                @if ($product->image)
                                    <div class="flex justify-center">
                                        <img src="{{ $product->image }}" alt="Image" class="h-8 sm:h-12 lg:h-14 w-auto rounded">
                                    </div>
                                @else
                                    <span class="text-gray-400 italic text-xs">No image</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b text-center">
                                <div class="flex justify-center items-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs sm:text-sm"
                                       >
                                       Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                          class="delete-product">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs sm:text-sm cursor-pointer">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

    <x-loading-popup id="loading-popup-delete-product">
        Deleting product...
    </x-loading-popup>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.delete-product').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Cegah submit langsung

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setLoadingState('loading-popup-delete-product', true)
                        form.submit(); // Submit form jika dikonfirmasi
                    }
                });
            });
        });
    </script>
@endpush