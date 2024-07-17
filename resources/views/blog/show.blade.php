@extends('layouts.appuser')

@section('title')	
	<a href="#">Job Details</a> 
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

	<div class="col-lg-12  text-danger" style="font-weight:600;">
		<u>Note: </u>This is for information only, Please Verify before you Proceed, We are not Liable for any Information Posted on this Portal.
	</div><br>
<div class="table-responsive">
	<div class="form form-view">
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<th>{{ $blog->label('blog_title') }}</th>	
						<td>{{ $blog->blog_title }}</td>
							
						<th>{{ $blog->label('category') }}</th>	
						<td>{{ $blog->category }}</td>
					</tr>
					
					<tr>
						<th>{{ $blog->label('location') }}</th>	
						<td>{{ $blog->location }}</td>
							
						<th>{{ $blog->label('last_date') }}</th>	
						<td>{{ date('d M Y', strtotime($blog->last_date)) }}</td>
					</tr>
					
					<tr>
						<th>{{ $blog->label('description') }}</th>	
						<td colspan=3>{!! hyperlinks($blog->description) !!}</td>
					</tr>
					
					<tr>
						<th>Posted On</th>	
						<td colspan=3>{!! date('d M Y', strtotime($blog->created_at)) !!}&nbsp;by {{ $blog->person_name }}</td>
					</tr>
				</table>
			</fieldset> 
		</div>
			
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<th colspan=4>
						Job Information Attachments :<text class="text-muted small"> (if any)</text></th>
					</tr>
					<tr>
						<td colspan=3>
						<?php $ext = pathinfo($blog->image_1, PATHINFO_EXTENSION);?>
						@if($ext =='pdf')
							{!! EasyForm::viewFile('image_1', $blog->label('image_1'), $blog->image_1) !!}	
						@else	
							<?php $img = $blog->image_1 ? url('viewfile/'.$blog->image_1) : asset('/images/default.png')?>
							<a href="{{ $img }}">
								<img src="{{ $img }}" style="width:70%"/><br><br>
							</a>
						@endif
					</tr>
					<tr>
						<td colspan=3>
						<?php $img2 = $blog->image_2 ? url('viewfile/'.$blog->image_2) : null?>
						
						<?php $ext = pathinfo($blog->image_2, PATHINFO_EXTENSION);?>
						@if($ext =='pdf')
							{!! EasyForm::viewFile('image_2', $blog->label('image_2'), $blog->image_2) !!}	
						@elseif ($img2)
							<a href="{{ $img2 }}">
								<img src="{{ $img2 }}"  style="width:60%"/>
							</a>
						@endif
						
						</td>
					</tr>
				</table>
			</fieldset> 
		</div>
	</div>
</div>
			
		
@endsection

	
					
					
			