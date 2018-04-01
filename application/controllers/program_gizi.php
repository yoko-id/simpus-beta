<?php
//if ($this->uri->segment(2) == 'program_gizi'){
			
			$data 		= $this->input->post();
			$segment 	= $this->uri->segment(3);
			//var_dump ($segment);
			
			if($segment=="input"){
				if($data){
					$param = array(
						'nama_bayi' => $this->input->post('nama_bayi'),
						'nama_orangtua' => $this->input->post('nama_orangtua'),
						'kelamin' => $this->input->post('kelamin'),
						'tgl_lahir' => date("Y-m-d", strtotime($this->input->post('tgl_lahir'))),
						'bb_lahir' => $this->input->post('bb_lahir'),
						'alamat_bayi' => $this->input->post('alamat_bayi'),
						'desa_id' => $this->input->post('desa_id'),
					);
					
					//var_dump ($param);
					if(!$this->cek_balita($param)){
						$this->db->insert('tbl_gizi', $param);
						//echo $this->db->last_query();
					}else{
						$this->session->set_flashdata('response',"Data Bayi/Balita Duplikasi!");
					}
				}
				
				$desa_id 	= $this->input->get('desa');
				$pasien_id 	= $this->input->get('desa');
				$data = array(
					'all_balita' => $this->all_balita($desa_id),
					'list_desa' => $this->list_desa(),
				);
				
				$this->load->view('AdminLTE/program_gizi_add', $data);
				
			}elseif($segment=="import"){
				ini_set('memory_limit', '-1');
					
				$arr_data 	= array();
				$msg		= '';
				
				//var_dump ( $_GET['desa'] );
				if($_FILES){
					//var_dump ($_FILES);
					$config['upload_path'] = "./uploads/";
					$config['allowed_types'] = "doc|docx|pdf|xls|xlsx";
					$config['max_size'] = "10000"; //2048;
					$config['overwrite'] = false;
					
					$this->load->library('upload');
					$this->upload->initialize($config);
					
					$fileName = str_replace(" ", "_", $_FILES['fileToUpload']['name']);					
					$inputFileName = $config['upload_path'] . $fileName;
					//print_r ($inputFileName);
					
					if (!$this->upload->do_upload('fileToUpload')){
						$msg = array('status' => false, 'msg' => $this->upload->display_errors());
					}else{
						$file = $this->upload->data();
						$msg = array('status' => true, 'msg' => 'Tugas berhasil di upload', 'detail' => $file);
						
						try {
							$inputFileType = IOFactory::identify($inputFileName);
							$objReader = IOFactory::createReader($inputFileType);
							$objPHPExcel = $objReader->load($inputFileName);
						} catch(Exception $e) {
							die('Error loading file :' . $e->getMessage());
						}
						
						$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
						$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
						for($i=7;$i<=$arrayCount;$i++){
							if($allDataInSheet[$i]['B']) $arr_data[] = $allDataInSheet[$i];
						}
						
						$arr_data = json_encode($arr_data);
						
						$arr_bayi = json_decode($arr_data, true);
						foreach($arr_bayi as $k => $v){
							$databayi = array(
								"nama_bayi" => $v['B'],
								"nama_orangtua" => $v['C'],
								"kelamin" => $v['D'],
								"tgl_lahir" => $this->konvertTgl($v['E']),
								"bb_lahir" => $v['H'],
								"alamat_bayi" => $v['G'],
								"desa_id" => (int)$_GET['desa'],
							);
							
							if(!$this->cek_balita($databayi)){
								$this->db->insert('tbl_gizi', $databayi);
								//echo $this->db->last_query();
							}
						}
					}
					
					//var_dump($status);
				}
				
				$this->load->view('AdminLTE/program_gizi_import', array("msg" => $msg, "result" => $arr_data));
			}else{
			
				$data = array('list_desa' => $this->list_desa());				
				$this->load->view('AdminLTE/program_gizi', $data);
			}
		//}