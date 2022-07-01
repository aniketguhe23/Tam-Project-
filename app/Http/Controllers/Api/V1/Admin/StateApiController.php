<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StateApiController extends Controller
{
    public function index(Request $request) {
        $response = State::get();
        if(!empty($response))
        {
            $response = ['response' => $response,'message'=> 'State Record Successfully.....!','status'=>true];
            return response($response, 200);
            die();
        }else{
            $response = ["message" => "State does not exit",'status'=>FALSE];
            return response($response, 422);
            die();
        }
    }

  
}
