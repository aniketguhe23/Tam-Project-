@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       <i class="fas fa-edit"></i> {{ trans('cruds.library.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.librarys.update", [$library->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="library_category_id">Category</label>
                <select class="form-control select2 {{ $errors->has('library_category_id') ? 'is-invalid' : '' }}" name="library_category_id" id="library_category_id">
                @if(!empty($librarycategorys))   
                @foreach($librarycategorys as $id => $librarycategorys)
                        <option value="{{ $id }}" {{ old('library_category_id') == $id ? 'selected' : '' }}>{{ $librarycategorys->library_category }}</option>
                    @endforeach
                @endif
                </select>
                @if($errors->has('library_category_id'))
                    <span class="text-danger">{{ $errors->first('library_category_id') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="link">{{ trans('cruds.library.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $library->link) }}" required>
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.library.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="source">{{ trans('cruds.library.fields.source') }}</label>
                <input class="form-control {{ $errors->has('source') ? 'is-invalid' : '' }}" type="text" name="source" id="source" value="{{ old('source', $library->source) }}" required>
                @if($errors->has('source'))
                    <span class="text-danger">{{ $errors->first('source') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.library.fields.source_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.library.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $library->description) }}" required>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.library.fields.description_helper') }}</span>
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