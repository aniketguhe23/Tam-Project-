@extends('layouts.admin')
@section('content')
@can('library_category_create')
    <a class="btn btn-primary" href="{{ route('admin.librarycategorys.create') }}">
     Add Library Categories
    </a>
@endcan
<div class="card">
    <div class="card-header">
       TamHub Library Categories
    </div>
    <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.librarycategory.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.librarycategory.fields.library_category') }}
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  $i = 1;?>
                    @foreach($librarycategorys as $key => $librarycategory)
                        <tr data-entry-id="{{ $librarycategory->id }}">
                            <td></td>
                            <td> <?php echo $i; $i++ ;?></td>
                            <td> {{$librarycategory->library_category}}</td>
                            
                                <td>
                                    @can('library_category_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.librarycategorys.show', $librarycategory->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('library_category_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.librarycategorys.edit', $librarycategory->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('library_category_delete')
                                        <form action="{{ route('admin.librarycategorys.destroy', $librarycategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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