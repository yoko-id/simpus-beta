<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends CI_Controller{

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}
		
		$this->load->helper('my');
	}

	function index(){		
		//$result = $this->db->query('SELECT * FROM inbox ORDER BY ID DESC');
		//$this->load->view('AdminLTE/inbox', array("result" => $result->result()));
	}

	function outbox(){		
		//$result = $this->db->query('SELECT * FROM sentitems ORDER BY SendingDateTime DESC, ID DESC');
		//$this->load->view('AdminLTE/outbox', array("result" => $result->result()));
	}

	function phonebok(){		
		//$result = $this->db->query("SELECT * FROM pbk WHERE Number!='' ORDER BY Name ASC");
		//$groups = $this->db->query("SELECT * FROM pbk_groups");
		//$this->load->view('AdminLTE/phone_book', array("result" => $result->result(), "groups" => $groups->result()));
	}
}