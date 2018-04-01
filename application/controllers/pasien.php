<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasien extends CI_Controller{
	
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
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('uname', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Password', 'required');
		$this->form_validation->set_rules('feedback', 'Feedback', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			// Here is where you do stuff when the submitted form is invalid.
			//$this->load->view('myform');
			//$this->session->set_flashdata('response',"Data Invalid!!!!");
		}*/
		
		$data = $this->input->post();
		//var_dump ($data);
		
		$tgl_lahir = date("Y-m-d", strtotime($this->input->post('tgl_lahir')));
		if($this->input->post('umur')){
			//$tgl_lahir = date("Y-m-d", strtotime($this->input->post('umur') . ' years ago'));
			if($this->input->post('mode_lahir')=='TH'){
				$tgl_lahir = date("Y-m-d", strtotime('-' . $this->input->post('umur') . ' years'));
			}else{
				$tgl_lahir = date("Y-m-d", strtotime('-' . $this->input->post('umur') . ' months'));
			}
		}
		
		if($data){			
			//$tgl_register = gmdate("Y-m-d H:i:s", time()+60*60*8);
			$tgl_register = date("Y-m-d H:i:s");
			if($this->input->post('tgl_register')){
				//$tgl_register = str_replace('/', '-', $this->input->post('tgl_register'));
				$tgl_register = date("Y-m-d H:i:s", strtotime($this->input->post('tgl_register') . date("H:i:s")));
			}
			
			$newdata = array(
				'no_index' => $this->input->post('noindex'),
				'nama_pasien' => strtoupper($this->input->post('nama_pasien')),
				'no_bpjs' => $this->input->post('nobpjs'),
				'status_bpjs' => $this->input->post('status_bpjs'),
				'no_nik' => $this->input->post('nonik'),
				'status_peserta' => $this->input->post('status_peserta'),
				'jenis_peserta' => $this->input->post('jenis_peserta'),
				'tgl_lahir' => $tgl_lahir,
				'gender' => $this->input->post('gender'),
				'alamat' => $this->input->post('alamat'),
				'desa' => $this->input->post('desa'),
				'rujukan' => $this->input->post('dari_rujukan'),
				'poli_tujuan' => $this->input->post('tujuan_poli'),
				'keperluan' => $this->input->post('kperluan'),
				'kunjungan' => $this->input->post('kasus'),
				'no_ppk' => $this->input->post('ppk'),
				'tgl_register' => $tgl_register
			);
			//var_dump ($newdata);
			
			if(!$this->pasienExist($this->input->post('noindex'))){
				//array_merge($newdata, array('tgl_register' => $tgl_register));
				$sql_query = $this->db->insert('tbl_pasien', $newdata);
				$this->session->set_flashdata('response',"Data Tersimpan");
				//echo $this->db->last_query();				
			}else{
				//unset();
				$this->db->where('no_index', $this->input->post('noindex'));
				$this->db->update('tbl_pasien', $newdata);
				$this->session->set_flashdata('response',"Data Terupdate");
				//echo $this->db->last_query();
			}
			
			$no_antrian	= $this->getNoAntrian()+1;
			if($this->input->post('date_kunjungan')){
				$tgl_register = date("Y-m-d H:i:s", strtotime($this->input->post('date_kunjungan') . date("H:i:s")));
			}
			$newkunjungan = array(
				'no_index' => $this->input->post('noindex'),
				'keperluan' => $this->input->post('kperluan'),
				'jenis_poli' => $this->input->post('tujuan_poli'),
				'kasus' => $this->input->post('kasus'),
				'no_antrian' => mynumber_pad($no_antrian,3),
				'date_kunjungan' => $tgl_register,
			);
			
			// Kunjungan
			if(!$this->kunjunganExist($this->input->post('noindex'), $tgl_register)){
				$this->db->insert('tbl_kunjungan', $newkunjungan);
				//echo $this->db->last_query();
			}
			
			// Reset Antrian
			$this->db->where('no_index', $this->input->post('noindex'));
			$this->db->update('tbl_pasien', array('antrian' => 0));
			redirect('pasien/add');
		}
		
		//$this->load->view('add_pasien');
		$query = $this->db->query("SELECT no_index FROM tbl_pasien ORDER BY id DESC LIMIT 1");
		$row = $query->last_row('array');
		
		$curdate = date("Y-m-d");
		$result2 = $this->db->query("SELECT a.*, b.* FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index WHERE DATE(a.date_kunjungan) = '{$curdate}' AND b.antrian=0 ORDER BY a.id desc");
		
		//$this->load->view('add_pasien');
		
		$data['title'] = 'Register Pasien';
		$data['no_index'] = $row['no_index']+1;
		$data['visits'] = $result2->result();
		
		$this->load->view('AdminLTE/add_pasien', $data);
	}
	
	function view_pasien(){
		$stat = $this->stat_pasien();		
		
		$this->db->order_by("id", "asc");
		//$this->db->where("date(tgl_register)", "CURDATE()");
		$result = $this->db->get('tbl_pasien');
		
		$data['title'] = 'Register Pasien';
		$data['result'] = $result->result();
		$data['stat'] = $stat;
		
		$this->load->view('AdminLTE/view_pasien', $data);
	}
	
	function printkartu(){
		$data = $this->input->post();
		if($data){
			//var_dump ($data);
			//http://localhost:8080/simpus/v8/api/kartu/cetak?nokartu=000082
			redirect('api/kartu/cetak?nokartu='.implode(',', $this->input->post('nokartu')));
		}
		
		$stat = $this->stat_pasien();		
		
		$this->db->order_by("id", "asc");
		//$this->db->where("date(tgl_register)", "CURDATE()");
		$result = $this->db->get('tbl_pasien');
		
		$data['title'] = 'Register Pasien';
		$data['result'] = $result->result();
		$data['stat'] = $stat;
		
		$this->load->view('AdminLTE/print_kartu', $data);
	}
	
	function loket(){		
		$result = $this->db->query('SELECT * FROM tbl_loket');
		$this->load->view('AdminLTE/loket', array("result" => $result->result()));
	}
	
	function add_visit(){		
		$result = $this->db->query('SELECT a.*, b.* FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index ORDER BY a.id DESC');
		$this->load->view('AdminLTE/add_visit', array("result" => $result->result()));
	}
	
	function view_visit(){
		$result = $this->db->query('SELECT a.*, b.nama_pasien FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index ORDER BY a.id DESC');
		$this->load->view('AdminLTE/view_visit', array("result" => $result->result()));
	}
	
	function antrian(){
		$curdate = date("Y-m-d", strtotime("-1 day"));
		$result = $this->db->query('SELECT a.*, b.* FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index WHERE DATE(a.date_kunjungan) = CURDATE() AND b.antrian=0 ORDER BY a.id ASC');
		//echo $this->db->last_query();
		
		$loket = $this->db->query('SELECT * FROM tbl_loket');
		
		$this->load->view('AdminLTE/antrian', array(
			"result" => $result->result(),
			"loket" => $loket->result()
		));
	}
	
	function stat_pasien(){
		/*
		 * - Pasien Hari ini
		 * - Total Pasien
		 * - Naik/Turun Pasien
		 * - Jumlah Pasien Berdasarkan Pria/Wanita
		 */
		 
		 $data = array(
			'stat_pasienToday' => $this->stat_pasienToday(),
			'stat_pasienTotal' => $this->stat_pasienTotal(),
			'stat_pasienMale' => $this->stat_pasienGender('L'),
			'stat_pasienFemale' => $this->stat_pasienGender('p')
		 );
		 
		 return $data;
	}
	
	function stat_pasienToday(){
		$query = $this->db->query("SELECT * FROM tbl_kunjungan WHERE DATE(date_kunjungan) = CURDATE()");
		return $query->num_rows();
	}
	
	function stat_pasienTotal(){
		$query = $this->db->count_all("tbl_pasien");
		return $query;
	}
	
	function stat_pasienGender($gender){
		$query = $this->db->query("SELECT * FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON b.no_index=a.no_index  WHERE DATE(date_kunjungan) = CURDATE() AND gender='".$gender."'");
		return $query->num_rows();
	}
	
	function pasienExist($index){
		$this->db->select('nama_pasien');
		$this->db->where('no_index', $index);
		//$this->db->where('DATE(tgl_register)', date("Y-m-d"));
		$result = $this->db->get('tbl_pasien');
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	
	function kunjunganExist($index, $tgl_register=""){
		//$this->db->select('no_index');
		if(empty($tgl_register)) $tgl_register = date("Y-m-d");
		
		$this->db->where('no_index', $index);
		$this->db->where('DATE(date_kunjungan)', date("Y-m-d", strtotime($tgl_register)));
		$result = $this->db->get('tbl_kunjungan');
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	
	function getNoAntrian(){
		$this->db->select('no_antrian');
		$this->db->where("DATE(date_kunjungan)", date("Y-m-d"));
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$result = $this->db->get('tbl_kunjungan');
		return (int)$result->row('no_antrian');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url(''));
	}
}