<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Obat extends CI_Controller{

	function __construct(){
		parent::__construct();	
		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}
		
		$this->load->helper('my');
	}

	function index(){		
		//var_dump ($this->uri->segment(2));
		
		$data = $this->input->post();
		if($data){
			$newdata = array(
				'nama_obat' => $this->input->post('nama_obat'),
				'kode_obat' => $this->input->post('kode_obat'),
				'id_kategori' => $this->input->post('kategori'),
				'satuan' => $this->input->post('satuan'),
				'harga_beli' => $this->input->post('hargabeli'),
				'harga' => $this->input->post('hargajual'),
				'stok' => $this->input->post('stok'),
				'tgl_masuk' => date("Y-m-d", strtotime($this->input->post('masuk'))),
				'expired' => date("Y-m-d", strtotime($this->input->post('expired')))
			);
			
			/* Since PHP 5.5 mysql_real_escape_string has been deprecated and as of PHP7 it has been removed. */
			$columns = implode("`, `", array_keys($newdata));
			$escaped_values = array_values($this->db->escape_str($newdata));
			$values  = implode("', '", $escaped_values);
			
			$sql_query = "INSERT INTO tbl_obat (`".$columns."`) VALUES ('".$values."')";
			//var_dump($sql_query);
			$query = $this->db->query($sql_query);
			
		}
		
		$this->db->order_by("id_obat", "desc");
		$result = $this->db->get('tbl_obat');
		
		$kategori = $this->db->get('tbl_obat_kategori');
		$this->load->view('AdminLTE/obat', array(
			"result" => $result->result(),
			"kategori" => $kategori->result()
		));
	}
	
	function resep(){
		$result = $this->db->query('SELECT a.*, b.* FROM tbl_rekamedis a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index LEFT JOIN tbl_kunjungan c ON c.no_index=b.no_index WHERE DATE(c.date_kunjungan)=NOW() ORDER BY b.tgl_register DESC');
		
		$this->load->view('AdminLTE/resep', array("result" => $result->result()));
	}
	
	function input_obat(){
		$data = $this->input->post();
		if($data){
			//var_dump($data);/*array(8) { ["no_index"]=> string(6) "000112" ["nama_pasien"]=> string(8) "TN ARWAN" ["tgl_lahir"]=> string(0) "" ["jenis_peserta"]=> string(0) "" ["status_peserta"]=> string(0) "" ["keluhan"]=> string(0) "" ["diagnosa"]=> string(0) "" ["obat"]=> string(2) "42" }*/
			$obat = implode(",", $this->input->post('obat'));			
			$data = array (
				'obat' => $obat
			);
			//var_dump($data);
			
			$this->db->where('no_index', $this->input->post('no_index'));
			$this->db->update('tbl_rekamedis', $data);
			echo $this->db->last_query();
		}
		
		$no_index = $this->uri->segment(3);
		$this->db->where('no_index', $no_index);
		$datapasien = $this->db->get('tbl_pasien');
		
		$this->db->select("id_obat,nama_obat");
		$obat = $this->db->get('tbl_obat');
		
		$this->load->view('AdminLTE/input_obat', array(
			"data" => $datapasien->result(),
			"obats" => $obat->result()
		));
	}
	
	function obat_keluar($month=""){
		//$this->db->where("obat IS NOT NULL", null, false);
		//$result = $this->db->get('tbl_rekamedis');
		
		if(empty($month)) $month = date("m");
		
		$result = $this->db->query("SELECT a.*, count(b.id_obat) as tot
		FROM tbl_obat a
		LEFT JOIN tbl_obat_keluar b ON b.id_obat=a.id_obat
		WHERE MONTH(b.tgl_register) = '".$month."'
		GROUP BY a.id_obat having tot >=1 ORDER BY tot DESC");

		$this->load->view('AdminLTE/obat_keluar', array("result" => $result->result()));
	}
	
	function obat_expired(){
		$result = $this->db->get('tbl_obat');
		$this->load->view('AdminLTE/obat_expired', array("result" => $result->result()));
	}
	
	// https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/
	function obat_import(){
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'csv';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        /*if (!$this->upload->do_upload('userfile'))
        {
            $data = array('error' => $this->upload->display_errors());
			var_dump ($data);
        } else {
            //$data = array('upload_data' => $this->upload->data());
			
			$data = $this->upload->data();
			//var_dump ($data);
			$cvs = array();
			
			$row = 1;
			if (($handle = fopen($data['full_path'], "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);
					//echo "<p> $num fields in line $row: <br /></p>\n";
					$row++;
					for ($c=12; $c < $num; $c++) {
						$cvs = $data[$c] . "<br />\n";
					}
				}
				fclose($handle);
			}
        }*/
		
		$data['full_path'] = 'D:/AppServ/www/simpus/v8/uploads/LPLPO_format_baru_2016_(persediaan).csv';
		$cvs = array();
		
		$row = 1;
			if (($handle = fopen($data['full_path'], "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {					
					$num = count($data);
					for ($c=0; $c < $num; $c++) {
						$cvs[$row] = $data[$c] . "<br />\n";
					}
					$row++;
				}
				fclose($handle);
			}
			
		$json = json_encode($cvs);
		$cvs = json_decode($json, true);
		
		$this->load->view('AdminLTE/obat_import', array("result" => $cvs));
	}
}