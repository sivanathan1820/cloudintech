@extends('layout.header')
@section('content')
<style type="text/css">
   .card
   {
      padding: 10px !important;
   }
   label 
   {
      margin-bottom: 5px !important;
   }
   .hide
   {
      display: none;
   }
   .error-text
   {
      font-size: 11px;
      margin-top: 4px;
      color: red;
   }
   .form-control
   {
      border-radius: 0px !important;
   }
</style>
<div class="pagetitle">
   <h1>Products</h1>
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item active"><a href="javascript:void(0)">Save Product</a></li>
         <li class="breadcrumb-item active"><a href="{{url('products')}}">Product List</a></li>
      </ol> 
   </nav>
</div>
<div class="card">
   <form id="product_form" novalidate>
      <div class="row">
         <div class="col-xxl-4 col-md-4">
            <div class="form-group">
               <label>Product Name</label>
               <input type="text" name="product" id="product" class="form-control" value="">
            </div>
            <p class="error-text hide" id="error-product">Enter Valid Product Name</p>
         </div>
         <div class="col-xxl-2 col-md-2">
            <div class="form-group">
               <label>Price</label>
               <input type="number" name="price" id="price" class="form-control" value="">
            </div>
            <p class="error-text hide" id="error-price">Enter Valid Price</p>
         </div>
         <div class="col-xxl-4 col-md-4">
            <div class="form-group">
               <label>Description</label>
               <textarea class="form-control" name="description" id="description"></textarea>
            </div>
            <p class="error-text hide" id="error-description">Enter Valid Description</p>
         </div>
         <div class="col-xxl-2 col-md-2">
            <br>
            <a href="javascript:void(0)" class="btn btn-success" id="action-btn" onclick="save_form()">Save</a>
         </div>
      </div>
   </form>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
   $(document).ready(function(){
      getProduct();
   });

   function save_form()
   {
      var product       = $("#product").val();
      var price         = $("#price").val();
      var description   = $("#description").val();

      $("#error-product").hide();
      $("#error-price").hide();
      $("#error-description").hide();

      if(product !="" && price !="" && description !="")
      {
         $.ajax({
            type: "POST",
            url: "{{route('save-product')}}",
            headers: {
            "Authorization": "Bearer {{Session::get('SGtoken')}}"
            },
            data: {'_token' : '{{csrf_token()}}','id' : '{{request()->ref}}','product' : product,'price' : price,'description' : description},
            dataType: 'json',
            success: function (msg) 
            {
               if(msg.code==1 || msg.code==2)
               {
                  alert(msg.message);
                  window.location.href = "{{url('/products')}}";
               }
               else
               {
                  alert(msg.message);
               }
            },
            error: function (msg) 
            {
               alert(msg.message);
            }
         });
      }
      else
      {
         if(product=="") $("#error-product").show();
         if(price=="") $("#error-price").show();
         if(description=="") $("#error-description").show();
      }
   }

   function getProduct()
   {
      $.ajax({
         type: "POST",
         url: "{{route('get-product')}}",
         headers: {
         "Authorization": "Bearer {{Session::get('SGtoken')}}"
         },
         data: {'_token' : '{{csrf_token()}}','id' : '{{request()->ref}}'},
         dataType: 'json',
         success: function (msg) 
         {
            if(msg.data.length>0)
            {
               $("#product").val(msg.data[0].product);
               $("#price").val(msg.data[0].price);
               $("#description").val(msg.data[0].description);
            }
         },
         error: function (msg) 
         {
            
         }
      });
   }
</script>
@endpush