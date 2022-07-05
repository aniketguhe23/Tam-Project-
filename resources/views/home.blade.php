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
@endsection