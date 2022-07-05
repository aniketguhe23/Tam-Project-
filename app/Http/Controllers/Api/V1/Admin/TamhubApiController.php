<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTamhubRequest;
use App\Http\Requests\UpdateTamhubRequest;
use App\Http\Resources\Admin\TamhubResource;
use App\Models\TamHub;
use App\Models\ResourceCategory;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TamhubApiController extends Controller
{
    public function stateResourceCategorys(Request $request)
    {
        $getStates = State::where('id',$request->state_id)->first();
        if(!empty($getStates))
        {
            $tamResourceCategorys = TamHub::where('state',$getStates->state_name)->where('resource_category_id',$request->category_id)->get();
            $response = ['response' => $tamResourceCategorys,'message'=> 'Tamhub Resource Category Record Successfully.....!','status'=>true];
            return response($response, 200);
            die();
        }else
        {
            $response = ['response' => [],'message'=> 'Record not found','status'=>false];
            return response($response, 200);
            die();   
        }
    }

    public function store(Request $request) {
        $tamResourceCategorys = ResourceCategory::where('id',$request->resource_category_id)->first();
        if(!empty($tamResourceCategorys))
        {
                $response = TamHub::where('resource_category_id',$tamResourceCategorys->id,)->get();
                $response = ['response' => $response,'message'=> 'Tamhub Resource Category Record Successfully.....!','status'=>true];
                return response($response, 200);
                die();
        }else{
            $response = ["message" => "Resource Category does not exit",'status'=>FALSE];
            return response($response, 422);
            die();
        }
    }

  
}
