<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\ResearcherBilling;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index(){
        $histories = ResearcherBilling::where('user_id', '=', Auth::id())->orderByDesc('created_at')->with('project')->paginate(10);
        return view('backend.pages.billing-center', compact('histories'));
    }
}
