<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRABA</title>

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <style>
        /* Assure que les notifications Toastr apparaissent au-dessus de la navbar */
        #toast-container {
            z-index: 1999 !important;
            position: fixed;
        }

        /* Optionnel : ajuster la position en haut */
        .toast-top-right {
            top: 80px;
            right: 12px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('includes.menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('titre')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('titre')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
        </div>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                All rights reserved.
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2024 RAF Burkina SARL</strong>
        </footer>
    </div>
    <!-- ./wrapper -->


    <div class="modal fade" id="dotationAnulleModal" tabindex="-1" aria-labelledby="dotationAnulleLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dotationAnulleLabel">
                        Budget du ministère pour l'année {{ date('Y') }}
                        {{-- @dump($errors->all()) --}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <form action="{{ route('budget.store') }}" method="post" id="dotationAnulleForm">
                        @csrf
                        <div class="form-group">
                            <label for="dotation">Budget du ministère pour l'année {{ date('Y') }}</label>
                            <input type="number" class="form-control" id="dotation" name="dotation"
                                placeholder="Budget">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" form="dotationAnulleForm">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>


    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    {{-- <script src="{{asset('dist/js/demo.js')}}"></script> --}}

    {{-- <script>
        if (@json(@session('BudjetAnuelle') == true))
            $('#dotationAnulleModal').modal('show');
    </script> --}}
    @yield('custom_js')

</body>

</html>
