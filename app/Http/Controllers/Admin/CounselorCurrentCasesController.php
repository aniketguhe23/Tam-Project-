<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyCurrentCasesRequest;
use App\Http\Requests\StoreCurrentCasesRequest;
use App\Http\Requests\UpdateCurrentCasesRequest;
use App\Models\CounselorCurrentCases;
use App\Models\CounselorAssignment;
use App\Models\CounselorPastCases;
use App\Models\CurrentUserMessage;
use App\Models\User;
use App\Models\Category;
use App\Models\ChatHistory;
use App\Models\CounselorCategoryUser;
use App\Models\AsyncChat;
use App\Models\Feedback;
use App\Models\FcmToken;
use Gate;
use Auth;
use DB;
use Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CounselorCurrentCasesController extends Controller
{
    
        public function index(Request $request)
        {
            abort_if(Gate::denies('counselor_current_cases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $sessionCounselorid = Auth::user()->id;
            $counselors = User::with(['roles'])->where('status','2')->get();
            $categorys = Category::get();

            if($sessionCounselorid == 1)
            {                
                $counselorCurrentChats = CounselorCurrentCases::with('getCategory','getUser')->get();
                return view('admin.counselorcurrentcases.index', compact('counselorCurrentChats','categorys','counselors'));
            }else
            {
                $counselorCheckit = User::where('id',$sessionCounselorid)->where('status','2')->first(); 
                $counselorCurrentChats = CounselorCurrentCases::with('getCategory','getUser')
                                                               ->where('category_id',$counselorCheckit->category_id)
                                                               ->get();
                return view('admin.counselorcurrentcases.counselorcurrentlist', compact('counselors','counselorCurrentChats'));
            }
        }
    
        public function create()
        {
            abort_if(Gate::denies('counselor_current_cases_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $categorys = Category::get();
            $categorys = User::where('status',0)->get();
            return view('admin.counselorcurrentcases.create', compact('roles','categorys'));
        }
    
        public function store(StoreCounselorRequest $request)
        {

            $counselorArr = array();
            $counselorArr['name'] = $request->name;
            $counselorArr['category_id'] = $request->category_id;
            $counselorArr['email'] = $request->email;
            $counselorArr['phone_no'] = $request->phone_no;
            $counselorArr['password'] = $request->password;
            $counselorArr['status'] = 2;
            $user = CounselorCurrentCases::create($counselorArr);
            $user->roles()->sync($request->input('roles', []));
    
            return redirect()->route('admin.counselorcurrentcases.index');
        }
    
        public function edit(User $counselor)
        {  
            abort_if(Gate::denies('counselor_current_cases_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $categorys = Category::get();
            return view('admin.counselorcurrentcases.edit', compact('counselor','categorys'));
        }

        

        public function counselorAssignUser($userId)
        {
            $sessionCounselorid = Auth::user()->id;
            $counselors = User::where('id',$sessionCounselorid)->where('status','2')->first();

            
            $currentCounselors = CounselorCurrentCases::where('user_id',$userId)
                                                      ->where('category_id',$counselors->category_id)
                                                      ->whereNull('deleted_at')
                                                      ->first();
            
            if(!empty($currentCounselors))
            {
                $counselorAssignToUsers = CounselorCategoryUser::where('category_id',$counselors->category_id)
                                                      ->where('user_id',$currentCounselors->user_id)
                                                      ->where('counselor_id',$counselors->id)
                                                      ->whereNull('deleted_at')
                                                      ->first();
                if(empty($counselorAssignToUsers))
                {
                    $counselorAssigntoUser = array();
                    $counselorAssigntoUser['counselor_id'] = $counselors->id;
                    $counselorAssigntoUser['user_id'] = $currentCounselors->user_id;
                    $counselorAssigntoUser['category_id'] = $currentCounselors->category_id;
                    $counselorAssigntoUser['activate_chat'] = 1;
                    $counselorAssignToUsers = CounselorCategoryUser::create($counselorAssigntoUser);

                    $chekUserCurrentMessages =  CurrentUserMessage::where('current_chat_id', $currentCounselors->id)
                                                                    ->get();
                                               
                    foreach($chekUserCurrentMessages as $chekUserCurrentMessage)
                    {
                        $chat = array();
                        $chat['counselor_category_by_user_id'] = $counselorAssignToUsers->id;
                        $chat['category_id'] = $chekUserCurrentMessage->category_id;
                        $chat['sender_id'] = $chekUserCurrentMessage->user_id;
                        $chat['reciver_id'] = $counselorAssignToUsers->counselor_id;
                        $chat['message'] = $chekUserCurrentMessage->message;
                        $chat['status'] = 1;
                        $chat['date'] = date("Y-m-d");
                        $chat['time'] = date("H:i:s");
                        $chat['labels'] = "user sender";
                        $chat['created_at'] = date("Y-m-d H:i:s");
                        $chat['updated_at'] = date("Y-m-d H:i:s");
                        $chats = AsyncChat::create($chat);
                    }
                }
                else
                {
                    $asyncChats = DB::select("SELECT * FROM `async_chat` WHERE `category_id` = ".$currentCounselors->category_id." AND (`sender_id` = $currentCounselors->user_id OR `reciver_id` = $currentCounselors->user_id) ORDER BY `date`,`time` ASC");
                    return view('admin.chatboat.asyncchat',compact('counselorAssignToUsers','asyncChats'));
                }
            }
            else
            {
                $counselorAssignToUsers = CounselorCategoryUser::where('category_id',$counselors->category_id)
                                                      ->where('user_id',$currentCounselors->user_id)
                                                      ->where('counselor_id',$counselors->id)
                                                      ->whereNull('deleted_at')
                                                      ->first();

                $asyncChats = DB::select("SELECT * FROM `async_chat` WHERE `category_id` = ".$currentCounselors->category_id." AND (`sender_id` = $currentCounselors->user_id OR `reciver_id` = $currentCounselors->user_id) ORDER BY `date`,`time` ASC");
                return view('admin.chatboat.asyncchat',compact('counselorAssignToUsers','asyncChats'));
            }




            if(!empty($counselorCategoryUsers))
            {
                $asyncChats = DB::select("SELECT * FROM `async_chat` WHERE `category_id` = ".$counselors->category_id." AND (`sender_id` = $userId OR `reciver_id` = $userId) ORDER BY `date`,`time` ASC");

                return view('admin.chatboat.asyncchat',compact('counselorCategoryUsers','asyncChats'));
            }
            else
            {
                return redirect()->route('admin.counselorcurrentcases.index');
            }
        }

        public function counselorUserChat($userId, $categoryId)
        {
            $sessionCounselorid = Auth::user()->id;
            $counselorCategoryUsers = CounselorCategoryUser::where('category_id',$categoryId)
                                                          ->where('counselor_id',$sessionCounselorid)
                                                          ->where('user_id',$userId)
                                                          ->where('activate_chat',1)
                                                          ->first();
            if(!empty($counselorCategoryUsers))
            {
                $asyncChats = DB::select("SELECT * FROM `async_chat` WHERE `category_id` = ".$categoryId." AND (`sender_id` = $userId OR `reciver_id` = $userId) ORDER BY `date`,`time` ASC");
                $response = ['response' => $asyncChats,'message'=> 'message send successfully.....!'];

                return response($response, 200);
            }
            return response(400);
        }


        public function counselorLiveChat($userId)
        {
            $sessionCounselorid = Auth::user()->id;
            $counselors = User::where('id',$sessionCounselorid)->where('status','2')->first();
            $currentCounselors = CounselorCurrentCases::where('user_id',$userId)
                                                      ->where('category_id',$counselors->category_id)
                                                      ->first();
                                                        
            $counselorCategoryUsers = CounselorAssignment::where('category_id',$currentCounselors->category_id)
                                                          ->where('user_id',$currentCounselors->user_id)
                                                          ->where('chat_availability',1)
                                                          ->first();
           
            if(!empty($counselorCategoryUsers))
            {
                $liveChats = DB::select("SELECT * FROM `live_chat` WHERE `category_id` = ".$currentCounselors->category_id." AND (`sender_id` = $currentCounselors->user_id OR `reciver_id` = $currentCounselors->user_id) ORDER BY `date`,`time` ASC");
                return view('admin.chatboat.livechat',compact('counselorCategoryUsers','liveChats'));       
            }
            else
            { 
                $liveChats = [];
                return view('admin.chatboat.livechat',compact('counselorCategoryUsers','liveChats'));       
            }



        }


        
        public function chat(Request $request)
        {
                    
            $counselorCategoryUsers = CounselorCategoryUser::with('getCategory','getUser')
                                ->where('category_id',$request->category_id)
                                ->where('user_id',$request->user_id)
                                ->where('activate_chat',1)
                                ->first();

            
            if(!empty($counselorCategoryUsers))
            {
                $chat['counselor_category_by_user_id'] = $counselorCategoryUsers->id;
                $chat['category_id'] = $counselorCategoryUsers->category_id;
                $chat['sender_id'] = $counselorCategoryUsers->counselor_id;
                $chat['reciver_id'] = $counselorCategoryUsers->user_id;
                $chat['message'] = $request->message;
                $chat['status'] = 0;
                $chat['date'] = date("Y-m-d");
                $chat['time'] = date("H:i:s");
                $chat['labels'] = '';
                $chat['created_at'] = date("Y-m-d H:i:s");
                $chat['updated_at'] = date("Y-m-d H:i:s");

                $chats = AsyncChat::create($chat);

                $userId = $counselorCategoryUsers->user_id;
                $categoryId = $counselorCategoryUsers->category_id;
              
                $this->sendNotificationToUser($userId,$categoryId);
             
                // return redirect()->route('admin.counselor-assign-user.counselorAssignUser', $counselorCategoryUsers->user_id);

                $output = ['success' => true,
                        'data' => '<div id="cm-msg-1" class="chat-msg self">
                    <span class="msg-avatar"><img src="https://i.stack.imgur.com/l60Hf.png">
                    </span><div class="cm-msg-text"><span>'.$request->message.'</span><br><small style="float:right;">'.$chat['time'].'</small></div></div>',
                        'msg' => __("added_success")
                    ];

            } else {
                $output = ['success' => false,
                        'data' => '',
                        'msg' => __("not sent")
                    ];
            }

            return $output;
        }


        public function update_chat_ajax(Request $request, $userId)
        {
            $counselor_id = request()->get('counselor_id');
            $user_id = $userId;

            $asyncChats = DB::select("SELECT * FROM `async_chat` WHERE `sender_id` = $userId AND `reciver_id` = $counselor_id AND `read_status` = '0' AND `status` = '1' ORDER BY `date`,`time` ASC LIMIT 1");
            echo '<pre>';
            print_r($asyncChats);

            print_r(("SELECT * FROM `async_chat` WHERE `sender_id` = $userId AND `reciver_id` = $counselor_id AND `read_status` = '0' AND `status` = '1' ORDER BY `date`,`time` ASC LIMIT 1"));
        }
      
      
        public function sendNotificationToUser($userId, $categoryId)
        {
           
            $url = 'https://fcm.googleapis.com/fcm/send';
    
            // $getCounselor =  User::where('category_id',$categoryId)->where('status','2')->get();
          
             
            $FcmToken = FcmToken::where('user_id',$userId)->whereNotNull('fcm_token')->pluck('fcm_token')->all();
           
            $serverKey = 'AAAA0yAqXOY:APA91bFx-9he2tSBX8bwjlnBHik0i-f_NhgsgaElzQQ0xDbefryv9G2dwAj0J-6lBhcMt14PWhIb0AfHXvaaW-V2NkE2rgTeLXDf5pbpAqvmmvvoVpYo73GfPsk4tYQo26s0c6p1pjLY';
      
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" =>"New Message",
                    "body" => "Counsellor has sent a message",  
                ],
                "data" => [
                    "key" =>"async_counsellor_message",
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
            // dd($result);  
            return true;      
        }
    

        public function closeChat($userId)
        {
            $sessionCounselorid = Auth::user()->id;
            $counselorCategoryUsers = CounselorCategoryUser::where('user_id',$userId)
                                                            ->where('counselor_id',$sessionCounselorid)
                                                            ->where('activate_chat',1)
                                                            ->first();
            
            if(!empty($counselorCategoryUsers))
            {
                $currentCounselorRemove = CounselorCurrentCases::where('user_id',$userId)
                                                                ->where('category_id',$counselorCategoryUsers->category_id)
                                                                ->delete();

                $updateCounselorCategoryUser = CounselorCategoryUser::where('category_id',$counselorCategoryUsers->category_id)
                                                                      ->where('user_id',$counselorCategoryUsers->user_id)
                                                                      ->where('counselor_id',$counselorCategoryUsers->counselor_id)
                                                                     ->update(
                                                                                array('activate_chat'=> 0,
                                                                                'created_at'=> date('Y-m-d H:i:s'),
                                                                                'updated_at'=> date('Y-m-d H:i:s'),
                                                                                'deleted_at'=> null)
                                                                                );
                $pastChatAssign = array();
                $pastChatAssign['date'] = date('Y-m-d');
                $pastChatAssign['category_id'] = $counselorCategoryUsers->category_id;
                $pastChatAssign['user_id'] = $counselorCategoryUsers->user_id;
                $pastChatAssign['counselor_id'] = $counselorCategoryUsers->counselor_id;
                $pastChatAssign['chat_type'] = "Async";
                $pastChatAssign['feedback_id'] = 1;
                $counselorPastChat = CounselorPastCases::create($pastChatAssign);
               
                $asyncChats = DB::select("SELECT * FROM `async_chat` WHERE `category_id` = ".$counselorPastChat->category_id." AND (`sender_id` = $counselorPastChat->user_id OR `reciver_id` = $counselorPastChat->user_id) ORDER BY `date`,`time` ASC");
                foreach($asyncChats as $asyncChat)
                {               
                    $chatHistory = array();
                     $chatHistory['counselor_past_cases_id']  = $counselorPastChat->id;
                     $chatHistory['category_id']         = $asyncChat->category_id;
                     $chatHistory['assignment_of_cc']    = $sessionCounselorid;
                     $chatHistory['sender_id']           = $asyncChat->sender_id;
                     $chatHistory['reciver_id']          = $asyncChat->reciver_id;
                     $chatHistory['message']             = $asyncChat->message;
                     $chatHistory['status']              = $asyncChat->status;
                     $chatHistory['date']                = date('Y-m-d');
                     $chatHistory['time']                = date('H:i:s');
                     $chatHistory['labels']              = $asyncChat->labels;
                    $chatHistory = ChatHistory::create($chatHistory);
                }
                Session::flash('message', 'Chat close succsesfully...!');
                return redirect()->route('admin.counselorcurrentcases.index');
            }
        }

        public function userAssignAdmin($userId)
        {
            $sessionCounselorid = Auth::user()->id;
            $counselorCategoryUsers = CounselorCategoryUser::where('user_id',$userId)
                                                            ->where('counselor_id',$sessionCounselorid)
                                                            ->where('activate_chat',1)
                                                            ->first();
            
            if(!empty($counselorCategoryUsers))
            {
                $currentCounselorRemove = CounselorCurrentCases::where('user_id',$userId)
                                                                ->where('category_id',$counselorCategoryUsers->category_id)
                                                                ->delete();
                $counselorAssigntoUser = array();
                $counselorAssigntoUser['counselor_id'] = 1;
                $counselorAssigntoUser['user_id'] = $counselorCategoryUsers->user_id;
                $counselorAssigntoUser['category_id'] = $counselorCategoryUsers->category_id;
                $counselorAssigntoUser['activate_chat'] = 1;
                $counselorAssignToUsers = CounselorCategoryUser::create($counselorAssigntoUser);
                Session::flash('message', 'Chat Assign to admin succsesfully...!');
            }
                return redirect()->route('admin.counselorcurrentcases.index');
        }
    
        public function update(UpdateCounselorRequest $request, User $counselor)
        {
            $counselorArr = array();
            $counselorArr['name'] = $request->name;
            $counselorArr['category_id'] = $request->category_id;
            $counselorArr['email'] = $request->email;
            $counselorArr['phone_no'] = $request->phone_no;
            $counselorArr['password'] = $request->password;  
            $counselorArr['status'] = 2;
            $counselor->update($counselorArr);
            return redirect()->route('admin..index');
        }
    
        public function show(User $counselor)
        {
            abort_if(Gate::denies('counselor_current_cases_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
            $counselor->load('roles');
    
            return view('admin.counselorcurrentcases.show', compact('counselor'));
        }
    
        public function destroy(User $counselor)
        {
            abort_if(Gate::denies('counselor_current_cases_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
            $counselor->delete();
    
            return back();
        }
    
        public function massDestroy(MassDestroyCounselorRequest $request)
        {
            CounselorCurrentCases::whereIn('id', request('ids'))->delete();
    
            return response(null, Response::HTTP_NO_CONTENT);
        }
    
       
}
