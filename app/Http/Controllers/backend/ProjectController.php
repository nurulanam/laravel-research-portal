<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasAgeRange;
use App\Models\backend\ProjectHasCity;
use App\Models\backend\ProjectHasCompanySize;
use App\Models\backend\ProjectHasEducationLevel;
use App\Models\backend\ProjectHasEthnicity;
use App\Models\backend\ProjectHasGender;
use App\Models\backend\ProjectHasHouseholdIncome;
use App\Models\backend\ProjectHasIndustry;
use App\Models\backend\ProjectHasLocation;
use App\Models\backend\ProjectHasProjectTopic;
use App\Models\backend\ProjectHasQuestion;
use App\Models\backend\ProjectHasResponse;
use App\Models\backend\ProjectHasSkill;
use App\Models\backend\Projects;
use App\Models\backend\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        app()->call([dashboardController::class, 'updateProjectStatus']);

        if (Auth::user()->hasRole('researcher')) {
            $projects = Projects::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->paginate(5);
            return view('backend.pages.researcher-projects', compact('projects'));

        }elseif (Auth::user()->hasRole('participant')){
            $findProjectHasResponse = ProjectHasResponse::where('user_id', '=', Auth::id())->get();
            if ($findProjectHasResponse){
                $projectIds = $findProjectHasResponse->pluck('project_id')->toArray();
                $projects = Projects::whereIn('id', $projectIds)->paginate(10); // Change '10' to the number of items per page you want to display

            }
            return view('backend.pages.participant-projects', compact('projects'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $us_states = config('app.us_states');
        $industries = config('app.industries');

        return view('backend.pages.new-project', compact('industries', 'us_states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'my_project_name' => 'required|string',
           'study_title' => 'required|string',
           'study_description' => 'required|string',
           'target_audience' => 'required|string',
           'project_topic' => 'nullable|array|max:2',
           'project_topic.*' => 'string',
           'project_type' => 'required|string',
           'research_type' => 'nullable|string',
           'required_time' => 'nullable|numeric',
           'participant_incentive' => 'required|numeric',
           'target_participant' => 'required',
           'industry' => 'required|array|max:5',
           'industry.*' => 'string',
           'company_size' => 'nullable|array',
           'states' => 'required|array',
           'cities' => 'required|array',
           'states.*.*' => 'required|string',
           'cities.*.*' => 'required|string',
           'skills' => 'nullable|array|max:25',
           'skills.*' => 'string',
           'household_income' => 'nullable|array',
           'gender' => 'nullable|array',
           'education_level' => 'nullable|array',
           'ethnicity' => 'nullable|array',
           'age_range' => 'nullable|array',
           'status' => 'required'
        ]);
        // User Info  schedule_date' => 'nullable|date_format:Y-m-d\TH:i',
        $user_id = Auth::id();

        // Project Cost Calculation
        $total_participant_incentive = $request->participant_incentive * $request->target_participant;
        $total_service_fee  = $total_participant_incentive/2;
        $total_cost  = $total_participant_incentive + $total_service_fee;

        // Creating New Project
        $project = new Projects();

        //Adjusting Project Fields
        $project->user_id = $user_id;
        $project->my_project_name = $request->my_project_name;
        $project->study_title = $request->study_title;
        $project->study_description = $request->study_description;
        $project->target_audience = $request->target_audience;
        $project->project_type = $request->project_type;
        $project->research_type = $request->research_type;
        $project->required_time = $request->required_time;
        $project->participant_incentive = $request->participant_incentive;
        $project->target_participant = $request->target_participant;
        $project->total_incentive = $total_participant_incentive;
        $project->total_service_fee = $total_service_fee;
        $project->total_coast = $total_cost;
        $project->slug = $this->createSlug($request->study_title);

        $project->status = $request->status;
        if ($request->has('schedule_date')){
            $project->published_at = Carbon::createFromFormat('Y-m-d\TH:i', $request->schedule_date);
        }

        $project->save();

        // Creating New Project Topics belongsToProject
        if ($request->target_audience == 'b2c'){
            if ($request->project_topic !== null){
                $new_project_topic = new ProjectHasProjectTopic();
                $new_project_topic->project_id = $project->id;
                $new_project_topic->project_topic = json_encode($request->project_topic);
                $new_project_topic->save();
            }
        }

        // Creating New Industries belongsToProject
        if ($request->industry !== null){
            $new_industry = new ProjectHasIndustry();
            $new_industry->project_id = $project->id;
            $new_industry->industries = json_encode($request->industry);
            $new_industry->save();
        }

        // Creating New Company Size belongsToProject

        // Check if each element in the $request->company_size array is a string
        if (is_array($request->company_size)) {
            $filtered_company_sizes = array_filter($request->company_size, 'is_string');

            // Convert the array to JSON
            $company_sizes_json = json_encode($filtered_company_sizes);

            // Save the JSON data in the database using the model
            $new_company_size = new ProjectHasCompanySize();
            $new_company_size->project_id = $project->id;
            $new_company_size->company_size = $company_sizes_json;
            $new_company_size->save();
        }

        // Creating New Cities Size belongsToProject

        $locations = [];
        $stateData = $request->states;
        $cityData = $request->cities;

        // Combine the state and city data into a single array
        $locations = [];
        foreach ($stateData as $index => $states) {
            $cities = $cityData[$index];

            if (count($states) > 0 && count($cities) > 0) {
                $locations[] = [
                    'state' => $states[0], // Access the first element of the nested array
                    'city' => $cities[0], // Access the first element of the nested array
                ];
            }
        }
        $locationJson = json_encode($locations);
        $new_location = new ProjectHasLocation();
        $new_location->project_id = $project->id;
        $new_location->locations = $locationJson;
        $new_location->save();

        // Creating New Skills belongsToProject
        if ($request->skills !== null){
            $skillIds = [];

            foreach ($request->skills as $skill){
                $findSkill = Skill::where('skill_name', $skill)->first();
                if ($findSkill) {
                    $skillIds[] = $findSkill->id;
                }
            }
            $json_skills = json_encode($skillIds);
            $new_skills = new ProjectHasSkill();
            $new_skills->project_id = $project->id;
            $new_skills->skills = $json_skills;
            $new_skills->save();
        }

        // Creating New Household Income belongsToProject
        // Check if each element in the $request->household_income array is a string
        if (is_array($request->household_income)) {
            $filtered_household_incomes = array_filter($request->household_income, 'is_string');

            // Convert the array to JSON
            $household_income_json = json_encode($filtered_household_incomes);

            // Save the JSON data in the database using the model
            $new_household_income = new ProjectHasHouseholdIncome();
            $new_household_income->project_id = $project->id;
            $new_household_income->household_income = $household_income_json;
            $new_household_income->save();
        }

        // Creating New Gender belongsToProject
        // Check if each element in the $request->gender array is a string
        if (is_array($request->gender)) {
            $filtered_genders = array_filter($request->gender, 'is_string');

            // Convert the array to JSON
            $gender_json = json_encode($filtered_genders);

            // Save the JSON data in the database using the model
            $new_gender = new ProjectHasGender();
            $new_gender->project_id = $project->id;
            $new_gender->gender = $gender_json;
            $new_gender->save();
        }

        // Creating New Education Level belongsToProject
        // Check if each element in the $request->education_level array is a string
        if (is_array($request->education_level)) {
            $filtered_education_levels = array_filter($request->education_level, 'is_string');

            // Convert the array to JSON
            $education_level_json = json_encode($filtered_education_levels);

            // Save the JSON data in the database using the model
            $new_education_level = new ProjectHasEducationLevel();
            $new_education_level->project_id = $project->id;
            $new_education_level->education_level = $education_level_json;
            $new_education_level->save();
        }

        // Creating New Ethnicity belongsToProject
        // Check if each element in the $request->ethnicity array is a string
        if (is_array($request->ethnicity)) {
            $filtered_ethnicities = array_filter($request->ethnicity, 'is_string');

            // Convert the array to JSON
            $ethnicity_json = json_encode($filtered_ethnicities);

            // Save the JSON data in the database using the model
            $new_ethnicity = new ProjectHasEthnicity();
            $new_ethnicity->project_id = $project->id;
            $new_ethnicity->ethnicity = $ethnicity_json;
            $new_ethnicity->save();
        }

        // Creating New Age Range belongsToProject
        // Check if each element in the $request->age_range array is a string
        if (is_array($request->age_range)) {
            $filtered_age_ranges = array_filter($request->age_range, 'is_string');

            // Convert the array to JSON
            $age_range_json = json_encode($filtered_age_ranges);

            // Save the JSON data in the database using the model
            $new_age_range = new ProjectHasAgeRange();
            $new_age_range->project_id = $project->id;
            $new_age_range->age_range = $age_range_json;
            $new_age_range->save();
        }

        // Creating New Questions belongsToProject
        if ($request->has('question_name')){
            $new_project_question = new ProjectHasQuestion();
            $new_project_question->project_id = $project->id;

            $question_name = $request->question_name;
            $question_type = $request->question_type;
            $required = $request->required;
            $answer = $request->answer;
            $answer_qualify = $request->answer_qualify;
            $min_value = $request->min_value;
            $max_value = $request->max_value;
            $steps = $request->steps;

            $combinedArray = [];

            foreach ($question_name as $index => $name) {
                $combinedArray[] = [
                    'question_name' => $name,
                    'question_type' => isset($question_type[$index]) ? $question_type[$index] : null,
                    'required' => isset($required[$index]) ? $required[$index] : null,
                    'answer' => isset($answer[$index]) ? $answer[$index] : null,
                    'answer_qualify' => isset($answer_qualify[$index]) ? $answer_qualify[$index] : null,
                    'min_value' => isset($min_value[$index]) ? $min_value[$index] : null,
                    'max_value' => isset($max_value[$index]) ? $max_value[$index] : null,
                    'steps' => isset($steps[$index]) ? $steps[$index] : null,
                ];
            }
            $json_questions = json_encode($combinedArray);

            $new_project_question->questions = $json_questions;
            $new_project_question->save();
        }

        return redirect()->route('project.index')->with('success', 'Your Project Added Successfully');

    }



    public function createSlug($title)
    {
        // Generate the initial slug from the project title
        $slug = Str::slug($title);

        // Check if the generated slug already exists in the database
        $existingProjects = Projects::where('slug', 'LIKE', $slug . '%')->pluck('slug');

        // If the slug already exists, find the latest number suffix and increment it
        if ($existingProjects->count() > 0) {
            $suffixes = $existingProjects->map(function ($existingSlug) use ($slug) {
                $slugSuffix = Str::afterLast($existingSlug, $slug . '-');
                return intval($slugSuffix);
            });

            $highestSuffix = $suffixes->max();
            $slug .= '-' . ($highestSuffix + 1);
        }

        return $slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function projectParticipants($slug){
        $findProject = Projects::where('slug', '=', $slug)->first();
        $allSkills = Skill::all();
        return view('backend.pages.project-participants', compact('findProject', 'allSkills'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $us_states = config('app.us_states');
        $industries = config('app.industries');
        $project = Projects::where('id', '=', $id)->first();

        if (!$project){
            return back()->with('error', 'Project Not Found');
        }
        if ($project->status == 'publish'){
            return back()->with('error', 'Once you publish project you can\'t update that');
        }
        $projectLocations = json_decode($project->projectLocations->locations, true);
        $projectQuestions = json_decode($project->projectQuestions->questions, true);

        return view('backend.pages.edit-project', compact('project', 'us_states', 'industries', 'projectLocations', 'projectQuestions'));
    }
    public function projectPreview($slug)
    {
        $findProject = Projects::where('slug', $slug)->first();
        if ($findProject) {
            // The project with the given slug exists
            $findQuestions = ProjectHasQuestion::where('project_id', $findProject->id)->first();

            if ($findQuestions) {
                $questions = json_decode($findQuestions->questions);
                return view('backend.pages.project-preview', compact('findProject', 'questions'));
            } else {
                return redirect()->route('project.index')->with('error', 'Project Not Found');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'my_project_name' => 'required|string',
            'study_title' => 'required|string',
            'study_description' => 'required|string',
            'target_audience' => 'required|string',
            'project_topic' => 'nullable|array|max:2',
            'project_topic.*' => 'string',
            'project_type' => 'required|string',
            'research_type' => 'nullable|string',
            'required_time' => 'nullable|numeric',
            'participant_incentive' => 'required|numeric',
            'target_participant' => 'required',
            'industry' => 'required|array|max:5',
            'industry.*' => 'string',
            'company_size' => 'nullable|array',
            'states' => 'required|array',
            'cities' => 'required|array',
            'states.*.*' => 'required|string',
            'cities.*.*' => 'required|string',
            'skills' => 'nullable|array|max:25',
            'skills.*' => 'string',
            'household_income' => 'nullable|array',
            'gender' => 'nullable|array',
            'education_level' => 'nullable|array',
            'ethnicity' => 'nullable|array',
            'age_range' => 'nullable|array',
            'status' => 'required'
        ]);
        // User Info  schedule_date' => 'nullable|date_format:Y-m-d\TH:i',
        $user_id = Auth::id();

        $project = Projects::where('id', '=' ,$id)->where('user_id', '=', $user_id)->first();

        if (!$project){
            return back()->with('error', 'Project Not Found! Or You are Not Right Author');
        }

        if ($project->status == 'publish'){
            return back()->with('error', 'Once You Publish Project You Can\'t Update That');
        }

        // Project Cost Calculation
        $total_participant_incentive = $request->participant_incentive * $request->target_participant;
        $total_service_fee = $total_participant_incentive/2;
        $total_cost  = $total_participant_incentive + $total_service_fee;

        //Adjusting Project Fields
        $project->user_id = $user_id;
        $project->my_project_name = $request->my_project_name;
        $project->study_title = $request->study_title;
        $project->study_description = $request->study_description;
        $project->target_audience = $request->target_audience;
        $project->project_type = $request->project_type;
        $project->research_type = $request->research_type;
        $project->required_time = $request->required_time;
        $project->participant_incentive = $request->participant_incentive;
        $project->target_participant = $request->target_participant;
        $project->total_incentive = $total_participant_incentive;
        $project->total_service_fee = $total_service_fee;
        $project->total_coast = $total_cost;
        $project->status = $request->status;

        if ($request->has('schedule_date')){
            $project->published_at = Carbon::createFromFormat('Y-m-d\TH:i', $request->schedule_date);
        }

        $project->update();

        // Creating New Project Topics belongsToProject
        if ($request->target_audience == 'b2c'){
            if ($request->project_topic !== null){
                $project_topic = ProjectHasProjectTopic::where('project_id', '=', $project->id)->first();
                $project_topic->project_topic = json_encode($request->project_topic);
                $project_topic->update();
            }
        }

        // Creating New Industries belongsToProject
        if ($request->industry !== null){
            $new_industry = ProjectHasIndustry::where('project_id', '=', $project->id)->first();
            $new_industry->industries = json_encode($request->industry);
            $new_industry->update();
        }

        // Creating New Company Size belongsToProject

        // Check if each element in the $request->company_size array is a string
        if (is_array($request->company_size)) {
            $filtered_company_sizes = array_filter($request->company_size, 'is_string');

            // Convert the array to JSON
            $company_sizes_json = json_encode($filtered_company_sizes);

            // Save the JSON data in the database using the model
            $new_company_size = ProjectHasCompanySize::where('project_id', '=', $project->id)->first();
            $new_company_size->company_size = $company_sizes_json;
            $new_company_size->update();
        }

        // Creating New Cities Size belongsToProject

        $locations = [];
        $stateData = $request->states;
        $cityData = $request->cities;

        // Combine the state and city data into a single array
        $locations = [];
        foreach ($stateData as $index => $states) {
            $cities = $cityData[$index];

            if (count($states) > 0 && count($cities) > 0) {
                $locations[] = [
                    'state' => $states[0], // Access the first element of the nested array
                    'city' => $cities[0], // Access the first element of the nested array
                ];
            }
        }
        $locationJson = json_encode($locations);
        $new_location = ProjectHasLocation::where('project_id', '=', $project->id)->first();
        $new_location->locations = $locationJson;
        $new_location->update();

        // Creating New Skills belongsToProject
        if ($request->skills !== null){
            $skillIds = [];

            foreach ($request->skills as $skill){
                $findSkill = Skill::where('skill_name', $skill)->first();
                if ($findSkill) {
                    $skillIds[] = $findSkill->id;
                }
            }
            $json_skills = json_encode($skillIds);
            $new_skills = ProjectHasSkill::where('project_id', '=', $project->id)->first();
            $new_skills->skills = $json_skills;
            $new_skills->update();
        }

        // Creating New Household Income belongsToProject
        // Check if each element in the $request->household_income array is a string
        if (is_array($request->household_income)) {
            $filtered_household_incomes = array_filter($request->household_income, 'is_string');

            // Convert the array to JSON
            $household_income_json = json_encode($filtered_household_incomes);

            // Save the JSON data in the database using the model
            $new_household_income = ProjectHasHouseholdIncome::where('project_id', '=', $project->id)->first();
            $new_household_income->household_income = $household_income_json;
            $new_household_income->update();
        }

        // Creating New Gender belongsToProject
        // Check if each element in the $request->gender array is a string
        if (is_array($request->gender)) {
            $filtered_genders = array_filter($request->gender, 'is_string');

            // Convert the array to JSON
            $gender_json = json_encode($filtered_genders);

            // Save the JSON data in the database using the model
            $new_gender = ProjectHasGender::where('project_id', '=', $project->id)->first();
            $new_gender->gender = $gender_json;
            $new_gender->update();
        }

        // Creating New Education Level belongsToProject
        // Check if each element in the $request->education_level array is a string
        if (is_array($request->education_level)) {
            $filtered_education_levels = array_filter($request->education_level, 'is_string');

            // Convert the array to JSON
            $education_level_json = json_encode($filtered_education_levels);

            // Save the JSON data in the database using the model
            $new_education_level = ProjectHasEducationLevel::where('project_id', '=', $project->id)->first();
            $new_education_level->education_level = $education_level_json;
            $new_education_level->update();
        }

        // Creating New Ethnicity belongsToProject
        // Check if each element in the $request->ethnicity array is a string
        if (is_array($request->ethnicity)) {
            $filtered_ethnicities = array_filter($request->ethnicity, 'is_string');

            // Convert the array to JSON
            $ethnicity_json = json_encode($filtered_ethnicities);

            // Save the JSON data in the database using the model
            $new_ethnicity = ProjectHasEthnicity::where('project_id', '=', $project->id)->first();
            $new_ethnicity->ethnicity = $ethnicity_json;
            $new_ethnicity->update();
        }

        // Creating New Age Range belongsToProject
        // Check if each element in the $request->age_range array is a string
        if (is_array($request->age_range)) {
            $filtered_age_ranges = array_filter($request->age_range, 'is_string');

            // Convert the array to JSON
            $age_range_json = json_encode($filtered_age_ranges);

            // Save the JSON data in the database using the model
            $new_age_range = ProjectHasAgeRange::where('project_id', '=', $project->id)->first();
            $new_age_range->age_range = $age_range_json;
            $new_age_range->update();
        }

        // Creating New Questions belongsToProject
        if ($request->has('question_name')){
            $new_project_question = ProjectHasQuestion::where('project_id', '=', $project->id)->first();
            $question_name = $request->question_name;
            $question_type = $request->question_type;
            $required = $request->required;
            $answer = $request->answer;
            $answer_qualify = $request->answer_qualify;
            $min_value = $request->min_value;
            $max_value = $request->max_value;
            $steps = $request->steps;

            $combinedArray = [];

            foreach ($question_name as $index => $name) {
                $combinedArray[] = [
                    'question_name' => $name,
                    'question_type' => isset($question_type[$index]) ? $question_type[$index] : null,
                    'required' => isset($required[$index]) ? $required[$index] : null,
                    'answer' => isset($answer[$index]) ? $answer[$index] : null,
                    'answer_qualify' => isset($answer_qualify[$index]) ? $answer_qualify[$index] : null,
                    'min_value' => isset($min_value[$index]) ? $min_value[$index] : null,
                    'max_value' => isset($max_value[$index]) ? $max_value[$index] : null,
                    'steps' => isset($steps[$index]) ? $steps[$index] : null,
                ];
            }
            $json_questions = json_encode($combinedArray);

            $new_project_question->questions = $json_questions;
            $new_project_question->update();
        }

        return redirect()->route('project.index')->with('success', 'Your Project Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findProject = Projects::find($id);
        $findProject->delete();
        return back()->with('info', 'Project Deleted Successfully');
    }
}
