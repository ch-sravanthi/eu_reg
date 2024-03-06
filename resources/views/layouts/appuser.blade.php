@include('layouts.header')
	<style>
		html,body,.page{
			font-size: 17px;
			background-color: #ddd;
			padding-top: 30px;
		}
		nav a{
			color: #fff!important;
		}
	</style>
	
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#fff; border-bottom: 2px solid #678bbd11; font-weight: 500;">
		<div class="container-fluid">
			<a class="navbar-brand" href="{{ route('welcome') }}"><img class="rounded" src="{{ asset('images/logo.png') }}" height="40"></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Welcome To UESI TS Job Portal</a>
					</li>	
				</ul>
			</div>
	</nav>
	@hasSection('content')
		<div class="container my-4">
			@yield('navs')
			
			@include('common.flash')
			
			<div class="card card-body">				
				@yield('content')
			</div>
		</div>
	@endif
	@yield('dashboard')
@include('layouts.footer')
