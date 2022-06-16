@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.categorys.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.category.title_singular') }}
            </a>
            <a class="btn btn-success" href="{{ route('admin.counselors.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.counselor.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
    {{ trans('cruds.counselor.title_singular') }} List
    </div>

    <div class="card-body">
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
                            {{ trans('cruds.counselor.fields.counselor_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.phone_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.counselor.fields.category') }}
                        </th>
                        <th>
                            Active
                        </th>
                        @if($sessionCounselorid == 1)
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                <?php  $i = 1;?>
                    @foreach($counselors as $key => $counselor)
                        <tr data-entry-id="{{ $counselor->id }}">
                            <td></td>
                            <td>
                                <?php echo $i; $i++ ;?>
                            </td>
                            <td>{{ $counselor->name }} </td>
                            <td>{{ $counselor->email }} </td>
                            <td>{{ $counselor->phone_no }} </td>
                            <td> 
                                @foreach($categorys as $category)
                                @if($category->id == $counselor->category_id)
                                {{ $category->category_name }}
                                @endif
                                @endforeach
                             
                            </td>
                            <td>
                                @if($counselor->counselor_availability==1)
                                  <p class="text-active"> Active </p>
                                @else  
                                    <p class="text-inactive"> InActive </p>
                                @endif
                            </td>
                            @if($sessionCounselorid == 1)
                            <td>
                                @if($counselor->chat_availability==0) 
                                    <i class="fa fa-flag text-abvaility" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-flag text-unabvaility" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td> 
                                @can('counselor_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.counselors.show', $counselor->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('counselor_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.counselors.edit', $counselor->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('counselor_delete')
                                    <form action="{{ route('admin.counselors.destroy', $counselor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>
                            @endif
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