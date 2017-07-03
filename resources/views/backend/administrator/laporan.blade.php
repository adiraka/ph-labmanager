@extends('backend.print')

@push('title')
<title>Beranda Administrator - MDRTB Laboratory Manager</title>
@endpush

@include('backend.administrator.asset.laporanasset')

@section('content')
<div class="container-fluid">

{{-- #table --}}
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card light animate a4" data-animate="slideInUp">
				<div class="header">
					@include('backend.partials.printheader')
				</div>
				<div class="body kuisioner-table-container" style="padding-top: 0;height: calc(29cm - 105px);">

				</div>
			</div>

			<ul class="mfb-component--br mfb-slidein ph" data-mfb-toggle="hover" data-mfb-state="closed">
				<li class="mfb-component__wrap">
					<a data-mfb-label="Menu" class="mfb-component__button--main">
						<i class="mfb-component__main-icon--resting material-icons">inbox</i>
						<i class="mfb-component__main-icon--active material-icons">clear</i>
					</a>
					<ul class="mfb-component__list">
						<li>
							<a href="javascript:void(0)" data-mfb-label="Print" class="mfb-component__button--child print-report">
								<i class="mfb-component__child-icon material-icons">print</i>
							</a>
						</li>
						<li>
							<a href="link.html" data-mfb-label="Export PDF" class="mfb-component__button--child">
								<i class="mfb-component__child-icon material-icons">note</i>
							</a>
						</li>
						<li>
							<a href="link.html" data-mfb-label="Export Excell" class="mfb-component__button--child">
								<i class="mfb-component__child-icon material-icons">grid_on</i>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
@endsection