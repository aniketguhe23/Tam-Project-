<?php

namespace App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FcmToken;
use Gate;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class NotificationApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $getFcmTokens = FcmToken::where('user_id', $request->user_id)->first();
        return response()->json($getFcmTokens);
    }
  
    public function storeToken(Request $request)
    {   
        $getFcmTokens = FcmToken::where('user_id', $request->user_id)->where('fcm_token',$request->fcm_token)->whereNull('deleted_at')->first();
        if(empty($getFcmTokens->fcm_token))
        {
            $storeFcmTokens = FcmToken::where('user_id', $request->user_id)
                                    ->create(['fcm_token' => $request->fcm_token,
                                            'user_id' => $request->user_id
                                        ]);
            $response = ['response' => $storeFcmTokens,'message'=> 'Fcm token add successfully.....!','status'=>true];
        }
        else
        {
            $response = ['response' =>$getFcmTokens->fcm_token, 'message'=> 'Fcm token sent Successfully.....!','status'=>true];

        }
        return response($response, 200);
    }
  
    
    public function sendNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = FcmToken::whereNotNull('fcm_token')->pluck('fcm_token')->all();
          
        $serverKey = env('AAAA0yAqXOY:APA91bFx-9he2tSBX8bwjlnBHik0i-f_NhgsgaElzQQ0xDbefryv9G2dwAj0J-6lBhcMt14PWhIb0AfHXvaaW-V2NkE2rgTeLXDf5pbpAqvmmvvoVpYo73GfPsk4tYQo26s0c6p1pjLY');
  
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        

        // Close connection
        curl_close($ch);

        // FCM response
        dd($result);        
    }
}
