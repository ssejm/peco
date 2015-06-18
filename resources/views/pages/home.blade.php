@extends('layouts.default')


@section('navbar')
        <li class="active"><a href="{{ $site_path }}">Home <span class="sr-only">(current)</span></a></li>
          <li><a href="about">About</a></li>
          <li><a href="contact">Contact</a></li>
           <li></li>
           <li><a href="login">Log In</a></li>
         <li><a href="signup">Sign Up</a></li>
@stop       
         
@section('content')

  <div class="jumbotron">
  <h1>here at simply eco we have only organic and eco items!</h1>
  </div>




@stop