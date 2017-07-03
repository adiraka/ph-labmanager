@push('css')

<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/jquery-datatable/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/select2/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endpush

@push('script')
<script src="{{ URL::asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-datatable/datatables.min.js') }}"></script>
<script src="{{ URL::asset('plugins/autosize/autosize.js') }}"></script>
<script src="{{ URL::asset('plugins/momentjs/moment.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('plugins/amcharts/amcharts.js') }}"></script>
<script src="{{ URL::asset('plugins/amcharts/pie.js') }}"></script>
<script src="{{ URL::asset('plugins/amcharts/serial.js') }}"></script>
<script>
	$(function() {
		var date = new Date();
		var tgl = date.toLocaleDateString();
		var export_filename = 'MDRTB Labmanger - Kuisioner' + tgl;
		var chart;
		var selected;
		var pieChart;
		var notif;

		var kuisioner = $('#kuisioner').show();

		$('#search-table-kuisioner').keyup(function(){
			dTable.search($(this).val()).draw() ;
		})

		callData('{{ route('adm.chartkuisioner') }}',true);

		function callData(url,animate = false){
			$.ajax({
				url: url,
				type: 'GET',
				data: {
					format: 'json'
				},
				error: function() {
					loadDataFails();
				},
				dataType: 'json',
				success: function(data) {
					if (data.length == 0) {
						loadDataFails();
						return false;
					};

					if (animate == true) {
						$('.page-loader-wrapper').fadeOut();
						$.AdminBSB.animate.activate();
					}

					setTimeout(function () { 
						generatePieChart(data[0].total);
						generateSerialChart(data[1].statistik);
						generateStatistik(data[2].jumlah);
					}, 600);
				}

			});
		};

		function generateChartData(data) {
			var chartData = [];
			if (data.length) {
				for (var i = 0; i < data.length; i++) {
					if (i == selected) {
						chartData.push({
							title: data[i].title,
							value: data[i].value,
							color: data[i].color,
							pulled: true
						});
					} else {
						chartData.push({
							title: data[i].title,
							value: data[i].value,
							color: data[i].color,
							id: i
						});
					}
				}
			}
			return chartData;
		}

		function generateSerialChart(data) {
			serialChart = AmCharts.makeChart("serialchart",
			{
				"type": "serial",
				"categoryField": "bln",
				"dataDateFormat": "YYYY-MM",
				"startDuration": 1,
				"color": "#FFFFFF",
				"trendLines": [],
				"categoryAxis": {
					"autoWrap": true,
					"equalSpacing": true,
					"gridPosition": "start",
					"minPeriod": "MM",
					"parseDates": true,
					"position": "top",
					"autoGridCount": false,
					"axisThickness": 0,
					"fontSize": 9,
					"gridCount": 6,
					"gridThickness": 0,
				},
				"valueAxes": [
				{
					"id": "ValueAxis-1",
					"stackType": "regular",
					"autoGridCount": false,
					"axisThickness": 0,
					"gridThickness": 0,
					"labelsEnabled": false,
					"title": "",
					"totalText": "[[total]]",
					"titleFontSize": 0
				}
				],
				"graphs": [
				{
					"id": "positif-graph",
					"title": "TB Positif",
					"valueField": "total",
					"type": "column",
					"balloonText": "[[value]] Kuisioner",
					"fillAlphas": 1,
					"fillColors": "#FF9E01",
					"lineThickness": 0,
				}
				],
				"chartCursor": {
					"enabled": true,
					"animationDuration": 0.92,
					"balloonPointerOrientation": "horizontal",
					"bulletSize": 3,
					"categoryBalloonColor": "#9400D3",
					"categoryBalloonDateFormat": "MMM YYYY",
					"categoryBalloonText": "",
					"cursorAlpha": 0.5,
					"cursorColor": "#777",
					"fullWidth": true,
					"graphBulletAlpha": 0.13,
					"leaveAfterTouch": false,
					"leaveCursor": false,
					"tabIndex": 0,
					"valueLineAlpha": 0
				},
				"guides": [],
				"allLabels": [],
				"balloon": {},
				"dataProvider": data
			}
			); 
		}

		function generatePieChart(data) {
			pieChart = AmCharts.makeChart("piechart",
			{
				"type": "pie",
				autoMargins: false,
				marginBottom: 0,
				marginLeft: 0,
				marginRight: 0,
				"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]] </b> ([[percents]]%)</span>",
				"titleField": "title",
				"valueField": "value",
				"fontSize": 12,
				"theme": "default",
				"pullOutDuration": 0.1,
				"labelsEnabled":false,
				"color": "#ffffff",
				"labelText": "Pasien [[title]]<br>[[percents]]% <br>([[value]] pasien) ",
				"outlineColor": "#FFFFFF",
				"colorField": "color",
				"pulledField": "pulled",
				"maxLabelWidth": 60,
				"dataProvider": generateChartData(data),
				legend: {
					"enabled": true,
					"divId": "pie-legend",
					"color": "#FFFFFF",
					"align": "center",
					"forceWidth": true,
					"labelWidth": 150,
					"width": 300,
					"markerLabelGap": 10,
					"valueText": "[[value]] - [[percents]]%",
					"valueWidth": 50
				},
				"listeners": [
				{
					"event": "animationFinished",
					"method": function(e) {
						var interval = setInterval( function() {
							if ( window.fabric ) {
								clearTimeout( interval );
								e.chart["export"].capture( {}, function() {
									this.toJPG( {}, function( base64 ) {
										chartimg = base64;
										$("#pdf [name=img]").val(chartimg);
										$("#export-pdf").unbind("click");
										$("#icon").removeClass('fa-refresh fa-spin');
										$("#icon").addClass('fa-file-pdf-o');
									} );
								} );
							}
						}, 100 );
					}
				},{
					"event": "clickSlice",
					"method": function(e) {
						var chart = e.chart;
						if (e.dataItem.dataContext.id != undefined) {
							selected = e.dataItem.dataContext.id;
						} else {
							selected = undefined;
						}
						chart.dataProvider = generateChartData(data);
						chart.validateData();
					}
				}],
				"export": {
					"enabled": true,
					"menu": []
				}
			});
		}

		function generateStatistik(data) {
			$('#skr').countTo({from: 0, to: data.skr ? data.skr : 0 });
			$('#kmrn').countTo({from: 0, to: data.kmrn ? data.kmrn : 0 });
			$('#blnskr').countTo({from: 0, to: data.blnskr ? data.blnskr : 0 });
			$('#blnkmrn').countTo({from: 0, to: data.blnkmrn ? data.blnkmrn : 0 });
			$('#thnskr').countTo({from: 0, to: data.thnskr ? data.thnskr : 0 });
			$('#thnkmrn').countTo({from: 0, to: data.thnkmrn ? data.thnkmrn : 0 });
			$('#total').countTo({from: 0, to: data.total ? data.total : 0 });
		}
		
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
								format:'DD-MM-YYYY',
								minDate:'01-01-2014',
								nowButton:true,
								nowText:'tgl skr',
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

									callData('{{ route('adm.chartkuisioner') }}');
									dTable.ajax.reload();
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

		$('#ModalUpdateKuisioner').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
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
				url: 'kuisioner/getform/'+id,
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
								var $p_this = $(this);
								var $input = $p_this.find('input:radio');
								var $inputTextTogle = $p_this.find('input:radio.text-togle');

								$.each($inputTextTogle, function() {
									if ($(this).is(':checked')) {
										$c_id = $(this).prop('id')
										
										$('#'+$c_id.substring(0, $c_id.length - 2)+'t').prop('disabled', false)
									}									
								});


								$input.change(function(){
									$c_id = $(this).prop('id')
									$_it = $('#'+$c_id.substring(0, $c_id.length - 2)+'t')

									if ($c_id == $inputTextTogle.prop('id')) {
										$_it.prop('disabled', false)

									} else {
										$_it.val(null)
										$_it.prop('disabled', true)
									}
								});
								
							});

							$('.datepicker').bootstrapMaterialDatePicker({
								lang:'id',
								format:'DD-MM-YYYY',
								nowButton:true,
								nowText:'tgl skr',
								clearButton: true,
								cancelText : 'Batal',
								clearText : 'Hapus',
								weekStart: 1,
								time: false
							});

							var kpasien= $("#pasien").select2({
								allowClear: true,
								dropdownParent: $('#ModalUpdateKuisioner'),
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
									$('#ModalUpdateKuisioner').modal('hide')
									notify = $.notify('Proses sedang berjalan','mengirim data ke server');
								},
								success: function (data) {
									notify.update({
										'title': data.title,
										'message': data.message,
										'progress': 60 
									});

									callData('{{ route('adm.chartkuisioner') }}');
									dTable.ajax.reload();
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

		$("#formDeleteKuisioner").validate({
			rules:{
			},
			messages:{
			},
			submitHandler: function (form) {
				$.ajax({
					type: $(form).attr('method'),
					url: $(form).attr('action'),
					data: $(form).serialize(),
					beforeSend:function () {
						$('#ModalDeleteKuisioner').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						callData('{{ route('adm.chartkuisioner') }}');
						dTable.ajax.reload();
					}
				});
				return false; 
			}
		});

		$('#ModalDeleteKuisioner').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
			var responden = button.data('responden')
			var modal = $(this)

			modal.find('input[name="_id"]').val(id)
			modal.find('#del-id').text(id);
			modal.find('#del-res').text(responden);
		});

		$('#ModalTambahKuisioner').on('hide.bs.modal', function (e) { 
			var button = $(e.relatedTarget)
			var modal = $(this)
			modal.find('.card').empty();
		});

		$('#ModalUpdateKuisioner').on('hide.bs.modal', function (e) { 
			var button = $(e.relatedTarget)
			var modal = $(this)
			modal.find('.card').empty();
		});

		function loadDataFails() {
			$('.spinner-layer').removeClass('pl-light-blue');
			$('.spinner-layer').addClass('pl-light-red');
			$('.preloader').css('animation-iteration-count','1');
			$('#loading-text').text('Oh Snaap... load data gagal, mohon refresh kembali jika masih gagal mohon hubungi WebMaster');
		}

		dTable = $('#kuisioner-table').DataTable({
			processing: true,
			serverSide: true,
			"autoWidth": false,
			"pageLength": 20,
			order: [ [0, 'desc'] ],
			"dom": "<'row m-t-15'<'col-sm-12'tr>>" + "<'row m-t-15'<'col-sm-5'i><'col-sm-7'p>>",
			ajax: '{!! route('adm.datakuisioner') !!}',
			"oLanguage": {
				"oPaginate": {"sNext": "Berikutnya","sPrevious": "Sebelumnya"},
				"sInfo": "_START_ sampai _END_ dari _TOTAL_"
			},
			columns: [
			{ data: 'id', name: 'kuisioner.id',width: "60px" },
			{ data: 'idtb', name: 'pasien.idtb',width: "180px" },
			{ data: 'nama_pasien', name: 'nama_pasien', orderable: false, searchable: false, width: "200px" },
			{ data: 'sex', name: 'sex', orderable: false, searchable: false, width: "80px", class:'text-center'},
			{ data: 'instansi.nama_instansi',
			"render":function(data, type, full, meta){
				return full.nama_jenis_instansi +" "+ full.nama_instansi +" "+ full.nama_daerah;
				}, orderable: false, searchable: false, width: "300px"
			},
			{ data: 'alamat', name: 'pasien.alamat', orderable: false, searchable: false, width: "350px" },
			{ data: 'action', name: 'action', orderable: false, searchable: false, width: "90px"},
			{ data: 'control', name: 'control', orderable: false, searchable: false, width: "10px"}
			],
			"columnDefs": [
			{
				className: 'control',
				targets:   -1
			}
			],
			"language": {
				"loadingRecords": "Mohon Tunggu - loading...",
				"emptyTable": "Belum ada Data tersimpan",
				"processing": "Meminta Data ke Server ..."
			},
			responsive: {
				details: {
					type: 'column',
					target: -1,
				}
			}
		});

		function setButtonWavesEffect(event) {
			$(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
			$(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
		}
	});
</script>
@endpush