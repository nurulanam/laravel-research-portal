<?php

namespace App\Http\Controllers\backend;

use App\Events\ParticipantHireAccepted;
use App\Events\ParticipantRejected;
use App\Events\ProjectHired;
use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasResponse;
use App\Models\backend\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectHireController extends Controller
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

    public function projectHire($slug , $id){
        $project = Projects::where('slug', '=', $slug)->where('user_id', '=', Auth::id())->first();
        if (isset($project)){
            $response = ProjectHasResponse::where('project_id', '=', $project->id)->where('user_id', '=', $id)->first();
            if (isset($response)){
                if ($response->status == 'submitted'){
                    ProjectHired::dispatch($project->id, $id);
                    $response->status = 'invited';
                    $response->update();
                    return redirect()->back()->with('success', 'Project invitation send successfully');
                }else{
                    return redirect()->back()->with('error','Sorry! Already Invited');
                }
            }else {
                return redirect()->back()->with('error','Response not found.');
            }
        }else {
            return redirect()->back()->with('error','Project not found.');
        }
    }
    public function projectReject($slug , $id){
        $project = Projects::where('slug', '=', $slug)->where('user_id', '=', Auth::id())->first();
        if (isset($project)){
            $response = ProjectHasResponse::where('project_id', '=', $project->id)->where('user_id', '=', $id)->first();
            if (isset($response)){
                if ($response->status == 'submitted'){
                    ParticipantRejected::dispatch($project->id, $id);
                    $response->status = 'rejected';
                    $response->update();
                    return redirect()->back()->with('success', 'Participant rejected successfully');
                }else{
                    return redirect()->back()->with('error','Sorry! Already rejected');
                }
            }else {
                return redirect()->back()->with('error','Response not found.');
            }
        }else {
            return redirect()->back()->with('error','Project not found.');
        }
    }
     public function projectAccept($id){
         $findResponse = ProjectHasResponse::where('id', '=', $id)->where('user_id', '=', Auth::id())->first();
         if (isset($findResponse)){
             if ($findResponse->status == 'invited'){
                 $findResponse->status = 'hired';
                 $findResponse->update();
                 ParticipantHireAccepted::dispatch($findResponse->project->my_project_name, $findResponse->user_id, $findResponse->project->user_id);
                 return redirect()->route('project.index')->with('success', 'You are hired successfully');
             }else{
                 return redirect()->back()->with('error', 'Sorry! Already hired');
             }
         }else{
             return redirect()->route('project.index')->with('error', 'Your response not found');
         }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
