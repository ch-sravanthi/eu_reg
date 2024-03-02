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
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- JQuery JS -->
	<script src="{{ asset('jquery/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('popper/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>
   
    <!-- Custom -->
	<script src="{{ asset('js/form.js?v=7.0.6') }}"></script>

    <title>{{ config('app.name', 'App') }}</title>
		
	@include('layouts.theme')
		
  </head>
  <body>
	@include ('layouts.nav.navpartner')	  

		
	<div class="content-wrapper py-5 px-2">
		<div class="text-right">
			<a  type="button"  class="btn btn-info" class="btn" href="{{ route('login') }}">Login</a>
		</div>
		<div class="text-center p-5">
			<a class="card card-body d-inline-block h5 p-5 shadow mr-3" style="background-color: #f4325c; color: #fff; text-decoration: none;" href="{{ route('field_staff_report.sub_menu') }}"><i class="fas fa-tasks"></i> Bill Submission</a>
			<a class="card card-body d-inline-block h5 p-5 shadow" style="background-color: #7854f6; color: #fff; text-decoration: none;" href="{{ route('donation.select') }}"><i class="fas fa-money-bill"></i> Donation Submission</a>
		</div>
			<div class="py-3 text-center noprint">
				<hr></hr>
				Response Time: {{ round(microtime(true) - LARAVEL_START, 2) }} Seconds
				<div>© {{ date('Y') }} {{ config('app.name') }}</div>
			</div>
	</div>
	
    <link rel="stylesheet" href="{{ asset('jquery/jquery-ui.css') }}">
	<script src="{{ asset('jquery/jquery-ui.js') }}"></script>
  </body>
</html>
