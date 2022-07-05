@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table   table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.id') }}
                        </th>
                        <td>
                            {{ $customer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.customer_name') }}
                        </th>
                        <td>
                            {{ $customer->customer_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.firm_name') }}
                        </th>
                        <td>
                            {{ $customer->firm_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.mobile_no') }}
                        </th>
                        <td>
                            {{ $customer->mobile_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.email') }}
                        </th>
                        <td>
                            {{ $customer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.address') }}
                        </th>
                        <td>
                            {{ $customer->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.district') }}
                        </th>
                        <td>
                            {{ $customer->district }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.city') }}
                        </th>
                        <td>
                            {{ $customer->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $customer->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.date_of_anniversary') }}
                        </th>
                        <td>
                            {{ $customer->date_of_anniversary }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection