<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Industry;
use App\Models\backend\Projects;
use App\Models\backend\UserHasIndustry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Projects::where('status', '=', 'publish');

        if ($request->filled('search')){
            $query->where('project_title', 'like', '%' . $request->search . '%')->orWhere('project_details', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('audience')) {
            $query->where('audience', $request->audience);
        }

        if ($request->filled('research_type')) {
            $query->where('research_type', $request->research_type);
        }

        if ($request->filled('min_incentive')) {
            $query->where('total_incentive', '>=', $request->min_incentive);
        }

        if ($request->filled('max_incentive')) {
            $query->where('total_incentive', '<=', $request->max_incentive);
        }

        if ($request->filled('min_time')) {
            $query->where('required_time', '>=', $request->min_time);
        }

        if ($request->filled('max_time')) {
            $query->where('required_time', '<=', $request->max_time);
        }

        $projects = $query->orderBy('updated_at', 'desc')->paginate(2);

        return view('backend.pages.dashboard', compact('projects'));
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
        //
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
