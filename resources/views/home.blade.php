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
@parent

@endsection