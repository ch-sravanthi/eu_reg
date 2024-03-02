@include ('common.image_viewer')
<div class="row">
	<div class="col-lg-2">
		@include ('common.fileoptions')
	</div>
	<div class="col-lg-4 file-uploader1">
		<div class="image" style="background-image: url('{!! EasyForm::loadImage($model->$filename) !!}')">
		</div>
		<div class="py-0 my-0">
			<a class="btn btn-theme" href="#" onclick="openImageViewer('{{ url('viewfile/'.$model->$filename) }}')"><i class="fas fa-search-plus"></i> FULL VIEW</a> &nbsp;
			<a class="btn btn-theme" href="{{ route($model->modelname().'.openfile', [$model->id, $filename]) }}">CHANGE FILE</a>
		</div>
	</div>
</div>