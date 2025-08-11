@extends('layouts.admin')

@section('title', 'Create Category')
@section('header', 'Create Category')

@section('content')
    <div id="page-content" class="bg-white p-4 sm:p-6 rounded shadow max-w-xl mx-auto">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Add New Category</h2>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4" onsubmit="setLoadingState('loading-popup-create-category', true)">
            @csrf

            <div>
                <label for="name" class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" id="name" name="name"
                       class="w-full px-3 py-2 sm:py-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-500 text-sm sm:text-base"
                       required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="image" class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Category Image</label>
                <input type="file" id="image" name="image"
                class="w-full px-2 py-1 sm:py-1.5 border border-gray-300 rounded-md shadow-sm text-sm sm:text-base hover:bg-gray-100 cursor-pointer">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2 flex items-center justify-between">
                <a href="{{ route('admin.categories.index') }}"
                   class="text-gray-600 hover:text-gray-800 text-sm sm:text-base">← Back to List</a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md text-sm sm:text-base transition cursor-pointer">
                    Create
                </button>
            </div>
        </form>
    </div>

    <x-loading-popup id="loading-popup-create-category">
        Creating new category...
    </x-loading-popup>
@endsection