@if ($model->$filename)
	<div class="py-3">
		{!! EasyForm::viewFile('file', null, $model->$filename) !!}
	</div>
	
	<div class="py-3 text-theme h6">
		File Exists. Do you want to change?
	</div>
@endif

{!! Form::open(['url' => $saveUrl, 'files' => true]) !!}
	{{ Form::file('file') }}
	{{ Form::submit('Upload') }}
{!! Form::close() !!}