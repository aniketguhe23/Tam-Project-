@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       <i class="fas fa-edit"></i> {{ trans('cruds.bookappointment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bookappointments.update", [$bookappointment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="url">{{ trans('cruds.bookappointment.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $bookappointment->url) }}" required>
                @if($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookappointment.fields.url_helper') }}</span>
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