@extends('layouts.default')


@section('navbar')
        <li class="active"><a href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="{{ url('/about') }}">About</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>
        <li></li>
        <li><a href="{{ url('/auth/login') }}">Log In</a></li>
        <li><a href="{{ url('/auth/register') }}">Register</a></li>
@stop       
         
@section('content')

  <div class="jumbotron">
  <h1>here at simply eco we have only organic and eco items!</h1>
  </div>




@stop