@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
      Past Chats
    </div>
    <div class="card-body">
    <div class="row">
                <div class="col-md-3">
                    <div class="m-form__section m-form__section--first">
                            <div class="form-group">
                                <label class="form-control-label">Start Date</label>
                                <input class="form-control date" type="text" name="fromdate" id="m_datepicker_2" placeholder="Start Date" required>
                            </div>
                        </div>
                </div>
                <div class="col-md-3">
                    <div class="m-form__section m-form__section--first">
                            <div class="form-group">
                                <label class="form-control-label">End Date </label>
                                <input class="form-control date" type="text" name="todate" id="m_datepicker_3" placeholder="End Date" required>
                            </div>
                        </div>
                </div>
                <div class="col-md-3">
                    <label class="required" for="chat_type">FeedBack</label>    
                        <select class="form-control select2 {{ $errors->has('chat_type') ? 'is-invalid' : '' }}" name="chat_type" id="chat_type">
                            <option> FeedBack(1-6) </option>
                            <option> 1 </option>
                            <option> 2 </option>
                            <option> 3 </option>
                            <option> 4 </option>
                            <option> 5 </option>
                            <option> 6 </option>
                        </select>
                </div>
                <div class="col-md-3">
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
                            </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection