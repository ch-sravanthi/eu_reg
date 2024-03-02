		<?php $color = '#393185';?>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css?v=6.6') }}" >

	<style>
		.main-navbar{
			background: {{$color}}!important;
		}
		.titlebar .navs a{
			font-weight: 300;
			color: {{$color}};
			
		}	
		.dropdown-item:hover{
			background: {{$color}};
			color: #fff!important;
		}
		
		.navbar {
		}			
		.navbar-brand {
			padding-bottom: 0!important;
		}
		.form-view fieldset .row:hover{
			background: {{$color}}30!important;			
		}
		
		.btn-theme, .btn-theme:hover, .bg-theme{
			background: {{ $color }}!important;
			color: #fff;
		}
		.bg-theme-light{
			background: {{ $color }}22!important;
		}

		.text-theme{
			color: {{ $color }};
		}
		.list-title{
			background: {{ $color }};
			color: #fff;
			font-weight: 400;			
		}
		.list-title-light{
			background: {{ $color }}bb;
			color: #fff;
			font-weight: 400;			
		}
		.list-current{
			color: {{ $color }};
			font-weight: 400;
		}
		.list-inactive:hover, .list-active{
			background: {{$color}}30!important;
			color: {{$color}};			
		}
		
		.list-active{
			background: #00640030!important;
			color: {{$color}};			
		}
		.section legend{
			font-size: .5em;
			font-weight: 400;
			color: {{$color}};	
		}
		table.dashboard-table thead{
			background: {{$color}}30;
		}
		
		table.dashboard-table .hyperlink-td:hover{
			background: {{$color}};
			color: #fff;
		}
		
		.checked{
			background: {{$color}}!important;
			color: #fff;
		}
		
		table th{
			font-weight: 400;
		}
		
		table td.number, table th.number{
			text-align: right;
		}
		.pointer{
			cursor: pointer;
		}
		.pointer:hover{
			color: {{$color}};
		}
		.box-pointer{
			color: {{$color}};
			cursor: pointer;
		}
		.box-pointer:hover{
			background-color: {{$color}}22;
		}
		
		
		
		
	.dashboard .block{
		display: flex;
		align-items: flex-start;
		color: #fff;
	}
	.dashboard .block .content {
		flex: 0;
		text-transform: uppercase;
		padding: 0px;
	}
	.dashboard .block i {
		font-size: .0rem;
	}
	.dashboard .card {
		cursor: pointer;
	}
	 select:not([multiple]) option:first-child {
	  color: gray!important;
	}

	 select:invalid option:not(:first-child) {
	  color: black;
	}
	.datepicker{
		background-color: #fff!important;
	}
	.datepicker:disabled{
		background-color: #e9ecef!important;
	}

	</style>