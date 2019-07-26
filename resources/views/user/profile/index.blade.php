<?php
    $title = Auth::user()->name.' - Profile';
    function setActive($data)
    {
      if ($data === 'profile')
      {
        return 'active';
      }
    }
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
            <a href="/user/profile/create" class="btn btn-primary btn-round">Profile Setup</a>
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
                  <h5 class="card-title">Hospital Name</h5>
                  <p class="card-text">{{Auth::user()->hospital_name}}</p>
                  <hr>
                </div>

                <div class="col-md-4">
                  <h5 class="card-title">Staff Position</h5>
                  <p class="card-text">{{$profile->position}}</p>
                  <hr>
                </div>

                <div class="col-md-4">
                  <h5 class="card-title">Phone Number</h5>
                  <p class="card-text">{{$profile->phone_number}}</p>
                  <hr>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                <h5 class="card-title">First Name</h5>
                <p class="card-text">{{$profile->first_name}}</p>
                <hr>
                </div>

                <div class="col-md-4">
                  <h5 class="card-title">Last Name</h5>
                  <p class="card-text">{{$profile->last_name}}</p>
                  <hr>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title">Gender</h5>
                    <p class="card-text">{{$profile->gender}}</p>
                    <hr>
                </div>
              </div>

              <div class="row">
                <div class="col-md-10">
                  <h5 class="card-title">Address</h5>
                  <p class="card-text">{{$profile->address}}</p>
                  <hr>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <h5 class="card-title">City</h5>
                  <p class="card-text">{{$profile->city}}</p>
                  <hr>
                </div>

                <div class="col-md-4">
                  <h5 class="card-title">State</h5>
                  <p class="card-text">{{$profile->state}}</p>
                  <hr>
                </div>

                <div class="col-md-4">
                  <h5 class="card-title">Country</h5>
                  <p class="card-text">{{$profile->country}}</p>
                  <hr>
                </div> 
              </div>
                        
                <a href="/user/profile/edit" class="btn btn-primary btn-round">Edit Profile</a>
                <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
@endsection