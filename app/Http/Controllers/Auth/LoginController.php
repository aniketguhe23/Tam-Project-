<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth; 
use App\Models\FcmToken;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }

    /* added */
    public function logout(Request $request) {
       
        $sessionCounselorid = Auth::user()->id;
        $getFcmTokens = FcmToken::where('user_id', $sessionCounselorid)->first();
        if(!empty($getFcmTokens))
        {
            $removeFcmToken = FcmToken::where('user_id', $getFcmTokens->user_id)->delete();
        }
        Auth::logout();
        return redirect('/login');
    }
}
