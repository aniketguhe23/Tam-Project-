@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.counselorassignment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.counselorassignments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="counselor_id">{{ trans('cruds.counselorassignment.fields.counselor_name') }}</label>
                       
                <select class="form-control select2 {{ $errors->has('counselor_id') ? 'is-invalid' : '' }}" name="counselor_id" id="counselor_id">
                @if(!empty($counselors))   
                @foreach($counselors as $id => $counselor)
                        <option value="{{ $counselor->id }}" {{ old('counselor_id') == $id ? 'selected' : '' }}>{{ $counselor->name }}</option>
                    @endforeach
                @endif
                </select>
                 @if($errors->has('counselor'))
                    <span class="text-danger">{{ $errors->first('counselor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counselorassignment.fields.counselor_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">Category</label>
                       
                <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                @if(!empty($categorys))   
                @foreach($categorys as $id => $category)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                    @endforeach
                @endif
                </select>
                 @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counselorassignment.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">User</label>
                       
                <select class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                @if(!empty($users))   
                @foreach($users as $id => $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                @endif
                </select>
                 @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counselorassignment.fields.user_helper') }}</span>
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