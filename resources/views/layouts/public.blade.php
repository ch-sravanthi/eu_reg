@include('layouts.header')
	 <style>
    html,body{
		background: #cccccc;
		background: -webkit-linear-gradient(to top, #cccccc, #0757aa); 
		//background: linear-gradient(to top, #cccccc, #0757aa);
		background-image:  url("paper.gif");default.png;
    }
	</style>
	@yield('content')
			
@include('layouts.footer')
