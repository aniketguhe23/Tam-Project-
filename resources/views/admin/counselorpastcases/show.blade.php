@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('public/chatboat/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/chatboat/assets/vendors/css/vendor.bundle.base.css')}}">

  <link rel="stylesheet" href="{{asset('public/chatboat/assets/css/chatsection.css')}}">
  <link rel="stylesheet" href="{{asset('public/chatboat/assets/js/model.js')}}">

  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('public/chatboat/assets/images/favicon.ico')}}" />
  <meta http-equiv="refresh" content="10"/>
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
                @if(!empty($chatHistorys))
                @foreach($chatHistorys as $chatHistory)
                @if($chatHistory->status == 1)
                <div id="cm-msg-2" class="chat-msg user" >          
                    <span class="msg-avatar">            
                        <img src="https://i.stack.imgur.com/l60Hf.png">          
                    </span>          
                    <div class="cm-msg-text"><span>{{ $chatHistory->message }}</span></br><small>{{ $chatHistory->time }}</small></div>        
                </div>
                @else
                <div id="cm-msg-1" class="chat-msg self" >
                    <span class="msg-avatar">
                        <img src="https://i.stack.imgur.com/l60Hf.png">
                    </span>          
                    <div class="cm-msg-text"><span>{{ $chatHistory->message }}</span></br><small style="float:right;">{{ $chatHistory->time }}</small></div>        
                </div>
                @endif
                @endforeach 
                @endif
              </div>
              <!--chat-log -->
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


@endsection