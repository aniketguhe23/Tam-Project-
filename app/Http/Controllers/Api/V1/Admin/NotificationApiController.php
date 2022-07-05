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

    public function index()
    {
        $sessionCounselorid = Auth::user()->id;
        $getFcmTokens = FcmToken::where('user_id', $sessionCounselorid)->get();
        return response()->json($getFcmTokens);
    }
  
    public function storeToken(Request $request)
    {
        $sessionCounselorid = Auth::user()->id;
        
        $storeFcmTokens = FcmToken::where('user_id', $request->user_id)
                                 ->create(['fcm_token' => $request->fcm_token,
                                           'user_id' => $request->user_id
                                        ]);
        return response()->json($storeFcmTokens);
    }
  
    
    public function sendNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
          
        $serverKey = env('FCM_SERVER_KEY');
  
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
