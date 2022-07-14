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
    <p> @if(!empty($counselorAssignToUsers->getUser->name)) {{ $counselorAssignToUsers->getUser->name }} @else  @endif</p>
    
          </div><span id="app"></span>
            </div>
            <div class="chat-box-body">
              <div class="chat-logs chat-history" >
                <ul>
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
                </ul>
              </div>
              <!--chat-log -->
            </div>
            <div class="chat-input">
            <form id="chatAjax_ids" method="POST" action="{{ route("admin.counselor-chat.chat") }}" enctype="multipart/form-data">
            @csrf
                <input class="form-control" type="text" name="message" id="chat-input" placeholder="Send a message..." required>
                <input class="form-control" type="hidden" name="counselor_id" id="counselor_id" value="{{ $counselorAssignToUsers->counselor_id }}">
                <input class="form-control" type="hidden" id="user_id"  name="user_id" value="{{ $counselorAssignToUsers->user_id }}">
                <input class="form-control" type="hidden" name="category_id" value="{{ $counselorAssignToUsers->category_id }}">
                
                <input type="hidden" id="urlUpdatechat" value='{{ route("admin.counselor-chat-update-chat.update_chat_ajax",$counselorAssignToUsers->user_id ) }}'>


                <button class="btn attachment"><i class="mdi mdi-paperclip"></i></button>
                <button class="btn emoji"><i class="mdi mdi-emoticon"></i></button>
                <button  type="submit" class="chat-submit"><i class="material-icons mdi mdi-send"></i></button>
              </form>
            </div>
    <div class="chat_footer">
        <button class="btn btn-chat-footer btn-sm" id="myBtn">Escalate</button>
          <!-- The Modal -->
          <div id="myModal2" class="modal2">
            <!-- Modal content -->
            <div class="modal-content2" align="center">
              <div>
                  <h3> Choose any Option <span class="close2">&times;</span> </h3>
              </div>
              <hr>
                <div>

                <a  id="tab1" data-index="Inappropriate" name="report">
                <button class="btn btn-chat-footer inbtns btn-sm " style="margin:5px;"> Inappropriate </button> 
              </a>
              <a id="tab2" data-index="User At Risk" name="report">
              <button class="btn btn-chat-footer inbtns btn-sm " style="margin:5px;"> User At Risk </button>
              </a>
              <a id="tab3" data-index="Reassign User" name="report">
              <button class="btn btn-chat-footer inbtns btn-sm " style="margin:5px;">  Reassign User </button>
              </a>
              </div>
            </div>
          </div>
          <button class="btn btn-chat-footer btn-sm"  id="feedbackBtn">Close Chat</button>
            <!-- <a href="@if(!empty($getLiveChats->getUser->id)) {{ route('admin.chat-closed.closeChat', $getLiveChats->getUser->id) }} @else  @endif "><button class="btn btn-chat-footer btn-sm" id="feedbackBtn">Close Chat</button></a> -->
            <!-- The Modal -->
            <div id="myModal1" class="modal1">
              <!-- Modal content -->
              <div class="modal-content1">
                <span class="close1">&times;</span>
                <input type="text" class="form-control" name="remark" id="remark">
                <button class="btn btn-chat-footer inbtns btn-sm" onClick="chatRemark();" >Submit</button>
              </div>
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
  <script src="{{asset('public/chatboat/assets/js/chat.js')}}"></script>
  <script src="{{asset('public/chatboat/assets/js/modal.js')}}"></script>
  <script>
     $('.chat-history,ul,div').animate({scrollTop: 99999999});
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
    });

     $(document).on('submit', 'form#chatAjax_ids', function (e) {

      var msg = $('#chat-input').val();
      console.log(msg);

        e.preventDefault();
        // $(this).find('button[type="submit"]')
        //     .attr('disabled', true);
        var data = $(this).serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function (result) {
                if (result.success == true) {
                  $('.chat-history,ul,div').animate({scrollTop: 99999999});
                  $('.chat-logs').append(result.data);
                  $('#chat-input').val(' ');
                }  else {
                alert(dataResult.msg);
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
        console.log(counselor_id);
        $.ajax({
             url: urlUpdate,
             method:"GET",
             data:{user_id:user_id,counselor_id:counselor_id},        
             success: function(dataResult){

              if (dataResult.success == true) {
                  $('.chat-history,ul,div').animate({scrollTop: 99999999});
                  $('.chat-logs').append(dataResult.data);
              }
             }
         });       
    }


    $("a[name=report]").on("click", function () { 
    var remark = $(this).data("index"); 
    var user_id = $('#user_id').val();
      $.ajax({
            url: "{{url('admin/user-assign-admin')}}",
            method:"GET",
            data:{user_id:user_id,remark:remark},        
            success: function(data) {
              window.location.href ="{{ route('admin.counselorcurrentcases.index') }}";

            }
      });       
});

    function chatRemark()
    {
      var remark = $('#remark').val();
      var user_id = $('#user_id').val();
      $.ajax({
            url: "{{url('admin/close-chat-async')}}",
            method:"GET",
            data:{user_id:user_id,remark:remark},        
            success: function(data) {
              window.location.href ="{{ route('admin.counselorcurrentcases.index') }}";
            }
      });       
    }
   

</script>


@endsection