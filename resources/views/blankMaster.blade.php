<!DOCTYPE html>
<html lang="en">
<head>
    @include('backend.includes.meta')

    <title> {{ config('app.name') }} - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/img/favicon.png') }}">

    <!-- Custom fonts for this template-->
    @include('backend.includes.fonts')

    <!-- Custom styles for this template-->
    @include('backend.includes.css')

</head>

<body class="bg-dark-blue">

<div class="container">
@yield('mainContent')
</div>

<!-- End of Page Wrapper -->


<!--All scripts  -->
@include('backend.includes.scripts')
<!--End of All scripts  -->

</body>

</html>
