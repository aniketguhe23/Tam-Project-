@extends('layouts.admin')
@section('content')
@can('resource_category_create')
    <a class="btn btn-primary" href="{{ route('admin.resourcecategorys.create') }}">
    {{ trans('global.create') }} {{ trans('cruds.resourcecategory.title_singular') }}
    </a>
@endcan
<div class="card">
    <div class="card-header">
       TamHub Resource Categories
    </div>
    <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.resourcecategory.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.resourcecategory.fields.resource_category') }}
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  $i = 1;?>
                    @foreach($resourcecategorys as $key => $resourcecategory)
                        <tr data-entry-id="{{ $resourcecategory->id }}">
                            <td></td>
                            <td> <?php echo $i; $i++ ;?></td>
                            <td> {{$resourcecategory->resource_category}}</td>
                            
                                <td>
                                    @can('resource_category_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.resourcecategorys.show', $resourcecategory->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('resource_category_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.resourcecategorys.edit', $resourcecategory->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('resource_category_delete')
                                        <form action="{{ route('admin.resourcecategorys.destroy', $resourcecategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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