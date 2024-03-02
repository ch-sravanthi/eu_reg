<!-- Form JS -->
<script src="{{ asset('js/cropper.js?v=1.0') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.3.5/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.3.5/cropper.min.js"></script>
<script src="{{asset('js/file.js?v=1.3')}}"></script>

<div class="row">
	<div class="col-lg-4">
		<div class="list-group">
			<div class="list-group-item list-title">
				Attachments
			</div>
			
			@foreach ($model->files() as $file)
				@if (!empty($model->$file))
					<a href="{{ route($model->modelname().'.viewfile', [$model->id, $file]) }}" class="list-group-item list-inactive">
						{!! $model->label($file) !!}
					</a>
				@else
					<a href="{{ route($model->modelname().'.openfile', [$model->id, $file]) }}" class="list-group-item list-inactive">
						{!! $model->label($file) !!}
					</a>					
				@endif
			@endforeach
		</div>
	</div>
	<div class="col-lg-8 file-uploader">
		
	</div>
</div>