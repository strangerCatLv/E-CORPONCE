<!doctype html>
<html lang="en">
    
    <head>
    @include('layouts.partials.head')
    <style>
        @keyframes vibrate {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(2px, -2px); }
            60% { transform: translate(-2px, 2px); }
            80% { transform: translate(2px, -2px); }
            100% { transform: translate(0); }
        }
    
        .vibrate-image {
            animation: vibrate 0.3s ease infinite;
        }
        .header-item:hover{
            color: white
        }
        .fa, .fas{
            color: white
        }
        .jarak-button{
            margin-right: 5px;
        }
        .loader {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        }
    </style>
    </head>

    <body data-sidebar="dark">
    {{-- <body class="sidebar-enable vertical-collpsed" data-sidebar="dark"> --}}

        {{-- <div class="loader d-flex justify-content-center">
            <img class="d-block my-auto vibrate-image" src="{{ asset('img/logo smk.png') }}" width="250" height="auto" alt="">
        </div> --}}

        <div class="loader d-flex justify-content-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        
        <!-- ========== Loader ========== -->
        <!-- ========== End Loader ========== -->

        <div id="layout-wrapper" class="d-none">

            <!-- ========== Navbar Start ========== -->
            @include('layouts.partials.navbar')
            <!-- ========== End Navbar Start ========== -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.partials.sidebar')
            <!-- ========== End Left Sidebar Start ========== -->

            <!-- ========== Content Start ========== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        @yield('breadcumb')

                        @yield('content')
                        
                    </div>
                </div>

                @include('layouts.partials.footer')

            </div>
            <!-- ========== End Content Start ========== -->

        </div>
        <!-- END layout-wrapper -->


        @include('layouts.partials.foot')
    </body>
</html>
