@extends('layouts.app')
@section('title', Str::title($todo->title))
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3>{{Str::title($todo->title)}} <a href="{{url('/todo/'.$todo->id).'/edit'}}" class="btn btn-warning btn-group-sm pull-right ">Edit</a></h3>
      </div>
    </div>
  </div>
</div>
@endsection
