<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	{{--引入js文件--}}
	<script src="{{ url('dist/js/jquery.min.js') }}"></script>
	<script src="{{ url('dist/js/bootstrap.js') }}"></script>


	<!-- Noty 提示框的js集成 -->
	<script src="{{ url('dist/noty-2.2.9/packaged/jquery.noty.packaged.js') }}"></script>
	<script src="{{ url('dist/noty-2.2.9/themes/bootstrap.js') }}"></script>
	<script src="{{ url('dist/noty-2.2.9/options.js') }}"></script>
	<!-- Fonts -->




	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ route('Invest') }}">投资人信息录入</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">发送邮件</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ route('Phone') }}">发送手机</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ route('Group') }}">投资人分组</a></li>
				</ul>

				<ul class="nav navbar-nav">
					<li><a href="{{ route('Edit') }}">投资人信息编辑</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')


</body>
</html>
