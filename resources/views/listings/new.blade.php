@extends('layouts.default')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">New Listing</div>
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

					<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{url('/listings')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">


						<div class="form-group">
							<label class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" value="{{old('title')}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Description</label>
							<div class="col-md-6">
                                                            <textarea class="form-control" name="description" rows="5" >{{old('description')}}</textarea>
							</div>
						</div>
                                                
                                                
						<div class="form-group">
							<label class="col-md-4 control-label">Category</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="category" value="{{old('category')}}">
							</div>
						</div>
                                                 
						<div class="form-group">
							<label class="col-md-4 control-label">Price</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="price" value="{{old('price')}}">
							</div>
						</div>
                                                 
						<div class="form-group">
							<label class="col-md-4 control-label">Image</label>
							<div class="col-md-6">
								<input type="file" class="form-control" name="image" value="{{old('image')}}">
							</div>
						</div>



                                                
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Create
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