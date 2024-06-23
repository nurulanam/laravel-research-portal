<!-- Bootstrap core JavaScript-->
<script src="{{ asset('backend') }}/js/bootstrap.bundle.js"></script>
<!--toastrjs -->
<script src="{{ asset('backend') }}/js/toastr.min.js"></script>
<script>
    $(document).ready(() => {
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    })
    $('.confirm-btn').on('click', function(){
        var confirm = $(this);
        var url = confirm.data('url');
        var confirmModal = $('#confirmEditModal');
        var confirmButton = $('#confirmEditModal #btnLeave');

        confirmButton.attr('href', url);
        console.log(confirmButton);
    });

    @if (Session::has('success'))
        toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    toastr.options.timeOut = 3000;
    toastr.success("{{session('success')}}");

    @elseif (Session::has('error'))
        toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    toastr.options.timeOut = 3000;
    toastr.error("{{session('error')}}");

    @elseif (Session::has('info'))
        toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    toastr.options.timeOut = 3000;
    toastr.info("{{session('info')}}");
    @endif
        @if(count($errors) > 0)
        toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    toastr.options.timeOut = 3000;
    toastr.error("Error Please Recheck !");
    @endif
</script>
