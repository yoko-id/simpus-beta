<?php
$data = $this->input->post();			
			if($data){			
				$newdata = array(
					'no_index' => $this->input->post('no_index'),
					'keluhan' => $this->input->post('keluhan'),
					'terapi' => $this->input->post('terapi'),
					'kunjungan' => $this->input->post('kunjungan'),
					'tgl_register' => date("Y-m-d H:i:s"),
				);
				
				$sql_query = $this->db->insert('tbl_rekamedis', $newdata);
				
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				redirect('poli/poli_kia_kb');
			}
			
			$result = $this->db->query('SELECT a.*, b.* FROM tbl_rekamedis a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index ORDER BY a.id DESC');
			$this->load->view('AdminLTE/poli_umum', array("result" => $result->result()));