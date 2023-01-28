<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Pay</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <button id="rzp-button1" style="display: none;">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_test_1xufIWYYSKB4jD",
    "amount": "{{$data['amount']}}",
    "currency": "{{$data['currency']}}",
    "name": "Sivanathan T",
    "description": "Razorpay",
    "order_id": "{{$data['id']}}",
    "callback_url": "{{url('/paymentresponse')}}",
    "prefill": {
        "name": "Tamil",
        "email": "tamil@example.com",
        "contact": "9999999999"
    },
    "handler": function (response){
    // alert(response.razorpay_payment_id);
    // alert(response.razorpay_order_id);
    // alert(response.razorpay_signature);
     $.ajax({
               type: "POST",
               url: "{{route('paymentresponse')}}",
               headers: {
               "Authorization": "Bearer {{Session::get('SGtoken')}}"
               },
               data: {'_token' : '{{csrf_token()}}','paymentid' : response.razorpay_payment_id,'order_id' : response.razorpay_order_id,'sign' : response.razorpay_signature,'amount' : '{{$data["amount"]}}'},
               dataType: 'json',
               success: function (msg) 
               {
                  window.location.href = "{{url('/my-orders')}}";
               },
            });
   },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
$(document).ready(function(){
   rzp1.open();
    e.preventDefault();
});
</script>
   </body>
</html>