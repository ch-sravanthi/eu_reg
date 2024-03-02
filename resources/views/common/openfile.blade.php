<div class="row">
	<div class="col-lg-4">
		@include ('common.fileoptions')
	</div>
	<div class="col-lg-8 file-uploader1">
		<?php 
			$rules = $model->rules();
			$isImage = (strpos($rules[$filename], 'image') !== false);
		?>
		@include ('common.image_picker', [
			'isImage' => $isImage,
			'viewUrl' => route($model->modelname().'.viewfile', [$model->id, $filename]),
			'saveUrl' => route($model->modelname().'.savefile', [$model->id, $filename])
		])
		
	</div>
</div>

