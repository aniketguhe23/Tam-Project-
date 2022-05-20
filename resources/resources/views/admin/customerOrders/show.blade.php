@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customerOrder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.customerOrder.fields.id') }}
                        </th>
                        <td>
                            {{ $customerOrder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerOrder.fields.customer') }}
                        </th>
                        <td>
                            {{ $customerOrder->customer->customer_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerOrder.fields.design') }}
                        </th>
                        <td>
                            {{ $customerOrder->design->design_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerOrder.fields.purity') }}
                        </th>
                        <td>
                            {{ $customerOrder->purity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerOrder.fields.weight') }}
                        </th>
                        <td>
                            {{ $customerOrder->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerOrder.fields.size') }}
                        </th>
                        <td>
                            {{ $customerOrder->size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerOrder.fields.quantity') }}
                        </th>
                        <td>
                            {{ $customerOrder->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerOrder.fields.delivery_date') }}
                        </th>
                        <td>
                            {{ $customerOrder->delivery_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerOrder.fields.remark') }}
                        </th>
                        <td>
                            {{ $customerOrder->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection