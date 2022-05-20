@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.customer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.customers.update", [$customer->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="customer_name">{{ trans('cruds.customer.fields.customer_name') }}</label>
                <input class="form-control {{ $errors->has('customer_name') ? 'is-invalid' : '' }}" type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $customer->customer_name) }}" required>
                @if($errors->has('customer_name'))
                    <span class="text-danger">{{ $errors->first('customer_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.customer_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="firm_name">{{ trans('cruds.customer.fields.firm_name') }}</label>
                <input class="form-control {{ $errors->has('firm_name') ? 'is-invalid' : '' }}" type="text" name="firm_name" id="firm_name" value="{{ old('firm_name', $customer->firm_name) }}">
                @if($errors->has('firm_name'))
                    <span class="text-danger">{{ $errors->first('firm_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.firm_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobile_no">{{ trans('cruds.customer.fields.mobile_no') }}</label>
                <input class="form-control {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" type="number" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', $customer->mobile_no) }}" step="1" required>
                @if($errors->has('mobile_no'))
                    <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.mobile_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.customer.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $customer->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.customer.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address', $customer->address) }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="district">{{ trans('cruds.customer.fields.district') }}</label>
                <input class="form-control {{ $errors->has('district') ? 'is-invalid' : '' }}" type="text" name="district" id="district" value="{{ old('district', $customer->district) }}">
                @if($errors->has('district'))
                    <span class="text-danger">{{ $errors->first('district') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.district_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.customer.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $customer->city) }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_birth">{{ trans('cruds.customer.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $customer->date_of_birth) }}">
                @if($errors->has('date_of_birth'))
                    <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_anniversary">{{ trans('cruds.customer.fields.date_of_anniversary') }}</label>
                <input class="form-control {{ $errors->has('date_of_anniversary') ? 'is-invalid' : '' }}" type="text" name="date_of_anniversary" id="date_of_anniversary" value="{{ old('date_of_anniversary', $customer->date_of_anniversary) }}">
                @if($errors->has('date_of_anniversary'))
                    <span class="text-danger">{{ $errors->first('date_of_anniversary') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.date_of_anniversary_helper') }}</span>
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