@extends('layouts.default')

@section('content')
      <?php  if (Auth::check()): ?>

<h1>This is your dashboard</h1>

<h2>Manage Your Account Here</h2>

       <?php   else: ?>
<h2>You Must be logged in to view this page!</h2>

<h3><a href="{{ url('/auth/login') }}">Log In</a></h3> 

        
         <?php  endif; ?>
        

@stop