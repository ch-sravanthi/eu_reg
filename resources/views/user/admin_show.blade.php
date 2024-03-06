@include('header')
<div class="container">
    <div class="text-center">
				<h5 class=".text-warning float-left mb-2">Admin Information:</h5>
	</div>
	<div class="text-right mb-5">
		@if(Auth::user()->isSuperAdmin())
			<a class = "btn btn-sm btn-outline-primary" href = "{{ url('user/index') }}"><i class = "fa fa-arrow-left"></i></a>
			<a class="btn btn-outline-primary btn-sm" href="{{ route('user.admin_create',$user->id)}}"><i class = "fa fa-pencil"></i></a>	
			<?php $route = url('user/delete/'.$user->id)?>
			<a href="#" class="btn btn-outline-primary btn-sm" onclick="deleteRow('{{ $route }}')"> <i class="fa fa-trash"></i> </a>
		@endif
	</div>
	
	<div class="container table table-bordered table-striped p-5 shadow-lg p-3 mb-10 bg-body rounded">
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
</div>	
<script>
							function deleteRow(route) {
							var result = confirm("Are you sure?");
								if(result) {
									location.href = route;
								}
							}
				</script>
 @include('footer')	