@extends('layouts.appuser')

@section('title')	
	<a href="#">Job Details</a> 
@endsection

@section('navs')	
	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Job Information</li>
	  </ol>
	</nav>
@endsection

@section('content')	


	<div class="col-lg-12  text-danger" style="font-weight:600;">
		<u>Note: </u>This is for information only, Please Verify before you Proceed, We are not Liable for any Information Posted on this Portal.
	</div><br>

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
						<td>{{ $blog->last_date }}</td>
					</tr>
					
					<tr>
						<th>{{ $blog->label('description') }}</th>	
						<td colspan=3>{{ $blog->description }}</td>
					</tr>
					
					<tr>
						<th>Posted On</th>	
						<td colspan=3>{{ $blog->created_at }}</td>
					</tr>
				</table>
			</fieldset> 
		</div>
			
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<th  colspan=4>
						Job Information Attachments</th>
					</tr>
					<tr>
						<td  colspan=3>
						@if($blog->image_1)
							<img src="{{ url('viewfile/'.$blog->image_1) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
						@endif
						</td>
					</tr>
					<tr>
						<td  colspan=3>
						@if($blog->image_1)
							<img  src="{{ url('viewfile/'.$blog->image_2) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
						@endif
						</td>
					</tr>
				</table>
			</fieldset> 
		</div>
	</div>
			
		
@endsection

	
					
					
			