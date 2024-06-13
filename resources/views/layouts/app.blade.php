<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>@if (isset($title)) {{ $title }} @endif | Pixadmin - Eco Cash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Adminto - Tailwind HTML Admin Dashboard Template, A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="shadapixel" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('pixadmin/favicon.ico')}}" type="image/x-icon">

    <!-- App css -->
    <link href="{{asset('admindash/asset/css/app.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Icons css -->
    <link href="{{asset('admindash/asset/css/icons.min.css')}}" rel="stylesheet" type="text/css">



    {{-- Custom css --}}
    <link rel="stylesheet" href="{{asset('admindash/asset/css/custom.css')}}">
    {{-- Custom Data table --}}
    <link rel="stylesheet" href="{{asset('css/datatable-customization.css')}}">

    {{-- Header style --}}
    @if (isset($headerstyle))
        {{ $headerstyle }}
    @endif



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme Config Js -->
    <script src="{{asset('admindash/asset/js/config.js')}}"></script>

    <script>
        let BASE_URL = {!! json_encode(url('/')) !!} + "/";
    </script>
</head>

<body class="font-space">

    <div class="flex wrapper">

        <!-- Menu -->
        @include('layouts.adminmenu')
        <!-- Sidenav Menu End  -->


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- Topbar Start -->
            @include('layouts.adminheader')
            <!-- Topbar End -->

            <main class="relative">
                {{-- for php flash --}}
                <x-auth-session-status :status="Session::get('message')" id="notificationflush" onclick="hideflash()"></x-auth-session-status>
                {{-- for ajax flash --}}
                <div class="bg-seagreen/40 backdrop-blur-sm px-4 py-2 font-medium text-sm text-white absolute top-4 right-6 z-[11111] hover:bg-seagreen hidden" id="ajaxflash">
                    <div class="flex gap-4">
                        <p></p>
                        <span class="menu-icon"><i class="mdi mdi-close"></i></span>
                    </div>
                </div>

                @if ($errors->any())
                <div class="bg-seagreen/40 backdrop-blur-sm px-4 py-2 font-medium text-sm text-white absolute top-4 right-6 z-[11111] hover:bg-seagreen" id="sessionerror">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                            {{ $slot }}
            </main>

            <!-- Footer Start -->
            @include('layouts.adminfooter')
            <!-- Footer End -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>

    <!-- Theme Settings -->


    <!-- Plugin Js -->
    <script src="{{asset('admindash/asset/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admindash/asset/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('admindash/asset/libs/lucide/umd/lucide.min.js')}}"></script>
    <script src="{{asset('admindash/asset/libs/%40frostui/tailwindcss/frostui.js')}}"></script>

    <!-- App Js -->
    <script src="{{asset('admindash/asset/js/app.js')}}"></script>

    <!-- knob plugin -->
    <script src="{{asset('admindash/asset/libs/jquery-knob/jquery.knob.min.js')}}"></script>

    <!--Morris Chart-->
    <script src="{{asset('admindash/asset/libs/morris.js06/morris.min.js')}}"></script>
    <script src="{{asset('admindash/asset/libs/raphael/raphael.min.js')}}"></script>
    {{-- Sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Custom js --}}
    <script src="{{asset('admindash/js/custom.js')}}"></script>



    @if (isset($script))
    {{ $script }}
    @endif



</body>

</html>
