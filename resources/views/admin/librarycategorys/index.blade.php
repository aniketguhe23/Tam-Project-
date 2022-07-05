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
                <table class=" table   table-striped   datatable datatable-User">
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
                                        <a class=" btn btn-gradient-primary btn-rounded btn-icon" href="{{ route('admin.librarycategorys.show', $librarycategory->id) }}">
                                           <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    @endcan

                                    @can('library_category_edit')
                                        <a class="btn btn-gradient-primary btn-rounded btn-icon" href="{{ route('admin.librarycategorys.edit', $librarycategory->id) }}">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('library_category_delete')
                                        <form action="{{ route('admin.librarycategorys.destroy', $librarycategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                             <button type="submit" class="btn btn-gradient-primary btn-rounded btn-icon"><i class="fa fa-trash" aria-hidden="true"></i></button>
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