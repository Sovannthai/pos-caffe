<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', config('app.name'))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ionicons@5.1.2/dist/css/ionicons.min.css">
    @yield('css')
    <script>
        window.APP = < ? php echo json_encode([
            'currency_symbol' => config('settings.currency_symbol')
            , 'warning_quantity' => config('settings.warning_quantity')
        ]) ? >

    </script>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        @include('layouts.partials.navbar')
        @include('layouts.partials.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('content-header')</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            @yield('content-actions')
                        </div><!-- /.col -->
                    </div>
                </div><!-- /.container-fluid -->
            </section <!-- Main content -->
            <section class="content">
                @include('layouts.partials.alert.success')
                @include('layouts.partials.alert.error')
                @yield('content')
            </section>

        </div>
        <!-- /.content-wrapper -->

        @include('layouts.partials.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div <!-- ./wrapper -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true
            , position: 'top-right',
            // iconColor: 'white',
            customClass: {
                popup: "colored-toast {{ (config('app.dark_mode') == 1 ? 'dark-colored-toast' : '') }}"
            }
            , showConfirmButton: false
            , timer: 4000
            , timerProgressBar: true
            , didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        , });

        @if(Session::get('success'))
        Toast.fire({
            icon: 'success'
            , title: `{{ Session::get('success') }}`,
            // message: ,
        });
        @endif
        @if(Session::get('error'))
        Toast.fire({
            icon: 'error'
            , title: `{{ Session::get('error') }}`,
            // message: ,
        });
        @endif

    </script>
    @yield('js')
</body>

</html>
