<?php
    $title = Auth::user()->name.' - Profile';
?>
@extends('layouts.dashboard-layout')

@section('content')
@if (empty($profile))

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-10">
        <div class="card card-profile">
          <div class="card-body">
            <h2 class="card-category text-gray">Profile Unavailable</h2>
            <h4 class="card-title">You have not set up your profile</h4>
            <p class="card-description">
              Please click the button below to set up your profile.
            </p>
            <a href="/user/profile/edit" class="btn btn-primary btn-round">Profile Setup</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@else
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10">
          <div class="card card-profile">
            <div class="card-avatar">
              <a href="#pablo">
                @if (empty($profile->picture))
                <img class="img" src="{{ asset('images/no-image-available.png') }}" >
                @else
                <img class="img" src="/storage/images/{{$profile->picture}}" />
                @endif
              </a>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Hospital Name</label>
                      <input type="text" class="form-control" disabled value="{{Auth::user()->hospital_name}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="bmd-label-floating">Phone Number</label>
                        <input type="text" class="form-control" disabled value="{{$profile->phone_number}}">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="bmd-label-floating">Position in Hospital</label>
                        <input type="text" class="form-control" disabled value="{{$profile->position}}">
                      </div>
                    </div>
                  </div>
                  
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Fist Name</label>
                      <input type="text" class="form-control" disabled value="{{$profile->first_name}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Last Name</label>
                      <input type="text" class="form-control"disabled value="{{$profile->last_name}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Adress</label>
                      <input type="text" class="form-control" disabled value="{{$profile->address}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">City</label>
                      <input type="text" class="form-control" disabled value="{{$profile->city}}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">State</label>
                      <input type="text" class="form-control" disabled value="{{$profile->phone_number}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Gender</label>
                          <input type="text" class="form-control" disabled value="{{$profile->gender}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-floating">Country</label>
                        <input type="text" class="form-control" disabled value="{{$profile->country}}">
                       
                      </div>
                    </div>
                    <br>
                </div>                  
                <a href="/user/profile/edit" class="btn btn-primary btn-round">Update Profile</a>
                <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
@endsection