<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Dashboard</title>
      <meta content="" name="description">
      <meta content="" name="keywords">
      <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
      <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
      <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
      <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
      <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
      <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
   </head>
   <body>
      <header id="header" class="header fixed-top d-flex align-items-center">
         <div class="d-flex align-items-center justify-content-between">
            <a href="{{url('/dashboard')}}" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Cloudin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
         </div>
         <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
               <li class="nav-item dropdown pe-3">
                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                  <img src="{{asset('assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
                  <span class="d-none d-md-block dropdown-toggle ps-2">{{Session::get('logedname')}}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                     <li>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)" onclick="logout()">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                        </a>
                     </li>
                  </ul>
               </li>
            </ul>
         </nav>
      </header>
      <aside id="sidebar" class="sidebar">
         <ul class="sidebar-nav" id="sidebar-nav">
            <!-- <li class="nav-item">
               <a class="nav-link " href="{{url('/dashboard')}}">
               <i class="bi bi-grid"></i>
               <span>Dashboard</span>
               </a>
            </li> -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="{{url('/products')}}">
               <i class="bi bi-menu-button-wide"></i>
               <span>Products</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link collapsed" href="{{url('/orders')}}">
               <i class="bi bi-journal-text"></i>
               <span>Orders</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link collapsed" href="{{url('/customers')}}">
               <i class="bi bi-person"></i>
               <span>Customers</span>
               </a>
            </li>
         </ul>
      </aside>
      <main id="main" class="main">
         @yield('content')
      </main>
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
      <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
      <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
      <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
      <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
      <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
      <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
      <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
      <script src="{{asset('assets/js/main.js')}}"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      @stack('scripts')
      <script type="text/javascript">
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