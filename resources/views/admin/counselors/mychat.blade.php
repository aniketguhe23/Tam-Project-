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
            <table class=" table table-bordered table-striped table-hover datatable datatable-counselors">
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
                            Assign By
                        </th>
                        <th>
                            Activate Chats
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($counselors as $key => $counselor)
                        <tr data-entry-id="{{ $counselor->id }}">
                            <td></td>
                            <td>{{ $counselor->id }} </td>
                            <td>{{ $counselor->name }} </td>
                            <td>46 </td>
                            <td>{{ $counselor->gender }} </td>
                            <td>{{ $counselor->topic }} </td>
                            <td>{{ $counselor->location }} </td>
                            <td> </td>
                            <td>Live </td>
                            <th> Admin </th>
                             <td><a class="btn btn-xs btn-primary" href="#">
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
                    <label class="required" for="counselor_name">Counselor Name</label>    
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
                            Chats Filter
                        </button>
                    </div>
                </div>
            </div>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-counselors">
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
                    @foreach($counselors as $key => $counselor)
                        <tr data-entry-id="{{ $counselor->id }}">
                            <td></td>
                            <td>{{ $counselor->id }} </td>
                            <td> 08/08/2022</td>
                            <td>{{ $counselor->name }} </td>
                            <td>46 </td>
                            <td>{{ $counselor->gender }} </td>
                            <td>Work </td>
                            <td> Live</td>
                            <th> Admin </th>
                            <td> 3 </td>
                            <td> 
                                @can('counselor_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.counselors.show', $counselor->id) }}">
                                        View Chat
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

</script>
@endsection