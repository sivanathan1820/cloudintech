<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Products</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <style type="text/css">
      	
      </style>
   </head>
   <body>
      <nav class="navbar navbar-default">
         <div class="container-fluid">
            <div class="navbar-header">
               <a class="navbar-brand" href="javascript:void(0)">Cloudin E-Comm</a>
            </div>
            <ul class="nav navbar-nav">
               <li><a href="{{url('customer-dashboard')}}">Products</a></li>
               <li class="active"><a href="{{url('my-orders')}}">View My Orders</a></li>
               <li><a href="javascript:void(0)" onclick="logout()">Logout</a></li>
            </ul>
         </div>
      </nav>
      <div class="container">
         <div class="card">
            <div class="card-body">
               <div class="row">
               	<div class="col-lg-12" align="center">
               		<h3>Product Card Details</h3>
               		<br>
               	</div>
                  <div class="col-lg-3"></div>
                  <div class="col-lg-6">
                  	<table class="table table-bordered" width="100%">
                  		<thead>
                  			<tr>
	                  			<th width="70%">Product</th>
	                  			<th width="30%" style="text-align: center;">Price</th>
	                  		</tr>
                  		</thead>
                  		<tbody id="product-list">
                  			
                  		</tbody>
                  		<tfoot id="product-foot">
                        </tfoot>
                  	</table>
                  </div>
                  <div class="col-lg-3"></div>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript">
      	$(document).ready(function(){
      		getcardlist();
      	});

      	function getcardlist()
      	{
      		var search = $("#search").val();
      		$.ajax({
		         type: "POST",
		         url: "{{route('get-card-list')}}",
		         headers: {
		         "Authorization": "Bearer {{Session::get('SGtoken')}}"
		         },
		         data: {'_token' : '{{csrf_token()}}','search' : search},
		         dataType: 'json',
		         success: function (msg) 
		         {
		            var data    = msg.data;
		            var card   = '';
		            sno = 1;
		            for (var i = 0; i < data.length; i++) 
		            {
		               card       += '<tr><td width="70%">'+data[i]['product']+'</td><td width="30%" align="center">₹ '+data[i]['price']+'</td></tr>';
		            }
		            if(data.length>0)
		            {
		            	$("#product-foot").html('<tr><td width="100%" colspan="2" align="center"><a href="{{url("payment")}}" class="btn btn-success">Place order and Pay</a></td></tr>');
		            }
		            else
		            {
		            	card = '<tr><td width="100%" colspan="2" align="center">No Products Available</td></tr>';
		            }
		            $("#product-list").html(card);
		         },
		         error: function (msg) 
		         {
		            
		         }
		    });
      	}

      	function logout()
         {
            $.ajax({
               type: "POST",
               url: "{{route('logout')}}",
               headers: {
               "Authorization": "Bearer {{Session::get('SGtoken')}}"
               },
               data: {'_token' : '{{csrf_token()}}'},
               dataType: 'json',
               success: function (msg) 
               {
                  window.location.href = "{{url('/')}}";
               },
               error: function (msg) 
               {

               }
            });
         }
      </script>
   </body>
</html>