<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShippedMail;
use App\Mail\OrderCompletedMail;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $orders = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return view('admin.orders', compact('orders', 'startDate', 'endDate'));
    }

   public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:shipped,completed'
        ]);

        $data = ['status' => $request->status];

        // Jika status diubah menjadi "shipped", tambahkan tanggal pengiriman dan kirim email
        if ($request->status === 'shipped') {
            $data['shipping_date'] = now();
            $order->update($data);

            try {
                Mail::to($order->email)->send(new OrderShippedMail($order));
            } catch (\Exception $e) {
                \Log::error('Failed to send shipped email: ' . $e->getMessage());
            }
        }

        // Jika status diubah menjadi "completed", tambahkan tanggal penyelesaian dan kirim email
        elseif ($request->status === 'completed') {
            $data['completion_date'] = now();
            $order->update($data);

            try {
                Mail::to($order->email)->send(new OrderCompletedMail($order));
            } catch (\Exception $e) {
                \Log::error('Failed to send completed email: ' . $e->getMessage());
            }
        } else {
            $order->update($data);
        }

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
