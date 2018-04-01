<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diagnosa extends CI_Controller{

	function __construct(){
		parent::__construct();	
		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}
		
		$this->load->helper('my');
	}

	function index(){
		
		$data = $this->input->post();
		if($data){
			$newdata = array(
				'kode' => $this->input->post('kode_diagosa'),
				'keterangan' => $this->input->post('nama_diagosa')
			);
			
			$sql_query = $this->db->insert('tbl_diagnosa', $newdata);
		}
		
		$this->db->order_by("id", "asc");
		$result = $this->db->get('tbl_diagnosa');		
		$this->load->view('AdminLTE/diagnosa', array("result" => $result->result()));
	}
	
	function histori(){
		$result = $this->db->query('SELECT a.*, b.* FROM tbl_rekamedis a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index ORDER BY a.id DESC');
		
		/*$this->db->order_by("id", "desc");
		$this->db->where("date(tgl_register)", "CURDATE()");
		$result = $this->db->get('tbl_rekamedis');*/
		
		$this->load->view('AdminLTE/diagnosa_history', array("result" => $result->result()));
	}
	
	function import_diagnosa(){
		$diagnosa = list_diagnosa();
		$diagnosa = json_decode($diagnosa, true);
		$diagnosa = array_unique($diagnosa);
		
		foreach($diagnosa as $diag){
			//$this->db->query("INSERT INTO tbl_diagnosa (`kode`,`keterangan`) VALUES (null, '".htmlspecialchars($diag)."')");
		}
	}
	
	function import_desa(){
		$diagnosa = desa_andoolo();
		$diagnosa = json_decode($diagnosa, true);
		$diagnosa = array_unique($diagnosa);
		
		foreach($diagnosa as $desa){
			//if($desa) $this->db->query("INSERT INTO tbl_desa (`nama_desa`) VALUES ('".htmlspecialchars($desa)."')");
		}
	}
	
	function update_diagnosa(){
		$this->db->order_by("id", "asc");
		$result = $this->db->get('tbl_diagnosa');
		foreach($result->result() as $row){
			if($row->kode){
				echo $row->kode.' = '.$row->keterangan.'<br>';
				
				$newkode = str_replace(" ","",ltrim($row->kode));
				$data = array (
					'kode' => trim($newkode)
				);
				$this->db->where('id', $row->id);
				//$this->db->update('tbl_diagnosa', $data);
			}
		}
	}
	
	function histori_pasien(){
		$no_index = $this->uri->segment(3);
		
		$result = $this->db->query('SELECT a.*, b.* FROM tbl_rekamedis a
			LEFT JOIN tbl_pasien b ON a.no_index=b.no_index
			WHERE a.no_index = '.$no_index.'
		ORDER BY a.id DESC');
		
		$this->db->order_by("id", "desc");
		$this->db->where("no_index", $no_index);
		$pasien = $this->db->get('tbl_pasien');
		
		$this->load->view('AdminLTE/pasien_history', array(
			"result" => $result->result(),
			"pasien" => array_shift( $pasien->result() )
		));
	}
	
	function penyakit_primer(){
		$array = array();
	}
}