@extends('layouts.app')

@section('title')	
	<a href="{{ route('welcome') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('blog/my_index') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Verify Job Details </li>
	  </ol>
	</nav>
@endsection

@section('content')	

<div class="container">
	<div class="table table-striped ">
		{!! Form::open(['url' => route('blog.update', [$blog->id]),'method' => 'post', 'id' => 'idForm', 'files' => true]) !!}		
		{!! EasyForm::setErrors($errors) !!}
			@csrf
		<div class="form form-view">
			<div class="table-wrapper">
				<fieldset class="section">
					<table class="table table-bordered m-0">
						<tr>
							<th>{{ $blog->label('blog_title') }}</th>	
							<td>{{ $blog->blog_title }}</td>
								
							<th>{{ $blog->label('category') }}
							
							
							</th>	
							<td>{!! EasyForm::select('category', '', old('category', $blog->category), AppHelper::options('categories')) !!}</td>
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
							<td>{{ $blog->created_at }}</td>
							
							<th>Person Name</th>	
							<td>{{ $blog->person_name }}</td>
						</tr>
						
						<tr>
							<th>Person Mobile No</th>	
							<td>{{ $blog->person_mobile }}</td>
							
							<th>Person E-mail</th>
							<td>{{ $blog->person_email }}</td>
						</tr>
						
						<tr>
							<th>{{ $blog->label('status') }}</th>	
							<td colspan=3>{{ $blog->status }}</td>
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
				
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					{!! EasyForm::select('status', $blog->label('status'), old('status', $blog->status), AppHelper::options('blog_status'))!!}
						@if($errors->has('status'))
							<div class="text-danger">{{ $errors->first('status') }}</div>
						@endif
				</table>
			</fieldset> 
		</div>
		<br><br>
		
		<div class="text-center">
			<button type="submit" class="btn btn-outline-secondary">Verify Job Details</button>
		</div>				
		</div>
		{{Form::close()}}	
    </div>

@endsection		
