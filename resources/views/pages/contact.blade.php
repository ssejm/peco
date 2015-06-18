@extends('layouts.default')

@section('navbar')
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}">About</a></li>
        <li class="active"><a href="{{ url('/contact') }}">Contact <span class="sr-only">(current)</span></a></li>
        <li></li>
        <li><a href="{{ url('/auth/login') }}">Log In</a></li>
        <li><a href="{{ url('/auth/register') }}">Register</a></li>
@stop    


@section('content')
<h1>This is the contact page</h1>
@stop