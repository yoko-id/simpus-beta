<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}
		
		$this->load->helper('my');
	}

	function index(){		
		$this->db->select("tbl_user.*, tbl_pegawai.nama", "tbl_pegawai.id=tbl_user.petugas");
		$this->db->from("tbl_user");
		$this->db->join("tbl_pegawai", "tbl_pegawai.id=tbl_user.petugas", "left");
		//$this->db->order_by("id", "desc");
		$result = $this->db->get();
		//echo $this->db->last_query();
		$this->load->view('AdminLTE/user', array("result" => $result->result()));
	}

	function edit($id){		
		$data = $this->input->post();
		if($data){
			$newdata = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'petugas' => $this->input->post('petugas'),
				'level' => $this->input->post('level'),
			);
			
			$this->db->where("id", $this->input->post('id'));
			$this->db->update('tbl_user', $newdata);
			
			$this->session->set_flashdata('response',"Data Inserted Successfully");
			redirect('user');
		}
		
		$this->db->where("id", $id);
		$result = $this->db->get('tbl_user');
		
		$pegawai = $this->db->get("tbl_pegawai");
		
		$this->load->view('AdminLTE/user_edit', array(
			"result" => $result->result(),
			"pegawai" => $pegawai->result()
		));
	}

	function add_petugas(){		
		$data = $this->input->post();
		if($data){			
			$data = array(
				'nip_petugas' => $this->input->post('nip_petugas'),
				'nama_petugas' => $this->input->post('nama_petugas'),
				'alamat_petugas' => $this->input->post('alamat_petugas'),
				'telp' => $this->input->post('telp'),
				'jabatan' => $this->input->post('jabatan'),
				'unit' => $this->input->post('unit')
			);
			
			/* Since PHP 5.5 mysql_real_escape_string has been deprecated and as of PHP7 it has been removed. */
			/*$columns = implode("`, `", array_keys($data));
			$escaped_values = array_values($this->db->escape_str($data));
			$values  = implode("', '", $escaped_values);
			
			$sql_query = "INSERT INTO tbl_petugas (`".$columns."`) VALUES ('".$values."')";*/
			
			$sql_query = $this->db->insert('tbl_petugas', $data);
			if (!$sql_query){
				$error = $this->db->error();
				$this->session->set_flashdata('response',$error);
			}
			
			$lastid = $this->db->insert_id();
			$newdata = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'level' => $this->input->post('unit'),
				'petugas' => $lastid,
			);
				
			$sql_query = $this->db->insert('tbl_user', $newdata);
			if (!$sql_query){
				$error = $this->db->error();
				$this->session->set_flashdata('response',$error);
			}
			
			//return false;
			$this->session->set_flashdata('response',"Data Inserted Successfully");
			redirect('user/addpetugas');
		}
		
		$this->load->view('AdminLTE/add_petugas');
	}
	
	function delete($id){
		if($id){
			$this->db->delete("tbl_petugas", array('id' => $id));
		}
		//redirect('user/');
	}
	
	function add_pegawai(){
		$data = $this->input->post();
		if($data){
			
			$fileName = '';
			if(isset($_FILES)){
				$config['overwrite'] 			= true;
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|jpeg|png';
				$config['max_size']             = 2048;
				//$config['max_width']            = 1024;
				//$config['max_height']           = 768;
				//$config['max_size']      =   "5000"; 
				//$config['max_width']     =   "1907"; 
				//$config['max_height']    =   "1280";
				
				$this->load->library('upload');
				$this->upload->initialize($config);
					
				$fileName		= str_replace(" ", "_", $_FILES['fileToUpload']['name']);
				$inputFileName 	= $config['upload_path'] . $fileName;
				//var_dump ($fileName);
				
				if(!file_exists($inputFileName)){
					if (!$this->upload->do_upload('fileToUpload')){  // cek apakah ada file yg diupload
						$status = array('status' => false, 'msg' => $this->upload->display_errors());
					}else{
						$file = $this->upload->data();
						// pura-puranya disini ada sebuah proses mengenai file yg d upload.
						$status = array('status' => true, 'msg' => 'Tugas berhasil di upload', 'detail' => $file);
					}
					//echo json_encode($status);
				}
			}
			
			$newdata = array(
				'nip' => strtoupper($this->input->post('nip')),
				'nama' => strtoupper($this->input->post('nama')),
				'jabatan' => strtoupper($this->input->post('jabatan')),
				'pangkat' => ucwords($this->input->post('pangkat')),
				'pendidikan' => $this->input->post('pendidikan'),
				'phone' => $this->input->post('phone'),
				'photo' => $fileName
			);
			
			if($this->input->post('update')){
				$this->db->where('nip', $this->input->post('nip'));
				$this->db->update('tbl_pegawai', $newdata);
				$this->session->set_flashdata('response',"Data Update Successfully");
				//redirect('user/addpegawai');
			}else{
				$this->db->insert('tbl_pegawai', $newdata);			
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				//redirect('user/addpegawai');
			}
			//echo $this->db->last_query();
		}
		
		//var_dump ($id);		
		$id 		= '';
		$profile 	= '';
		
		$id 		= $this->uri->segment(3);
		if($id){
			$this->db->where("id", $id);
			$this->db->limit(1);
			$profile = $this->db->get('tbl_pegawai')->result();
		}		
		
		$this->db->order_by("id", "asc");
		$result = $this->db->get('tbl_pegawai');
		
		$this->load->view('AdminLTE/add_pegawai', array("profile" => $profile, "result" => $result->result()));
	}
	
	function update_pegawai(){
		$id = $this->uri->segment(3);		
		$this->db->where("id", $id);
		$this->db->limit(1);
		$profile = $this->db->get('tbl_pegawai');
		
		$this->db->order_by("id", "asc");
		$result = $this->db->get('tbl_pegawai');
		
		$this->load->view('AdminLTE/add_pegawai', array(
			"profile" => $profile->result(),
			"result" => $result->result()
		));
	}
}