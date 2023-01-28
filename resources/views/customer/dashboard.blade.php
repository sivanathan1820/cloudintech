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
      	body{
      		background: bisque;
      	}
		.thumb-wrapper {
		background: #fcfcfc;
		padding: 4rem;
		box-shadow: 0px 0px 4px 1px rgb(0 0 0 / 15%);
		}
      </style>
   </head>
   <body>
      <nav class="navbar navbar-default">
         <div class="container-fluid">
            <div class="navbar-header">
               <a class="navbar-brand" href="javascript:void(0)">Cloudin E-Comm</a>
            </div>
            <ul class="nav navbar-nav">
               <li class="active"><a href="{{url('customer-dashboard')}}">Products</a></li>
               <li><a href="{{url('my-orders')}}">View My Orders</a></li>
               <li><a href="javascript:void(0)" onclick="logout()">Logout</a></li>
            </ul>
         </div>
      </nav>
      <div class="container">
         <div class="card">
            <div class="card-body">
            	<div class="row">
            		<div class="col-md-10" align="center">
            			<input type="text" name="search" id="search" class="form-control" value="" placeholder="Search Products">
            		</div>
            		<div class="col-md-2" align="center">
            			<a href="javascript:void(0)" class="btn btn-success" onclick="getproductlist();">Search</a>
            		</div>
            	</div>
               <div class="row" id="product-list">
                  
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript">
      	$(document).ready(function(){
      		getproductlist();
      	});

      	function getproductlist()
      	{
      		var search = $("#search").val();
      		$.ajax({
		         type: "POST",
		         url: "{{route('get-product-list')}}",
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
		               card       += '<div class="col-sm-3" style="margin-top: 15px;"><div class="thumb-wrapper"><span class="wish-icon"><i class="fa fa-heart-o"></i></span><div class="thumb-content"><h4>'+data[i]["product"]+'</h4><div class="star-rating"><ul class="list-inline"><li class="list-inline-item"><i class="fa fa-star"></i></li><li class="list-inline-item"><i class="fa fa-star"></i></li><li class="list-inline-item"><i class="fa fa-star"></i></li><li class="list-inline-item"><i class="fa fa-star"></i></li><p>'+data[i]["description"]+'</p></ul></div><p class="item-price"><b>₹ '+data[i]["price"]+'</b></p><a href="#" class="btn btn-primary" id="btn_'+sno+'" onclick="add_product(\''+data[i]["ref"]+'\',\''+data[i]["ref1"]+'\')">Add to Cart</a></div></div></div>';
		            }
		            $("#product-list").html(card);
		         },
		         error: function (msg) 
		         {
		            
		         }
		    });
      	}

      	function add_product(ref1,ref2)
      	{
      		$.ajax({
		         type: "POST",
		         url: "{{route('add-product')}}",
		         headers: {
		         "Authorization": "Bearer {{Session::get('SGtoken')}}"
		         },
		         data: {'_token' : '{{csrf_token()}}','ref' : ref1,'price' : ref2},
		         dataType: 'json',
		         success: function (msg) 
		         {
		            alert(msg.message);
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