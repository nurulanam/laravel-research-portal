<!DOCTYPE html>
<html lang="en">
<head>
    @include('backend.includes.meta')
    @yield('extraMeta')

    <title> {{ config('app.name') }} - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/img/favicon.png') }}">

    <!-- Custom fonts for this template-->
    @include('backend.includes.fonts')
    @yield('extraCss')

    <!-- Custom styles for this template-->
    @include('backend.includes.css')

</head>

<body>

        <!-- Main Content -->
        <div class="container">
{{--            nab bar --}}
            @include('backend.includes.nav')

            <!-- Begin Page Content -->
            <div class="content dashboard-content">
                @yield('mainContent')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <div class="">
            @include('backend.includes.footer')
        </div>


<!--All scripts  -->
@include('backend.includes.scripts')
<!--End of All scripts  -->
@yield('extraJs')


</body>

</html>
