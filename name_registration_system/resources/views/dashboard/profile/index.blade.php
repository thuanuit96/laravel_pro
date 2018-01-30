@extends('adminlte::page')

@section('title', 'Domain Name')

@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</h1>
@stop

@section('content')
	<div class="container-fluid" style="background-color: #ffffff; padding: 15px; border: 1px solid #ddd; max-width: 767px; margin: 0 auto;">
		<form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
					<input id="first-name" type="text" class="form-control" name="name" value="{{$name}}" placeholder="Name">
				</div>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success" style="display: block; width: 100%">
					<i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save
				</button>
			</div>
			

		</form>
	</div>
@stop