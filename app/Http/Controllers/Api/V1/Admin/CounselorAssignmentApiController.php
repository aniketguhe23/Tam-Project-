<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CounselorAssignmentResource;
use App\Models\CounselorAssignment;
use App\Models\WaitingAssignments;
use App\Models\User;
use App\Models\AsyncChat;
use App\Models\CounselorCurrentCases;
use App\Models\CounselorCategoryUser;
use App\Models\CurrentUserMessage;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CounselorAssignmentApiController extends Controller
{
    public function store(Request $request)
    {
        $getCounselors  = User::where('category_id',$request->category_id)
                             ->where('status','2')
                             ->where('counselor_availability','1')
                             ->get();
     
        $counselorAssignment = array();
        $userAssignment = array();
        $checkCounselor = array();
        if(!empty($getCounselors))
        {
            foreach($getCounselors as $getCounselor)
            {
                $userAssignment['counselor_id'] = $getCounselor->id;
                $userAssignment['user_id'] = 5;
                $userAssignment['category_id'] = 1;
                $userAssignment['chat_type'] = "Live";
                $userAssignment['chat_availability'] = 1;
                $counselorAssignment = $userAssignment; 
                $checkCounselor = CounselorAssignment::create($counselorAssignment);
            }
        }
        if(empty($checkCounselor))
        {
                $userAssignment['user_id'] = 7;
                $userAssignment['category_id'] = 1;
                $userAssignment['waiting_status'] ='1';
                $WaitingAssignments = $userAssignment; 
                $checkCounselor = WaitingAssignments::create($WaitingAssignments);
        }
        
        return (new CounselorAssignmentResource($checkCounselor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


    public function async(Request $request)
    {
        $checkCounselor = CounselorCurrentCases::where('user_id',$request->user_id)->where('category_id',$request->category_id)->first();
        $chat = array();
        if(empty($checkCounselor))
        {
            $userCurrentChat = array();
            $userCurrentChat['category_id'] = $request->category_id;
            $userCurrentChat['user_id'] = $request->user_id;
            $userCurrentChat['message'] = $request->message;
            $counselorCurrentChat = CounselorCurrentCases::create($userCurrentChat);

            $currentUserMessage = array();
            $currentUserMessage['current_chat_id'] =  $counselorCurrentChat->id;
            $currentUserMessage['user_id'] =  $counselorCurrentChat->user_id;
            $currentUserMessage['category_id'] =  $counselorCurrentChat->category_id;
            $currentUserMessage['message'] =  $counselorCurrentChat->message;
            $currentUserMessage['status'] =  1;
            $chekUserCurrentMessage = CurrentUserMessage::create($currentUserMessage);
        }
        else
        {
            $currentUserMessage = array();
            $currentUserMessage['current_chat_id'] =  $checkCounselor->id;
            $currentUserMessage['user_id'] =  $checkCounselor->user_id;
            $currentUserMessage['category_id'] =  $checkCounselor->category_id;
            $currentUserMessage['message'] =  $request->message;
            $currentUserMessage['status'] =  1;
            $chekUserCurrentMessage = CurrentUserMessage::create($currentUserMessage);

            $counselorCategoryUsers = CounselorCategoryUser::with('getCategory','getUser')
                                                          ->where('category_id',$chekUserCurrentMessage->category_id)
                                                          ->where('activate_chat',1)
                                                          ->first();
            if(!empty($counselorCategoryUsers))
            {
                $chat['counselor_category_by_user_id'] = $counselorCategoryUsers->id;
                $chat['category_id'] = $counselorCategoryUsers->category_id;
                $chat['sender_id'] = $request->user_id;
                $chat['reciver_id'] = $counselorCategoryUsers->counselor_id;
                $chat['message'] = $request->message;
                $chat['status'] = 1;
                $chat['date'] = date("Y-m-d");
                $chat['time'] = date("H:i");
                $chat['labels'] = $request->labels;
                $chat['created_at'] = date("Y-m-d H:i:s");
                $chat['updated_at'] = date("Y-m-d H:i:s");
                $chats = AsyncChat::create($chat);
            }

            $chekUserCurrentMessage =  CurrentUserMessage::where('current_chat_id', $checkCounselor->id)->get();
        }
        $categoryId = $request->category_id;
        $userId  = $request->user_id;

        $data = $this->sendNotification($categoryId, $userId);

        $response = ['response' => $chekUserCurrentMessage,'message'=> 'message send successfully.....!','status'=>true];
        return response($response, 200);
    }

    public function sendNotification($categoryId, $userId)
    {
       
        $url = 'https://fcm.googleapis.com/fcm/send';

        $getCounselor =  User::where('category_id',$categoryId)->where('status','2')->get();
      
         
        $FcmToken = FcmToken::where('user_id',$sessionCounselorid)->whereNotNull('fcm_token')->pluck('fcm_token')->all();
       
        $serverKey = 'AAAA0yAqXOY:APA91bFx-9he2tSBX8bwjlnBHik0i-f_NhgsgaElzQQ0xDbefryv9G2dwAj0J-6lBhcMt14PWhIb0AfHXvaaW-V2NkE2rgTeLXDf5pbpAqvmmvvoVpYo73GfPsk4tYQo26s0c6p1pjLY';
  
        $data = [
            "registration_ids" => ["cCwIM59JJe626IYb0Iq1PG:APA91bFDQBAGEkBsi_GwOWT5DetWmu8yg1rOIwAHC3LBN4dpfvriNeRD6jPEyLWG_OvGQPyqyVpV8YthC_hP_3Vk_nR4GloMz2fuMGeja0glWheI4HOURTpSIXMwyHmf823MVgdanhfn"],
            "notification" => [
                "title" =>"New Message",
                "body" => "User has sent a message",  
            ],
            "data" => [
                "key" =>"async_user_message",
                "user_id" => $userId,  
                "category_id" => $categoryId,
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


    public function getChat(Request $request)
    {
        $chatMessages = array();
        $chatMessages = DB::select("SELECT * FROM `async_chat` WHERE `category_id` = ".$request->category_id." AND (`sender_id` = $request->sender_id OR `reciver_id` = $request->sender_id) ORDER BY `date`,`time` ASC");
      
        if(empty($chatMessages))
        {
            $checkCounselor = DB::table('counselor_current_cases')->where('category_id',$request->category_id)
                                                                  ->where('user_id',$request->sender_id) 
                                                                   ->first();
            if(!empty($checkCounselor))
            {
                $chekUserCurrentMessage =  CurrentUserMessage::where('current_chat_id', $checkCounselor->id)
                                                                ->where('category_id',$checkCounselor->category_id)
                                                                ->where('user_id',$checkCounselor->user_id)
                                                                ->get();
            }
            else{
                $response = ['response' => [],'message'=> 'Category does not exixt.','status'=>False];
                return response($response, 400);
            }
            $response = ['response' => $chekUserCurrentMessage,'message'=> 'message send successfully.....!','status'=>true];
            return response($response, 200);
        }
        else{
            $response = ['response' => $chatMessages,'message'=> 'message send successfully.....!','status'=>true];
            return response($response, 200);
        }

       

    }

    
    

    

   
}
