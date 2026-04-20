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
        Log::info('MIDTRANS HIT', [
            'method' => $request->method(),
            'content' => $request->getContent(),
        ]);

        // Handle test ping (tanpa body)
        if (!$request->getContent()) {
            return response()->json([
                'message' => 'Webhook endpoint active'
            ]);
        }

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $notif = new Notification();

            Log::info('MIDTRANS PARSED', [
                'order_id' => $notif->order_id ?? null,
                'status' => $notif->transaction_status ?? null,
            ]);

            // ✅ VALIDASI SIGNATURE (WAJIB)
            $serverKey = env('MIDTRANS_SERVER_KEY');

            $expectedSignature = hash('sha512',
                $notif->order_id .
                $notif->status_code .
                $notif->gross_amount .
                $serverKey
            );

            if ($notif->signature_key !== $expectedSignature) {
                Log::warning('Invalid Midtrans signature', [
                    'expected' => $expectedSignature,
                    'received' => $notif->signature_key
                ]);

                return response()->json(['message' => 'Invalid signature'], 403);
            }

            $transaction = $notif->transaction_status;
            $fraud = $notif->fraud_status;
            $orderId = $notif->order_id;

            $order = Order::where('id', $orderId)->first();

            // ⚠️ JANGAN RETURN 404 (biar Midtrans ga retry terus)
            if (!$order) {
                Log::warning('Order not found', ['order_id' => $orderId]);
                return response()->json(['message' => 'Order not found'], 200);
            }

            // Handle status transaksi
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
            } elseif ($transaction == 'expire') {
                $this->updateOrderStatus($order, 'expired');
            } elseif ($transaction == 'pending') {
                // optional: bisa disimpan kalau mau
                Log::info('Transaction pending', ['order_id' => $orderId]);
            }

            return response()->json(['message' => 'Callback handled successfully.'], 200);

        } catch (\Exception $e) {
            Log::error('MIDTRANS ERROR', [
                'message' => $e->getMessage(),
                'body' => $request->getContent()
            ]);

            // ⚠️ PENTING: tetap return 200
            return response()->json(['message' => 'Handled'], 200);
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