@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
      Counselor past cases
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="m-form__section m-form__section--first">
                        <div class="form-group">
                            <label class="form-control-label">From Date</label>
                            <input class="form-control date" type="text" name="fromdate" id="m_datepicker_2" placeholder="Start Date" required>
                        </div>
                    </div>
            </div>
            <div class="col-md-3">
                <div class="m-form__section m-form__section--first">
                        <div class="form-group">
                            <label class="form-control-label">To Date </label>
                            <input class="form-control date" type="text" name="todate" id="m_datepicker_3" placeholder="End Date" required>
                        </div>
                    </div>
            </div>
            <div class="col-md-3">
                <label class="required" for="category_name">Feedback</label>    
                    <select class="form-control select2 {{ $errors->has('category_name') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                        <option> Feedback(1-6) </option>
                        <option>1 </option>
                        <option>2 </option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
            </div>
            <div class="col-md-3">
                <div class="form-group filter">
                    <button class="btn btn-primary" type="submit">
                        Chat Filter
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
                            {{ trans('cruds.counselor.fields.queue_no') }}
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
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td> </td>
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
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.counselors.show', $user->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.counselors.edit', $user->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_delete')
                                    <form action="{{ route('admin.counselors.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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