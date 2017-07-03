@push('css')
	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/select2/css/select2.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css') }}">
@endpush

@push('script')
<script src="{{ URL::asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script type="text/javascript">
	$(function() {

		$('.page-loader-wrapper').fadeOut();
		$.AdminBSB.animate.activate();

		$('.print-report').on('click', function(event) {
			event.preventDefault();
			window.print();
		});

		var rpasien= $("#ins_id").select2({
			// dir: "rtl",
			allowClear: true,
			dropdownParent: $('body'),
			language: "id",
			minimumInputLength: 2,
			placeholder: "Cth: M. Jamil",
			ajax: {
				url: '{{ route('adm.datalistinstitusi') }}',
				dataType: 'json',
				type: "GET",
				quietMillis: 50,
				delay: 250,
				data: function (term) {
					return {
						term: term.term
					};
				},
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							return { 
								id: obj.id, 
								text: obj.text 
							};
						})
					};
				}
			}
		});

		var rpasien= $("#ins_id2").select2({
			// dir: "rtl",
			allowClear: true,
			dropdownParent: $('.pasien-picker'),
			language: "id",
			minimumInputLength: 2,
			placeholder: "Cth: M. Jamil",
			ajax: {
				url: '{{ route('adm.datalistinstitusi') }}',
				dataType: 'json',
				type: "GET",
				quietMillis: 50,
				delay: 250,
				data: function (term) {
					return {
						term: term.term
					};
				},
				processResults: function (data) {
					return {
						results: $.map(data, function(obj) {
							return { 
								id: obj.id, 
								text: obj.text 
							};
						})
					};
				}
			}
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