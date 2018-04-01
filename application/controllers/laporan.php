<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller{

	function __construct(){
		parent::__construct();		
		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}
		
		ini_set('memory_limit', "256M");
		// you need to load the url helper to call base_url()
		$this->load->helper("url");
		$this->load->library('m_pdf');
		$this->load->helper('my');
	}

	function index(){
		if ($this->uri->segment(2) == 'gizi'){
			//$this->load->view('AdminLTE/gizi', array("result" => ""));
		}
		
		if ($this->uri->segment(2) == 'gigi'){
			//$this->load->view('AdminLTE/gizi', array("result" => ""));
		}
		
		if ($this->uri->segment(2) == 'diare'){
			//$this->load->view('AdminLTE/gizi', array("result" => ""));
		}
		
		if ($this->uri->segment(2) == 'ispa'){
			//$this->load->view('AdminLTE/gizi', array("result" => ""));
		}
		
		if ($this->uri->segment(2) == 'posbindu'){
			//$this->load->view('AdminLTE/gizi', array("result" => ""));
		}
		
		if ($this->uri->segment(2) == 'lb1'){
			$this->db->order_by("code", "asc");
			$penyakit = $this->db->get('tbl_penyakit_copy');
			
			$pages = GenerateNavArray($penyakit->result());
			$pages = GenerateNavHTML($pages);
			//echo json_encode($pages);
			//$result = $this->db->get('tbl_rekamedis');
			
			$this->load->view('AdminLTE/lb1', array(
				"penyakit" => $pages
			));
		}
		
		if ($this->uri->segment(2) == 'lplpo'){
			$this->db->order_by("nama_obat", "asc");
			$obat = $this->db->get('tbl_obat');
			
			$this->load->view('AdminLTE/lplpo', array("obat" => $obat->result()));
		}
	}
	
	function pasienxls(){
		
		$this->db->order_by("id", "desc");
		//$this->db->where("date(tgl_register)", "CURDATE()");
		$result = $this->db->get('tbl_pasien');
		
		$this->load->view('AdminLTE/pasien_viewxls', array(
			"pdfFilePath" => 'pasienxls.xls',
			"result" => $result->result()
		));
	}
	
	function pasienpdf(){
		$this->db->order_by("id", "desc");
		//$this->db->where("date(tgl_register)", "CURDATE()");
		$result = $this->db->get('tbl_pasien');
		
		$this->load->view('AdminLTE/pasien_viewpdf', array("result" =>$result->result()));
        $html = $this->load->view('AdminLTE/pasien_viewpdf', array("result" =>$result->result()), TRUE);
		
		$pdfFilePath = "pasienpdf.pdf";
		//lokasi file css yang akan di load
        //$stylesheet = file_get_contents(base_url().'assets/bootstrap/css/bootstrap.min.css');
        //$pdf = $this->m_pdf->load();
		
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';		
		$pdf = new mPDF();

        $pdf->AddPage('L');
        //$pdf->WriteHTML($stylesheet, 1);
        $pdf->WriteHTML($html);
        
        $pdf->Output($pdfFilePath, "D");
        exit();
	}
}