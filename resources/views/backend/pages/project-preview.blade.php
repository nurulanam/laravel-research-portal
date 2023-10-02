@extends('backend.dashboardMaster')
@section('extraMeta')
@endsection
@section('title', $findProject->project_title)
@section('extraCss')
    <style>
        .form-section {
            display: none;
        }

        .form-section.current {
            display: inline;
        }

        .parsley-errors-list {
            color: red;
            font-size: 13px;
            padding: 5px 10px;
            margin: 0 !important;
        }

        .my-30 {
            margin: 30px 0;
        }
    </style>
@endsection
@section('mainContent')
    <div class="row mb-3 mb-md-5 shadow-md">
        <div class="col-12">
            <div class="card bg-dark-blue bg-gradient rounded-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-9">
                            <h1 class="text-white font-25">{{ $findProject->study_title }}</h1>
                        </div>
                        <div class="col-12 col-md-3">
                            @php $totalQuestion = count($questions) @endphp
                            <p class="font-18 text-white float-md-end">Total Questions: {{ $totalQuestion }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">
            @php
                $q = 0;
            @endphp
            <div class="card rounded-4 shadow-md mt-4">
                <div class="card-body p-4">
                    <form action="#"  class="question-form">
                        @foreach ($questions as $question)
                            @if($question->question_type[0] == 'checkbox')
                                <div class="form-section">
                                    <h2 class="font-22"><span>Q{{ $q + 1 }}.
                                        </span>{{ $question->question_name[0] }}</h2>
                                    <div class="form-group mt-3">
                                        @foreach ($question->answer as $index => $answer)

                                            <div class="">
                                                <input type="checkbox" class="form-check-input"
                                                    name="{{ $question->question_type[0] }}[{{ $q }}][{{ $index }}]"
                                                    value="{{ $answer }}" id="{{ $answer . '-' . $q }}"
                                                    >
                                                <span class="mx-2"><label class="form-check-label"
                                                        for="{{ $answer . '-' . $q }}">{{ $answer }}</label></span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @php
                                    $q++;
                                @endphp
                            @elseif($question->question_type[0] == 'textarea')
                                <div class="form-section">
                                    <h2 class="font-22"><span>Q{{ $q + 1 }}.
                                        </span>{{ $question->question_name[0] }}</h2>
                                    <div class="form-group mt-3">
                                        <textarea name="{{ $question->question_type[0] }}[{{ $q }}][]" class="form-control" rows="5"
                                            placeholder="Your Answer" @if ($question->required[0]) required @endif></textarea>
                                    </div>
                                </div>
                                @php
                                    $q++;
                                @endphp
                            @elseif($question->question_type[0] == 'text')
                                <div class="form-section">
                                    <h2 class="font-22"><span>Q{{ $q + 1 }}.
                                        </span>{{ $question->question_name[0] }}</h2>
                                    <div class="form-group mt-3">
                                        <input type="text"
                                            name="{{ $question->question_type[0] }}[{{ $q }}][]"
                                            class="form-control" placeholder="Your Answer"
                                            @if ($question->required[0]) required @endif>
                                    </div>
                                </div>
                                @php
                                    $q++;
                                @endphp
                            @elseif($question->question_type[0] == 'number')
                                <div class="form-section">
                                    <h2 class="font-22"><span>Q{{ $q + 1 }}.
                                        </span>{{ $question->question_name[0] }}</h2>
                                    <div class="form-group mt-3">
                                        <input type="number"
                                            name="{{ $question->question_type[0] }}[{{ $q }}][]"
                                            class="form-control" placeholder="Your Answer In Number Only"
                                            @if ($question->required[0]) required @endif>
                                    </div>
                                </div>
                                @php
                                    $q++;
                                @endphp
                            @elseif($question->question_type[0] == 'slider')
                                <div class="form-section">
                                    <h2 class="font-22"><span>Q{{ $q + 1 }}.
                                        </span>{{ $question->question_name[0] }}</h2>
                                    <div class="form-group mt-3">
                                        <div class="d-md-flex align-items-center">
                                            <input type="number" class="form-control w-50 my-2 my-md-0 mr-3"
                                                name="{{ $question->question_type[0] }}[{{ $q }}][]" value="{{ $question->min_value[0] }}"
                                                min="{{ $question->min_value[0] }}" max="{{ $question->max_value[0] }}"
                                                placeholder="Total" readonly="readonly">
                                            <input type="range" class="form-range ms-md-2" value="{{ $question->min_value[0] }}"
                                                min="{{ $question->min_value[0] }}" max="{{ $question->max_value[0] }}"
                                                step="{{ $question->steps[0] }}">
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $q++;
                                @endphp
                            @endif
                        @endforeach

                        <div class="form-navigation mt-4">
                            <button type="button" class="previous btn btn-primary btn-custom float-start"><span
                                    class="mr-2"><i class="fas fa-chevron-left"></i></span> Previous</button>
                            <button type="button" class="next btn btn-primary btn-custom float-end">Next <span
                                    class="ml-2"><i class="fas fa-chevron-right"></i></span></button>
                            <a href="{{ route('project.index') }}" class="btn btn-success mx-1 publish-btn btn-custom float-end">Done</a>

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
        $(document).ready(function() {
            $(function() {
                var $sections = $('.form-section');

                function navigateTo(index) {
                    $sections.removeClass('current').eq(index).addClass('current');
                    $('.form-navigation .previous').toggle(index > 0);
                    var atTheEnd = index >= $sections.length - 1;
                    $('.form-navigation .next').toggle(!atTheEnd);
                    $('.form-navigation [Type=submit]').toggle(atTheEnd);
                }

                function curIndex() {
                    return $sections.index($sections.filter('.current'));
                }

                $('.form-navigation .previous').click(function() {
                    navigateTo(curIndex() - 1);

                    const curOldIndex = curIndex() + 1;
                    const backStep = document.querySelector('.step' + curOldIndex);
                    backStep.style.backgroundColor = "#fff";
                    backStep.style.color = "#858796";
                });

                $('.form-navigation .next').click(function() {
                    $('.question-form').parsley().whenValidate({
                        group: 'block-' + curIndex()
                    }).done(function() {
                        navigateTo(curIndex() + 1);
                    });
                });
                $sections.each(function(index, section) {
                    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
                });
                navigateTo(0);
            });
            $('input[type="range"]').on('input', function() {
                $(this).closest('div').find('input[type="number"]').val($(this).val());
            });
        })
    </script>
@endsection
