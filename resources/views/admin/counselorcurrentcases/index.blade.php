@extends('layouts.admin')
@section('content')
@can('counselor_current_cases_create')
@endcan
<div class="card">
    <div class="card-header">
       Current Chats
    </div>
    <div class="card-body">
    <div class="row">
                <div class="col-md-2">
                    <div class="m-form__section m-form__section--first">
                            <div class="form-group">
                                <label class="form-control-label">Start Date</label>
                                <input class="form-control date" type="text" name="fromdate" id="m_datepicker_2" placeholder="Start Date" required>
                            </div>
                        </div>
                </div>
                <div class="col-md-2">
                    <div class="m-form__section m-form__section--first">
                            <div class="form-group">
                                <label class="form-control-label">End Date </label>
                                <input class="form-control date" type="text" name="todate" id="m_datepicker_3" placeholder="End Date" required>
                            </div>
                        </div>
                </div>
                <!-- <div class="col-md-2">
                    <label class="required" for="counselor_name">Counsellor Name</label>    
                        <select class="form-control select2 {{ $errors->has('counselor_name') ? 'is-invalid' : '' }}" name="counselor_name" id="counselor_name">
                            @foreach($counselors as $counselor) 
                            <option> {{ $counselor->name}}  </option>
                            @endforeach
                        </select>
                </div> -->
                <div class="col-md-2">
                    <label class="required" for="category_id">Category</label>    
                        <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                        @foreach($categorys as $category) 
                            <option> {{ $category->category_name}} </option>
                        @endforeach
                        </select>
                </div>
                <div class="col-md-2">
                    <label class="required" for="chat_type">Chat Type</label>    
                        <select class="form-control select2 {{ $errors->has('chat_type') ? 'is-invalid' : '' }}" name="chat_type" id="chat_type">
                            <option> Live chats </option>
                            <option> Async Chats  </option>
                        </select>
                </div>
                <div class="col-md-2">
                    <div class="form-group filter">
                        <button class="btn btn-primary" type="submit">
                        Apply Filter
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class=" table   table-striped   datatable datatable-User">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                             {{ trans('cruds.counselor.fields.id') }}
                        </th>
                        <th>
                         {{ trans('cruds.counselor.fields.user_name') }}
                        </th>
                        <th>
                         {{ trans('cruds.counselor.fields.age') }}
                        </th>
                        <th>
                         {{ trans('cruds.counselor.fields.gender') }}
                        </th>
                        <th>
                         {{ trans('cruds.counselor.fields.topic') }}
                        </th>
                        <th>
                            Chat type
                        </th>
                        <th>
                            Assigment Counsellor	
                        </th>
                        <th>
                            Categories
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  $i = 1;?>
                    @foreach($counselorCurrentChats as $key => $counselorCurrentChat)
                        <tr data-entry-id="{{ $counselorCurrentChat->id }}">
                            <td></td>
                            <td><?php echo $i; $i++ ;?> </td>
                            <td>{{ $counselorCurrentChat->getUser->name }} </td>
                            <td>46 </td>
                            <td>{{ $counselorCurrentChat->getUser->gender }} </td>
                            <td>{{ $counselorCurrentChat->getCategory->category_name }} </td>
                            <td>@if($counselorCurrentChat->chat_type == 0) Async @else Live @endif </td>
                            <td>                               
                            <select  class="form-control select2 {{ $errors->has('counselor_name') ? 'is-invalid' : '' }}" name="counselor_name" id="counselor_name">
                                @foreach($counselors as $counselor) 
                                <option> Please select counselor  </option>
                                <option> {{ $counselor->name}}  </option>
                                @endforeach
                            </select>
                            </td>
                            <td>
                            <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                            @foreach($categorys as $category) 
                            <option> Please select Categories </option>
                                <option> {{ $category->category_name}} </option>
                            @endforeach
                            </select>
                            </td>
                            <td>
                                <a class="btn btn-gradient-primary btn-rounded btn-icon" href="#">
                                    Assignments
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection