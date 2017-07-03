@extends('backend.print')

@push('title')
<title>Lap. Institusi - MDRTB Laboratory Manager</title>
@endpush

@include('backend.administrator.asset.linstitusiasset')

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
								<p class="font-bold font-14 ">Pilih Intitusi</p>
								<form class="clearfix" method="POST" action="{{ route('adm.laporaninstitusi') }}">
									{{ csrf_field() }}
									<div class="col-md-10">
										<select class="select2" id="ins_id2" name="ins_id" style="width: 100%;">
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
							Laporan Institusi <small>Pilih institusi jika ingin mencetak laporan institusi lain</small>
						</h2>
						<form method="POST" action="{{ route('adm.laporaninstitusi') }}">
							{{ csrf_field() }}
							<ul class="header-dropdown m-r--5">
								<li>
									<div style="width: 350px">
										<select class="select2" id="ins_id" name="ins_id" style="width: 100%;">
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
						<h2 class="font-18 align-center m-b-50">Laporan Institusi </h2>

						<div class="row clearfix m-b-20">
							<div class="col-md-12 col-p-12 font-14 m-b-10 font-bold">Keterangan Intitusi</div>
							<div class="col-md-6 col-p-6 m-l-15">Nama Institusi</div>
							<div class="col-md-5 col-p-5"><span class="font-bold">{{ $data[0]->nama_jenis_instansi.' '.$data[0]->nama_instansi }}</span></div>
							<div class="col-md-6 col-p-6 m-l-15">Alamat Institusi</div>
							<div class="col-md-5 col-p-5"><span class="font-bold">{{ $data[0]->alamat_instansi }}</span></div>
						</div>

						@foreach ($statistik as $stat)

						<div class="row clearfix m-b-20">
							<div class="col-md-12 col-p-12 font-14 m-b-10 font-bold">Jumlah Pasien</div>
							<div class="col-md-6 col-p-6 m-l-15">Jumlah pasien yang suspek TB MDR</div>
							<div class="col-md-5 col-p-5"><span class="hasil font-bold">{{ $stat->total }}</span> pasien</div>
						</div>

						<div class="row clearfix m-b-20">
							<div class="col-md-12 col-p-12 font-14 m-b-10 font-bold">Hasil Pemeriksaan GeneXpert</div>

							<div class="col-md-6 col-p-6 m-l-15">MTB Detected, Rif Resistance NOT Detected</div>
							<div class="col-md-5 col-p-5"><span class="hasil font-bold">{{ $stat->gespn }}</span> spesimen</div>

							<div class="col-md-6 col-p-6 m-l-15">MTB Detected, Rif Detected</div>
							<div class="col-md-5 col-p-5"><span class="hasil font-bold">{{ $stat->gespp }}</span> spesimen</div>

							<div class="col-md-6 col-p-6 m-l-15">MTB NOT Detected</div>
							<div class="col-md-5 col-p-5"><span class="hasil font-bold">{{ $stat->gesn }}</span> spesimen</div>

							<div class="col-md-6 col-p-6 m-l-15">Indeterminate</div>
							<div class="col-md-5 col-p-5"><span class="hasil font-bold"></span> spesimen</div>

							<div class="col-md-6 col-p-6 m-l-15">Error</div>
							<div class="col-md-5 col-p-5"><span class="hasil font-bold">-</span> spesimen</div>

							<div class="col-md-6 col-p-6 m-l-15">Invalid</div>
							<div class="col-md-5 col-p-5"><span class="hasil font-bold">-</span> spesimen</div>

							<div class="col-md-6 col-p-6 m-l-15">No Result</div>
							<div class="col-md-5 col-p-5"><span class="hasil font-bold">-</span> spesimen</div>
						</div>

						@endforeach
						
						<div class="body lbln-table-container" style="padding-top: 0">
							<div class="row clearfix">
								<div class="col-md-12 col-p-12 font-14 m-b-20 font-bold">Data Pemeriksaan</div>
							</div>
							<table id="lbln-table"  class="table table-condensed table-bordered table-striped table-hover" style="width: 100%;">
								<thead>
									<tr>
										<th rowspan="2" width="200">Nama Pasien</th>
										<th rowspan="2" width="35" class="align-center">Umur</th>
										<th rowspan="2" width="45">Sex</th>
										<th colspan="6" width="180" class="align-center">GeneXpert</th>
										<th colspan="3" width="80" class="align-center">BTA</th>
										<th rowspan="2" width="30">Kuis</th>
									</tr>
									<tr>
										<th>TT0</th>
										<th>RT0</th>
										<th>TT2</th>
										<th>RT2</th>
										<th>TT6</th>
										<th>RT6</th>
										<th>H1</th>
										<th>H2</th>
										<th>H3</th>
									</tr>
								</thead>
								<tbody>
									@php $counter = 0 @endphp

									@foreach ($data as $row)
							@if ($loop->index >= 10)
							@php $counter = $counter + 1 @endphp
							@endif

							@if ($loop->index == 10)
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="card animate a4" data-animate="slideInUp">

				{{-- #content --}}
				<div class="body lbln-container" style="padding-top: 0;">
					<div class="body lbln-table-container" style="padding-top: 0">
						<table id="lbln-table"  class="table table-condensed table-bordered table-striped table-hover" style="width: 100%;">
							<thead>
								<tr>
									<th rowspan="2" width="200">Nama Pasien</th>
									<th rowspan="2" width="35" class="align-center">Umur</th>
									<th rowspan="2" width="45">Sex</th>
									<th colspan="6" width="180" class="align-center">GeneXpert</th>
									<th colspan="3" width="80" class="align-center">BTA</th>
									<th rowspan="2" width="30">Kuis</th>
								</tr>
								<tr>
									<th>TT0</th>
									<th>RT0</th>
									<th>TT2</th>
									<th>RT2</th>
									<th>TT6</th>
									<th>RT6</th>
									<th>H1</th>
									<th>H2</th>
									<th>H3</th>
								</tr>
							</thead>

							@endif

							@if (!($counter == 
							0) && ($counter % 26 == 0))
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="card animate a4" data-animate="slideInUp">

				{{-- #content --}}
				<div class="body lbln-container" style="padding-top: 0;">
					<div class="body lbln-table-container" style="padding-top: 0">
						<table id="lbln-table"  class="table table-condensed table-bordered table-striped table-hover" style="width: 100%;">
							<thead>
								<tr>
									<th rowspan="2" width="200">Nama Pasien</th>
									<th rowspan="2" width="35" class="align-center">Umur</th>
									<th rowspan="2" width="45">Sex</th>
									<th colspan="6" width="180" class="align-center">GeneXpert</th>
									<th colspan="3" width="80" class="align-center">BTA</th>
									<th rowspan="2" width="30">Kuis</th>
								</tr>
								<tr>
									<th>TT0</th>
									<th>RT0</th>
									<th>TT2</th>
									<th>RT2</th>
									<th>TT6</th>
									<th>RT6</th>
									<th>H1</th>
									<th>H2</th>
									<th>H3</th>
								</tr>
							</thead>

							@endif
						
								<tr>
									<td>{{ $row->nama_pasien }}</td>
									<td class="align-center" >{{ $row->umur }}</td>
									<td>{{ ucfirst($row->sex) }}</td>
									<td class="align-center">{!! $row->gepertama_hasil == Null ? '' : ( $row->gepertama_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									<td class="align-center">{!! $row->gepertama_rif == Null ? '' : ( $row->gepertama_rif == 'Rif Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									<td class="align-center">{!! $row->gekedua_hasil == Null ? '' : ( $row->gekedua_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									<td class="align-center">{!! $row->gekedua_rif == Null ? '' : ( $row->gekedua_rif == 'Rif Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									<td class="align-center">{!! $row->geketiga_hasil == Null ? '' : ( $row->geketiga_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									<td class="align-center">{!! $row->geketiga_rif == Null ? '' : ( $row->geketiga_rif == 'Rif Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									<td class="align-center">{!! $row->btapertama_hasil == Null ? '' : ( $row->btapertama_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									<td class="align-center">{!! $row->btakedua_hasil == Null ? '' : ( $row->btakedua_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									<td class="align-center">{!! $row->btaketiga_hasil == Null ? '' : ( $row->btaketiga_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									<td class="align-center">{!! $row->kuisioner == 1 ? '<i class="material-icons font-bold font-14 col-green">check</i>' : '<i class="material-icons font-bold font-14 col-red">close</i>' !!}</td>
								</tr>
							@endforeach
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
								<a href="{{ url('/administrator/excel/institusi/') }}" data-mfb-label="Export Excell" class="mfb-component__button--child export-excel">
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