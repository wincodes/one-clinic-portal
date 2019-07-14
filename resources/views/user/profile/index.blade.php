<?php
    $title = Auth::user()->name.' - Profile';
?>
@extends('layouts.dashboard-layout')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10">
          <div class="card card-profile">
            <div class="card-avatar">
              <a href="#pablo">
                <img class="img" src="{{ asset('images/no-image-available.png') }}" />
              </a>
            </div>
            <div class="card-body">
              <h6 class="card-category text-gray">CEO / Co-Founder</h6>
              <h4 class="card-title">Alec Thompson</h4>
              <p class="card-description">
                Dont be scared of the truth because we need to restart the human foundation in truth 
                And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
              </p>
              <a href="/user/profile/edit" class="btn btn-primary btn-round">Edit Profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection