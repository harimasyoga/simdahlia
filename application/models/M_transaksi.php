<?php
class M_transaksi extends CI_Model
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		$this->username = $this->session->userdata('username');
		$this->waktu    = date('Y-m-d H:i:s');
		$this->load->model('m_master');
	}

	function get_data_max($table, $kolom)
	{
		$query = "SELECT IFNULL(LPAD(MAX(RIGHT($kolom,4))+1,4,0),'0001')AS nomor FROM $table";
		return $this->db->query($query)->row("nomor");
	}



	function batal($id, $jenis, $field)
	{

		$this->db->set("Status", 'Batal');
		$this->db->set("edit_user", $this->username);
		$this->db->set("edit_time", date('Y-m-d H:i:s'));
		$this->db->where($field, $id);
		$query = $this->db->update($jenis);

		if ($jenis == "trs_so_detail") {
			$data = $this->db->query("SELECT * FROM trs_so_detail WHERE id ='" . $id . "' ")->row();

			$this->db->set("Status", 'Open');
			$this->db->where("no_po", $data->no_po);
			$this->db->where("kode_mc", $data->kode_mc);
			$query = $this->db->update("trs_po_detail");

			$this->db->set("Status", 'Open');
			$this->db->where("no_po", $data->no_po);
			$query = $this->db->update("trs_po");
		} else if ($jenis == "trs_wo") {
			$data = $this->db->query("SELECT * FROM trs_wo WHERE id ='" . $id . "' ")->row();

			$this->db->set("Status", 'Open');
			$this->db->where("id", $data->no_so);
			$query = $this->db->update("trs_so_detail");

			// $this->db->set("Status", 'Batal');
			$this->db->where("no_wo", $data->no_wo);
			$query = $this->db->delete("trs_wo_detail");

			$this->db->where("no_wo", $data->no_wo);
			$query = $this->db->delete("trs_wo");
		} else if ($jenis == "trs_surat_jalan") {
			$data = $this->db->query("SELECT * FROM trs_surat_jalan WHERE id ='" . $id . "' ")->row();

			$this->db->set("Status", 'Open');
			$this->db->where("no_wo", $data->no_wo);
			$query = $this->db->update("trs_wo");

			$this->db->set("Status", 'Open');
			$this->db->where("no_wo", $data->no_wo);
			$query = $this->db->update("trs_wo_detail");
		}

		return $query;
	}

	
	function save_po()
	{
		$status_input = $this->input->post('sts_input');
		if($status_input == 'add')
		{
			$tgl_po   = $this->input->post('tgl_po');
			$tanggal   = explode('-',$tgl_po);
			$tahun     = $tanggal[0];
			$bulan     = $tanggal[1];
			$bulan_rmw = $this->m_master->get_romawi($bulan);

			$c_no_inv    = $this->m_fungsi->urut_transaksi('PO');
			$m_no_inv    = $c_no_inv.'/PBLI'.'/'.$bulan_rmw.'/'.$tahun;

			$data_header = array(
				'no_po'   		=> $m_no_inv,
				'terms'         => $this->input->post('terms'),
				'tgl_po'        => $this->input->post('tgl_po'),
				'fob'           => $this->input->post('fob'),
				'supp'          => $this->input->post('supp'),
				'tgl_minta'     => $this->input->post('tgl_minta'),
				'cttn'          => $this->input->post('cttn'),
				'acc_owner'     => 'N',
				'add_user' 		=> $this->username,
				'add_time' 		=> date("Y:m:d H:i:s"),
			);

			$result_header = $this->db->insert('po_header', $data_header);
	
			// rinci
			$rowloop     = $this->input->post('bucket');
			for($loop = 0; $loop <= $rowloop; $loop++)
			{
				$data_detail = array(				
					'no_po'    => $m_no_inv,
					'nm_barang'      => $this->input->post('nm_barang['.$loop.']'),
					'ket'            => $this->input->post('ket['.$loop.']'),
					'qty'            => str_replace('.','',$this->input->post('qty['.$loop.']')),
					'hrg_sat'        => str_replace('.','',$this->input->post('hrg_sat['.$loop.']')),
					'jum'            => str_replace('.','',$this->input->post('jum['.$loop.']')),
				);

				$result_detail = $this->db->insert('po_detail', $data_detail);
			}		

			return $result_detail;
			
		}else{
			
			$no_inv_beli    = $this->input->post('no_inv_beli');

			$data_header = array(
				'no_po'   		=> $no_inv_beli,
				'terms'         => $this->input->post('terms'),
				'tgl_po'        => $this->input->post('tgl_po'),
				'fob'           => $this->input->post('fob'),
				'supp'          => $this->input->post('supp'),
				'tgl_minta'     => $this->input->post('tgl_minta'),
				'cttn'          => $this->input->post('cttn'),
				'acc_owner'     => 'N',
				'add_user' 		=> $this->username,
				'add_time' 		=> date("Y:m:d H:i:s"),
			);

			$this->db->where('id_header_po', $this->input->post('id_header_po'));
			$result_header = $this->db->update('po_header', $data_header);
	
			// delete rinci
			$del_detail = $this->db->query("DELETE FROM po_detail where no_po='$no_po' ");

			// rinci
			if($del_detail)
			{
				$rowloop     = $this->input->post('bucket');
				for($loop = 0; $loop <= $rowloop; $loop++)
				{
					$data_detail = array(				
						'no_po'    => $m_no_inv,
						'nm_barang'      => $this->input->post('nm_barang['.$loop.']'),
						'ket'            => $this->input->post('ket['.$loop.']'),
						'qty'            => str_replace('.','',$this->input->post('qty['.$loop.']')),
						'hrg_sat'        => str_replace('.','',$this->input->post('hrg_sat['.$loop.']')),
						'jum'            => str_replace('.','',$this->input->post('jum['.$loop.']')),
					);
	
					$result_detail = $this->db->insert('po_detail', $data_detail);
				}		
				return $result_detail;
			}
		}
	}
	
	function save_penawaran()
	{
		$status_input = $this->input->post('sts_input');
		if($status_input == 'add')
		{
			$tgl_tawar   = $this->input->post('tgl_tawar');
			$tanggal     = explode('-',$tgl_tawar);
			$tahun       = $tanggal[0];
			$bulan       = $tanggal[1];
			$bulan_rmw   = $this->m_master->get_romawi($bulan);

			$c_no_inv    = $this->m_fungsi->urut_transaksi('PENAWARAN');
			$m_no_inv    = $c_no_inv.'/PNWR'.'/'.$bulan_rmw.'/'.$tahun;

			$data_header = array(
				'no_penawaran'  => $m_no_inv,
				'hal'         	=> $this->input->post('hal'),
				'tgl_penawaran' => $this->input->post('tgl_tawar'),
				'kpd'         	=> $this->input->post('kpd'),
				'ket'         	=> $this->input->post('ket'),
				'alamat'      	=> $this->input->post('alamat'),
				'acc_owner'   	=> 'N',
				'add_user'    	=> $this->username,
				'add_time'    	=> date("Y:m:d H:i:s"),
			);

			$result_header = $this->db->insert('penawaran_header', $data_header);
	
			// rinci
			$rowloop     = $this->input->post('bucket');
			for($loop = 0; $loop <= $rowloop; $loop++)
			{
				$data_detail = array(	
					'no_penawaran'    => $m_no_inv,
					'nm_barang'      => $this->input->post('nm_barang['.$loop.']'),
					'spek'            => $this->input->post('spek['.$loop.']'),
					'hrg_sat'        => str_replace('.','',$this->input->post('hrg_sat['.$loop.']')),
					'moq'            => str_replace('.','',$this->input->post('moq['.$loop.']')),
					'note'            => $this->input->post('note['.$loop.']'),
				);

				$result_detail = $this->db->insert('penawaran_detail', $data_detail);
			}		

			return $result_detail;
			
		}else{
			
			$no_inv_beli    = $this->input->post('no_inv_beli');

			$data_header = array(
				'no_penawaran'  => $m_no_inv,
				'hal'         	=> $this->input->post('hal'),
				'tgl_penawaran' => $this->input->post('tgl_tawar'),
				'kpd'         	=> $this->input->post('kpd'),
				'ket'         	=> $this->input->post('ket'),
				'alamat'      	=> $this->input->post('alamat'),
				'acc_owner'   	=> 'N',
				'add_user'    	=> $this->username,
				'add_time'    	=> date("Y:m:d H:i:s"),
			);

			$this->db->where('id_header_penawaran', $this->input->post('id_header_penawaran'));
			$result_header = $this->db->update('penawaran_header', $data_header);
	
			// delete rinci
			$del_detail = $this->db->query("DELETE FROM penawaran_detail where no_po='$no_po' ");

			// rinci
			if($del_detail)
			{
				$rowloop     = $this->input->post('bucket');
				for($loop = 0; $loop <= $rowloop; $loop++)
				{
					$data_detail = array(				
						'no_po'    => $m_no_inv,
						'nm_barang'      => $this->input->post('nm_barang['.$loop.']'),
						'spek'            => $this->input->post('spek['.$loop.']'),
						'hrg_sat'        => str_replace('.','',$this->input->post('hrg_sat['.$loop.']')),
						'moq'            => str_replace('.','',$this->input->post('moq['.$loop.']')),
						'note'            => $this->input->post('note['.$loop.']'),
					);
	
					$result_detail = $this->db->insert('penawaran_detail', $data_detail);
				}		
				return $result_detail;
			}
		}
	}

	function batalDataSO()
	{
		$this->db->where('id', $_POST["i"]);
		$result = $this->db->delete('trs_so_detail');
		return array(
			'data' => $result,
			'msg' => 'BERHASIL BATAL DATA SO!'
		);
	}

}
