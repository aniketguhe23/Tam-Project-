@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.privacypolicy.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.privacypolicys.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.privacypolicy.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.privacypolicy.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="token_key">{{ trans('cruds.privacypolicy.fields.token_key') }}</label>
                <input class="form-control {{ $errors->has('token_key') ? 'is-invalid' : '' }}" type="text" name="token_key" id="token_key" value="{{ old('token_key', '') }}" required>
                @if($errors->has('token_key'))
                    <span class="text-danger">{{ $errors->first('token_key') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.privacypolicy.fields.token_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="url">{{ trans('cruds.privacypolicy.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', '') }}" required>
                @if($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.privacypolicy.fields.url_helper') }}</span>
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