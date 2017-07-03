@extends('backend.default')

@push('title')
<title>Kuisioner Administrator - MDRTB Laboratory Manager</title>
@endpush

@include('backend.administrator.asset.kuisionerasset')

@section('content')
<div class="container-fluid">
{{-- #card --}}
	<div class="row clearfix">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInLeft'>
				<div class="header bg-green">
					<h2>
						Chart Persentase Responden <small>persentase pasien yang menjadi responden</small>
					</h2>
					<ul class="header-dropdown m-r--5">
						<li>
							<a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="timer" data-loading-color="lightBlue">
								<i class="material-icons">pie_chart</i>
							</a>
						</li>
					</ul>
				</div>
				<div class="body bg-green h300">
					<div id="piechartwrapper" class="piechartwrapper"><div id="piechart" class="piechart"></div></div>
					<div id="pie-legend" style="margin: 15px 0 20px 0;position: relative;"></div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInLeft'>
				<div class="header bg-green">
					<h2>
						Chart Jumlah Kuisioner <small>Penambahan jumlah kuisioner perbulan</small>
					</h2>
					<ul class="header-dropdown m-r--5">
						<li>
							<a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="timer" data-loading-color="lightBlue">
								<i class="material-icons">equalizer</i>
							</a>
						</li>
					</ul>
				</div>
				<div class="body bg-green h300">
					<div id="serialchartwrapper"><div id="serialchart"></div></div>
					<div id="serial-legend" style="margin: 0 0 20px 0;position: relative;"></div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInRight'>
				<div class="header bg-green">
					<h2>
						Statistik Kuisioner <small>Statistik data kuisioner</small>
					</h2>
					<ul class="header-dropdown m-r--5">
						<li>
							<a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="timer" data-loading-color="lightBlue">
								<i class="material-icons">trending_up</i>
							</a>
						</li>
					</ul>
				</div>
				<div class="body bg-green h300">
					<ul class="dashboard-stat-list no-mt">
						<li>
							Hari ini<span class="pull-right"><b><span id="skr"></span></b> <small>Kuisioner</small></span>
						</li>
						<li>
							Kemarin<span class="pull-right"><b><span id="kmrn"></span></b> <small>Kuisioner</small></span>
						</li>
						<li>
							Bulan ini<span class="pull-right"><b><span id="blnskr"></span></b> <small>Kuisioner</small></span>
						</li>
						<li>
							Bulan kemarin<span class="pull-right"><b><span id="blnkmrn"></span></b> <small>Kuisioner</small></span>
						</li>
						<li>
							Tahun ini<span class="pull-right"><b><span id="thnskr"></span></b> <small>Kuisioner</small></span>
						</li>
						<li>
							Tahun kemarin<span class="pull-right"><b><span id="thnkmrn"></span></b> <small>Kuisioner</small></span>
						</li>
						<li>
							Total Seluruh kuisioner<span class="pull-right"><b><span id="total"></span></b> <small>Kuisioner</small></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInRight'>
				<div class="header bg-green">
					<h2>
						Kuisioner <small>Kelola data kuisioner</small>
					</h2>
					<ul class="header-dropdown m-r--5">
						<li>
							<a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="timer" data-loading-color="lightBlue">
								<i class="material-icons">settings</i>
							</a>
						</li>
					</ul>
				</div>
				<div class="body bg-green h300">
					<ul class="dashboard-stat-list no-mt">
						<li>
							<span class="font-bold font-15">Tambah Kuisioner</span>
							<p class="m-b-20 font-12">klik untuk menambahkan kuisioner baru</p>
							<button type="button" class="btn btn-lg bg-light-green waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahKuisioner">
								<i class="material-icons" style="font-size: 16px">add</i><span> Tambah Kuisioner</span>
							</button>
						</li>
						<li class="m-t-20">
							<span class="font-bold font-15">Report</span>
							<p class="m-b-20 font-12">Cetak Report atau Eksport ke PDF dan Excel</p>
							<button type="button" class="btn btn-lg bg-indigo waves-effect" data-toggle="modal" onclick="$.AdminBSB.notif.show('asdasdasdasdasd','asdadasdasdasdasdadasda');">
								<span>Print</span>
							</button>
							<div class="btn-group m-l-20" role="group">
								<button type="button" class="btn btn-lg bg-deep-purple waves-effect font-bold" data-toggle="modal">
									<span>PDF</span>
								</button>
								<a href="{{ route('adm.excel.kuisioner') }}">
									<button type="button" class="btn btn-lg bg-purple waves-effect font-bold" data-toggle="modal">
										<span>Excel</span>
									</button>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

{{-- #table --}}
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card light animate" data-animate="slideInUp">
				<div class="header">
					<h2>List Responden <small>data semua kuisioner</small> </h2>
					<ul class="header-dropdown m-r-15">
						<div class="input-group">
							<span class="input-group-addon">
								Filter
							</span>
							<div class="form-line">
								<input class="form-control" type="text" id="search-table-kuisioner" name="search-table-kuisioner" placeholder="..">
							</div>
						</div>
					</ul>
				</div>
				<div class="body kuisioner-table-container" style="padding-top: 0">
					<table id="kuisioner-table"  class="table table-striped table-hover dataTable" style="width: 100%;">
						<thead>
							<tr>
								<th data-priority="1"># ID</th>
								<th data-priority="1">IDTB</th>
								<th data-priority="2">Nama Responden</th>
								<th data-priority="3">Gender</th>
								<th data-priority="4">Institusi Asal Responden</th>
								<th data-priority="5">Alamat Responden</th>
								<th data-priority="2">Action</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

{{-- #modal tambah Kuisioner--}}
	<div class="modal fade" id="ModalTambahKuisioner" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" style="min-height: 300px" role="document">
			<div class="modal-content modal-col-trans">
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
														
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

{{-- #modal edit Kuisioner--}}
	<div class="modal fade" id="ModalUpdateKuisioner" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" style="min-height: 300px" role="document">
			<div class="modal-content modal-col-trans">
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
														
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

{{-- #modal delete Kuisioner--}}
	<div class="modal fade" id="ModalDeleteKuisioner" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content modal-col-light-green">
				<div class="modal-header">
					<h2 class="modal-title" id="defaultModalLabel">APA ANDA YAKIN INGIN MENGHAPUS DATA KUISIONER BERIKUT ?</h2>
				</div>
				<div class="modal-body">
						<table class="table table-delete table-condensed">
							<tbody>
								<tr>
									<td>ID</td>
									<td><span id="del-id"></span></td>
								</tr>
								<tr>
									<td>Responden</td>
									<td><span id="del-res"></span></td>
								</tr>
							</tbody>
						</table>

				</div>

				<div class="modal-footer">
					<form id="formDeleteKuisioner" action="{{ route('adm.postdeletekuisioner') }}" method="post" accept-charset="utf-8">
						<input type="hidden" name="_token" value="{{ Session::token() }}" >
						<input type="hidden" name="_id" value="" >
						<button type="submit" class="btn btn-link waves-effect">HAPUS</button>
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection