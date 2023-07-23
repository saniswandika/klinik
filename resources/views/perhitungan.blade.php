
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('/assets/img/favicon.png') }}">
  <title>
    klinik 
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('/assets/css/nucleo-icons.css') }}" rel="stylesheet"  rel="stylesheet" />
  <link href="{{asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
 
  <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>
<body class="g-sidenav-show bg-gray-100">
    {{-- sidebar --}}
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main" style="z-index: 1">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0 m-1 d-flex justify-content-center py-3" href="/home">
        {{-- <img src="{{ asset('/assets/img/logo.png') }}" alt="main_logo" height="55px"> --}}
        <img src="{{ asset('/assets/img/logo-klinik-kimia_farma-removebg-preview.png') }}" class="navbar-brand-img" alt="">
        {{-- <span class="ms-1 font-weight-bold">Argon Dashboard 2</span> --}}
      </a>
    </div>
    <hr class="horizontal dark mt-3">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="/home">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            {{-- @can('pengaduan-create') --}}
            <span class="nav-link-text ms-1">Dashboard</span>
            {{-- @endcan --}}
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">menu klinik</h6>
        </li>
        <hr class="horizontal dark mt-0">
        {{-- <li class="nav-item">
          <a class="nav-link " href="#collapseExample2" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1 text-wrap">Pengaduan</span>
          </a>
        </li>
        <div class="collapse {{ request()->is('pengaduans') || request()->is('pengaduans/dashboard') ? 'show' : '' }} sm-2" id="collapseExample2">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('pengaduans/dashboard') ? 'active' : '' }}" href="/pengaduans/dashboard">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-4 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text text-wrap">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('pengaduans') ? 'active' : '' }}" href="/pengaduans">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-4 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text text-wrap">Layanan</span>
            </a>
          </li>
        </div> --}}
        @can('klinik-list')
        <li class="nav-item">
          <a class="nav-link " href="{{ route('obat.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">List Obat</span>
          </a>
        </li>
        @endcan
        @can('pendaftaranPasien-list')
        <li class="nav-item">
          <a class="nav-link " href="{{ route('pendaftaran_pasien.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pendaftaran Pasien</span>
          </a>
        </li>
        @endcan
        @can('tindakanMedis-list')
        <li class="nav-item">
          <a class="nav-link " href="{{ route('tindakan_medis.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tindakan Medis</span>
          </a>
        </li>
        @endcan
        @can('pembayaran-list')
        <li class="nav-item">
          <a class="nav-link " href="{{ route('pembayaran.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pembayaran</span>
          </a>
        </li>
        @endcan
        @can('vitalSign-list')
        <li class="nav-item">
          <a class="nav-link " href="{{ route('vital_sign.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Vital Sign</span>
          </a>
        </li>
        @endcan
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-wrap">Pengaturan Akun dan Hak Akses</h6>
        </li>
        <hr class="horizontal dark mt-0">
        @can('role-list')
        <li class="nav-item">
          <a class="nav-link {{ request()->is('roles') ? 'active' : '' }}" href="/roles">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Management Role User</span>
          </a>
        </li>
        @endcan
        @can('users-list')
        <li class="nav-item">
          <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="/users">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">management akun</span>
          </a>
        </li>
        @endcan
  
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">@yield('title')</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">@yield('title')</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item dropdown px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="avatar avatar-sm  me-1">
                {{-- <i class="fa fa-user me-sm-1"></i> --}}
                {{-- <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span> --}}
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="profile">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">Profile Account</span>
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-user me-1"></i>
                          {{-- {{ Auth::user()->name }} --}}
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="https://img.icons8.com/color/48/null/exit.png" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-sm font-weight-normal mb-1">
                          Logout
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="card">
          <div class="card-body">
              <h4>Node 1</h4>
              <div class="table-responsive-sm">                
                  <table class="table" style="width:100%;">
                        <tr>
                          {{-- <th>Name</th>
                          <th>Name</th> --}}
                          <th scope="col">No.</th>
                          <th scope="col">Atribut</th>
                          <th scope="col">Nilai Atribut</th>
                          <th scope="col">Jumlah Kasus Total</th>
                          <th scope="col">Jumlah Kasus Gizi Normal</th>
                          <th scope="col">Jumlah Kasus Gizi Buruk</th>
                          <th scope="col">Entropy</th>
                          <th scope="col">Gain</th>
                        </tr>
                        @foreach ($nodes as $node)
                        <tr>
                        <td> {{ 0 }}</td>
                          <th rowspan="{{ count($node['data']) }}">{{ $node['attribute'] }}</th>
                          <td> {{ $node['data'][0]['nilai_attribute'] }} </td>
                          <td> {{ $node['data'][0]['jumlah_kasus_total'] }} </td>
                          <td> {{ $node['data'][0]['jumlah_kasus_gizi_normal'] }} </td>
                          <td> {{ $node['data'][0]['jumlah_kasus_gizi_buruk'] }} </td>
                          <td>{{ $node['data'][0]['entrophy'] }}</td>
                           <td rowspan="{{ count($node['data']) }}">{{ $node['gain'] }}</td>
                        </tr>
                        @for ($i = 1; $i < count($node['data']); $i++)                            
                        <tr>
                           {{-- <td>Berat Badan</td> --}}
                           <td></td>
                           <td>{{ $node['data'][$i]['nilai_attribute'] }}</td>
                           <td> {{ $node['data'][$i]['jumlah_kasus_total'] }} </td>
                           <td> {{ $node['data'][$i]['jumlah_kasus_gizi_normal'] }} </td>
                           <td> {{ $node['data'][$i]['jumlah_kasus_gizi_buruk'] }} </td>
                          <td>{{ $node['data'][$i]['entrophy'] }}</td>
                        </tr>
                        @endfor   
                        @endforeach
                     <tr>
                        <td colspan="8" style="display: flex; justify-content: end; width: 100%; position: absolute">Total Gain Tertinggi : {{ $gainTertinggi }}</td>
                     </tr>
                  </table>
                  
              </div>
          </div>
      </div>
  </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet"></script>
    @include('sweetalert::alert');
</body>

</html>