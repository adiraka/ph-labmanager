<h3>Paparan Rokok Dirumah</h3>
<fieldset>
	<div class="block-header">
		<h2>Paparan Rokok Dirumah <small>Kuisioner tentang paparan asap rokok pasien</small></h2>
	</div>
	<hr>

	{{-- no42 --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">42. Apakah ada orang/anggota keluarga yang merokok di dalam rumah?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks42" id="ks42a1" value="ya" type="radio" class="radio-col-light-green" @if ($ans->k42 == "ya") checked="checked" @endif/>
						<label for="ks42a1" class="inline">Ya</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks42" id="ks42a2" value="tidak" type="radio" class="radio-col-light-green" @if ($ans->k42 == "tidak") checked="checked" @endif/>
						<label for="ks42a2" class="inline">Tidak</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks42" id="ks42a3" value="" type="radio" class="radio-col-light-green" @if ($ans->k42 == "") checked="checked" @endif/>
						<label for="ks42a3" class="inline">tidak dijawab</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no43a --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">43a. Berapa orang yang merokok dalam rumah saudara?</p>
			<div class="answer">

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks43a" id="ks43aa1" value="kurang dari 3 Org" type="radio" class="radio-col-light-green" @if ($ans->k43a == "kurang dari 3 Org") checked="checked" @endif/>
						<label for="ks43aa1" class="inline">kurang dari 3 Org</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks43a" id="ks43aa2" value="lebih dari 3 Org" type="radio" class="radio-col-light-green" @if ($ans->k43a == "lebih dari 3 Org") checked="checked" @endif/>
						<label for="ks43aa2" class="inline">lebih dari 3 Org</label>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-12" style="margin-bottom: 0">
						<input name="ks43a" id="ks43a3" value="" type="radio" class="radio-col-light-green" @if ($ans->k43a == "") checked="checked" @endif/>
						<label for="ks43a3" class="inline">tidak dijawab</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- no43b --}}
	<div class="row clearfix p-l-25">
		<div class="col-md-12 m-t-15">
			<p class="font-bold">43b. Berapa batang rata-rata rokok sehari per orang dihisap di dalam rumah?</p>
			<div class="answer">
				<div class="row clearfix">
					<div class="col-md-5" style="margin-bottom: 0">
						<div class="input-group" style="margin-bottom: 0">
							<span class="input-group-addon">
								<label for="ks43b">jumlah rokok</label>
							</span>
							<div class="form-line">
								<input class="form-control" name="ks43b" value=" {{ $ans->k43b ? $ans->k43b : '' }} " type="text">
							</div>
							<span class="input-group-addon">
								<label for="ks43b">Batang</label>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</fieldset>