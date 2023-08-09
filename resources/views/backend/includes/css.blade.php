<style>
    @font-face {
        font-family: 'circularStd';
        src: url('{{ asset('/backend/fonts/CircularStd-Black.woff') }}') format('truetype');
        font-weight: 900;
    }
    @font-face {
        font-family: 'circularStd';
        src: url('{{ asset('/backend/fonts/CircularStd-Bold.woff') }}') format('truetype');
        font-weight: 700;
    }

    @font-face {
        font-family: 'circularStd';
        src: url('{{ asset('/backend/fonts/CircularStd-Medium.woff') }}') format('truetype');
        font-weight: 500;
    }
    @font-face {
        font-family: 'circularStd';
        src: url('{{ asset('/backend/fonts/CircularStd-Book.woff') }}') format('truetype');
        font-weight: 400;
    }
    @font-face {
        font-family: 'circularStd';
        src: url('{{ asset('/backend/fonts/CircularStd-Light.woff') }}') format('truetype');
        font-weight: 300;
    }
</style>
{{-- font awesome css --}}
<link href="{{ asset('backend') }}/css/all.css" rel="stylesheet">
{{--bootstrap 5 css --}}
<link href="{{ asset('backend') }}/css/bootstrap.css" rel="stylesheet">
<link href="{{ asset('backend') }}/css/toastr.css" rel="stylesheet">
{{--toastr css --}}
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>--}}

{{--main css--}}
<link rel="stylesheet" href="{{ asset('backend') }}/css/style.css">

<!-- Jquery-->
<script src="{{ asset('backend') }}/js/jquery.min.js"></script>
