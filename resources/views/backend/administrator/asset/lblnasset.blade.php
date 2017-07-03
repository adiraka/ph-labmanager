@push('css')
	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css') }}">
@endpush

@push('script')
<script src="{{ URL::asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<script type="text/javascript">
	$(function() {

		$('.page-loader-wrapper').fadeOut();
		$.AdminBSB.animate.activate();

		$('.print-report').on('click', function(event) {
			event.preventDefault();
			window.print();
		});

		var page = $('.a4')

		var header='<div class="header"><h2 class="font-14" style="margin-bottom: 5px">Partnerships for Enhanced Engagement in Research</h2><h2 class="font-14" >Multidrug-Resistant Tuberculosis <small>JL. Perintis Kemerdekaan, Kampus FK-UNAND, Padang – Sumatera Barat</small> </h2><ul class="header-dropdown"><img src="'+'{{ asset("img/pdf-logo2.png") }}'+'" alt="logo" height="40"></ul></div>'

		page.prepend(header)

		function loadDataFails() {
			$('.spinner-layer').removeClass('pl-light-blue');
			$('.spinner-layer').addClass('pl-light-red');
			$('.preloader').css('animation-iteration-count','1');
			$('#loading-text').text('Oh Snaap... load data gagal, mohon refresh kembali jika masih gagal mohon hubungi WebMaster');
		}
	});
</script>
@endpush