@extends('layouts.default')

@section('navbar')
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}">About</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>
        <li></li>
        <li class="active" ><a href="{{ url('/auth/login') }}">Log In <span class="sr-only">(current)</span></a></li>
        <li><a href="{{ url('/auth/register') }}">Register</a></li>
@stop     


@section('content')
<h1>This is the login page</h1>
@stop