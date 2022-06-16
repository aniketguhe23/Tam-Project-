<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Gate;
use Auth;
use Session;
use Symfony\Component\HttpFoundation\Response;

class DashboardControoler extends Controller
{
    public function counselorActivation()
    {
        $sessionCounselorid = Auth::user()->id;
        $getCounselorActive = User::where('id',$sessionCounselorid)
                                    ->get();
        return view('home', compact('getCounselorActive'));
    }
}
