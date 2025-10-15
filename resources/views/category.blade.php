@extends('layouts.customer')

@section('title', 'Categories')

@section('content')
  <section class="pt-16 pb-12 bg-white min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-24">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">All Categories</h1>
        <p class="text-sm sm:text-base text-gray-600 mt-2">Explore our wide range of categories</p>
      </div>

      @if ($categories)
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
          @foreach ($categories as $category)
            <a href="{{ route('category.show', $category->id) }}"
              class="block p-4 text-center bg-gray-100 hover:bg-gray-200 rounded-lg shadow-sm hover:shadow transition">
              <img src="{{ $category->image ?? 'https://res.cloudinary.com/dypiyksms/image/upload/v1754490991/placeholder_dvwraw.png' }}" alt="{{ $category->name }}" class="h-16 object-cover mx-auto rounded-md">
              <h2 class="text-lg sm:text-xl font-semibold text-gray-700 mb-1 truncate">
                {{ $category->name }}
              </h2>
            </a>
          @endforeach
        </div>
      @else
        <div class="text-center text-gray-600 py-10">
          Belum ada kategori tersedia.
        </div>
      @endif
    </div>
  </section>
@endsection