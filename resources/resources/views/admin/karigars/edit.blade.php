@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.karigar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.karigars.update", [$karigar->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.karigar.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $karigar->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigar.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobile_no">{{ trans('cruds.karigar.fields.mobile_no') }}</label>
                <input class="form-control {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" type="number" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', $karigar->mobile_no) }}" step="1" required>
                @if($errors->has('mobile_no'))
                    <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigar.fields.mobile_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alternate_mobile_no">{{ trans('cruds.karigar.fields.alternate_mobile_no') }}</label>
                <input class="form-control {{ $errors->has('alternate_mobile_no') ? 'is-invalid' : '' }}" type="number" name="alternate_mobile_no" id="alternate_mobile_no" value="{{ old('alternate_mobile_no', $karigar->alternate_mobile_no) }}" step="1">
                @if($errors->has('alternate_mobile_no'))
                    <span class="text-danger">{{ $errors->first('alternate_mobile_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigar.fields.alternate_mobile_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.karigar.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $karigar->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigar.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.karigar.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $karigar->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigar.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="district">{{ trans('cruds.karigar.fields.district') }}</label>
                <input class="form-control {{ $errors->has('district') ? 'is-invalid' : '' }}" type="text" name="district" id="district" value="{{ old('district', $karigar->district) }}">
                @if($errors->has('district'))
                    <span class="text-danger">{{ $errors->first('district') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigar.fields.district_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.karigar.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $karigar->city) }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigar.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_birth">{{ trans('cruds.karigar.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $karigar->date_of_birth) }}">
                @if($errors->has('date_of_birth'))
                    <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigar.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_anniversary">{{ trans('cruds.karigar.fields.date_of_anniversary') }}</label>
                <input class="form-control date {{ $errors->has('date_of_anniversary') ? 'is-invalid' : '' }}" type="text" name="date_of_anniversary" id="date_of_anniversary" value="{{ old('date_of_anniversary', $karigar->date_of_anniversary) }}">
                @if($errors->has('date_of_anniversary'))
                    <span class="text-danger">{{ $errors->first('date_of_anniversary') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigar.fields.date_of_anniversary_helper') }}</span>
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