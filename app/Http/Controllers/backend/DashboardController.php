<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Industry;
use App\Models\backend\ProjectHasIndustry;
use App\Models\backend\ProjectHasResponse;
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
        $this->updateProjectStatus();

        if (Auth::user()->hasRole('participant')){
            $this->industries = config('app.industries');

            $userIndustries = UserHasIndustry::where('user_id', '=', Auth::id())->first();

            $query = Projects::where('status', '=', 'publish');

            $filterValues = [
                'target_audience' => $request->input('target_audience'),
                'project_type' => $request->input('project_type'),
                'min_incentive' => $request->input('min_incentive'),
                'max_incentive' => $request->input('max_incentive'),
                'min_time' => $request->input('min_time'),
                'max_time' => $request->input('max_time'),
            ];

            foreach ($filterValues as $filter => $value) {
                if (!empty($value)) {
                    if ($request->filled($filter)) {
                        if ($filter === 'min_incentive') {
                            $query->where('total_incentive', '>=', $value);
                        } elseif ($filter === 'max_incentive') {
                            $query->where('total_incentive', '<=', $value);
                        } elseif ($filter === 'min_time') {
                            $query->where('required_time', '>=', $value);
                        } elseif ($filter === 'max_time') {
                            $query->where('required_time', '<=', $value);
                        } else {
                            $query->where($filter, $value);
                        }
                    }
                }
            }

            if ($request->filled('search')) {
                $searchTerm = '%' . $request->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('study_title', 'like', $searchTerm)
                        ->orWhere('study_description', 'like', $searchTerm);
                });
            }

            $projects = $query->orderBy('created_at', 'desc')->paginate(2)->withQueryString();

            if ($userIndustries) {
                $userIndustryKeys = json_decode($userIndustries->industry, true);

                if (!empty($userIndustryKeys)) {
                    $projectIds = ProjectHasIndustry::select('project_id')
                        ->where(function ($query) use ($userIndustryKeys) {
                            foreach ($userIndustryKeys as $value) {
                                $query->orWhereJsonContains('industries', $value);
                            }
                        })
                        ->pluck('project_id');
                    $query->whereIn('id', $projectIds);
                }
            }
            $projects = $query->orderByDesc('created_at')->paginate(2)->withQueryString();

        return view('backend.pages.dashboard', compact('projects', 'filterValues', 'userIndustries'));

        }elseif (Auth::user()->hasRole('researcher')){
            return view('backend.pages.dashboard');
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

    public static function updateProjectStatus()
    {
        // Fetch all projects from the database
        Projects::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where('status', 'schedule')
            ->update(['status' => 'publish']);
    }
}
