@extends('layouts.admin')
@section('content')
@can('karigar_order_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.karigar-orders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.karigarOrder.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.karigarOrder.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-KarigarOrder">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.karigar') }}
                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.product_design') }}
                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.per_piece_weight') }}
                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.total_weight') }}
                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.purity') }}
                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.pieces') }}
                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.size') }}
                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.delivery_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.karigarOrder.fields.remark') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karigarOrders as $key => $karigarOrder)
                        <tr data-entry-id="{{ $karigarOrder->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $karigarOrder->id ?? '' }}
                            </td>
                            <td>
                                {{ $karigarOrder->karigar->name ?? '' }}
                            </td>
                            <td>
                                {{ $karigarOrder->product_design->design_name ?? '' }}
                            </td>
                            <td>
                                {{ $karigarOrder->per_piece_weight ?? '' }}
                            </td>
                            <td>
                                {{ $karigarOrder->total_weight ?? '' }}
                            </td>
                            <td>
                                {{ $karigarOrder->purity ?? '' }}
                            </td>
                            <td>
                                {{ $karigarOrder->pieces ?? '' }}
                            </td>
                            <td>
                                {{ $karigarOrder->size ?? '' }}
                            </td>
                            <td>
                                {{ $karigarOrder->delivery_date ?? '' }}
                            </td>
                            <td>
                                {{ $karigarOrder->remark ?? '' }}
                            </td>
                            <td>
                                @can('karigar_order_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.karigar-orders.show', $karigarOrder->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('karigar_order_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.karigar-orders.edit', $karigarOrder->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('karigar_order_delete')
                                    <form action="{{ route('admin.karigar-orders.destroy', $karigarOrder->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('karigar_order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.karigar-orders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-KarigarOrder:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection