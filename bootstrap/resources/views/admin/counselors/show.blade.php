@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.counselor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.counselors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th>{{ trans('cruds.user.fields.id') }}</th>
                    <td>{{ $counselor->id }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.counselor.fields.counselor_name') }}</th>
                    <td>{{ $counselor->name }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.counselor.fields.category') }}</th>
                    <td>       </td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.counselor.fields.email') }}</th>
                    <td>{{ $counselor->email }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.counselor.fields.phone_no') }}</th>
                    <td>{{ $counselor->phone_no }}</td>
                </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.counselors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection