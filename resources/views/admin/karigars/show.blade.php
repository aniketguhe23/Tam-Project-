@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.karigar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.karigars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.id') }}
                        </th>
                        <td>
                            {{ $karigar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.name') }}
                        </th>
                        <td>
                            {{ $karigar->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.mobile_no') }}
                        </th>
                        <td>
                            {{ $karigar->mobile_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.alternate_mobile_no') }}
                        </th>
                        <td>
                            {{ $karigar->alternate_mobile_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.email') }}
                        </th>
                        <td>
                            {{ $karigar->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.address') }}
                        </th>
                        <td>
                            {{ $karigar->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.district') }}
                        </th>
                        <td>
                            {{ $karigar->district }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.city') }}
                        </th>
                        <td>
                            {{ $karigar->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $karigar->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigar.fields.date_of_anniversary') }}
                        </th>
                        <td>
                            {{ $karigar->date_of_anniversary }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.karigars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection