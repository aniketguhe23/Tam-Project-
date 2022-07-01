<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CounselorCategoryApiController extends Controller
{
    public function index(Request $request) {
        $response = Category::get();
        if(!empty($response))
        {
                $response = ['response' => $response,'message'=> 'Counselor Category Record Successfully.....!','status'=>true];
                return response($response, 200);
                die();
        }else{
            $response = ["message" => "Counselor Category does not exit",'status'=>FALSE];
            return response($response, 422);
            die();
        }
    }

  
}
