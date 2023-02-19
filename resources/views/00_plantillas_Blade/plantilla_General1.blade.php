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
      <link href={{ asset("css/nucleo-icons.css") }} rel="stylesheet" type="text/css">
      <link href={{ asset("css/nucleo-svg.css") }} rel="stylesheet" />
      <link href={{ asset("css/main.css") }} rel="stylesheet" />
      <!-- CSS Files -->
      <link id="pagestyle" href="{{ asset("css/argon-dashboard.css") }}" rel="stylesheet" />
      <link href={{ asset("css/font-awesome.css") }} rel="stylesheet" type="text/css">
      <link href={{ asset("css/app.css") }} rel="stylesheet" type="text/css">
      </head>
<style>
  body{
    Overflow-x: hidden;
     
  }
</style>
</head>
<main class="main-content border-radius-lg">
<body >
  <div class="bg-danger">
    @yield('contend')
  </main>
  </div>   
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src={{ asset("js/scripts.js") }}></script>
        <script src={{ asset("js/app.js") }}></script>
</body>
</html>