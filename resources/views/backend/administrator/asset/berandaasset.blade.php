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

		$('.datepicker').bootstrapMaterialDatePicker({
			lang:'id',
			format:'YYYY/MM/DD',
			clearButton: true,
			cancelText : 'Batal',
			clearText : 'Hapus',
			weekStart: 1,
			time: false
		});

		var rpasien= $("#report-pasien").select2({
			// dir: "rtl",
			allowClear: true,
			dropdownParent: $('.tab-content'),
			language: "id",
			minimumInputLength: 2,
			placeholder: "ID pasien - Nama pasien - Institusi asal pasien",
			ajax: {
				url: '{{ route('adm.datalistpasien') }}',
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

		var tpasien= $("#spasien").select2({
			// dir: "rtl",
			allowClear: true,
			dropdownParent: $('#ModalTambahSampel'),
			language: "id",
			minimumInputLength: 2,
			placeholder: "ID pasien - Nama pasien - Institusi asal pasien",
			ajax: {
				url: '{{ route('adm.datalistpasien') }}',
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

		var tinstansiasal= $("#instansiasal").select2({
			dir: "rtl",
			allowClear: true,
			dropdownParent: $('#ModalTambahPasien'),
			language: "id",
			minimumInputLength: 2,
			placeholder: "Pilih institusi Asal Pasien",
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

		$(".select2[name='instansiasal']").on('select2:select', function (e) {
			var select2Container = $(this).parents('.input-group');

			if (select2Container.children('span.select2').hasClass('select2-error')) {
				select2Container.children('span.select2').removeClass('select2-error')
				select2Container.children('label.error').remove();
			}
		});

		$(".select[name='jns_sampel']").on('changed.bs.select', function (e,clickedIndex,newValue,oldValue) {
			var hasil = $(".select[name='hasil']")
			var rif = $(".select[name='rif']")
			var res = $(".select[name='jns_resistensi']")
			var resc = $(".resistensiContainer")
			var rifc = $(".rifContainer")
			var opNorm = [
			{text: 'TB Positif', value: 'TB Positif'},
			{text: 'TB Negatif', value: 'TB Negatif'}
			];
			var opRes = [
			{text: 'Sensitive', value: 'Sensitive'},
			{text: 'Resistance', value: 'Resistance'}
			];

			if (clickedIndex == 2) {
				res.selectpicker('val',null);
				resc.velocity("fadeOut", { duration: 50 })
				rifc.velocity("fadeIn", { duration: 50, delay:100 })
				hasil.changeOptionValue(opNorm);
				hasil.selectpicker('refresh');
			} else if (clickedIndex == 4){
				rif.selectpicker('val',null);
				rifc.velocity("fadeOut", { duration: 50 })
				resc.velocity("fadeIn", { duration: 50, delay:100 })
				hasil.changeOptionValue(opRes);
				hasil.selectpicker('refresh');
			} else {
				res.selectpicker('val',null);
				rif.selectpicker('val',null);
				resc.velocity("fadeOut", { duration: 50 })
				rifc.velocity("fadeOut", { duration: 50, delay:100 })
				hasil.changeOptionValue(opNorm);
				hasil.selectpicker('refresh');
			}
		});

		$.each($('.select'), function(index, val) {
			$(this).on('changed.bs.select', function (e) {
				var selectContainer = $(this).parents('.input-group');

				if (selectContainer.children('.bootstrap-select').hasClass('select-error')) {
					selectContainer.children('.bootstrap-select').removeClass('select-error')
					selectContainer.children('label.error').remove();
				}
			});
		});
		
		$("#formTambahPasien").validate({
			rules:{
				namapasien:"required",
				sex:"required",
				instansiasal:"required",
				kuisioner:"required",
			},
			messages:{
				namapasien:"Nama pasien tidak boleh kosong",
				sex:"gender pasien tidak boleh kosong",
				instansiasal:"Institusi asal pasien tidak boleh kosong",
				kuisioner:"Kuisioner tidak boleh kosong",
			},
			highlight: function (input) {
				if ($(input).is('select')){
					if ($(input).hasClass('select2')) {
						$(input).parents('.input-group').children('span.select2').addClass('select2-error');
					} else {
						$(input).parents('.input-group').children('.bootstrap-select').addClass('select-error');
					}
				} else 
				$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function (input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function (error, element) {
				if ($(element).is('select'))
					$(element).parents('.input-group').append(error);
				else 
					$(element).parents('.input-group').append(error);
			},
			submitHandler: function (form) {
				$.ajax({
					type: $(form).attr('method'),
					url: $(form).attr('action'),
					data: $(form).serialize(),
					beforeSend:function () {
						$('#ModalTambahPasien').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						InfoBoxPasien(data.rekappasien[0]);
					}
				});
				return false; 
			}
		});

		$("#formTambahSampel").validate({
			rules:{
				pasien_id:"required",
				idtb:"required",
				tgl_masuk_sampel:"required",
				tgl_periksa:"required",
				pemeriksaanke:"required",
				jns_sampel:"required",
				hasil:"required",
			},
			messages:{
				pasien_id:"Nama pasien tidak boleh kosong",
				idtb:"IDTB sampel tidak boleh kosong",
				tgl_masuk_sampel:"Tgl masuk sampel tidak boleh kosong",
				tgl_periksa:"Tgl periksa sampel tidak boleh kosong",
				pemeriksaanke:"Pemeriksaanke tidak boleh kosong",
				jns_sampel:"Jenis sampel tidak boleh kosong",
				hasil:"Hasil tidak boleh kosong",
			},
			highlight: function (input) {
				if ($(input).is('select')){
					if ($(input).hasClass('select2')) {
						$(input).parents('.input-group').children('span.select2').addClass('select2-error');
					} else {
						$(input).parents('.input-group').children('.bootstrap-select').addClass('select-error');
					}
				} else 
				$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function (input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function (error, element) {
				if ($(element).is('select'))
					$(element).parents('.input-group').append(error);
				else 
					$(element).parents('.input-group').append(error);
			},
			submitHandler: function (form) {
				$.ajax({
					type: $(form).attr('method'),
					url: $(form).attr('action'),
					data: $(form).serialize(),
					beforeSend:function () {
						$('#ModalTambahSampel').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						InfoBoxSampel(data.rekap[0]);
					}
				});
				return false; 
			}
		});

		$("#formTambahInstitusi").validate({
			rules:{
				iNamaInstitusi:"required",
				iJnsInstitusi:"required",
				iDaerah:"required",
				iAlamat:"required",
			},
			messages:{
				iNamaInstitusi:"Nama institusi tidak boleh kosong",
				iJnsInstitusi:"Jenis institusi tidak boleh kosong",
				iDaerah:"Lokasi institusi tidak boleh kosong",
				iAlamat:"Alamat tidak boleh kosong",
			},
			highlight: function (input) {
				if ($(input).is('select'))
					$(input).parents('.input-group').children('.bootstrap-select').addClass('select-error');
				else 
					$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function (input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function (error, element) {
				$(element).parents('.input-group').append(error);
			},
			submitHandler: function (form) {
				$.ajax({
					type: $(form).attr('method'),
					url: $(form).attr('action'),
					data: $(form).serialize(),
					beforeSend:function () {
						$('#ModalTambahInstitusi').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						InfoBoxInstitusi(data.rekap[0]);
					}
				});
				return false; 
			}
		});

		$('#ModalTambahPasien').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
			var modal = $(this)

			modal.find('#namapasien').val(null)
			modal.find('#sex').selectpicker('val',null)
			modal.find('#umur').val(null)
			modal.find('#tgllahir').bootstrapMaterialDatePicker('setDate', null);
			modal.find('#instansiasal').val(null).trigger('change')
			tinstansiasal.val(null).trigger("change");
			modal.find('#kuisioner').selectpicker('val',null);
			modal.find('#enumerator').val(null)
			modal.find('#alamat').val(null)
		});

		$('#ModalTambahSampel').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
			var modal = $(this)

			tpasien.val(null).trigger("change");
			modal.find('#idtb').val(null)
			modal.find('#idpp').val(null)
			modal.find('#pemeriksaanke').selectpicker('val',null)
			modal.find('#tgl_masuk_sampel').bootstrapMaterialDatePicker('setDate', null);
			modal.find('#tgl_periksa').bootstrapMaterialDatePicker('setDate', null);
			modal.find('#jns_sampel').selectpicker('val',null)
			modal.find('#hasil').selectpicker('val',null)
		});

		$('#ModalTambahInstitusi').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var modal = $(this)

			modal.find('#iNamaInstitusi').val(null)
			modal.find('#iJnsInstitusi').selectpicker('val',null)
			modal.find('#iDaerah').selectpicker('val',null)
			modal.find('#iAlamat').val(null)
		});

		$('#ModalTambahKuisioner').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var modal = $(this)

			modal.find('.modal-dialog').waitMe({
				effect : 'rotation',
				text : 'Loading... Mohon Tunggu',
				bg : 'rgba(76, 175, 80, 0.3)',
				color : '#fff',
				textPos : 'vertical',
				onClose : function () {
					modal.find('.card').addClass('light');
					modal.find('.card').animateCss('fadeInDown');
				}
			});

			$.ajax({
				type: 'GET',
				url: '{{ route('adm.getformkuisioner') }}',
				dataType:"html",
				success: function (form) {
					modal.find('.card').html(form)
					var kuisioner = $('#f-kuisioner');
					
					kuisioner.steps({
						headerTag: 'h3',
						bodyTag: 'fieldset',
						enableAllSteps: true,
						stepsOrientation: 'vertical',
						labels: {
							cancel: "Batal",
							finish: "Selesai",
							next: "Berikut",
							previous: "Sebelum",
							loading: "Loading ..."
						},
						onInit: function (event, currentIndex) {
							$.AdminBSB.input.activate();

							$.each($('.radio-with-text'), function() {
								var $p_this =$(this);
								var $input =$p_this.find('input:radio');
								var $inputTextTogle =$p_this.find('input:radio.text-togle').prop('id');

								$input.change(function(){
									$c_id = $(this).prop('id')
									$_it = $('#'+$c_id.substring(0, $c_id.length - 2)+'t')

									if ($c_id == $inputTextTogle) {
										$_it.prop('disabled', false)

									} else {
										$_it.prop('disabled', true)
										$_it.val(null)
									}
								});
								
							});

							$('.datepicker').bootstrapMaterialDatePicker({
								lang:'id',
								format:'YYYY/MM/DD',
								clearButton: true,
								cancelText : 'Batal',
								clearText : 'Hapus',
								weekStart: 1,
								time: false
							});

							var kpasien= $("#pasien").select2({
								allowClear: true,
								dropdownParent: $('#ModalTambahKuisioner'),
								language: "id",
								minimumInputLength: 2,
								placeholder: "ID pasien - Nama pasien - Institusi asal pasien",
								ajax: {
									url: '{{ route('adm.datalistpasien') }}',
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
						},
						onStepChanging: function (event, currentIndex, newIndex) {
							if (currentIndex > newIndex) { return true; }

							if (currentIndex < newIndex) {
								kuisioner.find('.body:eq(' + newIndex + ') label.error').remove();
								kuisioner.find('.body:eq(' + newIndex + ') .error').removeClass('error');
							}

							kuisioner.validate().settings.ignore = ':disabled,:hidden';
							return kuisioner.valid();
						},
						onStepChanged: function (event, currentIndex, priorIndex) {

						},
						onFinishing: function (event, currentIndex) {
							kuisioner.validate().settings.ignore = ':disabled';
							return kuisioner.valid();
						},
						onFinished: function (event, currentIndex) {
							var form = $(this);

							form.submit();
						}
					});

					kuisioner.validate({
						highlight: function (input) {
							$(input).parents('.input-group').addClass('error');
						},
						unhighlight: function (input) {
							$(input).parents('.input-group').removeClass('error');
						},
						errorPlacement: function (error, element) {
							$(element).parents('.input-group').append(error);
						},
						rules: {
							'pasien_id': 'required'
						},
						submitHandler: function (form) {
							$.ajax({
								type: $(form).attr('method'),
								url: $(form).attr('action'),
								data: $(form).serialize(),
								beforeSend:function () {
									$('#ModalTambahKuisioner').modal('hide')
									notify = $.notify('Proses sedang berjalan','mengirim data ke server');
								},
								success: function (data) {
									notify.update({
										'title': data.title,
										'message': data.message,
										'progress': 60 
									});

									InfoBoxKuisioner(data.rekap[0]);
								}
							});
							return false; 
						}
					});

					var tab = modal.find('.steps');
					var content = modal.find('fieldset');

					content.css('height', tab.height());
					modal.find('.modal-dialog').waitMe("hide")
				},
			});
		});

		$('#ModalTambahKuisioner').on('hide.bs.modal', function (e) { 
			var button = $(e.relatedTarget)
			var modal = $(this)
			modal.find('.card').empty();
		});
		
		function InfoBoxPasien(data) {
			$('#totalPasien').countTo({from: 0, to: data.total ? data.total : 0 });
		}

		function InfoBoxSampel(data) {
			$('#totalSampel').countTo({from: 0, to: data.total ? data.total : 0 });
		}

		function InfoBoxInstitusi(data) {
			$('#totalInstitusi').countTo({from: 0, to: data.total ? data.total : 0 });
		}

		function InfoBoxKuisioner(data) {
			$('#totalKuisioner').countTo({from: 0, to: data.total ? data.total : 0 });
		}

		function loadDataFails() {
			$('.spinner-layer').removeClass('pl-light-blue');
			$('.spinner-layer').addClass('pl-light-red');
			$('.preloader').css('animation-iteration-count','1');
			$('#loading-text').text('Oh Snaap... load data gagal, mohon refresh kembali jika masih gagal mohon hubungi WebMaster');
		}
	});
</script>
@endpush