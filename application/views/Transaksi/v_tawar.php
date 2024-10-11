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
				<div class="col-md-2">No Penawaran</div>
				<div class="col-md-3">
					<input type="hidden" name="sts_input" id="sts_input">
					<input type="hidden" name="id_header_penawaran" id="id_header_penawaran">

					<input type="text" class="angka form-control" name="no_penawaran" id="no_penawaran" value="AUTO" readonly>
				</div>
				<div class="col-md-1"></div>
				
				<div class="col-md-2">Hal</div>
				<div class="col-md-3">
					<input type="text" class= "form-control" name="hal" id="hal"  oninput="this.value = this.value.toUpperCase()">
				</div>

			</div>
			
			<div class="card-body row" style="padding-bottom:1px;font-weight:bold">			
				<div class="col-md-2">Tanggal Penawaran</div>
				<div class="col-md-3">
					<input type="date" class="form-control" name="tgl_tawar" id="tgl_tawar" value ="<?= date('Y-m-d') ?>" >
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-2">Kepada</div>
				<div class="col-md-3">
					<input type="text" class= "form-control" name="kpd" id="kpd"  oninput="this.value = this.value.toUpperCase()">
				</div>
				
			</div>
			
			<div class="card-body row" style="padding-bottom:1px;font-weight:bold">
				
			<div class="col-md-2">Keterangan</div>
					<div class="col-md-3">
					<textarea type="text" class="form-control" name="ket" id="ket" ></textarea>
				</div>
				
				<div class="col-md-1"></div>
				<div class="col-md-2">Kepada Alamat :</div>
				<div class="col-md-3">
					<textarea type="text" class="form-control" name="alamat" id="alamat" ></textarea>
				</div>
			</div>
			
			<br>
			
			<!-- detail PO-->
			<hr>
			<div class="card-body row" style="padding:0 20px 20px;font-weight:bold">
				<div class="col-md-4" style="padding-right:0">List Item Penawaran</div>
				<div class="col-md-8">&nbsp;
				</div>
			</div>


			<div style="overflow:auto;white-space:nowrap;" >
				<table class="table table-hover table-striped table-bordered table-scrollable table-condensed" id="table_list_item" width="100%">
					<thead class="color-tabel">
						<tr>
							<th id="header_del">Delete</th>
							<th style="padding : 12px 50px">Nama Barang</th>
							<th style="padding : 12px 70px" >Spesifikasi</th>
							<th style="padding : 12px 50px" >Harga Satuan</th>
							<th style="padding : 12px 50px" >MoQ</th>
							<th style="padding : 12px 50px" >Note</th>
						</tr>
					</thead>
					<tbody>
						<tr id="itemRow0">
							<td id="detail-hapus-0">
								<div class="text-center">
									<a class="btn btn-danger" id="btn-hapus-0" onclick="removeRow(0)">
										<i class="far fa-trash-alt" style="color:#fff"></i> 
									</a>
								</div>
							</td>

							<td style="padding : 12px 20px">
								<div class="input-group mb-1">
									<input type="text" size="5" name="nm_barang[0]" id="nm_barang0" class="form-control">
								</div>
							</td>		
							<td style="padding : 12px 20px">
								<div class="input-group mb-1">
									<input type="text" size="5" name="spek[0]" id="spek0" class="form-control">
								</div>
							</td>		
							<td style="padding : 12px 20px">
								<div class="input-group mb-1">
									<div class="input-group-append">
										<span class="input-group-text"><b>Rp</b>
										</span>
									</div>	
									<input type="text" size="5" name="hrg_sat[0]" id="hrg_sat0" class="angka form-control" onkeyup="ubah_angka(this.value,this.id),hitung_total()" value='0'>
								</div>
							</td>		
							<td style="padding : 12px 20px">
								<div class="input-group mb-1">
									<input type="text" size="5" name="moq[0]" id="moq0" class="angka form-control" onkeyup="ubah_angka(this.value,this.id)" value='0' >
										
								</div>
								
							</td>		
							<td style="padding : 12px 20px">
								<div class="input-group mb-1">
									<input type="text" size="5" name="note[0]" id="note0" class="form-control" value='-'>
										
								</div>
								
							</td>		
						</tr>
					</tbody>
				</table>
				<div id="add_button" >
					<!-- <button type="button" onclick="addRow()" class="btn-tambah-produk btn  btn-success"><b><i class="fa fa-plus" ></i></b></button>
					<input type="hidden" name="bucket" id="bucket" value="0"> -->
				</div>
				<br>
			</div>

			<!-- end detail PO-->

		
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
									<th class="text-center">NO PENAWARAN</th>
									<th class="text-center">TANGGAL</th>
									<th class="text-center">KEPADA</th>
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

	function jenis_beban(rowNum) 
	{
		option = "";
		$.ajax({
			type       : 'POST',
			url        : "<?= base_url(); ?>Transaksi/load_jenis_beban",
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
					option += `<option value="${val.kd}" data-nm="${val.nm}" >${val.nm}</option>`;

					});

					$('#jns_beban'+rowNum).html(option);
					$('.select2').select2({
						containerCssClass: "wrap",
						placeholder: '--- Pilih ---',
						dropdownAutoWidth: true
					});
					swal.close();
				}else{	
					option += "<option value=''></option>";
					$('#jns_beban'+rowNum).html(option);					
					swal.close();
				}
			}
		});
	}
	
	function jenis_beban2(rowNum,jns_beban) 
	{
		option = "";
		$.ajax({
			type       : 'POST',
			url        : "<?= base_url(); ?>Transaksi/load_jenis_beban",
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
					if(val.kd==jns_beban)
					{
						option += `<option value="${val.kd}" selected data-nm="${val.nm}" >${val.nm}</option>`;
					}else{
						option += `<option value="${val.kd}" data-nm="${val.nm}" >${val.nm}</option>`;
					}

					});

					$('#jns_beban'+rowNum).html(option);
					$('.select2').select2({
						containerCssClass: "wrap",
						placeholder: '--- Pilih ---',
						dropdownAutoWidth: true
					});
					swal.close();
				}else{	
					option += "<option value=''></option>";
					$('#jns_beban'+rowNum).html(option);					
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
		var ket         = $('#ket' + b).val();
		var jns_beban   = $('#jns_beban' + b).val();
		var nominal     = $('#nominal' + b).val();
			
		if (nominal != '0' && nominal != '' && jns_beban != '' && ket != '') 
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
								<input type="text" size="5" name="transaksi[${ rowNum }]" id="transaksi${ rowNum }" class="form-control">
							</div>
						</td>		

						<td style="padding : 12px 20px">
							<div class="input-group mb-1">
								<select name="jns_beban[${ rowNum }]"  id="jns_beban${ rowNum }" class="form-control select2" style="width: 100%">
								</select>	
							</div>
						</td>		
						<td style="padding : 12px 20px">
							<div class="input-group mb-1">
								<div class="input-group-append">
									<span class="input-group-text"><b>Rp</b>
									</span>
								</div>	
								<input type="text" size="5" name="nominal[${ rowNum }]" id="nominal${ rowNum }" class="angka form-control" onkeyup="ubah_angka(this.value,this.id),hitung_total()" value='0'>
									
							</div>
							
						</td>		
					</tr>
					`);
				jenis_beban(rowNum);
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
		// var diskon        = $("#diskon").val()
		// diskon_ok         = (diskon=='' || isNaN(diskon) || diskon == null) ? '0' : diskon;
		// var disk_total    = parseInt(diskon_ok.split('.').join(''));
		
		// var pajak         = $("#pajak").val()
		// var total_hrg_sat = 0
		// for(loop = 0; loop <= rowNum; loop++)
		// {
		// 	var hrg_sat = $("#hrg_sat"+loop).val()
		// 	if(hrg_sat=='')
		// 	{
		// 		hrg_sat1 = 0;
		// 	}else{
		// 		hrg_sat1 = hrg_sat;
		// 	}
		// 	var hrg_sat   = parseInt(hrg_sat1.split('.').join(''))
			
		// 	var qty = $("#qty"+loop).val()
		// 	if(qty=='')
		// 	{
		// 		qty1 = 0;
		// 	}else{
		// 		qty1 = qty;
		// 	}
		// 	var qty   = parseInt(qty1.split('.').join(''))
			
		// 	total_hrg_sat += hrg_sat*qty;			
		// 	$("#jum"+loop).val(format_angka(total_hrg_sat))
		// }		
		// total_hrg_sat_ok = (total_hrg_sat=='' || isNaN(total_hrg_sat) || total_hrg_sat == null) ? 0 : total_hrg_sat
		
		// if(pajak=='PPN')
		// {
		// 	var ppn_total    = (total_hrg_sat_ok *0.11).toFixed(0);
		// }else{
		// 	var ppn_total   = 0
		// }
		
		// var total_all     = parseInt(total_hrg_sat_ok)-parseInt(disk_total)+parseInt(ppn_total)
		
		// $("#disk_total").val(format_angka(disk_total))
		// $("#pajak_total").val(format_angka(ppn_total))
		// $("#total_all").val(format_angka(total_all))
		
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
				"url": '<?php echo base_url('Transaksi/load_data/penawaran')?>',
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
			data       : { id, jenis :'edit_inv_beli' },
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
					$("#id_header_beli").val(data.header.id_header_beli);
					$("#no_inv_beli").val(data.header.no_inv_beli);
					$("#id_hub").val(data.header.id_hub).trigger('change');
					$("#id_supp").val(data.header.id_supp).trigger('change');
					$("#tgl_inv").val(data.header.tgl_inv_beli);
					$("#pajak").val(data.header.pajak);
					$("#ket").val(data.header.ket);
					$("#diskon").val(format_angka(data.header.diskon));	
					
					swal.close();
					// detail

					var list = `
						<table class="table table-hover table-striped table-bordered table-scrollable table-condensed" id="table_list_item" width="100%">
							<thead class="color-tabel">
								<tr>
									<th id="header_del">Delete</th>
									<th style="padding : 12px 50px">Transaksi</th>
									<th style="padding : 12px 70px" >Jenis Beban</th>
									<th style="padding : 12px 50px" >Nominal</th>
								</tr>
							</thead>`;
						
					var no   = 0;
					$.each(data.detail, function(index, val) {
						
						jenis_beban2(no,val.jns_beban)	
						list += `
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
										<input type="text" size="5" name="transaksi[${ no }]" id="transaksi${ no }" class="form-control" value="${(val.transaksi)}">
									</div>
								</td>		

								<td style="padding : 12px 20px">
									<div class="input-group mb-1">
										<select name="jns_beban[${ no }]"  id="jns_beban${ no }" class="form-control select2" style="width: 100%">
											<option value="${val.jns_beban}" selected data-nm="${val.nm}" >${val.jns_beban}</option>
										</select>	
									</div>
								</td>		
								<td style="padding : 12px 20px">
									<div class="input-group mb-1">
										<div class="input-group-append">
											<span class="input-group-text"><b>Rp</b>
											</span>
										</div>	
										<input type="text" size="5" name="nominal[${ no }]" id="nominal${ no }" class="angka form-control" onkeyup="ubah_angka(this.value,this.id),hitung_total()" value="${format_angka(val.nominal)}">
											
									</div>
									
								</td>		
							</tr>
						`;
						no ++;
					})
					
					list +=`<tfoot>
								<tr>
									<td colspan="3" class="text-right">
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
									<td colspan="3" class="text-right">
										<label for="total">DISKON</label>
									</td>	
									<td>
										<div class="input-group mb-1">
											<div class="input-group-append">
												<span class="input-group-text"><b>Rp</b>
												</span>
											</div>		
											<input type="text" size="5" name="disk_total" id="disk_total" class="angka form-control" value='0' readonly>
										</div>
										
									</td>	
								</tr>
								<tr>
									<td colspan="3" class="text-right">
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
									<td colspan="3" class="text-right">
										<label for="total">PPH</label>
									</td>	
									<td>
										<div class="input-group mb-1">
											<div class="input-group-append">
												<span class="input-group-text"><b>Rp</b>
												</span>
											</div>		
											<input type="text" size="5" name="pph_total" id="pph_total" class="angka form-control" value='0' readonly>
										</div>
										
									</td>	
								</tr>
								<tr>
									<td colspan="3" class="text-right">
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
					rowNum = no-1 
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

	// MODAL //
	function open_modal(id,no_invoice) 
	{		
		$("#modalForm").modal("show");
		$("#judul").html('<h3> VERIFIKASI OWNER </h3>');
		
		$.ajax({
			url        : '<?= base_url(); ?>Transaksi/load_data_1',
			type       : "POST",
			data       : { id, jenis :'edit_inv_beli' },
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
					$("#m_id_header_beli").val(data.header.id_header_beli);
					$("#m_no_inv_beli").val(data.header.no_inv_beli);
					$("#m_id_hub").val(data.header.nm_hub);
					$("#m_id_supp").val(data.header.nm_supp);
					$("#m_tgl_inv").val(data.header.tgl_inv_beli);
					$("#m_pajak").val(data.header.pajak); 
					$("#m_ket").val(data.header.ket);
					$("#m_diskon").val(format_angka(data.header.diskon));	
					
					swal.close();

					if(data.header.acc_owner == 'Y')
					{
						$("#modal_btn_verif").html(`<button type="button" class="btn btn-success" id="modal_btn_verif" onclick="acc_inv('Y')"><i class="fas fa-lock"></i><b> BATAL VERIFIKASI </b></button>`)
					}else{
						$("#modal_btn_verif").html(`<button type="button" class="btn btn-success" id="modal_btn_verif" onclick="acc_inv('N')"><i class="fas fa-check"></i><b> VERIFIKASI </b></button>`)

					}
					// detail

					var list = `
						<table class="table table-hover table-striped table-bordered table-scrollable table-condensed" id="m_table_list_item" width="100%">
							<thead class="color-tabel">
								<tr>
									<th style="padding : 12px 50px">Transaksi</th>
									<th style="padding : 12px 70px" >Jenis Beban</th>
									<th style="padding : 12px 50px" >Nominal</th>
								</tr>
							</thead>`;
						
					var no   = 0;
					$.each(data.detail, function(index, val) {
							
						list += `
							<tr id="m_itemRow${ no }">
								<td style="padding : 12px 20px">
									<div class="input-group mb-1">
										<input type="text" size="5" name="m_transaksi[${ no }]" id="m_transaksi${ no }" class="form-control" value="${(val.transaksi)}" readonly>
									</div>
								</td>		

								<td style="padding : 12px 20px">
									<div class="input-group mb-1">
										<input type="text"  name="m_jns_beban[${ no }]" id="m_jns_beban${ no }" class="form-control" value="${(val.nm)}" readonly>
									</div>
								</td>		
								<td style="padding : 12px 20px">
									<div class="input-group mb-1">
										<div class="input-group-append">
											<span class="input-group-text"><b>Rp</b>
											</span>
										</div>	
										<input type="text" size="5" name="m_nominal[${ no }]" id="m_nominal${ no }" class="angka form-control" onkeyup="ubah_angka(this.value,this.id),m_hitung_total()" value="${format_angka(val.nominal)}" readonly>
											
									</div>
									
								</td>		
							</tr>
						`;
						no ++;
					})
					
					list +=`<tfoot>
								<tr>
									<td colspan="2" class="text-right">
										<label for="total">SUB TOTAL</label>
									</td>	
									<td>
										<div class="input-group mb-1">
											<div class="input-group-append">
												<span class="input-group-text"><b>Rp</b>
												</span>
											</div>		
											<input type="text" size="5" name="m_total_nom" id="m_total_nom" class="angka form-control" value='0' readonly>
										</div>
										
									</td>	
								</tr>
								<tr>
									<td colspan="2" class="text-right">
										<label for="total">DISKON</label>
									</td>	
									<td>
										<div class="input-group mb-1">
											<div class="input-group-append">
												<span class="input-group-text"><b>Rp</b>
												</span>
											</div>		
											<input type="text" size="5" name="m_disk_total" id="m_disk_total" class="angka form-control" value='0' readonly>
										</div>
										
									</td>	
								</tr>
								<tr>
									<td colspan="2" class="text-right">
										<label for="total">PPN</label>
									</td>	
									<td>
										<div class="input-group mb-1">
											<div class="input-group-append">
												<span class="input-group-text"><b>Rp</b>
												</span>
											</div>		
											<input type="text" size="5" name="m_pajak_total" id="m_pajak_total" class="angka form-control" value='0' readonly>
										</div>
										
									</td>	
								</tr>
								<tr>
									<td colspan="3" class="text-right">
										<label for="total">PPH</label>
									</td>	
									<td>
										<div class="input-group mb-1">
											<div class="input-group-append">
												<span class="input-group-text"><b>Rp</b>
												</span>
											</div>		
											<input type="text" size="5" name="m_pph_total" id="m_pph_total" class="angka form-control" value='0' readonly>
										</div>
										
									</td>	
								</tr>
								<tr>
									<td colspan="2" class="text-right">
										<label for="total">TOTAL</label>
									</td>	
									<td>
										<div class="input-group mb-1">
											<div class="input-group-append">
												<span class="input-group-text"><b>Rp</b>
												</span>
											</div>		
											<input type="text" size="5" name="m_total_all" id="m_total_all" class="angka form-control" value='0' readonly>
										</div>
										
									</td>	
								</tr>
							</tfoot>`;
					rowNum = no-1 
					$('#m_bucket').val(rowNum);					
					$("#m_table_list_item").html(list);
					m_hitung_total()	
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
		$("#id_hub").val('').trigger('change');	
		$("#id_supp").val('').trigger('change');	
		$("#pajak").val('').trigger('change');	
		$("#diskon").val('') 
		$("#diskon").val('') 
		$("#ket").val('') 		
		$("#tgl_inv").val($tgl) 
		$("#no_inv_beli").val('AUTO') 

		$("#transaksi0").val('');			
		$("#jns_beban0").val('').trigger('change');	
		$("#nominal0").val(0);		
		// load_hub()
		clearRow()
		hitung_total()
		
		swal.close()
	}

	function simpan() 
	{
		var id_header_penawaran   = $("#id_header_penawaran").val();
		var hal                   = $("#hal").val();
		var tgl_tawar             = $("#tgl_tawar").val();
		var kpd                   = $("#kpd").val();
		var ket                   = $("#ket").val();
		var alamat                = $("#alamat").val();		
		
		if ( hal  == '' || tgl_tawar  == '' || kpd  == '' || ket  == '' || alamat  == '' ) 
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
			url        : '<?= base_url(); ?>Transaksi/Insert_penawaran',
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

	function deleteData(id,no_inv_beli) 
	{
		// let cek = confirm("Apakah Anda Yakin?");
		swal({
			title: "HAPUS PEMBAYARAN",
			html: "<p> Apakah Anda yakin ingin menghapus file ini ?</p><br>"
			+"<strong>" +no_inv_beli+ " </strong> ",
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
					id         : no_inv_beli,
					jenis      : 'inv_beli',
					field      : 'no_inv_beli'
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
