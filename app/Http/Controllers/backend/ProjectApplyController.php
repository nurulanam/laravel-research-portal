<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasQuestion;
use App\Models\backend\ProjectHasResponse;
use App\Models\backend\Projects;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectApplyController extends Controller
{
    /**
     * There is no separate "apply" index; participants pick a study from the
     * dashboard.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('dashboard.index');
    }

    /**
     * Display the screener questions of the study a participant wants to apply for.
     */
    public function projectScreener(string $slug): View|RedirectResponse
    {
        $findProject = Projects::where('slug', $slug)->firstOrFail();

        $alreadyResponded = ProjectHasResponse::where('project_id', $findProject->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyResponded) {
            return redirect()->route('dashboard.index')->with('error', 'Already Participated');
        }

        $findQuestions = ProjectHasQuestion::where('project_id', $findProject->id)->first();

        if (! $findQuestions) {
            return redirect()->route('dashboard.index')->with('error', 'This study is not accepting responses.');
        }

        $questions = json_decode($findQuestions->questions);

        return view('backend.pages.project-apply', compact('findProject', 'questions'));
    }

    /**
     * Store the participant's screener answers.
     */
    public function store(Request $request, string $slug): RedirectResponse
    {
        $findProject = Projects::where('slug', $slug)->firstOrFail();

        $findQuestions = ProjectHasQuestion::where('project_id', $findProject->id)->first();

        if (! $findQuestions) {
            return redirect()->route('dashboard.index')->with('error', 'This study is not accepting responses.');
        }

        $questions = json_decode($findQuestions->questions, true) ?? [];
        $userResponses = [];

        foreach ($questions as $key => $question) {
            $questionType = $question['question_type'][0];
            $userResponse = $request->input($questionType.'.'.$key, []);

            if (! is_array($userResponse)) {
                $userResponse = [$userResponse];
            }

            if ($questionType === 'checkbox' && isset($question['answer_qualify'])) {
                $selectedIndexes = [];

                foreach ($userResponse as $index => $value) {
                    if (isset($question['answer'][$index])) {
                        $selectedIndexes[] = $index;
                    }
                }

                $userResponse = $selectedIndexes;
            } elseif (in_array($questionType, ['textarea', 'text', 'number', 'slider'], true)) {
                $userResponse = $request->input($questionType.'.'.$key);
            }

            $userResponses[] = [
                'response' => $userResponse,
            ];
        }

        $userResponseModel = new ProjectHasResponse();
        $userResponseModel->project_id = $findProject->id;
        $userResponseModel->user_id = $request->user()->id;
        $userResponseModel->user_response = json_encode($userResponses);
        $userResponseModel->save();

        return redirect()->route('dashboard.index')->with('success', 'Response Submitted');
    }
}
