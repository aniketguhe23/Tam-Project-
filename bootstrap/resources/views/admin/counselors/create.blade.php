@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.counselor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.counselors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.counselor.fields.counselor_name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counselor.fields.counselor_name_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="category_name">Category</label>
                       
                <select class="form-control select2 {{ $errors->has('category_name') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                @if(!empty($categorys))   
                @foreach($categorys as $id => $category)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                    @endforeach
                @endif
                </select>
                 @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counselor.fields.category_helper') }}</span>
            </div>
           
            
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.counselor.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counselor.fields.email_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_no">{{ trans('cruds.counselor.fields.phone_no') }}</label>
                <input class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" type="number" name="phone_no" id="phone_no" value="{{ old('phone_no') }}" required>
                @if($errors->has('phone_no'))
                    <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counselor.fields.phone_no_helper') }}</span>
            </div>


            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.counselor.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counselor.fields.password_helper') }}</span>
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