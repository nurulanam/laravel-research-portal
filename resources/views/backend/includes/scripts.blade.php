<!-- Bootstrap core JavaScript-->
<script src="{{ asset('backend') }}/js/bootstrap.bundle.js"></script>
<!--toastrjs -->
<script src="{{ asset('backend') }}/js/toastr.min.js"></script>
<script>
    $(document).ready(() => {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    })
</script>
