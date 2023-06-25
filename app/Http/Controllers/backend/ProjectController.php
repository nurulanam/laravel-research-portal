<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasCity;
use App\Models\backend\ProjectHasCompanySize;
use App\Models\backend\ProjectHasIndustry;
use App\Models\backend\ProjectHasProjectTopic;
use App\Models\backend\ProjectHasSkill;
use App\Models\backend\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
           'status' => 'required',
        ]);
//        dd($request->industry);
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

        $project->status = $request->status;
        $project->save();

        // Creating New Project Topics belongsToProject
        if ($request->project_topic !== null){
            foreach ($request->project_topic as $topic){
                $project_topic = new ProjectHasProjectTopic();
                $project_topic->project_id = $project->id;
                $project_topic->project_topic = $topic;
                $project_topic->save();
            }
        }

        // Creating New Industires belongsToProject
        if ($request->industry !== null){
            foreach ($request->industry as $industry){
                $project_topic = new ProjectHasIndustry();
                $project_topic->project_id = $project->id;
                $project_topic->industry_name = $industry;
                $project_topic->save();
            }
        }
        // Creating New Company Size belongsToProject
        if ($request->industry !== null){
            foreach ($request->company_size as $company_size){
                $project_topic = new ProjectHasCompanySize();
                $project_topic->project_id = $project->id;
                $project_topic->company_size = $company_size;
                $project_topic->save();
            }
        }

        // Creating New Company Size belongsToProject
        if ($request->cities !== null){
            foreach ($request->cities as $city){
                $project_topic = new ProjectHasCity();
                $project_topic->project_id = $project->id;
                $project_topic->city_name = $city;
                $project_topic->save();
            }
        }

        // Creating New Skills belongsToProject
        if ($request->skills !== null){
            foreach ($request->skills as $skill){
                $project_topic = new ProjectHasSkill();
                $project_topic->project_id = $project->id;
                $project_topic->skill_name = $skill;
                $project_topic->save();
            }
        }

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
        //
    }
}
