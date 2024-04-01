@if(Auth::user())
	@extends('layouts.app')
@else
	@extends('layouts.appuser')
@endif

@section('title')	
	<a href="#">Notification Details</a> 
@endsection

@section('navs')	
	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('notification/my_index') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Notification Information</li>
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
						<th>{{ $notification->label('description') }}</th>	
						<td colspan=3>{{ $notification->description }}
						<br>
						@if($notification->image_1)
							<img src="{{ url('viewfile/'.$notification->image_1) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
						@endif
						</td>
					</tr>
					
					<tr>
						<th>Posted On</th>	
						<td>{{ $notification->created_at }}</td>
						
						<th>Person Name</th>	
						<td>{{ $notification->person_name }}</td>
					</tr>
					
					<tr>
						<th>Person Mobile No</th>	
						<td>{{ $notification->person_mobile }}</td>
						
						<th>Person Email ID </th>	
						<td>{{ $notification->person_email }}</td>
					</tr>
					
					<tr>
						<th>{{ $notification->label('status') }}</th>	
						<td colspan=3>{{ $notification->status }}</td>
					</tr>
				</table>
			</fieldset> 
		</div>
			
		
	</div>
</div>
@endsection

	
					
					
			