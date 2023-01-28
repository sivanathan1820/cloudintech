<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Login</title>
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
      <style type="text/css">
         .error-text
         {
            color: red;
            font-size: 12px;
            text-align: center;
         }
      </style>
   </head>
   <body>
      <main>
         <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
               <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">
                           <div class="card-body">
                              <div class="pt-4 pb-2">
                                 <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                              </div>
                              <form class="row g-3" novalidate>
                                 <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                 </div>
                                 <div class="col-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                 </div>
                                 <div class="col-12">
                                    <button class="btn btn-success w-100" type="button" onclick="login()">Admin Login</button>
                                 </div>
                                 <div class="col-12">
                                    <a class="btn btn-danger w-100" href="{{url('/googlelogin')}}">Customer Login with Google</a>
                                 </div>
                                 <div class="col-12">
                                    <p class="error-text" id="response"></p>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </main>
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
      <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
      <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
      <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
      <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
      <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
      <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
      <script src="{{asset('assets/js/main.js')}}"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script type="text/javascript">
        function login()
        {
          var email     = $("#email").val();
          var password  = $("#password").val();

            $.ajax({
              type: "POST",
              url: "{{route('login')}}",
              data: {
              "email": email,
              "password": password,
              },
              dataType: 'json',
              success: function (msg) {
               location.reload();
              },
              error: function (msg) {
               $("#response").text(msg.responseJSON.message);
              }
            });
        }

      </script>
   </body>
</html>