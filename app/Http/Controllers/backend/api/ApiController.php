<?php

namespace App\Http\Controllers\backend\api;

use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasIndustry;
use App\Models\backend\ProjectHasProjectTopic;
use App\Models\backend\ProjectHasResponse;
use App\Models\backend\ProjectHasSkill;
use App\Models\backend\Projects;
use App\Models\backend\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{

    public function skillsApi(Request $request){
        $search = $request->search;

        $query = Skill::orderBy('skill_name', 'asc');

        $skills = $query->where(function ($query) use ($search) {
            if (is_numeric($search)) {
                $query->where('id', $search);
            } else {
                $query->where('skill_name', 'like', '%' . $search . '%');
            }
        })->select('id', 'skill_name')->get()->toArray();
        return response()->json([
            'options' => $skills,
        ]);
    }

    public function projectShowApi($projectId , $userId)
    {
        $projectInfo = Projects::find($projectId);
        $industries = config('app.industries');

        if ($projectInfo != null && $projectInfo->status == 'publish') {
            $findProjectSkills = ProjectHasSkill::where('project_id', $projectInfo->id)->first();
            $findProjectIndustries = ProjectHasIndustry::where('project_id', $projectInfo->id)->first();

            $findResponse = ProjectHasResponse::where('project_id', '=', $projectInfo->id)->get();
            $findParticipant = ProjectHasResponse::where('project_id', '=', $projectInfo->id)->where('user_id', '=', $userId)->first();
            $findProjectTopics = ProjectHasProjectTopic::where('project_id', '=', $projectInfo->id)->first();

            $response = [
                'data' => $projectInfo,
            ];

            if ($findProjectIndustries) {
                $projectIndustryIds = json_decode($findProjectIndustries->industries);
                $projectIndustryNames = [];
                foreach ($projectIndustryIds as $index) {
                    if (isset($industries[$index])) {
                        $projectIndustryNames[] = $industries[$index];
                    }
                }
                $response['industries'] = $projectIndustryNames;
            }

            if ($findProjectSkills) {
                $projectSkillIds = json_decode($findProjectSkills->skills);
                if (count($projectSkillIds) > 0) {
                    $projectSkills = Skill::whereIn('id', $projectSkillIds)->get();
                    $response['skills'] = $projectSkills;
                }
            }
            if ($findProjectTopics){
                $projectTopics = json_decode($findProjectTopics->project_topic);
                $response['topics'] = $projectTopics;
            }
            if ($findResponse){
                $response['totalResponse'] = count($findResponse);
            }
            if ($findParticipant){
                $response['applied'] = $findParticipant;
            }

            return response()->json($response);
        }else{
            return response()->json([
                'data' => 'error'
            ]);
        }
    }

}
