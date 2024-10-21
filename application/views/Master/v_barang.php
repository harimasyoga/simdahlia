<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right"></ol>
			</div>
			</div>
		</div>
	</section>

	<style>
		/* Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
	</style>


<section class="content">

<!-- Default box -->
<div class="card shadow row-input" style="display: none;">
	<div class="card-header" style="font-family:Cambria;" >
		<h3 class="card-title" style="color:#4e73df;"><b>Input <?=$judul?></b></h3>

		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fas fa-minus"></i></button>
		</div>
	</div>
	<form role="form" method="post" id="myForm">
		<div class="col-md-12">
						
			<br>
				
			<div class="card-body row" style="padding-bottom:1px;font-weight:bold">						
				<div class="col-md-2">Kode Barang</div>
				<div class="col-md-3">
					<input type="hidden" name="sts_input" id="sts_input">
					<input type="hidden" name="id_barang" id="id_barang">

					<input type="text" class="form-control" name="kd_brg" id="kd_brg" value="KODE" oninput="this.value = this.value.toUpperCase();this.value = this.value.match(/\[(\d+)\][(\d+)\]/);">
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-2">Ukuran</div>
				<div class="col-md-3">
					<div class="input-group mb-1">
						<input type="text" class="form-control" name="ukuran" id="ukuran" value="Ukuran">
							
					</div>
				</div>

			</div>
			
			<div class="card-body row" style="padding-bottom:1px;font-weight:bold">			
				<div class="col-md-2">Nama Barang</div>
				<div class="col-md-3">
					<input type="text" class="form-control" name="nm_brg" id="nm_brg" value="Nama" oninput="this.value = this.value.toUpperCase()">
				</div>
				<div class="col-md-1"></div>

				<div class="col-md-2">Merk</div>
				<div class="col-md-3">
					<input type="text" class="form-control" name="merk" id="merk" value="Ukuran">
				</div>
			</div>
			
			<div class="card-body row" style="padding-bottom:1px;font-weight:bold">			
				<div class="col-md-2">Supplier</div>
				<div class="col-md-3">
					<input type="text" class="form-control" name="supp" id="supp" value ="" >
				</div>
				<div class="col-md-1"></div>

				<div class="col-md-2">Ket</div>
				<div class="col-md-3">
					<input type="text" class= "form-control" name="ket" id="ket"  oninput="this.value = this.value.toUpperCase()">
				</div>
			</div>
			
			<div class="card-body row" style="padding-bottom:1px;font-weight:bold">			
				<div class="col-md-2">Qty / Satuan Terbesar</div>
				<div class="col-md-2">
					<input type="text" class="angka form-control" name="qty1" id="qty1" value ="" >
					
				</div>
				<div class="col-md-2">
					<select class="form-control select2" name="sat1" id="sat1">
						<option value="PCS">PCS</option>
						<option value="PACK">PACK</option>
						<option value="BOX">BOX</option>
					</select>
				</div>
				<div class="col-md-5">
					
				</div>
			</div>
		
			<div class="card-body row" style="padding-bottom:1px;font-weight:bold">			
				<div class="col-md-2">Qty / Satuan Sedang</div>
				<div class="col-md-2">
					<input type="text" class="angka form-control" name="qty2" id="qty2" value ="" >
				</div>
				<div class="col-md-2">
					<select class="form-control select2" name="sat2" id="sat2">
						<option value="PCS">PCS</option>
						<option value="PACK">PACK</option>
						<option value="BOX">BOX</option>
					</select>
				</div>

				<div class="col-md-5">
					
				</div>
			</div>

			<div class="card-body row" style="padding-bottom:1px;font-weight:bold">			
				<div class="col-md-2">Qty / Satuan Terkecil</div>
				<div class="col-md-2">
					<input type="text" class="angka form-control" name="qty3" id="qty3" value ="" >
				</div>
				<div class="col-md-2">
					<select class="form-control select2" name="sat3" id="sat3">
						<option value="PCS">PCS</option>
						<option value="PACK">PACK</option>
						<option value="BOX">BOX</option>
					</select>
				</div>

				<div class="col-md-5">
					
				</div>
			</div>
			
			<br>
			<div class="card-body row"style="font-weight:bold">
				<div class="col-md-4">
					<button type="button" onclick="kembaliList()" class="btn-tambah-produk btn  btn-danger"><b>
						<i class="fa fa-undo" ></i> Kembali</b>
					</button>

					<span id="btn-simpan"></span>

				</div>
				
				<div class="col-md-6"></div>
				
			</div>

			<br>
			
		</div>
	</form>	
</div>
<!-- /.card -->
</section>

	<section class="content">
		<div class="card shadow mb-3">
			<div class="row-list">
				<div class="card-header" style="font-family:Cambria;">		
						<h3 class="card-title" style="color:#4e73df;"><b><?= $judul ?></b></h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
						</div>
				</div>
				<div class="card-body" >
					<?php if(in_array($this->session->userdata('level'), ['Admin','konsul_keu','Laminasi'])){ ?>
						<div style="margin-bottom:12px">
							<button type="button" class="btn btn-sm btn-info" onclick="add_data()"><i class="fa fa-plus"></i> <b>TAMBAH DATA</b></button>
						</div>
					<?php } ?>
					<div style="overflow:auto;">
						<table id="datatable" class="table table-bordered table-striped table-scrollable" width="100%">
							<thead class="color-tabel">
								<tr>
									<th class="text-center">NO</th>
									<th class="text-center">NO PO</th>
									<th class="text-center">TANGGAL PO</th>
									<th class="text-center">SUPPLIER</th>
									<th class="text-center">ACC OWNER</th>
									<th class="text-center">AKSI</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>			
		</div>
	</section>

</div>


<script type="text/javascript">

	const urlAuth = '<?= $this->session->userdata('level')?>';

	$(document).ready(function ()
	{
		kosong()
		load_data()
		// load_supp()
		// jenis_beban(0)
		$('.select2').select2();
	});
	
	var rowNum = 0;

	function load_supp() 
	{
		option = "";
		$.ajax({
			type       : 'POST',
			url        : "<?= base_url(); ?>Transaksi/load_supp",
			// data       : { idp: pelanggan, kd: '' },
			dataType   : 'json',
			beforeSend: function() {
				swal({
				title: 'loading ...',
				allowEscapeKey    : false,
				allowOutsideClick : false,
				onOpen: () => {
					swal.showLoading();
				}
				})
			},
			success:function(data){			
				if(data.message == "Success"){					
					option = `<option value="">-- Pilih --</option>`;	

					$.each(data.data, function(index, val) {
					option += "<option value='"+val.id_supp+"'>"+val.nm_supp+"</option>";
					});

					$('#id_supp').html(option);
					swal.close();
				}else{	
					option += "<option value=''></option>";
					$('#id_supp').html(option);					
					swal.close();
				}
			}
		});
		
	}

	function addRow() 
	{
		var b = $('#bucket').val();

		if (b == -1) {
			b = 0;
			rowNum = 0;
		}
		var nm_barang   = $('#nm_barang' + b).val();
		var ket         = $('#ket' + b).val();
		var qty         = $('#qty' + b).val();
		var hrg_sat     = $('#hrg_sat' + b).val();
			
		if (nm_barang != '' && ket != '' && qty != 0 && hrg_sat != 0) 
		{			
			rowNum++;
			var x = rowNum + 1;
			
				$('#table_list_item').append(
					`<tr id="itemRow${ rowNum }">
						<td id="detail-hapus-${ rowNum }">
							<div class="text-center">
								<a class="btn btn-danger" id="btn-hapus-${ rowNum }" onclick="removeRow(${ rowNum })">
									<i class="far fa-trash-alt" style="color:#fff"></i> 
								</a>
							</div>
						</td>

						<td style="padding : 12px 20px">
							<div class="input-group mb-1">
								<input type="text" size="5" name="nm_barang[${ rowNum }]" id="nm_barang${ rowNum }"  class= "form-control" value='' >
							</div>
						</td>		
						<td style="padding : 12px 20px">
							<div class="input-group mb-1">
								<input type="text" size="5" name="ket[${ rowNum }]" id="ket${ rowNum }" class="form-control" value=''>
							</div>
						</td>		
						<td style="padding : 12px 20px">
							<div class="input-group mb-1">
								<input type="text" size="5" name="qty[${ rowNum }]" id="qty${ rowNum }" class="angka form-control" onkeyup="ubah_angka(this.value,this.id),hitung_total()" value='0'>	
								<div class="input-group-append">
									<span class="input-group-text"><b>PCS</b>
									</span>
								</div>	
							</div>
						</td>		
						<td style="padding : 12px 20px">
							<div class="input-group mb-1">
								<div class="input-group-append">
									<span class="input-group-text"><b>Rp</b>
									</span>
								</div>	
								<input type="text" size="5" name="hrg_sat[${ rowNum }]" id="hrg_sat${ rowNum }" class="angka form-control" onkeyup="ubah_angka(this.value,this.id),hitung_total()" value='0'>
							</div>
						</td>		
						<td style="padding : 12px 20px">
							<div class="input-group mb-1">
								<div class="input-group-append">
									<span class="input-group-text"><b>Rp</b>
									</span>
								</div>	
								<input type="text" size="5" name="jum[${ rowNum }]" id="jum${ rowNum }" class="angka form-control" onkeyup="ubah_angka(this.value,this.id)" value='0' readonly>
									
							</div>
							
						</td>		
					</tr>`);
				$('#bucket').val(rowNum);
				$('#list' + rowNum).focus();
		}else{
			swal({
				title               : "Cek Kembali",
				html                : "Isi form diatas terlebih dahulu",
				type                : "info",
				confirmButtonText   : "OK"
			});
			return;
		}
	}

	function removeRow(e) 
	{
		if (rowNum > 0) {
			jQuery('#itemRow' + e).remove();
			// rowNum--;
		} else {
			// toastr.error('Baris pertama tidak bisa dihapus');
			// return;

			swal({
					title               : "Cek Kembali",
					html                : "Baris pertama tidak bisa dihapus",
					type                : "error",
					confirmButtonText   : "OK"
				});
			return;
		}
		// $('#bucket').val(rowNum);
	}

	function clearRow() 
	{
		var bucket = $('#bucket').val();
		for (var e = bucket; e > 0; e--) {
			jQuery('#itemRow' + e).remove();
			rowNum--;
		}		
		$('#bucket').val(rowNum);
	}

	function hitung_total()
	{
		var diskon        = $("#disk_total").val()
		diskon_ok         = (diskon=='' || diskon == null) ? '0' : diskon;
		var disk_total    = parseInt(diskon_ok.split('.').join(''));
		
		var ppn           = $("#ppn").val()
		var total_hrg_sat = 0
		for(loop = 0; loop <= rowNum; loop++)
		{
			var hrg_sat = $("#hrg_sat"+loop).val()
			if(hrg_sat=='')
			{
				hrg_sat1 = 0;
			}else{
				hrg_sat1 = hrg_sat;
			}
			var hrg_sat   = parseInt(hrg_sat1.split('.').join(''))
			
			var qty = $("#qty"+loop).val()
			if(qty=='')
			{
				qty1 = 0;
			}else{
				qty1 = qty;
			}
			var qty   = parseInt(qty1.split('.').join(''))
			total_hrg_sat += hrg_sat*qty;	
			$("#jum"+loop).val(format_angka(hrg_sat*qty))
		}		
		total_hrg_sat_ok = (total_hrg_sat=='' || isNaN(total_hrg_sat) || total_hrg_sat == null) ? 0 : total_hrg_sat
		
		if(ppn=='YA')
		{
			var ppn_total    = (total_hrg_sat_ok *0.11).toFixed(0);
		}else{
			var ppn_total   = 0
		}
		
		var total_nom     = parseInt(total_hrg_sat_ok)
		var total_all     = parseInt(total_hrg_sat_ok)-parseInt(disk_total)+parseInt(ppn_total)
		
		$("#total_nom").val(format_angka(total_nom))
		$("#pajak_total").val(format_angka(ppn_total))
		$("#total_all").val(format_angka(total_all))
		
	}

	function reloadTable() 
	{
		table = $('#datatable').DataTable();
		tabel.ajax.reload(null, false);
	}

	function load_data() 
	{
		let table = $('#datatable').DataTable();
		table.destroy();
		tabel = $('#datatable').DataTable({
			"processing": true,
			"pageLength": true,
			"paging": true,
			"ajax": {
				"url": '<?php echo base_url('Transaksi/load_data/po')?>',
				"type": "POST",
			},
			"aLengthMenu": [
				[5, 10, 50, 100, -1],
				[5, 10, 50, 100, "Semua"]
			],	
			"responsive": false,
			"pageLength": 10,
			"language": {
				"emptyTable": "TIDAK ADA DATA.."
			}
		})
	}
	
	function edit_data(id,no_po)
	{
		$(".row-input").attr('style', '');
		$(".row-list").attr('style', 'display:none');
		$("#sts_input").val('edit');

		$("#btn-simpan").html(`<button type="button" onclick="simpan()" class="btn-tambah-produk btn  btn-primary"><b><i class="fa fa-save" ></i> Update</b> </button>`)

		$.ajax({
			url        : '<?= base_url(); ?>Transaksi/load_data_1',
			type       : "POST",
			data       : { no:no_po, jenis :'edit_po' },
			dataType   : "JSON",
			beforeSend: function() {
				swal({
				title: 'loading data...',
				allowEscapeKey    : false,
				allowOutsideClick : false,
				onOpen: () => {
					swal.showLoading();
				}
				})
			},
			success: function(data) {
				if(data){
					// header
					$("#id_barang").val(data.header.id_barang);
					$("#no_po").val(data.header.no_po);
					$("#ppn").val(data.header.ppn).trigger('change');
					$("#terms").val(data.header.terms).trigger('change');
					$("#tgl_po").val(data.header.tgl_po).trigger('change');
					$("#fob").val(data.header.fob);
					$("#supp").val(data.header.supp);
					$("#tgl_minta").val(data.header.tgl_minta);
					$("#cttn").val(data.header.cttn);	
					
					swal.close();
					// detail

					var list = `
						<table class="table table-hover table-striped table-bordered table-scrollable table-condensed" id="table_list_item" width="100%">
							<thead class="color-tabel">
								<tr>
									<th id="header_del">Delete</th>
									<th style="padding : 12px 50px">Nama Barang</th>
									<th style="padding : 12px 70px" >Keterangan</th>
									<th style="padding : 12px 70px" >Qty</th>
									<th style="padding : 12px 50px" >Harga Satuan</th>
									<th style="padding : 12px 50px" >Jumlah</th>
								</tr>
							</thead>`;
						
					var no   = 0;
					$.each(data.detail, function(index, val) {
						
						list += `
							<tbody>
								<tr id="itemRow${ no }">
									<td id="detail-hapus-${ no }">
										<div class="text-center">
											<a class="btn btn-danger" id="btn-hapus-${ no }" onclick="removeRow(${ no })">
												<i class="far fa-trash-alt" style="color:#fff"></i> 
											</a>
										</div>
									</td>

									<td style="padding : 12px 20px">
										<div class="input-group mb-1">
											<input type="text" size="5" name="nm_barang[${ no }]" id="nm_barang${ no }"  class= "form-control" value='${(val.nm_barang)}' >
										</div>
									</td>		
									<td style="padding : 12px 20px">
										<div class="input-group mb-1">
											<input type="text" size="5" name="ket[${ no }]" id="ket${ no }" class="form-control" value='${(val.ket)}'>
										</div>
									</td>		
									<td style="padding : 12px 20px">
										<div class="input-group mb-1">
											<input type="text" size="5" name="qty[${ no }]" id="qty${ no }" class="angka form-control" onkeyup="ubah_angka(this.value,this.id),hitung_total()" value='${format_angka((val.qty))}'>	
											<div class="input-group-append">
												<span class="input-group-text"><b>PCS</b>
												</span>
											</div>	
										</div>
									</td>		
									<td style="padding : 12px 20px">
										<div class="input-group mb-1">
											<div class="input-group-append">
												<span class="input-group-text"><b>Rp</b>
												</span>
											</div>	
											<input type="text" size="5" name="hrg_sat[${ no }]" id="hrg_sat${ no }" class="angka form-control" onkeyup="ubah_angka(this.value,this.id),hitung_total()" value='${format_angka((val.hrg_sat))}'>
										</div>
									</td>		
									<td style="padding : 12px 20px">
										<div class="input-group mb-1">
											<div class="input-group-append">
												<span class="input-group-text"><b>Rp</b>
												</span>
											</div>	
											<input type="text" size="5" name="jum[${ no }]" id="jum${ no }" class="angka form-control" onkeyup="ubah_angka(this.value,this.id)" value='${(val.jum)}' readonly>
												
										</div>
										
									</td>		
								</tr>
							</tbody>
					
						`;
						no ++;
					})
					
					list +=`<tfoot>
						<tr>
							<td colspan="5" class="text-right">
								<label for="total">SUB TOTAL</label>
							</td>	
							<td>
								<div class="input-group mb-1">
									<div class="input-group-append">
										<span class="input-group-text"><b>Rp</b>
										</span>
									</div>		
									<input type="text" size="5" name="total_nom" id="total_nom" class="angka form-control" value='0' readonly>
								</div>
								
							</td>	
						</tr>
						<tr>
							<td colspan="5" class="text-right">
								<label for="total">DISKON</label>
							</td>	
							<td>
								<div class="input-group mb-1">
									<div class="input-group-append">
										<span class="input-group-text"><b>Rp</b>
										</span>
									</div>		
									<input type="text" size="5" name="disk_total" id="disk_total" class="angka form-control" value='${format_angka(data.header.diskon)}' onkeyup="ubah_angka(this.value,this.id),hitung_total()">
								</div>
								
							</td>	
						</tr>
						<tr>
							<td colspan="5" class="text-right">
								<label for="total">PPN</label>
							</td>	
							<td>
								<div class="input-group mb-1">
									<div class="input-group-append">
										<span class="input-group-text"><b>Rp</b>
										</span>
									</div>		
									<input type="text" size="5" name="pajak_total" id="pajak_total" class="angka form-control" value='0' readonly>
								</div>
								
							</td>	
						</tr>
						<tr>
							<td colspan="5" class="text-right">
								<label for="total">TOTAL</label>
							</td>	
							<td>
								<div class="input-group mb-1">
									<div class="input-group-append">
										<span class="input-group-text"><b>Rp</b>
										</span>
									</div>		
									<input type="text" size="5" name="total_all" id="total_all" class="angka form-control" value='0' readonly>
								</div>
								
							</td>	
						</tr>
					</tfoot>`;
					rowNum = no-1; 
					
					// $("#disk_total").val(format_angka(data.header.diskon));
					$('#bucket').val(rowNum);					
					$("#table_list_item").html(list);
					hitung_total()	
					swal.close();

				} else {

					swal.close();
					swal({
						title               : "Cek Kembali",
						html                : "Gagal Simpan",
						type                : "error",
						confirmButtonText   : "OK"
					});
					return;
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				// toastr.error('Terjadi Kesalahan');
				
				swal.close();
				swal({
					title               : "Cek Kembali",
					html                : "Terjadi Kesalahan",
					type                : "error",
					confirmButtonText   : "OK"
				});
				
				return;
			}
		});
	}

	
	function acc_inv(no_invoice,status_owner) 
	{	
		var user        = "<?= $this->session->userdata('username')?>"
		var acc_owner   = status_owner
		// var acc_admin   = $('#modal_status_inv_admin').val()
		var no_inv      = no_invoice
		
		if(user=='bumagda' || user=='developer' || user=='yolanda_zu')
		{
			acc = acc_owner
		}else{
			acc = acc_owner
		}

		// console.log(user)
		// console.log(acc)
		if (acc=='N')
		{
			var html = 'VERIFIKASI'
			var icon = '<i class="fas fa-check"></i>'
		}else{
			var html = 'BATAL VERIFIKASI'
			var icon = '<i class="fas fa-lock"></i>'
		}
		
		swal({
			title              : html,
			html               : "<p> Apakah Anda yakin ?</p><br>",
			type               : "question",
			showCancelButton   : true,
			confirmButtonText  : '<b>'+icon+' '+html+'</b>',
			cancelButtonText   : '<b><i class="fas fa-undo"></i> Batal</b>',
			confirmButtonClass : 'btn btn-success',
			cancelButtonClass  : 'btn btn-danger',
			confirmButtonColor : '#28a745',
			cancelButtonColor  : '#d33'
		}).then(() => {

				$.ajax({
					url: '<?= base_url(); ?>Transaksi/prosesData',
					data: ({
						no_inv    : no_inv,
						acc       : acc,
						jenis     : 'verif_inv_beli'
					}),
					type: "POST",
					beforeSend: function() {
						swal({
							title: 'loading ...',
							allowEscapeKey    : false,
							allowOutsideClick : false,
							onOpen: () => {
								swal.showLoading();
							}
						})
					},
					success: function(data) {
						toastr.success('Data Berhasil Diproses');
						// swal({
						// 	title               : "Data",
						// 	html                : "Data Berhasil Diproses",
						// 	type                : "success",
						// 	confirmButtonText   : "OK"
						// });
						
						// setTimeout(function(){ location.reload(); }, 1000);
						// location.href = "<?= base_url()?>Transaksi/Invoice";
						// location.href = "<?= base_url()?>Transaksi/Invoice_edit?id="+id+"&statuss=Y&no_inv="+no_inv+"&acc=1";
						reloadTable()
						close_modal()
						swal.close();
					},
					error: function(jqXHR, textStatus, errorThrown) {
						// toastr.error('Terjadi Kesalahan');
						swal({
							title               : "Cek Kembali",
							html                : "Terjadi Kesalahan",
							type                : "error",
							confirmButtonText   : "OK"
						});
						return;
					}
				});
		
		});


	}
	
	function close_modal()
	{
		$('#modalForm').modal('hide');
		reloadTable()
	}
	
	function kosong()
	{
		$tgl = '<?= date('Y-m-d') ?>'	
		rowNum = 0
		$("#kd_brg").val('') 	
		$("#ukuran").val('') 	
		$("#nm_brg").val('') 	
		$("#merk").val('') 	
		$("#supp").val('') 	
		$("#ket").val('') 	
		$("#qty1").val('') 	
		// $("#sat1").val('') 	
		$("#qty2").val('') 	
		// $("#sat2").val('') 	
		$("#qty3").val('') 	
		// $("#sat3").val('') 	
		
		// hitung_total()
		
		swal.close()
	}

	function simpan() 
	{
		var id_barang   = $("#id_barang").val();
		var kd_brg      = $("#kd_brg").val();
		var ukuran      = $("#ukuran").val();
		var nm_brg      = $("#nm_brg").val();
		var merk        = $("#merk").val();
		var supp        = $("#supp").val();
		var ket         = $("#ket").val();
		var qty1        = $("#qty1").val();
		var sat1        = $("#sat1").val();
		var qty2        = $("#qty2").val();
		var sat2        = $("#sat2").val();
		var qty3        = $("#qty3").val();
		var sat3        = $("#sat3").val();
		
		if ( kd_brg == '' || ukuran == '' || nm_brg == '' || merk == '' || supp == '' || ket == '' || qty3 == '' || sat3 == '') 
		{
			swal({
				title               : "Cek Kembali",
				html                : "Harap Lengkapi Form Dahulu",
				type                : "info",
				confirmButtonText   : "OK"
			});
			return;
		}

		$.ajax({
			url        : '<?= base_url(); ?>Master/c_barang',
			type       : "POST",
			data       : $('#myForm').serialize(),
			dataType   : "JSON",
			beforeSend: function() {
				swal({
				title: 'loading ...',
				allowEscapeKey    : false,
				allowOutsideClick : false,
				onOpen: () => {
					swal.showLoading();
				}
				})
			},
			success: function(data) {
				if(data == true){
					// toastr.success('Berhasil Disimpan');						
					kosong();
					swal({
						title               : "Data",
						html                : "Berhasil Disimpan",
						type                : "success",
						confirmButtonText   : "OK"
					});
					kembaliList()
					
				} else {
					// toastr.error('Gagal Simpan');
					swal({
						title               : "Cek Kembali",
						html                : "Gagal Simpan",
						type                : "error",
						confirmButtonText   : "OK"
					});
					return;
				}
				reloadTable();
			},
			error: function(jqXHR, textStatus, errorThrown) {
				// toastr.error('Terjadi Kesalahan');
				
				swal.close();
				swal({
					title               : "Cek Kembali",
					html                : "Terjadi Kesalahan",
					type                : "error",
					confirmButtonText   : "OK"
				});
				
				return;
			}
		});

	}

	function add_data()
	{
		kosong()
		$(".row-input").attr('style', '')
		$(".row-list").attr('style', 'display:none')
		$("#sts_input").val('add');
		
		$("#btn-simpan").html(`<button type="button" onclick="simpan()" class="btn-tambah-produk btn  btn-primary"><b><i class="fa fa-save" ></i> Simpan</b> </button>`)
	}

	function kembaliList()
	{
		kosong()
		reloadTable()
		$(".row-input").attr('style', 'display:none')
		$(".row-list").attr('style', '')
	}

	function deleteData(id,no_po) 
	{
		// let cek = confirm("Apakah Anda Yakin?");
		swal({
			title: "HAPUS PEMBAYARAN",
			html: "<p> Apakah Anda yakin ingin menghapus file ini ?</p><br>"
			+"<strong>" +no_po+ " </strong> ",
			type               : "question",
			showCancelButton   : true,
			confirmButtonText  : '<b>Hapus</b>',
			cancelButtonText   : '<b>Batal</b>',
			confirmButtonClass : 'btn btn-success',
			cancelButtonClass  : 'btn btn-danger',
			cancelButtonColor  : '#d33'
		}).then(() => {

		// if (cek) {
			$.ajax({
				url: '<?= base_url(); ?>Transaksi/hapus',
				data: ({
					id         : no_po,
					jenis      : 'po_header',
					field      : 'no_po'
				}),
				type: "POST",
				beforeSend: function() {
					swal({
					title: 'loading ...',
					allowEscapeKey    : false,
					allowOutsideClick : false,
					onOpen: () => {
						swal.showLoading();
					}
					})
				},
				success: function(data) {
					toastr.success('Data Berhasil Di Hapus');
					swal.close();

					// swal({
					// 	title               : "Data",
					// 	html                : "Data Berhasil Di Hapus",
					// 	type                : "success",
					// 	confirmButtonText   : "OK"
					// });
					reloadTable();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					// toastr.error('Terjadi Kesalahan');
					swal({
						title               : "Cek Kembali",
						html                : "Terjadi Kesalahan",
						type                : "error",
						confirmButtonText   : "OK"
					});
					return;
				}
			});
		// }

		});


	}
</script>
