<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FcmToken;
use Auth;

class NotificationController extends Controller
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
        $sessionCounselorid = Auth::user()->id;
        $storeFcmToken = array();
        $storeFcmToken['fcm_token'] = $request->token;
        $storeFcmToken['user_id'] = $sessionCounselorid;
        $storeData = FcmToken::create($storeFcmToken);
        return response()->json($storeData);
    }
  
    
    public function sendNotification(Request $request)
    {
        $sessionCounselorid = Auth::user()->id;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = FcmToken::where('user_id',$sessionCounselorid)->whereNotNull('fcm_token')->pluck('fcm_token')->all();
       
        $serverKey = 'APA91bFCyy9PnsqRhJeFtftO6yVs0tm7b28jsAwmgND4QCM_jycKhIAZDyTACoZLjWHDc7a2rIX568KFAbGNBIr4wY8InLA9MBSd_gh0e6ixT7gKsyNOPmeBCeYTWI4cgJuXwdAXfZa7';
  
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
