@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.librarycategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.librarys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table   table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.library.fields.id') }}
                        </th>
                        <td>
                            {{ $library->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.library.fields.library_category') }}
                        </th>
                        <td>
                            @foreach($librarycategorys as $librarycategory)
                            @if($librarycategory->id == $library->library_category_id)
                                {{ $librarycategory->library_category }}
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.library.fields.link') }}
                        </th>
                        <td>
                            {{ $library->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.library.fields.source') }}
                        </th>
                        <td>
                            {{ $library->source }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.library.fields.description') }}
                        </th>
                        <td>
                            {{ $library->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.librarys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection