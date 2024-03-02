@include('layouts.header')
	
	
	<style>
		html,body,.page{
			font-size: 15px;
			background-color: #ddd;
			padding-top: 30px;
		}
	</style>
	<nav class="navbar navbar-expand-lg navbar-dark px-3">
  <a class="navbar-brand" href="#">Portal</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('home') }}"><i class="bi bi-house"></i> Home</a>
      </li>
	  @if(isset(\App\User::auth()->organization) && isset(\App\User::auth()->organization->partner_id))
		  <li class="nav-item active">
			<a class="nav-link active" href="{{ route('project.select') }}"><i class="bi bi-plus-circle"></i> New Project</a>
		  </li>
		  
		  <li class="nav-item active">
			<a class="nav-link active" href="{{ route('organization.view') }}"><i class="bi bi-bank"></i> Organization</a>
		  </li>
	  @endif
	  <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		        <i class="bi bi-person"></i> {{ \App\User::auth()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('signout') }}">Logout</a></li>
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
