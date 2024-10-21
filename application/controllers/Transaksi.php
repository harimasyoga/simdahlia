<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("Login"));
		}
		$this->load->model('m_master');
		$this->load->model('m_transaksi');
	}

	function Opb()
	{
		$data = [
			'judul' => "OPB",
		];
		$this->load->view('header',$data);
		if($this->session->userdata('level'))
		{
			$this->load->view('Transaksi/v_opb', $data);
		}else{
			$this->load->view('home');
		}
		$this->load->view('footer');

	}


	// public function PO()
	// {
	// 	$data = array(
	// 		'judul' => "Purchase Order",
	// 		'produk' => $this->db->query("SELECT * FROM m_produk order by id_produk")->result(),
	// 		'sales' => $this->db->query("SELECT * FROM m_sales order by id_sales")->result(),
	// 		'pelanggan' => $this->db->query("SELECT * FROM m_pelanggan a 
    //         left join m_kab b on a.kab=b.kab_id 
    //         Left Join m_sales c on a.id_sales=c.id_sales
    //         order by id_pelanggan")->result(),
	// 		'level' => $this->session->userdata('level'). "aa",
	// 	);

	// 	$this->load->view('header', $data);
	// 	$this->load->view('Transaksi/v_po', $data);
	// 	$this->load->view('footer');
	// }
	
	public function PO()
	{
		$data = array(
			'judul' => "ORDER PEMBELIAN",
		);
		$this->load->view('header', $data);
		$this->load->view('Transaksi/v_po');
		$this->load->view('footer');
	}

	public function Penawaran_harga()
	{
		$data = array(
			'judul' => "PENAWARAN HARGA",
		);
		$this->load->view('header', $data);
		$this->load->view('Transaksi/v_tawar');
		$this->load->view('footer');
	}

	function load_produk()
    {
        
		$pl = $this->input->post('idp');
		$kd = $this->input->post('kd');

        if($pl !='' && $kd ==''){
            $cek ="where no_customer = '$pl' ";
        }else if($pl =='' && $kd !=''){
            $cek ="where id_produk = '$kd' ";
        }else {
            $cek ="";
        }

        $query = $this->db->query("SELECT * FROM m_produk $cek order by id_produk ")->result();

            if (!$query) {
                $response = [
                    'message'	=> 'not found',
                    'data'		=> [],
                    'status'	=> false,
                ];
            }else{
                $response = [
                    'message'	=> 'Success',
                    'data'		=> $query,
                    'status'	=> true,
                ];
            }
            $json = json_encode($response);
            print_r($json);
    }
   
    function load_produk_1()
    {
        
		$pl = $this->input->post('idp');
		$kd = $this->input->post('kd');

        if($pl !='' && $kd ==''){
            $cek ="where no_customer = '$pl' ";
        }else if($pl =='' && $kd !=''){
            $cek ="where id_produk = '$kd' ";
        }else {
            $cek ="";
        }

        $query = $this->db->query("SELECT * FROM m_produk $cek order by id_produk ")->row();

        echo json_encode($query);
    }
    
	function getMax()
	{
		$table  = $this->input->post('table');
		$fieald = $this->input->post('fieald');

		$data = [
			'no'       => $this->m_master->get_data_max($table, $fieald),
			'bln'      => $this->m_master->get_romawi(date('m')),
			'tahun'    => date('Y')
		];
		echo json_encode($data);
	}

	function Insert()
	{

		$jenis    = $this->input->post('jenis');
		$status   = $this->input->post('status');

		$result   = $this->m_transaksi->$jenis($jenis, $status);
		echo json_encode($result);
	}

	function Insert_po()
	{
		if($this->session->userdata('username'))
		{ 
			$result = $this->m_transaksi->save_po();
			echo json_encode($result);
		}
		
	}

	function Insert_penawaran()
	{
		if($this->session->userdata('username'))
		{ 
			$result = $this->m_transaksi->save_penawaran();
			echo json_encode($result);
		}
		
	}

	function load_data()
	{
		$jenis        = $this->uri->segment(3);
		$data         = array();

		if ($jenis == "po") 
		{						
			$query = $this->db->query("SELECT*FROM po_header
			ORDER BY tgl_po")->result();

			$i               = 1;
			foreach ($query as $r) 
			{

				$rinci_stok  = $this->db->query("SELECT*FROM po_detail where no_po ='$r->no_po'");

				$hrg_sat = 0;
				foreach ($rinci_stok->result() as $row_detail) 
				{
					$hrg_sat   += $row_detail->hrg_sat;
				}		

				$total_hrg_sat = $hrg_sat;
				
				if($r->pajak=='PPN')
				{
					$ppn_total    = ROUND($total_hrg_sat *0.11);
				}else{
					$ppn_total   = 0;
				}
				
				$total_all     = $total_hrg_sat - $r->diskon + $ppn_total;

				$id       = "'$r->id_header_po'";
				$no_po    = "'$r->no_po'";

				if($r->acc_owner=='N')
                {
                    $btn2   = 'btn-warning';
                    $i2     = '<i class="fas fa-lock"></i>';
                } else {
                    $btn2   = 'btn-success';
                    $i2     = '<i class="fas fa-check-circle"></i>';
                }
				
				if (in_array($this->session->userdata('username'), ['bumagda','developer']))
				{
					// $urll2 = "onclick=open_modal('$r->id_header_po','$r->no_po')";
					$urll2 = "onclick=acc_inv('$r->no_po','$r->acc_owner')";
				} else {
					$urll2 = '';
				}

				if($r->pajak=='PPN_PPH')
				{
					$pajak = 'PPN - PPH';
				}else{
					$pajak = $r->pajak;
				}
					
				$row    = array();
				$row[]  = '<div class="text-center">'.$i.'</div>';
				$row[]  = '<div class="text-center">'.$r->no_po.'</div>';
				$row[]  = '<div class="text-center">'.$r->tgl_po.'</div>';
				$row[]  = '<div class="text-center">'.$r->supp.'</div>';

				// // Pembayaran
				// $bayar = $this->db->query("SELECT SUM(jumlah_bayar) AS byr_beli from trs_bayar_inv_beli where no_inv_beli='$r->no_inv_beli' GROUP BY no_inv_beli");

				// if ($r->acc_owner == "N") 
				// {
				// 	$txtB            = 'btn-light';
				// 	$txtT            = '-';
				// 	$kurang_bayar    = '';
				// }else{

				// 	if($bayar->num_rows() == 0){
				// 		$txtB           = 'btn-danger';
				// 		$txtT           = 'BELUM BAYAR';
				// 		$kurang_bayar   = '';
				// 	}
					
				// 	if($bayar->num_rows() > 0){
				// 		if($bayar->row()->byr_beli == round($total_all)){
				// 			$txtB            = 'btn-success';
				// 			$txtT            = 'LUNAS';
				// 			$kurang_bayar    = '';
				// 		}else{
				// 			$txtB            = 'btn-warning';
				// 			$txtT            = 'DI CICIL';
				// 			$kurang_bayar    = '<br><span style="color:#ff5733">'.number_format($total_all-$bayar->row()->byr_beli,0,',','.').'</span>';
				// 		}
				// 	}
				// }
				// $row[] = '<div class="text-center">
				// 	<button type="button" class="btn btn-xs '.$txtB.'" style="font-weight:bold" >'.$txtT.'</button><br>
				// </div>';


				// $row[]  = '<div class="text-center">'.$pajak.'</div>';

				$row[]  = '
						<div class="text-center"><a style="text-align: center;" class="btn btn-sm '.$btn2.' " '.$urll2.' title="VERIFIKASI DATA" ><b>'.$i2.' </b> </a><span style="font-size:1px;color:transparent">'.$r->acc_owner.'</span><div>';

				$btncetak ='<a target="_blank" class="btn btn-sm btn-danger" href="' . base_url("
				Transaksi/Cetak_po?no_po="."$r->no_po"."") . '" title="Cetak" ><i class="fas fa-print"></i> </a>';

				$btnEdit = '<a class="btn btn-sm btn-warning" onclick="edit_data(' . $id . ',' . $no_po . ')" title="EDIT DATA" >
				<b><i class="fa fa-edit"></i> </b></a>';

				$btnHapus = '<button type="button" title="DELETE"  onclick="deleteData(' . $id . ',' . $no_po . ')" class="btn btn-secondary btn-sm">
				<i class="fa fa-trash-alt"></i></button> ';
					
				if (in_array($this->session->userdata('level'), ['Admin','konsul_keu','User','Keuangan1']))
				{
					if ($r->acc_owner == "N") 
					{						
						$row[] = '<div class="text-center">'.$btnEdit.' '.$btncetak.' '.$btnHapus.'</div>';
					}else{

						if($bayar->num_rows() == 0)
						{
							$row[] = '<div class="text-center">'.$btnEdit.' '.$btncetak.' '.$btnHapus.'</div>';
						}else{
							$row[] = '<div class="text-center">'.$btnEdit.' '.$btncetak.'</div>';

						}
						
						
					}

				}else{
					$row[] = '<div class="text-center"></div>';
				}
				
				$data[] = $row;
				$i++;
			}
		}else if ($jenis == "penawaran") 
		{						
				$query = $this->db->query("SELECT*FROM penawaran_header
				ORDER BY tgl_penawaran")->result();
	
				$i               = 1;
				foreach ($query as $r) 
				{
	
					$rinci_stok  = $this->db->query("SELECT*FROM penawaran_detail where no_penawaran ='$r->no_penawaran'");
	
					$hrg_sat = 0;
					foreach ($rinci_stok->result() as $row_detail) 
					{
						$hrg_sat   += $row_detail->hrg_sat;
					}		
	
					$total_hrg_sat = $hrg_sat;
					$total_all     = $total_hrg_sat;
	
					$id              = "'$r->id_header_penawaran'";
					$no_penawaran    = "'$r->no_penawaran'";
	
					if($r->acc_owner=='N')
					{
						$btn2   = 'btn-warning';
						$i2     = '<i class="fas fa-lock"></i>';
					} else {
						$btn2   = 'btn-success';
						$i2     = '<i class="fas fa-check-circle"></i>';
					}
					
					if (in_array($this->session->userdata('username'), ['bumagda','developer']))
					{
						// $urll2 = "onclick=open_modal('$r->id_header_penawaran','$r->no_penawaran')";
						$urll2 = "onclick=acc_inv('$r->no_penawaran','$r->acc_owner')";
					} else {
						$urll2 = '';
					}
						
					$row    = array();
					$row[]  = '<div class="text-center">'.$i.'</div>';
					$row[]  = '<div class="text-center">'.$r->no_penawaran.'</div>';
					$row[]  = '<div class="text-center">'.$r->tgl_penawaran.'</div>';
					$row[]  = '<div class="text-center">'.$r->kpd.'</div>';
	
					// // Pembayaran
					// $bayar = $this->db->query("SELECT SUM(jumlah_bayar) AS byr_beli from trs_bayar_inv_beli where no_inv_beli='$r->no_inv_beli' GROUP BY no_inv_beli");
	
					// if ($r->acc_owner == "N") 
					// {
					// 	$txtB            = 'btn-light';
					// 	$txtT            = '-';
					// 	$kurang_bayar    = '';
					// }else{
	
					// 	if($bayar->num_rows() == 0){
					// 		$txtB           = 'btn-danger';
					// 		$txtT           = 'BELUM BAYAR';
					// 		$kurang_bayar   = '';
					// 	}
						
					// 	if($bayar->num_rows() > 0){
					// 		if($bayar->row()->byr_beli == round($total_all)){
					// 			$txtB            = 'btn-success';
					// 			$txtT            = 'LUNAS';
					// 			$kurang_bayar    = '';
					// 		}else{
					// 			$txtB            = 'btn-warning';
					// 			$txtT            = 'DI CICIL';
					// 			$kurang_bayar    = '<br><span style="color:#ff5733">'.number_format($total_all-$bayar->row()->byr_beli,0,',','.').'</span>';
					// 		}
					// 	}
					// }
					// $row[] = '<div class="text-center">
					// 	<button type="button" class="btn btn-xs '.$txtB.'" style="font-weight:bold" >'.$txtT.'</button><br>
					// </div>';
	
	
					// $row[]  = '<div class="text-center">'.$pajak.'</div>';
	
					$row[]  = '
							<div class="text-center"><a style="text-align: center;" class="btn btn-sm '.$btn2.' " '.$urll2.' title="VERIFIKASI DATA" ><b>'.$i2.' </b> </a><span style="font-size:1px;color:transparent">'.$r->acc_owner.'</span><div>';
	
					$btncetak ='<a target="_blank" class="btn btn-sm btn-danger" href="' . base_url("
					Transaksi/Cetak_penawaran?no_penawaran="."$r->no_penawaran"."") . '" title="Cetak" ><i class="fas fa-print"></i> </a>';
	
					$btnEdit = '<a class="btn btn-sm btn-warning" onclick="edit_data(' . $id . ',' . $no_penawaran . ')" title="EDIT DATA" >
					<b><i class="fa fa-edit"></i> </b></a>';
	
					$btnHapus = '<button type="button" title="DELETE"  onclick="deleteData(' . $id . ',' . $no_penawaran . ')" class="btn btn-secondary btn-sm">
					<i class="fa fa-trash-alt"></i></button> ';
						
					if (in_array($this->session->userdata('level'), ['Admin','konsul_keu','User','Keuangan1']))
					{
						if ($r->acc_owner == "N") 
						{						
							$row[] = '<div class="text-center">'.$btnEdit.' '.$btncetak.' '.$btnHapus.'</div>';
						}else{
	
							if($bayar->num_rows() == 0)
							{
								$row[] = '<div class="text-center">'.$btnEdit.' '.$btncetak.' '.$btnHapus.'</div>';
							}else{
								$row[] = '<div class="text-center">'.$btnEdit.' '.$btncetak.'</div>';
	
							}
							
							
						}
	
					}else{
						$row[] = '<div class="text-center"></div>';
					}
					
					$data[] = $row;
					$i++;
				}
			
			
			} else if ($jenis == "trs_so_detail") {
			$query = $this->db->query("SELECT d.id AS id_po_detail,p.kode_mc,d.tgl_so,p.nm_produk,d.status_so,COUNT(s.rpt) AS c_rpt,l.nm_pelanggan,s.* FROM trs_po_detail d
			INNER JOIN trs_so_detail s ON d.no_po=s.no_po AND d.kode_po=s.kode_po AND d.no_so=s.no_so AND d.id_produk=s.id_produk
			INNER JOIN m_produk p ON d.id_produk=p.id_produk
			INNER JOIN m_pelanggan l ON d.id_pelanggan=l.id_pelanggan
			WHERE d.no_so IS NOT NULL AND d.tgl_so IS NOT NULL AND d.status_so IS NOT NULL
			GROUP BY d.id DESC")->result();
			$i = 1;
			foreach ($query as $r) {
				$row = array();
				$row[] = '<div class="text-center"><a href="javascript:void(0)" onclick="tampilEditSO('."'".$r->id_po_detail."'".','."'".$r->no_po."'".','."'".$r->kode_po."'".','."'detail'".')">'.$i."<a></div>";
				$row[] = $r->tgl_so;
				$row[] = $r->kode_mc;
				$row[] = $r->nm_produk;
				$row[] = $r->nm_pelanggan;

				$urut_so = str_pad($r->urut_so, 2, "0", STR_PAD_LEFT);
				$row[] = $r->no_so.'.'.$urut_so.'('.$r->c_rpt.')';
				if ($r->status_so == 'Open') {
					$aksi = '<button type="button" onclick="tampilEditSO('."'".$r->id_po_detail."'".','."'".$r->no_po."'".','."'".$r->kode_po."'".','."'edit'".')" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>';
				}else{
					$aksi = '-';
				}
				$row[] = '<div class="text-center">'.$aksi.'</div>';
				$data[] = $row;
				$i++;
			}
		} else if ($jenis == "trs_wo") {
			$query = $this->m_master->query("SELECT a.id as id_wo,a.*,b.*,c.*,d.* FROM trs_wo a 
            JOIN trs_wo_detail b ON a.no_wo=b.no_wo 
            JOIN m_produk c ON a.id_produk=c.id_produk 
            JOIN m_pelanggan d ON a.id_pelanggan=d.id_pelanggan 
            order by a.id desc")->result();
			$i = 1;
			foreach ($query as $r) {

				if($r->kategori=='K_BOX'){
					$type ='BOX';
				}else{
					$type ='SHEET';
				}

				if($r->status == 'Open')
                {
                    $btn_status   = 'btn-info';
                }else if($r->status == 'Approve')
                {
                    $btn_status   = 'btn-success';
                }else{
                    $btn_status   = 'btn-danger';
                }

				$row = array();
				$row[] = '<div class="text-center">'.$i.'</div>';
				$row[] = '<a href="javascript:void(0)" onclick="tampil_edit(' . "'" . $r->id_wo . "'" . ',' . "'detail'" . ')">' . $r->no_wo . "<a>";
                
				$row[] = '<div class="text-center">'.$type.'</div';
				$row[] = $this->m_fungsi->tanggal_ind($r->tgl_wo);
				// $row[] = $r->no_so;
				$row[] = $this->m_fungsi->tanggal_ind($r->tgl_so);
				$row[] = '<div class="text-center btn btn-sm '.$btn_status.'">'.$r->status.'</div';
				$row[] = $r->kode_mc;
				$row[] = '<div class="text-center">'.number_format($r->qty, 0, ",", ".").'</div';
				// $row[] = $r->id_pelanggan;
				$row[] = $r->nm_pelanggan;

				if ($r->status == 'Open') {

                    $aksi = ' 
							<button type="button" onclick="tampil_edit(' . "'" . $r->id_wo . "'" . ',' . "'edit'" . ')" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>

							<a target="_blank" class="btn btn-sm btn-warning" href="' . base_url("Transaksi/Cetak_WO?no_wo=" . $r->no_wo . "") . '" title="Cetak" ><i class="fas fa-print"></i> </a>

                            <button type="button" onclick="deleteData(' . "'" . $r->id_wo . "'" . ',' . "'" . $r->no_wo . "'" . ')" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash-alt"></i>
                            </button>  
                            ';

				} else {
					$aksi = '-';
				}

				$row[] = $aksi;

				$data[] = $row;

				$i++;
			}
		} else if ($jenis == "trs_surat_jalan") {
			$query = $this->m_master->query("SELECT *,sum(qty) as tot_qty FROM trs_surat_jalan group by no_surat_jalan,no_po order by id")->result();
			$i = 1;
			foreach ($query as $r) {
				$row = array();

				$row[] = $i;
				$row[] = '<a href="javascript:void(0)" onclick="tampil_edit(' . "'" . $r->id . "'" . ',' . "'detail'" . ')">' . $r->no_surat_jalan . "<a>";
				$row[] = $r->tgl_surat_jalan;
				$row[] = $r->status;
				$row[] = $r->no_po;
				$row[] = $r->id_produk;
				$row[] = $r->tot_qty;
				$row[] = $r->id_pelanggan;
				$row[] = $r->nm_pelanggan;

				if ($r->status == 'Open') {
					$aksi = ' 
                            <button type="button" onclick="deleteData(' . "'" . $r->id . "'" . ')" class="btn btn-danger btn-xs">
                               Batal
                            </button> ';
				} else {
					$aksi = '-';
				}

				$row[] = $aksi;

				$data[] = $row;

				$i++;
			}
		}

		$output = array(
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function load_data_1()
	{
		$id       = $this->input->post('id');
		$no       = $this->input->post('no');
		$jenis    = $this->input->post('jenis');

		if($jenis=='edit_po')
		{
			$queryh   = "SELECT*FROM po_header a 
			join po_detail b on a.no_po=b.no_po
			where a.no_po = '$no'
			ORDER BY a.tgl_po,b.id_po_det";
			
			$queryd   = "SELECT*FROM po_detail where no_po= '$no'";
		}else if($jenis=='edit_tawar')
		{
			$queryh   = "SELECT*FROM penawaran_header where no_penawaran='$no' ORDER BY tgl_penawaran";
				
			$queryd   = "SELECT*FROM penawaran_detail b where no_penawaran='$no' 
				ORDER BY b.id_penawaran_det";
		}else if($jenis=='spill')
		{
			$queryh   = "SELECT *,IFNULL((select sum(jumlah_bayar) from trs_bayar_inv t
			where t.no_inv=a.no_invoice
			group by no_inv),0) jum_bayar FROM invoice_header a where a.id='$id' and a.no_invoice='$no'";
			
			$queryd   = "SELECT*FROM invoice_detail where no_invoice='$no' ORDER BY TRIM(no_surat) ";
		}else{

			$queryh   = "SELECT*FROM invoice_header a where a.id='$id' and a.no_invoice='$no'";
			$queryd   = "SELECT*FROM invoice_detail where no_invoice='$no' ORDER BY TRIM(no_surat) ";
		}
		

		$header   = $this->db->query($queryh)->row();
		$detail   = $this->db->query($queryd)->result();
		$data     = ["header" => $header, "detail" => $detail];

        echo json_encode($data);
	}

	function hapus()
	{
		$jenis    = $_POST['jenis'];
		$field    = $_POST['field'];
		$id       = $_POST['id'];

		if ($jenis == "po_header") {
			$result = $this->m_master->query("DELETE FROM $jenis WHERE  $field = '$id'");
			$result = $this->m_master->query("DELETE FROM po_detail WHERE  $field = '$id'");
		} else if ($jenis == "penawaran_header") {
			$result = $this->m_master->query("DELETE FROM $jenis WHERE  $field = '$id'");
			$result = $this->m_master->query("DELETE FROM penawaran_detail WHERE  $field = '$id'");
		}else{

			$result = $this->m_master->query("DELETE FROM $jenis WHERE  $field = '$id'");
		}

		echo json_encode($result);
	}

	function batal()
	{
		$jenis   = $_POST['jenis'];
		$field   = $_POST['field'];
		$id = $_POST['id'];

		$result = $this->m_transaksi->batal($id, $jenis, $field);


		echo json_encode($result);
	}

	function prosesData()
	{
		$jenis   = $_POST['jenis'];

		$result = $this->m_transaksi->$jenis();


		echo json_encode($result);
	}

	function Verifikasi_all()
	{
		$id  = $_GET['no_po'];

		if ($this->session->userdata('level') == "Admin") {
			
		}


		echo json_encode($result);
	}

	function Cetak_po()
	{
		$no_po  = $_GET['no_po'];

        $query_header = $this->db->query("SELECT*FROM po_header a 
			join po_detail b on a.no_po=b.no_po
			where a.no_po = '$no_po'
			ORDER BY a.tgl_po,b.id_po_det");
        
        $data = $query_header->row();
        
        $query_detail = $this->db->query("SELECT*FROM po_detail where no_po= '$no_po'");

		$html = '';

		if ($query_header->num_rows() > 0) 
		{

			$html .= '<table width="100%" border="0" cellspacing="0" style="font-size:14px;font-family: ;">
                        <tr style="font-weight: bold;">
                            <td colspan="5" align="center">
                            <b>( No. ' . $no_po . ' )</b>
                            </td>
                        </tr>
                 </table><br>';

            $html .= '<table width="100%" border="0" cellspacing="0" style="font-size:12px;font-family: ;">
			<tr>
                <td width="10 %" align="left">No PO</td>
                <td width="5 %" align="right"> : </td>
                <td width="30 %" > '. $data->no_po .'</td>
                <td width="5 %" ></td>
                <td width="15 %" align="left">TERMS</td>
                <td width="5 %" align="right"> : </td>
                <td width="35 %" > NET '. $data->terms .'</td>
            </tr>
            <tr>
                <td align="left">Tgl PO</td>
                <td align="right"> : </td>
                <td> '. $this->m_fungsi->tanggal_format_indonesia($data->tgl_po) .'</td>
				
                <td></td>
                <td align="left">FOB</td>
                <td align="right"> : </td>
                <td> '. $data->fob .'</td>
            </tr>
            <tr>
                <td align="left">SUPPLIER</td>
                <td align="right"> : </td>
                <td> '. $data->supp .'</td>
				
                <td></td>
                <td align="left">Tgl di Minta</td>
                <td align="right"> : </td>
                <td> '. $this->m_fungsi->tanggal_format_indonesia($data->tgl_minta) .'</td>
            </tr>
           
            </table><br>';

			$html .='<table width="100%" border="1" cellspacing="1" cellpadding="3" style="border-collapse:collapse;font-size:12px;font-family: ;">

			<tr style="border:none"><td >Dengan Hormat,</td></tr>
			<tr style="border:none"><td >Mohon Kirimkan kepada kami barang - barang sebagai berikut : </td></tr>
			<tr style="border:none"><td >&nbsp;</td></tr>
			</table>';

			$html .= '<table width="100%" border="1" cellspacing="1" cellpadding="3" style="border-collapse:collapse;font-size:12px;font-family: ;">
                        <tr style="background-color: #cccccc">
							<th align="center">NO</th>
							<th align="center">NAMA</th>
							<th align="center">KETERANGAN</th>
                            <th align="center">QTY</th>
                            <th align="center">HARGA SATUAN</th>
                            <th align="center">JUMLAH</th>
						</tr>';
						
			$no              = 1;
			$jum_all    = 0;			
			foreach ($query_detail->result() as $r) 
			{
				$html .= '<tr>
						<td align="center">' . $no . '</td>
						<td align="">' . $r->nm_barang . '</td>
						<td align="">' . $r->ket . '</td>
						<td align="right">' . number_format($r->qty, 0, ",", ".") . ' PCS</td>
						<td align="right">' . number_format($r->hrg_sat, 0, ",", ".") . '</td>
						<td align="right">' . number_format($r->jum, 0, ",", ".") . '</td>
					</tr>';

				$jum_all += $r->jum;
				$no++;
			}

			$total_nominal = $jum_all;
				
			if($data->pajak=='PPN')
			{
				$ppn_total    = ROUND($total_nominal *0.11);
			}else if($data->pajak=='PPN_PPH')
			{
				$ppn_total   = ROUND($total_nominal *0.11);
			}else{
				$ppn_total   = 0;
			}
			
			$total_all     = $total_nominal - $data->diskon + $ppn_total;

			$html .='<tr style="">
						<td align="left" style="border:none" colspan="3"><b>&nbsp;</b></td>

						<td align="right" colspan="2" ><b>Sub Total</b></td>
						<td align="right" ><b>' . number_format($nominal_all, 0, ",", ".") . '</b></td>						
					</tr>
					<tr style="">
						<td align="left" style="border:none" colspan="3"><b>Catatan Tambahan :</b></td>
				
						<td align="right" colspan="2"><b>Diskon</b></td>
						<td align="right" ><b>' . number_format($data->diskon, 0, ",", ".") . '</b></td>						
					</tr>
					<tr style="">
						<td align="left" style="border:none" colspan="3"><b>'.$data->cttn.'</b></td>		
						<td align="right" colspan="2"><b>PPN</b></td>
						<td align="right" ><b>' . number_format($ppn_total, 0, ",", ".") . '</b></td>						
					</tr>
					<tr style="">
						<td align="left" style="border:none" colspan="3"><b>&nbsp;</b></td>
						<td align="right" colspan="2"><b>Total</b></td>
						<td align="right" ><b>' . number_format($total_all, 0, ",", ".") . '</b></td>						
					</tr>

					
					<tr style="border:none"><td align="right" colspan="6">&nbsp;</td></tr>
					<tr style="border:none"><td align="right" colspan="6">&nbsp;</td></tr>
					<tr style="border:none"><td align="right" colspan="6">&nbsp;</td></tr>
					';
			$html .= '</table>';

			
			$html .= '<table width="100%" border="0" cellspacing="0" style="font-size:12px;font-family: ;">
			<tr>
                <td width="15%" align="left">&nbsp;</td>
                <td width="30%" align="right"></td>
                <td width="10%" >&nbsp;</td>
                <td width="30%" align="center">Hormat Kami</td>
                <td width="15%" >&nbsp;</td>
            </tr>
			<tr>
                <td colspan="5">&nbsp;</td>
            </tr>
			<tr>
                <td colspan="5">&nbsp;</td>
            </tr>
			<tr>
                <td colspan="5">&nbsp;</td>
            </tr>
			<tr>
                <td align="left">&nbsp;</td>
                <td align="center" style="border-top: 1px solid black;">Direksi</td>
                <td align="left">&nbsp;</td>
                <td align="center" style="border-top: 1px solid black;">Bagian Pembelian</td>
                <td >&nbsp;</td>
            </tr>
           
            </table><br>';

			$html .='<table width="100%" border="1" cellspacing="1" cellpadding="3" style="border-collapse:collapse;font-size:12px;font-family: ;">

			<tr style="border:none"><td >Ket :</td></tr>
			<tr style="border:none"><td >*PPN akan muncul jika harga ber-PPN </td></tr>
			<tr style="border:none"><td >&nbsp;</td></tr>
			</table>';
			
			$html .='<table width="100%" border="0" cellspacing="1" cellpadding="3" style="border-collapse:collapse;font-size:12px;font-family: ;">

			<tr >
				<td >Lembar ke :</td>
				<td >1 . Supplier</td>
				<td >2. Bagian Akuntansi</td>
				<td >3. Bagian Pembelian</td>
				<td >4. Bagian Gudang</td>
			</tr>
			</table>';

			
		} else {
			$html .= '<h1> Data Kosong </h1>';
		}

		// echo $html;
		// $this->m_fungsi->_mpdf($html);
		$this->m_fungsi->template_kop('ORDER PEMBELIAN',$no_po,$html,'P','1');
		// $this->m_fungsi->mPDFP($html);
	}
	
	function Cetak_penawaran()
	{
		$no_penawaran  = $_GET['no_penawaran'];

        $query_header = $this->db->query("SELECT*FROM penawaran_header a 
				join penawaran_detail b on a.no_penawaran=b.no_penawaran
				where a.no_penawaran = '$no_penawaran'
				ORDER BY a.tgl_penawaran,b.id_penawaran_det");
        
        $data = $query_header->row();
        
        $query_detail = $this->db->query("SELECT*FROM penawaran_detail where no_penawaran= '$no_penawaran'");

		$html = '';

		if ($query_header->num_rows() > 0) 
		{

			$html .= "<table style=\"border-collapse:collapse;font-family: Century Gothic; font-size:13px; color:#000;\" width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
			 <thead>
				<tr><td>&nbsp; </td></tr>
				<tr><td>&nbsp; </td></tr>
				<tr>
					<td rowspan=\"5\" >
						<img src=\"" . base_url() . "assets/gambar/logo.png\"  width=\"80\" height=\"70\" />
					</td>
				</tr>
				
				<tr><td>&nbsp;</td></tr>
			 </table>";
			
			 $html .= "<table style=\"border-collapse:collapse;font-family: Century Gothic; font-size:13px; color:#000;\" width=\"100%\"  border=\"\" cellspacing=\"0\" cellpadding=\"0\" >
			 <thead>
				  <tr><td ><b>CV. ANUGERAH ABADI</b></td></tr>
				  <tr><td >&nbsp; </td></tr>
			 </table>";
			 
			 $html .= "<table style=\"border-collapse:collapse;font-family: Arial,Century Gothic; font-size:13px; color:#000;\" width=\"100%\"  border=\"\" cellspacing=\"0\" cellpadding=\"0\" >
			 <thead>
				  <tr>
					<td width=\"50%\">Surakarta, ".$this->m_fungsi->tanggal_format_indonesia($data->tgl_penawaran) ."</td>
					<td width=\"50%\"></td>
				  </tr>
				  <tr><td >&nbsp; </td><td></td></tr>

				  <tr><td >Kepada :</td> <td></td></tr>
				  <tr><td >&nbsp; </td> <td></td></tr>
				  <tr><td >".$data->kpd."</td> <td></td></tr>
				  <tr><td >".$data->alamat."</td> <td></td></tr>

				  <tr><td >&nbsp; </td><td></td></tr>

				  <tr><td >Hal : ".$data->hal."</td> <td></td></tr>
				  
				  
				  <tr><td >&nbsp; </td><td></td></tr>
				  <tr><td >Dengan Hormat,</td> <td></td></tr>
				  <tr><td >&nbsp; </td><td></td></tr>
				  <tr><td >Berikut kami berikan penawaran harga botol yang diminta :</td> <td></td></tr>
				  <tr><td >&nbsp; </td><td></td></tr>
			 </table>";
			
			$html .= '<table width="100%" border="1" cellspacing="1" cellpadding="3" style="border-collapse:collapse;font-size:13px;font-family: Arial,Century Gothic;">
                        <tr style="background-color: #f8bf00">
							<th align="center">NO</th>
							<th align="center">Nama barang</th>
							<th align="center">Spesifikasi</th>
                            <th align="center">HARGA SATUAN</th>
                            <th align="center">MoQ</th>
                            <th align="center">Note</th>
						</tr>';
						
			$no              = 1;
			$jum_all    = 0;			
			foreach ($query_detail->result() as $r) 
			{
				$html .= '<tr>
						<td align="center">' . $no . '</td>
						<td align="">' . $r->nm_barang . '</td>
						<td align="">' . $r->spek . '</td>
						<td align="center">Rp ' . number_format($r->hrg_sat, 0, ",", ".") . '</td>
						<td align="center">' . number_format($r->moq, 0, ",", ".") . '</td>
						<td align="">' . $r->note . '</td>
					</tr>';

				$jum_all += $r->jum;
				$no++;
			}

			// $total_nominal = $jum_all;
				
			// if($data->pajak=='PPN')
			// {
			// 	$ppn_total    = ROUND($total_nominal *0.11);
			// 	$pph_total    = 0;
			// }else if($data->pajak=='PPN_PPH')
			// {
			// 	$ppn_total   = ROUND($total_nominal *0.11);
			// 	$pph_total   = ROUND($total_nominal *0.02);
			// }else{
			// 	$ppn_total   = 0;
			// 	$pph_total   = 0;
			// }
			
			// $total_all     = $total_nominal - $data->diskon + $ppn_total - $pph_total;

			// $html .='<tr style="">
			// 			<td align="left" style="border:none" colspan="3"><b>&nbsp;</b></td>

			// 			<td align="right" colspan="2" ><b>Sub Total</b></td>
			// 			<td align="right" ><b>' . number_format($nominal_all, 0, ",", ".") . '</b></td>						
			// 		</tr>
			// 		<tr style="">
			// 			<td align="left" style="border:none" colspan="3"><b>Catatan Tambahan :</b></td>
				
			// 			<td align="right" colspan="2"><b>Diskon</b></td>
			// 			<td align="right" ><b>' . number_format($data->diskon, 0, ",", ".") . '</b></td>						
			// 		</tr>
			// 		<tr style="">
			// 			<td align="left" rowspan="2" style="border:none" colspan="3"><b>'.$data->cttn.'</b></td>		
			// 			<td align="right" colspan="2"><b>PPN</b></td>
			// 			<td align="right" ><b>' . number_format($ppn_total, 0, ",", ".") . '</b></td>						
			// 		</tr>
			// 		<tr style="">
			// 			<td align="right" colspan="2"><b>PPH</b></td>
			// 			<td align="right" ><b>' . number_format($pph_total, 0, ",", ".") . '</b></td>						
			// 		</tr>
			// 		<tr style="">
			// 			<td align="left" style="border:none" colspan="3"><b>&nbsp;</b></td>
			// 			<td align="right" colspan="2"><b>Total</b></td>
			// 			<td align="right" ><b>' . number_format($total_all, 0, ",", ".") . '</b></td>						
			// 		</tr>

					
			// 		<tr style="border:none"><td align="right" colspan="6">&nbsp;</td></tr>
			// 		<tr style="border:none"><td align="right" colspan="6">&nbsp;</td></tr>
			// 		';
			$html .= '
					<tr style="border:none"><td align="right" colspan="6">&nbsp;</td></tr>
			</table>';

			$kett = str_replace("\r\n","<br>",$data->ket);

			$html .= '<table width="100%" border="0" cellspacing="0" style="font-size:13px;font-family: Arial;">
			<tr> <td align="left">Keterangan :</td> </tr>
			<tr> 
				<td align="left">
				'.$kett.'
				</td> 
			</tr>
           
            </table><br>';

			$html .='<table width="100%" border="0" cellspacing="1" cellpadding="3" style="border-collapse:collapse;font-size:13px;font-family: ;">

			<tr style="border:none"><td >Demikian penawaran harga dari kami,kabar selanjutnya dari bapak/ibu kami tunggu
Terimakasih.</td></tr>
			<tr style="border:none"><td >&nbsp;</td></tr>
			</table>';
			
			
			$html .= '<table width="100%" border="0" cellspacing="0" style="font-size:13px;font-family: Arial;">
			<tr>
                <td width="5%" align="left">&nbsp;</td>
                <td width="20%" align="center">Hormat Kami</td>
                <td width="75%" >&nbsp;</td>
            </tr>
			<tr>
                <td colspan="3">&nbsp;</td>
            </tr>
			<tr>
                <td colspan="1">&nbsp;</td>
                <td align="center"><img src="' . base_url() . 'assets/gambar/STAMPEL.png"  width="80" height="70" /></td>
                <td colspan="3">&nbsp;</td>
            </tr>
			<tr>
                <td colspan="3">&nbsp;</td>
            </tr> 
			<tr>
                <td align="left">&nbsp;</td>
                <td align="center" style="border-top: 1px solid black;">T. Agung R</td>
                <td align="left">&nbsp;</td>
            </tr>
           
            </table><br>';

			
		} else {
			$html .= '<h1> Data Kosong </h1>';
		}

		// echo $html;
		// $this->m_fungsi->_mpdf($html);
		// $this->m_fungsi->template_kop('PENAWARAN HARGA',$no_penawaran,$html,'P','1');
		// $this->m_fungsi->mPDFP($html);

		$judul          = 'PENAWARAN HARGA '.$this->m_fungsi->tanggal_format_indonesia($data->tgl_penawaran);
		$position       = 'P';
		$cekpdf         = 1;

		switch ($cekpdf) {
			case 0;
				echo ("<title>$judul</title>");
				echo ($html);
				break;

			case 1;
				$this->m_fungsi->_mpdf_hari($position, 'A4', $judul, $html, 'PENAWARAN HARGA.pdf', 10, 10, 5, 10);
			


				break;
			case 2;
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd-ms-excel");
				header("Content-Disposition: attachment; filename= $judul.xls");
				$this->load->view('app/master_cetak', $data);
				break;
		}
	}


}
