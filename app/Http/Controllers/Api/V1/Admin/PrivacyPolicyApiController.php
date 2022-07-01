<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PrivacyPolicyResource;
use App\Models\PrivacyPolicy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrivacyPolicyApiController extends Controller
{
    public function privacyPolicy(Request $request) {
        $privacypolicy = PrivacyPolicy::get();
        if(!empty($privacypolicy))
        {
            $response = ['response' => $privacypolicy,'message'=> 'Privacy policy Record Successfully.....!','status'=>true];
            return response($response, 200);
        }else{
            $response = ['response' => [], 'message'=> 'record does not exsist.','status'=>true];
            return response($response, 404);
        }
    
    }
}
