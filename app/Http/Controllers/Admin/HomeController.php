<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Gate;
use Auth;
use Session;
use Symfony\Component\HttpFoundation\Response;
class HomeController
{
    public function index()
    {
        $sessionCounselorid = Auth::user()->id;
        $getCounselorActive = User::where('id',$sessionCounselorid)->first();
        return view('home', compact('getCounselorActive','sessionCounselorid'));
    }
}
