@extends('layouts.default')


@section('navbar')
        <li ><a href="{{ $site_path }}">Home</a></li>
          <li class="active"><a href="about">About <span class="sr-only">(current)</span></a></li>
          <li><a href="contact">Contact</a></li>
           <li></li>
           <li><a href="login">Log In</a></li>
         <li><a href="signup">Sign Up</a></li>
@stop    


@section('content')
<h1>This is the about page</h1>

@stop
