@component('mail::message')
# Your Order Has Been Shipped 🚚

Hi **{{ $order->name }}**,  
Your order (ID: **{{ $order->id }}**) has been shipped!

@component('mail::panel')
**Shipping Date:** {{ $order->shipping_date->format('d M Y H:i') }}  
**Status:** {{ ucfirst($order->status) }}
@endcomponent

We’ll notify you once it’s completed.

Thanks,
**Saira Teknik**
@endcomponent
