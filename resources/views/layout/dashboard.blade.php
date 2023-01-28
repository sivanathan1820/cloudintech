@extends('layout.header')
@section('content')
<div class="pagetitle">
   <h1>Dashboard</h1>
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
         <li class="breadcrumb-item active">Dashboard</li>
      </ol> 
   </nav>
</div>
<section class="section dashboard">
   <div class="row">
      <div class="col-lg-12">
         <div class="row">
            <div class="col-xxl-4 col-md-4">
               <div class="card info-card sales-card">
                  <div class="card-body">
                     <h5 class="card-title">Orders <span>| Today</span></h5>
                     <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                           <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                           <h6>145</h6>
                           <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-md-4">
               <div class="card info-card revenue-card">
                  <div class="card-body">
                     <h5 class="card-title">Products</h5>
                     <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                           <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                           <h6>$3,264</h6>
                           <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-md-4">
               <div class="card info-card customers-card">
                  <div class="card-body">
                     <h5 class="card-title">Customers <span>| This Year</span></h5>
                     <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                           <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                           <h6>1244</h6>
                           <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12">
            <div class="card recent-sales overflow-auto">
               <div class="card-body">
                  <h5 class="card-title">Recent Sales <span>| Today</span></h5>
                  <table class="table table-borderless datatable">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Customer</th>
                           <th scope="col">Product</th>
                           <th scope="col">Price</th>
                           <th scope="col">Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th scope="row"><a href="#">#2457</a></th>
                           <td>Brandon Jacob</td>
                           <td><a href="#" class="text-primary">At praesentium minu</a></td>
                           <td>$64</td>
                           <td><span class="badge bg-success">Approved</span></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@push('scripts')
@endpush