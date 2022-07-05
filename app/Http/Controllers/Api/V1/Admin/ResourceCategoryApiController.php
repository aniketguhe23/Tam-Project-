<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResourceCategoryApiController extends Controller
{
    public function index(Request $request) {

        $tamResourcCategorys = ResourceCategory::get();
       if(!empty($tamResourcCategorys))
       {
        $response = ['response' => $tamResourcCategorys,'message'=> 'Tamhub Resource Category Record Successfully.....!','status'=>true];
        return response($response, 200);
       }else{
        $response = ['response' => $tamResourcCategorys,'message'=> 'Record Not Found','status'=>False];
        return response($response, 200);
       }
        
    }
   
}
