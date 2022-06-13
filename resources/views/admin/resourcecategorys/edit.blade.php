@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.resourcecategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.resourcecategorys.update", [$resourcecategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="resource_category">{{ trans('cruds.resourcecategory.fields.resource_category') }}</label>
                <input class="form-control {{ $errors->has('resource_category') ? 'is-invalid' : '' }}" type="text" name="resource_category" id="resource_category" value="{{ old('resource_category', $resourcecategory->resource_category) }}" required>
                @if($errors->has('resource_category'))
                    <span class="text-danger">{{ $errors->first('resource_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resourcecategory.fields.resource_category_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection