<!DOCTYPE html>
<html lang="en">
    <head>
        @include('main._meta')
        
        <title>AdminLTE 3 | Dashboard 2</title>
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        @yield('stylesheets')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            @include('main._navbar')
            @include('main._sidebar')
            <div class="content-wrapper">
                @include('main._breadcrumb')
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>
            </div>
            @include('main._option')
            @include('main._footer')
            @include('main._toast')
        </div>
        <script src="{{ mix('js/main.js') }}"></script>
        @yield('scripts')

        @include('sweetalert::alert')
    </body>
</html>
