@extends('layouts.default')

@section('navbar')
        <li><a href="{{ $site_path }}">Home</a></li>
          <li><a href="about">About</a></li>
          <li><a href="contact">Contact</a></li>
           <li></li>
           <li ><a href="login">Log In </a></li>
         <li class="active"><a href="signup">Sign Up <span class="sr-only">(current)</span></a></li>
@stop    


@section('content')
<h1>This is the sign up page</h1>
@stop