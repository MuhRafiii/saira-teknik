<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPaid;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::find($request->order_id);
        if (!$order) return response()->json(['message' => 'Order not found'], 404);

        if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
            $order->status = 'paid';
            $order->save();
            Mail::to($order->email)->send(new OrderPaid($order));
        }

        return response()->json(['message' => 'OK']);
    }
}
