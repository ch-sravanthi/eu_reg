@include('layouts.header')
	
	
	<style>
		html,body,.page{
			font-size: 16px;
			background-color: #ddd;
			padding-top: 40px;
			font-family:sans-serif !important;
		}
		.navbar-brand{
			margin-right:0px;
		}
		nav a{
			color: #fff!important;
			font-size: 16px;
		}
		 .btn
		 {
			width: auto;
		}   
		input{
			width: 165px;
		}
		.navbar-light .navbar-toggler{
			border-color:#fff;
		}
		.navbar, input[type=submit], .btn{
		//	background: linear-gradient(to bottom, #bb2514, #782607);
			background: linear-gradient(to bottom, #950589, #a34079);
		}
		.btn:hover{
			    background-color: #208962!important;
				border-color: #066f74!important;
		}
		.my-4{
			margin-top : 1px !important;
			margin-bottom : 1px!important;
		}
		.breadcrumb{
			line-height : 3 !important;
		}
		.dropdown-item{
			padding:15px;
		}
	</style>
	
	
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color:grey; border-bottom: 1px solid #678bbd11; font-weight: 500;"><br>
		<div class="container-fluid">
			<a class="navbar-brand" href="https://uesits.com/"><img class="rounded" src="{{ asset('images/vv.jpeg') }}" height="60"></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				@if(Auth::user()->role == 'Admin')
					
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 d-sm-none d-md-block">
					<li class="nav-item" style="color:#fff;">
						<a class="nav-link active" aria-current="page" href="#" > Welcome To Vidhyarthi Velugu World </a> 
					</li>
				</ul>
				
				&nbsp;&nbsp;&nbsp;
				<ul class="navbar-nav  mb-lg-0 ml-1">
					<li class="nav-item dropdown">
						<a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownFavorites" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							All in One
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownFavorites" style="background-color:#0e98e9;">
							<li><a class="dropdown-item" href="{{url('subscriptions')}}" style="background-color:#0e98e9;"><i class="bi bi-card-checklist"></i> &nbsp;Subscriptions</a></li>
							
							<li><a class="dropdown-item" href="{{url('address_changes')}}" style="background-color:#0e98e9;"> <i class="bi bi-postcard"></i>&nbsp;Address Change</a></li>
							
							<li><a class="dropdown-item" href="{{url('complaints')}}" style="background-color:#0e98e9; "><i class="bi bi-exclamation-diamond-fill"></i>&nbsp;Complaints</a></li>
							
							<li><a class="dropdown-item" href="{{url('feedbacks')}}" style="background-color:#0e98e9;"><i class="bi bi-hand-thumbs-up-fill"></i>&nbsp; Feedback</a></li>
							
							<li><a class="dropdown-item" href="{{url('prayer_points')}}" style="background-color:#0e98e9;"><i class="bi bi-person-lines-fill"></i> &nbsp;Prayer Points</a></li>
						</ul>
					</li>
				</ul>
				&nbsp;&nbsp;&nbsp;
				<ul class="navbar-nav  mb-lg-0 ml-1">
					<li class="nav-item dropdown">
						<a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownFavorites" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Upload Soft Copy
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownFavorites" style="background-color:#0e98e9;">
							<li><a class="dropdown-item" href="{{url('vv_magazines')}}" style="background-color:#0e98e9;"><i class="bi bi-postcard"></i>  VV Magazine</a></li>
							
						</ul>
					</li>
				</ul>
				&nbsp;&nbsp;&nbsp;
				@endif
				
				<ul class="navbar-nav  mb-lg-0 ml-1">
					<li class="nav-item dropdown">
						<a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownFavorites" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						 
							@if(Auth::user())
								 {{ ucwords(Auth::user()->name) }}
							@endif
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownFavorites" style="background-color:red; ">

							<li><a class="dropdown-item" href="{{route('authenticate.logout')}}" style="background-color:red; " >Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
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
