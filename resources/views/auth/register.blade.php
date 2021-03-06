@extends('layouts.main')

@section('content')

 <div class="intro-section bg-image overlay" style="background-image: url('images/medical-5.jpeg');">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-8 text-center testimony">
            <div class="card-body">
                <h3 class="mb-4">Registration</h3>
                    <form method="POST" action="register">
                    @csrf

                    <div class="row">
                        <div class="col-6">

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right text-white">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right text-white">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right text-white">Phone Number</label>
                                    <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
        
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right text-white">Password</label>
        
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right text-white">Confirm Password</label>
        
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control-lg" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                        </div>
                        <div class="col-6">
                            
                            <div class="form-group row">
                                <label for="hospital_name" class="col-md-4 col-form-label text-md-right text-white">Hospital Name</label>
                                    <div class="col-md-6">
                                    <input id="hospital_name" type="text" class="form-control-lg @error('hospital_name') is-invalid @enderror" name="hospital_name" value="{{ old('hospital_name') }}" required autocomplete="hospital_name">
        
                                        @error('hospital_name')
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="hospital_address" class="col-md-4 col-form-label text-md-right text-white">Hospital Address</label>
                            <div class="col-md-6">
                                    <input type="text" id="hospital_address" class="form-control-lg @error('hospital_address') is-invalid @enderror" name="hospital_address" value="{{ old('hospital_address') }}" required autocomplete="hospital_address">

                                    @error('hospital_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right text-white">City</label>
                            <div class="col-md-6">
                                    <input id="city" type="text" class="form-control-lg @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state" class="col-md-4 col-form-label text-md-right text-white">State</label>
                            <div class="col-md-6">
                                    <input id="state" type="text" class="form-control-lg @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" required autocomplete="state">

                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                    <label for="country" class="col-md-4 col-form-label text-md-right text-white">Country</label>
                                <div class="col-md-6">
                                        <select id="country" name="country" required class="form-control">
                                                <option value="">Choose...</option>
                                                @foreach ($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                              </select>
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                        </div>                
                    </div>
                    <div class="form-group row mb-0 align-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                Register
                                </button>
                                <a class="btn btn-link" href="/recovery">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                    
            </div>
          </div>
        </div>
      </div>
</div>
@include('packages')
@include('contact')
@endsection
