<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/image_viewer.css?v=2') }}" >

<div class="modal pb-imageviewer" tabindex="-1" role="dialog" id="pb-imageviewer-model">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">
				Image Viewer
			</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div id="pb-img-viewer-wrapper" style="overflow: auto;">
				<div id="pb-img-viewer" class="pb-img-viewer" style="background-size: contain; transform: rotate(0deg) scale(1)">				
				</div>
			</div>
		</div>
				 
		<div class="modal-footer">
			<button class="btn btn-theme" onclick="imageViewerZoomin()">				
				<i class="fas fa-search-plus" id="pb-img-viewer-zoom-icon"></i>
			</button>
			<div class="d-inline img-viewer-inactive-buttons" id="pb-img-viewer-buttons">	
				<button class="btn btn-theme" onclick="imageViewerZoomout()">				
					<i class="fas fa-search-minus" id="pb-img-viewer-zoom-icon"></i>
				</button>
				<button class="btn btn-theme" onclick="imageViewerRotate()" >
					<i class="fas fa-sync"></i>
				</button>
			</div>		
			
			<div class="d-inline ml-auto">
				@if (Auth::user()->can('print', \App\User::class))
					<button class="btn btn-theme" onclick="printImage()">
						<i class="fas fa-print"></i> Print
					</button>
					&nbsp; 
					<button class="btn btn-theme" onclick="downloadImage()">
						Download
					</button>
					&nbsp; 
				@endif
				<button class="btn btn-theme" onclick="imageViewerDisableZoom()">
					Reset
				</button>
				&nbsp;
				<button class="btn btn-theme" data-dismiss="modal" aria-label="Close">
					Close
				</button>
			</div>
		</div>			 
	</div>
	</div>
</div>

<!-- JS -->
<script src="{{ asset('js/image_viewer.js?v=5') }}"></script>