@extends('layouts.default')

@section('navbar')
        <li ><a href="{{ $site_path }}">Home</a></li>
          <li ><a href="about">About</a></li>
          <li class="active"><a href="contact">Contact <span class="sr-only">(current)</span></a></li>
           <li></li>
           <li><a href="login">Log In</a></li>
         <li><a href="signup">Sign Up</a></li>
@stop    


@section('content')
<h1>This is the contact page</h1>
@stop