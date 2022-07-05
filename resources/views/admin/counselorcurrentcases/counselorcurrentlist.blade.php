@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            
        </div>
    </div>
    <div class="card">
    <div class="card-header">
    Current Chats
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table   table-striped   datatable datatable-counselors">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            User {{ trans('cruds.counselor.fields.id') }}
                        </th>
                        <th>
                         {{ trans('cruds.counselor.fields.user_name') }}
                        </th>
                        <th>
                        User {{ trans('cruds.counselor.fields.age') }}
                        </th>
                        <th>
                        User {{ trans('cruds.counselor.fields.gender') }}
                        </th>
                        <th>
                        User {{ trans('cruds.counselor.fields.topic') }}
                        </th>
                        <th>
                        Time Left
                        </th>
                        <th>
                        User Location
                        </th>
                        <th>
                            Chat Type
                        </th>
                        <th>
                            Activate Chats
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php   $i = 1; ?>
                    @foreach($counselorCurrentChats as $key => $counselorCurrentChat)
                        <tr data-entry-id="{{ $counselorCurrentChat->id }}">
                            <td></td>
                            <td><?php echo $i; $i++ ;?> </td>
                            <td>{{ $counselorCurrentChat->getUser->name }} </td>
                            <td>46 </td>
                            <td>{{ $counselorCurrentChat->getUser->gender }} </td>
                            <td>{{ $counselorCurrentChat->getCategory->category_name }} </td>
                            <td>{{ $counselorCurrentChat->created_at }}</td>
                            <td>{{ $counselorCurrentChat->getUser->location }} </td>
                            <td>Async</td>
                             <td>
                                <a class="btn btn-gradient-primary btn-rounded btn-icon" href="{{ route('admin.counselor-assign-user.counselorAssignUser', $counselorCurrentChat->getUser->id) }}">
                                    Activate
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('counselor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.counselors.massDestroy') }}",
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
  let table = $('.datatable-counselor:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection