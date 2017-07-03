<h3 class="font-bold">Riwayat TB Responden</h3>
<fieldset>
	<div class="block-header" id="k1">
		<h2>Riwayat TB Pasien<small>Kuisioner tentang riwayat penyakit TB pasien</small></h2>
	</div>
	<hr>

	{{-- no1 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">1. Apakah saudara sudah pernah didiagnosis oleh TB sebelum ini?</p>
			<div class="answer">
				<input name="ks1" id="ks1a1" value="ya" type="radio" class="radio-col-light-green"/>
				<label for="ks1a1" class="inline">Ya</label>

				<input name="ks1" id="ks1a2" value="tidak" type="radio" class="radio-col-light-green"/>
				<label for="ks1a2" class="inline">Tidak</label>

				<input name="ks1" id="ks1a3" value="" type="radio" class="radio-col-light-green"/>
				<label for="ks1a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no2 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">2. Siapakah yang mendiagnosis saudara dengan TB?</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks2" id="ks2a1"  value="Dokter Puskesmas" type="radio" class="radio-col-light-green"/>
						<label for="ks2a1">Dokter Puskesmas</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks2" id="ks2a2"  value="Dokter Spesialis di BP 4" type="radio" class="radio-col-light-green"/>
						<label for="ks2a2">Dokter Spesialis di BP 4</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks2" id="ks2a3"  value="Dokter Spesialis di RS" type="radio" class="radio-col-light-green"/>
						<label for="ks2a3">Dokter Spesialis di RS</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks2" id="ks2a4"  value="Dokter Spesialis di Prakt. Pribadi" type="radio" class="radio-col-light-green"/>
						<label for="ks2a4">Dokter Spesialis di Prakt. Pribadi</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks2" id="ks2a5"  value="lainya" type="radio" class="radio-col-light-green text-togle"/>
								<label for="ks2a5">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks2t" name="ks2t" value="" disabled="" placeholder="cth: bidan puskesmas" type="text">
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	{{-- no3 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">3. Jika saudara ingat, tanggal/bulan atau tahun berapakah diagnosis itu dibuat?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-6" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks3">Tanggal Diagnosis</label>
							</span>
							<div class="form-line">
								<input class="form-control datepicker align-center" name="ks3" value="" placeholder="thn/bln/tgl" type="text">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	{{-- no4 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">4. Untuk diagnosa tersebut, spesimen apa yang dikumpulkan?</p>
			<div class="answer radio-with-text">
				<input name="ks4" id="ks4a1" value="Sputum" type="radio" class="radio-col-light-green"/>
				<label for="ks4a1" class="inline">Sputum</label>

				<div class="row clearfix">
					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks4" id="ks4a5"  value="lainya" type="radio" class="radio-col-light-green text-togle"/>
								<label for="ks4a5">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks4t" name="ks4t" value="" placeholder="cth: urine" type="text" disabled="">
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	{{-- no5 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">5. Apakah saudara mempunyai hasil pemeriksaan BTA+ dari Puskesmas?</p>
			<div class="answer">
				<input name="ks5" id="ks5a1" value="ya" type="radio" class="radio-col-light-green"/>
				<label for="ks5a1" class="inline">Ya</label>

				<input name="ks5" id="ks5a2" value="tidak" type="radio" class="radio-col-light-green"/>
				<label for="ks5a2" class="inline">Tidak</label>

				<input name="ks5" id="ks5a3" value="" type="radio" class="radio-col-light-green"/>
				<label for="ks5a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no6 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">6. Apakah saudara mempunyai hasil pemeriksaan BTA+ dari Hasil Penelitian Laboratorium saat itu?</p>
			<div class="answer">
				<input name="ks6" id="ks6a1" value="ya" type="radio" class="radio-col-light-green"/>
				<label for="ks6a1" class="inline">Ya</label>

				<input name="ks6" id="ks6a2" value="tidak" type="radio" class="radio-col-light-green"/>
				<label for="ks6a2" class="inline">Tidak</label>

				<input name="ks6" id="ks6a3" value="" type="radio" class="radio-col-light-green"/>
				<label for="ks6a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no7 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">7. Apakah saudara mempunyai hasil pemeriksaan Kultur+ dari Hasil Penelitian Laboratorium saat itu?</p>
			<div class="answer">
				<input name="ks7" id="ks7a1" value="ya" type="radio" class="radio-col-light-green"/>
				<label for="ks7a1" class="inline">Ya</label>

				<input name="ks7" id="ks7a2" value="tidak" type="radio" class="radio-col-light-green"/>
				<label for="ks7a2" class="inline">Tidak</label>

				<input name="ks7" id="ks7a3" value="" type="radio" class="radio-col-light-green"/>
				<label for="ks7a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no8 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">8. Apakah saudara mempunyai hasil pemeriksaan rontgen foto Thorak Positif pada saat itu?</p>
			<div class="answer">
				<input name="ks8" id="ks8a1" value="ya" type="radio" class="radio-col-light-green"/>
				<label for="ks8a1" class="inline">Ya</label>

				<input name="ks8" id="ks8a2" value="tidak" type="radio" class="radio-col-light-green"/>
				<label for="ks8a2" class="inline">Tidak</label>

				<input name="ks8" id="ks8a3" value="" type="radio" class="radio-col-light-green"/>
				<label for="ks8a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no9 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">9. Apakah saudara sudah mendapatkan pengobatan TB?</p>
			<div class="answer">
				<input name="ks9" id="ks9a1" value="ya" type="radio" class="radio-col-light-green"/>
				<label for="ks9a1" class="inline">Ya</label>

				<input name="ks9" id="ks9a2" value="tidak" type="radio" class="radio-col-light-green"/>
				<label for="ks9a2" class="inline">Tidak</label>

				<input name="ks9" id="ks9a3" value="" type="radio" class="radio-col-light-green"/>
				<label for="ks9a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no10 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">10. Tahukah saudara jenis/kategori pengobatan yang didapatkan?</p>
			<div class="answer">
				<input name="ks10" id="ks10a1" value="ya" type="radio" class="radio-col-light-green"/>
				<label for="ks10a1" class="inline">Ya</label>

				<input name="ks10" id="ks10a2" value="tidak" type="radio" class="radio-col-light-green"/>
				<label for="ks10a2" class="inline">Tidak</label>

				<input name="ks10" id="ks10a3" value="" type="radio" class="radio-col-light-green"/>
				<label for="ks10a3" class="inline">tidak dijawab</label>
			</div>
		</div>
	</div>

	{{-- no11 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">11. Jika ya, apa jenis/kategori pengobatan saudara?</p>
			<div class="answer radio-with-text">

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks11" id="ks11a1"  value="Kategori 1" type="radio" class="radio-col-light-green"/>
						<label for="ks11a1">Kategori 1</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks11" id="ks11a2"  value="Kategori 2" type="radio" class="radio-col-light-green"/>
						<label for="ks11a2">Kategori 2</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks11" id="ks11a3"  value="Dokter Spesialis di RS" type="radio" class="radio-col-light-green"/>
						<label for="ks11a3">Dokter Spesialis di RS</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks11" id="ks11a4"  value="Dokter Spesialis di Prakt. Pribadi" type="radio" class="radio-col-light-green"/>
						<label for="ks11a4">Dokter Spesialis di Prakt. Pribadi</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks11" id="ks11a5"  value="lainya" type="radio" class="radio-col-light-green text-togle"/>
								<label for="ks11a5">Pengobatan khusus, gambarkan, sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks11t" name="ks11t" value="" disabled="" placeholder="cth: operasi paru" type="text">
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks11" id="ks11a6"  value="Data tidak ada" type="radio" class="radio-col-light-green"/>
						<label for="ks11a6">Data tidak ada</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks11" id="ks11a7"  value="tidak dijawab" type="radio" class="radio-col-light-green"/>
						<label for="ks11a7">tidak dijawab</label>
					</div>
				</div>

			</div>
		</div>
	</div>

	{{-- no13 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">13. Tanggal berapa pengobatan tersebut?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks13">Tanggal Mulai Pengobatan</label>
							</span>
							<div class="form-line">
								<input class="form-control datepicker align-center" name="ks13" value="" placeholder="thn/bln/tgl" type="text">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no14 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">14. Tanggal berapa saudara berhenti mendapatkan pengobatan?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="k14">Tanggal Berhenti Pengobatan</label>
							</span>
							<div class="form-line">
								<input class="form-control datepicker align-center" name="k14" value="" placeholder="thn/bln/tgl" type="text">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</fieldset>