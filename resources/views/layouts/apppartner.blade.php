<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="google" content="notranslate">
	<link rel="shortcut icon" href="{{ asset('favicon.png') }}">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- JQuery JS -->
	<script src="{{ asset('jquery/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('popper/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>
   
    <!-- Custom -->
	<script src="{{ asset('js/form.js?v=7.0.6') }}"></script>

    <title>{{ config('app.name', 'App') }}</title>
		
	@include('layouts.theme')
  </head>
  <body>
	

  
	<div class="content-wrapper my-1 py-1">
		<nav class="navbar navbar-expand-1g navbar-light titlebar">
		  <a class="navbar-brand" href="#">
			@yield('title')
		  </a>		  
		   <div class="navs" id="menuContent">
			<ul class="navbar-nav m0-auto">
			
			  @yield('navs')
			</ul>
			
		  </div>

		</nav>
		<div class="content">
			@yield('content')
			<div class="py-3 text-center noprint">
				<hr></hr>
				Response Time: {{ round(microtime(true) - LARAVEL_START, 2) }} Seconds
				<div>© {{ date('Y') }} {{ config('app.name') }}</div>
			</div>
		</div>
	</div>
	
    <link rel="stylesheet" href="{{ asset('jquery/jquery-ui.css') }}">
	<script src="{{ asset('jquery/jquery-ui.js') }}"></script>
	{{ Form::open(['id' => 'form']) }} {{ Form::close() }}
	
	
	<script>
	
		$('#myform').on('submit', function() {
			var submit = document.getElementById("submit");
			submit.getElementsByTagName("i")[0].classList.remove("d-none");
			submit.disabled  = true; 
			submit.parentNode.getElementsByTagName("a")[0].classList.add("d-none");
		});

		/* To display selected file name */
		window.pressed = function(obj){
			var fileLabel = obj.parentNode.getElementsByTagName("label")[0];
			if(obj.value == "")
			{
				fileLabel.innerHTML = "Choose file";
			}
			else
			{
				var theSplit = obj.value.split('\\');
				fileLabel.innerHTML = theSplit[theSplit.length-1];
			}
		};
		
		
		/* Add total */
		function add() 
		{		   
			var total = 0;
			var list = document.getElementsByName('amount[]');
			for (var i = 0; i < list.length; i++) { 
				if ( !isNaN(parseInt(list[i].value)) ) {
					total += parseInt(list[i].value);  
				}
			}
			document.getElementById('total').value=total;   
		}

	</script>
	
	
			
<script type="text/javascript">
	/* Related to attachment */
	function addNewAttachment1(obj) {
		var parent = obj.parentNode.parentNode.parentNode;
		var ele = parent.getElementsByTagName("div")[0].cloneNode(true);
		parent.appendChild(ele);
		ele.getElementsByTagName("input")[0].value = null;
		ele.getElementsByTagName("label")[0].innerHTML = "Choose File";
		resetElements(ele);
		setSingleNode(ele, "file");
	}
	
	function addNewAttachment(obj) {
		var parent = obj.parentNode.parentNode.parentNode;
		var ele = parent.getElementsByTagName("div")[0].cloneNode(true);
		parent.appendChild(ele);
		var inp = ele.getElementsByTagName("input");
		var sel = ele.getElementsByTagName("select");
		var txt = ele.getElementsByTagName("textarea");
		for (var e of inp) {
			e.value = null;
		}
		for (var e of sel) {
			e.selectedIndex = 0;
		}
		for (var e of txt) {
			e.value = null;
		}
		ele.getElementsByTagName("label")[0].innerHTML = "Choose File";
		resetElements(ele);
		setSingleNode(ele, "file");
	}
	
	function removeAttachment(obj) {	
		
		var parent = obj.parentNode.parentNode.parentNode;
		if(parent.children.length == 1) {
			alert("Oops! you cannot delete.. Click on the FILE you uploaded to Replace..!!");
			return;
		}
		var node = obj.parentNode.parentNode;
		parent.removeChild(node);
	}
	
	
	function updateAttachment(obj) {	
		
		var parent = obj.parentNode.parentNode;
		var attachments = parent.getElementsByTagName("input");
		for (var i=0; i<attachments.length; i++) {
			if (attachments[i].type != 'file') continue;			
			attachments[i].setAttribute("name", "attachment["+obj.value+"][]")
			//alert(attachments[i]);
		}
	}
	
	function setSingleNode(obj, className) {
		var nodes = obj.getElementsByClassName(className);
		if (nodes.length < 1) return;
		var parent = nodes[0].parentNode;
		var node = nodes[0];
		parent.innerHTML = "";
		parent.appendChild(node);
	}
	
	

	function trPattern(obj) { 
		var type = obj.options[obj.selectedIndex].value;
		var inp = obj.parentNode.parentNode.getElementsByTagName("input")[0];
		if (type == 'account_transfer' || type == 'cash') {
			inp.setAttribute("pattern", "[a-zA-Z0-9\\s\\-]+");
		} else {
			inp.setAttribute("pattern", "[a-zA-Z0-9]+");			
		}
	}


  </script>
	
	<style>
	input, select{
		width: 100%;
	}
	input[type=file]{
		width: 100%;
	}
	.form .row{		
		background-color: #eee;
	}
	.row{
		border: 1px solid #ccc;
		border-radius: 3px;
		position: relative;
		padding: 1rem 2rem;
	}
	.col{
		margin: 0.5rem 0rem;
	}
	.buttons{
		position: absolute;
		right: 3px;
		top: 0px;
		font-size: 1.1rem;
		cursor: pointer;
	}
	.bill{
		padding: 1.25rem 0.5rem 0.5rem 0.5rem!important;
		margin-bottom: 0.5rem;
	}
	.file{
		border: 1px solid #555;
		border-radius: 3px;
		padding1:0;
		margin-bottom: 0.5rem;
	}
	.file .file-buttons{
		min-width: 50px;
	}
	.file i{
		cursor: pointer;
		padding: 0px 5px;
		margin:0;
		position:relative;
	}
	input[type=file]{
		position: absolute;
		width: 1px;
	}
	.file label{
		background-color: #e0ebf7;
		min-height: 24px;
		margin:0;
		padding: 0px 5px;
		width:100%
	}
</style>
<script src="{{ asset('js/cdp_print.js?v=1.3') }}"></script>
  </body>
</html>
