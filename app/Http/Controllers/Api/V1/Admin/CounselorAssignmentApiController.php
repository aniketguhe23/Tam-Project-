<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAsyncChatRequest;
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
use Gate;
use DB;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Symfony\Component\HttpFoundation\Response;

class CounselorAssignmentApiController extends Controller
{
    public function async(Request $request)
    {
        $checkCounselor = CounselorCurrentCases::where('user_id',$request->user_id)
                                               ->where('category_id',$request->category_id)
                                               ->where('chat_type',0)
                                               ->whereNull('deleted_at')
                                               ->first();
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
            
            $counselorCategoryUsers = CounselorCategoryUser::with('getCategory','getUser')
                                                          ->where('user_id',$request->user_id)
                                                          ->where('category_id',$request->category_id)
                                                          ->where('activate_chat',1)
                                                          ->whereNull('deleted_at')
                                                          ->first();
        
            if(!empty($counselorCategoryUsers))
            {
                $chat['counselor_category_by_user_id'] = $counselorCategoryUsers->id;
                $chat['category_id'] = $counselorCategoryUsers->category_id;
                $chat['sender_id'] = $counselorCategoryUsers->user_id;
                $chat['reciver_id'] = $counselorCategoryUsers->counselor_id;
                $chat['message'] = $request->message;
                $chat['status'] = 1;
                $chat['date'] = date("Y-m-d");
                $chat['time'] = date("H:i:s");
                $chat['labels'] = $request->labels;
                $chat['created_at'] = date("Y-m-d H:i:s");
                $chat['updated_at'] = date("Y-m-d H:i:s");
                $chekUserCurrentMessage = AsyncChat::create($chat);
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
            }
        }
    
        $categoryId = $request->category_id;
        $userId  = $request->user_id;
        $chatType = "async_user_chat";
        $data = $this->sendNotificationToCounselor($categoryId, $userId, $chatType);

        $response = ['response' => $chekUserCurrentMessage,'notification' => $data,'message'=> 'message send successfully.....!','status'=>true];
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

    public function getChat(Request $request)
    {
        $chatMessages = array();
        $chatMessages = DB::select("SELECT * FROM `async_chat` WHERE `deleted_at` IS NULL AND `category_id` = ".$request->category_id." AND (`sender_id` = $request->sender_id OR `reciver_id` = $request->sender_id) ORDER BY `date`,`time` ASC");
      
        if(empty($chatMessages))
        {
            $checkCounselor = DB::table('counselor_current_cases')->where('category_id',$request->category_id)
                                                                  ->where('user_id',$request->sender_id) 
                                                                  ->where('chat_type','0')
                                                                  ->whereNull('deleted_at')
                                                                  ->first();
            if(!empty($checkCounselor))
            {
                $getCurrentChat = array();
                $pastChats = CounselorPastCases::where('category_id',$checkCounselor->category_id)
                                              ->where('user_id',$checkCounselor->user_id)
                                              ->where('chat_type','0')
                                              ->get();
                $getChatHistory = array();
                if(!empty($pastChats))
                {
                    foreach($pastChats as $pastChat)
                    {
                        $data = ChatHistory::where('counselor_past_cases_id',$pastChat->id)->get();
                        $getChatHistory = $data;
                    }
                }

                $getCurrentChat =  CurrentUserMessage::where('current_chat_id', $checkCounselor->id)
                                                                ->where('category_id',$checkCounselor->category_id)
                                                                ->where('user_id',$checkCounselor->user_id)
                                                                ->whereNull('deleted_at')
                                                                ->get();
                if(!empty($getCurrentChat))
                {
                    if(!empty($getChatHistory))
                    {
                        $result = $getChatHistory->merge($getCurrentChat);

                    }else
                    {
                        $result = $getCurrentChat;
                    }
                }
                else
                {
                    $result = $getChatHistory;
                }
            }
            else
            {
                $pastChats = CounselorPastCases::where('category_id',$request->category_id)
                                              ->where('user_id',$request->sender_id)
                                              ->where('chat_type','0')
                                              ->get();
                $getChatHistory = array();
                if(!empty($pastChats))
                {
                    foreach($pastChats as $pastChat)
                    {
                        $data = ChatHistory::where('counselor_past_cases_id',$pastChat->id)->get();
                        $getChatHistory = $data;
                    }
                }

                if(!empty($getChatHistory))
                {
                    $response = ['response' => $getChatHistory,'message'=> 'past chat get succsessfully','status'=>true];
                    return response($response, 200);
                    die();
                }
                else
                {
                    $response = ['response' => [],'message'=> 'chat not found','status'=>FALSE];
                    return response($response, 200);
                    die();
                }
            }
            $response = ['response' => $result,'message'=> 'message send successfully.....!','status'=>true];
            return response($response, 200);
        }
        else{
            $chatMessages = DB::select("SELECT * FROM `async_chat` WHERE `category_id` = ".$request->category_id." AND (`sender_id` = $request->sender_id OR `reciver_id` = $request->sender_id) ORDER BY `date`,`time` ASC");
            $response = ['response' => $chatMessages,'message'=> 'message send successfully.....!','status'=>true];
            return response($response, 200);
        }
    
    }

    // public function getChat(Request $request)
    // {
    //     $chatMessages = array();
    //     $checkCounselor = DB::table('counselor_current_cases')
    //                         ->where('category_id',$request->category_id)
    //                         ->where('user_id',$request->sender_id)
    //                         ->where('chat_type','0')
    //                         ->whereNull('deleted_at')
    //                         ->first();

                            
    //     if(!empty($checkCounselor))
    //     {
    //             $data = DB::table('counselor_current_cases')
    //                         ->join('current_user_message', 'counselor_current_cases.id','current_user_message.current_chat_id')
    //                         ->select('counselor_current_cases.id','counselor_current_cases.user_id','counselor_current_cases.category_id','counselor_current_cases.deleted_at','counselor_current_cases.chat_type','current_user_message.status','current_user_message.current_chat_id','current_user_message.user_id','current_user_message.category_id', 'current_user_message.message')
    //                         ->where('counselor_current_cases.category_id',$request->category_id)
    //                         ->where('counselor_current_cases.user_id',$request->sender_id)
    //                         ->where('chat_type','0')
    //                         ->whereNull('counselor_current_cases.deleted_at')
    //                         ->get();

    //             $userAssignment = CounselorCategoryUser::where('category_id',$request->category_id)
    //                                                    ->where('user_id',$request->sender_id)
    //                                                    ->where('chat_type',0)
    //                                                    ->whereNull('deleted_at')
    //                                                    ->first();
    //             if(!empty($userAssignment))
    //             {
    //                 $chatMessages = DB::select("SELECT * FROM `async_chat` WHERE `deleted_at` IS NULL AND `category_id` = ".$request->category_id." AND (`sender_id` = $request->sender_id OR `reciver_id` = $request->sender_id) ORDER BY `date`,`time` ASC");
    //                 $result = $chatMessages;
    //             }
    //             else
    //             {
    //                 $result = $data;
    //             }
    //     }
    //     else
    //     {
    //           $pastChat = CounselorPastCases::Where('category_id',$request->category_id)
    //                                             ->where('user_id',$request->sender_id)
    //                                             ->where('chat_type','0')
    //                                             ->first();
    //             if(!empty($pastChat))
    //             {
    //                 $data = ChatHistory::where('counselor_past_cases_id',$pastChat->id)->whereNull('deleted_at')->get();
    //                 $result = $data;
    //             }
    //     }

    //     $response = ['response' => $result,'message'=> 'message get successfully.....!','status'=>true];
    //     return response($response, 200);
    // }


    // public function chatFilter(Request $request)
    // {
    //     if(!empty($request->sender_id) && !empty($request->category_id) && $request->chat_type != NULL && $request->chat_type == 0)
    //     {

    //     }
    //     if(!empty($request->sender_id) && !empty($request->category_id) && $request->chat_type != NULL)
    //     {

    //     }

    //     $chatMessages = array();
  
    //     $chatMessages = CounselorPastCases::where('category_id',$request->category_id)
    //                                         ->where('user_id',$request->sender_id)
    //                                         ->where('chat_type',"Live")
    //                                         ->whereNull('deleted_at')
    //                                         ->first();
    //     if(!empty($chatMessages))
    //     {
    //         $getChatHistory = ChatHistory::where('counselor_past_cases_id',$chatMessages->id)->get();
    //             $response = ['response' => $getChatHistory, 'status'=>true];
    //     }
    //     else
    //     {
    //         $response = ['response' => [],'message'=>"Chat not found",'status'=>true];
    //     }
           
    //     return response($response, 200);
    // }
    

    
    

    

   
}
