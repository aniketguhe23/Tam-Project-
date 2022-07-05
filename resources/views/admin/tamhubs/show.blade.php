@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tamhub.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tamhubs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table   table-striped">
                <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.id') }}
                    </th>
                    <td>
                            {{ $tamhub->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.organisation_name') }}
                    </th>
                    <td>
                            {{ $tamhub->organisation_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.city') }}
                    </th>
                    <td>
                            {{ $tamhub->city }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.areas') }}
                    </th>
                    <td>
                            {{ $tamhub->areas }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.services') }}
                    </th>
                    <td>
                            {{ $tamhub->services }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.special_note') }}
                    </th>
                    <td>
                            {{ $tamhub->special_note }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.contact_no') }}
                    </th>
                    <td>
                            {{ $tamhub->contact_no }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.email_id') }}
                    </th>
                    <td>
                            {{ $tamhub->email_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.website_link') }}
                    </th>
                    <td>
                            {{ $tamhub->website_link }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.tamhub.fields.address') }}
                    </th>
                    <td>
                            {{ $tamhub->address }}
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tamhubs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection