@include('header')
<div class="container">
    <h3 class="text-center .text-warning">User Create</h3>
	<div class = "text-right mb-2">
		<a class = "btn btn-sm btn-outline-primary" href = "{{ url('user/index') }}"><i class = "fa fa-arrow-left"></i></a>
	</div>
		<div class="table table-striped my-5">
		{!! Form::open(['url' => route('user.save', $user->id)]) !!}
					@csrf
				<div class="row">
				  <div class="col-lg-6">
					   <label>{{ $user->nicenames['name'] }}</label>
							{{ Form::text('name', old('name', $user->name), ['class' => 'form-control']) }}
							@if($errors->has('name'))
								<div class="text-danger">{{ $errors->first('name') }}</div>
							@endif
				  </div>
				   <div class="col-lg-6">
					   <label>{{ $user->nicenames['email_id'] }}</label>
						   {{ Form::text('email_id', old('email_id', $user->email_id), ['class' => 'form-control']) }}
						   @if($errors->has('email_id'))
								<div class="text-danger">{{ $errors->first('email_id') }}</div>
							@endif
				   </div>
				</div>
				<div class="row">
				  <div class="col-lg-6">
					   <label>{{ $user->nicenames['mobile_no'] }}</label>
						   {{ Form::text('mobile_no', old('mobile_no', $user->mobile_no), ['class' => 'form-control']) }}
						   @if($errors->has('mobile_no'))
								<div class="text-danger">{{ $errors->first('mobile_no') }}</div>
							@endif
				  </div>
				  <div class="col-lg-6">
				       <label>{{ $user->nicenames['role'] }}</label>
						{{ Form::select('role', [''=>'--select Here--','Volunteer' => 'Volunteer', 'Staff' => 'Staff','AM' => 'AM'], old('role', $user->role),['class' => 'form-control']) }}
						@if($errors->has('role'))
								<div class="text-danger">{{ $errors->first('role') }}</div>
							@endif
				  </div>
				</div>
				<div class="row">
					<div class="col-lg-6 mb-2">
						<label>District</label>
						<div>{{ Form::select('user_district_id', ['' => '']+$districts, old('user_district_id', $user->user_district_id),['class' => 'form-control']) }}
						@if($errors->has('user_district_id'))
								<div class="text-danger">{{ $errors->first('user_district_id') }}</div>
							@endif
						</div>
					</div>
				 
				</div>
				@if($user && $user->id)
					<div class="row">
					  <div class="col-lg-6">
					  <label>{{ $user->nicenames['status'] }}</label>
							{{ Form::select('status', [''=>'','Active' => 'Active', 'Inactive' => 'Inactive',], old('status', $user->status),['class' => 'form-control']) }}
					  </div>
					</div>
				@endif
						   <div class="col-lg-12 text-center p-2">
							   {{Form::submit('Submit', ['class' => 'btn btn-success']) }}
						   </div>
								{!! Form::close() !!}		

		</div>	
		
</div>	
 @include('footer')	