@push('css')

	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/jquery-datatable/datatables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-select/css/bootstrap-select.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/select2/css/select2.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endpush

@push('script')
<script src="{{ URL::asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>
<script src="{{ URL::asset('plugins/velocity/velocity.min.js') }}"></script>
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

<script type="text/javascript">

$(function() {
	var date = new Date();
		var tgl = date.toLocaleDateString();
		var export_filename = 'MDRTB Labmanger - Pasien' + tgl;
		var chart;
		var selected;
		var pieChart;
		var notif;

	callData('{{ route('adm.chartpasien') }}','yes');

	$('.datepicker').bootstrapMaterialDatePicker({
		lang:'id',
		format:'YYYY/MM/DD',
		clearButton: true,
		cancelText : 'Batal',
		clearText : 'Hapus',
		weekStart: 1,
		time: false
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
	
	var uinstansiasal= $("#uinstansiasal").select2({
			dir: "rtl",
			allowClear: true,
			dropdownParent: $('#ModalUpdatePasien'),
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

	$.each($('.select'), function(index, val) {
		$(this).on('changed.bs.select', function (e) {
			var selectContainer = $(this).parents('.input-group');

			if (selectContainer.children('.bootstrap-select').hasClass('select-error')) {
				selectContainer.children('.bootstrap-select').removeClass('select-error')
				selectContainer.children('label.error').remove();
			}
		});
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

	function loadDataFails() {
		$('.spinner-layer').removeClass('pl-light-blue');
		$('.spinner-layer').addClass('pl-light-red');
		$('.preloader').css('animation-iteration-count','1');
		$('#loading-text').text('Oh Snaap... load data gagal, mohon refresh kembali jika masih gagal mohon hubungi WebMaster');
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
						// "gridPosition": "start",
						// "labelsEnabled": false,
						// "tickLength": 0
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
							// "gridCount": 0,
							// "tickLength": 0,
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
							"valueField": "positif",
							"type": "column",
							"balloonText": "[[value]] TB Positif",
							"fillAlphas": 1,
							"fillColors": "#FF9E01",
							"lineThickness": 0,
						},
						{
							"id": "negatif-graph",
							"title": "TB Negatif",
							"valueField": "negatif",
							"type": "column",
							"balloonText": "[[value]] TB Negatif",
							"fillAlphas": 1,
							"fillColors": "#B0DE09",//357CD2
							"lineThickness": 0,
						},
						{
							"id": "kosong-graph",
							"title": "--",
							"valueField": "kosong",
							"type": "column",
							"balloonText": "[[value]] --",
							"fillAlphas": 1,
							"fillColors": "#F8FF01",
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
					"legend": {
						"enabled": true,
						"divId": "serial-legend",
						"useGraphSettings": true,
						"color": "#FFFFFF",
						"align": "left",
						// "marginLeft": 0,
						"forceWidth": true,
						"equalWidths": false,
						"labelWidth": 100,
						// "width": 300,
						"markerLabelGap": 10,
						"markerSize": 10,
						"maxColumns": 3,
						"valueWidth": 0,
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
				// "marginLeft": 0,
				"labelWidth": 100,
				"width": 300,
				"markerLabelGap": 10,
				"valueText": "[[value]] - [[percents]]%",
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

	$('#search-table-pasien').keyup(function(){
		dTable.search($(this).val()).draw() ;
	})

	dTable = $('#pasien-table').DataTable({
			processing: true,
			serverSide: true,
			"pageLength": 20,
			// scrollX:true,
			"autoWidth": false,
			order: [ [0, 'desc'] ],
			"dom": "<'row m-t-15'<'col-sm-12'tr>>" + "<'row m-t-15'<'col-sm-5'i><'col-sm-7'p>>",//lfrtip
			ajax: '{!! route('adm.datapasien') !!}',
			"oLanguage": {
				"oPaginate": {"sNext": "<i class='material-icons'>navigate_next</i>","sPrevious": "<i class='material-icons'>navigate_before</i>"},
				"sInfo": "_START_ sampai _END_ dari _TOTAL_"
			},
			columns: [
			{ data: 'id', name: 'pasien.id',width: "50px"},
			{ data: 'idtb', name: 'pasien.idtb',width: "150px"},
			{ data: 'idpp', name: 'pasien.idpp',width: "150px"},
			{ data: 'nama_pasien', name: 'pasien.nama_pasien',width: "200px" },
			{ data: 'sex', name: 'pasien.sex',width: "80px",class:'text-center'},
			{ data: 'umur', name: 'pasien.umur',width: "80px",class:'text-center' },
			{ data: 'instansi.jenisinstansi_id', name: 'instansi.jenisinstansi_id',width: "50px",orderable: false, searchable: false, },
			{ data: 'instansi.nama_instansi', name: 'instansi.nama_instansi',width: "200px"  },
			{ data: 'alamat', name: 'pasien.alamat',width: "350px" },
			{ data: 'kuisioner', name: 'pasien.kuisioner',width: "50px",class:'text-center' },
			{ data: 'enumerator', name: 'pasien.enumerator',width: "50px",class:'text-center' },
			{ data: 'action', name: 'action', orderable: false, searchable: false,"width": "100px"},
			{ data: 'control', name: 'control', orderable: false, searchable: false,"width": "10px"}
			],
			"columnDefs": [
			{
				"render": function ( data, type, row ) {
					if (data == 1) {
						return '<i class="material-icons font-bold font-18 col-green" >done</i>';
					} else {
						return '<i class="material-icons font-bold font-18 col-red" >clear</i>';
					}
				},
				"targets": [9,10]
			},
			{
				"render": function ( data, type, row ) {
					if (data == 1) {
						return 'RS';
					} else if (data == 2){
						return 'Pusk';
					} else if (data == 3){
						return 'BP4';
					} else {
						return 'LP';
					}

				},
				"targets": [6]
			},
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

	$("#formTambahSampel").validate({
		rules:{
			pasien_id:"required",
			tgl_masuk_sampel:"required",
			tgl_periksa:"required",
			pemeriksaanke:"required",
			jns_sampel:"required",
			hasil:"required",
		},
		messages:{
			pasien_id:"Nama pasien tidak boleh kosong",
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

					callData('{{ route('adm.chartsampel') }}');
					dTable.ajax.reload();
				}
			});
			return false; 
		}
	});

	$("#formTambahPasien").validate({
		rules:{
			namapasien:"required",
			idtb:"required",
			sex:"required",
			instansiasal:"required",
			kuisioner:"required",
		},
		messages:{
			namapasien:"Nama pasien tidak boleh kosong",
			idtb:"IDTB pasien tidak boleh kosong",
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

					callData('{{ route('adm.chartpasien') }}');
					dTable.ajax.reload();
				}
			});
			return false; 
		}
	});

	$("#formUpdatePasien").validate({
		rules:{
			namapasien:"required",
			idtb:"required",
			sex:"required",
			instansiasal:"required",
			kuisioner:"required",
		},
		messages:{
			namapasien:"Nama pasien tidak boleh kosong",
			idtb:"IDTB pasien tidak boleh kosong",
			sex:"gender pasien tidak boleh kosong",
			instansiasal:"Instansi asal pasien tidak boleh kosong",
			kuisioner:"Kuisioner tidak boleh kosong",
		},
		highlight: function (input) {
			if ($(input).is('select')){
				$(input).parents('.input-group').children('span.select2').addClass('select2-error');
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
					$('#ModalUpdatePasien').modal('hide')
					notify = $.notify('Proses sedang berjalan','mengirim data ke server');
				},
				success: function (data) {
					notify.update({
						'title': data.title,
						'message': data.message,
						'progress': 60 
					});

					dTable.ajax.reload();
				}
			});
			return false; 
		}
	});

	$("#formDeletePasien").validate({
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
					$('#ModalDeletePasien').modal('hide')
					notify = $.notify('Proses sedang berjalan','mengirim data ke server');
				},
				success: function (data) {
					notify.update({
						'title': data.title,
						'message': data.message,
						'progress': 60 
					});

					callData('{{ route('adm.chartpasien') }}');
					dTable.ajax.reload();
				}
			});
			return false; 
		}
	});

	$('#ModalTambahSampel').on('show.bs.modal', function (e) {
		var button = $(e.relatedTarget)
		var id = button.data('id')
		var idtb = button.data('idtb')
		var idpp = button.data('idpp')
		var nm = button.data('nama_pasien')
		var modal = $(this)

		modal.find('#nm_pas').text(nm)
		modal.find('#pasien_id').val(id)
		modal.find('#sidtb').val(idtb)
		modal.find('#vsidtb').text(idtb)
		modal.find('#sidpp').val(idpp)
		modal.find('#vsidpp').text(idpp ? idpp : "-")
		modal.find('#pemeriksaanke').selectpicker('val',null)
		modal.find('#tgl_masuk_sampel').bootstrapMaterialDatePicker('setDate', null);
		modal.find('#tgl_periksa').bootstrapMaterialDatePicker('setDate', null);
		modal.find('#jns_sampel').selectpicker('val',null)
		modal.find('#hasil').selectpicker('val',null)
	})

	$('#ModalTambahPasien').on('show.bs.modal', function (e) {
		var button = $(e.relatedTarget)
		var id = button.data('id')
		var modal = $(this)

		modal.find('#namapasien').val(null)
		modal.find('#idtb').val(null)
		modal.find('#idpp').val(null)
		modal.find('#sex').selectpicker('val',null)
		modal.find('#umur').val(null)
		modal.find('#tgllahir').bootstrapMaterialDatePicker('setDate', null);
		modal.find('#instansiasal').val(null).trigger('change')
		tinstansiasal.val(null).trigger("change");
		modal.find('#kuisioner').selectpicker('val',null);
		modal.find('#enumerator').val(null)
		modal.find('#alamat').val(null)
	})

	$('#ModalUpdatePasien').on('show.bs.modal', function (e) {
		var button = $(e.relatedTarget)
		var id = button.data('id')
		var idtb = button.data('idtb')
		var idpp = button.data('idpp')
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
			url: 'pasien/detail/'+id,
			beforeSend:function () {
				
			},
			success: function (data) {
				modal.find('input[name="_id"]').val(id)
				modal.find('#uidtb').val(idtb)
				modal.find('#uidpp').val(idpp)
				modal.find('#unamapasien').val(data.nama_pasien)
				modal.find('#usex').selectpicker('val',data.sex);
				modal.find('#uumur').val(data.umur)
				modal.find('#utgllahir').bootstrapMaterialDatePicker('setDate', data.tgl_lhr);
				modal.find('#uinstansiasal').append('<option value="'+data.instansi.id+'">'+data.instansi.nama_instansi+'</option>') 
				uinstansiasal.val(data.instansi.id).trigger("change");
				modal.find('#ukuisioner').selectpicker('val',data.kuisioner);
				modal.find('#uenumerator').val(data.enumerator)
				modal.find('#ualamat').val(data.alamat)
				modal.find('.card .body').waitMe("hide")
			}
		});
	})

	$('#ModalDeletePasien').on('show.bs.modal', function (e) {
		var button = $(e.relatedTarget)
		var id = button.data('id')
		var nama = button.data('nama_pasien')
		var sex = button.data('sex')
		var umur = button.data('umur')
		var asal = button.data('asal')
		var modal = $(this)

		modal.find('input[name="_id"]').val(id)
		modal.find('#del-nama').text(nama)
		modal.find('#del-sex').text(sex)
		modal.find('#del-age').text(umur)
	})
});
</script>

@endpush