@extends('backend.print')

@push('title')
<title>Lap. Pasien - MDRTB Laboratory Manager</title>
@endpush

@push('css')
@endpush

@include('backend.administrator.asset.lpasienasset')

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
								<p class="font-bold font-14 ">Pilih Pasien</p>
								<form id="lapPas" class="clearfix" method="POST" action="{{ route('adm.laporanpasien') }}">
									{{ csrf_field() }}
									<div class="col-md-10">
										<select class="select2" id="report-pasien2" name="pasien_id" style="width: 100%;">
										</select>
									</div>
									<div class="col-md-2">
										<button type="submit" class="btn form-control bg-green waves-effect" id="getLapBln">
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
						Laporan Pasien <small>Pilih bulan dan tahun jika ingin mencetak laporan pada bulan lain</small>
					</h2>
					<form id="lapBlnan" method="POST" action="{{ route('adm.laporanpasien') }}">
						{{ csrf_field() }}
						<ul class="header-dropdown m-r--5">
							<li>
								<div style="width: 350px">
									<select class="select2" id="report-pasien" name="pasien_id" style="width: 100%;">
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
					<h2 class="font-18 align-center m-b-50">Laporan Pemeriksaan Pasien</h2>

						@foreach ($data as $row)
							@if ($loop->index == 0)
								<div class="row clearfix m-b-20">
									<div class="col-md-12 col-p-12 font-14 m-b-10 font-bold">Identitas Pasien</div>
									<div class="col-md-3 col-p-3 p-l-25">Nama Pasien</div>
									<div class="col-md-8 col-p-8">{{ $row->nama_pasien }}</div>

									<div class="col-md-3 col-p-3 p-l-25">Jenis Kelamin</div>
									<div class="col-md-8 col-p-8">{{ ucfirst($row->sex) }}</div>

									<div class="col-md-3 col-p-3 p-l-25">Umur</div>
									<div class="col-md-8 col-p-8">{{ ($row->umur == 0 or $row->umur == Null) ? '-' : $row->umur }}</div>

									<div class="col-md-3 col-p-3 p-l-25">Alamat</div>
									<div class="col-md-8 col-p-8">{{ $row->alamat == Null ? '-' : $row->alamat }}</div>
								</div>

								<div class="row clearfix m-b-20">
									<div class="col-md-12 col-p-12 font-14 m-b-10 font-bold">Keterangan</div>
									<div class="col-md-12 col-p-12 p-l-25">{{ '- Pasien rujukan dari '.$row->nama_jenis_instansi.' '.$row->nama_instansi }}</div>
									<div class="col-md-12 col-p-12 p-l-25">{{ '- Domisili pasien di kota/kab '.ucfirst($row->nama_daerah) }}</div>
									<div class="col-md-12 col-p-12 p-l-25">{{ $row->kuisioner == 1 ? '- Pasien merupakan Responden' : '- Pasien bukan Responden' }}</div>
								</div>
							@endif
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
								@foreach ($data as $row)
									<tr>
										<td>{{ $row->gepertama_tgl_periksa }}</td>
										<td>{{ $row->gepertama_idtb }}</td>
										<td class="align-center">{!! $row->gepertama_hasil == Null ? '' : ( $row->gepertama_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
										<td class="align-center">{!! $row->gepertama_rif == Null ? '' : ( $row->gepertama_rif == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>

										<td>{{ $row->gekedua_tgl_periksa }}</td>
										<td>{{ $row->gekedua_idtb }}</td>
										<td class="align-center">{!! $row->gekedua_hasil == Null ? '' : ( $row->gekedua_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
										<td class="align-center">{!! $row->gekedua_rif == Null ? '' : ( $row->gekedua_rif == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>

										<td>{{ $row->geketiga_tgl_periksa }}</td>
										<td>{{ $row->geketiga_idtb }}</td>
										<td class="align-center">{!! $row->geketiga_hasil == Null ? '' : ( $row->geketiga_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
										<td class="align-center">{!! $row->geketiga_rif == Null ? '' : ( $row->geketiga_rif == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
							<div class="row clearfix">
								<div class="col-md-12 col-p-12 font-14 m-b-20 font-bold">Data Pemeriksaan BTA</div>
							</div>
							<table class="table table-condensed table-bordered table-hover" style="width: 100%;">
								<thead>
									<tr class="active">
										<th width=""></th>
										<th width=""></th>
										<th width="40"></th>
										<th width=""></th>
										<th width=""></th>
										<th width="40"></th>
										<th width=""></th>
										<th width=""></th>
										<th width="40"></th>
									</tr>
									<tr>
										<th colspan="3" width="" class="align-center">T0</th>
										<th colspan="3" width="" class="align-center">T2</th>
										<th colspan="3" width="" class="align-center">T6</th>
									</tr>
									<tr>
										<th>tgl Periksa</th>
										<th>IDTB</th>
										<th>Hasil</th>
										<th>tgl Periksa</th>
										<th>IDTB</th>
										<th>Hasil</th>
										<th>tgl Periksa</th>
										<th>IDTB</th>
										<th>Hasil</th>
									</tr>
								</thead>

								<tbody>
									@foreach ($data as $row)
										<tr>
											<td>{{ $row->btapertama_tgl_periksa }}</td>
											<td>{{ $row->btapertama_idtb }}</td>
											<td class="align-center">{!! $row->btapertama_hasil == Null ? '' : ( $row->btapertama_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>

											<td>{{ $row->btakedua_tgl_periksa }}</td>
											<td>{{ $row->btakedua_idtb }}</td>
											<td class="align-center">{!! $row->btakedua_hasil == Null ? '' : ( $row->btakedua_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>

											<td>{{ $row->btaketiga_tgl_periksa }}</td>
											<td>{{ $row->btaketiga_idtb }}</td>
											<td class="align-center">{!! $row->btaketiga_hasil == Null ? '' : ( $row->btaketiga_hasil == 'TB Positif' ? '<i class="material-icons font-bold font-14 col-red">add</i>' : '<i class="material-icons font-bold font-14 col-green">remove</i>') !!}</td>
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
							<a href="{{ url('/administrator/excel/pasien/'.$id) }}" data-mfb-label="Export Excell" class="mfb-component__button--child export-excel">
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