@extends('layouts.appuser')

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
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('notification.index') }}">Reset</a>&nbsp;
					{!! Form::close() !!}	&nbsp;
				</div>
			</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered">
				<thead >
					 <tr style="text-align:center;">
						
						<th style="width:90%;">Notification Details </th>
						<th>Posted On</th>
					 </tr>
				</thead>
				<?php $s=1;?>
				<tbody>	
				@foreach($notifications as $notification)
					<tr>
						<td>	
							@if($notification->image_1)
								<img src="{{ url('viewfile/'.$notification->image_1) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
							@endif
						<br/>
							
						{!! hyperlinks($notification->description) !!}
						</td>
						<td style="text-align:center;">{!! date('d M Y', strtotime($notification->created_at)) !!} <br/>by {{ $notification->person_name }}</td>
					</tr>
				@endforeach
				</tbody>	
			</table>
			{{ $notifications->withQueryString()->links() }}
		</div>
	</div>
		
@endsection