	
	var pbImageViewer = document.getElementById("pb-img-viewer");
	var pbImageViewerWrapper = document.getElementById("pb-img-viewer-wrapper");
	var pbImageViewerMoveDistance = 30;
	var pbImageViewerZoomValue = 0.5;
	var pbImageViewerIntervalHandler;
	var pbImageViewerWrapperWidth, pbImageViewerWrapperHeight;
	
	$('#pb-imageviewer-model').on('hidden.bs.modal', function (e) {		
		imageViewerDisableZoom();
	});
	$(function() {
		$('.modal-dialog').draggable({
			handle: ".modal-header"
	    });
	});
	function openImageViewer(url) {
		pbImageViewer.style.backgroundImage = "url("+url+")";
		//pbImageViewerImg.src = url;
		$('#pb-imageviewer-model').modal('toggle').draggable({ handle: ".modal-header" });
	}
	function imageViewerZoom() {
		if (!imageViewerZoomEnabled()) {
			imageViewerEnableZoom();
		} else {
			imageViewerDisableZoom();
		}			
	}
	
	function imageViewerZoomin() {
		if (!imageViewerZoomEnabled()) {
			imageViewerEnableZoom();
		} else {
			//var scale = getCssTransformValue(pbImageViewer, 'scale');	
			//updateCssTransform(pbImageViewer, 'scale', scale + pbImageViewerZoomValue);	
		}
		
		imageViewerSize(parseInt(pbImageViewer.style.width) + 100, parseInt(pbImageViewer.style.height) + 100); 
		
	}
	
	function imageViewerSize(width, height) {
		if (width < pbImageViewerWrapperWidth) {
			return;
		}
		pbImageViewer.style.width = width + "px";
		pbImageViewer.style.height = height + "px";
		
	}
	
	function imageViewerZoomout() {
		// return if zoom not enabled
		if (!imageViewerZoomEnabled()) {
			return;
		}
		//var scale = getCssTransformValue(pbImageViewer, 'scale');		
		//updateCssTransform(pbImageViewer, 'scale', scale - pbImageViewerZoomValue);	
		
		imageViewerSize(parseInt(pbImageViewer.style.width) - 100, parseInt(pbImageViewer.style.height) - 100); 
	}	
	
	function imageViewerRotate() {
		// return if zoom not enabled
		if (!imageViewerZoomEnabled()) {
			return;
		}
		var rotate = getCssTransformValue(pbImageViewer, 'rotate');		
		updateCssTransform(pbImageViewer, 'rotate', rotate + 90);	
	}
	

	
	function updateCssTransform(obj, type, value) {
		if (type == 'rotate') {
			var scale = getCssTransformValue(pbImageViewer, 'scale');	
			var rotate = value;
		} else if (type == 'scale') {
			var rotate = getCssTransformValue(pbImageViewer, 'rotate');	
			var scale = value;
			
		}
		if (rotate >= 360) rotate = 0;
		else if (rotate <= 0) rotate = 360;
		
		if (scale <= 0) return;
		
		obj.style.transform = "rotate(" + rotate + "deg) scale(" + scale + ")";
		
		document.getElementById("pb-img-viewer-wrapper").style.overflow = (scale > 1) ? "auto" : "scroll";
	}
	
	function getCssTransformValue(obj, type) {		
		var val = obj.style.transform;	
		// if empty transform style return 0
		if (!val) {
			return 0;
		}
		
		var split = val.split(type + '(');
		// if empty transform function(type) return 0
		if (split.length < 0) {
			return 0;
		}
		
		return parseFloat(split[1]);
	}
	
	
	function imageViewerEnableZoom() {		
		var imgButtons = document.getElementById("pb-img-viewer-buttons");	
		
		pbImageViewer.style.backgroundSize = "contain";
		pbImageViewer.style.backgroundPosition = "0px 0px";
		imgButtons.classList.remove("img-viewer-inactive-buttons");
		
		pbImageViewerWrapperWidth = pbImageViewer.offsetWidth;
		pbImageViewerWrapperHeight = pbImageViewer.offsetHeight;
		
		pbImageViewerWrapper.style.maxWidth = pbImageViewerWrapperWidth + "px";
	    pbImageViewerWrapper.style.maxHeight = pbImageViewerWrapperHeight + "px";
		
		pbImageViewer.style.width = pbImageViewerWrapperWidth + "px";
		pbImageViewer.style.height = pbImageViewerWrapperHeight + "px";
	}
	
	function imageViewerDisableZoom() {		
		var imgButtons = document.getElementById("pb-img-viewer-buttons");
		
		pbImageViewer.style.backgroundSize = "contain";
		pbImageViewer.style.backgroundPosition = "center";
		pbImageViewer.style.transform = "rotate(0deg) scale(1)";
		imgButtons.classList.add("img-viewer-inactive-buttons");
		
		pbImageViewer.style.width = pbImageViewerWrapperWidth + "px";
		pbImageViewer.style.height = pbImageViewerWrapperHeight + "px";
	}
	
	function imageViewerZoomEnabled() {
		var imgButtons = document.getElementById("pb-img-viewer-buttons");	
		return !imgButtons.classList.contains("img-viewer-inactive-buttons");
		
		//return pbImageViewer.style.backgroundSize == "cover";
	}
	
	function printImage() { 
		var img = document.getElementById("pb-img-viewer");
		var url = img.style.backgroundImage.slice(4, -1).replace(/"/g, "");
		
		Pagelink = "Image";
		var pwa = window.open(Pagelink, "_new");
		pwa.document.open();
		pwa.document.write(sourceToPrint(url));
		pwa.document.close();
		pwa.print();
		pwa.close();
		return true;
	}
	
	function downloadImage() { 
		var img = document.getElementById("pb-img-viewer");
		var url = img.style.backgroundImage.slice(4, -1).replace(/"/g, "");
		
		window.open(url,'_blank');
		return true;
	}
	
	function sourceToPrint(source) {
		return "<html><head><script>function step1(){\n" +
				"setTimeout('step2()', 10);}\n" +
				"function step2(){window.print();window.close()}\n" +
				"</scri" + "pt></head><body onload='step1()'>\n" +
				"<img src='" + source + "' /></body></html>";
	}