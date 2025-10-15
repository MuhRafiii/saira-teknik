@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2">Welcome to the Admin Panel</h2>
    <p class="text-sm sm:text-base text-gray-600 mb-6">
        Manage your store efficiently using the quick access links below.
    </p>

    {{-- NAVIGATION GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        {{-- Company Profile --}}
        <a href="{{ route('admin.company-profile.edit') }}"
           class="group flex flex-col items-center justify-center bg-gray-50 shadow-md rounded-lg p-6 hover:bg-blue-50 hover:shadow transition duration-200">
            <div class="text-blue-600 text-3xl font-bold mb-2">🏢</div>
            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-700">Company Profile</h3>
            <p class="text-sm text-gray-500 mt-1 text-center">Update your company details and branding.</p>
        </a>

        {{-- Categories --}}
        <a href="{{ route('admin.categories.index') }}"
           class="group flex flex-col items-center justify-center bg-gray-50 shadow-md rounded-lg p-6 hover:bg-green-50 hover:shadow transition duration-200">
            <div class="text-green-600 text-3xl font-bold mb-2">📂</div>
            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-green-700">Categories</h3>
            <p class="text-sm text-gray-500 mt-1 text-center">Manage your product categories.</p>
        </a>

        {{-- Products --}}
        <a href="{{ route('admin.products.index') }}"
           class="group flex flex-col items-center justify-center bg-gray-50 shadow-md rounded-lg p-6 hover:bg-yellow-50 hover:shadow transition duration-200">
            <div class="text-yellow-600 text-3xl font-bold mb-2">🛒</div>
            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-yellow-700">Products</h3>
            <p class="text-sm text-gray-500 mt-1 text-center">Add, edit, or delete store products.</p>
        </a>

        {{-- Orders --}}
        <a href="{{ route('admin.orders.index') }}"
           class="group flex flex-col items-center justify-center bg-gray-50 shadow-md rounded-lg p-6 hover:bg-indigo-50 hover:shadow transition duration-200">
            <div class="text-indigo-600 text-3xl font-bold mb-2">📦</div>
            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-700">Orders</h3>
            <p class="text-sm text-gray-500 mt-1 text-center">View and manage customer orders.</p>
        </a>

        {{-- Sales Report --}}
        <a href="{{ route('admin.sales-report.index') }}"
           class="group flex flex-col items-center justify-center bg-gray-50 shadow-md rounded-lg p-6 hover:bg-pink-50 hover:shadow transition duration-200">
            <div class="text-pink-600 text-3xl font-bold mb-2">📈</div>
            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-pink-700">Sales Report</h3>
            <p class="text-sm text-gray-500 mt-1 text-center">Analyze your sales performance and trends.</p>
        </a>

    </div>
</div>
@endsection
