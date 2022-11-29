<x-mail::message>
<h1 style="text-align: center;">

# Order Shipped

Your order has been shipped!
> hello
* one
* two

Thanks,
</h1>
{{ $employee->name }}
{{ url('/qr-code/' . $employee->qr_code) }}
<img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate('Make me into an QrCode!')) !!} ">

</x-mail::message>
