<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="{{ asset('img/archive.png') }}">
    <title>Login-Sistem Informasi Arsip Surat</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary d-flex justify-content-center align-items-center" style="height: 100vh;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                            </div>

                            <!-- Form login -->
                            <form method="POST" action="{{ url('/prosesLogin') }}" class="user">
                                @csrf

                                <!-- Alert dari error autentikasi-->
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="inputEmail"
                                        name="email" aria-describedby="emailHelp" placeholder="Masukkan email aktif" autofocus>
                                    <!-- Alert error dari validasi -->
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password"
                                        id="inputPassword" placeholder="Masukkan password">
                                    <!-- Alert error dari validasi -->
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{-- <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                                    </div> --}}

                                    <!-- Tampilkan password -->
                                    <div class="col-auto custom-control custom-checkbox">
                                        <input type="checkbox" name="show" class="custom-control-input"
                                            tabindex="3" id="show-password" onclick="togglePasswordVisibility()">
                                        <label class="custom-control-label" for="show-password">Tampilkan
                                            Password</label>
                                    </div>
                                </div>

                                <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>

                            {{-- <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.html">Create an Account!</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script>
        // Show password
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('inputPassword');
            var showPasswordCheckbox = document.getElementById('show-password');

            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

</body>

</html>
