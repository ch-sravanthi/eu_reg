@include('header')
<div class="container">
    <div class="text-center">
		<h5 class=".text-warning float-left ">Users Information</h5>
	</div>
	<div class = "text-right mb-2">
		@if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
			<a class = "btn btn-sm btn-outline-primary" href = "{{ url('user/index') }}"><i class = "fa fa-arrow-left"></i></a>
			<a class="btn btn-outline-primary btn-sm" href="{{ route('user.create',$user->id)}}"><i class = "fa fa-pencil"></i></a>	
		@endif
	</div>
	
</div>	
	<?php 
			$district =  $user->district;
			$opt = AppHelper::options('districts');
			$district_name = $opt[$district->state][$district->district];
		?>
	<div class="container table table-bordered table-striped p-5 shadow-lg p-3 mb-5 bg-body rounded">
				<table class="table">
				<div class = "row">
					<div class = "col-lg-3 mb-2">
						<div>
							{{ $user->nicenames['name'] }}
						</div>
					</div>
					<div class = "col-lg-3 mb-2">
						<div>
							<label>{{ $user->name }}</label>
						</div>
					</div>
					<div class = "col-lg-3 mb-2">
						<div>
							{{ $user->nicenames['email_id'] }}
						</div>
					</div>
					<div class = "col-lg-3 mb-2">
						<div>
							<label>{{ $user->email_id }}</label>
						</div>
					</div>
					<div class = "col-lg-3 mb-2">
						<div>
							{{ $user->nicenames['mobile_no'] }}
						</div>
					</div>
					<div class = "col-lg-3 mb-2">
						<div>
							<label>{{ $user->mobile_no }}</label>
						</div>
					</div>
					<div class = "col-lg-3 mb-2">
						<div>
							{{ $user->nicenames['role'] }}
						</div>
					</div>
					<div class = "col-lg-3 mb-2">
						<div>
							<label>{{ $user->role }}</label>
						</div>
					</div>
					@if($user->role = 'Volunteer')
						<div class = "col-lg-3 mb-2">
							<div>
								District
							</div>
						</div>
						<div class = "col-lg-3 mb-2">
							<div>
								<label>{{ $district_name }}</label>
							</div>
						</div>
					@endif	
					<div class = "col-lg-3 mb-2">
						<div>
							{{ $user->nicenames['status'] }}
						</div>
					</div>
					<div class = "col-lg-3 mb-2">
						<div>
							<label>{{ $user->status }}</label>
						</div>
					</div>
				</table>
		</div>	
	</div>
 @include('footer')	