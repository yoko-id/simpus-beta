<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Excel extends CI_Controller {
    function __construct(){
        parent::__construct();
        //$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		
		$this->load->helper('my');
    }
	
    public function index()
    {
        $inputFileName = './uploads/1484859351LPLPO_format_baru_2016_Persediaan.xls';
        $inputFileName = './uploads/LPLPO_format_baru_2016_(persediaan).csv';
        //$inputFileName = APPPATH."libraries/example.xls";		
		
		$dataexcel = array();
		$row = 1;
		if (($handle = fopen($inputFileName, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1024, ',')) !== FALSE) {
				$num = count($data);
				//echo "<p> $num fields in line $row: <br /></p>\n";
				for ($c=0; $c < $num; $c++) {
					$col = explode(";",$data[$c]);
					$dataexcel[] = array(
						'nama_obat' => $col[1],
						'satuan' => $col[2],
						'stok_awal' => $col[5],
						'stok_tambah' => $col[6],
						'stok_keluar' => $col[8],
						'harga' => $col[10]
					);
				}
				$row++;
			}
			fclose($handle);
		}
		
		if($dataexcel){
			$i=0;
			foreach($dataexcel as $data){				
				if($data['nama_obat'] && $i>10 && $i<=207){
					$param = array(
						'id_kategori' => 6,
						'nama_obat' => trim($data['nama_obat']),
						'satuan' => $data['satuan'],
						'stok' => $data['stok_awal'],
						'harga' => $data['harga'],
					);
					
					$this->db->insert('tbl_obat_copy', $param);
				}
				$i++;
			}
		}
		
		$this->load->view('AdminLTE/excel', array("data" => $dataexcel));
    }
	
	public function upload(){
       
    }
}