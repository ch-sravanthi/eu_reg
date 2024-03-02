@extends('layouts.apppartner')

@section('title')
	
@endsection

@section('content')


 <div class="form-group">
	<div class="block">
		<div class="col">      
				<div class="text-center">
					<button type="button" style= "padding:30px 62px;"class="btn btn-danger" onclick="location.href='{{ route('field_staff_report.sub_menu') }}'">Bills Submission </button>
				</div>        
			</div> 
     </div> 
</div>

<div class="form-group">
	<div class="block">
		<div class="col">      
				<div class="text-center">
					<div type="button" style= "padding:30px 42px;"class="btn btn-primary" onclick="location.href='{{ route('field_staff_report.donation_sub_menu') }}'">Donation Submission</div>
				</div>        
			
		</div> 
     </div> 
</div>
@endsection
