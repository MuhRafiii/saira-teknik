<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        if (session()->has('direct_checkout')) {
            $cart = [session()->get('direct_checkout')];
        } else {
            $cart = session()->get('cart', []);
        }
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('checkout', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        if (session()->has('direct_checkout')) {
            $cart = [session()->get('direct_checkout')];
        } else {
            $cart = session()->get('cart', []);
        }
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 'pending',
            'total' => $total
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            // Kurangi stok produk
            $product = Product::find($item['id']);
            if ($product) {
                $product->stock -= $item['quantity'];
                if ($product->stock < 0) {
                    return redirect('/cart')->with('error', 'Out of stock');
                }
                $product->save();
            }
        }

        Mail::to($order->email)->send(new OrderCreated($order));

        if (session()->has('direct_checkout')) {
            session()->forget('direct_checkout');
        } else {
            session()->forget('cart');
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'email' => $order->email,
                'phone' => $order->phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment', compact('snapToken', 'order'));
    }

    public function buyNow(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Ambil quantity dari form modal
        $quantity = $request->input('quantity', 1);

        // Simpan produk ini saja di session khusus direct checkout
        session()->put('direct_checkout', [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'image' => $product->image
        ]);

        return redirect()->route('checkout.index');
    }
}
