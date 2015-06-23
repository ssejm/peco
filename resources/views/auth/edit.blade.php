@extends('layouts.default')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Profile</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{url('user')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">First Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="first_name" value="{{  Auth::user()->first_name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Last Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}">
							</div>
						</div>
                                                
                                                
						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">New Password</label>
							<div class="col-md-6">
                                                            (leave blank if you don't want to change it)<br />
								<input type="password" class="form-control" name="new_password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="new_password_confirmation">
							</div>
						</div>
                                                
						<div class="form-group">
							<label class="col-md-4 control-label">Current Password</label>
							<div class="col-md-6">
                                                            (needed to confirm changes)<br />
								<input type="password" class="form-control" name="password">
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