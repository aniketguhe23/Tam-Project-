@extends('layouts.admin')
@section('content')
@can('tamhub_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tamhubs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tamhub.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tamhub.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-tamhub">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.organisation_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.areas') }}
                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.services') }}
                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.special_note') }}
                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.contact_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.email_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.website_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.tamhub.fields.address') }}
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
@can('tamhub_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tamhubs.massDestroy') }}",
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
    ajax: "{{ route('admin.tamhubs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'organisation_name', name: 'organisation_name',sortable: false, searchable: false},
{ data: 'city', name: 'city',sortable: false, searchable: false},
{ data: 'areas', name: 'areas',sortable: false, searchable: false},
{ data: 'services', name: 'services',sortable: false, searchable: false},
{ data: 'special_note', name: 'special_note',sortable: false, searchable: false},
{ data: 'contact_no', name: 'contact_no',sortable: false, searchable: false},
{ data: 'email_id', name: 'email_id',sortable: false, searchable: false},
{ data: 'website_link', name: 'website_link',sortable: false, searchable: false},
{ data: 'address', name: 'address',sortable: false, searchable: false},
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-tamhub').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection