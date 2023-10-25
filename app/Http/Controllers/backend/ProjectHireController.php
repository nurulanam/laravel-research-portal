<?php

namespace App\Http\Controllers\backend;

use App\Events\ParticipantHireAccepted;
use App\Events\ParticipantHireDenied;
use App\Events\ParticipantInvited;
use App\Events\ParticipantRejected;
use App\Events\ParticipantZoomLinkSend;
use App\Events\ParticipantHired;
use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasResponse;
use App\Models\backend\Projects;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
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

    public function projectInvite($slug , $id){
        $project = Projects::where('slug', '=', $slug)->where('user_id', '=', Auth::id())->first();
        if (isset($project)){
            $response = ProjectHasResponse::where('project_id', '=', $project->id)->where('user_id', '=', $id)->first();
            if (isset($response)){
                if ($response->status == 'submitted'){
                    ParticipantInvited::dispatch($project->id, $id);
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
                 $findResponse->status = 'accepted';
                 $findResponse->update();
                 ParticipantHireAccepted::dispatch($findResponse->project->my_project_name, $findResponse->user_id, $findResponse->project->user_id);
                 return redirect()->route('project.index')->with('success', 'You accepted successfully');
             }else{
                 return redirect()->back()->with('error', 'Sorry! Already accepted');
             }
         }else{
             return redirect()->route('project.index')->with('error', 'Your response not found');
         }
    }
    public function projectDeny($id){
         $findResponse = ProjectHasResponse::where('id', '=', $id)->where('user_id', '=', Auth::id())->first();
         if (isset($findResponse)){
             if ($findResponse->status == 'invited'){
                 $findResponse->status = 'denied';
                 $findResponse->update();
                 ParticipantHireDenied::dispatch($findResponse->project->my_project_name, $findResponse->user_id, $findResponse->project->user_id);
                 return redirect()->route('project.index')->with('success', 'You are successfully denied the project');
             }else{
                 return redirect()->back()->with('error', 'Sorry! Already denied');
             }
         }else{
             return redirect()->route('project.index')->with('error', 'Your response not found');
         }
    }


    /**
     * Send Zoom meeting link to participant
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendZoomLink(Request $request, $slug, $id)
    {
        $request->validate(
            [
                'meeting_id' => 'required|numeric',
                'passcode' => 'required|string',
                'schedule_date_time' => 'required|date'
            ]
        );
        $project = Projects::where('slug', '=', $slug)->where('user_id', '=', Auth::id())->first();
        if (isset($project)) {
            $findResponse = ProjectHasResponse::where('project_id', '=', $project->id)->where('user_id', '=', $id)->first();
            if (isset($findResponse)) {
                $carbonDateTime = Carbon::parse($request->schedule_date_time);
                $formattedDateTime = $carbonDateTime->format('M d, Y h:i A T');
                if ($findResponse->status == 'accepted') {
                    ParticipantZoomLinkSend::dispatch($findResponse, $request->meeting_id, $request->passcode, $formattedDateTime);
                    $findResponse->status = 'scheduled';
                    $findResponse->update();
                    return redirect()->back()->with('success', 'Participant invited successfully for meeting');
                } else {
                    return redirect()->back()->with('error', 'Sorry can\'t send meeting invitation for now');
                }
            }else {
                return redirect()->back()->with('error','Response not found.');
            }
        }else{
            return redirect()->back()->with('error', 'Sorry request invalid');
        }
    }
    /**
     * Hire participant for project
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function projectHire($slug, $id){
        $project = Projects::where('slug', '=', $slug)->where('user_id', '=', Auth::id())->first();
        if (isset($project)){
            $response = ProjectHasResponse::where('project_id', '=', $project->id)->where('user_id', '=', $id)->first();
            if (isset($response)){
                if ($response->status == 'scheduled'){
                    ParticipantHired::dispatch($project->id, $id);
                    $response->status = 'hired';
                    $response->update();
                    return redirect()->back()->with('success', 'Participant hired send successfully');
                }else{
                    return redirect()->back()->with('error','Sorry! Already hired');
                }
            }else {
                return redirect()->back()->with('error','Response not found.');
            }
        }else {
            return redirect()->back()->with('error','Project not found.');
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
