var field, route;
var cropper;
var photoWidth = 375;
var photoHeight = 450;

function showFile(f, imageroute, uploadroute)
{
    field = f;
    route = uploadroute;
    showUploadBlock ("idUpload");
    var img = document.getElementById("img");
    loadImageFromServer(field, imageroute, uploadroute);
}

function uploadFile(f, r)
{
    field = f;
    route = r;
    var img = document.getElementById("img");
    img.classList.add("d-none");
    img.src = '#';
    initCropper(img);
    showUploadBlock ("idUpload");
}

	function loadImage(obj, imageID)
    {
        var file = obj.files[0];
        var reader = new FileReader();
        var img = document.getElementById(imageID);
        reader.onload = function (e) {
            //alert();
            img.src = e.target.result;
            img.classList.remove("d-none");
            initCropper(img);
        };
        reader.readAsDataURL(obj.files[0]);
    }
     
     function loadImageFromServer(field, imageroute, uploadrouteIfError)
     {
        var img = document.getElementById("img");
        $.ajax({
            url: imageroute,
            type: 'GET',
            success: function(data){                 
                img.src = data;
                img.classList.remove("d-none");
                initCropper(img);
            },
            error: function(data) {
               uploadFile(field, uploadrouteIfError);
            }
        });
     }
     
     function uploadImage(){
         
       //  var objImageLoader = document.getElementById("idImageLoader");
        // objImageLoader.classList.remove("d-none");
        if (field == 'photo') {
            cropper.getCroppedCanvas({width: photoWidth, height: photoHeight}).toBlob(function (blob) {         
                fileUpload(field, route, blob);
            });
        } else {
            
            cropper.getCroppedCanvas().toBlob(function (blob) {   
                    //var size = blob.size/1024;
                    var imageData = cropper.getImageData();
                    var width = imageData.naturalWidth;
                    var height = imageData.naturalHeight;
                    
                    var dst = document.createElement("canvas");
                    dst.width = width;
                    dst.height = height;
                    var ctx = dst.getContext("2d");
                    ctx.drawImage(cropper.getCroppedCanvas(), 0, 0, width, height);
                    
                    base64 = dst.toDataURL('image/jpeg');
                    size = Math.round(base64.length * 6 / 8);
                    if (size > 1024) {
                        base64 = dst.toDataURL('image/jpeg', 0.7);
                    }
                    blob = dataURItoBlob(base64);
                   // alert(size/1024);
                   // alert(blob.size/1024);
                    fileUpload(field, route, blob);
                
            });
        }
    }
    
    function dataURItoBlob(dataURI) {
        var byteString;
        if (dataURI.split(',')[0].indexOf('base64') >= 0)
            byteString = atob(dataURI.split(',')[1]);
        else
            byteString = unescape(dataURI.split(',')[1]);
        var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
        var ia = new Uint8Array(byteString.length);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ia], {type:mimeString});
    }

    /**
    * If error check php max upload size
    */
    function fileUpload(field, route, blob, progressBar, errorMessageBlock)
    {
        
        var formData = new FormData();
        formData.append(field, blob);
        
           
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    if (progressBar !== undefined) {
                        progressBar.style.width = percentComplete+"%";
                    }
                  }
                }, false);

                return xhr;
          },
          url: route,
          type: "POST",
          enctype: 'multipart/form-data',
          data: formData,
          contentType: false,
          processData: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(result) {
                location.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            var error = JSON.parse(jqXHR.responseText);
            var errorMessage = "";
            for (var key in error) {
                errorMessage+= "<div class='py-1'>" + error[key] + "</div>";
                console.log(error[key]);
            }
            if (errorMessageBlock !== undefined) {
                errorMessageBlock.innerHTML = errorMessage;
            }
          }
        });
    } 
     
     // init variable is used to hide error message
    function initCropper(image, init)
    {
       // var image = document.getElementById('img');
        //document.getElementById("idFileStatus").classList.add("d-none");
        if  (cropper) {
           cropper.destroy();
        }
        var uploadButton  = document.getElementById("idUploadButton");
        
        if (uploadButton!== undefined && uploadButton.disabled) {
            uploadButton.disabled = false;
        }
        if (field == 'photo') {
                cropper = new Cropper(image, { 
                    viewMode: 2,
                    aspectRatio: photoWidth / photoHeight,
                    dragMode: 'move',
                    cropBoxMovable: true,
                    cropBoxResizable: false,
                    zoomable: false,
                    minCropBoxWidth: photoWidth,
                    minCropBoxHeight: photoHeight,
                    ready: function(e) {
                        var imageData = cropper.getImageData();    
                        if (imageData.naturalWidth <= photoWidth || imageData.naturalHeight <= photoHeight) {
                            //cropper.destroy();
                            uploadButton.disabled = true;
                            if (!init) {
                                document.getElementById("idFileStatus").classList.remove("d-none");
                            }
                        }
                    }
                    
                });
        } else {
            cropper = new Cropper(image,{autoCrop: false, zoomable: false});
        }
                           
    }

function showUploadBlock(id)
{
    var ch = document.getElementById("idUploadBlocks").getElementsByClassName("upload-box");
    for (var i=0; i< ch.length; i++) {
            if (ch[i].id != id) {
                ch[i].classList.add("d-none");
            } else {            
                ch[i].classList.remove("d-none");
            }
    }
}

function showFileLoader(loaderImagePath)
{   
    var img = document.getElementById("img");
    img.src = loaderImagePath;
    img.classList.remove("d-none");alert();
}


function pasteFromClipboard(items) {
    var imgContainer = document.getElementById("idUpload");
    var imageID = 'img';
    if(!imgContainer.classList.contains("d-none")) {
       

    for (var i = 0; i < items.length; i++) {
        // Skip content if not image
        if (items[i].type.indexOf("image") == -1) continue;
        // Retrieve image on clipboard as blob
        var blob = items[i].getAsFile();
        //alert(blob);
        
        var reader = new FileReader();
        var img = document.getElementById(imageID);
        reader.onload = function (e) {
            //alert();
            img.src = e.target.result;
            img.classList.remove("d-none");
            initCropper(img);
        };
        reader.readAsDataURL(blob);        
    }
       
    
    }
}

