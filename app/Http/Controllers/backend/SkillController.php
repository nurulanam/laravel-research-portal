<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Skill;
use App\Models\backend\userHasSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
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
        $request->validate([
            'skills' => 'required | array',
            'skills.*' => 'numeric'
        ]);
        $user_id = Auth::id();

        $findUserSkill = userHasSkills::where('user_id', '=', $user_id)->first();
        if ($findUserSkill !== null){
            $findUserSkill->delete();
        }
        $skills = json_encode($request->skills);
        $newUserSkill = new userHasSkills();
        $newUserSkill->user_id = $user_id;
        $newUserSkill->skills = $skills;
        $newUserSkill->save();


        return back()->with('success', 'Your Skills Saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\backend\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\backend\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\backend\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\backend\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
    }



    public function skillsApi(Request $request)
    {

        $search = $request->search;
        $skills = Skill::orderby('skill_name', 'asc')->select('id', 'skill_name')->where('skill_name', 'like', '%' . $search . '%')->get()->toArray();

        return response()->json([
            'options' => $skills,
        ]);
    }
}
