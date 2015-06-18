@extends('layouts.default')


@section('navbar')
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active"><a href="{{ url('/about') }}">About <span class="sr-only">(current)</span></a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>
        <li></li>
        <li><a href="{{ url('/auth/login') }}">Log In</a></li>
        <li><a href="{{ url('/auth/register') }}">Register</a></li>
@stop    


@section('content')
<h1>This is the about page</h1>

@stop
