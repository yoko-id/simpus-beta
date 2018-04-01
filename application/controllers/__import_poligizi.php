<?php
ini_set('memory_limit', '-1');
					
					$this->load->library('upload');
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'xls|xlsx|csv|ods|ots|xlsb'; //type yang dapat diakses bisa anda sesuaikan
					//$config['max_size'] = '2048'; //maksimum besar file 2M
					$config['max_size'] = 10000;
					//$config['file_name'] = "file_".time(); //nama yang terupload nantinya	
					
					$this->upload->initialize($config);
						
					//var_dump ($_FILES);
					$ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
					if($ext=="xlsb"){
						$filename = $config['upload_path'] . $_FILES['fileToUpload']['name'];
						if(!file_exists($filename)){
							move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $filename);
						}
						
						// Load the spreadsheet reader library
						$this->load->library('Excel_reader/Excel_reader');
						$this->excel_reader->setOutputEncoding('230787');
						$this->excel_reader->read($filename);
						error_reporting(E_ALL ^ E_NOTICE);
						
						// Get the contents of the first worksheet
						$worksheet = $this->excel_reader->sheets[0];
						$dataexcel = Array();
						for ($i = 7; $i <= 80; $i++) {
							echo $data['cells'][$i][1].' - '.$data['cells'][$i][2].' - '.$data['cells'][$i][3].' - '.$data['cells'][$i][4];
						}
					}else{
						$filename = $config['upload_path'] . $_FILES['fileToUpload']['name'];
						$inputFileName = str_replace(" ", "_", $filename);
						
						/*if (!$this->upload->do_upload('fileToUpload')){
							$data['error'] = $this->upload->display_errors();
							// jika validasi file gagal, kirim parameter error ke index
							$this->session->set_flashdata('msg', $this->upload->display_errors());
						}else{
							//$data = array('upload_data' => $this->upload->data());
							
							$upload_data = $this->upload->data(); //Mengambil detail data yang di upload
							//var_dump ($upload_data);
							$inputFileName = './uploads/'.$upload_data['file_name'];//Nama File							
							$inputFileName = $upload_data['full_path'];//Nama File
						}*/
						
						try {
							$inputFileType = IOFactory::identify($inputFileName);
							$objReader = IOFactory::createReader($inputFileType);
							$objPHPExcel = $objReader->load($inputFileName);
						} catch(Exception $e) {
							die('Error loading file :' . $e->getMessage());
						}

						$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
						foreach ($cell_collection as $cell) {
							$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
							$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
							if($row >=7){
								$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
								$arr_data[$row][$column] = $data_value;
							}
						}
					}