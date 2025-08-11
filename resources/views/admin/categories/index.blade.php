@extends('layouts.admin')

@section('title', 'Category List')
@section('header', 'Category List')

@section('content')
    <div id="page-content" class="bg-white p-4 sm:p-6 rounded shadow w-full overflow-x-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Categories</h2>
            <a href="{{ route('admin.categories.create') }}">
                <button class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm sm:text-base transition cursor-pointer">
                    + Add Category
                </button>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border border-gray-200 text-sm sm:text-base">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-center">
                    <th class="px-4 py-2 border-b">No</th>
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Image</th>
                    <th class="px-4 py-2 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $index => $category)
                    <tr class="h-20 hover:bg-gray-50 transition text-center">
                        <td class="px-4 py-3 border-b">{{ ($categories->currentPage() - 1) * $categories->perPage() + ($index + 1) }}</td>
                        <td class="px-4 py-3 border-b">{{ $category->name }}</td>
                        <td class="px-4 py-3 border-b">
                            @if ($category->image)
                                <div class="flex justify-center">
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}" class="h-8 sm:h-12 lg:h-14 rounded">
                                </div>
                            @else
                                <span class="text-gray-400">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 border-b text-center">
                            <div class="flex justify-center items-center gap-2 flex-wrap">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs sm:text-sm"
                                    >
                                    Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        class="delete-category">
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
                        <td colspan="4" class="text-center text-gray-500 py-4">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-loading-popup id="loading-popup-delete-category">
        Deleting category...
    </x-loading-popup>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.delete-category').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Cegah submit langsung

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will delete the products from this category!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setLoadingState('loading-popup-delete-category', true)
                        form.submit(); // Submit form jika dikonfirmasi
                    }
                });
            });
        });
    </script>
@endpush
