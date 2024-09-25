@extends('layouts.appvv_subscriber')

@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		
		<li class="breadcrumb-item active" aria-current="page">VV Monthly - Magazine</li>
	  </ol>
	</nav>
@endsection

@section('content')
<style>
    .card-equal-height {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .card-body-equal-height {
        flex-grow: 1;
    }
</style>

<div class="container">
		<div class="row">
			<div class="col-lg-4 mb-3">
				<b class = "text-dark">Monthly - Magazines </b>
				<div class="badge bg-info"> {{ $vv_magazines->total() }} </div>
			</div>	
			
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
					
					{!! Form::select('magazine_month', AppHelper::options('vv_months'), request()->magazine_month, ['class' => ' mr-2', 'placeholder' => ' Select Month ']) !!}
					{!! Form::select('magazine_year', AppHelper::options('vv_years'), request()->magazine_year, ['class' => ' mr-2', 'placeholder' => ' Select Year ']) !!}
					
					 &nbsp;
				<button  class="btn btn-primary btn-sm mr-2">
					<i class="bi bi-search"></i>
				</button>&nbsp;
				<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('vv_magazine') }}">Reset</a>&nbsp;
				
					{!! Form::close() !!}	&nbsp;
				</div>
			</div>
		</div>
		<div class="card">
			 <div class="card-header">
			VV Monthly - Prayer Points
			</div>
		</div><br>
	
<div class="table-responsive">
       
	@include ('common.image_viewer')
    <div class="row row-cols-1 row-cols-md-3 g-4"> 
		@foreach($vv_magazines as $vv_magazine)
            <div class="col-lg-4 d-flex">
                <div class="card mb-3 card-equal-height" style="border-radius:4%; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2)">
                    <div class="card-body card-body-equal-height">
					<tr>
                        <div class="row" style="line-height: 2;">
                            <div> 
								<b>Title: </b>{{ $vv_magazine->name_of_the_file }}<br/>
								<p><i class="bi bi-calendar3"></i> 	&nbsp;
								{{ $vv_magazine->magazine_month }} 	&nbsp;
								{{ $vv_magazine->magazine_year }}</p>
                               
								
								<img src="{{ url('viewfile/'.$vv_magazine->cover_page) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
							</div>
                            <div class="col-lg-12">
								<b>Prayer Points Copy </b>
								<?php $ext = pathinfo($vv_magazine->prayer_copy, PATHINFO_EXTENSION); ?>
								{!! EasyForm::viewFile('prayer_copy', '', $vv_magazine->prayer_copy) !!}
								
								<b>Magazine Copy </b>
								<?php $ext = pathinfo($vv_magazine->magazine_copy, PATHINFO_EXTENSION); ?>
								
								<iframe src="{{ url('viewfile/'.$vv_magazine->magazine_copy) }}#toolbar=0" width="100%" height="600px"></iframe>
                            </div>
                          
                          
                            <p style="color:grey; font-size:14px;"><i class="bi bi-person-circle"></i>  Posted on {!! date('d M Y', strtotime($vv_magazine->created_at)) !!}</p>
                        </div>
						</tr>
                    </div>
                </div>
            </div>    
		@endforeach
	</div><br>
       
 
</div><br>

	{{ $vv_magazines->withQueryString()->links() }}
</div>
	<style>
		 svg,.shadow-sm{
			display:none;
		}
		.bg-white{
			background-color:#d77878 !important;
		}
	<style>
@endsection