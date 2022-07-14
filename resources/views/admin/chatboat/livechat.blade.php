@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('public/chatboat/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/chatboat/assets/vendors/css/vendor.bundle.base.css')}}">

  <link rel="stylesheet" href="{{asset('public/chatboat/assets/css/chatsection.css')}}">
  <link rel="stylesheet" href="{{asset('public/chatboat/assets/js/model.js')}}">

  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('public/chatboat/assets/images/favicon.ico')}}" />
  
<div class="content-wrapper">
<div id="chat-circle" class="btn btn-raised">
<div id="chat-overlay"></div>
<i class="material-icons mdi mdi-comment-multiple-outline"></i>
</div>
<div class="chat-box">
<div class="chat-box-header">

<div class="profile_img">
  <!-- <img class="img_circle" src="http://askavenue.com/img/17.jpg" alt="Jesse Tino"> -->
  <span class="availability_status online"></span>
</div>
<p class="chat_p">User Name</p>
<span id="appLiveTimershow"></span>
<div class="text-right ml-auto">
  <a class="btn start_btn mt-2 " id="liveChatButtonStart" onclick="liveChatStart('liveChatButtonStart','appLiveTimershow')">Start</a>
  <!-- <a class="btn start_btn mt-2 liveChatButtonStop"  onclick="liveChatStart()">Stop</a> -->
</div>

</div>
<div class="chat-box-body">
  <div class="chat-logs chat-history">
    <ul>
    @if(!empty($liveChats))
    @foreach($liveChats as $liveChat)
    @if($liveChat->status == 1)
    <div id="cm-msg-2" class="chat-msg user" >          
        <span class="msg-avatar">            
            <img src="https://i.stack.imgur.com/l60Hf.png">          
        </span>          
        <div class="cm-msg-text"><span>{{ $liveChat->message }}</span></br><small>{{ $liveChat->time }}</small></div>        
    </div>
    @else
    <div id="cm-msg-1" class="chat-msg self" >
        <span class="msg-avatar">
            <img src="https://i.stack.imgur.com/l60Hf.png">
        </span>          
        <div class="cm-msg-text"><span>{{ $liveChat->message }}</span></br><small style="float:right;">{{ $liveChat->time }}</small></div>        
    </div>
    @endif
    @endforeach 
    @endif
  </ul>
  </div>
  <!--chat-log -->
</div>
<div class="chat-input">
<form id="chatAjax_ids" method="POST" action="{{ route("admin.counselor-chat-live.liveChat") }}" enctype="multipart/form-data">
@csrf
    <input class="form-control" type="text" name="message" id="chat-input" oninput="checkmsglive(this)"  placeholder="Send a message..." required>
    <input class="form-control" type="hidden" name="counselor_id"  id="counselor_id" value=" @if(!empty($getLiveChats->counselor_id)) {{ $getLiveChats->counselor_id }} @else @endif">
    <input class="form-control" type="hidden" id="user_id"  name="user_id" value=" @if(!empty($getLiveChats->user_id)) {{ $getLiveChats->user_id }} @else @endif">
    <input class="form-control" type="hidden" name="category_id" id="category_iddd" value=" @if(!empty($getLiveChats->category_id)) {{ $getLiveChats->category_id }} @else @endif">
      
    <input type="hidden" id="urlUpdatechat" value='{{ route("admin.counselor-chat-update-chat-live.update_chat_live_ajax",$getLiveChats->user_id ) }}'>

    <input type="hidden" id="urlChatStart" value='{{ route("admin.counselor-start-chat-live.start_chat_live_ajax",$getLiveChats->user_id ) }}'>

    <a class="btn attachment"><i class="mdi mdi-paperclip"></i></a>
    <a class="btn emoji"><i class="mdi mdi-emoticon"></i></a>
    <button  type="submit" class="chat-submit" id="liveChatbutton" disabled><i class="material-icons mdi mdi-send"></i></button>
  </form>
</div>
<div class="chat_footer">
<button class="btn btn-chat-footer btn-sm" id="myBtn">Escalate</button>

    <!-- The Modal -->
    <div id="myModal2" class="modal2">
      <!-- Modal content -->
      <div class="modal-content2" align="center">
        <div>
            <h3> Choose any Option
                  <span class="close2">&times;</span> </h3>
        </div>
        <hr>
          <div>
          <a class="btn btn-gradient-primary btn-rounded" id="myBtn" href=" @if(!empty($getLiveChats->getUser->id))  {{ route('admin.user-assign-admin.userAssignAdmin', $getLiveChats->getUser->id) }} @else  @endif "><button class="btn btn-chat-footer inbtns btn-sm " style="margin:5px;">Inappropriate</button></a>
          <a class="btn btn-gradient-primary btn-rounded" id="myBtn" href=" @if(!empty($getLiveChats->getUser->id))  {{ route('admin.user-assign-admin.userAssignAdmin', $getLiveChats->getUser->id) }} @else  @endif "><button class="btn btn-chat-footer inbtns btn-sm " style="margin:5px;"> Reassign User</button></a>
          <a class="btn btn-gradient-primary btn-rounded" id="myBtn" href=" @if(!empty($getLiveChats->getUser->id))  {{ route('admin.user-assign-admin.userAssignAdmin', $getLiveChats->getUser->id) }} @else  @endif "><button class="btn btn-chat-footer inbtns btn-sm " style="margin:5px;">User At Risk </button></a>
        </div>
      </div>
    </div>
    <a href="@if(!empty($getLiveChats->getUser->id)) {{ route('admin.chat-closed-live.closeChatLive', $getLiveChats->getUser->id) }} @else  @endif "><button class="btn btn-chat-footer btn-sm" id="feedbackBtn">Close Chat</button></a>
    <!-- The Modal -->
    <div id="myModal1" class="modal1">
      <!-- Modal content -->
      <div class="modal-content1">
        <span class="close1">&times;</span>
        <input type="text" class="form-control">
        <button class="btn">Submit</button>
      </div>
    </div>
  </div>
</div>
</div>
<script src="{{asset('public/chatboat/assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('public/chatboat/assets/vendors/chart.js/Chart.min.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('public/chatboat/assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('public/chatboat/assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('public/chatboat/assets/js/misc.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="{{asset('public/chatboat/assets/js/chart.js')}}"></script>
  <script src="{{asset('public/chatboat/assets/js/liveTimer.js')}}"></script>
  <script src="{{asset('public/chatboat/assets/js/chat.js')}}"></script>
  <script src="{{asset('public/chatboat/assets/js/modal.js')}}"></script>


  <script>
    $('.chat-history,ul,div').animate({scrollTop: 9999999999});

    $(document).on("click", function(e){
        if($(e.target).is("#period_select_range_btn")){
          $("#selectPeriodRangePanel").show();
        }else{
            $("#selectPeriodRangePanel").hide();
        }
    });
</script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: 'AIzaSyBVwfEvl5Gtmi1u6Tq5q0pCDbfPugenQYE',
        authDomain: 'tam-app-dev.firebaseapp.com',
        databaseURL: 'https://auth-db582.hstgr.io/index.php?db=u141015763_db_tam',
        projectId: 'tam-app-dev',
        storageBucket: 'tam-app-dev.appspot.com',
        messagingSenderId: '906777746662',
        appId: '1:906777746662:web:e4d6e511e2a1a4245d2f27',
        measurementId: 'G-BEFLVMNWLB',
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
 
    messaging.onMessage(function (payload) {
      var userId = parseFloat(payload.data.user_id);
      var categoryId = parseFloat(payload.data.category_id);
      var thisKey = payload.data.key;    
      update_chat_history_data();
      if(thisKey == "async_user_message")
      {
        // $.ajax({
        //     url: "{{url('admin/counselor-assign-user-chat')}}/"+ userId + "/" + categoryId,
        //     method: 'GET',
        //     success: function(data) {
        //       console.log('result');
        //        console.log(data);
        //        // $('#employee_district_id').html(data.html);
        //     }
        // });
      }
    });


    $(document).on('submit', 'form#chatAjax_ids', function (e) {
      var msg = $('#chat-input').val();
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                success: function (result) {
                    if (result.success == true) {
                       $('.chat-logs').append(result.data);
                       $('#chat-input').val('');
                       document.getElementById("chat-input").placeholder = "Type message here..";
                       $('.chat-history,ul,div').animate({scrollTop: 9999999999});
                    }
                  
                },
            });
    });


    $(document).ready(function(){
         
        setInterval(function(){
            update_chat_history_data();
        }, 1000);
    });

     function update_chat_history_data(){
        var counselor_id = $('#counselor_id').val();
        var user_id = $('#user_id').val();
        var urlUpdate = $('#urlUpdatechat').val();
        $.ajax({
             url: urlUpdate,
             method:"GET",
             data:{user_id:user_id,counselor_id:counselor_id},        
             success: function(dataResult){

              if (dataResult.success == true) {
                  $('.chat-history,ul,div').animate({scrollTop: 9999999999});
                  $('.chat-logs').append(dataResult.data);
              }
             }
         });       
    }


    // Live msg check whiteSpace 
        function checkmsglive(obj){
            var msg =$(obj).val();
            if (msg.replace(/\s/g, "").length) {                
                document.getElementById("liveChatbutton").disabled = false;
            } else {
                document.getElementById("liveChatbutton").disabled = true;
            }        
        }
    // End validation 

</script>


@endsection