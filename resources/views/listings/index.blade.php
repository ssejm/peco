@extends('layouts.default')

@section('content')


<h1>Here are your Listings:</h1>



@if (count($listings))
<table class="table table-striped table-bordered">
<tr>
<th class="center">Image</th>
<th class="center">Name</th>
<th class="center">Description</th>
<th class="center">Category</th>
<th class="center">Price</th>
<th class="center" >Action</th>
</tr>
    @foreach ($listings as $row)  
  <tr>
  <td><a  href="{{url('listings/'. $row->id)}}">
    <img src="{{asset('/images/thumbnails/'.$row->image_file_name)}}" alt="{{$row->title}}" /></a></td>
  <td>{{$row->title}}</td>
  <td>{{$row->description}}</td>
  <td>{{$row->category}}</td>
  <td>${{ number_format($row->price, 2) }}</td>
  <td>

  <div class="btn-group" role="group" >
  <a class="btn btn-info" href="{{url('listings/'. $row->id)}}">View</a>
  <a class="btn btn-warning" href="{{url('listings/'. $row->id .'/edit')}}">Edit</a>
</div>
      <p>
    <form  role="form" method="POST" action="{{url('/listings/' . $row->id)}}"
          onsubmit ="return ConfirmDelete('Are you sure you want to delete this listing?')">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input  name="_method" type="hidden" value="DELETE" />
    <input data-confirm="Are you sure?"  class="btn btn-danger" type="submit" value="Delete" />
    </form></p>
  
  <!--<a class="btn btn-danger" data-method="delete" href="{{url('listings/'. $row->id )}}">Delete</a></button>-->



<!--  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      Action <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="#"><a class="btn btn-link" href="{{url('listings/'. $row->id)}}">View</a></a></li>
      <li><a href="#"><a class="btn btn-link" href="{{url('listings/'. $row->id .'/edit')}}">Edit</a></a></li>
      <li><a href="#">  <a data-confirm="Are you sure?" class="btn btn-link" rel="nofollow" data-method="delete" href="{{url('listings/'. $row->id )}}">Delete</a></a></li>

    </ul>
  </div>-->
  
  </td>
  </tr>

    @endforeach
</table>
@else
    <br />
    <h3>You have no Listings.</h3>
@endif





<br />

<span class="default-link"><a href="{{url('/listings/create')}}">New Listing</a></span>

@stop