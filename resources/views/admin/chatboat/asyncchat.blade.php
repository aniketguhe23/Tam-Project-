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
              <img class="img_circle" src="http://askavenue.com/img/17.jpg" alt="Jesse Tino">
              <span class="availability_status online"></span>
              </div>
              <span id="app"></span>

            </div>
            <div class="chat-box-body">
              <div class="chat-logs">
                @if(!empty($asyncChats))
                @foreach($asyncChats as $asyncChat)
                @if($asyncChat->status == 1)
                <div id="cm-msg-2" class="chat-msg user" >          
                    <span class="msg-avatar">            
                        <img src="https://i.stack.imgur.com/l60Hf.png">          
                    </span>          
                    <div class="cm-msg-text"><span>{{ $asyncChat->message }}</span></br><small>{{ $asyncChat->time }}</small></div>        
                </div>
                @else
                <div id="cm-msg-1" class="chat-msg self" >
                    <span class="msg-avatar">
                        <img src="https://i.stack.imgur.com/l60Hf.png">
                    </span>          
                    <div class="cm-msg-text"><span>{{ $asyncChat->message }}</span></br><small style="float:right;">{{ $asyncChat->time }}</small></div>        
                </div>
                @endif
                @endforeach 
                @endif
              </div>
              <!--chat-log -->
            </div>
            <div class="chat-input">
            <form method="POST" action="{{ route("admin.counselor-chat.chat") }}" enctype="multipart/form-data">
            @csrf
                <input class="form-control" type="text" name="message" id="chat-input" placeholder="Send a message...">
                <input class="form-control" type="hidden" name="counselor_id" value="{{ $counselorCategoryUsers->counselor_id }}">
                <input class="form-control" type="hidden" id="user_id"  name="user_id" value="{{ $counselorCategoryUsers->user_id }}">
                <input class="form-control" type="hidden" name="category_id" value="{{ $counselorCategoryUsers->category_id }}">
                
                <button class="btn attachment"><i class="mdi mdi-paperclip"></i></button>
                <button class="btn emoji"><i class="mdi mdi-emoticon"></i></button>
                <button  type="submit" class="chat-submit"><i class="material-icons mdi mdi-send"></i></button>
              </form>
            </div>
            <div class="chat_footer">
             <a class="btn btn-gradient-primary btn-rounded btn-icon" id="myBtn" href="{{ route('admin.user-assign-admin.userAssignAdmin', $counselorCategoryUsers->getUser->id) }}">
                  Report chat
              </a>
              <a class="btn btn-gradient-primary btn-rounded btn-icon" id="myBtn" href="{{ route('admin.user-assign-admin.userAssignAdmin', $counselorCategoryUsers->getUser->id) }}">
                  Inappropriate
              </a>
              <a class="btn btn-gradient-primary btn-rounded btn-icon" id="myBtn" href="{{ route('admin.user-assign-admin.userAssignAdmin', $counselorCategoryUsers->getUser->id) }}">
                  User At Risk
              </a>
              <a class="btn btn-gradient-primary btn-rounded btn-icon" id="myBtn" href="{{ route('admin.user-assign-admin.userAssignAdmin', $counselorCategoryUsers->getUser->id) }}">
                  Reassign User
              </a>
             <a class="btn btn-gradient-primary btn-rounded btn-icon" href="{{ route('admin.chat-closed.closeChat', $counselorCategoryUsers->getUser->id) }}">
                  Close
                </a>
              <a class="btn btn-gradient-primary btn-rounded btn-icon" id="myBtn" href="{{ route('admin.user-assign-admin.userAssignAdmin', $counselorCategoryUsers->getUser->id) }}">
                  User InActive
              </a>
              <a class="btn btn-gradient-primary btn-rounded btn-icon" id="myBtn" href="{{ route('admin.user-assign-admin.userAssignAdmin', $counselorCategoryUsers->getUser->id) }}">
                  Chat Report 
              </a>
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
  <script src="{{asset('public/chatboat/assets/js/chat.js')}}"></script>
  <script>
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
      if(thisKey == "async_user_message")
      {
        $.ajax({
            url: "{{url('admin/counselor-assign-user-chat')}}/"+ userId + "/" + categoryId,
            method: 'GET',
            success: function(data) {
              console.log('result');
               console.log(data);
               // $('#employee_district_id').html(data.html);
            }
        });
      } else
      {
        alert("not match");
      }
    });
</script>


@endsection