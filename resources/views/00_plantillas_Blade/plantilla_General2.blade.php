<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="./assets/img/favicon.png">
        <title>Villa Crisol - @yield('title') </title>

        <!-- Icons -->
        <link href={{ asset('css/nucleo-icons.css') }} rel="stylesheet" type="text/css">
        <link href={{ asset('css/nucleo-svg.css') }} rel="stylesheet" />

        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href={{ asset('css/menuStyles/menuStyles.css') }} type="text/css">

        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
      </head>
      
      <body class=" g-sidenav-show bg-gray-100">
        <div  style="background:#F5F5DC;padding: 5px 5px 5px 0.5em;

border: solid 4px;
border-radius: 15px;
background: linear-gradient(90deg, rgba(255,0,0,0.5) 0%, rgba(255,99,80,0.5) 100%);
color: #fff; 
text-decoration: none; 

width: 100%;
height: 100%;
">              

      
      <aside
      class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-2 "
      id="sidenav-main">
      <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href={{ route('menuAdmon.index') }}>
            <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">INICIO</span>
          </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href={{ route('menuAdmon.index') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Restaurante</span>
                      </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href={{ route('registro') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                          </div>
                          <span class="nav-link-text ms-1">Registro plantilla</span>
                        </a>
                      </li>
                <li class="nav-item">
                  <a class="nav-link " href={{ route('pedidosp.pedido') }}>
                    <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pedidos Cocina</span>
                      </a>
                    </li>
                    <li class="nav-item">
                  <a class="nav-link " href={{ route('pedidost.pedido') }}>
                    <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pedidos Caja</span>
                    </a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link " href={{ route('b') }}>
                    <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                  </div>
                  <span class="nav-link-text ms-1">Billing</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="#">
                  <div
                  class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-app text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Virtual Reality</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('r') }}>
                      <div
                      class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                    </div>
                        <span class="nav-link-text ms-1">RTL</span>
                      </a>
                    </li>
                <li class="nav-item mt-1">
                  <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href={{ route('p') }}>
                    <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                  </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('s') }}>
                      <div
                      class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                          </div>
                          <span class="nav-link-text ms-1">Sign In</span>
                        </a>
                      </li>
                      <li class="nav-item">
                  <a class="nav-link " href="./pages/sign-up.html">
                    <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-collection text-info text-sm opacity-10"></i>
                  </div>
                  <span class="nav-link-text ms-1">Sign Up</span>
                </a>
              </li>
            </ul>
          </aside>
        <main class="main-content position-relative border-radius-lg">
        @yield('contend')
      </main>
    </div>
  
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