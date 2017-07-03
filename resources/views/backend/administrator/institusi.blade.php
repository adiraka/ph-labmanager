@extends('backend.default')

@push('title')
<title>Kelola Data Institusi - MDRTB Laboratory Manager</title>
@endpush

@include('backend.administrator.asset.institusiasset')

@section('content')
<div class="container-fluid">

{{-- #card --}}
	<div class="row clearfix">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInLeft'>
				<div class="header bg-green">
					<h2>
						Chart Jumlah Institusi <small>Jumlah setiap jenis institusi</small>
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
					<div class="piechartwrapper"><div id="institusichart" class="piechart"></div></div>
					<div id="pie-legend" style="margin: 5px 0 20px 0;position: relative;"></div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInLeft'>
				<div class="header bg-green">
					<h2>
						Chart Jumlah Institusi <small>Jumlah institusi setiap daerah</small>
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
					<div id="Daerahchartwrapper" class="piechartwrapper"><div id="daerahchart" class="piechart"></div></div>
					<div id="daerah-legend" class="bg-green" style="margin: 5px 0 20px 0;position: relative; z-index: 8"></div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInRight'>
				<div class="header bg-green">
					<h2>
						Statistik Institusi <small>Statistik data institusi</small>
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
							Hari ini<span class="pull-right"><b><span id="skr"></span></b> <small>INSTITUSI</small></span>
						</li>
						<li>
							Kemarin<span class="pull-right"><b><span id="kmrn"></span></b> <small>INSTITUSI</small></span>
						</li>
						<li>
							Bulan ini<span class="pull-right"><b><span id="blnskr"></span></b> <small>INSTITUSI</small></span>
						</li>
						<li>
							Bulan kemarin<span class="pull-right"><b><span id="blnkmrn"></span></b> <small>INSTITUSI</small></span>
						</li>
						<li>
							Tahun ini<span class="pull-right"><b><span id="thnskr"></span></b> <small>INSTITUSI</small></span>
						</li>
						<li>
							Tahun kemarin<span class="pull-right"><b><span id="thnkmrn"></span></b> <small>INSTITUSI</small></span>
						</li>
						<li>
							Total seluruh institusi<span class="pull-right"><b><span id="total"></span></b> <small>INSTITUSI</small></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="card animate" data-animate='fadeInRight'>
				<div class="header bg-green">
					<h2>
						Institusi <small>Kelola data institusi</small>
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
							<span class="font-bold font-15">Tambah Jenis Institusi & Institusi</span>
							<p class="m-b-10 font-12">klik untuk menambahkan jenis institusi dan institusi baru</p>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-lg bg-indigo waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahInstitusi">
								<span>Institusi</span>
							</button>
								<button type="button" class="btn btn-lg bg-deep-purple waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahJnsInstitusi">
								<span> Jns Institusi</span>
							</button>
							<button type="button" class="btn btn-lg bg-purple waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahDaerah">
								<span> Daerah</span>
							</button>
							</div>
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
				<div class="body">

					<ul class="nav nav-tabs tab-nav-right" role="tablist">
						<li role="presentation" class="active"><a class="font-18" href="#tab-table-institusi" data-toggle="tab">Institusi <small>data semua Institusi</small></a></li>
						<li role="presentation"><a class="font-18" href="#tab-table-jns-institusi" data-toggle="tab">Jenis Institusi <small>data semua Jenis Institusi</small></a></li>
						<li role="presentation"><a class="font-18" href="#tab-table-daerah" data-toggle="tab">Daerah <small>data semua Daerah</small></a></li>
					</ul>

					<div class="tab-content">
						<div role="tabpanel" class="tab-pane animated fadeIn active" id="tab-table-institusi"  style="min-height: 550px">
							<table id="institusi-table" class="table table-striped table-hover dataTable" style="padding-top: 0">
								<thead>
									<tr>
										<th data-priority="1">#</th>
										<th data-priority="4">Jenis Institusi</th>
										<th data-priority="3">Nama Institusi</th>
										<th data-priority="6">Daerah</th>
										<th data-priority="7">Alamat</th>
										<th data-priority="2">Action</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div role="tabpanel" class="tab-pane animated fadeIn" id="tab-table-jns-institusi" style="min-height: 550px">
							<div class="body pasien-table-container" style="padding-top: 0;width: 500px">
							<table id="jns-institusi-table" class="table table-striped table-hover dataTable">
									<thead>
										<tr>
											<th data-priority="1">#</th>
											<th data-priority="4">Nama Jenis Institusi</th>
											<th data-priority="3">Jumlah Institusi</th>
											<th data-priority="2">Action</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane animated fadeIn" id="tab-table-daerah" style="min-height: 550px">
							<div class="body pasien-table-container" style="padding-top: 0;width: 500px">
								<table id="daerah-table" class="table table-striped table-hover dataTable">
									<thead>
										<tr>
											<th data-priority="1">#</th>
											<th data-priority="4">Nama Daerah</th>
											<th data-priority="3">Jumlah Institusi</th>
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
	</div>

{{-- #modal tambah daerah--}}
	<div class="modal fade" id="ModalTambahDaerah" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-green">

				<form id="formTambahDaerah" action="{{ route('adm.formtambahdaerah') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" >	

					<div class="card light">
						<div class="header bg-green">
							<h2>Form Tambah Daerah<small>Tambah data daerah baru</small></h2>
						</div>
						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
									<div class="col-sm-12">
										<p><b>Nama Daerah</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="NamaDaerah" name="NamaDaerah" placeholder="Cth: Padang">
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

{{-- #modal update daerah--}}
	<div class="modal fade" id="ModalUpdateDaerah" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-green">
				<form id="formUpdateDaerah" action="{{ route('adm.formupdatedaerah') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" >
					<input type="hidden" name="_id" value="" >	

					<div class="card light">
						<div class="header bg-green">
							<h2>Form Update Daerah<small>Perbaharui data daerah</small></h2>
						</div>

						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
									<div class="col-sm-12">
										<p><b>Nama Daerah</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="uNamaDaerah" name="uNamaDaerah" placeholder="Cth: Rumah Sakit">
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

{{-- #modal delete daerah--}}
	<div class="modal fade" id="ModalDeleteDaerah" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content modal-col-light-green">
				<div class="modal-header">
					<h2 class="modal-title" id="defaultModalLabel">APA ANDA YAKIN INGIN MENGHAPUS DATA DAERAH BERIKUT ?</h2>
				</div>
				<div class="modal-body">
						<table class="table table-delete table-condensed">
							<tbody>
								<tr>
									<td>Nama Daerah</td>
									<td><span id="dDaerah"></span></td>
								</tr>
							</tbody>
						</table>
				</div>

				<div class="modal-footer">
					<form id="formDeleteDaerah" action="{{ route('adm.formdeletedaerah') }}" method="post" accept-charset="utf-8">
						<input type="hidden" name="_token" value="{{ Session::token() }}" >
						<input type="hidden" name="_id" value="" >
						<button type="submit" class="btn btn-link waves-effect">HAPUS</button>
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
					</form>
				</div>
			</div>
		</div>
	</div>

{{-- #modal tambah Jns institusi--}}
	<div class="modal fade" id="ModalTambahJnsInstitusi" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-green">

				<form id="formTambahJnsInstitusi" action="{{ route('adm.formtambahjnsinstitusi') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" >	

					<div class="card light">
						<div class="header bg-green">
							<h2>Form Tambah Jenis Institusi<small>Tambah data Jenis institusi baru</small></h2>
						</div>
						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
									<div class="col-sm-12">
										<p><b>Nama Jenis Institusi</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="jNamaJenisInstitusi" name="jNamaJenisInstitusi" placeholder="Cth: Rumah Sakit">
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

{{-- #modal update Jns institusi--}}
	<div class="modal fade" id="ModalUpdateJnsInstitusi" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-green">
				<form id="formUpdateJnsInstitusi" action="{{ route('adm.formupdatejnsinstitusi') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" >
					<input type="hidden" name="_id" value="" >	

					<div class="card light">
						<div class="header bg-green">
							<h2>Form Update Jenis Instansi<small>Perbaharui data jenis instansi</small></h2>
						</div>

						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
									<div class="col-sm-12">
										<p><b>Nama Jenis Institusi</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="ujNamaJenisInstitusi" name="ujNamaJenisInstitusi" placeholder="Cth: Rumah Sakit">
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

{{-- #modal delete Jns institusi--}}
	<div class="modal fade" id="ModalDeleteJnsInstitusi" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content modal-col-light-green">
				<div class="modal-header">
					<h2 class="modal-title" id="defaultModalLabel">APA ANDA YAKIN INGIN MENGHAPUS DATA JENIS INSTITUSI BERIKUT ?</h2>
				</div>
				<div class="modal-body">
						<table class="table table-delete table-condensed">
							<tbody>
								<tr>
									<td>Nama</td>
									<td><span id="djNamaJenisInstitusi"></span></td>
								</tr>
							</tbody>
						</table>
				</div>

				<div class="modal-footer">
					<form id="formDeleteJnsInstitusi" action="{{ route('adm.formdeletejnsinstitusi') }}" method="post" accept-charset="utf-8">
						<input type="hidden" name="_token" value="{{ Session::token() }}" >
						<input type="hidden" name="_id" value="" >
						<button type="submit" class="btn btn-link waves-effect">HAPUS</button>
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
					</form>
				</div>
			</div>
		</div>
	</div>

{{-- #modal tambah institusi--}}
	<div class="modal fade" id="ModalTambahInstitusi" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-green">

				<form id="formTambahInstitusi" action="{{ route('adm.formtambahinstitusi') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" >	

					<div class="card light">
						<div class="header bg-green">
							<h2>Form Tambah Institusi<small>Tambah data institusi baru</small></h2>
						</div>
						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
									<div class="col-sm-12">
										<p><b>Nama Institusi</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="iNamaInstitusi" name="iNamaInstitusi" placeholder="Cth: Dr M.Djamil">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<p><b>Jenis Institusi</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="iJnsInstitusi" name="iJnsInstitusi" title="Pilih opsi">
											@foreach ($listJnsInstansi as $jnsInstansi)
												<option value="{{ $jnsInstansi->id }}">{{ $jnsInstansi->nama_jenis_instansi }}</option>
											@endforeach
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<p><b>Daerah</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="iDaerah" name="iDaerah" title="Pilih opsi">
												@foreach ($listdaerah as $daerah)
													<option value="{{ $daerah->id }}">{{ $daerah->nama_daerah }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-sm-12">
										<h3 class="card-inside-title">Alamat</h3>
										<div class="input-group">
											<div class="form-line">
												<textarea class="form-control no-resize" id="iAlamat" name="iAlamat" rows="4" placeholder="Ketik alamat Institusi..."></textarea>
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

{{-- #modal update institusi--}}
	<div class="modal fade" id="ModalUpdateInstitusi" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-green">

				<form id="formUpdateInstitusi" action="{{ route('adm.formupdateinstitusi') }}" method="post" accept-charset="utf-8">
					<input type="hidden" name="_token" value="{{ Session::token() }}" >
					<input type="hidden" name="_id" value="" >
					<div class="card light">
						<div class="header bg-green">
							<h2>Form Update Institusi<small>Perbaharui data institusi</small></h2>
						</div>
						<div class="body">
							<div class="container-fluid m-t-15">
								<div class="row clearfix">
									<div class="col-sm-12">
										<p><b>Nama Institusi</b></p>
										<div class="input-group">
											<div class="form-line">
												<input class="form-control" type="text" id="uiNamaInstitusi" name="uiNamaInstitusi" placeholder="Cth: Dr M.Djamil">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<p><b>Jenis Institusi</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="uiJnsInstitusi" name="uiJnsInstitusi" title="Pilih opsi">
											@foreach ($listJnsInstansi as $jnsInstansi)
												<option value="{{ $jnsInstansi->id }}">{{ $jnsInstansi->nama_jenis_instansi }}</option>
											@endforeach
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<p><b>Daerah</b></p>
										<div class="input-group">
											<select class="select form-control show-tick" id="uiDaerah" name="uiDaerah" title="Pilih opsi">
												@foreach ($listdaerah as $daerah)
													<option value="{{ $daerah->id }}">{{ $daerah->nama_daerah }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-sm-12">
										<h3 class="card-inside-title">Alamat</h3>
										<div class="input-group">
											<div class="form-line">
												<textarea class="form-control no-resize" id="uiAlamat" name="uiAlamat" rows="4" placeholder="Ketik alamat Institusi..."></textarea>
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

{{-- #modal delete institusi--}}
	<div class="modal fade" id="ModalDeleteInstitusi" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-light-green">
				<div class="modal-header">
					<h2 class="modal-title" id="defaultModalLabel">APA ANDA YAKIN INGIN MENGHAPUS DATA INSTITUSI BERIKUT ?</h2>
				</div>
				<div class="modal-body">
						<table class="table table-delete table-condensed">
							<tbody>
								<tr>
									<td width="30%">Nama Institusi</td>
									<td><span id="diNamaInstitusi"></span></td>
								</tr>
								<tr>
									<td>Jenis institusi</td>
									<td><span id="diJnsInstitusi"></span></td>
								</tr>
								<tr>
									<td>Daerah</td>
									<td><span id="diDaerah"></span></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td><span id="diAlamat"></span></td>
								</tr>
							</tbody>
						</table>
				</div>

				<div class="modal-footer">
					<form id="formDeleteInstitusi" action="{{ route('adm.formdeleteinstitusi') }}" method="post" accept-charset="utf-8">
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