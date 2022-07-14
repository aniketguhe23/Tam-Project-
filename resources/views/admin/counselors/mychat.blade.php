@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            
        </div>
    </div>
    <div class="card">
    <div class="card-header">
      My Chats
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
                        User Location
                        </th>
                        <th>
                            Queue No
                        </th>
                        <th>
                            Chat Type
                        </th>
                        <th>
                            Reason
                        </th>
                        <th>
                            Assign By
                        </th>
                        <th>
                            Activate Chats
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php  $i = 1;?>
                    @foreach($getCurrentCounselorByUsers as $key => $getCurrentCounselorByUsers)
                        <tr data-entry-id="{{ $getCurrentCounselorByUsers->id }}">
                            <td></td>
                            <td><?php echo $i; $i++ ;?> </td>
                            <td>{{ $getCurrentCounselorByUsers->getUser->name }} </td>
                            <td>{{ $getCurrentCounselorByUsers->getUser->age }}</td>
                            <td>{{ $getCurrentCounselorByUsers->getUser->gender }} </td>
                            <td>{{ $getCurrentCounselorByUsers->getCategory->category_name }} </td>
                            <td>{{ $getCurrentCounselorByUsers->getUser->location }} </td>
                            <td> 0999 </td>
                            <td> @if($getCurrentCounselorByUsers->chat_type == 0) Async @else Live @endif  </td>
                            <td> {{ $getCurrentCounselorByUsers->report }}</td>
                            <td> @if($getCurrentCounselorByUsers->counselor_id == 1) Admin @else @endif  </td>
                             <td>
                                <a class=" btn btn-gradient-primary btn-rounded btn-icon" href="#">
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
<div class="card">
    <div class="card-header">   
    </div>

    <div class="card-body">
    <div class="row">
                <div class="col-md-2">
                    <div class="m-form__section m-form__section--first">
                            <div class="form-group">
                                <label class="form-control-label">Start Date</label>
                                <input class="form-control date" type="text" name="fromdate" id="m_datepicker_2" placeholder="Start Date" required>
                            </div>
                        </div>
                </div>
                <div class="col-md-2">
                    <div class="m-form__section m-form__section--first">
                            <div class="form-group">
                                <label class="form-control-label">End Date </label>
                                <input class="form-control date" type="text" name="todate" id="m_datepicker_3" placeholder="End Date" required>
                            </div>
                        </div>
                </div>
                <div class="col-md-2">
                    <label class="required" for="counselor_name">Counsellor Name</label>    
                        <select class="form-control select2 {{ $errors->has('counselor_name') ? 'is-invalid' : '' }}" name="counselor_name" id="counselor_name">
                            @foreach($counselors as $counselor) 
                            <option> {{ $counselor->name}}  </option>
                            @endforeach
                        </select>
                </div>
                <div class="col-md-2">
                    <label class="required" for="category_id">Category</label>    
                        <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                        @foreach($categorys as $categorys) 
                            <option> {{ $categorys->category_name}} </option>
                        @endforeach
                        </select>
                </div>
                <div class="col-md-2">
                    <label class="required" for="chat_type">Chat Type</label>    
                        <select class="form-control select2 {{ $errors->has('chat_type') ? 'is-invalid' : '' }}" name="chat_type" id="chat_type">
                            <option> Live chats </option>
                            <option> Async Chats  </option>
                        </select>
                </div>
                <div class="col-md-2">
                    <div class="form-group filter">
                        <button class="btn btn-primary" type="submit">
                        Apply Filter
                        </button>
                    </div>
                </div>
            </div>
        <div class="table-responsive">
            <table class=" table   table-striped   datatable datatable-counselors">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.id') }}
                        </th>
                        <th>
                           Date
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
                        Chat type
                        </th>
                        <th>
                            Assign By
                        </th>
                        <th> Feedback </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                
                  
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

</script>
@endsection