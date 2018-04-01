<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->helper('url');
		
		// Default
		//$this->load->view('welcome_message');
		$this->load->view('AdminLTE/login');
	}
	
	public function aksi_login(){
		//$data = $this->input->post();
		//var_dump ($data);		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		
		//$cek = $this->m_login->cek_login("admin",$where)->num_rows();
		$result = $this->db->get_where('tbl_user',$where);
		$data = array_shift($result->result_array());
		
		if($result->num_rows() > 0){
			$data_session = array(
				'nama' => $username,
				'status' => "login",
				'level' => $data['level']
			);

			$this->session->set_userdata($data_session);
			redirect(base_url("admin"));

		}else{
			//echo "Username dan password salah !";
			$this->session->set_flashdata('response',"USERNAME ATAU PASSWORD SALAH!");
			redirect(base_url("/"));
		}
	}
	
	function getlevel(){
		//
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url(''));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */