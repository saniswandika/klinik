
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Dinas Sosial kota Bandung
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
  {{-- <div class="container position-sticky z-index-sticky top-0"> --}}
    {{-- <div class="row"> --}}
      {{-- <div class="col-12"> --}}
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
          <div class="container">
            {{-- <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
              Argon Dashboard 2
            </a> --}}
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                {{-- <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/dashboard.html">
                    <i class="fa fa-chart-pie opacity-6  me-1"></i>
                    Dashboard
                  </a>
                </li> --}}
                {{-- <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/profile.html">
                    <i class="fa fa-user opacity-6  me-1"></i>
                    Profile
                  </a>
                </li> --}}
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-up.html">
                    <i class="fas fa-user-circle opacity-6  me-1"></i>
                    Sign Up
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-in.html">
                    <i class="fas fa-key opacity-6  me-1"></i>
                    Sign In
                  </a>
                </li>
              </ul>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  {{-- <a href="https://www.creative-tim.com/product/argon-dashboard" class="btn btn-sm mb-0 me-1 bg-gradient-light">Free Download</a> --}}
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      {{-- </div> --}}
    {{-- </div> --}}
  {{-- </div> --}}
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Selamat Datang !</h1>
            <p class="text-lead text-white">Daftarkan Akun Anda Mempermudah Untuk Konsultasi Gizi Balita Anda</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-12 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
           
            <div class="card-body">
              {!! Form::open(array('route' => 'DaftarAkun','method'=>'POST')) !!}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                <div class="card-header text-center pt-4">
                  <h5>Data Bayi</h5>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="Nama_Anak">Nama Anak</label>
                      <input type="text" id="Nama_Anak" class="form-control" name="Nama_Anak"/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">Tanggal Lahir</label>
                        <input type="date" id="form6Example1" class="form-control" name="Tgl_Lahir"/>
                      </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="form6Example1">Umur Bulan</label>
                      <input type="Bumber" id="form6Example1" class="form-control" name="Umur_bulan"/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">Umur Tahun</label>
                        <input type="Number" id="form6Example1" class="form-control" name="Umur_Tahun"/>
                      </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">Jenis Kelamin</label>
                          <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                            {{-- @foreach ($roles as $role ) --}}
                              <option selected>Pilih Jenis Kelamin</option>
                              <option value="L">Laki-Laki</option>
                              <option value="p">Perempuan</option>
                              {{-- <option value="Darah Tinggi">Darah Tinggi</option> --}}
                            {{-- @endforeach --}}
                        </select> 
                        {{-- <input type="Number" id="form6Example1" class="form-control" name="jenis_kelamin"/> --}}
                      </div>
                      
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">Nik Balita / Nomer Kartu Keluarga</label>
                        <input type="Number" id="form6Example1" class="form-control" name="Nik_bayi"/>

                        {{-- <input type="Number" id="form6Example1" class="form-control" name="jenis_kelamin"/> --}}
                      </div>
                      
                  </div>
                </div>
                
                <div class="card-header text-center pt-4">
                  <h5>Data Orang Tua</h5>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="form6Example1">Nama Orang Tua</label>
                      <input type="text" id="form6Example1" class="form-control" name="Nama_Ortu"/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">Nik Orang Tua</label>
                        <input type="Number" id="form6Example1" class="form-control" name="Nik_Ortu"/>
                      </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="form6Example1">Nomer Telepon Orang Tua</label>
                      <input type="number" id="form6Example1" class="form-control" name="No_hp_Ortu"/>
                    </div>
                  </div>
                </div>

                <div class="card-header text-center pt-4">
                  <h5>Alamat</h5>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="Pkm">Pkm</label>
                      <input type="text" id="Pkm" class="form-control" value="{{ $klinik->PKM }}" name="Pkm"/>
                    </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="Alamat">Alamat</label>
                      <input type="text" id="Alamat" class="form-control" value="{{ $klinik->Alamat }}" name="Alamat"/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="Posyandu">Posyandu</label>
                        <input type="text" id="Posyandu" value="{{ $klinik->nama_posyandu }}" class="form-control" name="Posyandu"/>
                      </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="Kelurahan">Kelurahan</label>
                      <input type="text" id="Kelurahan" value="{{ $klinik->Kelurahan }}" class="form-control" name="Kelurahan"/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="RW">RW</label>
                        <input type="text" id="RW" value="{{ $klinik->RW }}" class="form-control" name="Rw"/>
                      </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">Rt</label>
                        <input type="text" id="form6Example1" class="form-control" name="Rt"/>
                      </div>
                  </div>
                </div>
                <div class="card-header text-center pt-4">
                  <h5>Daftar Akun</h5>
                </div>
                {{-- <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Name" aria-label="Name">
                </div> --}}
                {{-- <div class="mb-3">
                  <label class="form-label" for="form6Example1">Email</label>
                  <input type="email" class="form-control" placeholder="Email" aria-label="Email">
                </div> --}}
                <div class="form-outline mb-2">
                  <label class="form-label" for="form3Example3cg">Email</label>
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email"/>
                </div>
                <div class="form-outline mb-2">
                  <label class="form-label" for="form3Example4cg">Password</label>
                  <input type="password" id="form3Example4cg" class="form-control form-control-lg" @error('password') is-invalid @enderror name="password" required autocomplete="new-password" />
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                  <input type="password" id="form3Example4cdg" class="form-control form-control-lg" name="confirm-password" required autocomplete="new-password"/>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Daftar Sebagai Pasien</label>
                  <select class="form-select" aria-label="Default select example" name="roles">
                      {{-- <option value="pilih daftar Sebagai ...">pilih daftar Sebagai ...</option> --}}
                    @foreach ($roles as $role )
                      <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                </div>
               
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="/login" class="text-dark font-weight-bolder">Sign in</a></p>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  @include('sweetalert::alert');
</body>

</html>
