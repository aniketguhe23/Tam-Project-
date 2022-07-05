@extends('layouts.admin')
@section('content')
@can('library_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.librarycategorys.create') }}">
               Add Library Categories
            </a>
            <a class="btn btn-success" href="{{ route('admin.librarys.create') }}">
               Add Data
            </a>
           
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
       TamHub Library
    </div>
    <div class="card-body">
            <div class="table-responsive">
                <table class=" table   table-striped   datatable datatable-User">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.library.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.library.fields.library_category') }}
                            </th>
                            <th>
                                {{ trans('cruds.library.fields.link') }}
                            </th>
                            <th>
                                {{ trans('cruds.library.fields.source') }}
                            </th>
                            <th>
                                {{ trans('cruds.library.fields.description') }}
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  $i = 1;?>
                    @foreach($librarys as $key => $library)
                        <tr data-entry-id="{{ $library->id }}">
                            <td></td>
                            <td> <?php echo $i; $i++ ;?></td>
                            <td>  
                                @foreach($librarycategorys as $librarycategory)
                                        {{ $librarycategory->library_category }}
                                @endforeach
                            </td>
                            <td> {{$library->link}}</td>
                            <td> {{$library->source}}</td>
                            <td> {{$library->description}}</td>
                            
                                <td>
                                    @can('library_show')
                                        <a class=" btn btn-gradient-primary btn-rounded btn-icon" href="{{ route('admin.librarys.show', $library->id) }}">
                                           <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    @endcan

                                    @can('library_edit')
                                        <a class="btn btn-gradient-primary btn-rounded btn-icon" href="{{ route('admin.librarys.edit', $library->id) }}">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('library_delete')
                                        <form action="{{ route('admin.librarys.destroy', $library->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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