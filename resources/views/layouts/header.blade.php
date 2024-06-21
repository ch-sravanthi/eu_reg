<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
	/>

	<link rel="stylesheet" href="{{ asset('jquery/jquery-ui.css') }}">
	<script src="{{ asset('jquery/jquery-ui.js') }}"></script>


    <link rel="stylesheet" href="{{ asset('jquery/jquery-ui-timepicker-addon.css') }}">
	<script src="{{ asset('jquery/jquery-ui-timepicker-addon.js') }}"></script>
	
	<script src="{{ asset('js/form.js?v=21') }}"></script>
	<!-- Custom -->

	<title></title>
  <style>
    html,body{
		font-family: 'Roboto', sans-serif;
		min-height: 100vh;
    }	
		.label {
			font-weight1:500;
		}
		.label::after{
			content: ": ";
		}
		.card{
			box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
		}
		.navbar, input[type=submit],.btn {			
			background: linear-gradient(to bottom, #182b89, #146bc5); 
			padding-bottom:1px;
			padding-top:1px;
			
		}
		.navbar-brand {
			padding-top: .1rem;
			padding-bottom: .1rem;
		}
		input[type=submit]:hover,.btn:hover {
			background: linear-gradient(to right, #146bc5, #182b89); 
		
		}
		input[type=submit],.btn {			
			display: inline-flex;
			align-items: center;
			justify-content: center;
			
		}
		input[type=submit] *,.btn *{
			margin: 0px 0.25em;			
		}
		.navbar{			
			position: fixed;
			width: 100%;
			top: 0;
			z-index: 999;
		}
		input[type=submit],.btn {
			border: none;
		//	padding: 0.25em 1.5em;
			color: #fff;
			border-radius: 0.25em;
		}
		.btn:hover{
			color: #fff;
		}
		.breadcrumb-item a, .breadcrumb-item.active{
			color: #000!important;
			font-weight: 600;
		}
		.tab-content{
			margin: 1em 0em;
		}
		.form div{
			margin-bottom: 0.5em;
		}
		h6{
			font-weight: bold;
			margin-bottom: 1em;
			display: inline-block!important;
			border-bottom: 1px solid #7e1046;
		}
		
		.error{
			border: 1px solid #f00!important;
		}
		.pe-none label{
			color: lightgray;
		}
		.btn-prev, .btn-next{
			position: fixed;
			top: 50%;
			height: 30px;
			width: 30px;
			padding: 0;
			border-radius: 50%;
		}
		.btn-prev{
			left: 20px;
		}
		.btn-next{
			right: 20px;
		}
	</style>
	<script>
		var CSRF_TOKEN = '';
		$(function() {
			CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		});
		function saveModel(obj) {
			var form = $(obj).closest('form')[0];
			//$(form).submit(); return;
			//console.log(form);alert(); return;
			var errors = 0;
			$.each($(form).find('input, select'),function(){
				//console.log($(this).is("select"));
				//console.log($(this).val());
				var hasValue = $(this).is("select");
				if (!$(this).prop('required') 
					|| $(this).hasClass('ui-autocomplete-input')
					|| $(this).is("input[type=checkbox]")
					|| $(this).is("input[type=radio]")
					|| $(this).is(":hidden")) {
					return;
				}
				  if ($(this).val() == "") {
					  console.log($(this).attr('name'));
					  $(this).addClass("error");
					  if ($(this).is("select")) {
						  $(this).closest('.dropdown').addClass("error");
					  }
					  errors++;
				  } else {
					   $(this).removeClass("error");				   
					  if ($(this).is("select")) {
						  $(this).closest('.dropdown').removeClass("error");
					  }
				  }
			});
			if (errors > 0) {
				alert("Some errors found, please check");
				return;
			}
			$(form).submit(); return;
			var formData = new FormData(form);
			$(form).find('.error').html(" ");
			$(form).find('.loader').addClass("loading");
			
			$(form).find('.progressval').addClass('prog').html("0%");
			//alert(form.action);
			$.ajax({ 
					xhr: function() {
							var xhr = new window.XMLHttpRequest();

							// Upload progress
							 xhr.upload.onprogress = function(evt){
									var percentComplete = evt.loaded / evt.total;
									var per = Math.round(percentComplete * 100);
									
									$(form).find('.progressval').html(per+"%");
								};
						   xhr.upload.onload = function(){ 
								$(form).find('.progressval').removeClass('prog');
								$(form).find('.loader').removeClass("loading");
							} ;
						   return xhr;
						},
                    url: form.action,
                    type: 'POST',
					headers: {
						'X-CSRF-TOKEN': CSRF_TOKEN
					},
                    data: formData,
                    success: function (response) { 
					console.log(response);
						if(window.location.href == response.redirect) {
							location.reload();
						} else {
							window.location.href = response.redirect;
						}
						
                    },
                    error: function (response) { 
						
						$(form).find('.progressval').removeClass('prog').html("");
						$(form).find('.loader').removeClass("loading");
						
						var responseText = $.parseJSON(response.responseText);
						if (responseText.error) {
							alert(responseText.error);
							return;
						}
						var errors = responseText.errors;
						console.log(response);
						
						var errTxt = "";
						for(var k in errors) {
							errTxt+= errors[k]+"\n";
						}
						alert("Some errors found, please check \n"+errTxt);
						/*
						for(var k in errors) {
							$(form).find('.error-'+k).html(errors[k]);
							$(form).find('.error-'+k).removeClass("d-none");
							console.log(k);
						}
						$(form).find('.spin').addClass("fa-check-circle").removeClass("fa-spinner fa-spin");
						$(form).find('.progressval').html("<i class='fas fa-exclamation-triangle'></i>");
						*/
                    },
					cache: false,
					contentType: false,
					processData: false
                }); 
		}
	</script>
	
	</head>
	<body>