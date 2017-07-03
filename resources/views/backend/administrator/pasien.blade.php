@extends('backend.default')

@push('title')
<title>Kelola Data Pasien - MDRTB Laboratory Manager</title>
@endpush

@include('backend.administrator.asset.pasienasset')

@section('content')
<div class="container-fluid">

{{-- #card --}}
	<div class="row clearfix">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInLeft'>
				<div class="header bg-green">
					<h2>
						Chart Total Jumlah Pasien <small>Jumlah total seluruh pasien</small>
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
					<div id="pie-legend" style="margin: 5px 0 20px 0;position: relative;"></div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInLeft'>
				<div class="header bg-green">
					<h2>
						Chart Jumlah Pasien <small>Penambahan jumlah pasien perbulan</small>
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
						Statistik Pasien <small>Statistik data pasien</small>
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
							Hari ini<span class="pull-right"><b><span id="skr"></span></b> <small>PASIEN</small></span>
						</li>
						<li>
							Kemarin<span class="pull-right"><b><span id="kmrn"></span></b> <small>PASIEN</small></span>
						</li>
						<li>
							Bulan ini<span class="pull-right"><b><span id="blnskr"></span></b> <small>PASIEN</small></span>
						</li>
						<li>
							Bulan kemarin<span class="pull-right"><b><span id="blnkmrn"></span></b> <small>PASIEN</small></span>
						</li>
						<li>
							Tahun ini<span class="pull-right"><b><span id="thnskr"></span></b> <small>PASIEN</small></span>
						</li>
						<li>
							Tahun kemarin<span class="pull-right"><b><span id="thnkmrn"></span></b> <small>PASIEN</small></span>
						</li>
						<li>
							Total Seluruh pasien<span class="pull-right"><b><span id="total"></span></b> <small>PASIEN</small></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInRight'>
				<div class="header bg-green">
					<h2>
						Pasien <small>Kelola data pasien</small>
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
							<span class="font-bold font-15">Tambah Pasien</span>
							<p class="m-b-20 font-12">klik untuk menambahkan pasien baru</p>
							<button type="button" class="btn btn-lg bg-light-green waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahPasien">
								<i class="material-icons" style="font-size: 16px">add</i><span> Tambah Pasien</span>
							</button>
						</li>
						<li class="m-t-20">
							<span class="font-bold font-15">Report</span>
							<p class="m-b-20 font-12">Cetak Report atau Eksport ke PDF dan Excel</p>
							<button type="button" class="btn btn-lg bg-indigo waves-effect" data-toggle="modal" data-target="#largeModal" onclick="$.AdminBSB.notif.show('asdasdasdasdasd','asdadasdasdasdasdadasda');">
								<span>Print</span>
							</button>
							<div class="btn-group m-l-20" role="group">
								<button type="button" class="btn btn-lg bg-deep-purple waves-effect font-bold" data-toggle="modal" data-target="#largeModal">
									<span>PDF</span>
								</button>
								<button type="button" class="btn btn-lg bg-purple waves-effect font-bold" data-toggle="modal" data-target="#largeModal">
									<span>Excel</span>
								</button>
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
					<h2>List Pasien <small>data semua pasien</small> </h2>
					<ul class="header-dropdown m-r-15">
						<div class="input-group">
							<span class="input-group-addon">
								Filter
							</span>
							<div class="form-line">
								<input class="form-control" type="text" id="search-table-pasien" name="search-table-pasien" placeholder="ketik unt filter data..">
							</div>
						</div>
					</ul>
				</div>
				<div class="body pasien-table-container" style="padding-top: 0">
					<table id="pasien-table" class="table table-striped table-hover dataTable">
						<thead>
							<tr>
								<th data-priority="1">#</th>
								<th data-priority="1">IDTB</th>
								<th data-priority="1">IDPP</th>
								<th data-priority="4">Nama Pasien</th>
								<th data-priority="6">Gender</th>
								<th data-priority="7">Umur</th>
								<th data-priority="12">#</th>
								<th data-priority="5">Institusi asal Pasien</th>
								<th data-priority="8">Alamat Pasien</th>
								<th data-priority="10">Kuis..</th>
								<th data-priority="11">Enum..</th>
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
									<div class="col-md-4">
										<p><b>Sampel dari Pasien</b></p>
										<div class="input-group">
											<h4 id="nm_pas">Nama Pasien</h4>
											<input type="hidden" id="pasien_id" name="pasien_id" value="" > 
										</div>
									</div>
									<div class="col-sm-4">
										<p><b>#IDTB</b></p>
										<div class="input-group">
											<div class="form-line">
												<h5 id="vsidtb">idtb</h5>
												<input type="hidden" id="sidtb" name="idtb" value="" > 
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<p><b>#IDPP</b></p>
										<div class="input-group">
											<div class="form-line">
												<h5 id="vsidpp">idpp</h5>
												<input type="hidden" id="sidpp" name="idpp" value="" > 
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

{{-- #modal tambah pasien--}}
	<div class="modal fade" id="ModalTambahPasien" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content modal-col-green">

				<form id="formTambahPasien" action="{{ route('adm.formtambahpasien') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" >	

					<div class="card light">
						<div class="header bg-green">
							<h2>Form Tambah Pasien<small>Tambah data pasien baru</small></h2>
						</div>
						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
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
									<div class="col-sm-6">
										<p><b>Nama</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="namapasien" name="namapasien" placeholder="Cth: Sandi Kelana">
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>Gender</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="sex" name="sex" title="Pilih opsi">
												<option value="pria">Pria</option>
												<option value="wanita">Wanita</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>Umur</b></p>
										<div class="input-group spinner" data-trigger="spinner">
											<span class="input-group-addon">
												<a href="javascript:;" class="spin-up" data-spin="up"><i class="glyphicon glyphicon-chevron-up"></i></a>
												<a href="javascript:;" class="spin-down" data-spin="down"><i class="glyphicon glyphicon-chevron-down"></i></a>
											</span>
											<div class="form-line">
												<input class="form-control text-center" type="text" id="umur" name="umur" value="0" data-max="100" data-min="0">
											</div>
											<span class="input-group-addon">thn</span>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<p><b>Institusi Asal</b></p>
										<div class="input-group">
											<select class="select2" id="instansiasal" name="instansiasal" style="width: 100%;">
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>Kuisioner</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="kuisioner" name="kuisioner" title="Pilih opsi">
												<option value="1">Ada</option>
												<option value="0">Tidak Ada</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>Enumerator</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="enumerator" name="enumerator" placeholder="Cth: Sandi Kelana" >
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-sm-12">
										<h3 class="card-inside-title">Alamat</h3>
										<div class="form-group">
											<div class="form-line">
												<textarea class="form-control no-resize" id="alamat" name="alamat" rows="4" placeholder="Ketik alamat pasien..."></textarea>
											</div>
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

{{-- #modal update pasien--}}
	<div class="modal fade" id="ModalUpdatePasien" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content modal-col-green">
				<form id="formUpdatePasien" action="{{ route('adm.formupdatepasien') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" >
					<input type="hidden" name="_id" value="" >	

					<div class="card light">
						<div class="header bg-green">
							<h2>Form Update Pasien<small>Perbaharui data pasien</small></h2>
						</div>

						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
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
									<div class="col-sm-6">
										<p><b>Nama</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="unamapasien" name="namapasien" placeholder="Cth: Sandi Kelana">
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>Gender</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="usex" name="sex">
												<option value="pria">Pria</option>
												<option value="wanita">Wanita</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>Umur</b></p>
										<div class="input-group spinner" data-trigger="spinner">
											<span class="input-group-addon">
												<a href="javascript:;" class="spin-up" data-spin="up"><i class="glyphicon glyphicon-chevron-up"></i></a>
												<a href="javascript:;" class="spin-down" data-spin="down"><i class="glyphicon glyphicon-chevron-down"></i></a>
											</span>
											<div class="form-line">
												<input class="form-control text-center" type="text" id="uumur" name="umur" value="0" data-max="100" data-min="0">
											</div>
											<span class="input-group-addon">thn</span>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<p><b>Institusi Asal</b></p>
										<div class="input-group">
											<select class="select2" id="uinstansiasal" name="instansiasal" style="width: 100%;">

											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>Kuisioner</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="ukuisioner" name="kuisioner">
												<option value="1">Ada</option>
												<option value="0">Tidak Ada</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<p><b>Enumerator</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="uenumerator" name="enumerator" placeholder="Cth: Sandi Kelana" >
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<h3 class="card-inside-title">Alamat</h3>
										<div class="form-group">
											<div class="form-line">
												<textarea class="form-control no-resize" id="ualamat" name="alamat" rows="4" placeholder="Ketik alamat pasien..."></textarea>
											</div>
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
	<div class="modal fade" id="ModalDeletePasien" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content modal-col-light-green">
				<div class="modal-header">
					<h2 class="modal-title" id="defaultModalLabel">APA ANDA YAKIN INGIN MENGHAPUS DATA PASIEN BERIKUT ?</h2>
				</div>
				<div class="modal-body">
						<table class="table table-delete table-condensed">
							<tbody>
								<tr>
									<td>Nama</td>
									<td><span id="del-nama"></span></td>
								</tr>
								<tr>
									<td>Gender</td>
									<td><span id="del-sex"></span></td>
								</tr>
								<tr>
									<td>Umur</td>
									<td><span id="del-age"></span></td>
								</tr>
							</tbody>
						</table>

				</div>

				<div class="modal-footer">
					<form id="formDeletePasien" action="{{ route('adm.formdeletepasien') }}" method="post" accept-charset="utf-8">
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