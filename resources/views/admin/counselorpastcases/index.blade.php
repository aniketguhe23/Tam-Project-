@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
      Past Chats
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
                    <label class="required" for="counselor_name">Counselor Name</label>    
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
                            Chats Filter
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
                            {{ trans('cruds.counselor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.date') }}
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
                            {{ trans('cruds.counselor.fields.chat_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.feedback') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                 
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                           
                            <td>
                                @can('user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.counselors.show', 1) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.counselors.edit', 1) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_delete')
                                    <form action="{{ route('admin.counselors.destroy', 1) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection