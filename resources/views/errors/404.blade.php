<!DOCTYPE HTML>
<html>
<head>
	<title>Page not found</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
	body{
		background:url('{{ asset('img/bg.png') }}');
		margin:0;
	}
	.wrap{
		margin:0 auto;
		text-align: center;
	}
	.sub a{
		color:white;
		background:rgba(0,0,0,0.3);
		text-decoration:none;
		padding:5px 10px;
		font-size:13px;
		font-family: arial, serif;
		font-weight:bold;
	}
</style>
</head>
<body>
	<img src="{{ asset('img/label.png') }}"/> 
	<div class="wrap">
		<img src="{{ asset('img/woody-404.png') }}"/>
		<div class="sub">
			<p><a href="{{ url('') }}">Go Back to Admin</a></p>
		</div>
	</div>
</body>