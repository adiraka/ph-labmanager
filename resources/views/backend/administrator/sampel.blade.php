@extends('backend.default')

@push('title')
<title>Kelola Data Sampel - MDRTB Laboratory Manager</title>
@endpush

@include('backend.administrator.asset.sampelasset')

@section('content')
<div class="container-fluid">

{{-- #card --}}
	<div class="row clearfix">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInLeft'>
				<div class="header bg-green">
					<h2>
						Chart Total Jumlah Sampel <small>Jumlah total seluruh sampel</small>
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
					<div id="piechartwrapper"><div id="piechart"></div></div>
					<div id="pie-legend" style="margin: 5px 0 20px 0;position: relative;"></div>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInLeft'>
				<div class="header bg-green">
					<h2>
						Chart Jumlah Sampel <small>Penambahan jumlah sampel perbulan</small>
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
						Statistik Sampel <small>Statistik data sampel</small>
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
							Hari ini<span class="pull-right"><b><span id="skr"></span></b> <small>SAMPEL</small></span>
						</li>
						<li>
							Kemarin<span class="pull-right"><b><span id="kmrn"></span></b> <small>SAMPEL</small></span>
						</li>
						<li>
							Bulan ini<span class="pull-right"><b><span id="blnskr"></span></b> <small>SAMPEL</small></span>
						</li>
						<li>
							Bulan kemarin<span class="pull-right"><b><span id="blnkmrn"></span></b> <small>SAMPEL</small></span>
						</li>
						<li>
							Tahun ini<span class="pull-right"><b><span id="thnskr"></span></b> <small>SAMPEL</small></span>
						</li>
						<li>
							Tahun kemarin<span class="pull-right"><b><span id="thnkmrn"></span></b> <small>SAMPEL</small></span>
						</li>
						<li>
							Total Seluruh Sampel<span class="pull-right"><b><span id="total"></span></b> <small>SAMPEL</small></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInRight'>
				<div class="header bg-green">
					<h2>
						Sampel <small>Kelola data sampel</small>
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
							<span class="font-bold font-15">Tambah Sampel</span>
							<p class="m-b-20 font-12">klik untuk menambahkan sampel baru</p>
							<button type="button" class="btn btn-lg bg-light-green waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahSampel">
								<i class="material-icons" style="font-size: 16px">add</i><span> Tambah Sampel</span>
							</button>
						</li>
						<li class="m-t-20">
							<span class="font-bold font-15">Report</span>
							<p class="m-b-20 font-12">Export Laporan Sampel ke Excel</p>
							<div class="btn-group m-l-20" role="group">
								<a href="{{ route('adm.excel.sampel.ge') }}">
									<button type="button" class="btn btn-lg bg-deep-purple waves-effect font-bold">
										<span>GE</span>
									</button>
								</a>
								<a href="{{ route('adm.excel.sampel.kltr') }}">
									<button type="button" class="btn btn-lg bg-indigo waves-effect">
										<span>KLTR</span>
									</button>
								</a>
								<a href="{{ route('adm.excel.sampel.bta') }}">
									<button type="button" class="btn btn-lg bg-purple waves-effect font-bold">
										<span>BTA</span>
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
				<div class="body">

					<ul class="nav nav-tabs tab-nav-right" role="tablist">
						<li role="presentation" class="active">
						<a class="font-18" href="#tab-table-institusi" data-toggle="tab">List Sampel <small>data semua sampel</small></a>
						</li>
						<li role="presentation">
							<a class="font-18" href="#tab-table-jns-institusi" data-toggle="tab">List Sampel Positif <small>data sampel positif</small></a>
						</li>
						<li role="presentation">
							<a class="font-18" href="#tab-table-daerah" data-toggle="tab">List Sampel Negatif <small>data sampel negatif</small></a>
						</li>
					</ul>

					<div class="tab-content">

						<div role="tabpanel" class="tab-pane animated fadeIn active" id="tab-table-institusi"  style="min-height: 550px">
							{{-- <div class="header"> --}}
								{{-- <h2>List Sampel <small>data semua sampel</small> </h2> --}}
								<ul class="header-dropdown m-r-15" style="position: relative;">
									<div class="input-group">
										<span class="input-group-addon">
											Filter
										</span>
										<div class="form-line">
											<input class="form-control" type="text" id="search-table-sampel" name="search-table-sampel" placeholder="ketik unt filter data..">
										</div>
									</div>
								</ul>
							{{-- </div> --}}
							<table id="sampel-table" class="table compact table-striped table-hover dataTable">
								<thead>
									<tr>
										<th data-priority="1">#</th>
										<th data-priority="2">IDTB</th>
										<th data-priority="2">IDPP</th>
										<th data-priority="2">Nama Pasien</th>
										<th data-priority="3">Pemeriksaan</th>
										<th data-priority="7">Tgl Masuk</th>
										<th data-priority="6">Tgl Periksa</th>
										<th data-priority="6">Jns Sampel</th>
										<th data-priority="8">Resistensi</th>
										<th data-priority="4">Hasil</th>
										<th data-priority="5">Rif</th>
										<th data-priority="2">Action</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>

						<div role="tabpanel" class="tab-pane animated fadeIn" id="tab-table-jns-institusi" style="min-height: 550px">
							{{-- <div class="header"> --}}
{{-- 								<h2>List Sampel <small>data semua sampel</small> </h2>
 --}}								<ul class="header-dropdown m-r-15" style="position: relative;">
									<div class="input-group">
										<span class="input-group-addon">
											Filter
										</span>
										<div class="form-line">
											<input class="form-control" type="text" id="search-table-sampel" name="search-table-sampel" placeholder="ketik unt filter data..">
										</div>
									</div>
								</ul>
							{{-- </div> --}}
								<table id="sampel-table-positiv" class="table compact table-striped table-hover dataTable">
									<thead>
										<tr>
											<th data-priority="1">#</th>
											<th data-priority="2">IDTB</th>
											<th data-priority="2">IDPP</th>
											<th data-priority="2">Nama Pasien</th>
											<th data-priority="3">Pemeriksaan</th>
											<th data-priority="7">Tgl Masuk</th>
											<th data-priority="6">Tgl Periksa</th>
											<th data-priority="6">Jns Sampel</th>
											<th data-priority="8">Resistensi</th>
											<th data-priority="4">Hasil</th>
											<th data-priority="5">Rif</th>
											<th data-priority="2">Action</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>

						</div>

						<div role="tabpanel" class="tab-pane animated fadeIn" id="tab-table-daerah" style="min-height: 550px">
							{{-- <div class="header"> --}}
								{{-- <h2>List Sampel <small>data semua sampel</small> </h2> --}}
								<ul class="header-dropdown m-r-15" style="position: relative;">
									<div class="input-group">
										<span class="input-group-addon">
											Filter
										</span>
										<div class="form-line">
											<input class="form-control" type="text" id="search-table-sampel" name="search-table-sampel" placeholder="ketik unt filter data..">
										</div>
									</div>
								</ul>
							{{-- </div> --}}
								<table id="sampel-table-negativ" class="table compact table-striped table-hover dataTable">
									<thead>
										<tr>
											<th data-priority="1">#</th>
											<th data-priority="2">IDTB</th>
											<th data-priority="2">IDPP</th>
											<th data-priority="2">Nama Pasien</th>
											<th data-priority="3">Pemeriksaan</th>
											<th data-priority="7">Tgl Masuk</th>
											<th data-priority="6">Tgl Periksa</th>
											<th data-priority="6">Jns Sampel</th>
											<th data-priority="8">Resistensi</th>
											<th data-priority="4">Hasil</th>
											<th data-priority="5">Rif</th>
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
		</div>
	</div>

{{-- #modal tambah sampel--}}
	<div class="modal fade" id="ModalTambahSampel" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content modal-col-green">
				<form id="formTambahSampel" action="{{ route('adm.formtambahsampel') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" > 

					<div class="card light">

						<div class="header bg-green">
							<h2>Form Tambah Sampel<small>Tambah data sampel baru</small></h2>
						</div>

						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
									<div class="col-md-6">
										<p><b>Sampel dari Pasien</b></p>
										<div class="input-group">
											<select class="select2" id="pasien" name="pasien_id" style="width: 100%;">
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>#IDTB</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="idtb" name="idtb" placeholder="Cth: 0002-110915PM1S">
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>#IDPP</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="idpp" name="idpp" placeholder="Cth: 08/20/133">
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-sm-4">
										<p><b>Sampel ke</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="pemeriksaanke" name="pemeriksaanke" title="Pilih opsi">
												<option value="pertama">Pertama</option>
												<option value="kedua">Kedua</option>
												<option value="ketiga">Ketiga</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<p><b>Tgl Masuk Sampel</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="datepicker form-control" type="text" id="tgl_masuk_sampel" name="tgl_masuk_sampel" placeholder="thn/bln/hr">
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<p><b>Tgl Pemeriksaan Sampel</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="datepicker form-control" type="text" id="tgl_periksa" name="tgl_periksa" placeholder="thn/bln/hr">
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-sm-4">
										<p><b>Jenis Pemeriksaan</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="jns_sampel" name="jns_sampel" title="Pilih opsi">
												<option value="BTA">BTA</option>
												<option value="GeneXpert">GeneXpert</option>
												<option value="Kultur">Kultur</option>
												<option value="Resistensi">Resistensi</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<p><b>Hasil Pemeriksaan</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="hasil" name="hasil" title="Pilih opsi">
												<option value="TB Positif">TB Positif</option>
												<option value="TB Negatif">TB Negatif</option>
												<option value="Resistance">Resistance</option>
												<option value="Sensitive">Sensitive</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4 rifContainer">
										<p><b>Rif</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="rif" name="rif" title="Pilih opsi">
												<option value="Rif Positif">Rif Positif</option>
												<option value="Rif Negatif">Rif Negatif</option>
												<option value="Indeterminate">Indeterminate</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4 resistensiContainer">
										<p><b>Resistensi</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="jns_resistensi" name="jns_resistensi" title="Pilih opsi">
												<option value="Ethambutol">Ethambutol</option>
												<option value="INH">INH</option>
												<option value="Rifampisin">Rifampisin</option>
												<option value="Streptomisin">Streptomisin</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
						<button type="submit" class="btn btn-link waves-effect">SIMPAN</button>
					</div>
				</form>
			</div>
		</div>
	</div>

{{-- #modal update sampel--}}
	<div class="modal fade" id="ModalUpdateSampel" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content modal-col-green">
				<form id="formUpdateSampel" action="{{ route('adm.formupdatesampel') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" >
					<input type="hidden" name="_id" value="" >  

					<div class="card light">
						<div class="header bg-green">
							<h2>Form Update Sampel<small>Perbaharui data sampel</small></h2>
						</div>

						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
									<div class="col-sm-6">
										<p><b>Sampel dari Pasien</b></p>
										<div class="input-group">
											<select class="select2" id="upasien" name="pasien_id" style="width: 100%;">
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>#IDTB</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="uidtb" name="idtb" placeholder="Cth: 0002-110915PM1S">
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>#IDPP</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="uidpp" name="idpp" placeholder="Cth: 08/20/133">
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-sm-4">
										<p><b>Sampel ke</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="upemeriksaanke" name="pemeriksaanke" title="Pilih opsi">
												<option value="pertama">Pertama</option>
												<option value="kedua">Kedua</option>
												<option value="ketiga">Ketiga</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<p><b>Tgl Masuk Sampel</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="datepicker form-control" type="text" id="utgl_masuk_sampel" name="tgl_masuk_sampel" placeholder="thn/bln/hr">
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<p><b>Tgl Pemeriksaan Sampel</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="datepicker form-control" type="text" id="utgl_periksa" name="tgl_periksa" placeholder="thn/bln/hr">
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-4">
										<p><b>Jenis Pemeriksaan</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="ujns_sampel" name="jns_sampel" title="Pilih opsi">
												<option value="BTA">BTA</option>
												<option value="GeneXpert">GeneXpert</option>
												<option value="Kultur">Kultur</option>
												<option value="Resistensi">Resistensi</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<p><b>Hasil Pemeriksaan</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="uhasil" name="hasil" title="Pilih opsi">
												<option value="TB Positif">TB Positif</option>
												<option value="TB Negatif">TB Negatif</option>
												<option value="Resistance">Resistance</option>
												<option value="Sensitive">Sensitive</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4 rifContainer">
										<p><b>Rif</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="urif" name="rif" title="Pilih opsi">
												<option value="Rif Positif">Rif Positif</option>
												<option value="Rif Negatif">Rif Negatif</option>
												<option value="Indeterminate">Indeterminate</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4 resistensiContainer">
										<p><b>Resistensi</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="ujns_resistensi" name="jns_resistensi" title="Pilih opsi">
												<option value="Ethambutol">Ethambutol</option>
												<option value="INH">INH</option>
												<option value="Rifampisin">Rifampisin</option>
												<option value="Streptomisin">Streptomisin</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
						<button type="submit" class="btn btn-link waves-effect">UBAH</button>
					</div>
				</form>
			</div>
		</div>
	</div>

{{-- #modal delete pasien--}}
	<div class="modal fade" id="ModalDeleteSampel" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content modal-col-light-green">
				<div class="modal-header">
					<h2 class="modal-title" id="defaultModalLabel">APA ANDA YAKIN INGIN MENGHAPUS DATA <br/><br/> Sampel  <span id="del-pemeriksaanke"></span> dari pasien <br/><span id="del-nmpasien"></span> ?</h2>
				</div>
				<div class="modal-body">
					<table class="table table-delete table-condensed">
						<tbody>
							<tr>
								<td width="50%">IDTB</td>
								<td><span id="del-idtb"></span></td>
							</tr>
							<tr>
								<td>IDPP</td>
								<td><span id="del-idpp"></span></td>
							</tr>
							<tr>
								<td>Jenis sampel</td>
								<td><span id="del-jns_sampel"></span></td>
							</tr>
							<tr>
								<td>Hasil</td>
								<td><span id="del-hasil"></span></td>
							</tr>
						</tbody>
					</table>

				</div>

				<div class="modal-footer">
					<form id="formDeleteSampel" action="{{ route('adm.formdeletesampel') }}" method="post" accept-charset="utf-8">
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