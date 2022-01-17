@component('mail::message')
# NINETYNINE INVOICE #{{$order->id}}

@component('mail::panel')
Your Total Price is Rp. {{number_format($order->total_price)}} <br>
And Your Under Payment Is Rp. {{number_format($order->total_money)}}
@endcomponent

@component('mail::table')
| Product | Qty | Total Price |
| ------------- |:-------------:| --------:|
@foreach ($order->order_details as $order_detail)
| {{$order_detail->product_name}} | {{$order_detail->qty}} | Rp. {{number_format($order_detail->total_price)}} |
@endforeach

@component('mail::subcopy')
Your Payment History : <br>
@foreach ($order->order_payments as $order_payment)
<i> {{$order_payment->created_at}} </i> , Rp. {{number_format($order_payment->nominal)}} <br>
@endforeach
@endcomponent

@endcomponent

Thanks,<br>
NINETYNINE KONVEKSI
@endcomponent