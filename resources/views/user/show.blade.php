@extends('layouts.app')

@section('title')	
	<a href="#">User Details</a> 
@endsection

@section('navs')	
	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('blog/my_index') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">User Information</li>
	  </ol>
	</nav>
@endsection

@section('content')	

<div class="table-responsive">
	<div class="form form-view">
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<th>Name</th>	
						<td>{{ $user->name }}</td>
							
						<th>Email</th>	
						<td>{{ $user->email }}</td>
					</tr>
					
					<tr>
						<th>Role</th>	
						<td>{{ $user->role }}</td>
						
						<th>status</th>	
						<td colspan=3>{{ $user->status }}</td>
					</tr>
					
				</table>
			</fieldset> 
		</div>
		
	</div>
</div>
@endsection

	
					
					
			