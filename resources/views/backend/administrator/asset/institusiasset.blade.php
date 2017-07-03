@push('css')

	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/jquery-datatable/datatables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/select2/css/select2.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endpush

@push('script')
<script src="{{ URL::asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>
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
		var export_filename = 'MDRTB Labmanger - Institusi' + tgl;
		var chart;
		var selected;
		var notif;

		callData('{{ route('adm.chartinstitusi') }}','yes');

		function callData(url,animate = 'no'){
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

					if (animate == 'yes') {
						$('.page-loader-wrapper').fadeOut();
						$.AdminBSB.animate.activate();
					}

					setTimeout(function () { 
						generateInstitusiChart(data[0].total);
						generateDaerahChart(data[1].statistik);
						generateStatistik(data[2].jumlah);
					}, 600);
				}
			});
		};

		function loadDataFails() {
			$('.spinner-layer').removeClass('pl-light-blue');
			$('.spinner-layer').addClass('pl-light-red');
			$('.preloader').css('animation-iteration-count','1');
			$('#loading-text').text('Oh Snaap... load data gagal, mohon refresh kembali jika masih gagal mohon hubungi WebMaster');
		}

		function generateChartDataWithDetail(data) {
			var chartData = [];
			if (data.length) {
				for (var i = 0; i < data.length; i++) {
					if (i == selected) {
						for (var x = 0; x < data[i].subs[0].length; x++) {
							chartData.push({
								title: data[i].subs[0][x].title,
								value: data[i].subs[0][x].value,
								color: data[i].color,
								pulled: true
							});
						}
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

		function generateDaerahChart(data) {
			daerahChart = AmCharts.makeChart("daerahchart",
			{
				"type": "pie",
				autoMargins: false,
				marginBottom: 0,
				marginLeft: 0,
				marginRight: 0,
				"balloonText": "[[title]]<br><span style='font-size:12px'><b>[[value]] institusi </b> ([[percents]]%)</span>",
				"titleField": "title",
				"valueField": "value",
				"fontSize": 12,
				"theme": "default",
				"labelsEnabled":false,
				"pullOutDuration": 0.1,
				"color": "#ffffff",
				"labelText": "[[title]]<br>[[percents]]% ([[value]]) ",
				"outlineColor": "#FFFFFF",
				"colorField": "color",
				"pulledField": "pulled",
				"maxLabelWidth": 80,
				"dataProvider": generateChartDataWithDetail(data),
				legend: {
					"divId": "daerah-legend",
					"enabled": true,
					"color": "#FFFFFF",
					"align": "center",
					"forceWidth": true,
					// "marginTop": -10,
					"labelWidth": 150,
					"width": 300,
					"verticalGap": 8,
					"fontSize": 10,
					"markerLabelGap": 10,
					"valueText": "[[value]]",
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
						chart.dataProvider = generateChartDataWithDetail(data);
						chart.validateData();
					}
				}],
				"export": {
					"enabled": true,
					"menu": []
				}
			});
		}

		function generateInstitusiChart(data) {
			InstitusiChart = AmCharts.makeChart("institusichart",
			{
				"type": "pie",
				autoMargins: false,
				marginBottom: 0,
				marginLeft: 0,
				marginRight: 0,
				// "pieY": "40%",
				"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]] </b> ([[percents]]%)</span>",
				"titleField": "title",
				"valueField": "value",
				"fontSize": 12,
				"theme": "default",
				"pullOutDuration": 0.1,
				"labelsEnabled":false,
				// "labelRadius": 14,
				"color": "#ffffff",
				"labelText": "Pasien [[title]]<br>[[percents]]% <br>([[value]] institusi) ",
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
					// "marginTop": -10,
					"labelWidth": 100,
					"width": 300,
					"verticalGap": 8,
					"fontSize": 10,
					"markerLabelGap": 10,
					"valueText": "[[value]]",
					"valueWidth": 100
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

		$('#search-table-institusi').keyup(function(){
			dTable.search($(this).val()).draw() ;
		})

		dTable = $('#institusi-table').DataTable({
			processing: true,
			serverSide: true,
			// scrollX:true,
			"autoWidth": false,
			"pageLength": 20,
			order: [ [0, 'desc'] ],
			"dom": "<'row m-t-15'<'col-sm-12'tr>>" + "<'row m-t-15'<'col-sm-5'i><'col-sm-7'p>>",//lfrtip
			ajax: '{!! route('adm.datainstitusi') !!}',
			"oLanguage": {
				"oPaginate": {"sNext": "<i class='material-icons'>navigate_next</i>","sPrevious": "<i class='material-icons'>navigate_before</i>"},
				"sInfo": "_START_ sampai _END_ dari _TOTAL_"
			},
			columns: [
			{ data: 'id', name: 'instansi.id',width: "30px"},
			{ data: 'jenisinstansi.nama_jenis_instansi', name: 'jenisinstansi.nama_jenis_instansi',width: "50px"},
			{ data: 'nama_instansi', name: 'instansi.nama_instansi',width: "100px"},
			{ data: 'daerah.nama_daerah', name: 'daerah.nama_daerah',width: "70px" },
			{ data: 'alamat', name: 'instansi.alamat',width: "300px" },
			{ data: 'action', name: 'action', orderable: false, searchable: false,"width": "50px"},
			{ data: 'control', name: 'control', orderable: false, searchable: false,"width": "10px"}
			],
			"columnDefs": [
			{
				className: 'control',
				targets:   -1
			}
			// {
			// 	"render": function ( data, type, row ) {
				{{-- // 		return '<a href="{{ url('administrator/detail/pasien/') }}'+'/'+row.id+'" class="" >'+data+'</a>'; --}}
			// 	},
			// 	"targets": [1]
			// },
			// {
			// 	"visible": false,
			// 	"targets": [0]
			// }
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

		dTableJnsInstitusi = $('#jns-institusi-table').DataTable({
			processing: true,
			serverSide: true,
			// scrollX:true,
			"autoWidth": false,
			// order: [ [0, 'desc'] ],
			"dom": "<'row m-t-15'<'col-sm-12'tr>>" + "<'row m-t-15'<'col-sm-5'><'col-sm-7'>>",//lfrtip
			ajax: '{!! route('adm.datajnsinstitusi') !!}',
			"oLanguage": {
				"oPaginate": {"sNext": "<i class='material-icons'>navigate_next</i>","sPrevious": "<i class='material-icons'>navigate_before</i>"},
				"sInfo": "_START_ sampai _END_ dari _TOTAL_"
			},
			columns: [
			{ data: 'id', name: 'jenisinstansi.id',width: "30px"},
			{ data: 'nama_jenis_instansi', name: 'jenisinstansi.nama_jenis_instansi',width: "200px"},
			{ data: 'jmlInstitusi', name: 'jmlInstitusi', orderable: false, searchable: false, width: "120px" },
			{ data: 'action', name: 'action', orderable: false, searchable: false, width: "100px"},
			]
		});

		dTableDaerah = $('#daerah-table').DataTable({
			processing: true,
			serverSide: true,
			// scrollX:true,
			"autoWidth": false,
			// order: [ [0, 'desc'] ],
			"dom": "<'row m-t-15'<'col-sm-12'tr>>" + "<'row m-t-15'<'col-sm-5'><'col-sm-7'>>",//lfrtip
			ajax: '{!! route('adm.datadaerah') !!}',
			"oLanguage": {
				"oPaginate": {"sNext": "<i class='material-icons'>navigate_next</i>","sPrevious": "<i class='material-icons'>navigate_before</i>"},
				"sInfo": "_START_ sampai _END_ dari _TOTAL_"
			},
			columns: [
			{ data: 'id', name: 'daerah.id',width: "30px"},
			{ data: 'nama_daerah', name: 'daerah.nama_daerah',width: "200px"},
			{ data: 'jmlInstitusi', name: 'jmlInstitusi', orderable: false, searchable: false, width: "120px" },
			{ data: 'action', name: 'action', orderable: false, searchable: false, width: "100px"},
			]
		});

		//remove error message if user select an option
		$.each($('.select'), function(index, val) {
			$(this).on('changed.bs.select', function (e) {
				var selectContainer = $(this).parents('.input-group');

				if (selectContainer.children('.bootstrap-select').hasClass('select-error')) {
					selectContainer.children('.bootstrap-select').removeClass('select-error')
					selectContainer.children('label.error').remove();
				}
			});
		});

		//form validate
		$("#formTambahDaerah").validate({
			rules:{
				NamaDaerah:"required",
			},
			messages:{
				NamaDaerah:"Nama daerah tidak boleh kosong",
			},
			highlight: function (input) {
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
						$('#ModalTambahDaerah').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						callData('{{ route('adm.chartinstitusi') }}');
						dTableDaerah.ajax.reload();
					}
				});
				return false; 
			}
		});

		$("#formUpdateDaerah").validate({
			rules:{
				uNamaDaerah:"required",
			},
			messages:{
				uNamaDaerah:"Nama daerah tidak boleh kosong",
			},
			highlight: function (input) {
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
						$('#ModalUpdateDaerah').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						callData('{{ route('adm.chartinstitusi') }}');
						dTableDaerah.ajax.reload();
					}
				});
				return false; 
			}
		});

		$("#formDeleteDaerah").validate({
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
						$('#ModalDeleteDaerah').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						callData('{{ route('adm.chartinstitusi') }}');
						dTableDaerah.ajax.reload();
					}
				});
				return false; 
			}
		});

		$("#formTambahJnsInstitusi").validate({
			rules:{
				jNamaJenisInstitusi:"required",
			},
			messages:{
				jNamaJenisInstitusi:"Nama Jenis Institusi tidak boleh kosong",
			},
			highlight: function (input) {
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
						$('#ModalTambahJnsInstitusi').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						callData('{{ route('adm.chartinstitusi') }}');
						dTableJnsInstitusi.ajax.reload();
					}
				});
				return false; 
			}
		});

		$("#formUpdateJnsInstitusi").validate({
			rules:{
				ujNamaJenisInstitusi:"required",
			},
			messages:{
				ujNamaJenisInstitusi:"Nama Jenis Institusi tidak boleh kosong",
			},
			highlight: function (input) {
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
						$('#ModalUpdateJnsInstitusi').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						dTableJnsInstitusi.ajax.reload();
					}
				});
				return false; 
			}
		});

		$("#formDeleteJnsInstitusi").validate({
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
						$('#ModalDeleteJnsInstitusi').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						callData('{{ route('adm.chartinstitusi') }}');
						dTableJnsInstitusi.ajax.reload();
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

						callData('{{ route('adm.chartinstitusi') }}');
						dTable.ajax.reload();
					}
				});
				return false; 
			}
		});

		$("#formUpdateInstitusi").validate({
			rules:{
				uiNamaInstitusi:"required",
				uiJnsInstitusi:"required",
				uiDaerah:"required",
				uiAlamat:"required",
			},
			messages:{
				uiNamaInstitusi:"Nama institusi tidak boleh kosong",
				uiJnsInstitusi:"Jenis institusi tidak boleh kosong",
				uiDaerah:"Lokasi institusi tidak boleh kosong",
				uiAlamat:"Alamat tidak boleh kosong",
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
						$('#ModalUpdateInstitusi').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						callData('{{ route('adm.chartinstitusi') }}');
						dTable.ajax.reload();
					}
				});
				return false; 
			}
		});

		$("#formDeleteInstitusi").validate({
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
						$('#ModalDeleteInstitusi').modal('hide')
						notify = $.notify('Proses sedang berjalan','mengirim data ke server');
					},
					success: function (data) {
						notify.update({
							'title': data.title,
							'message': data.message,
							'progress': 60 
						});

						callData('{{ route('adm.chartinstitusi') }}');
						dTable.ajax.reload();
					}
				});
				return false; 
			}
		});

		//modal call data
		$('#ModalTambahInstitusi').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var modal = $(this)

			modal.find('#iNamaInstitusi').val(null)
			modal.find('#iJnsInstitusi').selectpicker('val',null)
			modal.find('#iDaerah').selectpicker('val',null)
			modal.find('#iAlamat').val(null)
		});

		$('#ModalUpdateInstitusi').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
			var modal = $(this)

			modal.find('.card .body').waitMe({
				effect : 'rotation',
				text : '',
				bg : 'rgba(0,0,0,0.3)',
				color : '#2196F3',
				maxSize : '',
				textPos : 'vertical',
				fontSize : '',
				source : ''
			});

			$.ajax({
				type: 'GET',
				url: 'institusi/detail/'+id,
				beforeSend:function () {

				},
				success: function (data) {
					modal.find('input[name="_id"]').val(id)
					modal.find('#uiNamaInstitusi').val(data.nama_instansi)
					modal.find('#uiJnsInstitusi').selectpicker('val',data.jenisinstansi.id)
					modal.find('#uiDaerah').selectpicker('val',data.daerah.id)
					modal.find('#uiAlamat').val(data.alamat)
					modal.find('.card .body').waitMe("hide")
				}
			});
		});

		$('#ModalDeleteInstitusi').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
			var nama = button.data('namainstansi')
			var jns = button.data('jenisinstansi')
			var daerah = button.data('id')
			var alamat = button.data('alamat')
			var modal = $(this)

			modal.find('input[name="_id"]').val(id)
			modal.find('#diNamaInstitusi').text(nama)
			modal.find('#diJnsInstitusi').text(jns)
			modal.find('#diDaerah').text(daerah)
			modal.find('#diAlamat').text(alamat)
		});

		$('#ModalTambahJnsInstitusi').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var modal = $(this)

			modal.find('#iNamaInstitusi').val(null)
		});

		$('#ModalUpdateJnsInstitusi').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
			var nmJnsInstansi = button.data('namajnsinstansi')
			var modal = $(this)

			modal.find('input[name="_id"]').val(id)
			modal.find('#ujNamaJenisInstitusi').val(nmJnsInstansi)
		});

		$('#ModalDeleteJnsInstitusi').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
			var nmJnsInstansi = button.data('namajnsinstansi')
			var modal = $(this)

			modal.find('input[name="_id"]').val(id)
			modal.find('#djNamaJenisInstitusi').text(nmJnsInstansi)
		});

		$('#ModalTambahDaerah').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var modal = $(this)

			modal.find('#NamaDaerah').val(null)
		});

		$('#ModalUpdateDaerah').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
			var namadaerah = button.data('namadaerah')
			var modal = $(this)

			modal.find('input[name="_id"]').val(id)
			modal.find('#uNamaDaerah').val(namadaerah)
		});

		$('#ModalDeleteDaerah').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget)
			var id = button.data('id')
			var namadaerah = button.data('namadaerah')
			var modal = $(this)

			modal.find('input[name="_id"]').val(id)
			modal.find('#dDaerah').text(namadaerah)
		});
	});
</script>
@endpush