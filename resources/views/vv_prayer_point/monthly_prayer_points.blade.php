@extends('layouts.appvv')

@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	  
		@if(Auth::user())<?php //var_dump($user->email);die();?>
			@if(Auth::user()->role == 'Admin')
				<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
			@endif
		@else
			<li class="breadcrumb-item"><a href="{{ route('authenticate.vv') }}">Home</a></li>
		@endif
		<li class="breadcrumb-item active" aria-current="page">Monthly - Prayer Points</li>
		
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
				<b class = "text-dark">Monthly - Prayer Points Posted </b>
				<div class="badge bg-info"> {{ $vv_prayer_points->total() }} </div>
			</div>	
			
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
					
					{!! Form::select('vv_month', AppHelper::options('vv_months'), request()->vv_month, ['class' => ' mr-2', 'placeholder' => ' Select Month ']) !!}
					{!! Form::select('vv_year', AppHelper::options('vv_years'), request()->vv_year, ['class' => ' mr-2', 'placeholder' => ' Select Year ']) !!}
					
					 &nbsp;
				<button  class="btn btn-primary btn-sm mr-2">
					<i class="bi bi-search"></i>
				</button>&nbsp;
				<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('vv_prayer_points') }}">Reset</a>&nbsp;
				
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
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($vv_prayer_points as $vv_prayer_point)
            <div class="col-md-4 d-flex">
                <div class="card mb-3 card-equal-height" style="border-radius:4%; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2)">
                    <div class="card-body card-body-equal-height">
                        <div class="row" style="line-height: 2;">
                           
                            <div>
                                 <p><i class="bi bi-calendar3"></i> &nbsp;{{ $vv_prayer_point->vv_month }} &nbsp;{{ $vv_prayer_point->vv_year }}</p>
                                <?php $ext = pathinfo($vv_prayer_point->attachment_1, PATHINFO_EXTENSION); ?>
                                @if($ext == 'pdf')
									<!--<td colspan="2" style="width:120px; padding:2px;">	
										<iframe class="noprint" src="{{ url('viewfile/'.$vv_prayer_point->attachment_1 ) }}" frameborder="0" height="180px" width="180px">
										</iframe>
									</td>-->
                                    {!! EasyForm::viewFile('attachment_1', '', $vv_prayer_point->attachment_1) !!}
                                @endif
                            </div>
                            <p style="color:grey; font-size:14px;"><i class="bi bi-person-circle"></i>  Posted on {!! date('d M Y', strtotime($vv_prayer_point->created_at)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div><br>
</div><br>

	{{ $vv_prayer_points->withQueryString()->links() }}
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