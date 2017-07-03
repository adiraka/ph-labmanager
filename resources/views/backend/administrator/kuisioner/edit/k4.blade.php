<h3>Kebiasan Merokok</h3>
<fieldset>
	<div class="block-header" id="k3">
		<h2>Kebiasan Merokok <small>Kuisioner tentang kebiasan merokok pasien</small></h2>
	</div>
	<hr>

	{{-- no32 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">32. Apakah saudara merokok paling sedikit 100 batang rokok seumur hidup?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks32" id="ks32a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k32 == 'ya') checked="checked" @endif/>
						<label for="ks32a1" class="inline">Ya</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks32" id="ks32a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k32 == 'tidak') checked="checked" @endif/>
						<label for="ks32a2" class="inline">Tidak, lanjut ke no 42</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks32" id="ks32a3" value="" type="radio" class="radio-col-light-green" @if ($ans->k32 == '') checked="checked" @endif/>
						<label for="ks32a3" class="inline">tidak dijawab, lanjut ke no 42</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no33 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">33. Apakah saudara merokok dengan teratur?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks33" id="ks33a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k33 == 'ya') checked="checked" @endif/>
						<label for="ks33a1" class="inline">Ya</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks33" id="ks33a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k33 == 'tidak') checked="checked" @endif/>
						<label for="ks33a2" class="inline">Tidak, lanjut ke no 36</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks33" id="ks33a3" value="" type="radio" class="radio-col-light-green" @if ($ans->k33 == '') checked="checked" @endif/>
						<label for="ks33a3" class="inline">tidak dijawab, lanjut ke no 36</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no34 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">34. Apakah ada waktu tertentu merokok, seperti setelah makan, pagi hari, dll?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks34" id="ks34a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k34 == 'ya') checked="checked" @endif/>
						<label for="ks34a1" class="inline">Ya</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks34" id="ks34a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k34 == 'tidak') checked="checked" @endif/>
						<label for="ks34a2" class="inline">Tidak</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks34" id="ks34a3" value="" type="radio" class="radio-col-light-green" @if ($ans->k34 == '') checked="checked" @endif/>
						<label for="ks34a3" class="inline">tidak dijawab</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no35 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">35. Umur berapa saudara mulai merokok dengan teratur?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-7" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks35">Umur Pasien Mulai merokok</label>
							</span>
							<div class="form-line">
								<input class="form-control align-center" name="ks35" value=" {{ $ans->k35 ? $ans->k35 : '' }} " placeholder="umur" type="text">
							</div>
							<span class="input-group-addon">
								<label for="ks35">thn</label>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no36 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">36. Apakah saat ini saudara masih merokok?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks36" id="ks36a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k36 == 'ya') checked="checked" @endif/>
						<label for="ks36a1" class="inline">Ya</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks36" id="ks36a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k36 == 'tidak') checked="checked" @endif/>
						<label for="ks36a2" class="inline">Tidak, lanjut ke no 40</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks36" id="ks36a3" value="tidak tahu" type="radio" class="radio-col-light-green" @if ($ans->k36 == 'tidak tahu') checked="checked" @endif/>
						<label for="ks36a3" class="inline">tidak tahu, lanjut ke no 40</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks36" id="ks36a4" value="" type="radio" class="radio-col-light-green" @if ($ans->k36 == '') checked="checked" @endif/>
						<label for="ks36a4" class="inline">tidak dijawab, lanjut ke no 40</label>
					</div>
				</div>

			</div>
		</div>
	</div>

	{{-- no37 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">37. Berapa batang rata-rata jumlah rokok yang saudara hisap setiap hari?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-5" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks37">jumlah rokok</label>
							</span>
							<div class="form-line">
								<input class="form-control align-center" name="ks37" value=" {{ $ans->k37 ? $ans->k37 : '' }} " placeholder="jumlah" type="text">
							</div>
							<span class="input-group-addon">
								<label for="ks37">Batang</label>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no38 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">38. Sudah berapa lama saudara merokok seperti ini?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks38" id="ks38a1" value="Kurang dari 1 Thn" type="radio" class="radio-col-light-green" @if ($ans->k38 == 'Kurang dari 1 Thn') checked="checked" @endif/>
						<label for="ks38a1" class="inline">Kurang dari 1 Thn</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks38" id="ks38a2" value="Lebih dari 1 Thn" type="radio" class="radio-col-light-green" @if ($ans->k38 == 'Lebih dari 1 Thn') checked="checked" @endif/>
						<label for="ks38a2" class="inline">Lebih dari 1 Thn</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks38" id="ks38a3" value="" type="radio" class="radio-col-light-green" @if ($ans->k38 == '') checked="checked" @endif/>
						<label for="ks38a3" class="inline">tidak dijawab</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no39 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">39. Jika lebih dari 1 tahun, sudah berapa lama anda merokok?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-5" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks39">lama merokok</label>
							</span>
							<div class="form-line">
								<input class="form-control align-center" name="ks39" value=" {{ $ans->k39 ? $ans->k39 : '' }} " type="text">
							</div>
							<span class="input-group-addon">
								<label for="ks39">Thn</label>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no40 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">40. Sudah berapa lama saudara berhenti merokok?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-6" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks40">lama berhenti merokok</label>
							</span>
							<div class="form-line">
								<input class="form-control align-center" name="ks40" value=" {{ $ans->k40 ? $ans->k40 : '' }} " type="text">
							</div>
							<span class="input-group-addon">
								<label for="ks40">Thn</label>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no41 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">41. Saat itu rerata berapa batang rokok yang saudara hisap setiap hari?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-5" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks41">jumlah rokok</label>
							</span>
							<div class="form-line">
								<input class="form-control align-center" name="ks41" value=" {{ $ans->k41 ? $ans->k41 : '' }} " type="text">
							</div>
							<span class="input-group-addon">
								<label for="ks41">Batang</label>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



</fieldset>