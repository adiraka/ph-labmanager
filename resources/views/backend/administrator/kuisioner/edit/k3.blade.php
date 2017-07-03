<h3>Riwayat Medis</h3>
<fieldset>
	<div class="block-header" id="k2">
		<h2>Riwayat Medis<small>Kuisioner tentang riwayat penyakit pasien selain TB</small></h2>
	</div>
	<hr>

	{{-- no15 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">15. Pernahkah saudara didiagnosa dengan penyakit jantung?</p>
			<div class="answer">
				<input name="ks15" id="ks15a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k15 == 'ya') checked="checked" @endif />
				<label for="ks15a1" class="inline">Ya</label>

				<input name="ks15" id="ks15a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k15 == 'tidak') checked="checked" @endif />
				<label for="ks15a2" class="inline">Tidak</label>

				<input name="ks15" id="ks15a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k15 == 'Tidak Tahu') checked="checked" @endif />
				<label for="ks15a3" class="inline">Tidak Tahu</label>

				<input name="ks15" id="ks15a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k15 == '') checked="checked" @endif/>
				<label for="ks15a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no16 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">16. Pernahkah saudara di daignosa dengan tekanan darah tinggi?</p>
			<div class="answer">
				<input name="ks16" id="ks16a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k16 == 'ya') checked="checked" @endif/>
				<label for="ks16a1" class="inline">Ya</label>

				<input name="ks16" id="ks16a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k16 == 'tidak') checked="checked" @endif />
				<label for="ks16a2" class="inline">Tidak</label>

				<input name="ks16" id="ks16a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k16 == 'Tidak Tahu') checked="checked" @endif />
				<label for="ks16a3" class="inline">Tidak Tahu</label>

				<input name="ks16" id="ks16a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k16 == '') checked="checked" @endif/>
				<label for="ks16a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no17 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">17. Pernahkah saudara di diagnosa dengan asthma?</p>
			<div class="answer">
				<input name="ks17" id="ks17a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k17 == 'ya') checked="checked" @endif/>
				<label for="ks17a1" class="inline">Ya</label>

				<input name="ks17" id="ks17a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k17 == 'tidak') checked="checked" @endif/>
				<label for="ks17a2" class="inline">Tidak</label>

				<input name="ks17" id="ks17a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k17 == 'Tidak Tahu') checked="checked" @endif/>
				<label for="ks17a3" class="inline">Tidak Tahu</label>

				<input name="ks17" id="ks17a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k17 == '') checked="checked" @endif/>
				<label for="ks17a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no18 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">18. Pernahkah saudara di diagnosa dengan penyakit ginjal?</p>
			<div class="answer">
				<input name="ks18" id="ks18a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k18 == 'ya') checked="checked" @endif/>
				<label for="ks18a1" class="inline">Ya</label>

				<input name="ks18" id="ks18a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k18 == 'tidak') checked="checked" @endif/>
				<label for="ks18a2" class="inline">Tidak</label>

				<input name="ks18" id="ks18a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k18 == 'Tidak Tahu') checked="checked" @endif/>
				<label for="ks18a3" class="inline">Tidak Tahu</label>

				<input name="ks18" id="ks18a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k18 == '') checked="checked" @endif/>
				<label for="ks18a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no19 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">19. Pernahkah saudara di diagnosa dengan diabetes/sakit gula?</p>
			<div class="answer">
				<input name="ks19" id="ks19a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k19 == 'ya') checked="checked" @endif />
				<label for="ks19a1" class="inline">Ya</label>

				<input name="ks19" id="ks19a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k19 == 'tidak') checked="checked" @endif />
				<label for="ks19a2" class="inline">Tidak</label>

				<input name="ks19" id="ks19a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k19 == 'Tidak Tahu') checked="checked" @endif />
				<label for="ks19a3" class="inline">Tidak Tahu</label>

				<input name="ks19" id="ks19a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k19 == '') checked="checked" @endif />
				<label for="ks19a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no20 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">20. Apakah tipe pengobatan yang saudara terima untuk diabetes/sakit gula?</p>
			<div class="answer radio-with-text">

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks20" id="ks20a1"  value="Pil Saja" type="radio" class="radio-col-light-green" @if ($ans->k20 == 'Pil Saja') checked="checked" @endif />
						<label for="ks20a1">Pil Saja</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks20" id="ks20a2"  value="Hanya Injeksi Insulin" type="radio" class="radio-col-light-green" @if ($ans->k20 == 'Hanya Injeksi Insulin') checked="checked" @endif />
						<label for="ks20a2">Hanya Injeksi Insulin</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks20" id="ks20a3"  value="Keduanya" type="radio" class="radio-col-light-green" @if ($ans->k20 == 'Keduanya') checked="checked" @endif />
						<label for="ks20a3">Keduanya</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks20" id="ks20a4"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if ($ans->k20 !== 'Pil Saja' && $ans->k20 !== 'Hanya Injeksi Insulin' && $ans->k20 !== 'Keduanya' && $ans->k20 !== 'Tidak ada' && $ans->k20 !== 'Tidak dijawab') checked="checked" @endif/>
								<label for="ks20a4">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks20t" name="ks20t" value="@if ($ans->k20 !== 'Pil Saja' && $ans->k20 !== 'Hanya Injeksi Insulin' && $ans->k20 !== 'Keduanya' && $ans->k20 !== 'Tidak ada' && $ans->k20 !== 'Tidak dijawab') {{ $ans->k20 }} @endif" disabled="" placeholder="cth: transplantasi pankreas" type="text">
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks20" id="ks20a5"  value="Tidak ada" type="radio" class="radio-col-light-green" @if ($ans->k20 == 'Tidak ada') checked="checked" @endif />
						<label for="ks20a5">Tidak ada</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks20" id="ks20a6"  value="tidak dijawab" type="radio" class="radio-col-light-green" @if ($ans->k20 == 'tidak dijawab') checked="checked" @endif />
						<label for="ks20a6">tidak dijawab</label>
					</div>
				</div>

			</div>
		</div>
	</div>

	{{-- no21 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">21. Apakah saudara terinfeksi HIV?</p>
			<div class="answer">
				<input name="ks21" id="ks21a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k21 == 'ya') checked="checked" @endif/>
				<label for="ks21a1" class="inline">Ya</label>

				<input name="ks21" id="ks21a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k21 == 'tidak') checked="checked" @endif/>
				<label for="ks21a2" class="inline">Tidak</label>

				<input name="ks21" id="ks21a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k21 == 'Tidak Tahu') checked="checked" @endif/>
				<label for="ks21a3" class="inline">Tidak Tahu</label>

				<input name="ks21" id="ks21a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k21 == '') checked="checked" @endif/>
				<label for="ks21a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no22 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">22. Apakah saudara mendapatkan pengobata HIV?</p>
			<div class="answer">
				<input name="ks22" id="ks22a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k22 == 'ya') checked="checked" @endif/>
				<label for="ks22a1" class="inline">Ya</label>

				<input name="ks22" id="ks22a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k22 == 'tidak') checked="checked" @endif/>
				<label for="ks22a2" class="inline">Tidak</label>

				<input name="ks22" id="ks22a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k22 == 'Tidak Tahu') checked="checked" @endif/>
				<label for="ks22a3" class="inline">Tidak Tahu</label>

				<input name="ks22" id="ks22a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k22 == '') checked="checked" @endif/>
				<label for="ks22a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no23 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">23. Pernahkah dokter mendiagnosa saudara dengan penyakit kronis lainnya? (Seperti Asthma, DM/Gula, Penyakit Hati, Ginjal, dll)</p>
			<div class="answer">
				<input name="ks23" id="ks23a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k23 == 'ya') checked="checked" @endif/>
				<label for="ks23a1" class="inline">Ya</label>

				<input name="ks23" id="ks23a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k23 == 'tidak') checked="checked" @endif/>
				<label for="ks23a2" class="inline">Tidak</label>

				<input name="ks23" id="ks23a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k23 == 'Tidak Tahu') checked="checked" @endif/>
				<label for="ks23a3" class="inline">Tidak Tahu</label>

				<input name="ks23" id="ks23a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k23 == '') checked="checked" @endif/>
				<label for="ks23a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no24 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">24. Jika ya, sebutkan nama penyakit tersebut?</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks24" id="ks24a1"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if ( $ans->k24 !== 'lupa' && $ans->k24 !== 'Tidak dijawab') checked="checked" @endif/>
								<label for="ks24a1">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks24t" name="ks24t" value="@if ( $ans->k24 !== 'lupa' && $ans->k24 !== 'Tidak dijawab') {{ $ans->k24 }} @endif" placeholder="cth: jantung" type="text" disabled="">
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks24" id="ks24a2" value="lupa" type="radio" class="radio-col-light-green" @if ($ans->k24 == 'lupa') checked="checked" @endif/>
						<label for="ks24a2" class="inline">lupa</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks24" id="ks24a3" value="tidak dijawab" type="radio" class="radio-col-light-green" @if ($ans->k24 == 'tidak dijawab') checked="checked" @endif/>
						<label for="ks24a3" class="inline">tidak dijawab</label>
					</div>
				</div>

			</div>
		</div>
	</div>

	{{-- no25 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">25. Dalam dua tahun terakhir, pernahkah saudara dirawat selama 8 jam atau lebih?</p>
			<div class="answer">
				<input name="ks25" id="ks25a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k25 == 'ya') checked="checked" @endif />
				<label for="ks25a1" class="inline">Ya</label>

				<input name="ks25" id="ks25a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k25 == 'tidak') checked="checked" @endif />
				<label for="ks25a2" class="inline">Tidak</label>

				<input name="ks25" id="ks25a3" value="" type="radio" class="radio-col-light-green" @if ($ans->k25 == '') checked="checked" @endif />
				<label for="ks25a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no26 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">26. Dalam dua tahun terakhir, berapa banyak waktu yang dihabiskan untuk perawatan?</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks26" id="ks26a1"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if ($ans->k26 !== 'lupa' && $ans->k26 !== 'tidak dijawab') checked="checked" @endif/>
								<label for="ks26a1">Ada, berapa lama?</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks26t" name="ks26t" value="@if ($ans->k26 !== 'lupa' && $ans->k26 !== 'tidak dijawab') {{ $ans->k26 }} @endif" placeholder="cth: 2bln" type="text" disabled="">
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks26" id="ks26a2" value="lupa" type="radio" class="radio-col-light-green" @if ($ans->k26 == 'lupa') checked="checked" @endif/>
						<label for="ks26a2" class="inline">lupa</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks26" id="ks26a3" value="tidak dijawab" type="radio" class="radio-col-light-green" @if ($ans->k26 == 'tidak dijawab') checked="checked" @endif/>
						<label for="ks26a3" class="inline">tidak dijawab</label>
					</div>
				</div>

			</div>
		</div>
	</div>

	{{-- no27 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">27. Apakah saudara sudah menerima imunisasi BCG?</p>
			<div class="answer">
				<input name="ks27" id="ks27a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k27 == 'ya') checked="checked" @endif/>
				<label for="ks27a1" class="inline">Ya</label>

				<input name="ks27" id="ks27a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k27 == 'tidak') checked="checked" @endif/>
				<label for="ks27a2" class="inline">Tidak</label>

				<input name="ks27" id="ks27a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k27 == 'Tidak Tahu') checked="checked" @endif/>
				<label for="ks27a3" class="inline">Tidak Tahu</label>

				<input name="ks27" id="ks27a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k27 == '') checked="checked" @endif/>
				<label for="ks27a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no28 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">28. Apakah ada bekas imunisasi BCG dalam bentuk scar/jaringan parut?</p>
			<div class="answer">
				<input name="ks28" id="ks28a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k28 == 'ya') checked="checked" @endif/>
				<label for="ks28a1" class="inline">Ya</label>

				<input name="ks28" id="ks28a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k28 == 'tidak') checked="checked" @endif/>
				<label for="ks28a2" class="inline">Tidak</label>

				<input name="ks28" id="ks28a3" value="" type="radio" class="radio-col-light-green" @if ($ans->k28 == '') checked="checked" @endif/>
				<label for="ks28a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no29 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">29. Apakah saudari hamil?</p>
			<div class="answer">
				<input name="ks29" id="ks29a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k29 == 'ya') checked="checked" @endif/>
				<label for="ks29a1" class="inline">Ya</label>

				<input name="ks29" id="ks29a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k29 == 'tidak') checked="checked" @endif/>
				<label for="ks29a2" class="inline">Tidak</label>

				<input name="ks29" id="ks29a3" value="" type="radio" class="radio-col-light-green" @if ($ans->k29 == '') checked="checked" @endif/>
				<label for="ks29a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no30 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">30. Apakah umur kehamilannya tiga bulan / lebih?</p>
			<div class="answer">
				<input name="ks30" id="ks30a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k30 == 'ya') checked="checked" @endif/>
				<label for="ks30a1" class="inline">Ya</label>

				<input name="ks30" id="ks30a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k30 == 'tidak') checked="checked" @endif/>
				<label for="ks30a2" class="inline">Tidak</label>

				<input name="ks30" id="ks30a3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k30 == 'Tidak Tahu') checked="checked" @endif/>
				<label for="ks30a3" class="inline">Tidak Tahu</label>

				<input name="ks30" id="ks30a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k30 == '') checked="checked" @endif/>
				<label for="ks30a4" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">31. Apakah saudara mendapatkan obat-obatan berikut dalam 2 bulan terakhir? (Perlihatkan contoh kemasan obat atau minta kemasan yang dimiliki responden)</p>
			<div class="answer">

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>1. Ciprofloxacin</p>
						<div class="answer">
							<input name="ks31a" id="ks31aa1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31a == 'ya') checked="checked" @endif/>
							<label for="ks31aa1" class="inline">Ya</label>

							<input name="ks31a" id="ks31aa2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31a == 'tidak') checked="checked" @endif/>
							<label for="ks31aa2" class="inline">Tidak</label>

							<input name="ks31a" id="ks31aa3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31a == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31aa3" class="inline">Tidak Tahu</label>

							<input name="ks31a" id="ks31aa4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31a == '') checked="checked" @endif/>
							<label for="ks31aa4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>2. Ofloxacin</p>
						<div class="answer">
							<input name="ks31b" id="ks31ba1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31b == 'ya') checked="checked" @endif/>
							<label for="ks31ba1" class="inline">Ya</label>

							<input name="ks31b" id="ks31ba2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31b == 'tidak') checked="checked" @endif/>
							<label for="ks31ba2" class="inline">Tidak</label>

							<input name="ks31b" id="ks31ba3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31b == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31ba3" class="inline">Tidak Tahu</label>

							<input name="ks31b" id="ks31ba4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31b == '') checked="checked" @endif/>
							<label for="ks31ba4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>3. Cefadroxil</p>
						<div class="answer">
							<input name="ks31c" id="ks31ca1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31c == 'ya') checked="checked" @endif/>
							<label for="ks31ca1" class="inline">Ya</label>

							<input name="ks31c" id="ks31ca2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31c == 'tidak') checked="checked" @endif/>
							<label for="ks31ca2" class="inline">Tidak</label>

							<input name="ks31c" id="ks31ca3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31c == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31ca3" class="inline">Tidak Tahu</label>

							<input name="ks31c" id="ks31ca4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31c == '') checked="checked" @endif/>
							<label for="ks31ca4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>4. Levofloxacin</p>
						<div class="answer">
							<input name="ks31d" id="ks31da1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31d == 'ya') checked="checked" @endif/>
							<label for="ks31da1" class="inline">Ya</label>

							<input name="ks31d" id="ks31da2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31d == 'tidak') checked="checked" @endif/>
							<label for="ks31da2" class="inline">Tidak</label>

							<input name="ks31d" id="ks31da3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31d == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31da3" class="inline">Tidak Tahu</label>

							<input name="ks31d" id="ks31da4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31d == '') checked="checked" @endif/>
							<label for="ks31da4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>5. Moxifloxacin</p>
						<div class="answer">
							<input name="ks31e" id="ks31ea1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31e == 'ya') checked="checked" @endif/>
							<label for="ks31ea1" class="inline">Ya</label>

							<input name="ks31e" id="ks31ea2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31e == 'tidak') checked="checked" @endif/>
							<label for="ks31ea2" class="inline">Tidak</label>

							<input name="ks31e" id="ks31ea3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31e == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31ea3" class="inline">Tidak Tahu</label>

							<input name="ks31e" id="ks31ea4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31e == '') checked="checked" @endif/>
							<label for="ks31ea4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>6. Steroid, termasuk Prednison</p>
						<div class="answer">
							<input name="ks31f" id="ks31fa1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31f == 'ya') checked="checked" @endif/>
							<label for="ks31fa1" class="inline">Ya</label>

							<input name="ks31f" id="ks31fa2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31f == 'tidak') checked="checked" @endif/>
							<label for="ks31fa2" class="inline">Tidak</label>

							<input name="ks31f" id="ks31fa3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31f == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31fa3" class="inline">Tidak Tahu</label>

							<input name="ks31f" id="ks31fa4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31f == '') checked="checked" @endif/>
							<label for="ks31fa4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>7. Kemoterapi Kanker</p>
						<div class="answer">
							<input name="ks31g" id="ks31ga1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31g == 'ya') checked="checked" @endif/>
							<label for="ks31ga1" class="inline">Ya</label>

							<input name="ks31g" id="ks31ga2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31g == 'tidak') checked="checked" @endif/>
							<label for="ks31ga2" class="inline">Tidak</label>

							<input name="ks31g" id="ks31ga3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31g == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31ga3" class="inline">Tidak Tahu</label>

							<input name="ks31g" id="ks31ga4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31g == '') checked="checked" @endif/>
							<label for="ks31ga4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>8. Obat pencegah reaksi penolakan pada transplantasi</p>
						<div class="answer">
							<input name="ks31h" id="ks31ha1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31h == 'ya') checked="checked" @endif/>
							<label for="ks31ha1" class="inline">Ya</label>

							<input name="ks31h" id="ks31ha2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31h == 'tidak') checked="checked" @endif/>
							<label for="ks31ha2" class="inline">Tidak</label>

							<input name="ks31h" id="ks31ha3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31h == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31ha3" class="inline">Tidak Tahu</label>

							<input name="ks31h" id="ks31ha4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31h == '') checked="checked" @endif/>
							<label for="ks31ha4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>9. Trimethoprim</p>
						<div class="answer">
							<input name="ks31i" id="ks31ia1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31i == 'ya') checked="checked" @endif/>
							<label for="ks31ia1" class="inline">Ya</label>

							<input name="ks31i" id="ks31ia2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31i == 'tidak') checked="checked" @endif/>
							<label for="ks31ia2" class="inline">Tidak</label>

							<input name="ks31i" id="ks31ia3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31i == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31ia3" class="inline">Tidak Tahu</label>

							<input name="ks31i" id="ks31ia4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31i == '') checked="checked" @endif/>
							<label for="ks31ia4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>10. Cotrimoxazole</p>
						<div class="answer">
							<input name="ks31j" id="ks31ja1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31j == 'ya') checked="checked" @endif/>
							<label for="ks31ja1" class="inline">Ya</label>

							<input name="ks31j" id="ks31ja2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31j == 'tidak') checked="checked" @endif/>
							<label for="ks31ja2" class="inline">Tidak</label>

							<input name="ks31j" id="ks31ja3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31j == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31ja3" class="inline">Tidak Tahu</label>

							<input name="ks31j" id="ks31ja4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31j == '') checked="checked" @endif/>
							<label for="ks31ja4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

				<div class="row clearfix p-l-25">
					<div class="col-md-12 m-t-15">
						<p>11. Isoniazid</p>
						<div class="answer">
							<input name="ks31k" id="ks31ka1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k31k == 'ya') checked="checked" @endif/>
							<label for="ks31ka1" class="inline">Ya</label>

							<input name="ks31k" id="ks31ka2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k31k == 'tidak') checked="checked" @endif/>
							<label for="ks31ka2" class="inline">Tidak</label>

							<input name="ks31k" id="ks31ka3" value="Tidak Tahu" type="radio" class="radio-col-light-green" @if ($ans->k31k == 'Tidak Tahu') checked="checked" @endif/>
							<label for="ks31ka3" class="inline">Tidak Tahu</label>

							<input name="ks31k" id="ks31ka4" value="" type="radio" class="radio-col-light-green" @if ($ans->k31k == '') checked="checked" @endif/>
							<label for="ks31ka4" class="inline">tidak dijawab</label>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</fieldset>