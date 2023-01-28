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
   <h1>Order</h1>
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item active"><a href="javascript:void(0)">Order List</a></li>
      </ol> 
   </nav>
</div>
<div class="card">
   <div class="row" style="padding: 1rem;">
      <table class="table table-bordered">
         <thead>
            <tr>
               <th>S.No</th>
               <th>Customer Name</th>
               <th>Email</th>
               <th>Amount</th>
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
      getOrderList();
   });
   function getOrderList()
   {
      $.ajax({
         type: "POST",
         url: "{{route('list-orders')}}",
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
               tbody       += '<td width="30%">'+data[i]['name']+'</td>';
               tbody       += '<td width="10%">'+data[i]['email']+'</td>';
               tbody       += '<td width="10%">'+data[i]['price']+'</td>';
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

</script>
@endpush