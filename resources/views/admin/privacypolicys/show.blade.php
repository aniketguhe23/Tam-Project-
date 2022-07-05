@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.privacypolicy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.privacypolicys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table   table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.privacypolicy.fields.id') }}
                        </th>
                        <td>
                            {{ $privacypolicy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privacypolicy.fields.title') }}
                        </th>
                        <td>
                            {{ $privacypolicy->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privacypolicy.fields.token_key') }}
                        </th>
                        <td>
                            {{ $privacypolicy->token_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privacypolicy.fields.url') }}
                        </th>
                        <td>
                            {{ $privacypolicy->url }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.privacypolicys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection