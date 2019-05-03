@extends('layouts.app')

@section('content')
<div class="container">
    <p>Hi {{$registered->name}}</p>
    <P>Your registration is complete, please check your mail <strong>{{$registered->email}}</strong> for activation</p>
</div>
@endsection
