@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.resourcecategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.resourcecategorys.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.resourcecategory.fields.resource_category') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="resource_category" id="resource_category" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resourcecategory.fields.resource_category_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                @can('category_access')
                    <a class="btn btn-primary" href="{{ route('admin.categorys.index') }}">
                        Resource Categories
                    </a>
                @endcan
            </div>
        </form>
    </div>
</div>
@endsection