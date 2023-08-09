<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Profile;
use App\Models\backend\Skill;
use App\Models\backend\UserHasIndustry;
use App\Models\backend\userHasSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public $us_states = [];
    public $industries = [];
    public function __construct()
    {
        $this->us_states = config('app.us_states');
        $this->industries = config('app.industries');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $us_states = $this->us_states;
        $industries = $this->industries;

        $user_id = Auth::id();

        $profileInfo = Profile::where('user_id', '=' , $user_id)->first();
        $findProfileIndustry = UserHasIndustry::where('user_id', '=', $user_id)->first();
        $findUserSkills = userHasSkills::where('user_id', '=', $user_id)->first();


        if (!empty($findProfileIndustry) && !empty($findUserSkills)){
            $profileIndustry = json_decode($findProfileIndustry['industry']);
            $userHasSkills = json_decode($findUserSkills['skills']);
            $userSkills = Skill::whereIn('id', $userHasSkills)->get();
            return view('backend.pages.profile', compact('us_states', 'industries', 'profileInfo', 'profileIndustry', 'userSkills'));
        }elseif(!empty($findProfileIndustry)){
            $profileIndustry = json_decode($findProfileIndustry['industry']);
            return view('backend.pages.profile', compact('us_states', 'industries', 'profileInfo', 'profileIndustry'));
        }elseif(!empty($findUserSkills)){
            $userHasSkills = json_decode($findUserSkills['skills']);
            $userSkills = Skill::whereIn('id', $userHasSkills)->get();
            return view('backend.pages.profile', compact('us_states', 'industries', 'profileInfo', 'userSkills'));
        }else{
            return view('backend.pages.profile', compact('us_states', 'industries', 'profileInfo'));
        }
    }
    public static function showAvatar(){
        $user_id = Auth::id();
        return Profile::where('user_id', '=' , $user_id)->first();
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
    public function editContact(){

        $us_states = $this->us_states;
        $industries = $this->industries;

        $user_id = Auth::id();

        $profileInfo = Profile::where('user_id', '=' , $user_id)->first();
        $findProfileIndustry = UserHasIndustry::where('user_id', '=', $user_id)->first();
        $findUserSkills = userHasSkills::where('user_id', '=', $user_id)->first();


        if (!empty($findProfileIndustry) && !empty($findUserSkills)){
            $profileIndustry = json_decode($findProfileIndustry['industry']);
            $userHasSkills = json_decode($findUserSkills['skills']);
            $userSkills = Skill::whereIn('id', $userHasSkills)->get();
            return view('backend.pages.profile-edit-contact', compact('us_states', 'industries', 'profileInfo', 'profileIndustry', 'userSkills'));
        }elseif(!empty($findProfileIndustry)){
            $profileIndustry = json_decode($findProfileIndustry['industry']);
            return view('backend.pages.profile-edit-contact', compact('us_states', 'industries', 'profileInfo', 'profileIndustry'));
        }elseif(!empty($findUserSkills)){
            $userHasSkills = json_decode($findUserSkills['skills']);
            $userSkills = Skill::whereIn('id', $userHasSkills)->get();
            return view('backend.pages.profile-edit-contact', compact('us_states', 'industries', 'profileInfo', 'userSkills'));
        }else{
            return view('backend.pages.profile-edit-contact', compact('us_states', 'industries', 'profileInfo'));
        }
    }
    public function editDemographics(){
        if (Auth::user()->hasRole('participant')) {
            $us_states = $this->us_states;
            $industries = $this->industries;

            $user_id = Auth::id();

            $profileInfo = Profile::where('user_id', '=', $user_id)->first();
            $findProfileIndustry = UserHasIndustry::where('user_id', '=', $user_id)->first();
            $findUserSkills = userHasSkills::where('user_id', '=', $user_id)->first();


            if (!empty($findProfileIndustry) && !empty($findUserSkills)) {
                $profileIndustry = json_decode($findProfileIndustry['industry']);
                $userHasSkills = json_decode($findUserSkills['skills']);
                $userSkills = Skill::whereIn('id', $userHasSkills)->get();
                return view('backend.pages.profile-edit-demographics', compact('us_states', 'industries', 'profileInfo', 'profileIndustry', 'userSkills'));
            } elseif (!empty($findProfileIndustry)) {
                $profileIndustry = json_decode($findProfileIndustry['industry']);
                return view('backend.pages.profile-edit-demographics', compact('us_states', 'industries', 'profileInfo', 'profileIndustry'));
            } elseif (!empty($findUserSkills)) {
                $userHasSkills = json_decode($findUserSkills['skills']);
                $userSkills = Skill::whereIn('id', $userHasSkills)->get();
                return view('backend.pages.profile-edit-demographics', compact('us_states', 'industries', 'profileInfo', 'userSkills'));
            } else {
                return view('backend.pages.profile-edit-demographics', compact('us_states', 'industries', 'profileInfo'));
            }
        }else{
            return redirect()->route('profile.index')->with('error', 'Your Don\'t Have Permission');
        }


    }
    public function editEmployment(){
        $us_states = $this->us_states;
        $industries = $this->industries;

        $user_id = Auth::id();

        $profileInfo = Profile::where('user_id', '=' , $user_id)->first();
        $findProfileIndustry = UserHasIndustry::where('user_id', '=', $user_id)->first();
        $findUserSkills = userHasSkills::where('user_id', '=', $user_id)->first();


        if (!empty($findProfileIndustry) && !empty($findUserSkills)){
            $profileIndustry = json_decode($findProfileIndustry['industry']);
            $userHasSkills = json_decode($findUserSkills['skills']);
            $userSkills = Skill::whereIn('id', $userHasSkills)->get();
            return view('backend.pages.profile-edit-employment', compact('us_states', 'industries', 'profileInfo', 'profileIndustry', 'userSkills'));
        }elseif(!empty($findProfileIndustry)){
            $profileIndustry = json_decode($findProfileIndustry['industry']);
            return view('backend.pages.profile-edit-employment', compact('us_states', 'industries', 'profileInfo', 'profileIndustry'));
        }elseif(!empty($findUserSkills)){
            $userHasSkills = json_decode($findUserSkills['skills']);
            $userSkills = Skill::whereIn('id', $userHasSkills)->get();
            return view('backend.pages.profile-edit-employment', compact('us_states', 'industries', 'profileInfo', 'userSkills'));
        }else{
            return view('backend.pages.profile-edit-employment', compact('us_states', 'industries', 'profileInfo'));
        }
    }
    public function editSkill(){
        $us_states = $this->us_states;
        $industries = $this->industries;

        $user_id = Auth::id();

        $profileInfo = Profile::where('user_id', '=' , $user_id)->first();
        $findProfileIndustry = UserHasIndustry::where('user_id', '=', $user_id)->first();
        $findUserSkills = userHasSkills::where('user_id', '=', $user_id)->first();


        if (!empty($findProfileIndustry) && !empty($findUserSkills)){
            $profileIndustry = json_decode($findProfileIndustry['industry']);
            $userHasSkills = json_decode($findUserSkills['skills']);
            $userSkills = Skill::whereIn('id', $userHasSkills)->get();
            return view('backend.pages.profile-edit-skill', compact('us_states', 'industries', 'profileInfo', 'profileIndustry', 'userSkills'));
        }elseif(!empty($findProfileIndustry)){
            $profileIndustry = json_decode($findProfileIndustry['industry']);
            return view('backend.pages.profile-edit-skill', compact('us_states', 'industries', 'profileInfo', 'profileIndustry'));
        }elseif(!empty($findUserSkills)){
            $userHasSkills = json_decode($findUserSkills['skills']);
            $userSkills = Skill::whereIn('id', $userHasSkills)->get();
            return view('backend.pages.profile-edit-skill', compact('us_states', 'industries', 'profileInfo', 'userSkills'));
        }else{
            return view('backend.pages.profile-edit-skill', compact('us_states', 'industries', 'profileInfo'));
        }
    }
    public function storeSkill(Request $request){
        $request->validate([
            'skills' => 'required | array',
            'skills.*' => 'string | min:2'
        ]);

        $user_id = Auth::id();
        $requestSkills = $request->skills;
        $skillIds = [];

        foreach ($requestSkills as $skillName) {
            $skill = Skill::where('skill_name', $skillName)->first();

            if ($skill) {
                $skillIds[] = $skill->id;
            } else {
                $newSkill = new Skill();
                $newSkill->skill_name = $skillName;
                $newSkill->save();

                if ($newSkill) {
                    $skillIds[] = $newSkill->id;
                }
            }
        }

        $json = json_encode($skillIds);
        $findUserSkill = userHasSkills::where('user_id', '=', $user_id)->first();

        if ($findUserSkill !== null){
            $findUserSkill->skills = $json;
            $findUserSkill->update();
            return redirect()->route('profile.index')->with('success', 'Your Skills Updated');
        }elseif ($findUserSkill == null){
            $newUserSkill = new userHasSkills();
            $newUserSkill->user_id = $user_id;
            $newUserSkill->skills = $json;
            $newUserSkill->save();
            return redirect()->route('profile.index')->with('success', 'Your Skills Saved Successfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
    public function storeUserAvatar(Request $request){
        $request->validate([
            'user_avatar' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('user_avatar')) {
            $file = $request->file('user_avatar');
            $ext = $file->getClientOriginalExtension();
            $fileName = hexdec(uniqid()) . '.' . $ext;
            $img_host_path = public_path('backend/img/profile/');

            $user_id = Auth::id();
            $find_profile = Profile::where('user_id', '=', $user_id)->first();

            if (!$find_profile) {
                $find_profile = new Profile();
                $find_profile->user_id = $user_id;
                $message = 'Profile Picture Saved';
            } else {
                $existing_profile_avatar = $img_host_path . $find_profile->user_avatar;
                if (File::exists($existing_profile_avatar)) {
                    File::delete($existing_profile_avatar);
                }
                $message = 'Profile Picture Updated';
            }

            $avatar = Image::make($file);
            $avatar->resize(400, 400, function ($image) {
                $image->aspectRatio();
            })->save($img_host_path . $fileName);

            $find_profile->user_avatar = $fileName;
            $find_profile->save();

            return redirect()->back()->with('success', $message);
        }
    }
    public function storeContactDetails(Request $request){
        $user_id = Auth::id();
        $find_profile = Profile::where('user_id', '=' , $user_id)->first();
        if (Auth::user()->hasRole('participant')){
            $request->validate([
                    'phone' => 'nullable|numeric|digits:10',
                    'paypal_email' => 'required|email',
                    'state' => 'required|string',
                    'city' => 'required|string',
                    'zip_code' => 'required|integer',
                ]);
            if ($find_profile !== null){
                if ($request->phone !== null){
                    $find_profile->phone = $request->phone;
                }else{
                    $find_profile->phone = '';
                }
                $find_profile->paypal_email = $request->paypal_email;
                $find_profile->state = $request->state;
                $find_profile->city = $request->city;
                $find_profile->zip_code = $request->zip_code;
                $find_profile->update();
                return redirect()->route('profile.index')->with('success', 'Contact Information Updated');

            }elseif ($find_profile == null){
                $profile = new Profile();
                $profile->user_id = $user_id;
                if ($request->phone !== null){
                    $profile->phone = $request->phone;
                }
                $profile->paypal_email = $request->paypal_email;
                $profile->state = $request->state;
                $profile->city = $request->city;
                $profile->zip_code = $request->zip_code;
                $profile->save();
                return redirect()->route('profile.index')->with('success', 'Contact Information Saved');
            }
        }elseif(Auth::user()->hasRole('researcher')){
            $request->validate([
                'phone' => 'required|numeric|digits:10',
            ]);
            if ($find_profile !== null){
                $find_profile->phone = $request->phone;
                $find_profile->update();
                return redirect()->route('profile.index')->with('success', 'Contact Information Updated');
            }elseif ($find_profile == null){
                $profile = new Profile();
                $profile->user_id = $user_id;
                $profile->phone = $request->phone;
                $profile->save();
                return redirect()->route('profile.index')->with('success', 'Contact Information Saved');
            }
        }
    }
    public function storeDemographics(Request $request)
    {
        if (Auth::user()->hasRole('participant')) {
        $user_id = Auth::id();
        $find_profile = Profile::where('user_id', '=', $user_id)->first();
        $request->validate([
            'gender' => 'required|string',
            'date_of_birth' => 'required|date|before:18 years ago',
            'ethnicity' => 'required|string',
            'education_level' => 'required|string',
            'household_income' => 'required|string',
            'marital_status' => 'required|string',
            'children_in_living' => 'required|string',
        ],
            [
                'before' => 'You must be at least 18 years old',
            ]);

        if ($find_profile !== null) {
            if (Auth::user()->hasRole('participant')) {
                if ($find_profile->status == 'active') {
                    $find_profile->gender = $request->gender;
                    $find_profile->date_of_birth = $request->date_of_birth;
                    $find_profile->ethnicity = $request->ethnicity;
                    $find_profile->education_level = $request->education_level;
                    $find_profile->household_income = $request->household_income;
                    $find_profile->marital_status = $request->marital_status;
                    $find_profile->children_in_living = $request->children_in_living;
                    $find_profile->status = 'deactivate';
                    $find_profile->update();
                    return redirect()->route('profile.index')->with('success', 'Your Demographics Updated');
                }elseif($find_profile->status == 'deactivate'){
                    return redirect()->route('profile.index')->with('error', 'You Can\'t Change Demographics Please Contact With Our Support Team');
                }
            }
        }elseif($find_profile == null){
            $profile = new Profile();
            $profile->user_id = $user_id;
            $profile->gender = $request->gender;
            $profile->date_of_birth = $request->date_of_birth;
            $profile->ethnicity = $request->ethnicity;
            $profile->education_level = $request->education_level;
            $profile->household_income = $request->household_income;
            $profile->marital_status = $request->marital_status;
            $profile->children_in_living = $request->children_in_living;
            $profile->status = 'deactivate';
            $profile->save();
            return redirect()->route('profile.index')->with('success', 'Your Demographics Saved');
        }
        }else{
            return redirect()->route('profile.index')->with('error', 'Your Don\'t Have Permission');
        }
    }
    public function storeEmployment(Request $request){
        $user_id = Auth::id();
        $find_profile = Profile::where('user_id', '=' , $user_id)->first();

        $request->validate([
            'company_name' => 'required|string',
            'company_size' => 'required|string',
            'job_title' => 'required|string',
        ]);

        if (Auth::user()->hasRole('participant')) {
            $request->validate([
                'employment_status' => 'required|string',
                'industry' => 'required|array|max:5',
                'industry.*' => 'required|string',
            ]);
        } elseif (Auth::user()->hasRole('researcher')) {
            $request->validate([
                'industry' => 'required|string',
            ]);
        }
        if (!$find_profile) {
            $find_profile = new Profile();
            $find_profile->user_id = $user_id;
            $message = 'Employment Information Saved';
        } else {
            $message = 'Employment Information Updated';
        }
        $find_profile->company_name = $request->company_name;
        $find_profile->company_size = $request->company_size;
        $find_profile->job_title = $request->job_title;

        if (Auth::user()->hasRole('participant')) {
            $find_profile->employment_status = $request->employment_status;
        }

        $find_profile->save();

        $find_industry = UserHasIndustry::where('user_id', '=', $user_id)->first();
        if (!$find_industry) {
            $find_industry = new UserHasIndustry();
            $find_industry->user_id = $user_id;
        }

        $find_industry->industry = json_encode($request->industry);
        $find_industry->save();

        return redirect()->route('profile.index')->with('success', $message);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\backend\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\backend\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\backend\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\backend\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {

    }



}
