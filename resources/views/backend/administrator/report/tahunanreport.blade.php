@extends('backend.print')

@push('title')
<title>Beranda Administrator - MDRTB Laboratory Manager</title>
@endpush

@include('backend.administrator.asset.lblnasset')

@php
	$NmBln = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
	$thnAwal = \Carbon\Carbon::createFromDate(2015,null,null);
	$thnAkir = \Carbon\Carbon::now();
	$rentang = $thnAwal->diffInYears($thnAkir);
@endphp

@section('content')
<div class="container-fluid">

{{-- #title --}}
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card animate ph" data-animate="fadeInUp">
				<div class="header">
					<h2>
						Laporan Bulanan <small>Pilih bulan dan tahun jika ingin mencetak laporan pada bulan lain</small>
					</h2>
					<form id="lapBlnan" method="POST" action="{{ route('adm.laporanbulan') }}">
						{{ csrf_field() }}
						<ul class="header-dropdown m-r--5">
							<li>
								<div style="width: 150px">
									<select class="select form-control show-tick" data-size="5" id="bln" name="bln" title="Pilih Bulan">
										@for ($i = 1; $i < 13; $i++)
										<option value="{{ $i }}"> {{ $NmBln[$i] }} </option>
										@endfor
									</select>
								</div>

							</li>
							<li>
								<div style="width: 100px">
									<select class="select form-control show-tick" id="thn" data-size="5" name="thn" title="Pilih Tahun">
										@for ($i = 0; $i <= $rentang; $i++)
										<option value="{{ $thnAwal->copy()->addYears($i)->year }}"> {{ $thnAwal->copy()->addYears($i)->year }} </option>
										@endfor
									</select>
								</div>
							</li>
							<li>
								<button type="submit" class="btn form-control bg-green waves-effect" id="getLapBln">
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
					<h2 class="font-18 align-center m-b-50">Laporan Bulan {{ $NmBln[$bln].' '.$thn }}</h2>

					@foreach ($statistik as $stat)

					<div class="row clearfix m-b-20">
						<div class="col-md-12 col-p-12 font-14 m-b-10 font-bold">Jumlah Spesimen</div>
						<div class="col-md-6 col-p-6 m-l-15">Jumlah spesimen yang berasal dari suspek TB MDR</div><div class="col-md-5 col-p-5"><span class="hasil font-bold">{{ $stat->total }}</span> spesimen</div>
					</div>

					<div class="row clearfix m-b-20">
						<div class="col-md-12 col-p-12 font-14 m-b-10 font-bold">Hasil Pemeriksaan GeneXpert</div>
						<div class="col-md-6 col-p-6 m-l-15">MTB Detected, Rif Resistance NOT Detected</div><div class="col-md-5 col-p-5"><span class="hasil font-bold">{{ $stat->pn }}</span> spesimen</div>
						<div class="col-md-6 col-p-6 m-l-15">MTB Detected, Rif Detected</div><div class="col-md-5 col-p-5"><span class="hasil font-bold">{{ $stat->pp }}</span> spesimen</div>
						<div class="col-md-6 col-p-6 m-l-15">MTB NOT Detected</div><div class="col-md-5 col-p-5"><span class="hasil font-bold">{{ $stat->n }}</span> spesimen</div>
						<div class="col-md-6 col-p-6 m-l-15">Indeterminate</div><div class="col-md-5 col-p-5"><span class="hasil font-bold">{{ $stat->i }}</span> spesimen</div>
						<div class="col-md-6 col-p-6 m-l-15">Error</div><div class="col-md-5 col-p-5"><span class="hasil font-bold">-</span> spesimen</div>
						<div class="col-md-6 col-p-6 m-l-15">Invalid</div><div class="col-md-5 col-p-5"><span class="hasil font-bold">-</span> spesimen</div>
						<div class="col-md-6 col-p-6 m-l-15">No Result</div><div class="col-md-5 col-p-5"><span class="hasil font-bold">-</span> spesimen</div>
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
							@if ($loop->index >= 13)
							@php $counter = $counter + 1 @endphp
							@endif

							@if ($loop->index == 13)
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
									<td class="align-center">{!! $row->kuisioner == 1 ? '<i class="material-icons font-bold font-14 col-green">check</i>' : '<i class="material-icons font-bold font-14 col-red">remove</i>' !!}</td>
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
							<a href="{{ url('/administrator/excel/bulan/'.$bln.'/'.$thn) }}" data-mfb-label="Export Excell" class="mfb-component__button--child export-excel">
								<i class="mfb-component__child-icon material-icons">grid_on</i>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
@endsection