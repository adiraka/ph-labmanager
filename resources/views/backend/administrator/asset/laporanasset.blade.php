@push('css')
	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/select2/css/select2.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endpush

@push('script')
<script src="{{ URL::asset('plugins/autosize/autosize.js') }}"></script>
<script src="{{ URL::asset('plugins/momentjs/moment.min.js') }}"></script>
<script src="{{ URL::asset('plugins/velocity/velocity.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

<script type="text/javascript">
	$(function() {

		$('.page-loader-wrapper').fadeOut();
		$.AdminBSB.animate.activate();

		$('.print-report').on('click', function(event) {
			event.preventDefault();
			window.print();
		});

		function loadDataFails() {
			$('.spinner-layer').removeClass('pl-light-blue');
			$('.spinner-layer').addClass('pl-light-red');
			$('.preloader').css('animation-iteration-count','1');
			$('#loading-text').text('Oh Snaap... load data gagal, mohon refresh kembali jika masih gagal mohon hubungi WebMaster');
		}
	});
</script>
@endpush