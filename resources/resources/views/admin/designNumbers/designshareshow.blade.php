@extends('layouts.admin')
@section('content')
@can('design_number_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ url('admin/design-share-create') }}">
                Share Design
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.designNumber.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-DesignNumber">
            <thead>
                <tr>
                    
                    <th>
                        ID
                    </th>
                    <th>
                        Customer Name
                    </th>
                    <th>
                        Design Name
                    </th>
                    <th>
                        Design Number
                    </th>
                    
                   <th>Action</th>
                   
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
@can('design_number_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.design-numbers.massDestroy') }}",
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
    searching:false,
    aaSorting: [],
    ajax: "{{ url('admin/design-share-data') }}",
    columns: [
{ data: 'id', name: 'id' },
{ data: 'customer_name', name: 'customer_name' },
{ data: 'design_name', name: 'design_name' },
{ data: 'design_number', name: 'design_number' },
{data: 'id' , render : function ( data ,type, row,) {
    return '<a href="design-share-delete/'+row.id+'" class="btn btn-primary btn-sm">Delete</a> | <a href="design-share-edit/'+row.id+'" class="btn btn-warning btn-sm">Edit</a>';
                     
    }},


    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-DesignNumber').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

function delete_share(id)
{
  var id = id;
  $.ajax({
        url: '{{url("admin/design-share-delete")}}'+ '/' + id,
        type: "get",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
        
            
        }, 

  }); 
}

function edit_share(id)
{

}

</script>
@endsection