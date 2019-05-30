@extends('layouts.main')

@section('content')
<div class="intro-section bg-image overlay" style="background-image: url('images/medical-5.jpeg');">
<div class="container">
    <p>Hi {{$registered->name}}</p>
    <P>Your registration is complete, please check your mail <strong>{{$registered->email}}</strong> for activation</p>
</div>
@endsection
