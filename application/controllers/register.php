<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){		
		//var_dump ($this->uri->segment(2));
		$this->load->view('AdminLTE/register');
	}
}