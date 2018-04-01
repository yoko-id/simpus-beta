<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();	
		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}
		
		$this->load->helper('my');
	}

	function index(){
		require_once(APPPATH.'controllers/api.php');
		$aObj = new Api;
		
		$data = $this->input->get();		
		$month = date("m");
		//echo $month;
		
		$stat = array(
			"labels" => $aObj->statlabels($month),
			"data" => $aObj->statdata($month),
			"statDesa" => json_decode($aObj->statDesaJson($month),true),
			"statPlot" => $aObj->statPlot()
		);
		
		$data['title'] = 'Dashboard';
		$data['stat'] = $stat;
		
		$curdate = date("Y-m-d");
		//$result2 = $this->db->query("SELECT a.*, b.* FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index WHERE DATE(a.date_kunjungan) = '{$curdate}' AND b.antrian=0 ORDER BY a.id desc");
		$result2 = $this->db->query("SELECT * FROM tbl_pasien WHERE DATE(tgl_register) = '".$curdate."' ORDER BY id DESC");
		
		$data['visits'] = $result2->result();
		
		$this->load->view('AdminLTE/dashboard_2', $data);
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url(''));
	}
}