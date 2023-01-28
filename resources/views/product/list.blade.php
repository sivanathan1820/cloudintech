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
         <li class="breadcrumb-item active"><a href="javascript:void(0)">Product List</a></li>
         <li class="breadcrumb-item active"><a href="{{url('form-product/0')}}">Add Product</a></li>
      </ol> 
   </nav>
</div>
<div class="card">
   <div class="row" style="padding: 1rem;">
      <table class="table table-bordered">
         <thead>
            <tr>
               <th>S.No</th>
               <th>Product Name</th>
               <th>Price</th>
               <th>Description</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody id="tbody"></tbody>
      </table>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
   $(document).ready(function(){
      getProductList();
   });
   function getProductList()
   {
      $.ajax({
         type: "POST",
         url: "{{route('list-product')}}",
         headers: {
         "Authorization": "Bearer {{Session::get('SGtoken')}}"
         },
         data: {'_token' : '{{csrf_token()}}'},
         dataType: 'json',
         success: function (msg) 
         {
            var data    = msg.data;
            var tbody   = '';
            sno = 1;
            for (var i = 0; i < data.length; i++) 
            {
               tbody       += '<tr>';
               tbody       += '<td width="5%">'+sno+'</td>';
               tbody       += '<td width="30%">'+data[i]['product']+'</td>';
               tbody       += '<td width="10%">'+data[i]['price']+'</td>';
               tbody       += '<td width="35%">'+data[i]['description']+'</td>';
               tbody       += '<td width="20%"><a href="{{url("/form-product")}}/'+data[i]['ref']+'" class="btn btn-primary">Edit</a> <a href="javascript:void(0)" class="btn btn-danger" onclick="deletedata(\''+data[i]['ref']+'\')">Delete</a> </td>';
               tbody       += '</tr>';
               sno++;
            }
            $("#tbody").html(tbody);
         },
         error: function (msg) 
         {

         }
      });
   }

   function deletedata(id)
   {
      $.ajax({
         type: "POST",
         url: "{{route('delete-product')}}",
         headers: {
         "Authorization": "Bearer {{Session::get('SGtoken')}}"
         },
         data: {'_token' : '{{csrf_token()}}','id' : id},
         dataType: 'json',
         success: function (msg) 
         {
            getProductList();
         },
         error: function (msg) 
         {
            
         }
      });
   }
</script>
@endpush