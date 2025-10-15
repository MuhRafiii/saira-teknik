@component('mail::message')
# Payment Received Successfully ✅

Hi **{{ $order->name }}**,  
We’ve received your payment for your order. Here are the details:

@component('mail::panel')
**Order ID:** {{ $order->id }}  
**Status:** {{ ucfirst($order->status) }}  
**Total Paid:** Rp {{ number_format($order->total, 0, ',', '.') }}  
**Payment Date:** {{ $order->payment_date->format('d F Y, H:i') }}
@endcomponent

### Order Summary

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
    <tfoot style="background-color: #f8f8f8;"">
        <tr>
            <th colspan="3" style="text-align: center;">TOTAL</th>
            <th>Rp {{ number_format($order->total, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>

<p style="margin-top: 10px;">Your order will be processed and shipped soon.</p>
<p>Thank you for shopping with us!</p>

Thanks,<br>
**Saira Teknik**
@endcomponent
