@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.karigarOrder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.karigar-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.id') }}
                        </th>
                        <td>
                            {{ $karigarOrder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.karigar') }}
                        </th>
                        <td>
                            {{ $karigarOrder->karigar->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.product_design') }}
                        </th>
                        <td>
                            {{ $karigarOrder->product_design->design_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.per_piece_weight') }}
                        </th>
                        <td>
                            {{ $karigarOrder->per_piece_weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.total_weight') }}
                        </th>
                        <td>
                            {{ $karigarOrder->total_weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.purity') }}
                        </th>
                        <td>
                            {{ $karigarOrder->purity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.pieces') }}
                        </th>
                        <td>
                            {{ $karigarOrder->pieces }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.size') }}
                        </th>
                        <td>
                            {{ $karigarOrder->size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.delivery_date') }}
                        </th>
                        <td>
                            {{ $karigarOrder->delivery_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.remark') }}
                        </th>
                        <td>
                            {{ $karigarOrder->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.karigar-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection