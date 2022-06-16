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
                <div class="col-md-2">
                    <label class="required" for="counselor_name">Counsellor Name</label>    
                        <select class="form-control select2 {{ $errors->has('counselor_name') ? 'is-invalid' : '' }}" name="counselor_name" id="counselor_name">
                            @foreach($counselors as $counselor) 
                            <option> {{ $counselor->name}}  </option>
                            @endforeach
                        </select>
                </div>
                <div class="col-md-2">
                    <label class="required" for="category_id">Category</label>    
                        <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                        @foreach($categorys as $categorys) 
                            <option> {{ $categorys->category_name}} </option>
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
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.current_cases.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.current_cases.fields.current_cases_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.current_cases.fields.current_cases_age') }}
                            </th>
                            <th>
                                {{ trans('cruds.current_cases.fields.current_cases_gender') }}
                            </th>
                            <th>
                                {{ trans('cruds.current_cases.fields.current_cases_topic') }}
                            </th>
                            <th>
                                {{ trans('cruds.current_cases.fields.current_cases_chat_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.current_cases.fields.current_cases_assigment') }}
                            </th>
                            <th>
                                {{ trans('cruds.current_cases.fields.current_cases_categories') }}
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  $i = 1;?>
                    @foreach($counselorcurrentcasess as $key => $counselorcurrentcases)
                            <tr data-entry-id="{{ $counselorcurrentcases->id }}">
                                <td></td>
                                <td>{{ $counselorcurrentcases->id }}</td>
                                <td>{{ $counselorcurrentcases->getUser->name }} </td>
                                <td>{{ $counselorcurrentcases->getUser->age }} </td>
                                <td>{{ $counselorcurrentcases->getUser->gender }} </td>
                                <td>{{ $counselorcurrentcases->getUser->topic }} </td>
                                <td>{{ $counselorcurrentcases->chat_type }} </td>
                                <td>{{ $counselorcurrentcases->getCounselor->name }} </td>
                                <td>{{ $counselorcurrentcases->getCategory->category_name }} </td>
                                <td>
                                    @can('counselor_current_cases_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.counselorcurrentcases.show', $counselorcurrentcases->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('counselor_current_cases_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.counselorcurrentcases.edit', $counselorcurrentcases->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('counselor_current_cases_delete')
                                        <form action="{{ route('admin.counselorcurrentcases.destroy', $counselorcurrentcases->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection