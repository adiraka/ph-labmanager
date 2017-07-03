@extends('backend.default')

@push('title')
<title>Beranda Administrator - MDRTB Laboratory Manager</title>
@endpush

@include('backend.administrator.asset.berandaasset')

@section('content')
<div class="container-fluid">
	<div class="row clearfix">

		{{-- <div class="col-md-3 col-lg-3 hidden-xs">
			<div class="card">
				<div class="body bg-lime animate" data-animate="fadeInLeft" style="min-height: calc(100vh - 150px)">
					{{ \Date::setLocale('id') }}
					<div class="row clearfix user-info">
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 image">
							<img src="{{ asset('img/profil/user.png') }}" width="100" alt="">
						</div>
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 info-container">
							Selamat Datang !
							<span class="name font-18 font-bold"> {{ ucfirst($namauser) }}</span>
							Anda Login Sebagai
							<span class="email font-16 font-bold"> {{ ucfirst($role) }}</span>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px">
						<a href="{{ route('adm.pasien') }}" class="btn bg-light-green waves-effect font-bold" >
							<span>Perbaharui Data </span>
						</a>
						<a href="{{ route('logout') }}" class="btn-link col-green pull-right" style="margin-right: 15px">Logout ></a>
						</div>
					</div>
					<hr style="margin:0 0 10px 0 ">
					<div class="row clearfix">
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
							
						</div>
					</div>
				</div>
			</div>
		</div> --}}

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="block-header align-right">
						<h2>Waktu Server<small>{{ \Date::now()->format('l j F Y') }}</small></h2>
					</div>
				</div>
			</div>
		
		{{-- Infobox --}}
			<div class="row clearfix">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-5 bg-green hover-zoom-effect animate" data-animate="zoomIn">
						<div class="icon">
							<i class="material-icons">face</i>
						</div>
						<div class="content">
							<div class="text">PASIEN</div>
							@foreach ($rekappasien as $pasien)
							<div id="totalPasien" class="number">{{ $pasien->total }}</div>
							@endforeach
						</div>
						<div>
							<div class="btn-group btn-group-justified" role="group">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-lg bg-light-green waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahPasien">
										<span>TAMBAH</span>
									</button>
								</div>
								<a href="{{ route('adm.pasien') }}" class="btn btn-lg bg-lime waves-effect font-bold" >
									<span>DETAIL </span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-5 bg-green hover-zoom-effect animate" data-animate="zoomIn">
						<div class="icon">
							<i class="material-icons">local_pharmacy</i>
						</div>
						<div class="content">
							<div class="text">SAMPEL</div>
							@foreach ($rekapsampel as $sampel)
							<div id="totalSampel" class="number">{{ $sampel->total }}</div>
							@endforeach
						</div>
						<div>
							<div class="btn-group btn-group-justified" role="group">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-lg bg-light-green waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahSampel">
										<span>TAMBAH</span>
									</button>
								</div>
								<a href="{{ route('adm.sampel') }}" class="btn btn-lg bg-lime waves-effect font-bold" >
									<span>DETAIL </span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-5 bg-green hover-zoom-effect animate" data-animate="zoomIn">
						<div class="icon">
							<i class="material-icons">account_balance</i>
						</div>
						<div class="content">
							<div class="text">INSTITUSI</div>
							@foreach ($rekapinstitusi as $institusi)
							<div id="totalInstitusi" class="number">{{ $institusi->total }}</div>
							@endforeach
						</div>
						<div>
							<div class="btn-group btn-group-justified" role="group">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-lg bg-light-green waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahInstitusi">
										<span>TAMBAH</span>
									</button>
								</div>
								<a href="{{ route('adm.instansi') }}" class="btn btn-lg bg-lime waves-effect font-bold" >
									<span>DETAIL </span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-5 bg-green hover-zoom-effect animate" data-animate="zoomIn">
						<div class="icon">
							<i class="material-icons">textsms</i>
						</div>
						<div class="content">
							<div class="text">KUISIONER</div>
							@foreach ($rekapkuis as $kuisioner)
							<div id="totalKuisioner" class="number">{{ $kuisioner->total }}</div>
							@endforeach
						</div>
						<div>
							<div class="btn-group btn-group-justified" role="group">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-lg bg-light-green waves-effect font-bold" data-toggle="modal" data-target="#ModalTambahKuisioner">
										<span>TAMBAH</span>
									</button>
								</div>
								<a href="{{ route('adm.kuisioner') }}" class="btn btn-lg bg-lime waves-effect font-bold" >
									<span>DETAIL </span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		{{-- Report --}}
			<div class="row clearfix">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="card light animate" data-animate="zoomIn">

						<div class="body" style="padding-top: 0;overflow-y: auto;height: calc(100vh - 350px)">
							<ul class="nav nav-tabs tab-col-green" role="tablist">
								<li role="presentation" class="active">
									<a href="#home_with_icon_title" data-toggle="tab" class="font-12">
										<i class="material-icons">face</i> <span class="hidden-xs">PASIEN REPORT</span>
									</a>
								</li>
								<li role="presentation">
									<a href="#profile_with_icon_title" data-toggle="tab" class="font-12">
										<i class="material-icons">local_pharmacy</i> <span class="hidden-xs">SAMPEL REPORT</span>
									</a>
								</li>
								<li role="presentation">
									<a href="#messages_with_icon_title" data-toggle="tab" class="font-12">
										<i class="material-icons">account_balance</i> <span class="hidden-xs">INSTITUSI REPORT</span>
									</a>
								</li>
								<li role="presentation">
									<a href="#settings_with_icon_title" data-toggle="tab" class="font-12">
										<i class="material-icons">textsms</i> <span class="hidden-xs">KUISIONER REPORT</span>
									</a>
								</li>
							</ul>

							<div class="row clearfix m-t-20">
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									<div class="tab-content">
										{{-- Pasien --}}
											<div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
												<p><b>Partial Report</b></p>
												<p>
													Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
												</p>
												<div class="row clearfix p-t-15">
													<div class="col-md-6">
														<div class="input-group">
															<select class="select2" id="report-pasien" name="pasien_id" style="width: 100%;">
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group">
															<button type="submit" class="btn bg-light-green waves-effect">Laporan</button>
														</div>
													</div>
												</div>
											</div>
										{{-- Sampel --}}
											<div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
												<b>Partial Report</b>
												<p>
													Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
													Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
													pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
													sadipscing mel.
												</p>
											</div>
										{{-- Institusi --}}
											<div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
												<b>Partial Report</b>
												<p>
													Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
													Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
													pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
													sadipscing mel.
												</p>
											</div>
										{{-- Kuisioner --}}
											<div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
												<b>Partial Report</b>
												<p>
													Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
													Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
													pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
													sadipscing mel.
												</p>
											</div>
									</div>
								</div>
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<p><b>Cetak Laporan</b></p>

									<p>Buat dan cetak laporan data pasien </p>
									<p>
										<button class="btn bg-light-green waves-effect font-bold"><span>Lap. Lengkap</span></button>
										<button class="btn bg-light-green waves-effect font-bold"><span>Lap. Bulanan</span></button>
									</p>


									<p><b>Export Laporan</b></p>

									<p>Laporan lengkap dapat export </p>
									<p>
										<div class="btn-group" role="group">
											<a href="{{ route('adm.kuisioner') }}" class="btn bg-light-green waves-effect font-bold" >
												<span>PDF </span>
											</a>
											<a href="{{ route('adm.excel.keseluruhan') }}" class="btn bg-lime waves-effect font-bold" >
												<span>Excel </span>
											</a>
										</div>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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
											<select class="select2" id="spasien" name="pasien_id" style="width: 100%;">
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
@endsection