@extends('layouts.default')

@section('content')

<h2>You Must be logged in to view this page!</h2>

<h3>Please <a href="{{ url('/auth/login') }}">Log In</a></h3> 

        
        

@stop