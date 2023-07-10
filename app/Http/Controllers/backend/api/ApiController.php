<?php

namespace App\Http\Controllers\backend\api;

use App\Http\Controllers\Controller;
use App\Models\backend\ProjectHasIndustry;
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
//    public function projectShowApi($id){
//        $projectInfo = Projects::find($id);
//        $industries = config('app.industries');
//
//        if ($projectInfo){
//            $findProjectSkills = ProjectHasSkill::where('project_id', '=', $projectInfo->id)->first();
//            $findProjectIndustries = ProjectHasIndustry::where('project_id', '=', $projectInfo->id)->first();
//            if ($findProjectIndustries){
//                $projectIndustryIds = json_decode($findProjectIndustries['industries']);
//                $projectIndustryNames = [];
//                foreach ($projectIndustryIds as $index) {
//                    if (isset($industries[$index])) {
//                        $projectIndustryNames[] = $industries[$index];
//                    }
//                }
//                return response()->json(
//                    [
//                        'data' => $projectInfo,
//                        'industries' => $projectIndustryNames
//                    ]
//                );
//            }elseif ($findProjectSkills){
//                $projectSkillIds = json_decode($findProjectSkills['skills']);
//                if (count($projectSkillIds) > 0){
//                    $projectSkills = Skill::whereIn('id', $projectSkillIds)->get();
//                    return response()->json(
//                        [
//                            'data' => $projectInfo,
//                            'skills' => $projectSkills
//                        ]
//                    );
//                }
//            }else{
//                return response()->json(
//                    [
//                        'data' => $projectInfo
//                    ]
//                );
//            }
//
//        }
//
//
//    }
    public function projectShowApi($id)
    {
        $projectInfo = Projects::find($id);
        $industries = config('app.industries');

        if ($projectInfo) {
            $findProjectSkills = ProjectHasSkill::where('project_id', $projectInfo->id)->first();
            $findProjectIndustries = ProjectHasIndustry::where('project_id', $projectInfo->id)->first();

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

            return response()->json($response);
        }
    }

}
