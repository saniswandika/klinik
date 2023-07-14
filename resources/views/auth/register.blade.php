
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
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="/home">
              <img src="{{ asset('/assets/img/logo-klinik-kimia_farma-removebg-preview.png') }}" alt="main_logo" height="50px" class="navbar-brand">
                klinik harapan bunda
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav ms-auto">
                {{-- <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/dashboard.html">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/profile.html">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Profile
                  </a>
                </li> --}}
                <li class="nav-item">
                  <a class="nav-link me-2" href="/register">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                        Register 
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="/login">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                        Login
                  </a>
                </li>
              </ul>
              
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="mask d-flex align-items-start h-150 gradient-custom-3">
              <div class="container h-150">
                <div class="row d-flex justify-content-start align-items-center">
                  <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                      <div class="card-body p-5">
                        <h2 class="text-uppercase text-center">Create an account</h2>
          
                        {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif                    
                          <div class="form-outline mb-2">
                            <label class="form-label" for="form3Example1cg">Name</label>
                            <input type="text" id="form3Example1cg" class="form-control form-control-lg" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                          </div>
          
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                          <div class="form-outline mb-2">
                            <label class="form-label" for="form3Example3cg">Email</label>
                            <input type="email" id="form3Example3cg" class="form-control form-control-lg" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"/>
                          </div>
                          <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3cg">Alamat</label>
                            <input type="text" id="form3Example3cg" class="form-control form-control-lg" @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat"/>
                          </div>
                          <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3cg">No Telepon</label>
                            <input type="number" id="form3Example3cg" class="form-control form-control-lg" @error('no_telepon') is-invalid @enderror" name="no_telepon" value="{{ old('no_telepon') }}" required autocomplete="no_telepon"/>
                          </div>
                          <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3cg">Jenis Kelamin</label>
                            <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                              {{-- @foreach ($roles as $role ) --}}
                                <option value="pilih jenis kelamin ...">pilih jenis kelamin ...</option>
                                <option value="laki-laki">laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                              {{-- @endforeach --}}
                          </select> 
                            {{-- <input type="jenis_kelamin" id="form3Example3cg" class="form-control form-control-lg" @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" required autocomplete="jenis_kelamin"/> --}}
                          </div>
          
                          <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4cg">Password</label>
                            <input type="password" id="form3Example4cg" class="form-control form-control-lg" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
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
                          </div>
                            
                          <div class="d-flex justify-content-center">
                            <button type="submit"
                              class="btn btn-primary btn-block btn-lg">Register</button>
                          </div>
                        {!! Form::close() !!}
          
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-dark h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://softwareklinik.net/wp-content/uploads/2019/02/image-2.png');
                background-size: cover;">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative"></h4>
                {{-- <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
