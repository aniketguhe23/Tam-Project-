@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.designNumber.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.design-numbers.update", [$designNumber->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="design_name">{{ trans('cruds.designNumber.fields.design_name') }}</label>
                <input class="form-control {{ $errors->has('design_name') ? 'is-invalid' : '' }}" type="text" name="design_name" id="design_name" value="{{ old('design_name', $designNumber->design_name) }}" required>
                @if($errors->has('design_name'))
                    <span class="text-danger">{{ $errors->first('design_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.designNumber.fields.design_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="design_number">{{ trans('cruds.designNumber.fields.design_number') }}</label>
                <input class="form-control {{ $errors->has('design_number') ? 'is-invalid' : '' }}" type="text" name="design_number" id="design_number" value="{{ old('design_number', $designNumber->design_number) }}" required>
                @if($errors->has('design_number'))
                    <span class="text-danger">{{ $errors->first('design_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.designNumber.fields.design_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.designNumber.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $designNumber->product->id ?? '') == $id ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.designNumber.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.designNumber.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark', $designNumber->remark) }}</textarea>
                @if($errors->has('remark'))
                    <span class="text-danger">{{ $errors->first('remark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.designNumber.fields.remark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photos">{{ trans('cruds.designNumber.fields.photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <span class="text-danger">{{ $errors->first('photos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.designNumber.fields.photos_helper') }}</span>
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