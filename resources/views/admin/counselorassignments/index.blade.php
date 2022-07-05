@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Pending Chats
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table   table-striped   datatable datatable-User">
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
                <?php  $i = 1;?>
                @if(!empty($waitingUsers))
                    @foreach($waitingUsers as $key => $waitingUser)
                        <tr data-entry-id="{{ $waitingUser->id }}">
                            <td></td>
                            <td> <?php echo $i; $i++ ;?></td>
                            <td>{{ $waitingUser->getUser->name }} </td>
                            <td>{{ $waitingUser->getUser->age }} </td>
                            <td>{{ $waitingUser->getUser->gender }} </td>
                            <td>{{ $waitingUser->getUser->topic }} </td>
                            <td>{{ $waitingUser->getUser->location }} </td>
                            <td>{{ $waitingUser->id }} </td>
                            <td> Waiting </td>
                            <td>     
                                <select class="form-control select2 {{ $errors->has('counselor') ? 'is-invalid' : '' }}" name="counselor" id="counselor">
                                   <option> Select Counsellor </option>
                                   @foreach($counselorassignments as $key => $counselorassignment)  
                                   <option value="{{$counselorassignment->id}}"}>{{ $counselorassignment->name }} </option>
                                   @endforeach
                                </select>
                                <input type="hidden" name="user_id" id="user_id" value="{{ $waitingUser->id }}">
                            </td>
                            <td>
                                @can('user_counselor_assignment')
                                    <a class="btn btn-gradient-primary btn-rounded btn-icon submit" onclick="CounselorAssign();">
                                         Assign Counsellor
                                    </a>
                                @endcan
                                @can('my_chat_accses')
                                    <a class="btn btn-gradient-primary btn-rounded btn-icon" href="{{ route('admin.counselors.mychat', $sessionCounselorid) }}">
                                    Assign Myself
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @endif
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