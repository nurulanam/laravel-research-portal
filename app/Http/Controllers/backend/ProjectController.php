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
use App\Models\backend\ProjectHasProjectTopic;
use App\Models\backend\ProjectHasQuestion;
use App\Models\backend\ProjectHasSkill;
use App\Models\backend\Projects;
use App\Models\backend\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Projects::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->paginate(5);
        return view('backend.pages.all-projects', compact('projects'));
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
           'internal_name' => 'required|string',
           'project_title' => 'required|string',
           'project_details' => 'required|string',
           'audience' => 'required|string',
           'project_topic' => 'nullable|array|max:2',
           'project_topic.*' => 'string',
           'research_type' => 'required|string',
           'research_method' => 'nullable|string',
           'required_time' => 'nullable|numeric',
           'incentive' => 'required|numeric',
           'target_participant' => 'required',
           'industry' => 'required|array|max:5',
           'industry.*' => 'string',
           'company_size' => 'nullable|array',
           'company_size.*' => 'string',
           'cities' => 'nullable|array',
           'cities.*' => 'string',
           'skills' => 'nullable|array|max:25',
           'skills.*' => 'string',
           'household_income' => 'nullable|array',
           'household_income.*' => 'string',
           'gender' => 'nullable|array',
           'gender.*' => 'string',
           'education_level' => 'nullable|array',
           'education_level.*' => 'string',
           'ethnicity' => 'nullable|array',
           'ethnicity.*' => 'string',
           'age_range' => 'nullable|array',
           'age_range.*' => 'string',
           'status' => 'required',
        ]);
        // User Info
        $user_id = Auth::id();

        // Project Cost Calculation
        $total_incentive = $request->incentive * $request->target_participant;
        $total_service_fee  = $total_incentive/2;
        $total_cost  = $total_incentive + $total_service_fee;

        // Creating New Project
        $project = new Projects();

        //Adjusting Project Fields
        $project->user_id = $user_id;
        $project->internal_name = $request->internal_name;
        $project->project_title = $request->project_title;
        $project->project_details = $request->project_details;
        $project->audience = $request->audience;
        $project->research_type = $request->research_type;
        $project->research_method = $request->research_method;
        $project->required_time = $request->required_time;
        $project->incentive = $request->incentive;
        $project->target_participant = $request->target_participant;
        $project->total_incentive = $total_incentive;
        $project->total_service_fee = $total_service_fee;
        $project->total_coast = $total_cost;
        $project->slug = $this->createSlug($request->project_title);

        $project->status = $request->status;
        $project->save();

        // Creating New Project Topics belongsToProject
        if ($request->audience == 'b2c'){
            if ($request->project_topic !== null){
                foreach ($request->project_topic as $topic){
                    $new_project_topic = new ProjectHasProjectTopic();
                    $new_project_topic->project_id = $project->id;
                    $new_project_topic->project_topic = $topic;
                    $new_project_topic->save();
                }
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
        if ($request->company_size !== null){
            foreach ($request->company_size as $company_size){
                $new_company_size = new ProjectHasCompanySize();
                $new_company_size->project_id = $project->id;
                $new_company_size->company_size = $company_size;
                $new_company_size->save();
            }
        }

        // Creating New Company Size belongsToProject
        if ($request->cities !== null){
            foreach ($request->cities as $city){
                $new_cities = new ProjectHasCity();
                $new_cities->project_id = $project->id;
                $new_cities->city_name = $city;
                $new_cities->save();
            }
        }

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
        if ($request->household_income !== null){
            foreach ($request->household_income as $household_income){
                $new_household_income = new ProjectHasHouseholdIncome();
                $new_household_income->project_id = $project->id;
                $new_household_income->household_income = $household_income;
                $new_household_income->save();
            }
        }

        // Creating New Gender belongsToProject
        if ($request->gender !== null){
            foreach ($request->gender as $gender){
                $new_gender = new ProjectHasGender();
                $new_gender->project_id = $project->id;
                $new_gender->gender = $gender;
                $new_gender->save();
            }
        }

        // Creating New Education Level belongsToProject
        if ($request->education_level !== null){
            foreach ($request->education_level as $education_level){
                $new_education_level = new ProjectHasEducationLevel();
                $new_education_level->project_id = $project->id;
                $new_education_level->education_level = $education_level;
                $new_education_level->save();
            }
        }

        // Creating New Ethnicity belongsToProject
        if ($request->ethnicity !== null){
            foreach ($request->ethnicity as $ethnicity){
                $new_ethnicity = new ProjectHasEthnicity();
                $new_ethnicity->project_id = $project->id;
                $new_ethnicity->ethnicity = $ethnicity;
                $new_ethnicity->save();
            }
        }

        // Creating New Age Range belongsToProject
        if ($request->age_range !== null){
            foreach ($request->age_range as $age_range){
                $new_age_range = new ProjectHasAgeRange();
                $new_age_range->project_id = $project->id;
                $new_age_range->age_range = $age_range;
                $new_age_range->save();
            }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
