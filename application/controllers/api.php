<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller{

	function __construct(){
		parent::__construct();	
		/*if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		}*/
		
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$this->load->helper('my');
	}

	function index(){		
		$data = $this->input->get();
		if($data['no_index']){
			$result = $this->db->query("SELECT * FROM tbl_pasien WHERE no_index ='".$data['no_index']."' OR no_bpjs ='".$data['no_index']."' ORDER BY id DESC");
		
			header('Content-Type: application/json');
			header('Access-Control-Allow-Origin: *');
			echo json_encode( $result->result_array() );
		}
	}
	
	function giziActivityExist($bayi_id){
		$this->db->where('bayi_id', $bayi_id);
		$result = $this->db->get('tbl_gizi_kegiatan');
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	
	function giziActivity(){
		$data = $this->input->post();
		//var_dump ($data);
		if($data) {			
			list($id, $field, $desa_id, $bln) = explode("#", $data['id']);
			$act = array(
				'desa_id' => $desa_id,
				'bln' => $bln,
				'bayi_id' => $id,
				$field => $data['value'],
			);
			
			if($field=='bb_lahir'){
				$this->db->where('id', $id);
				$this->db->update('tbl_gizi', array('bb_lahir' => $data['value']));
			}else{
				if(!$this->giziActivityExist($id)){
					$this->db->insert('tbl_gizi_kegiatan', $act);
					//echo $this->db->last_query();
				}else{
					$this->db->where('bayi_id', $id);
					$this->db->update('tbl_gizi_kegiatan', $act);
					//echo $this->db->last_query();
				}
			}
		}
		echo $data['value'];
	}
	
	function delete_pegawai(){
		$data = $this->input->get();
		//var_dump ($data);
		$this->db->where('id', $data['id']);
		$this->db->delete('tbl_pegawai');
	}
	
	function delete_poli(){
		$data = $this->input->get();
		//var_dump ($data);
		$this->db->where('id', $data['id']);
		$this->db->delete('tbl_poli');
	}
	
	function laporanpdf(){
		ini_set('memory_limit', '-1');
		
		$this->load->library('m_pdf');
		//include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		
		$data = $this->input->get();
		//var_dump ($data);
		if($data){			
			$tgl = $data['tgl'];
			$bln = $data['bln'];
			$thn = $data['thn'];			
			$individu = $data['individu'];
			
			if($data['modePilihan']==1){
				$curdate = date("Y-m-d", strtotime($data['tgl']));
				$result2 = $this->db->query("SELECT a.*, b.* FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index WHERE DATE(b.tgl_register) = '".$curdate."' ORDER BY b.id DESC");
			}
			if($data['modePilihan']==2){
				$result2 = $this->db->query("SELECT a.*, b.* FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index WHERE MONTH(b.tgl_register) = '".$bln."' AND YEAR(a.date_kunjungan) = '".$thn."' ORDER BY b.id DESC");
			}
			if($data['modePilihan']==3){
				$result2 = $this->db->query("SELECT a.*, b.* FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index WHERE b.no_bpjs='".trim($individu)."' ORDER BY b.id DESC");
			}
			
			//echo $this->db->last_query();
			$html = '<style>
				#table
				{
					font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
					width:100%;
					border-collapse:collapse;
				}
				#table td, #table th
				{
					font-size:1em;
					border:1px solid #000000;
					padding:3px 7px 2px 7px;
				}
				#table th
				{
					font-size:1.1em;
					text-align:left;
					padding-top:5px;
					padding-bottom:4px;
					background-color:#0080FF;
					color:#ffffff;
					}
				#table tr.alt td 
					{
					color:#000000;
					background-color:#A9E2F3;
					}
			</style>
			<table width="100%"  border="1" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th>NO INDEX</th>
						<th>NAMA PASIEN</th>
						<th>KELAMIN</th>
						<th>UMUR</th>
						<th>ALAMAT</th>
						<th>NO BPJS</th>
						<th>KUNJUNGAN</th>
					</tr>
				</thead>
            <tbody>';
			if($result2->num_rows()){
				$visits = $result2->result();
				foreach($visits as $row){
					if($row->antrian==0) $antrian = $row->jenis_poli; else $antrian = "PULANG";
					$html .= '<tr>
						<td>'.$row->no_index.'</td>
						<td>'.$row->nama_pasien.'</td>
						<td>'.$row->gender.'</td>
						<td>'.get_age($row->tgl_lahir).' Th</td>
						<td>'.$row->desa.'</td>
						<td>'.$row->no_bpjs.'</td>
						<td>'.$row->kunjungan.'</td>
					</tr>';
				}
			}
			$html .= '</table>';
			
			/*$pdf = new mPDF();

			$pdf->AddPage('L');		
			$pdf->WriteHTML($html);
			
			$filename = "pasienpdf.pdf";
			$pdf->Output($filename, "D");
			exit();*/
			
			$pdfFilePath = "./uploads/laporan.pdf";			
			$this->load->library('m_pdf');
			
			$css = './assets/bootstrap/css/bootstrap.min.css';
			$stylesheet = file_get_contents($css);
			
			$pdf = $this->m_pdf->load();
 
			//$pdf->AddPage('L');
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->WriteHTML($html);
        
			$pdf->Output($pdfFilePath, 'F'); // save ke direktori $pdfFilePath
			//exit();
			
			// load download helder
			$this->load->helper('download');
	
			//$this->output->set_header('Content-Disposition: attachment; filename="'.basename($pdfFilePath).'"');
			//$this->output->set_content_type('application/pdf')->set_output($pdf->Output());
			//force_download($filename, $pdf->Output());
			
			header('Content-Disposition: attachment; filename="'.basename($pdfFilePath).'"');
			header("Content-Length: " . filesize($pdfFilePath));
			header("Content-Type: application/octet-stream;");
			readfile($pdfFilePath);
		}
		
		
	}
	
	function cariDataApotek(){
		$data = $this->input->get();
		//var_dump ($data);
		if($data){			
			$tgl = $data['tgl'];
			$bln = $data['bln'];
			$thn = $data['thn'];			
			$individu = $data['individu'];
			
			if($data['modePilihan']==1){
				$curdate = date("Y-m-d", strtotime($data['tgl']));
				//$result2 = $this->db->query("SELECT * FROM tbl_pasien WHERE DATE(tgl_register) = '".$curdate."' ORDER BY id DESC");
				$result2 = $this->db->query("select * from tbl_kunjungan a
left join tbl_rekamedis b ON b.no_index=a.no_index
left join tbl_pasien c ON c.no_index=a.no_index
where DATE(a.date_kunjungan) = '".$curdate."' GROUP BY a.no_index ORDER BY a.date_kunjungan DESC");
			}
			if($data['modePilihan']==2){
				//$result2 = $this->db->query("SELECT * FROM tbl_pasien WHERE MONTH(tgl_register) = '".$bln."' AND YEAR(tgl_register) = '".$thn."' ORDER BY id DESC");
				$result2 = $this->db->query("select * from tbl_kunjungan a
left join tbl_rekamedis b ON b.no_index=a.no_index
left join tbl_pasien c ON c.no_index=a.no_index
where MONTH(a.date_kunjungan) = '".$bln."' AND YEAR(a.date_kunjungan) = '".$thn."' GROUP BY a.no_index ORDER BY a.date_kunjungan DESC");
			}
			if($data['modePilihan']==3){
				if(is_numeric($individu)){
					if(strlen($individu)<6){
						//no_index
					}
					if(strlen($individu)>6){
						//no_bpjs
					}
				}
				
				//$result2 = $this->db->query("SELECT * FROM tbl_pasien WHERE no_bpjs LIKE '%".trim($individu)."' OR nama_pasien LIKE '%".trim($individu)."%' OR no_index LIKE '%".trim($individu)."' ORDER BY id DESC");
				$result2 = $this->db->query("select * from tbl_kunjungan a
left join tbl_rekamedis b ON b.no_index=a.no_index
left join tbl_pasien c ON c.no_index=a.no_index
where c.no_bpjs LIKE '%".trim($individu)."' OR c.nama_pasien LIKE '%".trim($individu)."%' OR c.no_index LIKE '%".trim($individu)."' GROUP BY a.no_index ORDER BY a.tgl_register DESC");
			}
			
			echo $this->db->last_query();
			$html = '';
			if($result2->num_rows()){
				$visits = $result2->result();
				$i=1;
				foreach($visits as $row){
					//if($row->antrian==0) $antrian = $row->jenis_poli; else $antrian = "PULANG";
					$attr = '';
								$btn = 'btn-danger';
								if($row->antrian==1) {
									$attr ='disabled';
									$btn = 'btn-default';
								}
								
					$html .= '<tr>
						<td>'.$i.'.</td>
						<td>'.$row->no_index.'</td>
                                    <td>'.$row->nama_pasien.'</td>
                                    <td>'.get_age($row->tgl_lahir).' Th</td>
                                    <td>'.$row->keluhan.'</td>
                                    <td>'.getObat($row->obat).'</td><td>'.tgl_indo(date("D, d-m-Y", strtotime($row->tgl_register))).'</td>
                                    <td>
									<div class="btn-group" role="group">
											<button class="btn btn-info hide" id="inputObat" data-value="'.$row->no_index.'">INPUT OBAT</button>
											<button class="btn '.$btn.'" id="signApotek" data-value="'.$row->no_index.'" '.$attr.'>RESEP SUDAH DI TEBUS</button>
										</div></td>
					</tr>';
					$i++;
				}
			}else{
				$html .= '<tr>
				<td colspan="10" align="center">
					<p class="lead">Data tidak ditemukan</p>
				</td>
				</tr>';
			}
			echo $html;
		}
	}
	function cariDataPoliUmum(){
		$data = $this->input->get();
		//var_dump ($data);
		if($data){			
			$tgl = $data['tgl'];
			$bln = $data['bln'];
			$thn = $data['thn'];			
			$individu = $data['individu'];
			
			if($data['modePilihan']==1){
				$curdate = date("Y-m-d", strtotime($data['tgl']));
				//$result2 = $this->db->query("SELECT * FROM tbl_pasien WHERE DATE(tgl_register) = '".$curdate."' ORDER BY id DESC");
				$result2 = $this->db->query("select * from tbl_kunjungan a
left join tbl_rekamedis b ON b.no_index=a.no_index
left join tbl_pasien c ON c.no_index=a.no_index
where DATE(a.date_kunjungan) = '".$curdate."' GROUP BY a.no_index ORDER BY a.date_kunjungan DESC");
			}
			if($data['modePilihan']==2){
				//$result2 = $this->db->query("SELECT * FROM tbl_pasien WHERE MONTH(tgl_register) = '".$bln."' AND YEAR(tgl_register) = '".$thn."' ORDER BY id DESC");
				$result2 = $this->db->query("select * from tbl_kunjungan a
left join tbl_rekamedis b ON b.no_index=a.no_index
left join tbl_pasien c ON c.no_index=a.no_index
where MONTH(a.date_kunjungan) = '".$bln."' AND YEAR(a.date_kunjungan) = '".$thn."' GROUP BY a.no_index ORDER BY a.date_kunjungan DESC");
			}
			if($data['modePilihan']==3){
				if(is_numeric($individu)){
					if(strlen($individu)<6){
						//no_index
					}
					if(strlen($individu)>6){
						//no_bpjs
					}
				}
				
				//$result2 = $this->db->query("SELECT * FROM tbl_pasien WHERE no_bpjs LIKE '%".trim($individu)."' OR nama_pasien LIKE '%".trim($individu)."%' OR no_index LIKE '%".trim($individu)."' ORDER BY id DESC");
				$result2 = $this->db->query("select * from tbl_kunjungan a
left join tbl_rekamedis b ON b.no_index=a.no_index
left join tbl_pasien c ON c.no_index=a.no_index
where c.no_bpjs LIKE '%".trim($individu)."' OR c.nama_pasien LIKE '%".trim($individu)."%' OR c.no_index LIKE '%".trim($individu)."' GROUP BY a.no_index ORDER BY a.tgl_register DESC");
			}
			
			echo $this->db->last_query();
			$html = '';
			if($result2->num_rows()){
				$visits = $result2->result();
				$i=1;
				foreach($visits as $row){
					//if($row->antrian==0) $antrian = $row->jenis_poli; else $antrian = "PULANG";
					$html .= '<tr>
						<td>'.$i.'.</td>
						<td>
										'.tgl_indo(date("D", strtotime($row->tgl_register))).'
										<p>'.tgl_indo(date("d-m-Y", strtotime($row->tgl_register))).'</p>
									</td>
                                    <td>
										'.$row->nama_pasien.' -- ('.$row->no_index.')
										<p>UMUR : '.get_age($row->tgl_lahir).' Th</p>
										<p>KELAMIN : '.$row->gender.'</p>
									</td>
                                    <td>
										<p class="lead">'.$row->keluhan.'<p>
										<p>DX : '.$row->diagnosa.'<p>
										<p>TB/BB : '.$row->tb.'/'.$row->bb.'<p>
										<p>Sistole/Diastole : '.$row->sistole.'/'.$row->diastole.'<p>
										<p>Respiratory Rate/Heart Rate : '.$row->respiratory.'/'.$row->heart.'<p>
										<p>Rujukan : '.$row->rujukan.'<p>
									</td>
                                    <td>'.getObat($row->obat).'</td>
                                    <td></td>
					</tr>';
					$i++;
				}
			}else{
				$html .= '<tr>
				<td colspan="10" align="center">
					<p class="lead">Data tidak ditemukan</p>
				</td>
				</tr>';
			}
			echo $html;
		}
	}
	
	function cariData(){
		$data = $this->input->get();
		//var_dump ($data);
		if($data){			
			$tgl = $data['tgl'];
			$bln = $data['bln'];
			$thn = $data['thn'];			
			$individu = $data['individu'];
			
			if($data['modePilihan']==1){
				$curdate = date("Y-m-d", strtotime($data['tgl']));
				$result2 = $this->db->query("SELECT a.*, b.* FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON b.no_index=a.no_index WHERE DATE(a.date_kunjungan) = '".$curdate."' GROUP BY a.no_index ORDER BY a.id ASC");
				$result2 = $this->db->query("select * from tbl_kunjungan a left join tbl_pasien b ON b.no_index=a.no_index where DATE(a.date_kunjungan) ='".$curdate."' group by a.no_index order by a.id asc");
			}
			if($data['modePilihan']==2){
				$result2 = $this->db->query("SELECT a.*, b.* FROM tbl_kunjungan a
				LEFT JOIN tbl_pasien b ON b.no_index=a.no_index WHERE DATE(a.date_kunjungan) = '".$bln."' AND YEAR(adate_kunjungan) = '".$thn."' GROUP BY a.no_index ORDER BY a.id ASC");
			}
			if($data['modePilihan']==3){
				if(is_numeric($individu)){
					if(strlen($individu)<6){
						//no_index
					}
					if(strlen($individu)>6){
						//no_bpjs
					}
				}
				
				$result2 = $this->db->query("SELECT a.*, b.* FROM tbl_kunjungan a
				LEFT JOIN tbl_pasien b ON b.no_index=a.no_index WHERE b.no_bpjs LIKE '%".trim($individu)."' OR b.nama_pasien LIKE '%".trim($individu)."%' OR b.no_index LIKE '%".trim($individu)."' GROUP BY a.no_index ORDER BY a.id ASC");
			}
			
			echo $this->db->last_query();
			$html = '';
			if($result2->num_rows()){
				$visits = $result2->result();
				$i=1;
				foreach($visits as $row){
					//if($row->antrian==0) $antrian = $row->jenis_poli; else $antrian = "PULANG";
					if($row->no_index=='000NaN') return;
					$html .= '<tr>
						<td>'.$i.'.</td>
						<td>'.$row->no_index.'</td>
						<td>'.$row->nama_pasien.'</td>
						<td>'.$row->gender.'</td>
						<td>'.get_age($row->tgl_lahir).' Th</td>
						<td>'.$row->desa.'</td>
						<td>'.$row->no_bpjs.'</td>
						<td>'.$row->kunjungan.'</td>
						<td>'.tgl_indo(date("D, d-m-Y", strtotime($row->date_kunjungan))).'</td>
					</tr>';
					$i++;
				}
			}else{
				$html .= '<tr>
				<td colspan="10" align="center">
					<p class="lead">Data tidak ditemukan</p>
				</td>
				</tr>';
			}
			echo $html;
		}
	}
	
	function cetak(){
		$data = $this->input->get();
		//var_dump ($data);
		
		if($data['nokartu']){
			$ids = explode(",", $data['nokartu']);
			if(is_array($ids)){
				$result = $this->db->query("SELECT * FROM tbl_pasien WHERE no_index IN ('".implode("','",$ids)."') ORDER BY id DESC");
			}else {
				$result = $this->db->query("SELECT * FROM tbl_pasien WHERE no_index ='".$data['nokartu']."' ORDER BY id DESC");
			}
		}
		
		//$nokartu = $this->set_barcode($data['nokartu']);
		$this->load->view('AdminLTE/cetak_kartu', array("result" => $result->result()));
	}
	
	function view_barcode(){
		$data = $this->input->get();
		$this->set_barcode('*'.$data['nokartu'].'*');
	}
	
	private function set_barcode($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		$imageResource = Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
		imagepng($imageResource, 'assets/'.$code.'.png');
	}
	
	function desa_andoolo(){
		/*$arr = array('Adaka Jaya', 'Adayu Indah', 'Andolo Utama', 'Anggokoti', 'Asembu Mulya', 'Awolo', 'Buke', 'Pelandia', 'Puudaria Jaya', 'Raha Menda Jaya', 'Ranooha Lestari', 'Silea Jaya', 'Tetenggolasa', 'Tirta Wartani', 'Wanua Maroa','Wulele Jaya');
		
		header('Content-Type: application/json');
		echo json_encode( $arr );*/
	}
	
	function diagnosa_histori(){
		$data = $this->input->get();
		if($data['no_index']){
			$result = $this->db->query("SELECT * FROM tbl_pasien a LEFT JOIN tbl_rekamedis b on b.no_index=a.no_index WHERE a.no_index ='".$data['no_index']."' ORDER BY a.id DESC");
		
			header('Content-Type: application/json');
			header('Access-Control-Allow-Origin: *');
			echo json_encode( $result->result_array() );
		}
	}
	
	function diagnosa(){
		$data = $this->input->get();
		if($data['term']){
			$result = $this->db->query("SELECT * FROM tbl_diagnosa WHERE keterangan LIKE '%".$data['term']."%' ORDER BY id DESC");
			foreach ($result->result_array() as $row){
				$json[] = array("id" => $row['id'],"text" => $row['keterangan']);
			}
			echo json_encode($json);
		}
	}
	
	function obat(){
		$data = $this->input->get();
		if($data['term']){
			$result = $this->db->query("SELECT * FROM tbl_obat 
			WHERE nama_obat LIKE '%".$data['term']."%' AND stok >=1
			ORDER BY id_obat DESC");
			foreach ($result->result_array() as $row){
				$json[] = array("id" => $row['id_obat'],"text" => $row['nama_obat'] . ' ~ ' . $row['stok']);
			}
			echo json_encode($json);
		}
	}
	
	function penyakit(){
		$data = $this->input->get();
		if($data['term']){
			$result = $this->db->query("SELECT * FROM tbl_penyakit_copy WHERE penyakit LIKE '%".$data['term']."%' ORDER BY id DESC");
			$json = array();
			foreach ($result->result_array() as $row){
				$json[] = array("id" => $row['code'],"text" => $row['penyakit']);
			}
			echo json_encode($json);
		}
	}
	
	function getrujukan(){
		$data = $this->input->get();
		if($data['term']){
			$result = $this->db->query("SELECT * FROM tbl_rujukan WHERE rujukan LIKE '%".$data['term']."%' LIMIT 1");
			foreach ($result->result_array() as $row){
				$json[] = array("id" => $row['id'],"text" => $row['rujukan']);
			}
			echo json_encode($json);
		}
	}
	
	function rujukan(){
		$data = $this->input->get();
		if($data['id']){
			$result = $this->db->query("SELECT * FROM tbl_rujukan WHERE id='".$data['id']."' LIMIT 1");
			foreach ($result->result_array() as $row){
				$json[] = $row;
			}
			echo json_encode($json);
		}
	}
	
	function pasien(){
		$data = $this->input->get();
		if($data['term']){
			$result = $this->db->query("SELECT * FROM tbl_pasien WHERE nama_pasien LIKE '%".$data['term']."%' ORDER BY id DESC");
			foreach ($result->result_array() as $row){
				$json[] = $row;// array("label" => $row['id'],"value" => $row['nama_pasien']);
			}
			echo json_encode($json);
		}
	}
	
	function sign_apotek(){
		$data = $this->input->get();
		if($data['no_index']){
			$this->approveApotek('POLI UMUM', $data['no_index']);
			
			$this->migrasiObat($data['no_index']);
		}
	}
	
	function sink(){
		$data = $this->input->get();
		if($data['no_index']){
			$this->migrasiObat($data['no_index']);
		}
	}
	
	function migrasiObat($no_index){
		// select obat from tbl_rekamedis
		$this->db->where("no_index", $no_index);
		$result = $this->db->get("tbl_rekamedis")->row();
		//echo $this->db->last_query();
		
		// insert into tbl_obat_keluar
		$obat_keluar = explode(",", $result->obat);
		if(is_array($obat_keluar)){
			//var_dump($obat_keluar);
			
			foreach($obat_keluar as $obat){
				$arr = array(
					'no_index' => $no_index,
					'id_obat' => $obat,
					'tgl_register' => $result->tgl_register,
				);
				$this->db->insert('tbl_obat_keluar', $arr);
				echo $this->db->last_query();
			}
		}
	}
	
	function approveApotek($poli_tujuan, $no_index){
		$data = array ('jenis_poli' => $poli_tujuan);
		$this->db->where('no_index', $no_index);
		$this->db->update('tbl_kunjungan', $data);
		
		$data = array ('antrian' => 10);
		$this->db->where('no_index', $no_index);
		$this->db->update('tbl_pasien', $data);
	}
	
	function rekamedis_pasien(){
		$data = $this->input->get();
		if($data['no_index']){
			$result = $this->db->query('SELECT * FROM tbl_rekamedis a LEFT JOIN tbl_pasien b ON b.no_index=a.no_index WHERE a.no_index='.$data['no_index'].' ORDER BY a.id DESC');
			
			$html = '';
			$i=1;
			foreach($result->result() as $row){
				$html .= '<tr>
                    <td>'.$i.'.</td>
                    <td>'.tgl_indo(date("D, d-m-Y", strtotime($row->tgl_register))).'</td>
                    <td>'.$row->nama_pasien.'</td>
                    <td>'.get_age($row->tgl_lahir).' Th</td>
                    <td>'.$row->gender.'</td>
                    <td>'.$row->keluhan.'</td>
                    <td>'.$row->terapi.'</td>
                    <td>'.$row->kasus.'</td>
                    <td>'.$row->no_bpjs.'</td>
                </tr>';
				$i++;
			}
			
			echo $html;
			
		}
	}
	
	function antrian(){
		$curdate = date("Y-m-d");
		$result = $this->db->query("SELECT * FROM  tbl_kunjungan a
		LEFT JOIN tbl_pasien b ON b.no_index=a.no_index
		WHERE DATE( a.date_kunjungan ) =  '".$curdate."'
		ORDER BY a.id DESC");
		
		$result = $this->db->query("SELECT a.*, b.* FROM tbl_kunjungan a LEFT JOIN tbl_pasien b ON a.no_index=b.no_index WHERE DATE(a.date_kunjungan) = '{$curdate}' AND b.antrian=0 ORDER BY a.id desc");
		//$this->load->view('AdminLTE/antrian', array("result" => $result->result()));
		
		/*$html = '<table class="table table-bordered">
			<thead>
				<tr>
					<th>NO ANTRIAN</th>
					<!--<th>ID PASIEN</th>-->
					<th>NAMA PASIEN</th>
					<th>TUJUAN</th>
					<th>JAM MASUK</th>
				</tr>
			</thead>
			<tbody>';*/
			
			$b=1;
			foreach($result->result() as $row){
				echo '<tr>
					<td align="center">'.$row->no_antrian.'</td>
					<!--<td>'.($row->no_index).'</td>-->
					<td>'.$row->nama_pasien.'</td>
					<td>'.$row->poli_tujuan.'</td>
					<td>'.date("H:i",strtotime($row->date_kunjungan)).'</td>
				</tr>';
				$b++;
			}
			
			/*$html .= '</tbody>
		</table>
		</div>';*/
		
		//echo $html;
	}
	
	function statMonth(){
		//require_once(APPPATH.'controllers/admin.php');
		//$aObj = new admin();
		
		$data = $this->input->get();
		$month = date("m", strtotime($data['myDate']));
		
		$stat = array(
			"labels" => explode(",",str_replace('"','',$this->statlabels($month))),
			"data" => explode(",",$this->statdata($month))
		);
		echo json_encode($stat);
	}
	
	function statmonthDesa(){
		//require_once(APPPATH.'controllers/admin.php');
		//$aObj = new admin();
		
		$data = $this->input->get();
		$month = date("m", strtotime($data['myDate']));
		
		$stat = array(
			"statDesa" => json_decode($this->statDesaJson($month),true)
		);
		//echo json_encode($stat);
		
		$bar = array('progress-bar-aqua', 'progress-bar-green', 'progress-bar-red', 'progress-bar-yellow');
		//shuffle($bar);
			
		if($stat['statDesa']){
			$tot = 0;
			foreach($stat['statDesa'] as $statDesa){
				$tot += $statDesa['tot'];
			}
						
			$html = '';
			foreach($stat['statDesa'] as $statDesa){
			  $percent = ($statDesa['tot']/$tot)*100;
			 
			  $html .= '<div class="progress-group">
				<span class="progress-text">'.$statDesa['desa'].'</span>
				<span class="progress-number"><b>'.$statDesa['tot'].'</b>/'.$tot.'</span>

				<div class="progress sm">
				  <div class="progress-bar '.$bar[array_rand($bar)].'" style="width: '.(int)$percent.'%"></div>
				</div>
			  </div>
			  <!-- /.progress-group -->';
			}
		
			echo $html;
		}
	}
	
	
	
	function statlabels($month = "MONTH(NOW())"){
		$result = $this->db->query("SELECT DATE(tgl_register) as tgl, count(tgl_register) as tot FROM tbl_pasien WHERE MONTH(tgl_register) = '".$month."' GROUP BY tgl having tot >=1 ORDER BY tgl_register ASC");
		//echo $this->db->last_query();
		
		if($result->num_rows()){
			$data = array();
			foreach ($result->result() as $row){
				$data[] = $row->tgl;
			}
		}else{
			for($d=1;$d <= date('d'); $d++){
				if($d<10) $d='0'.$d;
				$data[] = date("Y-m-".$d);
			}
		}
		
		return implode($data,'", "');
	}
	
	function statdata($month = "MONTH(NOW())"){
		$result = $this->db->query("SELECT DATE(tgl_register) as tgl, count(tgl_register) as tot FROM tbl_pasien WHERE MONTH(tgl_register) = {$month}
		GROUP BY tgl having tot >=1 ORDER BY tgl_register ASC");
		//echo $this->db->last_query();
		
		$data = array();
		if($result->num_rows()){
			foreach ($result->result() as $row){
				$data[] = $row->tot;
			}
		}else{
			$label = str_replace('"', '', $this->statlabels($month));
			$label = explode(",", $label);
			$label = count($label);
			for($d=1;$d<=$label; $d++){
				$data[] = 0;
			}
		}
		return implode($data, ',');
	}
	
	function statPlot(){
		$result = $this->db->query("SELECT DATE(tgl_register) as tgl, count(tgl_register) as tot FROM tbl_pasien WHERE MONTH(tgl_register) = MONTH(NOW())
		GROUP BY tgl having tot >=1 ORDER BY tgl_register ASC");
		$results = '';
		foreach ($result->result() as $row){
			$results .= "[".$row->tgl.",".$row->tot."], ";
		}
		
		return rtrim($results,', ');
	}
	
	function statDesa(){
		$result = $this->db->query("SELECT desa, count(desa) as tot FROM tbl_pasien WHERE MONTH(tgl_register) = MONTH(NOW())
		GROUP BY desa having tot >=1 ORDER BY tot ASC");
		
		$results = array();
		if($result->num_rows()){
			foreach ($result->result() as $row){
				$results .= "[".$row->desa.",".$row->tot."], ";
			}			
			return rtrim($results,', ');
		}
	}
	
	function statDesaJson($month = "MONTH(NOW())"){
		$result = $this->db->query("SELECT desa, count(desa) as tot FROM tbl_pasien WHERE MONTH(tgl_register) = {$month}
		GROUP BY desa having tot >=1 ORDER BY tot DESC");
		
		if($result->num_rows()){
			foreach ($result->result() as $row){
				$results[]= array("desa" => $row->desa, "tot" => $row->tot);
			}			
			return json_encode($results);
		}
	}
}