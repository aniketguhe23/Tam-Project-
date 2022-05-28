@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tamhub.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tamhubs.update", [$tamhub->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="organisation_name">{{ trans('cruds.tamhub.fields.organisation_name') }}</label>
                        <input class="form-control {{ $errors->has('organisation_name') ? 'is-invalid' : '' }}" type="text" name="organisation_name" id="organisation_name" value="{{ old('organisation_name', $tamhub->organisation_name) }}" required>
                        @if($errors->has('organisation_name'))
                            <span class="text-danger">{{ $errors->first('organisation_name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.tamhub.fields.organisation_name_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="areas">{{ trans('cruds.tamhub.fields.areas') }}</label>
                        <input class="form-control {{ $errors->has('areas') ? 'is-invalid' : '' }}" type="text" name="areas" id="areas" value="{{ old('areas', $tamhub->areas) }}" required>
                        @if($errors->has('areas'))
                            <span class="text-danger">{{ $errors->first('areas') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.tamhub.fields.areas_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="special_note">{{ trans('cruds.tamhub.fields.special_note') }}</label>
                        <input class="form-control {{ $errors->has('special_note') ? 'is-invalid' : '' }}" type="text" name="special_note" id="special_note" value="{{ old('special_note', $tamhub->special_note) }}" required>
                        @if($errors->has('special_note'))
                            <span class="text-danger">{{ $errors->first('special_note') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.tamhub.fields.special_note_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="email_id">{{ trans('cruds.tamhub.fields.email_id') }}</label>
                        <input class="form-control {{ $errors->has('email_id') ? 'is-invalid' : '' }}" type="text" name="email_id" id="email_id" value="{{ old('email_id', $tamhub->email_id) }}" required>
                        @if($errors->has('email_id'))
                            <span class="text-danger">{{ $errors->first('email_id') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.tamhub.fields.email_id_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="address">{{ trans('cruds.tamhub.fields.address') }}</label>
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $tamhub->address) }}" required>
                        @if($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.tamhub.fields.address_helper') }}</span>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="required" for="city">{{ trans('cruds.tamhub.fields.city') }}</label>
                            <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $tamhub->city) }}" required>
                            @if($errors->has('city'))
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tamhub.fields.city_helper') }}</span>
                    </div>
                    <div class="form-group">
                            <label class="required" for="services">{{ trans('cruds.tamhub.fields.services') }}</label>
                            <input class="form-control {{ $errors->has('services') ? 'is-invalid' : '' }}" type="text" name="services" id="services" value="{{ old('services', $tamhub->services) }}" required>
                            @if($errors->has('services'))
                                <span class="text-danger">{{ $errors->first('services') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tamhub.fields.services_helper') }}</span>
                    </div>
                    <div class="form-group">
                            <label class="required" for="contact_no">{{ trans('cruds.tamhub.fields.contact_no') }}</label>
                            <input class="form-control {{ $errors->has('contact_no') ? 'is-invalid' : '' }}" type="text" name="contact_no" id="contact_no" value="{{ old('contact_no', $tamhub->contact_no) }}" required>
                            @if($errors->has('contact_no'))
                                <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tamhub.fields.contact_no_helper') }}</span>
                    </div>
                    <div class="form-group">
                            <label class="required" for="website_link">{{ trans('cruds.tamhub.fields.website_link') }}</label>
                            <input class="form-control {{ $errors->has('website_link') ? 'is-invalid' : '' }}" type="text" name="website_link" id="website_link" value="{{ old('website_link', $tamhub->website_link) }}" required>
                            @if($errors->has('website_link'))
                                <span class="text-danger">{{ $errors->first('website_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tamhub.fields.website_link_helper') }}</span>
                    </div>
                </div>
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