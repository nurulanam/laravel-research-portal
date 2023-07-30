<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasQuestion;
use App\Models\backend\Projects;
use Illuminate\Http\Request;
use App\Models\backend\ProjectHasResponse;

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
     */
    public function store(Request $request, $slug)
    {
        $findProject = Projects::where('slug', $slug)->first();
        if ($findProject) {
            $findQuestions = ProjectHasQuestion::where('project_id', $findProject->id)->first();
            if ($findQuestions) {
                $questions = json_decode($findQuestions->questions, true);
                $userResponses = [];
                $overallQualification = 'qualify';
                foreach ($questions as $q => $question) {
                    $questionType = $question['question_type'][0];
                    $userResponse = $request->input($questionType . '.' . $q, []);

                    if (!is_array($userResponse)) {
                        $userResponse = [$userResponse];
                    }

                    $qualification = 'qualify'; // Default qualification

                    if ($questionType === 'checkbox' && isset($question['answer_qualify'])) {
                        $expectedAnswers = $question['answer_qualify'];

                        if (!empty($expectedAnswers)) {
                            // Check if any expected answer is set to 'disqualify' and present in the userResponse
                            foreach ($expectedAnswers as $index => $expectedAnswer) {
                                if ($expectedAnswer === 'disqualify' && in_array($question['answer'][$index], $userResponse)) {
                                    $qualification = 'disqualify';
                                    $overallQualification = 'disqualify';
                                    break;
                                }
                            }
                        }
                    }

                    $userResponses[] = [
                        'question' => $question['question_name'][0],
                        'question_type' => $questionType,
                        'response' => $userResponse,
                    ];

                    // If the overall qualification is already 'disqualify', no need to check further
                    if ($overallQualification === 'disqualify') {
                        break;
                    }
                }
                $userResponseModel = new ProjectHasResponse();
                $userResponseModel->project_id = $findProject->id;
                $userResponseModel->user_id = auth()->user()->id; // Assuming you have authenticated users
                $userResponseModel->user_response = json_encode($userResponses);
                $userResponseModel->qualification = $overallQualification; // Set the 'qualification' directly in $userResponseModel

                $userResponseModel->save();
                return back()->with('success', 'response saved');

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
