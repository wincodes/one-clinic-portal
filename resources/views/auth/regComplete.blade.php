
@extends('layouts.main')

@section('content')

 <div class="intro-section bg-image overlay" style="background-image: url('images/medical-5.jpeg');">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-8 text-center testimony">
                <div class="card-header">Registration Complete</div>
                <div class="card-body">
                    <p>Hi {{$registered->name}}</p>
                    <P>Your registration is complete, please check your mail <strong>{{$registered->email}}</strong> for activation</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

