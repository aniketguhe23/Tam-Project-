@extends('layouts.admin')
@section('content')
@can('privacy_policy_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.privacypolicys.create') }}">
               Privacy Policy Add
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.privacypolicy.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-privacypolicy">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.privacypolicy.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.privacypolicy.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.privacypolicy.fields.token_key') }}
                        </th>
                        <th>
                            {{ trans('cruds.privacypolicy.fields.url') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($privacypolicys as $key => $privacypolicy)
                        <tr data-entry-id="{{ $privacypolicy->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $privacypolicy->id ?? '' }}
                            </td>
                            <td>
                                {{ $privacypolicy->title ?? '' }}
                            </td>
                            <td>
                                {{ $privacypolicy->token_key ?? '' }}
                            </td>
                            <td>
                                {{ $privacypolicy->url ?? '' }}
                            </td>
                            <td>
                                @can('privacy_policy_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.privacypolicys.show', $privacypolicy->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('privacy_policy_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.privacypolicys.edit', $privacypolicy->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('privacy_policy_delete')
                                    <form action="{{ route('admin.privacypolicys.destroy', $privacypolicy->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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