@include('header')
<div class="container">
    <div class = "text-right mb-2">
		<a class = "btn btn-sm btn-outline-primary" href = "{{ url('user/index') }}"><i class = "fa fa-arrow-left"></i></a>
	</div>
	<div class="my-5">
	   <form action="{{url('user/update/'.$users->id)}}" method="post">
				@csrf
			<div class="row">
			  <div class="col-lg-6">
				   <label>{{ $user->nicenames['name'] }}</label>
							{{ Form::text('name', old('name', old('name', $users->name)), ['class' => 'form-control','placeholder' => 'Enter Name']) }}
				</div>
			   <div class="col-lg-6">
					<label>{{ $user->nicenames['email_id'] }}</label>
						   {{ Form::text('email_id', old('email_id', old('email_id', $users->email_id)), ['class' => 'form-control','placeholder' => 'Enter Email Id']) }}
			   </div>
			</div>
			<div class="row">
			   <div class="col-lg-6">
					<label>{{ $user->nicenames['mobile_no'] }}</label>
						   {{ Form::text('mobile_no', old('mobile_no', old('mobile_no', $users->mobile_no)), ['class' => 'form-control','placeholder' => 'Enter Mobile number']) }}
			   </div>
			   <div class="col-lg-6">
			  <label>{{ $user->nicenames['role'] }}</label>
					{{ Form::select('role', [''=>'--select Here--', 'Volunteer' => 'Volunteer', 'Staff' => 'Staff'], old('role', $users->role),['class' => 'form-control']) }}
			  </div>
			</div>
			<div class="row">
			<div class="col-lg-6 mb-2">
					<div>District</div>
					<div>{{ Form::select('district_id', ['' => '']+$districts, old('district_id', ''),['class' => 'form-control']) }}</div>
				</div>
			  <div class="col-lg-6">
			  <label>{{ $user->nicenames['status'] }}</label>
					{{ Form::select('status', [''=>'--select Here--','active' => 'active', 'inactive' => 'inactive',], old('status', ''),['class' => 'form-control']) }}
			  </div>
					   <div class="col-lg-12 text-center p-2">
						   {{Form::submit('Submit', ['class' => 'btn btn-success']) }}
					   </div>
				</div> 
				</div>
		</form>	
	</div>
<div>	
 @include('footer')	