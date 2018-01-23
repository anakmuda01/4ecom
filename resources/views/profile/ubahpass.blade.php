@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-6">
        <h1 class="text-center">Panel Ubah Password</h1>
        <form id="form-change-password" role="form" method="POST" action="{{ url('/user/credentials') }}" novalidate class="form-horizontal">
        <div class="col-md-12">
          <label for="current-password" class="col-sm-4 control-label">Current Password</label>
          <div class="col-sm-12">
            <div class="form-group">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password">
            </div>
          </div>
          <label for="password" class="col-sm-4 control-label">New Password</label>
          <div class="col-sm-12">
            <div class="form-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
          </div>
          <label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password</label>
          <div class="col-sm-12">
            <div class="form-group">
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <button type="submit" class="btn btn-danger btn-block">Submit</button>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection
