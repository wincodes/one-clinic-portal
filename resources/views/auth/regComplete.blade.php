
@extends('layouts.main')

@section('content')

 <div class="intro-section bg-image overlay" style="background-image: url('images/medical-5.jpeg');">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-8 text-center testimony">
                <div class="card-header text-white">Registration Complete</div>
                <div class="card-body bg-success">
                    <p class="text-white">Hi {{$registered->name}}</p>
                    <P class="text-white">Your registration is complete, please check your mail <strong>{{$registered->email}}</strong> for activation</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

