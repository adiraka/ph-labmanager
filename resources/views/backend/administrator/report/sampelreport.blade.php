@extends('backend.print')

@push('title')
<title>Sampel Report - MDRTB Laboratory Manager</title>
@endpush

@push('css')
@endpush

@include('backend.administrator.asset.lsampelasset')

@section('content')
<div class="container-fluid">

{{-- #title --}}
	<div class="row clearfix">

		@if ($id == 'blm')
			<div class="pasien-picker">

				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="card animate light ph" data-animate="fadeInUp">
						<div class="body clearfix">
							<div class="col-md-12">
								<p class="font-bold font-14 ">Cari Sampel</p>
								<form class="clearfix" method="POST" action="{{ route('adm.laporansampel') }}">
									{{ csrf_field() }}
									<div class="col-md-10">
										<select class="select2" id="idtb2" name="id" style="width: 100%;">
										</select>
									</div>
									<div class="col-md-2">
										<button type="submit" class="btn form-control bg-green waves-effect">
											<span>Go</span>
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		@else
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card animate ph" data-animate="fadeInUp">
					<div class="header">
						<h2>
							Laporan Sampel <small>Pilih IDTB sampel laporan</small>
						</h2>
						<form method="POST" action="{{ route('adm.laporansampel') }}">
							{{ csrf_field() }}
							<ul class="header-dropdown m-r--5">
								<li>
									<div style="width: 350px">
										<select class="select2" id="idtb" name="id" style="width: 100%;">
										</select>
									</div>
								</li>
								<li>
									<button type="submit" class="btn form-control bg-green waves-effect">
										<span>Go</span>
									</button>
								</li>

							</ul>
						</form>
						
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card animate a4" data-animate="slideInUp">

				{{-- #content --}}
					<div class="body lbln-container" style="padding-top: 0;">
						<h2 class="font-18 align-center m-b-50">Laporan Sampel Pasien</h2>

							@foreach ($data as $row)
									<div class="row clearfix m-b-20">
										<div class="col-md-12 col-p-12 font-14 m-b-10 font-bold">Identitas Pasien</div>
										<div class="col-md-3 col-p-3 p-l-25">Nama Pasien</div>
										<div class="col-md-8 col-p-8">{{ $row->nama_pasien }}</div>

										<div class="col-md-3 col-p-3 p-l-25">Jenis Kelamin</div>
										<div class="col-md-8 col-p-8">{{ ucfirst($row->sex) }}</div>

									</div>

									<div class="row clearfix m-b-20">
										<div class="col-md-12 col-p-12 font-14 m-b-10 font-bold">Keterangan</div>

									</div>
							@endforeach

							<div class="body lbln-table-container" style="padding-top: 0">
								<div class="row clearfix">
									<div class="col-md-12 col-p-12 font-14 m-b-20 font-bold">Data Pemeriksaan GeneXpert</div>
								</div>
								<table class="table table-condensed table-bordered table-hover" style="width: 100%;">
									<thead>
										<tr class="active">
											<th width=""></th>
											<th width=""></th>
											<th width="40"></th>
											<th width="30"></th>
											<th width=""></th>
											<th width=""></th>
											<th width="40"></th>
											<th width="30"></th>
											<th width=""></th>
											<th width=""></th>
											<th width="40"></th>
											<th width="30"></th>
										</tr>
										<tr>
											<th colspan="4" width="" class="align-center">T0</th>
											<th colspan="4" width="" class="align-center">T2</th>
											<th colspan="4" width="" class="align-center">T6</th>
										</tr>
										<tr>
											<th>tgl Periksa</th>
											<th>IDTB</th>
											<th>Hasil</th>
											<th>Rif</th>
											<th>tgl Periksa</th>
											<th>IDTB</th>
											<th>Hasil</th>
											<th>Rif</th>
											<th>tgl Periksa</th>
											<th>IDTB</th>
											<th>Hasil</th>
											<th>Rif</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>

							</div>					
					</div>
				</div>

				{{-- #action-button --}}
				<ul class="mfb-component--br mfb-slidein ph" data-mfb-toggle="hover" data-mfb-state="closed">
					<li class="mfb-component__wrap">
						<a data-mfb-label="Menu" class="mfb-component__button--main">
							<i class="mfb-component__main-icon--resting material-icons">inbox</i>
							<i class="mfb-component__main-icon--active material-icons">clear</i>
						</a>
						<ul class="mfb-component__list">
							<li>
								<a href="javascript:void(0)" data-mfb-label="Print" class="mfb-component__button--child print-report">
									<i class="mfb-component__child-icon material-icons">print</i>
								</a>
							</li>
							{{-- <li>
								<a href="{{ route('adm.pdfbln') }}" data-mfb-label="Export PDF" class="mfb-component__button--child export-pdf" target="_blank">
									<i class="mfb-component__child-icon material-icons">note</i>
								</a>
							</li> --}}
							<li>
								<a href="{{ url('/administrator/excel/sampel/'.$id) }}" data-mfb-label="Export Excell" class="mfb-component__button--child export-excel">
									<i class="mfb-component__child-icon material-icons">grid_on</i>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		@endif
	</div>
</div>
@endsection