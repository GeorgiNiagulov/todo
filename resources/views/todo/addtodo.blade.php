@extends('layouts.app')
@section('title', 'Add New Todo')
@section('content')
  <div class="row">
    <div class="col-m-6">
      <form class="form-horizontal" method="post" action="{{url('/todo')}}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Title</label>
          <div class="col-md-5">
            <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ old('title') }}">
            @if ($errors->has('title'))
              <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="created_at" class="col-sm-2 control-label">Date and time</label>
          <div class="col-md-5">
            <input type="datetime-local" class="form-control" id="created_at" name="created_at" value="{{ old('created_at') }}">
            @if ($errors->has('created_at'))
              <span class="help-block">
                <strong>{{ $errors->first('created_at') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-md-5">
            <button type="submit" class="btn btn-default">Add</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
