@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Project Participants')
@section('extraCss')
@endsection

@section('mainContent')
    <div class="row gap-2 gap-md-0">
        <div class="col-md-4">
            <div class="card rounded-4 shadow-md border-1" style="height: 65vh; ">
                <div class="card-header rounded-top-4 bg-dark-blue p-3">
                    <h5 class="text-white mb-0">All Messages</h5>
                </div>
                <div class="card-body p-0" style="overflow-y: scroll">
                    <ul class="list-group project-group bg-white rounded-0" style="height: 100%; ">
                        @if(count($projects) > 0)
                            @foreach($projects as $project)
                                <li class="list-group-item project-item list-group-item-action font-15 py-3 border-0 border-bottom d-flex justify-content-between align-items-center" data-id="{{$project->id}}" data-name="@if(Auth::user()->hasRole('researcher')) {{ $project->my_project_name }} @elseif(Auth::user()->hasRole('participant')) {{ $project->study_title }} @endif">
                                    <div class="fw-normal">@if(Auth::user()->hasRole('researcher')) {{ Str::limit($project->my_project_name, 40) }} @elseif(Auth::user()->hasRole('participant')) {{ Str::limit($project->study_title, 40) }} @endif</div>
                                    <span class="badge bg-primary rounded-pill"></span>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item list-group-item-action py-3 border-0 border-bottom d-flex justify-content-center align-items-center text-center">
                                No messages available
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card rounded-4 shadow-md border-1" style="height: 65vh;">
                <div class="card-header d-flex justify-content-between align-items-center rounded-top-4 px-3 py-2">
                    <h6 class="mb-0" id="projectTitle">Project Name</h6>
                    <button class="btn btn-primary" id="refresh" data-id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh Messages"><i class="fas fa-refresh"></i></button>
                </div>
                <div class="card-body message-box-container" style="overflow-y: scroll">
                    <div class="message-box font-15 d-flex flex-column gap-3">
                    </div>
                </div>
                <div class="card-footer rounded-bottom-4 py-3">
                    <form action="#">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div class="w-100">
                                <textarea class="form-control" rows="1" cols="1" id="message" required data-parsley-error-message="Please write your message." placeholder="Write your message here..."></textarea>
                            </div>
                            <button type="button" class="btn btn-primary flex-shrink-0" id="send">Send<span class="ms-2"><i class="fa-solid fa-paper-plane"></i></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraJs')
    <script src="{{ asset('backend/js/parsley.min.js') }}"></script>
    <script>
        function scrollToBottom() {
            var scrollableDiv = $(".message-box-container");
            scrollableDiv.scrollTop(scrollableDiv.prop("scrollHeight"));
        }

        $(document).ready(function (){
            var firstChild = $('ul.project-group li:first-child');
            firstChild.addClass('active');
            var dataId = firstChild.data('id');
            $('#refresh').data('id', dataId);
            var projectTitle = firstChild.data('name');
            $('#projectTitle').html(projectTitle);

            fetchMessages(dataId);


            setTimeout(function(){
                setInterval(function() {
                    var projectId = $('ul.project-group li.active').data('id');
                    var messageId = $('.message-box').find('.row:last-child').data('msg');
                    fetchMessagesById(projectId, messageId)
                }, 15000);
            }, 1000);



        });
        $('.project-item').on('click', function(){
            $('ul.project-group li').each(function() {
                $(this).removeClass('active');
            });
            $(this).addClass('active');

            var projectId = $(this).data('id');
            $('#refresh').data('id', projectId);

            var projectTitle =$(this).data('name');
            $('#projectTitle').html(projectTitle);

            fetchMessages(projectId);

            if ($(window).width() < 768) {
                // Smoothly scroll to the #targetSection
                $('html, body').animate({
                    scrollTop: $(".message-box-container").offset().top
                }, 1000); // Adjust the duration as needed (1000ms = 1 second)
            }
        });
        $('#refresh').on('click', function(){
            var projectId = $('#refresh').data('id');
            var lastChild = $('.message-box .row:last-child').data('msg');
            fetchMessagesById(projectId, lastChild);
        });

        $('#send').on('click', function (){
            var refresh = $('#refresh').data('id');
            $('#message').parsley().validate();
            var message = $('#message').val();
            $.ajax({
                method: 'POST',
                url: "{{ route('messages.store') }}",
                data: {
                    'message': message,
                    'projectId': refresh,
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response){
                    if (response.status == 'success'){
                        fetchMessages(refresh);
                        $('#message').val(' ');
                    }else if(response.status == 'error'){

                    }
                },
                error: function (error){
                    console.log(error);
                }
            })
        });

        function fetchMessages(projectId){
            var userId = {{ Auth::user()->id }};

            $.ajax({
                method: 'POST',
                url: "{{ route('messages.show') }}",
                data: {
                    'projectId': projectId,
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response){
                    if (response.status == 'success'){
                        $('.message-box').html(' ');
                        $.each(response.data, function (index, data){
                            if(data.user_id === userId){
                                var message = '<div class="row" data-msg="'+data.id+'">\
                                    <div class="d-flex justify-content-end align-items-end gap-2">\
                                        <p class="flex-shrink-0 order-2 text-end" style="min-width: 8%">'+data.user.first_name+' '+data.user.last_name.charAt(0)+'.</p>\
                                        <p class="order-1 d-inline-block bg-primary text-white p-2 rounded-3" style="max-width: 82%">'+data.message+'</p>\
                                    </div>\
                                    </div>';
                            }else{
                                var message = '<div class="row" data-msg="'+data.id+'">\
                                    <div class="d-flex justify-content-start align-items-end gap-2">\
                                        <p class="flex-shrink-0 text-start" style="min-width: 8%">'+data.user.first_name+' '+data.user.last_name.charAt(0)+'.</p>\
                                        <p class="d-inline-block bg-secondary-subtle p-2 rounded-3" style="max-width: 82%">'+data.message+'</p>\
                                    </div>\
                                    </div>';
                            }
                            $('.message-box').append(message);
                        });
                        scrollToBottom();
                    }else if(response.status == 'error'){
                        $('.message-box').html('<div class="row justify-content-center text-secondary">\
                            <p>'+response.data+'</p>\
                    </div>');
                    }
                }
            })
        }

        function fetchMessagesById(projectId, messageId){
            var userId = {{ Auth::user()->id }};

            $.ajax({
                method: 'POST',
                url: "{{ route('messages.refresh') }}",
                data: {
                    'projectId': projectId,
                    'messageId': messageId,
                },
                cache: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response){
                    if (response.status == 'success'){
                        $.each(response.data, function (index, data){
                            if(data.user_id === userId){
                                var message = '<div class="row" data-msg="'+data.id+'">\
                                    <div class="d-flex justify-content-end align-items-end gap-2">\
                                        <p class="flex-shrink-0 order-2" style="min-width: 8%">'+data.user.first_name+' '+data.user.last_name.charAt(0)+'.</p>\
                                        <p class="order-1 d-inline-block bg-primary text-white p-2 rounded-3" style="max-width: 82%">'+data.message+'</p>\
                                    </div>\
                                    </div>';
                            }else{
                                var message = '<div class="row" data-msg="'+data.id+'">\
                                    <div class="d-flex justify-content-start align-items-end gap-2">\
                                        <p class="flex-shrink-0" style="min-width: 8%">'+data.user.first_name+' '+data.user.last_name.charAt(0)+'.</p>\
                                        <p class="d-inline-block bg-secondary-subtle p-2 rounded-3" style="max-width: 82%">'+data.message+'</p>\
                                    </div>\
                                    </div>';
                            }
                            $('.message-box').append(message);
                        });
                        scrollToBottom();
                    }
                    // else if(response.status == 'error'){
                    //     // $('.message-box').append('<div class="row justify-content-center text-center text-secondary">\
                    //     //     <p>'+response.data+'</p>\
                    // </div>');
                    // }
                }
            })
        }
    </script>
@endsection
