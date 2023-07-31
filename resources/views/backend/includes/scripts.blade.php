<!-- Bootstrap core JavaScript-->
<script src="{{ asset('backend') }}/js/jquery.min.js"></script>
<script src="{{ asset('backend') }}/js/bootstrap.bundle.js"></script>
<script src="{{ asset('backend') }}/js/toastr.min.js"></script>
<!--toastrjs -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>--}}
<script>
    $(document).ready(() => {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    })
</script>
