<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller{

	function __construct(){
		parent::__construct();	
		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}
	}

	function index(){		
		//var_dump ($this->uri->segment(2));
		$this->load->view('AdminLTE/profile');
	}
}