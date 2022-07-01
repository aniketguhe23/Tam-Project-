<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuthApiController extends Controller
{
    public function login(Request $request) 
    {
        if(!empty($request->phone_no)){
            $user = User::where('phone_no', $request->phone_no)->where('status','0')->first();
        }
        if(!empty($request->email)){
            $user = User::where('email', $request->email)->where('status','0')->first();
        }

        if (!empty($user)) {
            if (Hash::check($request->token, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $user];
                return response([$response, 200,"message"=>'User Login Succsesfully....!','status'=>true]);
            } else {
                $response = ["message" => "token is not match",'status'=>FALSE];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist','status'=>FALSE];
            return response([$response, 422,'status'=>FALSE]);
        }
    }   


    
    public function register(Request $request) 
    {
        if(!empty($request->phone_no))
        {
            $checkUserMobileNo = User::where('phone_no',$request->phone_no)->where('status','0')->first();
            if(!empty($checkUserMobileNo))
            {
                $response = ['token' => $checkUserMobileNo,"message" => "Mobile Number Already Registred.....!",'status'=>FALSE];
                return response($response, 422);
            }
            else{
                    $checkUserEmail = User::where('email',$request->email)->where('status','0')->first();
                    if(!empty($checkUserEmail))
                    {
                        $response = ['token' => $checkUserEmail,"message" => "Email id Already Registerd....!",'status'=>FALSE];
                        return response($response, 422);
                    }
                    else
                    {
                        $userdata = array();
                        $request['password'] = Hash::make($request['token']);
                        $request['remember_token'] = Str::random(10);
                        $user = User::create($request->toArray());
                        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                    }
                }
        }else{
                $checkUserEmail = User::where('email',$request->email)->where('status','0')->first();
                if(!empty($checkUserEmail))
                {
                    $response = ['token' => $checkUserEmail,"message" => "Email id Already Registerd....!",'status'=>FALSE];
                    return response($response, 422);
                }
                else{
                    if(!empty($checkUserMobileNo))
                    {
                        $response = ['token' => $checkUserMobileNo,"message" => "Mobile Number Already Registred.....!",'status'=>FALSE];
                        return response($response, 422);
                    }
                    else
                    {
                        $request['password'] = Hash::make($request['token']);
                        $request['remember_token'] = Str::random(10);
                        $user = User::create($request->toArray());
                        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                    }
                    
                }
        }
        $response = ['token' => $user,"message" =>'User Registration Succsesfully....!','status'=>true];
        return response($response, 200);
    }


    public function profile(Request $request)
    {
        $userProfile = User::where('id',$request->user_id)->where('status','0')->first();
        if(!empty($userProfile))
        {
            $response = ['token' => $userProfile,"message" =>'User profile get record....!','status'=>true];
            return response($response, 200);
        }else
        {
            $response = ["message" => "User does not exisit.",'status'=>FALSE];
            return response($response, 422);
        }     
    }

    public function editProfile(Request $request)
    {
        $user = array();
        $userProfile = User::where('id',$request->user_id)->where('status','0')->first();
        if(!empty($userProfile))
        {
            $userProfileUpdate =    User::where('id',$request->user_id)
                                ->update([
                                        'name'                   => $request->name,
                                        'email'                  => $request->email,
                                        'email_verified_at'      => null,
                                        'remember_token'         => null,
                                        'access_code'            => $request->access_code,
                                        'password'               => Hash::make($request['token']),
                                        'phone_no'               => $request->phone_no,
                                        'gender'                 => $request->gender,
                                        'location'               => $request->location,
                                        'category_id'            => 0,
                                        'counselor_availability' => 0,
                                        'employment_status'      =>  $request->employment_status,
                                        'age'                    => $request->age,
                                        'social_login_type'      => $request->social_login_type,
                                        'social_login_id'        => $request->social_login_id,
                                        'primary_language'       => $request->primary_language,
                                        'secondary_language'       => $request->secondary_language,
                                ]);

            $response = ['token' => $userProfileUpdate,"message" =>'User profile get record....!','status'=>true];
            return response($response, 200);
        }else
        {
            $response = ["message" => "User does not exisit.",'status'=>FALSE];
            return response($response, 422);
        }
    }



    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

   
}
