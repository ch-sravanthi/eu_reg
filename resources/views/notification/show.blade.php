@extends('layouts.appuser')

@section('title')	
	<a href="#">Notification Details</a> 
@endsection

@section('navs')	
	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Notification Information</li>
	  </ol>
	</nav>
@endsection

@section('content')	
<?php
	
  function hyperlinks($text) {
    $v = preg_replace('@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@', '<a target="ref" href="http$2://$4">$1$2$3$4</a>', $text);
	
	return nl2br($v);
}
	?>

	<div class="col-lg-12  text-danger" style="font-weight:600;">
		<u>Note: </u>This is for information only, Please Verify before you Proceed, We are not Liable for any Information Posted on this Portal.
	</div><br>
<div class="table-responsive">
	<div class="form form-view">
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					
					<tr>
						<td>
						{!! hyperlinks($notification->description) !!} <br/>
						@if($notification->image_1)
							<img src="{{ url('viewfile/'.$notification->image_1) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
						@endif
						</td>
					</tr>
					
					<tr>
						<th>Posted On</th>	
						<td>{!! date('d M Y', strtotime($notification->created_at)) !!}&nbsp;by {{ $notification->person_name }}</td>
					</tr>
				</table>
			</fieldset> 
		</div>
			
		
	</div>
</div>
			
		
@endsection


	
					
					
			