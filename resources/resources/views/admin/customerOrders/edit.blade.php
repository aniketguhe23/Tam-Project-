@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.customerOrder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.customer-orders.update", [$customerOrder->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="customer_id">{{ trans('cruds.customerOrder.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id" required>
                    @foreach($customers as $id => $customer)
                        <option value="{{ $id }}" {{ (old('customer_id') ? old('customer_id') : $customerOrder->customer->id ?? '') == $id ? 'selected' : '' }}>{{ $customer }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <span class="text-danger">{{ $errors->first('customer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerOrder.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="design_id">{{ trans('cruds.customerOrder.fields.design') }}</label>
                <select class="form-control select2 {{ $errors->has('design') ? 'is-invalid' : '' }}" name="design_id" id="design_id" required>
                    @foreach($designs as $id => $design)
                        <option value="{{ $id }}" {{ (old('design_id') ? old('design_id') : $customerOrder->design->id ?? '') == $id ? 'selected' : '' }}>{{ $design }}</option>
                    @endforeach
                </select>
                @if($errors->has('design'))
                    <span class="text-danger">{{ $errors->first('design') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerOrder.fields.design_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="purity">{{ trans('cruds.customerOrder.fields.purity') }}</label>
                <input class="form-control {{ $errors->has('purity') ? 'is-invalid' : '' }}" type="text" name="purity" id="purity" value="{{ old('purity', $customerOrder->purity) }}" required>
                @if($errors->has('purity'))
                    <span class="text-danger">{{ $errors->first('purity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerOrder.fields.purity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="weight">{{ trans('cruds.customerOrder.fields.weight') }}</label>
                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="text" name="weight" id="weight" value="{{ old('weight', $customerOrder->weight) }}" required>
                @if($errors->has('weight'))
                    <span class="text-danger">{{ $errors->first('weight') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerOrder.fields.weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="size">{{ trans('cruds.customerOrder.fields.size') }}</label>
                <input class="form-control {{ $errors->has('size') ? 'is-invalid' : '' }}" type="text" name="size" id="size" value="{{ old('size', $customerOrder->size) }}" required>
                @if($errors->has('size'))
                    <span class="text-danger">{{ $errors->first('size') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerOrder.fields.size_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.customerOrder.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', $customerOrder->quantity) }}" required>
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerOrder.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_date">{{ trans('cruds.customerOrder.fields.delivery_date') }}</label>
                <input class="form-control date {{ $errors->has('delivery_date') ? 'is-invalid' : '' }}" type="text" name="delivery_date" id="delivery_date" value="{{ old('delivery_date', $customerOrder->delivery_date) }}">
                @if($errors->has('delivery_date'))
                    <span class="text-danger">{{ $errors->first('delivery_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerOrder.fields.delivery_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.customerOrder.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark', $customerOrder->remark) }}</textarea>
                @if($errors->has('remark'))
                    <span class="text-danger">{{ $errors->first('remark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customerOrder.fields.remark_helper') }}</span>
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