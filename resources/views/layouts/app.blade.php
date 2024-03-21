@include('layouts.header')
	
	
	<style>
		html,body,.page{
			font-size: 16px;
			background-color: #ddd;
			padding-top: 30px;
		}
		nav a{
			color: #fff!important;
		}
		 .btn
		 {
			width: auto;
		}   
		input{
			width: 200px;
		}
	</style>
	
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color:grey; border-bottom: 2px solid #678bbd11; font-weight: 500;">
		<div class="container-fluid">
			<a class="navbar-brand" href="{{ route('welcome') }}"><img class="rounded" src="{{ asset('images/logo.png') }}" height="40"></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 d-sm-none d-md-block">
				<li class="nav-item" style="color:#fff;">
					<a class="nav-link active" aria-current="page" href="#" > Welcome To UESI TS Job Portal </a>
				</li>	
			</ul>
	  
			<ul class="navbar-nav  mb-lg-0 ml-1">
				<li class="nav-item dropdown">
					<a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownFavorites" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					 
						@if(Auth::user())
							Welcome {{ ucwords(Auth::user()->name) }}
						@endif
					</a>
					<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownFavorites" style="background-color:grey; ">

						<li><a class="dropdown-item" href="{{route('authenticate.logout')}}" style="background-color:red; " >Logout</a></li>
					</ul>
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
