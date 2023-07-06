<?php

namespace App\Http\Controllers\backend\api;

use App\Http\Controllers\Controller;
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

    }
}
