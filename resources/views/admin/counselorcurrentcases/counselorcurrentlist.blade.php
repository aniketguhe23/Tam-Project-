@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            
        </div>
    </div>

    <div class="card">
    <div class="card-header">
    Current Live Chats
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
                        Queue No
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
                    @foreach($counselorLiveChats as $key => $counselorLiveChat)
                        <tr data-entry-id="{{ $counselorLiveChat->id }}">
                            <td></td>
                            <td><?php echo $i; $i++ ;?> </td>
                            <td>{{ $counselorLiveChat->getUser->name }} </td>
                            <td>{{ $counselorLiveChat->getUser->age }}</td>
                            <td>{{ $counselorLiveChat->getUser->gender }} </td>
                            <td>{{ $counselorLiveChat->getCategory->category_name }} </td>
                            <td>{{ $counselorLiveChat->id }}</td>
                            <td>{{ $counselorLiveChat->getUser->location }} </td>
                            <td>Live</td>
                            <td>
                                <a class="btn btn-gradient-primary btn-rounded btn-icon" href="{{ route('admin.counselor-live-chat.counselorLiveChat', $counselorLiveChat->user_id) }}">
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
    Current Async Chats
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
                            <td>{{ $counselorCurrentChat->getUser->age }}</td>
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
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: 'AIzaSyBVwfEvl5Gtmi1u6Tq5q0pCDbfPugenQYE',
        authDomain: 'tam-app-dev.firebaseapp.com',
        databaseURL: 'https://auth-db582.hstgr.io/index.php?db=u141015763_db_tam',
        projectId: 'tam-app-dev',
        storageBucket: 'tam-app-dev.appspot.com',
        messagingSenderId: '906777746662',
        appId: '1:906777746662:web:e4d6e511e2a1a4245d2f27',
        measurementId: 'G-BEFLVMNWLB',
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
 
    messaging.onMessage(function (payload) {

    var thisCouslorId = $('#user_id').val;

      $.ajax({
            url: "{{url('admin/counselor-assign-user.counselorAssignUser')}}/thisCouslorId:" + thisCouslorId,
            method: 'GET',
            success: function(data) {
                alert("get value ");
               // $('#employee_district_id').html(data.html);
            }
        });

        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
</script>
@endsection