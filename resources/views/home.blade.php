@extends('layouts.admin')
@section('content')
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
              </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle" width="200px" height="340px" ></i>
                </li>
                <li>
                @if($sessionCounselorid != 1)
                  @if($getCounselorActive->counselor_availability == 0)
                    <p style="float:right;"><input type="button" class="btn btn-danger" name="availability" onclick="myFunction();" value="InActivate" id="inactive"></p>
                  @else
                    <p style="float:right;"><input type="button" class="btn btn-primary" name="availability" onclick="myFunction();" value="Activate" id="active"></p>
                  @endif 
                @endif
                <?php   
                $sessionCounselorid = Auth::user()->id;
                if($sessionCounselorid != 1)
                {?>
                     <label class="switch"><input type="hidden" class="tuggle"></label>
               <?php }
                  ?>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-4">
                  <img src="{{asset('public/assets/images/dashboard/palate1.png')}}" class="tab1-dashbord" alt="circle-image" />
              </div>
            <div class="col-md-4">
                  <img src="{{asset('public/assets/images/dashboard/palate2.png')}}" class="tab1-dashbord" alt="circle-image" />
            </div>
            <div class="col-md-4">
                  <img src="{{asset('public/assets/images/dashboard/palate3.png')}}" class="tab1-dashbord" alt="circle-image" />
            </div>
          </div>   
          </div>
      <!-- partial -->
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <button onclick="startFCM()"
                    class="btn btn-danger btn-flat">Allow notification
                </button>
            <div class="card mt-3">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('admin.send.notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Message Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Message Body</label>
                            <textarea class="form-control" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  $("document").ready(function(){
  setTimeout(function(){
      $("div.alert").remove();
  }, 5000 ); // 5 secs

});
</script>
<script>
function myFunction()
  {
    var thisUserId = $("input[name=availability]").val();
    if(thisUserId == "Activate")
    {
      var  thisStatus = 2;
    }else{
      var  thisStatus = 1;
    }
    $.ajax({
            url: "{{url('admin/counselor-availability')}}/"+ thisStatus,
            method: 'GET',
            success: function(data) {
              location.reload();
            }
        });
  }
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
    function startFCM() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("admin.store.token") }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token stored.');
                    },
                    error: function (error) {
                        alert(error);
                    },
                });
            }).catch(function (error) {
                alert(error);
            });
    }
    messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
</script>
@endsection