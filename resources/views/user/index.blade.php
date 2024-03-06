@include('header')
<div class="container">
	<div class="container row mb-2">
		<div class="col-lg-2">
		    <b class = "text-dark">User Information </b><div class="badge bg-info"> {{ $users->total() }} </div></a>
		</div>
		
	    <div class="col-lg-8">
				{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
				<?php $options = (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()) ? ['Admin' => 'Admin', 'Volunteer' => 'Volunteer', 'Staff' => 'Staff'] : ['Volunteer' => 'Volunteer'];?>
				{!! Form::text('name', request()->name, ['class' => ' mr-2', 'placeholder' => 'Name']) !!}
				{!! Form::text('email_id', request()->email_id, ['class' => ' mr-2', 'placeholder' => 'Email']) !!} 
					{!!Form::text('mobile_no', request()->mobile_no, ['class' => ' mr-2', 'placeholder' => 'Mobile']) !!}
				{!! Form::select('role', $options, request()->role, ['class' => ' mr-2', 'placeholder' => 'Select Role']) !!}
				<button class = "btn btn-primary btn-sm mr-2">Filter</button>
				<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('user/index') }}">Reset</a>
				<a class="btn btn-sm btn-primary mr-2" href="{{url('user/create')}}">Add</a>
			{!! Form::close() !!}	
        </div>
	</div>
	
		<table class="table table-striped table-hover table-bordered">
			<thead>
				 <tr>
					<th>S.No</th>
					<th>{{ $user->nicenames['name'] }}</th>
					<th>{{ $user->nicenames['email_id'] }}</th>
					<th>{{ $user->nicenames['mobile_no'] }}</th>
					<th>{{ $user->nicenames['role'] }}</th>
					<th>{{ $user->nicenames['status'] }}</th>
					<th>Action</th>
				 </tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				@foreach($users as $user)
					<tr>
					<?php $route = ($user->isAdmin() || $user->isSuperAdmin()) ? url('user/admin_show/'.$user->id) : url('user/show/'.$user->id) ?>
						<th>{{ $i++ }}</th>
						<td>
							<a href="{{ $route }}">{{ $user->name }}</a>
							
						</td>
						<td>{{ $user->email_id }}</td>
						<td>{{ $user->mobile_no }}</td>
						<td>{{ $user->role }}</td>
						<td>{{ $user->status }}</td>
						<td>
						@if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
							@if($user->role == 'Admin')
							<a href="{{ url('user/admin_create/'.$user->id) }}"> <i class = "fa fa-pencil"></i> </a>
						@else
							<a href="{{ url('user/create/'.$user->id) }}"> <i class = "fa fa-pencil"></i> </a>
						@endif
							<?php $route = url('user/delete/'.$user->id)?>
							<a href="#" onclick="deleteRow('{{ $route }}')"> <i class="fa fa-trash"></i> </a>
						@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $users->withQueryString()->links() }}
	
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