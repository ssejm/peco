@extends('layouts.default')

@section('content')

<script>
$(document).ready(function() {

	$('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});
});

 </script>
 
 
 
<div class="row">
    <div class="col-md-6">
	    <div class="thumbnail">
<a class="image-popup-no-margins" href="{{asset('/images/listings/'.$listing->image_file_name)}}">
		<img src="{{asset('/images/medium/'.$listing->image_file_name)}}" alt="{{$listing->title}}" /></a>
		</div>
    </div>
    <div class="col-md-6">
    	<h3>{{$listing->title}}</h3>
    	<p>${{ number_format($listing->price, 2) }}</p>
    	<p>{{$listing->description}}</p>
        <br />
        <div class="center">
        <a class="btn btn-primary" data-no-turbolink="true" href="{{url('listings/'. $listing->id . '/orders/new')}}">Buy it Now!</a>
        </div>
    </div>
</div>



@stop