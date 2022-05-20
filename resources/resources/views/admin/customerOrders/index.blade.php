@extends('layouts.admin')
@section('content')
@can('customer_order_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.customer-orders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.customerOrder.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.customerOrder.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CustomerOrder">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.customerOrder.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.customerOrder.fields.customer') }}
                    </th>
                    <th>
                        {{ trans('cruds.customerOrder.fields.design') }}
                    </th>
                    <th>
                        {{ trans('cruds.customerOrder.fields.purity') }}
                    </th>
                    <th>
                        {{ trans('cruds.customerOrder.fields.weight') }}
                    </th>
                    <th>
                        {{ trans('cruds.customerOrder.fields.size') }}
                    </th>
                    <th>
                        {{ trans('cruds.customerOrder.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.customerOrder.fields.delivery_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.customerOrder.fields.remark') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('customer_order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.customer-orders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.customer-orders.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'customer_customer_name', name: 'customer.customer_name' },
{ data: 'design_design_name', name: 'design.design_name' },
{ data: 'purity', name: 'purity' },
{ data: 'weight', name: 'weight' },
{ data: 'size', name: 'size' },
{ data: 'quantity', name: 'quantity' },
{ data: 'delivery_date', name: 'delivery_date' },
{ data: 'remark', name: 'remark' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-CustomerOrder').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection