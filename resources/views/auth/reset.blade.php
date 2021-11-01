<html>
<head>
	<title>{{$site_settings->name}} {{trans('messages.Traffic Exchanger')}}</title>
	<link rel="stylesheet" href="/libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />

</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('messages.Reset Password')}}</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>{{trans('messages.Whoops!')}}</strong> {{trans('messages.There were some problems with your input.')}}<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="post" action="/reset">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="code" value="{{ $code }}">
						<input type="hidden" name="email" value="{{$email}}"/>



						<div class="form-group">
							<label class="col-md-4 control-label">{{trans('messages.Password')}}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{trans('messages.confirm password')}}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{trans('messages.Reset Password')}}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>