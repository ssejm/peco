@extends('layouts.default')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Listing</div>
				<div class="panel-body">
					@if (count($errors) > 0)

                                        
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-danger alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                       
								@foreach ($errors->all() as $error)
                                                                &bull; {{ $error }}<br />
								@endforeach
							
                                                    </div>
                                                </div>
                                            </div>
                                        
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{url('/listings/' . $listing->id)}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                 <input  name="_method" type="hidden" value="PUT" />

						<div class="form-group">
							<label class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" value="{{$listing->title}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Description</label>
							<div class="col-md-6">
                                                            <textarea class="form-control" name="description" rows="5" >{{$listing->description}}</textarea>
							</div>
						</div>
                                                
                                                
						<div class="form-group">
							<label class="col-md-4 control-label">Category</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="category" value="{{$listing->category}}">
							</div>
						</div>
                                                 
						<div class="form-group">
							<label class="col-md-4 control-label">Price</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="price" value="{{$listing->price}}">
							</div>
						</div>
                                                 
						<div class="form-group">
							<label class="col-md-4 control-label">Image File Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="image_file_name" value="{{$listing->image_file_name}}">
							</div>
						</div>



                                                
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Update
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
@stop