@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.designNumber.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.design-numbers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.designNumber.fields.id') }}
                        </th>
                        <td>
                            {{ $designNumber->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designNumber.fields.design_name') }}
                        </th>
                        <td>
                            {{ $designNumber->design_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designNumber.fields.design_number') }}
                        </th>
                        <td>
                            {{ $designNumber->design_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designNumber.fields.product') }}
                        </th>
                        <td>
                            {{ $designNumber->product->product_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designNumber.fields.remark') }}
                        </th>
                        <td>
                            {{ $designNumber->remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designNumber.fields.photos') }}
                        </th>
                        <td>
                            @foreach($designNumber->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.design-numbers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection