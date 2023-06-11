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

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('backend.includes.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('backend.includes.topbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('mainContent')


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('backend.includes.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!--All scripts  -->
@include('backend.includes.scripts')
<!--End of All scripts  -->
@yield('extraJs')
<script>
    @if (Session::has('success'))

        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.success("{{session('success')}}");

    @elseif (Session::has('error'))
        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.error("{{session('error')}}");

    @elseif (Session::has('info'))
        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.info("{{session('info')}}");
    @endif
    @if(count($errors) > 0)
        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.error("Error Please Recheck !");
    @endif
</script>

</body>

</html>
