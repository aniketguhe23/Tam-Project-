@extends('layouts.admin')
@section('content')
@can('counselor_current_cases_create')
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.current_cases.title_singular') }} {{ trans('global.list') }}
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
                                @can('counselor_current_cases_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.counselorcurrentcases.show', 1) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('counselor_current_cases_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.counselorcurrentcases.edit', 1) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('counselor_current_cases_delete')
                                    <form action="{{ route('admin.counselorcurrentcases.destroy', 1) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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