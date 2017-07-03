<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		body{
			font-family: 'Opensans','Roboto','helvetica',arial;
			font-size: 10px;
			margin: 30px 50px;
		}

		h1,p{
			padding: 0;
		}

		p{
			padding:0;
			margin: 5px 0;
		}

		h1{
			font-family: 'Opensans';
			font-weight: 500;
			font-size: 14px;
			color: #3A3A3A;
			line-height: 0.8;
		}

		h2{
			font-family: 'Opensans';
			font-weight: normal;
			font-size: 12px;
			color: #3A3A3A;
			line-height: 0.8;
		}

		hr{
			border-top: 1px solid #dddddd;
			color:transparent;
		}

		caption{
			padding-left: 5px;
			text-align: left;
			display: inline-block;
		}

		thead {
			background-color: #ddd;
			text-align: left;
		}

		tbody {
			border-bottom: 1px solid #ddd;
		}

		tbody tr {
			background-color: #f9f9f9;
		}

		td {
			padding: 2px 4px;
		}

		table.smal{
			font-size: 8px;
		}

		td {
			padding: 1px 2px;
		}

		.text-justifie{
			text-align: justify;
		}

		.page-break {
			page-break-after: always;
		}

		.logo-container{
			position: absolute;
			right: 5px;
			top: 30px;
			width:30%;
			text-align:right;
		}

		.logo-text-container{
			width:70%;
		}

		.logo-text{
			font-size: 14px;
			color: #3A3A3A;
			line-height: 1;
		}
		
		.logo{
			height:40px;
		}

		.cd-content-items{
			padding: 15px 0px;
		}

		.table-container{
			padding: 10px 0;
		}

		.charttitle{
			text-align: center;
			margin: auto;
		}

		.row {
			margin-right: auto;
			margin-left: auto;
		}

		.clear{
			clear: both;
		}

		.leftside-padder{
			padding-left: 20px;
		}

		.rightside-padder{
			padding-right: 20px;
		}

		.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5,.col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10,.col-md-11, .col-md-12{
			position: relative;
			min-height: 1px;
		}
		.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
			float: left;
		}
		.col-md-12 {
			width: 100%;
		}
		.col-md-11 {
			width: 91.66666667%;
		}
		.col-md-10 {
			width: 83.33333333%;
		}
		.col-md-9 {
			width: 75%;
		}
		.col-md-8 {
			width: 66.66666667%;
		}
		.col-md-7 {
			width: 58.33333333%;
		}
		.col-md-6 {
			width: 50%;
		}
		.col-md-5 {
			width: 41.66666667%;
		}
		.col-md-4 {
			width: 33.33333333%;
		}
		.col-md-3 {
			width: 25%;
		}
		.col-md-2 {
			width: 16.66666667%;
		}
		.col-md-1 {
			width: 8.33333333%;
		}
		.pad-small{
			padding-top: 15px;
		}
		.pad-medium{
			padding-top: 25px;
		}
	</style>
	@stack('css')

	@stack('title')
</head>
<body>
	<div class="header">
		@include('backend.partials.pdfheader')
	</div>

	<div class="content">
		@yield('content')
	</div>
	
	<div class="footer">
		@include('backend.partials.pdffooter')
	</div>

	<script type="text/php">
{{-- 	    if (isset($pdf)) {
	        $size = 8;
	        $tgl = date('d.m.Y');
	        $nomor = "( {PAGE_NUM} dari {PAGE_COUNT} )";
	        $nama = "Principal Investigator - Dr dr Andani Eka Putra, M.S.C";
	        $font = Font_Metrics::get_font("Helvetica");
	        $text_height = Font_Metrics::get_font_height($font, $size);
	        $width = Font_Metrics::get_text_width($tgl, $font, $size);

	        $tglx = $pdf->get_width() - $width - 72;
	        $tgly = 45;

	        $namax = 72 ;
	        $namay = $pdf->get_height() - $text_height - 34;

	        $nomorx = $pdf->get_width() - $width - 72;
	        $nomory = $pdf->get_height() - $text_height - 34;

	        $pdf->page_text($tglx, $tgly, $tgl, $font, $size);
	        $pdf->page_text($nomorx, $nomory, $nomor, $font, $size);
	        $pdf->page_text($namax, $namay, $nama, $font, $size);
	    } --}}
	</script>
</body>
</html>