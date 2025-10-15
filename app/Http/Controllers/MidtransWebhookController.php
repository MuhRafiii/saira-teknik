<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentMail;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    public function handleCallback(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $notif = new Notification();

            $transaction = $notif->transaction_status;
            $fraud = $notif->fraud_status;
            $orderId = $notif->order_id;

            $order = Order::where('id', $orderId)->first();
            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            // Tangani status transaksi
            if ($transaction == 'capture') {
                if ($fraud == 'accept') {
                    $this->updateOrderStatus($order, 'paid');
                }
            } elseif ($transaction == 'settlement') {
                $this->updateOrderStatus($order, 'paid');
            } elseif ($transaction == 'cancel') {
                $this->updateOrderStatus($order, 'cancelled');
            } elseif ($transaction == 'deny') {
                $this->updateOrderStatus($order, 'failed');
            }

            return response()->json(['message' => 'Callback handled successfully.']);
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    protected function updateOrderStatus(Order $order, string $status)
    {
        $order->update([
            'status' => $status,
            'payment_date' => now(),
        ]);

        // Kirim email jika pembayaran berhasil
        if ($status === 'paid') {
            try {
                Mail::to($order->email)->send(new PaymentMail($order));
                Log::info('Payment confirmation email sent to ' . $order->email);
            } catch (\Exception $e) {
                Log::error('Failed to send email: ' . $e->getMessage());
            }
        }
    }
}
