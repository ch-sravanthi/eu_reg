@extends('layouts.app')
@section('title')
	

@endsection
@section('navs')

@endsection
@section('content')	


<?php
	
  function hyperlinks($text) {
    $v = preg_replace('@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@', '<a target="ref" href="http$2://$4">$1$2$3$4</a>', $text);
	
	return nl2br($v);
}
	?>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mb-3">
					<b class = "text-dark">Notifications Posted </b>
					<div class="badge bg-info"> {{ $notifications->total() }} </div>
						
			</div>	
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
						{!! Form::text('search', request()->search, ['class' => ' mr-4', 'placeholder' => 'Description']) !!}&nbsp;
						<button  class="btn btn-primary btn-sm mr-2">
							<i class="bi bi-search"></i>
						</button>&nbsp;
						<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('notification.my_index') }}">Reset</a>&nbsp;
				
					{!! Form::close() !!}	&nbsp;
					</div>
			</div>
		</div>
		&nbsp;
				
		<div class="card table-wrapper">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						 <tr>
							<th>S.No</th>
							<th>Notification Description </th>
							<th>Posted On</th>
							<th>Status</th>
							<th colspan=2>Action</th>
							
						 </tr>
					</thead>
				<tbody>
				
				<?php $s=1;?>
				@foreach($notifications as $notification)
				
					<tr>
						<th>{{ $s++ }}</th>
						
						<td>
							<?php $img = $notification->image_1 ? url('viewfile/'.$notification->image_1) : null?>
							<?php $ext = pathinfo($notification->image_1, PATHINFO_EXTENSION);?>
							@if($ext =='pdf')
								{!! EasyForm::viewFile('image_1', '', $notification->image_1) !!}	
							@else
								<a href="{{ $img }}">
									<img src="{{ $img }}"  style="width:60%"/>
								</a>
							@endif
						<br/>
							{!! hyperlinks($notification->description) !!} - 
						</td>
						
						<td style="font-size:12px;">{!! date('d M Y', strtotime($notification->created_at)) !!} <br/>by {{ $notification->person_name }}</td>
						<td>{{ $notification->status }}</td>
						<td>
						<?php //var_dump(Auth::user());die();?>
						
							<a href="{{ url('notification/edit/'.$notification->id) }}"class="btn btn-sm btn-primary" ><i class = "bi bi-pen"></i></a>
						</td>
						<td>
							<?php $route = url('notification/delete/'.$notification->id)?>
							<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a><br>
						
						</td>
					</tr>
				@endforeach
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
	<style>
		 svg,.shadow-sm{
			display:none;
		}
		.bg-white{
			background-color:#d77878 !important;
		}
	<style>		

@endsection