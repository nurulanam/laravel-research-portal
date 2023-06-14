@extends('backend.dashboardMaster')
@section('title', 'Create New Project')
@section('extraCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
    <style>
        .form-section{
            display: none;
        }
        .form-section.current{
            display: inline;
        }
        .parsley-errors-list{
            color:red;
            font-size: 13px;
            padding: 5px 10px;
            margin: 0 !important;
        }
        .my-30{
            margin: 30px 0;
        }
    </style>
@endsection
@section('mainContent')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark-blue">
                    <h5 class="text-light mb-0"id="main_title">Project Title</h5>
                </div>
                <div class="card-body">
                    <div class="nav nav-fill my-2">
                        <label class="nav-link shadow-sm step0 border rounded mx-2">Details</label>
                        <label class="nav-link shadow-sm step1 border rounded mx-2">Audience</label>
                        <label class="nav-link shadow-sm step2 border rounded mx-2">Questions</label>
                        <label class="nav-link shadow-sm step3 border rounded mx-2">Summery</label>
                    </div>
                    <form action="" class="new-project-form my-4">
                        <div class="form-section">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Internal Project Name <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="internal_name" id="internal_name" class="form-control" placeholder="Internal Project Name" required>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Project Title <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="project_title" class="form-control" placeholder="Project Title" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Project Details <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <textarea name="project_details" class="form-control" placeholder="Project Full Details" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Target Audience <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="radio" name="audience">
                                            <span class="mx-2">Industry Professionals (B2B)</span>
                                        </div>
                                        <div class="">
                                            <input type="radio" name="audience" required>
                                            <span class="mx-2">General Population (B2C)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Type of Research</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="radio" name="research_type">
                                            <span class="mx-2">Remote</span>
                                        </div>
                                        <div class="">
                                            <input type="radio" name="research_type">
                                            <span class="mx-2">In-Person</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Research Methodology</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <select name="research_method" class="form-control">
                                            <option value="">Select Research Method</option>
                                            <option value="One-on-One">One-on-One</option>
                                            <option value="Focus Group">Focus Group</option>
                                            <option value="Unmoderated-Study">Unmoderated Study</option>
                                            <option value="Survey">Survey</option>
                                            <option value="Diary-Study">Diary Study</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Time Required (<span class="text-danger">Minutes</span>)</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" name="required_time" class="form-control" placeholder="Time Required in Minute(s)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Incentive (<span class="text-danger">Min: $5 - Max: $1000</span>)</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="d-flex">
                                            <input type="number" name="required_time" id="required_time" min="5" max="1000" value="5" class="form-control w-25 mr-lg-3" placeholder="Total Incentive" disabled="disabled" readonly="readonly">
                                            <input type="range" name="" id="required_time_range" min="5" max="1000" step="5" value="5" class="form-control-range">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Target number of participants <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="d-flex">
                                            <input type="number" name="target_participant" id="target_participant" min="1" max="50" value="1" class="form-control w-25 mr-lg-3" placeholder="Total Incentive" disabled="disabled" readonly="readonly">
                                            <input type="range" name="" id="target_participant_range" min="1" max="50" step="1" value="1" class="form-control-range">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <label for="">Address:</label>
                            <textarea name="address" class="form-control mb-3" cols="30" rows="5" required></textarea>
                        </div>
                        <div class="form-section">
                            <label for="">Address:</label>
                            <textarea name="address" class="form-control mb-3" cols="30" rows="5" required></textarea>
                        </div>
                        <div class="form-navigation mt-3">
                            <button type="button" class="previous btn btn-primary float-left"><span class="mr-2"><i class="fas fa-chevron-left"></i></span> Previous</button>
                            <button type="button" class="next btn btn-primary float-right">Next <span class="ml-2"><i class="fas fa-chevron-right"></i></span></button>
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#required_time_range').on('input', function (){
            let range = $(this).val();
            $('#required_time').val(range);
        });
        $('#target_participant_range').on('input', function (){
            let range = $(this).val();
            $('#target_participant').val(range);
        });
        $('#internal_name').on('keyup', function (){
            let name = $(this).val();
            if (name !== ""){
                $('#main_title').html(name);
            }else {
                $('#main_title').html('Project Title');
            }



        });
        $(function(){
            var $sections=$('.form-section');

            function navigateTo(index){

                $sections.removeClass('current').eq(index).addClass('current');

                $('.form-navigation .previous').toggle(index>0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [Type=submit]').toggle(atTheEnd);


                const step= document.querySelector('.step'+index);
                step.style.backgroundColor="#092D5F";
                step.style.color="white";
            }

            function curIndex(){
                return $sections.index($sections.filter('.current'));
            }

            $('.form-navigation .previous').click(function(){
                navigateTo(curIndex() - 1);

                const curOldIndex = curIndex()+1;
                const backStep= document.querySelector('.step'+curOldIndex);
                backStep.style.backgroundColor="#fff";
                backStep.style.color="#858796";
            });

            $('.form-navigation .next').click(function(){
                $('.new-project-form').parsley().whenValidate({
                    group:'block-'+curIndex()
                }).done(function(){
                    navigateTo(curIndex()+1);
                });
            });

            $sections.each(function(index,section){
                $(section).find(':input').attr('data-parsley-group','block-'+index);
            });

            navigateTo(0);

        });


    </script>
@endsection
