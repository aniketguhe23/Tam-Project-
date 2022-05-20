@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Share Desing
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url("admin/design-share-store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="design_name">Select Design</label>
               <select  name="design"  class="form-control" required="">
                <option value="">Select Design</option>
                @foreach($designs as $design)
                 <option value="{{$design->id}}">{{$design->design_name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                <label class="required" for="design_name">Select customers</label>
               <select  name="customers[]" multiple class="form-control" required="">
                @foreach($customers as $customer)
                 <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                @endforeach
              </select>
            </div>
            
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('admin.design-numbers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotosMap[file.name]
      }
      $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($designNumber) && $designNumber->photos)
      var files = {!! json_encode($designNumber->photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>

@endsection