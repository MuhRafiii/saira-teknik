@extends('layouts.admin')

@section('title', 'Sales Report')
@section('header', 'Sales Report')

@section('content')
<div class="p-4 sm:p-6">
    <h2 class="text-xl font-semibold mb-4">Sales Report</h2>

    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-4">
        <select wire:model="month" class="border rounded p-2 w-full sm:w-auto">
            <option value="">Choose Month</option>
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
            @endfor
        </select>

        <div class="flex gap-2">
            <button wire:click="exportExcel" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export Excel</button>
            <button wire:click="exportPDF" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Export PDF</button>
        </div>
    </div>

    <table class="w-full border-collapse table-auto text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr class="text-center">
                    <td class="p-2 border">{{ $order->name }}</td>
                    <td class="p-2 border">{{ $order->email }}</td>
                    <td class="p-2 border">Rp {{ number_format($order->total) }}</td>
                    <td class="p-2 border">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-4">No data found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>

@endsection
