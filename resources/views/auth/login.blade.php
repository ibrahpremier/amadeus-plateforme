<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amadeus Plateforme | Connexion</title>

    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>RAF</b> PLATFORME</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Connectez vous pour acceder à la plateforme</p>

                <form action="{{route("auth.login")}}" method="post">
                  @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                        </div>

                        @error('email')
                            <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Mot de passe" value="{{ old('password') }}"
                                required>
                        </div>
                        @error('password')
                            <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="social-auth-links text-center mt-2 mb-3">
                      <button type="submit" class="btn btn-block btn-primary">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Connexion
                      </button>
                    </div>
                    <!-- /.social-auth-links -->
                </form>


                <p class="mt-4 text-right">
                    <a href="forgot-password.html" class="text-danger"><small><u>J'ai oublié mon mot de passe</u></small></a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    {{-- <script src="{{asset('dist/js/demo.js')}}"></script> --}}
    @yield('custom_js')
</body>

</html>
