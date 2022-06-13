@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.library.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.librarys.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="link">{{ trans('cruds.library.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}" required>
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.library.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="source">{{ trans('cruds.library.fields.source') }}</label>
                <input class="form-control {{ $errors->has('source') ? 'is-invalid' : '' }}" type="text" name="source" id="source" value="{{ old('source', '') }}" required>
                @if($errors->has('source'))
                    <span class="text-danger">{{ $errors->first('source') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.library.fields.source_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.library.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}" required>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.library.fields.description_helper') }}</span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}vv
                </button>
                @can('library_access')
                    <a class="btn btn-primary" href="{{ route('admin.librarys.index') }}">
                        Library
                    </a>
                @endcan
            </div>
        </form>
    </div>
</div>
@endsection