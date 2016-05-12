<html>
	<head>
		<title>Laravel</title>

		<link href="{{ asset('/dist/css/bootstrap.css') }}" rel="stylesheet">
		{{--引入js文件--}}
		<script src="{{ url('dist/js/jquery.min.js') }}"></script>
		<script src="{{ url('dist/js/bootstrap.js') }}"></script>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
				background-color: #1b1b1b;
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 40px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 15px;
			}
		</style>



	</head>
	<body>
		<div class="container">

			<div class="content">

				{{--<div style="height: 300px;"><img  src="{{url('logo.png')}}"/></div>--}}

				<div class="title">impress_sms1.0 上线!!!</div>
				<div class="quote">{{ Inspiring::quote() }}</div>
				<form action="{{ url('home') }}" style="margin-top: 30px;">
				<button type="submit" class="btn btn-info" style="width: 105px;height: 30px;">登陆</button>
				</form>
			</div>
		</div>
	</body>
</html>
