@extends('layouts.appvv')

@section('title')	
	<a href="#">Prayer Points View</a> 
@endsection

@section('navs')	
	
	
@endsection

@section('content')	


<div class="table">
	<div class="form form-view">
		<div class="">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<th>{{ $vv_prayer_point->label('name_of_the_file') }}</th>	
						<td>{{ $vv_prayer_point->name_of_the_file }}</td>
						
						<th>{{ $vv_prayer_point->label('vv_month') }}</th>	
						<td>{{ $vv_prayer_point->vv_month }}</td>
							
						<th>{{ $vv_prayer_point->label('vv_year') }}</th>	
						<td>{{ $vv_prayer_point->vv_year }}</td>
					</tr>
				</table>
			</fieldset> 
		</div>
			
		<div class="">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<td colspan=3>
						
						
						<?php $ext = pathinfo($vv_prayer_point->attachment_1, PATHINFO_EXTENSION);?>
						@if($ext =='pdf')
							{!! EasyForm::viewFile('attachment_1', $vv_prayer_point->label('attachment_1'), $vv_prayer_point->attachment_1) !!}	
						
						@endif
						
						</td>
					</tr>
				</table>
			</fieldset> 
		</div>
	</div>
</div>
			
		
@endsection

	
					
					
			