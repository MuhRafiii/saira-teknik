@component('mail::message')
# Order Completed ✅

Hi **{{ $order->name }}**,  
Your order (ID: **{{ $order->id }}**) has been successfully completed.

@component('mail::panel')
**Completion Date:** {{ $order->completion_date->format('d M Y H:i') }}  
**Total:** Rp {{ number_format($order->total, 0, ',', '.') }}
@endcomponent

Thank you for shopping with us!
We hope to see you again soon.

Thanks,
**Saira Teknik**
@endcomponent
