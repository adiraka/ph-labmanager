<h3 class="font-bold">Responden</h3>
<fieldset>
	<div class="block-header" id="K0">
		<h2>Responden <small>Pasien yang mengisi kuisioner merupakan pasien yang telah terdaftar</small></h2>
	</div>
	<hr>
	<div class="row clearfix p-l-25">
		<div class="col-md-4 m-t-15">
			<p class="font-bold">Nama </p>
			<p class="font-bold">IDTB </p>
			<p class="font-bold">IDPP </p>
			<p class="font-bold">gender </p>
			<p class="font-bold">umur </p>
		</div>

		<div class="col-md-8 m-t-15">
			<p>{{ $ans->pasien->nama_pasien }} </p>
			<p>{{ $ans->pasien->idtb }} </p>
			<p>{{ $ans->pasien->idpp ? $ans->pasien->idpp : '-' }} </p>
			<p>{{ $ans->pasien->sex }} </p>
			<p>{{ $ans->pasien->umur }} </p>
		</div>
		<input type="hidden" name="pasien_id" value="{{ $ans->pasien->id }}">
	</div>
	<hr>

	<div class="row clearfix p-l-25">
	<h5>Ubah Responden</h5>
	<p class="m-t-15">pilih responden pada pasien box berikut </p>
		<div class="col-md-8">
			<div class="input-group">
				<select class="select2" id="pasien" name="pasien_id2" style="width: 100%;">
				</select>
			</div>
		</div>
	</div>
</fieldset>