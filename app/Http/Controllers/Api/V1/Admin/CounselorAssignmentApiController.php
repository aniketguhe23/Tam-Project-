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
        $response = ['response' => $chekUserCurrentMessage,'message'=> 'message send successfully.....!','status'=>true];
        return response($response, 200);
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
