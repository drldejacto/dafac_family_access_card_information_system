@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.division.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("divisions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.division.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}" required>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.division.fields.description') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="supervisor_id">{{ trans('cruds.division.fields.supervisor') }}</label>
                <select class="form-control{{ $errors->has('supervisor_id') ? 'is-invalid' : '' }}" name="supervisor_id" id="supervisor_id" required>
                        <option value="">Select</option>
                    @foreach($users as $id => $user)
                        <option value="{{ $user->id }}" {{ in_array($id, old('supervisor_id', [])) ? 'selected' : '' }}>{{ $user->last_name . ', ' . $user->first_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('supervisor_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supervisor_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.division.fields.supervisor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.division.fields.status') }}</label>
                <select class="form-control{{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                        <option value="">Select</option>
                        <option value="1" {{ in_array($id, old('status', [])) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ in_array($id, old('status', [])) ? 'selected' : '' }}>Inactive</option>
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.division.fields.status_helper') }}</span>
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