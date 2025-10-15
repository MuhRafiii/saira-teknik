@extends('layouts.admin')

@section('title', 'Orders')
@section('header', 'Orders')

@section('content')
<div id="page-content" class="bg-white p-4 sm:p-6 rounded shadow w-full">

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-col sm:flex-row sm:items-end text-sm gap-3 mb-6">
        <div class="flex flex-col">
            <label for="start_date">Start Date</label>
            <input id="start_date" type="date" name="start_date" value="{{ request('start_date') }}"
            class="border p-2 rounded text-sm">
        </div>

        <div class="flex flex-col">
            <label for="end_date">End Date</label>
            <input id="end_date" type="date" name="end_date" value="{{ request('end_date') }}"
            class="border p-2 rounded text-sm">
        </div>

        <select name="status" class="border p-2 rounded">
            <option value="">All Status</option>
            <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ request('status')=='paid' ? 'selected' : '' }}>Paid</option>
            <option value="shipped" {{ request('status')=='shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Filter
        </button>
    </form>

    {{-- Order List --}}
    @if ($startDate && $endDate)
    <div class="flex flex-col gap-4">
        @forelse ($orders as $order)
        <div class="bg-gray-100 rounded p-4 shadow-sm">
            <div class="flex justify-between items-center mb-2">
                    <h2 class="w-1/2 font-semibold text-gray-800">
                        Order #{{ $order->id }} - {{ $order->email }}
                    </h2>
                    <span class="text-sm text-gray-600">
                        {{ $order->created_at->format('d M Y') }}
                    </span>
                </div>
                
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-200 text-yellow-800',
                        'paid' => 'bg-blue-200 text-blue-800',
                        'shipped' => 'bg-purple-200 text-purple-800',
                        'completed' => 'bg-green-200 text-green-800',
                    ];
                    $colorClass = $statusColors[$order->status] ?? 'bg-gray-200 text-gray-800';
                @endphp

                <span class="inline-block font-bold text-xs px-3 py-1 rounded-full mb-3 {{ $colorClass }}">
                    {{ ucfirst($order->status) }}
                </span>

                {{-- List Produk --}}
                <ul class="text-sm text-gray-700 mb-3 list-disc list-inside">
                    @foreach ($order->items as $item)
                    <li class="flex justify-between mb-1">
                        <div class="w-1/2 flex items-center gap-2">
                            <span class="w-2/3 line-clamp-1">{{ $item->product->name }}</span>
                            x {{ $item->quantity }}
                        </div>
                        Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </li>
                    @endforeach
                </ul>

                <div class="flex justify-between items-center">
                    <div class="mt-3 flex justify-end">
                        @if ($order->status === 'paid')
                        <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="shipped">
                            <button type="submit"
                            class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-green-600 transition cursor-pointer">
                            Mark as Shipped
                        </button>
                    </form>
                    @elseif ($order->status === 'shipped')
                    <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit"
                        class="bg-blue-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-600 transition cursor-pointer">
                        Mark as Completed
                    </button>
                </form>
                @endif
                </div>

                <div class="text-right font-semibold">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </div>
            </div>
        </div>
        
        @empty
        <p class="text-gray-500 text-center py-6">No orders found.</p>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
    @else
    <p class="text-gray-500 text-center py-6">Please choose the date range first</p>
    @endif
</div>
@endsection