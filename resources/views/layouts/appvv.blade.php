@include('layouts.header')
	<style>
		html,body,.page{
			font-size: 16px;
			background-color: #ddd;
			padding-top: 30px;
			font-family:sans-serif !important;
		}
		.navbar-brand{
			margin-right:0px;
		}
		nav a{
			color: #fff!important;
			font-size: 16px;
		}
		.navbar-brand{
			margin-right:0px;
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
	</style>
	
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#fff; border-bottom: 2px solid #678bbd11; font-weight: 500;">
		<div class="container-fluid">
			<a class="navbar-brand" href="https://uesits.com/"><img class="rounded" src="{{ asset('images/logo.png') }}" height="40"></a>
			
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>	
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 d-sm-none d-md-block">
					<li class="nav-item" style="color:#fff;">
						<a class="nav-link active" aria-current="page" href="#" >Welcome To UESI TS Vidyarthi Velugu All In One</a>
					</li>
				</ul>
						
			&nbsp;
			@if(Auth::user())
				<ul class="navbar-nav  mb-lg-0 ml-1">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="{{url('new_subscriptions')}}"> <i class="bi bi-card-checklist"></i> New Subscription</a>
					</li>	
				</ul>
				
				<ul class="navbar-nav  mb-lg-0 ml-1">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="{{url('renewals')}}"> <i class="bi bi-bell-fill"></i> Renewal</a>
					</li>	
				</ul>
				
				<ul class="navbar-nav  mb-lg-0 ml-1">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="{{url('address_changes')}}"> <i class="bi bi-newspaper"></i> Address Change</a>
					</li>	
				</ul>
				
				<ul class="navbar-nav  mb-lg-0 ml-1">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="{{url('complaints')}}"> <i class="bi bi-question-diamond-fill"></i> Complaints</a>
					</li>	
				</ul>
				
				<ul class="navbar-nav  mb-lg-0 ml-1">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="{{url('feedbacks')}}"> <i class="bi bi-hand-thumbs-up-fill"></i> Feedback</a>
					</li>	
				</ul>
			
				<ul class="navbar-nav  mb-lg-0 ml-1">
					<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="{{ url('prayer_points')}}"> <i class="bi bi-person-lines-fill"></i> Prayer Points</a>
						</li>	
				</ul>
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
			@endif		
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
