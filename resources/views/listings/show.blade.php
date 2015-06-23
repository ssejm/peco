@extends('layouts.default')

@section('content')



<div class="row">
    <div class="col-md-6">
	    <div class="thumbnail">
		<img src="{{asset('/images/listings/'.$listing->image_file_name)}}" alt="{{$listing->title}}" />
		</div>
    </div>
    <div class="col-md-6">
    	<h3>{{$listing->title}}</h3>
<?php 
//setlocale(LC_MONETARY, 'en_US');
//echo "<p>" . money_format('%i',  $listing->price) . "</p>"; 
?>

    	<p>${{$listing->price}}</p>
    	<p>{{$listing->description}}</p>
        <br />
        <div class="center">
        <a class="btn btn-primary" data-no-turbolink="true" href="{{url('listings/'. $listing->id . '/orders/new')}}">Buy it Now!</a>
        </div>
    </div>
</div>



@stop