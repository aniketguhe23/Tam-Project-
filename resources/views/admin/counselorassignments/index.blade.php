@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Pending Chats
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.user_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.age') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.topic') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.user_location') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.queue_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.chat_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.counselor_assignment') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td></td>
                            <td>{{ $user->id }} </td>
                            <td>{{ $user->name }} </td>
                            <td>{{ $user->age }} </td>
                            <td>{{ $user->gender }} </td>
                            <td>{{ $user->topic }} </td>
                            <td>{{ $user->location }} </td>
                            <td> 0 </td>
                            <td> live  </td>
                            <td>     
                                <select class="form-control select2 {{ $errors->has('counselor') ? 'is-invalid' : '' }}" name="counselor" id="counselor">
                                   <option> Selecte Counselor </option>
                                   @foreach($counselorassignments as $key => $counselorassignment)  
                                   <option value="{{$counselorassignment->id}}"}>{{ $counselorassignment->name }} </option>
                                   @endforeach
                                </select>
                                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                            </td>
                            <td>
                                @can('user_counselor_assignment')
                                    <a class="btn btn-xs btn-info" onclick="CounselorAssign();">
                                         Submit
                                    </a>
                                @endcan
                                @can('my_chat_accses')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.counselors.mychat', $sessionCounselorid) }}">
                                        My Chats
                                    </a>
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



function CounselorAssign()
{
    var thisCouslorId = $("select[name=counselor]").val();
    var thisUserId = $("input[name=user_id]").val();
    if (thisCouslorId == "") {
        alert("Please selecte counselor");
        return false;
        }
        $.ajax({
            url: "{{url('admin/counselor-assignment')}}/thisCouslorId:" + thisCouslorId + "/thisUserId:" + thisUserId,
            method: 'GET',
            success: function(data) {
                alert("get value ");
               // $('#employee_district_id').html(data.html);
            }
        });
}

</script>
@endsection