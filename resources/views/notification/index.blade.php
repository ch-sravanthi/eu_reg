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
		
		<div class="card">
			 <div class="card-header">
				Notification Details 
			</div>
		</div><br>

			@foreach($notifications as $notification) 
			<div class="row row-cols-1 row-cols-md-3 g-4">
				<div class="col-md-12">
				   <div class="card mb-3" style="border-radius:3%;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.8);">
					<div class="card-body">
						<tr>
							<td>	
								<?php $img = $notification->image_1 ? url('viewfile/'.$notification->image_1) : null?>
								@if ($img)
									<a href="{{ $img }}">
										<img src="{{ $img }}"  style="width: 40%"/>
									</a>
								@endif
								<br/>
								{!! hyperlinks($notification->description) !!}
							</td><br/><br/>
							
							<p style="color:grey;font-size:14px;">{!! date('d M Y', strtotime($notification->created_at)) !!} 
							by {{ $notification->person_name }}</p>
						</tr>
					
					</div>
				  </div>
				</div>
			</div>
			@endforeach
	</div>
	{{ $notifications->withQueryString()->links() }}
@endsection