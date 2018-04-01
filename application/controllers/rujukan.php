<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rujukan extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		//$this->load->library('session');
		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}
		
		$this->load->helper('my');
		$this->load->helper('date');
	}
	
	function index(){
		$data = $this->input->post();
		if($data){
			$param = array(
				'rujukan' => strtoupper($this->input->post('rujukan')),
				'alamat' => ($this->input->post('alamat')),
				'telp' => strtoupper($this->input->post('telp')),
			);
			//var_dump($data);
			
			if($this->input->post('id')){
				$this->db->where('id', $this->input->post('id'));
				$this->db->update('tbl_rujukan', $param);
				//echo $this->db->last_query();
			}else{
				$this->db->insert('tbl_rujukan', $param);
				//echo $this->db->last_query();
			}
		}
		
		$this->db->order_by("id", "asc");
		$result = $this->db->get("tbl_rujukan");
		$this->load->view('AdminLTE/rujukan', array('result' => $result->result()));
	}
}