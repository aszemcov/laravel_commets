<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="utf-8">
	<title>Login</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script>
		$(document).ready(function() {
			
			$('input[name="signin"]').on('click', function(e) {
				e.preventDefault();
				$.post({
					type: 'POST',
					url: '{{url('auth/login')}}',
					data: $('form#logging').serialize(),
					success: function(data) {

					},
				});
			});

			$('#reg').on('submit', function(e) {
				e.preventDefault();

				console.log($('#reg').serialize());

				/*$.post({
					type: 'POST',
					url: '{{url('register')}}',
					data: $('form#logging').serialize(),
					success: function(data) {
						alert(data);
					},
				});*/
			});

		});
	</script>

</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<div class="panel panel-default" class="block-center" style="margin-top: 40%;">
					<div class="panel-body">
						<form role="form" method="POST" action="{{ url('register') }}">
							{!! csrf_field() !!}
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="text" name="email" class="form-control">
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control">
								@if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
							</div>

						</form>
					</div>
				</div>

			</div>
		</div>
	</div>

</body>
</html>