@extends('layouts.app')

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
				<b class = "text-dark">Website URL's </b>
				<div class="badge bg-info"> {{ $more_links->total() }} </div>
			</div>	
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
						{!! Form::text('search', request()->search, ['class' => ' mr-4', 'placeholder' => 'URL's']) !!}&nbsp;
						<button  class="btn btn-primary btn-sm mr-2">
							<i class="bi bi-search"></i>
						</button>&nbsp;
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('more_link.my_index') }}">Reset</a>&nbsp;
					{!! Form::close() !!}	&nbsp;
				</div>
			</div>
		</div>
		
		
		
		<div class="card card-body table-wrapper">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						 <tr>
							<th>More Jobs & Education Details</th>
							<th></th>
						 </tr>
					</thead>
				<tbody>
				
				<?php $s=1;?>
				@foreach($more_links as $more_link)
				
					<tr>
						<td style="text-align:justify-content-end;"> 
							{!! hyperlinks($more_link->link_url) !!}
						</td>
						
						<td>
						<?php //var_dump(Auth::user());die();?>
							
							<a href="{{ url('more_link/edit/'.$more_link->id) }}"class="btn btn-sm btn-primary" ><i class = "bi bi-pen"></i></a>
						
							<?php $route = url('more_link/delete/'.$more_link->id)?>
							<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
					
						</td>
					</tr>
					
				@endforeach
				</table>
			</div>
		</div>
	</div>
	{{ $more_links->withQueryString()->links() }}
	<script>
		function deleteRow(route) {
		var result = confirm("Are you sure?");
			if(result) {
				location.href = route;
			}
		}
	</script>
@endsection