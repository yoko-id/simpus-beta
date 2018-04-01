<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poli extends CI_Controller{

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}
		
		//$this->load->library("PHPExcel");
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->helper('my');
		//$this->load->helper('simplexlsx');
	}

	function index(){
		if ($this->uri->segment(2) == 'poli_gizi'){
			$this->load->view('AdminLTE/poli_gizi', array("result" => ""));
		}
		
		//http://localhost:8080/simpus/v8/poli/poli_umum
		if ($this->uri->segment(2) == 'poli_umum'){
			$data = $this->input->post();
			//var_dump ($data);
			
			$tgl_register = date("Y-m-d H:i:s");
			if($data){
				if($this->input->post('tgl_register')){
					$tgl_register = $this->input->post('tgl_register');
				}
					
				$newdata = array(
					'no_index' => $this->input->post('no_index'),
					'keluhan' => $this->input->post('keluhan'),
					'terapi' => $this->input->post('terapi'),
					'diagnosa' => implode(",", $this->input->post('diagnosa')),
					'obat' => implode(",", $this->input->post('pengobatan')),
					'rujukan' => $this->input->post('rujukan'),
					'kasus' => $this->input->post('kasus'),
					'tb' => $this->input->post('tb'),
					'bb' => $this->input->post('bb'),
					'sistole' => $this->input->post('sistole'),
					'diastole' => $this->input->post('diastole'),
					'respiratory' => $this->input->post('respiratory'),
					'heart' => $this->input->post('heart'),
					'tgl_medis' => $tgl_register,
				);
				//var_dump ($newdata);
				
				if(!$this->medisExist($this->input->post('no_index'))){
					$this->db->insert('tbl_rekamedis', $newdata);
					//echo $this->db->last_query();
					
					//
					$obat_keluar = $this->input->post('pengobatan');
					if(is_array($obat_keluar)){
						foreach($obat_keluar as $obat){
							$arr = array(
								'no_index' => $this->input->post('no_index'),
								'id_obat' => $obat,
								'tgl_register' => $tgl_register,
							);
							$this->db->insert('tbl_obat_keluar', $arr);
							//echo $this->db->last_query();
						}
					}
				}else{
					$this->db->where('no_index', $this->input->post('noindex'));
					$this->db->update('tbl_rekamedis', $newdata);
				}
				
				$this->updatePoli('APOTEK', $this->input->post('no_index'));
				
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				//redirect('poli/poli_umum');
			}
			
			//$curdate = date("Y-m-d", strtotime("-1 day"));
			$curdate = date("Y-m-d");
			$result = $this->db->query("SELECT a.*, b.nama_pasien, b.tgl_lahir, b.gender, c.jenis_poli , c.date_kunjungan FROM tbl_rekamedis a
				LEFT JOIN tbl_pasien b ON a.no_index=b.no_index
				LEFT JOIN tbl_kunjungan c ON c.no_index=a.no_index
				WHERE c.jenis_poli='POLI UMUM'
				GROUP BY b.no_index
			ORDER BY b.tgl_register DESC");
			
			$result = $this->db->query("SELECT a.no_index, a.nama_pasien, a.tgl_lahir, a.gender, a.tgl_register, b.* FROM tbl_pasien a LEFT JOIN tbl_rekamedis b ON b.no_index=a.no_index WHERE b.no_index !='' GROUP BY a.no_index ORDER BY a.tgl_register DESC");

			//echo $this->db->last_query();
			$data['title'] = "Poli Umum";
			$data['result'] = $result->result();
			
			$this->load->view('AdminLTE/poli_umum', $data);
		}
		
		//http://localhost:8080/simpus/v8/poli/poli_akupresure
		if ($this->uri->segment(2) == 'poli_akupresure'){
			$data = $this->input->post();			
			if($data){			
				$newdata = array(
					'terapi' => $this->input->post('terapi'),
				);
				
				//$sql_query = $this->db->insert('tbl_rekamedis', $newdata);
				$this->db->where('no_index', $this->input->post('no_index'));
				$this->db->update('tbl_rekamedis', $newdata);
				
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				redirect('poli/poli_akupresure');
			}
			
			//$result = $this->db->query('SELECT a.*, b.* FROM tbl_rekamedis a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index ORDER BY a.id DESC');
			
			$curdate = date("Y-m-d");
			$result = $this->db->query("SELECT a.*, b.nama_pasien, b.tgl_lahir, b.gender, c.jenis_poli , c.date_kunjungan FROM tbl_rekamedis a
				LEFT JOIN tbl_pasien b ON a.no_index=b.no_index
				LEFT JOIN tbl_kunjungan c ON c.no_index=a.no_index
				WHERE a.rujukan LIKE '%POLI AKUPRESURE%'
				GROUP BY a.no_index
			ORDER BY c.date_kunjungan DESC");
			//echo $this->db->last_query();
			
			$this->load->view('AdminLTE/poli_akupresure', array("result" => $result->result()));
		}
		
		//http://localhost:8080/simpus/v8/poli/poli_gigi
		if ($this->uri->segment(2) == 'poli_gigi'){
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
				redirect('poli/poli_umum_ugd');
			}
			
			$curdate = date("Y-m-d");
			$result = $this->db->query("SELECT a.*, b.*,c.jenis_poli FROM tbl_rekamedis a
				LEFT JOIN tbl_pasien b ON a.no_index=b.no_index
				LEFT JOIN tbl_kunjungan c ON c.no_index=a.no_index
				WHERE date(a.tgl_register) = {$curdate} AND c.jenis_poli='POLI GIGI'
			ORDER BY a.id DESC");
			$this->load->view('AdminLTE/poli_umum', array("result" => $result->result()));
		}
		
		//http://localhost:8080/simpus/v8/poli/poli_kia_kb
		if ($this->uri->segment(2) == 'poli_kia_kb'){
			require_once(APPPATH.'controllers/poli_kia_kb.php');
		}
		
		if ($this->uri->segment(2) == 'program_gizi'){
			require_once(APPPATH.'controllers/program_gizi.php');
		}
	}
	
	function konvertTgl($tgl){
		$curDate = explode("-",str_replace("/","-",$tgl));
		$tgl = $curDate[1];
		$bln = $curDate[0];		
		if(!is_numeric($tgl)){
			$bln = date("m", strtotime($tgl));
			$tgl = $curDate[0];
		}
		$thn = $curDate[2];
		if(strlen($thn)==2) $thn = "20".$thn;
		
		return $thn.'-'.$bln.'-'.$tgl;
	}
	
	function cek_balita($param){
		$this->db->where("nama_bayi", $param['nama_bayi']);
		$this->db->where("nama_orangtua", $param['nama_orangtua']);
		//$this->db->where("nama_orangtua", $param['nama_orangtua']);
		return $this->db->get("tbl_gizi")->num_rows();
	}
	
	function all_balita($id){
		//SELECT * FROM tbl_gizi WHERE tgl_lahir > DATE_SUB(NOW(), INTERVAL 59 MONTH) ORDER BY tgl_lahir DESC
		
		$query = "SELECT a.*,b.* FROM tbl_gizi a LEFT JOIN tbl_gizi_kegiatan b ON b.bayi_id=a.id
		WHERE a.tgl_lahir > DATE_SUB(NOW(), INTERVAL 59 MONTH)";
		if($id) $query .= " AND a.desa_id ='".$id."'";
		$query .= " ORDER BY a.id ASC";
		//echo $query;
		return $result = $this->db->query($query)->result();
	}
	
	function list_desa(){
		$this->db->order_by("id", "ASC");
		return $result = $this->db->get("tbl_desa")->result();
	}
	
	function medisExist($index){
		$this->db->where('no_index', $index);
		$result = $this->db->get('tbl_rekamedis');
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	
	function insert_obat_keluar($obat_keluar){
		$data = $this->input->post();
		$tgl_register = date("Y-m-d H:i:s");
		if($data){
			
		}
	}
	
	function _conf_upload(){
		$config['upload_path'] = "./uploads/";
		$config['allowed_types'] = "doc|docx|pdf|xls|xlsx";
		$config['max_size'] = "10000"; //2048;
		$config['overwrite'] = TRUE;
		$this->load->library('upload');
		$this->upload->initialize($config);
	}
	
	function add_poli($id=""){
		$data = $this->input->post();			
		if($data){
			$newdata = array(
				'nama' => $this->input->post('nama'),
				'kode' => $this->input->post('kode'),
				'status' => $this->input->post('status'),
			);
			
			if($this->input->post('update')){
				$this->db->where('id', $this->input->post('id'));
				$this->db->update('tbl_poli', $newdata);
				$this->session->set_flashdata('response',"Data Update Successfully");
				//redirect('poli/addpoli');
			}else{
				$this->db->insert('tbl_poli', $newdata);
				$this->session->set_flashdata('response',"Data Inserted Successfully");
				//redirect('poli/addpoli');
			}
			//echo $this->db->last_query();
		}
		
		if($id) $this->db->where("id", $id);
		$this->db->order_by("id", "asc");
		$result = $this->db->get('tbl_poli');
		
		$poli = '';
		if($id){
			$poli = $result->result();
		}
		
		$this->load->view('AdminLTE/add_poli', array(
			"poli" => $poli,
			"result" => $result->result()
		));
	}
	
	function getKodePenyakit($string){
		$this->db->select('code');
		$this->db->where('penyakit', $string);
		$result = $this->db->get('tbl_penyakit_copy');
		//echo $this->db->last_query();
		$ret = $result->row();
		//return (int)$ret->code;
	}
	
	function updatePoli($poli_tujuan, $no_index){
		/*$data = array (
			'jenis_poli' => $poli_tujuan
		);
		$this->db->where('no_index', $no_index);
		$this->db->update('tbl_kunjungan', $data);*/
		$data = array (
			'poli_tujuan' => $poli_tujuan
		);
		$this->db->where('no_index', $no_index);
		$this->db->update('tbl_pasien', $data);
	}
	
	public function downloadExcel()
        {
            //load librarynya terlebih dahulu
            //jika digunakan terus menerus lebih baik load ini ditaruh di auto load
            $this->load->library("Excel/PHPExcel");
 
            //membuat objek PHPExcel
            $objPHPExcel = new PHPExcel();
 
            //set Sheet yang akan diolah 
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                                        ->setCellValue('A1', 'Hello')
                                        ->setCellValue('B2', 'Ini')
                                        ->setCellValue('C1', 'Excel')
                                        ->setCellValue('D2', 'Pertamaku');
            //set title pada sheet (me rename nama sheet)
            $objPHPExcel->getActiveSheet()->setTitle('Excel Pertama');
 
            //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
            //sesuaikan headernya 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //ubah nama file saat diunduh
            header('Content-Disposition: attachment;filename="hasilExcel.xlsx"');
            //unduh file
            $objWriter->save("php://output");
 
            //Mulai dari create object PHPExcel itu ada dokumentasi lengkapnya di PHPExcel, 
            // Folder Documentation dan Example
            // untuk belajar lebih jauh mengenai PHPExcel silakan buka disitu
 
        }
}