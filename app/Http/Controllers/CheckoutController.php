<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use Midtrans\Config;
// use Midtrans\Snap;
use App\Mail\OrderConfirmationMail;

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

       foreach ($cart as $item) {
            $product = Product::find($item['id']);

            if (!$product || $product->stock < $item['quantity']) {
                if (session()->has('direct_checkout')) {
                    session()->forget('direct_checkout');
                } else {
                    $cart = session()->get('cart', []);
                    unset($cart[$item['id']]);
                    session()->put('cart', $cart);
                    return redirect('/cart')->with('error', 'Sorry, some of your orders just went out of stock.');
                }
                return redirect('/cart')->with('error', 'Sorry, this product just went out of stock.');
            }
        }

        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 'pending',
            'total' => $total
        ]);

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            $product->stock -= $item['quantity'];
            $product->save();
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }
        
        if (session()->has('direct_checkout')) {
            session()->forget('direct_checkout');
        } else {
            session()->forget('cart');
        }

        // Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        // Config::$isSanitized = true;
        // Config::$is3ds = true;

        // $transaction_details = [
        //     'order_id' => $order->id,
        //     'gross_amount' => $order->total,
        // ];

        // $customer_details = [
        //     'first_name' => $order->name,
        //     'email' => $order->email,
        //     'phone' => $order->phone,
        // ];

        // $item_details = [];
        // foreach ($order->items as $item) {
        //     $item_details[] = [
        //         'id' => $item->product_id,
        //         'price' => $item->price,
        //         'quantity' => $item->quantity,
        //         'name' => $item->product->name,
        //     ];
        // }

        // $transaction = [
        //     'transaction_details' => $transaction_details,
        //     'customer_details' => $customer_details,
        //     'item_details' => $item_details,
        // ];

        try {
            Mail::to($order->email)->send(new OrderConfirmationMail($order));
        } catch (\Exception $e) {
            \Log::error("Failed to send order confirmation email: " . $e->getMessage());
        }

        // try {
        //     $snapToken = Snap::getSnapToken($transaction);
        // } catch (\Exception $e) {
        //     echo $e->getMessage();
        // }

        // return view('payment', compact('snapToken', 'order'));

        return view('payment', compact('order'));
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
