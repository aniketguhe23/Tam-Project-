<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CounselorAssignmentResource;
use App\Models\CounselorAssignment;
use App\Models\WaitingAssignments;
use App\Models\User;
use App\Models\AsyncChat;
use App\Models\FcmToken;
use App\Models\LiveChat;
use App\Models\CounselorCurrentCases;
use App\Models\CounselorCategoryUser;
use App\Models\CurrentUserMessage;
use App\Models\CounselorPastCases;
use App\Models\ChatHistory;
use App\Models\Feedback;

use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CounselorLiveChatApiController extends Controller
{
    public function liveChatAssign(Request $request)
    {
        $getCounselors  = User::where('category_id',$request->category_id)
                              ->where('status','2')
                              ->where('counselor_availability','1')
                              ->where('chat_availability','0')
                              ->first();

        /* Check counselor availabil or not */
        if(!empty($getCounselors))
        {
            $checkCounselorAssignment = CounselorAssignment::where('category_id',$request->category_id)
                                                            ->where('counselor_id',$getCounselors->id)
                                                            ->where('user_id',$request->user_id)
                                                            ->whereNull('deleted_at')
                                                            ->whereNull('report')
                                                            ->first();
                if(empty($checkCounselorAssignment))
                {
                    $userAssignment['counselor_id'] = $getCounselors->id;
                    $userAssignment['user_id'] = $request->user_id;
                    $userAssignment['category_id'] = $request->category_id;
                    $userAssignment['chat_type'] = "Live";
                    $userAssignment['chat_availability'] = '1';
                    $checkCounselor = CounselorAssignment::create($userAssignment);

                    $getCounselors->chat_availability = '1';
                    $getCounselors->save();

                    $response = ['response' => $checkCounselor,'message'=> 'User  assignment succsesfully..! ','status'=>true];
                    return response($response, 200);
                }
                else
                {
                    $response = ['response' => $checkCounselorAssignment,'message'=> 'User already assignment','status'=>true];
                    return response($response, 200);
                }
        } else {

            $checkCounselorAssignment = CounselorAssignment::where('category_id',$request->category_id)
                                                            ->where('user_id',$request->user_id)
                                                            ->whereNull('deleted_at')
                                                            ->whereNull('report')
                                                            ->first();
            if(!empty($checkCounselorAssignment) && $checkCounselorAssignment->counselor_id != '1'){

                  $response = ['response' => $checkCounselorAssignment,'message'=> 'User already assignment','status'=>true];
                    return response($response, 200);
            } else {

                $checkWattingList = WaitingAssignments::where('user_id',$request->user_id)->where('category_id',$request->category_id)->first();

                if(empty($checkWattingList))
                {
                    $userAssignment['user_id'] = $request->user_id;
                    $userAssignment['category_id'] = $request->category_id;
                    $userAssignment['waiting_status'] = '1';
                    $WaitingAssignments = $userAssignment; 
                    $checkCounselor = WaitingAssignments::create($WaitingAssignments);

                    $response = ['response' => $checkCounselor,'message'=> 'User Waiting assignment succsesfully..! ','status'=>true];
                    return response($response, 200);
                }
                else
                {
                    $response = ['response' => $checkWattingList,'message'=> 'This User already waitting ...! ','status'=>true];
                    return response($response, 401);
                }
            }

           
        }

        /* End Check counselor availabil or not */           
        
    }


    public function liveChat(Request $request)
    { 
        $checkCounselorAssignment = CounselorAssignment::where('user_id',$request->user_id)
                                                ->where('category_id',$request->category_id)
                                                ->where('counselor_id',$request->counselor_id)
                                                ->where('chat_availability','1')
                                                ->whereNull('deleted_at')
                                                ->whereNull('report')
                                                ->first();
     
        if(!empty($checkCounselorAssignment))
        {   

            $checkCounselorCurrentChat = CounselorCurrentCases::where('user_id',$request->user_id)
                                               ->where('category_id',$request->category_id)
                                               ->where('chat_type','1')
                                               ->whereNull('deleted_at')
                                               ->first();

            if(empty($checkCounselorCurrentChat))
            {
                $userCurrentChat = array();
                $userCurrentChat['category_id'] = $request->category_id;
                $userCurrentChat['user_id'] = $request->user_id;
                $userCurrentChat['chat_type'] = '1';
                $userCurrentChat['message'] = "Live Chat";
                $counselorCurrentChat = CounselorCurrentCases::create($userCurrentChat);
            }

                $chat = array();
                $chat['counselor_assignment_id'] = $checkCounselorAssignment->id;
                $chat['sender_id'] = $request->user_id;
                $chat['reciver_id'] = $request->counselor_id;
                $chat['category_id'] = $request->category_id;
                $chat['message'] = $request->message;
                $chat['status'] = 1;
                $chat['date'] = date("Y-m-d");
                $chat['time'] = date("H:i:s");
                $chat['labels'] = $request->labels;
                $chat['created_at'] = date("Y-m-d H:i:s");
                $chat['updated_at'] = date("Y-m-d H:i:s");
                LiveChat::create($chat);
            
            $categoryId = $request->category_id;
            $userId  = $request->user_id;
            $chatType = "live_user_message";
            
            $data = $this->sendNotificationToCounselor($categoryId, $userId, $chatType);
            $chats = LiveChat::where('counselor_assignment_id',$checkCounselorAssignment->id)->get();
        }
        else
        {
            $chats = [];
            $data = [];
        }
            $response = ['response' => $chats,'notification' => $data,'message'=> 'message send successfully.....!','status'=>true];
            return response($response, 200);
    }

    public function getLiveChat(Request $request)
    {  
        $liveChatAssignment = CounselorAssignment::where('category_id',$request->category_id)
                                                    ->where('user_id',$request->sender_id)
                                                    ->whereNull('deleted_at')
                                                    ->whereNull('report')
                                                    ->first();
        if(!empty($liveChatAssignment))
        {
            $response = LiveChat::where('counselor_assignment_id',$liveChatAssignment->id)->get();

            $response = ['response' => $response,'message'=>"success",'status'=>true];
        }
        else
        {
            $response = ['response' => [],'message'=>"Chat not found",'status'=>true];
        }
           
        return response($response, 200);
    }

    public function liveChatFeedback(Request $request)
    {  

        $closeChatId = $request->closeChatId;
        $userId = $request->userId;

        $counselorPastCases = CounselorPastCases::where('id',$closeChatId)->first();
       
        if(!empty($counselorPastCases)){

                $feedback = array();                
                $feedback['user_id'] = $userId;
                $feedback['comment'] = $request->comment;
                $feedback['feedback'] = $request->feedback;
                $feedback['star_reviews'] = $request->star_reviews;
                $feedback['status'] = 1; 
                               
                $getfeedback = Feedback::create($feedback);

            $counselorPastCases->feedback_id = $getfeedback->id;            
            $counselorPastCases->save();
            $response = ['message'=>"success",'status'=>true];

        } else {

            $response = ['message'=>"Close chat id not found",'status'=>true];

        }
           
        return response($response, 200);
    }

     public function getChatHistory(Request $request){  

            $category_id = $request->category_id;
            $userId = $request->user_id;
            
            // $filter =  $request->filter;

            $chatType =  $request->type;

            $startDate =  $request->startDate;
            $endDate =  $request->endDate;



            $liveChatAssignment = CounselorAssignment::where('category_id',$request->category_id)
                                                        ->where('user_id',$request->sender_id)
                                                        ->whereNull('deleted_at')
                                                        ->whereNull('report')
                                                        ->first();
            if(!empty($liveChatAssignment))
            {
                $response = LiveChat::where('counselor_assignment_id',$liveChatAssignment->id)->get();

                $response = ['response' => $response,'message'=>"success",'status'=>true];
            }
            else
            {
                $response = ['response' => [],'message'=>"Chat not found",'status'=>true];
            }
               
            return response($response, 200);
    }
    
    public function sendNotificationToCounselor($categoryId, $userId, $chatType)
    {
       
        $url = 'https://fcm.googleapis.com/fcm/send';

        $getCounselor =  User::where('category_id',$categoryId)->where('status','2')->first();

        $FcmToken = FcmToken::where('user_id',$getCounselor->id)->whereNotNull('fcm_token')->pluck('fcm_token')->all();
       
        $serverKey = 'AAAA0yAqXOY:APA91bFx-9he2tSBX8bwjlnBHik0i-f_NhgsgaElzQQ0xDbefryv9G2dwAj0J-6lBhcMt14PWhIb0AfHXvaaW-V2NkE2rgTeLXDf5pbpAqvmmvvoVpYo73GfPsk4tYQo26s0c6p1pjLY';
  
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" =>"Hellow",
                "body" => "user message",  
            ],
            "data" => [
                "key" => $chatType,
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
        
        return $result;
    }
   
}
