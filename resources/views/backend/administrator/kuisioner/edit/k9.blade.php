<h3>Data Lingkungan Responden</h3>
<fieldset>
	<div class="block-header">
		<h2>Data Lingkungan Responden <small>Kuisioner tentang lingkungan tempat tinggal responden</small></h2>
	</div>
	<hr>

	{{-- no79 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">79. Tipe Rumah (Observasi)</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks79" id="ks79a1"  value="Permanen" type="radio" class="radio-col-light-green" @if ($ans->k79 == "Permanen") checked="checked" @endif/>
						<label for="ks79a1">Permanen</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks79" id="ks79a2"  value="Semi Permanen" type="radio" class="radio-col-light-green" @if ($ans->k79 == "Semi Permanen") checked="checked" @endif/>
						<label for="ks79a2">Semi Permanen</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks79" id="ks79a3"  value="Pondok / Menumpang" type="radio" class="radio-col-light-green" @if ($ans->k79 == "Pondok / Menumpang") checked="checked" @endif/>
						<label for="ks79a3">Pondok / Menumpang</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks79" id="ks79a4"  value="Ruko" type="radio" class="radio-col-light-green" @if ($ans->k79 == "Ruko") checked="checked" @endif/>
						<label for="ks79a4">Ruko</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks79" id="ks79a5"  value="Rusun" type="radio" class="radio-col-light-green" @if ($ans->k79 == "Rusun") checked="checked" @endif/>
						<label for="ks79a5">Rusun</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks79" id="ks79a6"  value="tempat yang tidak layak untuk tempat tinggal" type="radio" class="radio-col-light-green" @if ($ans->k79 == "tempat yang tidak layak untuk tempat tinggal") checked="checked" @endif/>
						<label for="ks79a6">tempat yang tidak layak untuk tempat tinggal</label>
					</div>

					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks79" id="ks79a9"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if($ans->k79 !== 'Permanen' && $ans->k79 !== 'Semi Permanen' && $ans->k79 !== 'Pondok / Menumpang' && $ans->k79 !== 'Ruko' && $ans->k79 !== 'Rusun' && $ans->k79 !== 'tempat yang tidak layak untuk tempat tinggal') checked="checked" @endif/>
								<label for="ks79a9">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks79t" name="ks79t" value="@if($ans->k79 !== 'Permanen' && $ans->k79 !== 'Semi Permanen' && $ans->k79 !== 'Pondok / Menumpang' && $ans->k79 !== 'Ruko' && $ans->k79 !== 'Rusun' && $ans->k79 !== 'tempat yang tidak layak untuk tempat tinggal') {{ $ans->k79 }} @endif" type="text" disabled="">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- no80 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">80. Bahan utama dinding bagian rumah</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks80" id="ks80a1"  value="Batu Bata" type="radio" class="radio-col-light-green" @if ($ans->k80 == "Batu Bata") checked="checked" @endif/>
						<label for="ks80a1">Batu Bata</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks80" id="ks80a2"  value="Batu Dengan Semen" type="radio" class="radio-col-light-green" @if ($ans->k80 == "Batu Dengan Semen") checked="checked" @endif/>
						<label for="ks80a2">Batu Dengan Semen</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks80" id="ks80a3"  value="Batako" type="radio" class="radio-col-light-green" @if ($ans->k80 == "Batako") checked="checked" @endif/>
						<label for="ks80a3">Batako</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks80" id="ks80a4"  value="Rammed Earth" type="radio" class="radio-col-light-green" @if ($ans->k80 == "Rammed Earth") checked="checked" @endif/>
						<label for="ks80a4">Rammed Earth</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks80" id="ks80a5"  value="Kayu dan Lumpur" type="radio" class="radio-col-light-green" @if ($ans->k80 == "Kayu dan Lumpur") checked="checked" @endif/>
						<label for="ks80a5">Kayu dan Lumpur</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks80" id="ks80a6"  value="Batu dan Lumpur" type="radio" class="radio-col-light-green" @if ($ans->k80 == "Batu dan Lumpur") checked="checked" @endif/>
						<label for="ks80a6">Batu dan Lumpur</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks80" id="ks80a7"  value="Kayu" type="radio" class="radio-col-light-green" @if ($ans->k80 == "Kayu") checked="checked" @endif/>
						<label for="ks80a7">Kayu</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks80" id="ks80a8"  value="Jerami" type="radio" class="radio-col-light-green" @if ($ans->k80 == "Jerami") checked="checked" @endif/>
						<label for="ks80a8">Jerami</label>
					</div>

					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks80" id="ks80a9"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if($ans->k80 !== 'Batu Bata' && $ans->k80 !== 'Batu Dengan Semen' && $ans->k80 !== 'Batako' && $ans->k80 !== 'Rammed Earth' && $ans->k80 !== 'Kayu dan Lumpur' && $ans->k80 !== 'Batu dan Lumpur' && $ans->k80 !== 'Kayu' && $ans->k80 !== 'Jerami') checked="checked" @endif/>
								<label for="ks80a9">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks80t" name="ks80t" value="@if($ans->k80 !== 'Batu Bata' && $ans->k80 !== 'Batu Dengan Semen' && $ans->k80 !== 'Batako' && $ans->k80 !== 'Rammed Earth' && $ans->k80 !== 'Kayu dan Lumpur' && $ans->k80 !== 'Batu dan Lumpur' && $ans->k80 !== 'Kayu' && $ans->k80 !== 'Jerami') {{ $ans->k80 }} @endif" type="text" disabled="">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- no81 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">81. Bahan lantai utama</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks81" id="ks81a1"  value="Lantai Papan" type="radio" class="radio-col-light-green" @if ($ans->k81 == "Lantai Papan") checked="checked" @endif/>
						<label for="ks81a1">Lantai Papan</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks81" id="ks81a2"  value="Aspal" type="radio" class="radio-col-light-green" @if ($ans->k81 == "Aspal") checked="checked" @endif/>
						<label for="ks81a2">Aspal</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks81" id="ks81a3"  value="Keramik" type="radio" class="radio-col-light-green" @if ($ans->k81 == "Keramik") checked="checked" @endif/>
						<label for="ks81a3">Keramik</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks81" id="ks81a4"  value="Papan Kayu" type="radio" class="radio-col-light-green" @if ($ans->k81 == "Papan Kayu") checked="checked" @endif/>
						<label for="ks81a4">Papan Kayu</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks81" id="ks81a5"  value="Semen" type="radio" class="radio-col-light-green" @if ($ans->k81 == "Semen") checked="checked" @endif/>
						<label for="ks81a5">Semen</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks81" id="ks81a6"  value="Tanah" type="radio" class="radio-col-light-green" @if ($ans->k81 == "Tanah") checked="checked" @endif/>
						<label for="ks81a6">Tanah</label>
					</div>

					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks81" id="ks81a9"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if($ans->k81 !== 'Lantai Papan' && $ans->k81 !== 'Aspal' && $ans->k81 !== 'Keramik' && $ans->k81 !== 'Papan Kayu' && $ans->k81 !== 'Semen' && $ans->k81 !== 'Tanah') checked="checked" @endif/>
								<label for="ks81a9">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks81t" name="ks81t" value="@if($ans->k81 !== 'Lantai Papan' && $ans->k81 !== 'Aspal' && $ans->k81 !== 'Keramik' && $ans->k81 !== 'Papan Kayu' && $ans->k81 !== 'Semen' && $ans->k81 !== 'Tanah') {{ $ans->k81 }} @endif" type="text" disabled="">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- no82 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">82. Bahan utama atap</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks82" id="ks82a1"  value="Pengerasan Beton" type="radio" class="radio-col-light-green" @if ($ans->k82 == "Pengerasan Beton") checked="checked" @endif/>
						<label for="ks82a1">Pengerasan Beton</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks82" id="ks82a2"  value="Kayu" type="radio" class="radio-col-light-green" @if ($ans->k82 == "Kayu") checked="checked" @endif/>
						<label for="ks82a2">Kayu</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks82" id="ks82a3"  value="Genteng" type="radio" class="radio-col-light-green" @if ($ans->k82 == "Genteng") checked="checked" @endif/>
						<label for="ks82a3">Genteng</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks82" id="ks82a4"  value="Seng Sera Semen" type="radio" class="radio-col-light-green" @if ($ans->k82 == "Seng Sera Semen") checked="checked" @endif/>
						<label for="ks82a4">Seng Sera Semen</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks82" id="ks82a5"  value="Alang-alang" type="radio" class="radio-col-light-green" @if ($ans->k82 == "Alang-alang") checked="checked" @endif/>
						<label for="ks82a5">Alang-alang</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks82" id="ks82a6"  value="Jerami" type="radio" class="radio-col-light-green" @if ($ans->k82 == "Jerami") checked="checked" @endif/>
						<label for="ks82a6">Jerami</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks82" id="ks82a7"  value="Daun Kelapa" type="radio" class="radio-col-light-green" @if ($ans->k82 == "Daun Kelapa") checked="checked" @endif/>
						<label for="ks82a7">Daun Kelapa</label>
					</div>

					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks82" id="ks82a9"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if($ans->k82 !== 'Pengerasan Beton' && $ans->k82 !== 'Kayu' && $ans->k82 !== 'Genteng' && $ans->k82 !== 'Seng Sera Semen' && $ans->k82 !== 'Alang-alang' && $ans->k82 !== 'Jerami' && $ans->k82 !== 'Daun Kelapa') checked="checked" @endif/>
								<label for="ks82a9">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks82t" name="ks82t" value="@if($ans->k82 !== 'Pengerasan Beton' && $ans->k82 !== 'Kayu' && $ans->k82 !== 'Genteng' && $ans->k82 !== '"Seng Sera Semen' && $ans->k82 !== 'Alang-alang' && $ans->k82 !== 'Jerami' && $ans->k82 !== 'Daun Kelapa') {{ $ans->k82 }} @endif" type="text" disabled="">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- no83 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">83. Tidak termasuk kamar mandi, dapur, gang, atau garasi, berapa jumlah total ruangan di rumah tersebut?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-5" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks83">sebanyak</label>
							</span>
							<div class="form-line">
								<input class="form-control align-center" name="ks83" value="{{ $ans->k83 ? $ans->k83 : '' }}" type="text">
							</div>
							<span class="input-group-addon">
								<label for="ks83">ruangan</label>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no84 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">84. Berapa ruangan yang digunakan untuk tidur?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-5" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks84">sebanyak</label>
							</span>
							<div class="form-line">
								<input class="form-control align-center" name="ks84" value=" {{ $ans->k84 ? $ans->k84 : '' }} " type="text">
							</div>
							<span class="input-group-addon">
								<label for="ks84">ruangan</label>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no85 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">85. Penyediaan Air</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks85" id="ks85a1"  value="Sumur" type="radio" class="radio-col-light-green" @if ($ans->k85 == "Sumur") checked="checked" @endif/>
						<label for="ks85a1">Sumur</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks85" id="ks85a2"  value="Kolam Umum" type="radio" class="radio-col-light-green" @if ($ans->k85 == "Kolam Umum") checked="checked" @endif/>
						<label for="ks85a2">Kolam Umum</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks85" id="ks85a3"  value="Diantar Truk" type="radio" class="radio-col-light-green" @if ($ans->k85 == "Diantar Truk") checked="checked" @endif/>
						<label for="ks85a3">Diantar Truk</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks85" id="ks85a4"  value="Sistem Umum di Luar Ruangan" type="radio" class="radio-col-light-green" @if ($ans->k85 == "Sistem Umum di Luar Ruangan") checked="checked" @endif/>
						<label for="ks85a4">Sistem Umum di Luar Ruangan</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks85" id="ks85a5"  value="Sistem Umum, Mudah dicapai Dalam Ruangan" type="radio" class="radio-col-light-green" @if ($ans->k85 == "Sistem Umum, Mudah dicapai Dalam Ruangan") checked="checked" @endif/>
						<label for="ks85a5">Sistem Umum, Mudah dicapai Dalam Ruangan</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks85" id="ks85a6"  value="Sungai, Saluran Irigasi, Sumber Mata air Alami" type="radio" class="radio-col-light-green" @if ($ans->k85 == "Sungai, Saluran Irigasi, Sumber Mata air Alami") checked="checked" @endif/>
						<label for="ks85a6">Sungai, Saluran Irigasi, Sumber Mata air Alami</label>
					</div>

					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks85" id="ks85a7"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if($ans->k85 !== 'Sumur' && $ans->k85 !== 'Kolam Umum' && $ans->k85 !== 'Diantar Truk' && $ans->k85 !== 'Sistem Umum di Luar Ruangan' && $ans->k85 !== 'Sistem Umum, Mudah dicapai Dalam Ruangan' && $ans->k85 !== 'Sungai, Saluran Irigasi, Sumber Mata air Alami') checked="checked" @endif/>
								<label for="ks85a7">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks85t" name="ks85t" value="@if($ans->k85 !== 'Sumur' && $ans->k85 !== 'Kolam Umum' && $ans->k85 !== 'Diantar Truk' && $ans->k85 !== 'Sistem Umum di Luar Ruangan' && $ans->k85 !== 'Sistem Umum, Mudah dicapai Dalam Ruangan' && $ans->k85 !== 'Sungai, Saluran Irigasi, Sumber Mata air Alami') {{ $ans->k85 }} @endif" type="text" disabled="">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- no86 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">86. Fasilitas sanitasi yang ada di rumah</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks86" id="ks86a1"  value="Sistem Umum, Mudah Dicapai Dalam Ruangan" type="radio" class="radio-col-light-green" @if ($ans->k86 == "Sistem Umum, Mudah Dicapai Dalam Ruangan") checked="checked" @endif/>
						<label for="ks86a1">Sistem Umum, Mudah Dicapai Dalam Ruangan</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks86" id="ks86a2"  value="Sistem Umum, Diluar Ruangan" type="radio" class="radio-col-light-green" @if ($ans->k86 == "Sistem Umum, Diluar Ruangan") checked="checked" @endif/>
						<label for="ks86a2">Sistem Umum, Diluar Ruangan</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks86" id="ks86a3"  value="Septic Tank" type="radio" class="radio-col-light-green" @if ($ans->k86 == "Septic Tank") checked="checked" @endif/>
						<label for="ks86a3">Septic Tank</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks86" id="ks86a4"  value="Sungai, Saluran Irigasi, Kanal" type="radio" class="radio-col-light-green" @if ($ans->k86 == "Sungai, Saluran Irigasi, Kanal") checked="checked" @endif/>
						<label for="ks86a4">Sungai, Saluran Irigasi, Kanal</label>
					</div>

					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks86" id="ks86a5"  value="Tidak Ada Fasilitas Sanitasi" type="radio" class="radio-col-light-green" @if ($ans->k86 == "Tidak Ada Fasilitas Sanitasi") checked="checked" @endif/>
						<label for="ks86a5">Tidak Ada Fasilitas Sanitasi</label>
					</div>

					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks86" id="ks86a9"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if($ans->k86 !== 'Sistem Umum, Mudah Dicapai Dalam Ruangan' && $ans->k86 !== 'Sistem Umum, Diluar Ruangan' && $ans->k86 !== 'Septic Tank' && $ans->k86 !== 'Sungai, Saluran Irigasi, Kanal' && $ans->k86 !== 'Tidak Ada Fasilitas Sanitasi') checked="checked" @endif/>
								<label for="ks86a9">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks86t" name="ks86t" value=" @if($ans->k86 !== 'Sistem Umum, Mudah Dicapai Dalam Ruangan' && $ans->k86 !== 'Sistem Umum, Diluar Ruangan' && $ans->k86 !== 'Septic Tank' && $ans->k86 !== 'Sungai, Saluran Irigasi, Kanal' && $ans->k86 !== 'Tidak Ada Fasilitas Sanitasi') {{ $ans->k86 }} @endif" type="text" disabled="">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- no87 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">87. Bagaimana dengan penerangan di rumah saudara?</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks87" id="ks87a1"  value="Listrik" type="radio" class="radio-col-light-green" @if ($ans->k87 == "Listrik") checked="checked" @endif/>
						<label for="ks87a1">Listrik</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks87" id="ks87a2"  value="Lampu Minyak Tanah" type="radio" class="radio-col-light-green" @if ($ans->k87 == "Lampu Minyak Tanah") checked="checked" @endif/>
						<label for="ks87a2">Lampu Minyak Tanah</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks87" id="ks87a3"  value="Minyak/Lampu Gas" type="radio" class="radio-col-light-green" @if ($ans->k87 == "Minyak/Lampu Gas") checked="checked" @endif/>
						<label for="ks87a3">Minyak/Lampu Gas</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks87" id="ks87a4"  value="Lilin" type="radio" class="radio-col-light-green" @if ($ans->k87 == "Lilin") checked="checked" @endif/>
						<label for="ks87a4">Lilin</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks87" id="ks87a5"  value="Generator" type="radio" class="radio-col-light-green" @if ($ans->k87 == "Generator") checked="checked" @endif/>
						<label for="ks87a5">Generator</label>
					</div>

					<div class="col-md-6" style="margin-bottom: 0">
						<input name="ks87" id="ks87a6"  value="Tanpa Penerangan" type="radio" class="radio-col-light-green" @if ($ans->k87 == "Tanpa Penerangan") checked="checked" @endif/>
						<label for="ks87a6">Tanpa Penerangan</label>
					</div>

					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks87" id="ks87a9"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if($ans->k87 !== 'Listrik' && $ans->k87 !== 'Lampu Minyak Tanah' && $ans->k87 !== 'Minyak/Lampu Gas' && $ans->k87 !== 'Lilin' && $ans->k87 !== 'Generator' && $ans->k87 !== 'Tanpa Penerangan') checked="checked" @endif/>
								<label for="ks87a9">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks87t" name="ks87t" value="@if($ans->k87 !== 'Listrik' && $ans->k87 !== 'Lampu Minyak Tanah' && $ans->k87 !== 'Minyak/Lampu Gas' && $ans->k87 !== 'Lilin' && $ans->k87 !== 'Generator' && $ans->k87 !== 'Tanpa Penerangan') {{ $ans->k87 }} @endif" type="text" disabled="">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


</fieldset>