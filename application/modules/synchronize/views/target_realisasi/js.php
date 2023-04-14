<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
?>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<!-- Export -->
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>



	$(document).ready(function() {
		show_opd();
	});

	function show_opd() {
		$.ajax({
			url: baseUrl('web_services/get_opd'),
			type: 'POST',
			dataType: 'JSON',
			data: {},
			success: function(data) {
				console.log(data)
				if (data.status == true) {
					$('#aliran-kas-opd').html('');
					$.each(data.data, function(k, v) {
						$('#aliran-kas-opd').append('<tr>' +
							'<th scope="row">' + (k + 1) + '</th>' +
							'<td>' + v.kode_opd + '</td>' +
							'<td>' + v.nama_instansi + '</td>' +
							// '<td>' + v.bulan_mulai_realisasi + '</td>' +
							// '<td>' + v.bulan_akhir_realisasi + '</td>' +
							// '<td>' + v.status + '</td>' +
							'<td id="cek_status_progress_'+v.id_instansi+'"></td>' +
							'<td id="keterangan_status_progress_'+v.id_instansi+'"></td>' +
							'<td style="text-align: center;"> <div class="btn-group">' +
							'<button class="btn btn-info btn-sm hitung_intansi" onclick="grafik(' + "'Akumulasi','"+v.id_instansi+"','" +v.nama_instansi+"'" + ')" data-toggle="tooltip" title="Lihat grafik '+v.nama_instansi+'" nama_opd="'+v.nama_instansi+'">' +
							'<i class="fa fa-signal"></i>' +
							'</button> ' +
							'<button class="btn btn-primary btn-sm tahap-2" id="tahap-2-' + v.id_instansi + '" onclick="sync(' + "'" + v.id_instansi + "'" + ')" data-toggle="tooltip" title="synchronize grafik '+v.nama_instansi+'">' +
							'<i class="pe-7s-science btn-icon-wrapper"> </i>' +
							'</button> </div>' +
							'</td>' +
							'</tr>');
					});
				}
			}
		});
	}






	// grafik('Akumulasi');

	function grafik(kategori, id_instansi, nama_instansi){
		start_loading();

		$('#modal_grafik_skpd').modal('show');
		$('#modal_grafik_skpd').find('#nama_skpd').html(nama_instansi);
		$('#modal_grafik_skpd').find('#tombol_pilihan_grafik').html(`<button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="grafik('Akumulasi','`+id_instansi+`','`+nama_instansi+`')"><i class="fa fa-plus"> </i> Grafik Akumulasi</button>
                                       <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"  onclick="grafik('Bulanan','`+id_instansi+`','`+nama_instansi+`')"><i class="fa fa-calendar"> </i> Grafik Bulanan</button>`);

		var sumber_data = requestData(kategori, id_instansi);
		Highcharts.chart('grafik_realisasi_skpd', {
		  chart: {
		    zoomType: 'xy'
		  },
		  title: {
		    text: 'Perncapaian Total SKPD'
		  },
		  subtitle: {
		    text: 'Berdasarkan ' + kategori
		  },
		  xAxis: [{
		    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
		      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		    crosshair: true
		  }],
		  yAxis: [{ // Primary yAxis

		    labels: {
		      format: '{value}%',
		      style: {
		        color: Highcharts.getOptions().colors[1]
		      }
		    },
		    title: {
		      text: 'Fisik',
		      style: {
		        color: Highcharts.getOptions().colors[1]
		      }
		    }
		  }, { 
		    // Secondary yAxis

		    opposite: true,
		    title: {
		      text: 'Keuangan',
		      style: {
		        color: Highcharts.getOptions().colors[0]
		      }
		    },
		    labels: {
		      format: '{value}%',
		      style: {
		        color: Highcharts.getOptions().colors[0]
		      }
		    },
		  }],
		  tooltip: {
		    shared: true
		  },
		  // legend: {
		  //   layout: 'vertical',
		  //   align: 'left',
		  //   x: 120,
		  //   verticalAlign: 'top',
		  //   y: 100,
		  //   floating: true,
		  //   backgroundColor:
		  //     Highcharts.defaultOptions.legend.backgroundColor || // theme
		  //     'rgba(255,255,255,0.25)'
		  // },
		  series: [
			  {
			    name: 'Target Fisik',
			    type: 'column',
			    yAxis: 0,
			    data: sumber_data.fisik,
			    tooltip: {
			      valueSuffix: '%'
			    }
			  }, 
			  {
			    name: 'Realisasi Fisik',
			    type: 'line',

			    yAxis: 0,
			    data: sumber_data.r_fis,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  },
			  {
			    name: 'Target Keuangan',
			    type: 'column',
			    yAxis: 1,
			    data: sumber_data.keu,
			    tooltip: {
			      valueSuffix: '%'
			    }
			  }, 
			  {
			    name: 'Realisasi Keuangan',
			    type: 'line',

			    yAxis: 1,
			    data: sumber_data.r_keu,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  }
		  ]
		});


		$('#tfisik').html('<td rowspan="3" align="center">Fisik</td>');
		$('#rfisik').html('');
		$('#dfisik').html('');
		$('#tkeu').html('<td rowspan="3" align="center">Keuangan</td>');
		$('#rkeu').html('');
		$('#dkeu').html('');

		$('#tfisik').append('<td>Target</td>');
		$('#rfisik').append('<td>Realisasi</td>');
		$('#dfisik').append('<td>Deviasi</td>');
		$('#tkeu').append('<td>Target</td>');
		$('#rkeu').append('<td>Realisasi</td>');
		$('#dkeu').append('<td>Deviasi</td>');
		for (var i = 0; i < 12; i++) {
			var deviasi_fisik = sumber_data.r_fis[i] - sumber_data.fisik[i];
			$('#tfisik').append('<td>' + sumber_data.fisik[i] + '</td>');
			$('#rfisik').append('<td>' + sumber_data.r_fis[i] + '</td>');
			$('#dfisik').append('<td>' + sumber_data.d_fisik[i] + '</td>');

			var deviasi_keuangan = sumber_data.r_keu[i] - sumber_data.keu[i];
			$('#tkeu').append('<td>' + sumber_data.keu[i] + '</td>');
			$('#rkeu').append('<td>' + sumber_data.r_keu[i] + '</td>');
			$('#dkeu').append('<td>' + sumber_data.d_keu[i] + '</td>');
		}
		stop_loading();
	
	}




function requestData(kategori, id_instansi) {
		var rf = [];
		var rk = [];
		var ba = <?php echo bulan_aktif(); ?>;
				// console.log($('#id_instansi_grafik').val());
		$.ajax({
			url: '<?php echo base_url('dashboard/show_chart'); ?>',
			type: "GET",
			data : {
				id_instansi : id_instansi,
				id_group : 5,
				kategori : kategori
			},
			dataType: "json",

            async: false,
			success: function(data) {
				// console.log(data);
				result = data;
				
			},
			// cache: false
		});

		return result;
	}

	function sync_all() {
		$('.tahap-2').trigger('click');
		$('#synchronize_all').html(`

               <div style="text-align: center;"><b>Sinkronisasi data Target dan Realisasi Semua SKPD</b></div>
					<div class="progress" style="margin-top:6px">
	                    <div class="progress-bar progress-bar-animated bg-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
	                        <img src="<?php echo base_url() ?>assets/sbe/image/loading_line.gif" width="100%">
	                    </div>
                </div>`);
		// $('#tombol_sync_all').html("Loading....").attr('disabled', true);
	}

	function sync(id_instansi) {
		var tahapan_apbd = $('#tahapan_apbd').val();
		var tahun = $('#tahun').val();
		var banyak_instansi = $('.hitung_intansi').length; 
		var nama_instansi = $(this).attr('nama_instansi');
		gagal_synch = 0;
		berhasil_synch = 0;
		$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-info">Loading</span>');

		console.log(id_instansi);
		$('#tahap-2'+ '-' + id_instansi).html('<i class="fa fa-cog fa-w-3 fa-spin"></i>').attr('disabled', true);



		if (tahun <= 2022) {
			$.ajax({
				url: baseUrl('synchronize/sync'),
				type: 'POST',
				dataType: 'JSON',
				data: {
					id_instansi : id_instansi,
					tahapan_apbd : tahapan_apbd
				},
				success: function(data) {
					if (data.status == true) {
						$('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
						$('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');
						var selesai = $('.selesai_sinkron').length; 
						$('#jumlah_selesai_synchronize').html(selesai+" OPD");
						if (selesai==banyak_instansi) {
								$('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
							// $('#tombol_sync_all').html("Selesai Sinkronisasi").attr('class', 'btn btn-success btn-sm');
						}
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-success">Synchronize Selesai</span>');
					}
				},
				error : function(){

					$('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
					$('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');
					var selesai = $('.selesai_sinkron').length; 
					$('#jumlah_selesai_synchronize').html(selesai+" OPD");
					if (selesai==banyak_instansi) {
							$('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
						}
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-danger">Synchronize Error</span>');

					
				}
			});
		}
		else{

			$.ajax({
				url: baseUrl('synchronize/synch_baru/' +tahun+ '/' +tahapan_apbd+'/'+id_instansi),
				type: 'GET',
				dataType: 'JSON',
				data: {
					// id_instansi : id_instansi,
					// tahap : tahapan_apbd,
					// tahun : tahun
				},
				success: function(data) {
					console.log(data);
						$('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');

						$('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
						var selesai = $('.selesai_sinkron').length; 
						$('#banyak_selesai').html(selesai);

						// $('#cek_status_progress_' + id_instansi).attr('style','background:green-light');
						if (selesai==banyak_instansi) {
							$('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
						}


					if (data.responcode == 200) {
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-' +data.badge+'">'+ data.synchronize +'</span>');


						$('#cek_status_progress_' + id_instansi).attr('class', 'berhasil_sinkron');
						var berhasil_synch = $('.berhasil_sinkron').length; 

							$('#jumlah_selesai_synchronize').html(selesai+" OPD");
							$('#jumlah_synchronize_berhasil').html(berhasil_synch+" OPD");
						$('#keterangan_status_progress_' + id_instansi).html(data.message);
					}
					else{
						
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-' +data.badge+'">'+ data.synchronize +'</span>');

						$('#cek_status_progress_' + id_instansi).attr('class', 'gagal_sinkron');
						var gagal_synch = $('.gagal_sinkron').length; 

							$('#jumlah_selesai_synchronize').html(selesai+" OPD");
							$('#jumlah_synchronize_gagal').html(gagal_synch+" OPD");
						$('#keterangan_status_progress_' + id_instansi).html(data.message);

					}

				},
				error : function(){
					console.log('ada error');
					$('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
					$('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');
					
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-danger">Synchronize Error</span>');
						$('#keterangan_status_progress_' + id_instansi).html('Error pada Aplikasi');
					var selesai = $('.selesai_sinkron').length; 
					$('#banyak_selesai').html(selesai);
					if (selesai==banyak_instansi) {
							$('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
						}

							$('#cek_status_progress_' + id_instansi).attr('class', 'gagal_sinkron');
						var gagal_synch = $('.gagal_sinkron').length; 
							$('#jumlah_selesai_synchronize').html(selesai+" OPD");
							$('#jumlah_synchronize_gagal').html(gagal_synch+" OPD");

					
				}
			});
		}


	}



	function rekap_synch_manual(sukses, gagal, jumlah_opd, tahun, tahap){
			$.ajax({
				url: baseUrl('synchronize/rekap_synch_manual'),
				type: 'POST',
				dataType: 'JSON',
				data: {
					sukses : sukses,
					gagal : gagal,
					jumlah_opd : jumlah_opd,
					tahun : tahun,
					tahap : tahap,
				},
				success: function(data) {
				},
				error : function(){

				}
			});
	}


	function Arrays_calc(array1, array2, ope) {
		var result = [];
		var ctr = 0;
		var x = 0;

		if (array1.length === 0)
			return "array1 is empty";
		if (array2.length === 0)
			return "array2 is empty";

		while (ctr < array1.length && ctr < array2.length) {
			switch (ope) {
				case '-':
					result.push(array1[ctr] - array2[ctr]);
					break;
				case '+':
					result.push(array1[ctr] + array2[ctr]);
			}
			ctr++;
		}

		if (ctr === array1.length) {
			for (x = ctr; x < array2.length; x++) {
				result.push(array2[x]);
			}
		} else {
			for (x = ctr; x < array1.length; x++) {
				result.push(array1[x]);
			}
		}

		var hasil = [];
		$.each(result, function(k, v) {
			hasil.push(v.toFixed(2));
		});

		return hasil;
	}









	function tess(){
		console.log('mencoba');
	}



	function lihat_penjadwalan_synch(){
		$('#modal_jadwal_synch').modal('show');
		 dt_penjadwalan_synch();
	}





function dt_penjadwalan_synch()
	{
		$('#penjadwalan_synch').DataTable(
		{
	        processing	: true,
	        serverSide	: true,
	        bDestroy	: true,
	        responsive	: true,
	        ajax		: {
				          	url 	: baseUrl('synchronize/dt_penjadwalan_synch/'),
				            type 	: "POST",
				          	data 	: {}
	        			  },
	        columnDefs  : [
						  	{
						    	targets	 	: [ 0, -1 ],
						    	orderable 	: false,
						    },
						    {
								width		: "1%",
								targets		: [ 0 ],
							},
							{
								className	: "dt-center",
								targets		: [ -1 ],
							},
	        			  ],
	    
	     //    fnRowCallback : function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		    //    var index = iDisplayIndex +1;
		    //    $('td:eq(0)',nRow).html(index);
		    //    return nRow;
		    // }

    	});
	}



</script>