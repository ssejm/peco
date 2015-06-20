@extends('layouts.default')

@section('content')


<h1>Here are your Listings:</h1>



@if (count($listings))
<table class="table table-striped table-bordered">
<tr>
<th class="center">Image</th>
<th class="center">Name</th>
<th class="center">Description</th>
<th class="center">Price</th>
<th class="center">Action</th>
</tr>
    @foreach ($listings as $row)  
  <tr>
  <td><img src="/peco/public/images/listings/{{$row->image_file_name}}" alt="{{$row->title}}" width="100" /></td>
  <td>{{$row->title}}</td>
  <td>{{$row->description}}</td>
  <td>{{$row->price}}</td>
  <td>
  <!-- Single button -->
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      Action <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="#"><a class="btn btn-link" href="/peco/public/listings/{{$row->id}}">View</a></a></li>
      <li><a href="#"><a class="btn btn-link" href="/peco/public/listings/{{$row->id}}/edit">Edit</a></a></li>
      <li><a href="#">  <a data-confirm="Are you sure?" class="btn btn-link" rel="nofollow" data-method="delete" href="/peco/public/listings/{{$row->id}}">Destroy</a></a></li>

    </ul>
  </div></td>
  </tr>

    @endforeach
</table>
@else
    <br />
    <h3>You have no Listings.</h3>
@endif


@stop