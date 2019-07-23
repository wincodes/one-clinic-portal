<?php
    $title = Auth::user()->name.' - Profile';
?>
@extends('layouts.dashboard-layout')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Edit Profile</h4>
              <p class="card-category">Complete your profile</p>
            </div>
            <div class="card-body">
              <form method="POST" action="/user/profile/edit" enctype="multipart/form-data">
                @csrf
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
                        <input type="text" @error('phone_number') is-invalid @enderror value="{{ old('phone_number') }}" class="form-control" name="phone_number" required>
                      </div>

                      @error('phone_number')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="bmd-label-floating">Position in Hospital</label>
                        <input type="text" @error('position') is-invalid @enderror value="{{ old('position') }}" class="form-control" name="position">
                      </div>
                    </div>

                    @error('position')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  </div>
                  
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Fist Name</label>
                      <input type="text" @error('first_name') is-invalid @enderror value="{{ old('first_name') }}" class="form-control" name="first_name" required>
                    </div>

                    @error('first_name')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Last Name</label>
                      <input type="text" @error('last_name') is-invalid @enderror value="{{ old('last_name') }}" class="form-control" name="last_name" required>
                    </div>
                  </div>

                  @error('last_name')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                  @enderror
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Address</label>
                      <input type="text" @error('address') is-invalid @enderror value="{{ old('address') }}" class="form-control" name="address" required>
                    </div>
                  </div>

                  @error('address')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                  @enderror
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">City</label>
                      <input type="text" @error('city') is-invalid @enderror value="{{ old('city') }}" class="form-control" name="city" required>
                    </div>

                    @error('city')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                    @enderror
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">State</label>
                      <input type="text" @error('state') is-invalid @enderror value="{{ old('state') }}" class="form-control" name="state" required>
                    </div>

                    @error('state')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Gender</label>
                          <select @error('gender') is-invalid @enderror class="form-control" name="gender">
                            <option value="">Choose....</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                          </select>
                        </div> 
                        
                        @error('gender')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-floating">Country</label>
                        <select id="country" @error('gender') is-invalid @enderror name="country_id" required class="form-control">
                          <option value="">Choose...</option>
                          @foreach ($countries as $country)
                          <option value="{{$country->id}}">{{$country->name}}</option>
                          @endforeach
                        </select>
                        @error('country_id')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <br>
                </div>
                  <label>Select a Beautiful Picture</label>
                  <input type="file" @error('picture') is-invalid @enderror class="btn btn-primary" name="picture">
                  @error('picture')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                  @enderror                  
                <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection