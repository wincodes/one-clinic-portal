@extends('layouts.main')

@section('content')

 <div class="intro-section bg-image overlay" style="background-image: url('images/medical-5.jpeg');">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-8 text-center testimony">
                <div class="card-body bg-info">
                    <p class="text-white">Hi</p>
                    <P class="text-white">There is an error in the Registration Link please check the link in your mail box <strong>{{$email}}</strong></p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

