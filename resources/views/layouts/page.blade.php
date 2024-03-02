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
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;1,700&display=swap" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
	/>

	<script src="{{ asset('js/form.js?v=20') }}"></script>
	<!-- Custom -->

	<title></title>
	<?php $color = '#c90076';?>
	<?php $col1 = '#191e57';?>
	<?php $collapse = false;//Auth::user() && Auth::user()->setting->nav_collapse?>
	<?php $menuLimit = 5?>
	<?php $access_control = Auth::user() ? Auth::user()->access_control : null?>
	<?php $role_type = $access_control ? $access_control->role_type : null?>
	<style>
		html,body,.page{
			font-family: 'Open Sans', sans-serif;
			font-size: 15px;
			min-height: 100vh!important;
			//background-color: #e8ecf2;
		}
		.public{
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
			background1: #7F00FF;
			background1: -webkit-linear-gradient(to right, #E100FF, #7F00FF);
			background1: linear-gradient(to right, #E100FF, #7F00FF);
			background-color: #f2f4f8;
		}
		.public .card{
			height: 450px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 1.2em;
		}
		.card1{
			width: 800px;
			background: linear-gradient(to bottom, #1e58a5, #69c4e7);
			background-image: url('login.gif');
			background-size: cover;
		}
		.card2{
			position: absolute;
			top: -30px;
			right:100px;
			min-width: 340px;
			min-height: 500px;
		}
		img.profile{
			height: 36px;
			width: 36px;
			border-radius: 18px;
			 box-shadow: 0px 0px 18px #506ab1;
			object-fit: cover;
			object-position: top;
		}
		.mynav{
			color: #ffffff;
			background-color: {{$col1}};
			width1: 250px;
			position1: fixed;
			height: 100%;
			z-index: 999;
		}
		.mynav .subtitle{
			color: #ccd9f8;
			font-size: 0.9em;
		}
		.mynav .subtitle a{
			color: #89a7ec;
			font-size: 0.95em;
			font-weight: bold;
		}
		.mynav .subtitle a:hover{
			color: #fff;
		}
		.mynav .tooglenav{
			position: absolute;
			width: 100%;
			text-align: center;
			font-size: 1.2em;
			bottom: 15px;
		}
		.mynav .tooglenav a{
			color: #fff;
		}
		.maincontent1{
			margin-left: 250px;
		}
		.mycollapse .maincontent1{
			margin-left: 100px;
		}
		.mycollapse .mynav{
			width1: 100px;
		}
		.mycollapse .modulename{
			display: none;
		}
		.mycollapse .mylist a{
			text-align: center;
			font-size: 1.2em;
		}
		.mylist a{
			color: #ffffff;
			text-decoration: none;
			display1: block;
			text-align: left;
			padding: 0.5em 0.5em;
			border-radius: 0.25em;
		}
		.mylist i{
			margin-right: 0.5em;
		}
		.mylist a:hover{
			background-color: #262b69;
		}
		.card-title{
			font-weight: 500;
			font-size: 1.1em;
		}
		.card-box{
			text-align: center;
			border-radius: 0.5em;
			padding: 1em;
			font-weight: 700;
		}
		.card-box.sm{
			padding: 0.5em!important;
		}
		.card-box.sm div{
			font-size: 0.85em!important;
		}
		.b1{
			background-color: #efefff;
			color: #1111bb;
		}
		.b2{
			background-color: #efffef;
			color: #009b00;
		}
		.b3{
			background-color: #dce6fa;
			color: #656a83;
		}
		.bgcol0{
			background-color: #f8f9e1;
		}
		.bgcol1{
			background-color: #f4ddff;
		}
		.bgcol2{
			background-color: #ffdddd;
		}
		.bgcol3{
			background-color: #ddffe1;
		}
		.bgcol4{
			background-color: #c0b3ff;
		}
		.bgcol5{
			background-color: #ffddf9;
		}
		table{
			width: 100%;
		}
		table th{
			font-size: 0.95em;
		}
		table td{
			font-size: 0.94em;
		}
		.table-small td{
			font-size: 0.9em;
		}
		.table-wrapper{
			overflow-x: auto;
		}
		a{
			text-decoration: none;
		}
		.text-gray{
			color: gray;
		}
		.text-info {
			color: #139fbb!important;
		}
		.bg-info {
			background-color: #139fbb!important;
		}
		.row{
			padding-bottom: 1em;
		}
		.breadcrumbs a:not(:last-child)::after{
			content: "/";
			color: #aaa!important;
			padding: 0em 0.5em;
		}
		.breadcrumbs a:last-child{
			color: inherit!important;
		}
		legend{
			font-size:1em;
			font-weight:bold;
		}
		.card{
			box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
		}
		 .table-wrap{
			 max-height: 430px;
			 overflow: auto;
			 display: none;
		 }


		 th, td{
			vertical-align: middle;
		 }
		 .table-freeze{
			overflow: auto;
			max-height: 450px;
			width: 400px;
		 }
		.table-freeze table tr:nth-child(1) th{
			position: sticky;
			top1: 0;
			background-color: #dadbff!important;
			z-index: 999;
		}
		.table-freeze table tr:last-child th{
			position: sticky;
			bottom: 0;
			background-color: #dadbff!important;
			z-index: 999;
		}
		.table-freeze table tr td:nth-child(1){
			position: sticky;
			left: 0;
			background-color: #eaeaff!important;
		}
		select{
			 color: #000!important;
		}
		.search-modal select option:first-child  {
		  color: #999999;
		}
		.search-modal select option:not(:first-child) {
		  color: #000;
		}
		.search-modal select.inactive-select  {
		  color: #999999!important;
		}
		 @media print {
		 .page{
			 display: block!important;
		 }
		 .maincontent{
			 margin-left: 0!important;
		 }
		 .noprint, .noprint * { display: none !important; }
		 }
		 .headline
		{
			font-size: 30px;
			margin-bottom: 0;
			color:#EEE;
			margin-left:35px;
			font-family: 'lato', sans-serif;
		}
		.txt-b
		{
			position: relative;
			top: 270px;
			color:#EEE;
		}

		.txt-body
		{
			font-size: 1.2em;
			margin-top: 0;
			color:#EEE;
			font-family: 'lato', sans-serif;
			margin-left:35px;
		}
		.input-group-lg>.form-control{
			font-size: inherit;
		}
		.public .title
		{
		color: #407ac7;
		font-size: 1.5em;
		font-weight: bold;
		text-transform: capitalize;
		font-weight: light;
		}
		.related-search ul{
			list-style: none;
			padding: 0;
			margin:0;
		}
		.related-search ul li{
			padding: 0.35em;
		}
		.related-search ul li:not(:last-child){
			border: 1px dotted #ddd;
		}
		.related-search ul li:hover{
			cursor: pointer;
			background-color: #407ac7aa;
		}
		.related-search:empty{
			display: none;
		}
		.right-nav a{
			margin-left: 0.35em;
		}

		.multiple div{
			display: flex;
			margin-bottom: 15px;
			padding: 0px;
			border: 1px solid #dddddd;
			border-radius: 3px;
		}
		fieldset {
			border1: 1px solid #ddd;
			border-radius1: 0.25em;
			padding: 0.5em;
			padding: 0 10px 10px 10px;
			border-bottom: none;
		}

		.section legend{
			font-size: 1em;
			font-weight: 600;
			color: {{$col1}};
			width: auto !important;
			border: none;
		}
		.dashboard-table-wrapper {
			overflow: auto;
			max-height: 300px;
		}
		.dashboard .card:hover{
			cursor: pointer;
		}
		.dashboard .card-body{
			padding: 0.5rem 0.75rem;
		}
		.dashboard .card .block{
			display: flex;
			align-items: center;
		}
		.dashboard .card .icon{
			font-size: 1.5em;
			padding-right: 0.5em;
		}
		.dashboard .card div:not(.icon){
			font-size: 1.05em;
		}
		.readonly-select{
			pointer-events: none;
			user-select: none;
		}

		.image{
			background-size: cover;
			border-radius: 4px;
			width: 60px;
			height: 70px;
		}
		.thumbnail{
			background-size: cover;
			border-radius: 20px;
			width: 40px;
			height: 40px;
		}
		.form-view .label{
			font-weight: 600;
		}
		.error{
			color:red;
			font-weight: 600;
		}
		
		
		.star{
			color: #ffc107;
		}
		.start-fill{
			color: lightgray;			
		}
	</style>
	<style>
		.navbar-brand{
			position: relative;
			width: 40px;
			display: inline-block;
		}
		.navbar-brand .logo{
			position: absolute;
			background-color: #fff;
			width: 40px;
			height: 40px;
			border-radius: 20px;
			top: -15px;
			background-image: url("{{asset('logo.png')}}");
			background-size: 30px;
			background-repeat: no-repeat;
			background-position: center;
		}
		.menuitem{
			position: relative;
			z-index: 9999;
		}
		.submenu{
			position: absolute;
			top: 0;
			background-color: #fff;
			color: {{ $col1 }}!important;
			border-radius: 5px;
			border: 1px solid #aaa;
			display: none;
			padding: 5px;
			z-index: 9999;
			width: 250px;
		}
		.menuitem:hover .submenu{
			display: block;
		}
		.submenu a{
			color: {{ $col1 }}!important;
			font-size: 1em!important;
			text-align: left!important;
		}
		.submenu a:hover{
			background-color: #fff;
			color1: #fff!important;
		}
		.nav-link i,.dropdown-item i {
			margin-right: 0.2em;
		}


		/*mobile view start*/
		.navbar .megamenu{
			padding: 1rem;
			margin: 1em;
			background-color: aliceblue;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
		navbar .megamenu li{
			display: inline-block;
		}
		@media all and (min-width: 992px) {

		  .navbar .has-megamenu{position:static!important;}
		  .navbar .megamenu{left:0; right:0; width:inherit; margin-top:0;  }

		}
		@media(max-width: 991px){
		  .navbar.fixed-top .navbar-collapse, .navbar.sticky-top .navbar-collapse{
			overflow-y: auto;
			  max-height: 90vh;
			  margin-top:10px;
		  }
		}
		/* mobile view end*/


		@page {
		  size: auto;
		  margin: 0mm;
		}
		@media print
	   {
		.noprint {display:none;}
		.onlyprint{
			display: block;
		}
		.card {
			box-shadow: none;
			border: none;
		}
		table{
			max-width: 99%;
		}
		.table-striped>tbody>tr:nth-of-type(odd){
			--bs-table-accent-bg:#ffffff!important;
		}
		table.small-padding td{
			padding: 5px;
		}
		table.small-padding th{
			padding: 10px 5px;
		}
		.table-bordered td, .table-bordered th{
			border: 1px solid #000!important;
		}

		.bg-theme{
			color: #000!important;
		}
		.table-wrapper{
			overflow: visible;
			overflow-y: visible;
		}

	}
	.pagebreak { page-break-before: always; } /* page-break-after works, as well */
	.breakNow {  page-break-after:always; }
	.tab-pane{
		margin: 1em;
		padding: 0.5em;
	}
	.pointer{
		cursor: pointer;
		color: #1111ff;
	}
	.cursor{
		cursor: pointer;
	}
	.moving{
		cursor: move;
		background-color: #aaccff;
	}
	</style>
	 <style>
		.megamenu {
		}
		.tabs-list{
			text-align: center;
		}
		.tabs-list .tab1{
			position: relative;
			display: inline-block;
			margin-right: 20px;
			margin-bottom: 20px;
			vertical-align: top;
			border: 1px solid #ddd;
			border-radius: 5px;
			font-size: 0.95em;
		}
		.tab-header{
			background-color: #cadfff;
			padding: 5px;
		}
		.tabs-list .tab-menu{
			position1: absolute;
			max-height: 150px;
			overflow-y: auto;
			min-width1: 200px;
			text-align: left;

		}
		/* width */
		::-webkit-scrollbar {
		  width: 10px;
		}

		/* Track */
		::-webkit-scrollbar-track {
		  background: #cadfff;
		}

		/* Handle */
		::-webkit-scrollbar-thumb {
		  background: #b1caf0;
		}

		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
		  background: #839abd;
		}
		.main-navbar{
			background: {{$color}}!important;
		}
		.bg-theme-light, .btn-theme-light{
			background: {{ $color }}22!important;
		}
		.btn-theme, .btn-theme:hover, .bg-theme{
			background: {{ $color }}!important;
			color: #fff;
		}
		.list-title{
			background: {{ $color }};
			color: #fff;
			font-weight: 600;
		}
		
		.box-pointer{
			color: {{$color}};
			cursor: pointer;
		}
	 </style>
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
		<div class="container">  @include ('common.flash')
			@yield('content')
			<div class="py-3 text-center noprint">
				<hr></hr>
				Response Time: {{ round(microtime(true) - LARAVEL_START, 2) }} Seconds
				<div>© {{ date('Y') }} {{ config('app.name') }}</div>
			</div>
		</div>
	</div>
				
		

	{{ Form::open(['id' => 'form']) }} {{ Form::close() }}

	<link rel="stylesheet" href="{{ asset('jquery/jquery-ui.css') }}">
	<script src="{{ asset('jquery/jquery-ui.js') }}"></script>

	<script>
		function initTooltip() {
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			  return new bootstrap.Tooltip(tooltipTriggerEl)
			});
		}
		initTooltip();
	</script>

	<script>

		$(function(){
			$('.table-wrap').width($(window).width() - 100);
			$('.table-wrap').css("display", "block");
		});

		 $('select').on('change', function(obj) {
		  toogleSelectActive(obj.target);
		});
	
		function resetSelect() {
			 var x = document.getElementsByTagName('select');
			 for (var i=0; i < x.length; i++) {
				toogleSelectActive(x[i]);
			 }
		}
		function toogleSelectActive(obj) {
			//alert(obj.selectedIndex);
			console.log(obj.selectedIndex);
			if (obj.selectedIndex == 0) {
			   obj.classList.add("inactive-select");
			   obj.classList.remove("active-select");
		   } else {
			   obj.classList.add("active-select");
			   obj.classList.remove("inactive-select");
		   }
		}
		resetSelect(); // on init

		var activeSearchObj;
		function loadSearchRelated(obj, modelname, relName, relField) {
			var div = obj.parentNode.getElementsByTagName("div")[0];
			var parent = div.parentNode;
			var inp = parent.getElementsByTagName("input");
			var val = obj.value;
			if (inp.length == 2) { // onchange remove id for id-rel field
				inp[0].value = "";
			}
			if (val == "" || val.length == 1) { // min 2
				div.innerHTML = "";
				return;
			}
			$.ajax({
				type:"GET",
				url:"{{url('related_search')}}/"+modelname+"/"+relName+"/"+relField+"/"+val,
				success: function(data) {
					div.innerHTML = data;
				}
			});
		}

		function selectedSearchRelated(obj, id) {
			var div = obj.parentNode.parentNode;
			var parent = div.parentNode;
			var inp = parent.getElementsByTagName("input");
			if (inp.length == 2) {
				inp[0].value = id;
				inp[1].value = obj.innerHTML;
			} else {
				inp[0].value = obj.innerHTML;
			}
			div.innerHTML = "";
		}

		function addOptionValue(obj) {
			var parent = obj.parentNode.parentNode;
			var child = parent.getElementsByTagName("div");

			var newDiv =  document.createElement("div");
			newDiv.innerHTML = child[0].innerHTML;
			newDiv.getElementsByTagName("input")[0].value = "";
			parent.insertBefore(newDiv, obj.parentNode.nextSibling);
		}

		function deleteOptionValue(obj) {
			var parent = obj.parentNode.parentNode;
			var child = parent.getElementsByTagName("div");
			if  (child.length > 1) {
				parent.removeChild(obj.parentNode);
			}
		}
		function addOptionTrValue(obj, code) {

			code = code !== undefined ? code : "";

			var parent = obj.parentNode.parentNode.parentNode;

			var child = parent.getElementsByTagName("tr");



			var newTr = document.createElement("tr");

			newTr.innerHTML = child[0].innerHTML;

			newTr.getElementsByTagName("input")[0].value = code;

			newTr.getElementsByTagName("select")[0].selectedIndex = 0;

			parent.insertBefore(newTr, obj.parentNode.parentNode.nextSibling);

			}



			function deleteOptionTrValue(obj) {

				var parent = obj.parentNode.parentNode.parentNode;

				var child = parent.getElementsByTagName("tr");

				if (child.length > 1) {

				parent.removeChild(obj.parentNode.parentNode);

				}

			}


    	function addOptionTrNewValue(obj) {
    		var parent = obj.parentNode.parentNode.parentNode;
    		var child = parent.getElementsByTagName("tr")[0];

    		var newObj =  document.createElement("tr");
    		newObj.innerHTML = child.innerHTML;

    		for(var inp of newObj.getElementsByTagName("input")) {
    			inp.value = "";
    		}
    		parent.insertBefore(newObj, obj.parentNode.parentNode.nextSibling);
    	}

    	function deleteOptionTrNewValue(obj) {
    		var parent = obj.parentNode.parentNode.parentNode;
    		var childObjs = parent.getElementsByTagName("tr");
    		if  (childObjs.length > 1) {
    			parent.removeChild(obj.parentNode.parentNode);
    		}
    	}
		function onInputDlist(obj, eid) {
			var val = obj.value;
			var opts = document.getElementById('dlist').childNodes;
			for (var i = 0; i < opts.length; i++) {
			  if (opts[i].value === val) {
				var selVal = opts[i].getAttribute("data-value");
				document.getElementById(eid).value = selVal;
				return;
			  }
			}
			document.getElementById(eid).value = "";
		  }
		$(function(){
			$('form').on('submit', function(ev){
				ev.preventDefault();
				var submit = $(this).find('button').not(".btn-outline-info").not(".btn-outline-danger") ;
				$(submit).find('*').removeClass('d-none');
				$(submit).attr('disabled','disabled');
				ev.target.submit();
			});
		});
	</script>
  </body>
</html>
