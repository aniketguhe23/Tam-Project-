@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       <i class="fas fa-edit"></i> {{ trans('cruds.librarycategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.librarycategorys.update", [$librarycategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="library_category">{{ trans('cruds.librarycategory.fields.library_category') }}</label>
                <input class="form-control {{ $errors->has('library_category') ? 'is-invalid' : '' }}" type="text" name="library_category" id="library_category" value="{{ old('library_category', $librarycategory->library_category) }}" required>
                @if($errors->has('library_category'))
                    <span class="text-danger">{{ $errors->first('library_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.librarycategory.fields.library_category_helper') }}</span>
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