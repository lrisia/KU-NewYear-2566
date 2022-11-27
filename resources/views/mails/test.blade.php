<x-mail::message>
# Order Shipped

Your order has been shipped!
> hello
* one
* two

Thanks,
{{ $employee->name }}
<img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate('Make me into an QrCode!')) !!} ">

</x-mail::message>
