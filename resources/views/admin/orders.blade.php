@extends('layouts.admin')

@section('title', 'Orders')
@section('header', 'Orders')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Orders</h1>

    <form method="GET" class="flex flex-wrap gap-2 mb-4">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="border p-2 rounded">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="border p-2 rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Total</th>
                    <th class="p-2 border">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="text-center">
                    <td class="p-2 border">{{ $order->name }}</td>
                    <td class="p-2 border">{{ $order->email }}</td>
                    <td class="p-2 border">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                    <td class="p-2 border">{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
