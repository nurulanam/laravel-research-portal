<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasMessage;
use App\Models\backend\ProjectHasResponse;
use App\Models\backend\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectHasMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        if (Auth::user()->hasRole('participant')){
            $response = ProjectHasResponse::where('user_id', '=', $user_id)->whereIn('status', ['hired', 'paid'])->get();
            $projectIds = $response->pluck('project_id')->toArray();

            $projectQuery = Projects::where('status', 'publish');
            if (is_array($projectIds)) {
                $projects = $projectQuery->whereIn('id', $projectIds)->get();
            } else {
                $projects = $projectQuery->where('id', $projectIds)->get();
            }
        }elseif (Auth::user()->hasRole('researcher')){
            $projects = Projects::where('user_id', '=', $user_id)->where('status', '=' ,'publish')->get();
        }

        return  view('backend.pages.project-messages', compact('projects'));
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
     * @param  string $message
     * @param  int $project_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $message = $request->message;
        $project_id = $request->projectId;

        if (isset($message, $project_id)){
            $find_response = ProjectHasResponse::where('project_id', '=', $project_id)->where('user_id', '=', $user_id)->first();
            $find_project = Projects::where('id', '=', $project_id)->where('user_id', '=', $user_id)->first();
            if (isset($find_response) && ($find_response->status == 'hired' || $find_response->status == 'paid')) {
                $new_message = new ProjectHasMessage();
                $new_message->user_id = $user_id;
                $new_message->project_id = $project_id;
                $new_message->message = $message;
                $new_message->save();
                if (isset($new_message)){
                    return response()->json([
                        'data' => 'Message send',
                        'status' => 'success'
                    ]);
                }else{
                    return response()->json([
                        'data' => 'Message not send',
                        'status' => 'error'
                    ]);
                }
            }elseif(isset($find_project)){
                $new_message = new ProjectHasMessage();
                $new_message->user_id = $user_id;
                $new_message->project_id = $project_id;
                $new_message->message = $message;
                $new_message->save();
                if (isset($new_message)){
                    return response()->json([
                        'data' => 'Message send',
                        'status' => 'success'
                    ]);
                }else{
                    return response()->json([
                        'data' => 'Message not send',
                        'status' => 'error'
                    ]);
                }
            }else{
                return response()->json([
                    'data' => 'Sorry, you are not a valid person',
                    'status' => 'error'
                ]);
            }
        }else{
            return response()->json([
                'data' => 'Message not send',
                'status' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $project_id = $request->projectId;

        if (isset($project_id)){
            $find_messages = ProjectHasMessage::where('project_id', '=', $project_id)->with('user')->get();
            if (count($find_messages) > 0){
                return response()->json([
                    'data' => $find_messages,
                    'status' => 'success'
                ]);
            }else{
                return response()->json([
                    'data' => 'Project Don\'t have any message',
                    'status' => 'error'
                ]);
            }
        }else{
            return response()->json([
                'data' => 'Project Not Found',
                'status' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {
        $project_id = $request->projectId;
        $message_id = $request->messageId;

        if (isset($project_id)){
            $find_messages = ProjectHasMessage::where('project_id', '=', $project_id)->where('id', '>', $message_id)->with('user')->get();
            if (count($find_messages) > 0){
                return response()->json([
                    'data' => $find_messages,
                    'status' => 'success'
                ]);
            }else{
                return response()->json([
                    'data' => 'Project Don\'t have new message',
                    'status' => 'error'
                ]);
            }
        }else{
            return response()->json([
                'data' => 'Project Not Found',
                'status' => 'error'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\backend\ProjectHasMessage  $projectHasMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectHasMessage $projectHasMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\backend\ProjectHasMessage  $projectHasMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectHasMessage $projectHasMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\backend\ProjectHasMessage  $projectHasMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectHasMessage $projectHasMessage)
    {
        //
    }
}
