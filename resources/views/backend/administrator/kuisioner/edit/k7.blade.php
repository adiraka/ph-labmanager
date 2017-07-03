<h3>Konsumsi Bahan Lain</h3>
<fieldset>
	<div class="block-header">
		<h2>Konsumsi Bahan Lain <small>Kuisioner tentang kebiasan pasien mengkonsumsi bahan lainnya</small></h2>
	</div>
	<hr>

	{{-- no50a --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">50a. Apakah saudara pernah mengkonsumsi Narkoba dan Psikotropika?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50a" id="ks50aa1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k50a == "ya") checked="checked" @endif/>
						<label for="ks50aa1" class="inline">Ya</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50a" id="ks50aa2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k50a == "tidak") checked="checked" @endif/>
						<label for="ks50aa2" class="inline">Tidak, lanjut ke no 51</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50a" id="ks50aa3" value="" type="radio" class="radio-col-light-green" @if ($ans->k50a == "") checked="checked" @endif/>
						<label for="ks50aa3" class="inline">tidak dijawab</label>
					</div>
				</div>

			</div>
		</div>
	</div>

	{{-- no50b --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">50b. Apa jenis narkoba yang saudara konsumsi?</p>
			<div class="answer radio-with-text">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50b" id="ks50ba1"  value="Marijuana" type="radio" class="radio-col-light-green" @if ($ans->k50b == "Marijuana") checked="checked" @endif/>
						<label for="ks50ba1">Marijuana</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50b" id="ks50ba2"  value="Kokain" type="radio" class="radio-col-light-green" @if ($ans->k50b == "Kokain") checked="checked" @endif/>
						<label for="ks50ba2">Kokain</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50b" id="ks50ba3"  value="Heroin" type="radio" class="radio-col-light-green" @if ($ans->k50b == "Heroin") checked="checked" @endif/>
						<label for="ks50ba3">Heroin</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50b" id="ks50ba4"  value="Ekstasi" type="radio" class="radio-col-light-green" @if ($ans->k50b == "Ekstasi") checked="checked" @endif/>
						<label for="ks50ba4">Ekstasi</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50b" id="ks50ba5"  value="Shabu" type="radio" class="radio-col-light-green" @if ($ans->k50b == "Shabu") checked="checked" @endif/>
						<label for="ks50ba5">Shabu</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-8" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<input name="ks50b" id="ks50ba6"  value="lainya" type="radio" class="radio-col-light-green text-togle" @if($ans->k50b !== 'Marijuana' && $ans->k50b !== 'Kokain' && $ans->k50b !== 'Heroin' && $ans->k50b !== 'Ekstasi' && $ans->k50b !== 'Shabu' && $ans->k50b !== 'tidak dijawab')  checked="checked" @endif/>
								<label for="ks50ba6">Lainya, Sebutkan</label>
							</span>
							<div class="form-line">
								<input class="form-control" id="ks50bt" name="ks50bt" value="@if($ans->k50b !== 'Marijuana' && $ans->k50b !== 'Kokain' && $ans->k50b !== 'Heroin' && $ans->k50b !== 'Ekstasi' && $ans->k50b !== 'Shabu' && $ans->k50b !== 'tidak dijawab') {{ $ans->k50b }} @endif" type="text" disabled="">
							</div>
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50b" id="ks50ba7"  value="tidak dijawab" type="radio" class="radio-col-light-green" @if ($ans->k50b == "tidak dijawab") checked="checked" @endif/>
						<label for="ks50ba7">tidak dijawab</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no50c --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">50c. Berapa kali dalam 5 tahun terakhir ini saudara mengkonsumsi bahan tersebut?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50c" id="ks50ca1"  value="kurang dari 5 kali" type="radio" class="radio-col-light-green" @if ($ans->k50c == "kurang dari 5 kali") checked="checked" @endif/>
						<label for="ks50ca1">kurang dari 5 kali</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50c" id="ks50ca2"  value="5 s/d 20 kali" type="radio" class="radio-col-light-green" @if ($ans->k50c == "5 s/d 20 kali") checked="checked" @endif/>
						<label for="ks50ca2">5 s/d 20 kali</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50c" id="ks50ca3"  value="lebih dari 20 kali" type="radio" class="radio-col-light-green" @if ($ans->k50c == "lebih dari 20 kali") checked="checked" @endif/>
						<label for="ks50ca3">lebih dari 20 kali</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50c" id="ks50ca4"  value="tidak pernah" type="radio" class="radio-col-light-green" @if ($ans->k50c == "tidak pernah") checked="checked" @endif/>
						<label for="ks50ca4">tidak pernah</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50c" id="ks50ca5"  value="tidak tahu" type="radio" class="radio-col-light-green" @if ($ans->k50c == "tidak tahu") checked="checked" @endif/>
						<label for="ks50ca5">tidak tahu</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks50c" id="ks50ca6"  value="tidak dijawab" type="radio" class="radio-col-light-green" @if ($ans->k50c == "tidak dijawab") checked="checked" @endif/>
						<label for="ks50ca6">tidak dijawab</label>
					</div>
				</div>
			</div>
		</div>
	</div>

</fieldset>