<!DOCTYPE html>
<html lang="en">
<head>
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
      <link rel="icon" type="image/png" href="./assets/img/favicon.png">
      <title>
        Villa Crisol
      </title>

      <!-- Icons -->
      <link href="fontawesome-free/css/all.min.css" rel="stylesheet">
      <link href= "assets/fontawesome/css/fontawesome.css" rel="stylesheet">
      <link href={{ asset("css/nucleo-icons.css") }} rel="stylesheet" type="text/css">
      <link href={{ asset("css/nucleo-svg.css") }} rel="stylesheet" />
      <link href={{ asset("css/main.css") }} rel="stylesheet" />
      <!-- CSS Files -->
      <link id="pagestyle" href="{{ asset("css/argon-dashboard.css") }}" rel="stylesheet" />
      <link href={{ asset("css/font-awesome.css") }} rel="stylesheet" type="text/css">
      <link href={{ asset("css/app.css") }} rel="stylesheet" type="text/css">

      <script src="{{ asset("js/sweetalert2.all.min.js") }}"></script> 
      <style>
        body{
          Overflow-x: hidden;
        }
      </style>
  </head>
</head>

<body class="bg-danger">
 <main class="main-content position-relative border-radius-lg">
    <div>              
      @yield('contend')
    </div>
  </main>
     
    <!-- Jquery JS-->
    <script src="/assets/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="/assets/select2/select2.min.js"></script>
    <script src="/assets/datepicker/moment.min.js"></script>
    <script src="/assets/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="/js/global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src={{ asset("js/scripts.js") }}></script>
        <script src={{ asset("js/app.js") }}></script>
        <script src="/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>
</html>