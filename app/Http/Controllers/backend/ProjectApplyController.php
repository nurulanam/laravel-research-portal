<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasQuestion;
use App\Models\backend\Projects;
use Illuminate\Http\Request;
use App\Models\backend\ProjectHasResponse;
use Illuminate\Support\Facades\Auth;

class ProjectApplyController extends Controller
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

    public function projectScreener($slug){
        $findProject = Projects::where('slug', $slug)->first();

        $findParticipant = ProjectHasResponse::where('project_id', '=', $findProject->id)->where('user_id', '=', Auth::id())->first();
        if ($findParticipant){
            return redirect()->route('dashboard.index')->with('error', 'Already Participated');
        }
        if ($findProject) {
            // The project with the given slug exists
            $findQuestions = ProjectHasQuestion::where('project_id', $findProject->id)->first();

            if ($findQuestions) {
                $questions = json_decode($findQuestions->questions);
                return view('backend.pages.project-apply', compact('findProject', 'questions'));
            } else {
                // No questions found for the project
            }
        } else {
            // No project found with the given slug
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
     *
     */
    public function store(Request $request, $slug)
    {
        $findProject = Projects::where('slug', $slug)->first();


        if ($findProject) {
            $findQuestions = ProjectHasQuestion::where('project_id', $findProject->id)->first();
            if ($findQuestions) {
                $questions = json_decode($findQuestions->questions, true);
                $userResponses = [];
                $disqualifyFlag = false; // Flag to track if any response disqualifies the user

                foreach ($questions as $key => $question) {
                    $questionType = $question['question_type'][0];
                    $userResponse = null;
                    $userResponse = $request->input($questionType . '.' . $key, []);

                    if (!is_array($userResponse)) {
                        $userResponse = [$userResponse];
                    }

                    if ($questionType === 'checkbox' && isset($question['answer_qualify'])) {
                        $expectedAnswers = $question['answer_qualify'];
                        $selectedIndexes = [];

                        if (!empty($expectedAnswers)) {
                            foreach ($userResponse as $index => $value) {
                                if (isset($expectedAnswers[$index]) && $expectedAnswers[$index] === 'disqualify') {
                                    $disqualifyFlag = true;
                                }

                                if (isset($question['answer'][$index])) {
                                    $selectedIndexes[] = $index;
                                }
                            }
                        }
                        $userResponse = $selectedIndexes;

                    } elseif ($questionType === 'textarea' || $questionType === 'text' || $questionType === 'number' || $questionType === 'slider') {
                        $userResponse = $request->input($questionType . '.' . $key, null);
                    }

                    $userResponses[] = [
                        'response' => $userResponse,
                    ];
                }

                // Set the overall qualification to 'disqualify' if any disqualification occurs
                $overallQualification = $disqualifyFlag ? 'disqualify' : 'qualify';

                $userResponseModel = new ProjectHasResponse();
                $userResponseModel->project_id = $findProject->id;
                $userResponseModel->user_id = auth()->user()->id; // Assuming you have authenticated users
                $userResponseModel->user_response = json_encode($userResponses);
                $userResponseModel->qualification = $overallQualification; // Set the 'qualification' directly in $userResponseModel

                $userResponseModel->save();
                return redirect()->route('dashboard.index')->with('success', 'response saved');
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
