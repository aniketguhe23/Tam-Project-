@extends('layouts.admin')
@section('content')
@can('bookappointment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bookappointments.create') }}">
               Url
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bookappointment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-bookappointment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bookappointment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookappointment.fields.url') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookappointments as $key => $bookappointment)
                        <tr data-entry-id="{{ $bookappointment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bookappointment->id ?? '' }}
                            </td>
                            <td>
                                {{ $bookappointment->url ?? '' }}
                            </td>
                            <td>
                                @can('bookappointment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bookappointments.show', $bookappointment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bookappointment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bookappointments.edit', $bookappointment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bookappointment_delete')
                                    <form action="{{ route('admin.bookappointments.destroy', $bookappointment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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