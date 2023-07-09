<?php

namespace App\Http\Controllers\backend\api;

use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasSkill;
use App\Models\backend\Projects;
use App\Models\backend\Skill;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function skillsApi(Request $request){
        $search = $request->search;
        $skills = Skill::orderby('skill_name', 'asc')->select('id', 'skill_name')->where('skill_name', 'like', '%' . $search . '%')->get()->toArray();

        return response()->json([
            'options' => $skills,
        ]);
    }
    public function projectShowApi($id){
        $projectInfo = Projects::find($id);

        if ($projectInfo){
            $findProjectSkills = ProjectHasSkill::where('project_id', '=', $projectInfo->id)->first();
            if ($findProjectSkills){
                $projectSkillIds = json_decode($findProjectSkills['skills']);
                if (count($projectSkillIds) > 0){
                    $projectSkills = Skill::whereIn('id', $projectSkillIds)->get();
                    return response()->json(
                        [
                            'data' => $projectInfo,
                            'skills' => $projectSkills
                        ]
                    );
                }
            }elseif ($findProjectSkills == null){
                return response()->json(
                    [
                        'data' => $projectInfo
                    ]
                );
            }

        }


    }
}
