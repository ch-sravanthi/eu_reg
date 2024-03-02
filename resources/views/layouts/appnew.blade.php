<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="google" content="notranslate">
	<link rel="shortcut icon" href="{{ asset('favicon.png') }}">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Custom -->
	<script src="{{ asset('js/form.js?v=7.0.6') }}"></script>

    <title>{{ config('app.name', 'App') }}</title>
		
  </head>
  <body style="background-color: #cbd5f0">
	<style>
		body{
			font-family: 'open sans';
			font-size: 14px;
		}
		input, select, textarea{
			border: 1px solid #aaa;
			padding: 0.25em;
		}
		.form input, .form select, .form textarea{
			border-radius: 5px;
			max-width: 200px;
			margin-bottom: 0.5em;
		}
		table input, table select{
			max-width: inherit!important;
			border: none;
		}
		table td{
			padding:0!important;
			margin: 0!important;
		}
		.xs{
			max-width: 70px!important;
		}
		.sm{
			max-width: 110px!important;
		}
		label{
			display: block;
			font-weight: 500;
		}
		.card-body{
			padding: 1em;
		}
		.pointer{
			cursor: pointer;
		}
		a.card:hover{
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
	</style>
  
	<div class="m-2">
		<div class="content">
			@yield('content')
			<div class="py-3 text-center noprint">
				
				Response Time: {{ round(microtime(true) - LARAVEL_START, 2) }} Seconds
				<div>© {{ date('Y') }} {{ config('app.name') }}</div>
			</div>
		</div>
	</div>


	{{ Form::open(['id' => 'form']) }} {{ Form::close() }}

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<script src="{{ asset('js/cdp_print.js?v=1.3') }}"></script>
	<script>
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl)
	});
	</script>
	
  </body>
</html>
