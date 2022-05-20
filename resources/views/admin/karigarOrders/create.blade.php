@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.karigarOrder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.karigar-orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="karigar_id">{{ trans('cruds.karigarOrder.fields.karigar') }}</label>
                <select class="form-control select2 {{ $errors->has('karigar') ? 'is-invalid' : '' }}" name="karigar_id" id="karigar_id" required>
                    @foreach($karigars as $id => $karigar)
                        <option value="{{ $id }}" {{ old('karigar_id') == $id ? 'selected' : '' }}>{{ $karigar }}</option>
                    @endforeach
                </select>
                @if($errors->has('karigar'))
                    <span class="text-danger">{{ $errors->first('karigar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigarOrder.fields.karigar_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_design_id">{{ trans('cruds.karigarOrder.fields.product_design') }}</label>
                <select class="form-control select2 {{ $errors->has('product_design') ? 'is-invalid' : '' }}" name="product_design_id" id="product_design_id" required>
                    @foreach($product_designs as $id => $product_design)
                        <option value="{{ $id }}" {{ old('product_design_id') == $id ? 'selected' : '' }}>{{ $product_design }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_design'))
                    <span class="text-danger">{{ $errors->first('product_design') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigarOrder.fields.product_design_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="per_piece_weight">{{ trans('cruds.karigarOrder.fields.per_piece_weight') }}</label>
                <input class="form-control {{ $errors->has('per_piece_weight') ? 'is-invalid' : '' }}" type="text" name="per_piece_weight" id="per_piece_weight" value="{{ old('per_piece_weight', '') }}" required>
                @if($errors->has('per_piece_weight'))
                    <span class="text-danger">{{ $errors->first('per_piece_weight') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigarOrder.fields.per_piece_weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_weight">{{ trans('cruds.karigarOrder.fields.total_weight') }}</label>
                <input class="form-control {{ $errors->has('total_weight') ? 'is-invalid' : '' }}" type="text" name="total_weight" id="total_weight" value="{{ old('total_weight', '') }}" required>
                @if($errors->has('total_weight'))
                    <span class="text-danger">{{ $errors->first('total_weight') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigarOrder.fields.total_weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="purity">{{ trans('cruds.karigarOrder.fields.purity') }}</label>
                <input class="form-control {{ $errors->has('purity') ? 'is-invalid' : '' }}" type="text" name="purity" id="purity" value="{{ old('purity', '') }}" required>
                @if($errors->has('purity'))
                    <span class="text-danger">{{ $errors->first('purity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigarOrder.fields.purity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pieces">{{ trans('cruds.karigarOrder.fields.pieces') }}</label>
                <input class="form-control {{ $errors->has('pieces') ? 'is-invalid' : '' }}" type="text" name="pieces" id="pieces" value="{{ old('pieces', '') }}" required>
                @if($errors->has('pieces'))
                    <span class="text-danger">{{ $errors->first('pieces') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigarOrder.fields.pieces_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="size">{{ trans('cruds.karigarOrder.fields.size') }}</label>
                <input class="form-control {{ $errors->has('size') ? 'is-invalid' : '' }}" type="text" name="size" id="size" value="{{ old('size', '') }}" required>
                @if($errors->has('size'))
                    <span class="text-danger">{{ $errors->first('size') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigarOrder.fields.size_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_date">{{ trans('cruds.karigarOrder.fields.delivery_date') }}</label>
                <input class="form-control date {{ $errors->has('delivery_date') ? 'is-invalid' : '' }}" type="text" name="delivery_date" id="delivery_date" value="{{ old('delivery_date') }}">
                @if($errors->has('delivery_date'))
                    <span class="text-danger">{{ $errors->first('delivery_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigarOrder.fields.delivery_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.karigarOrder.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark') }}</textarea>
                @if($errors->has('remark'))
                    <span class="text-danger">{{ $errors->first('remark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.karigarOrder.fields.remark_helper') }}</span>
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