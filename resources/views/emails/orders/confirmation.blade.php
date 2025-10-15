@component('mail::message')
# Thank You for Your Order!

Hi **{{ $order->name }}**,  
Thank you for shopping with us! Here are the details of your order:

@component('mail::panel')
**Order ID:** {{ $order->id }}  
**Status:** {{ ucfirst($order->status) }}  
**Total:** Rp {{ number_format($order->total, 0, ',', '.') }}  
**Address:** {{ $order->address }}
@endcomponent

### Order Items

<table width="100%" cellpadding="6" cellspacing="0" style="font-size: 14px; width: 100%; text-align: center;">
    <thead style="background-color: #f8f8f8;">
        <tr>
            <th style="width: 40%; word-break: break-word;">Product</th>
            <th style="width: 15%;">Qty</th>
            <th style="width: 20%;">Price</th>
            <th style="width: 25%;">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
        <tr>
            <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; text-align: left;">
                {{ $item->product->name }}
            </td>
            <td>{{ $item->quantity }}</td>
            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot style="background-color: #f8f8f8;">
        <tr>
            <th colspan="3" style="text-align: center;">TOTAL</th>
            <th>Rp {{ number_format($order->total, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>

<p style="margin-top: 10px;">We will notify you once your payment is confirmed.</p>

Thanks,<br>
**Saira Teknik**
@endcomponent
