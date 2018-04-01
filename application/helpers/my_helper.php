<?php
date_default_timezone_set("Asia/Jakarta");

include_once ("gizi_helper.php");

if (version_compare(phpversion(), '5', '>=')){
	//return phpversion();
	return PHP_VERSION;
}

function myTitle($title){	
	if(empty($title)) $title = "Simpus Online Puskesmas Andoolo Utama";	
	if(!$title === false) $title = $title . ' - Simpus Online Puskesmas Andoolo Utama';
	return $title;
}

function get_kategoriObat($id){
	$CI =& get_instance();
    $CI->load->database();
	
	$CI->db->select('kategori');
    $CI->db->where('id_kategori',$id);

    $query = $CI->db->get('tbl_obat_kategori');
	return $query->row()->kategori;
}

function getAntrian($no_index){
	$CI =& get_instance();
    $CI->load->database();
	
	if($no_index){
		$query = $CI->db->query("SELECT * FROM tbl_kunjungan WHERE no_index=$no_index")->row();
		return $query->no_antrian;
	}
}

function getToday(){
	if ($_SERVER['SERVER_ADDR'] != '127.0.0.1'){
		return date("Y-m-d", strtotime("-1 day"));
	}else{
		return date("Y-m-d");
	}
}

function listBulan(){
	$month = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	return $month;
}

function listTahun($jarak=5){
	$yearNow = date("Y");
	$yearEnd = ($yearNow-$jarak);
	$years = range($yearNow, $yearEnd);
	return $years;
}

function tgl_indo($str){
    $tr   = trim($str);
    $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
    return $str;
}

//Common Function
function kapanUltah($TglLahir){
	$date = date('m-d', strtotime($TglLahir));
	$today = date('m-d');
	$tomorrow = date('m-d', strtotime('tomorrow')); 
	$day_after_tomorrow = date('m-d', strtotime('tomorrow + 1 day'));

	if ($date == $today) {
	  $result = "Hari Ini";
	} else if ($date == $tomorrow) {
	  $result = "Besok";
	} else if ($date == $day_after_tomorrow) {
	  $result = "Lusa";
	}
	if($result) return "(".$result.")";
}

function get_age($dob){
	$diff = (date('Y') - date('Y',strtotime($dob)));
	return $diff;
}

function count_days($date) {
    $hari = floor((time() - strtotime($date))/86400);
	return abs($hari);
}

function count_months2($date) {
	$d1 = strtotime($date);
	$d2 = strtotime(date("Y-m-d"));
	$min_date = min($d1, $d2);
	$max_date = max($d1, $d2);
	$i = 0;

	while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
		$i++;
	}
	return $i; // 8
}

// http://codingpintar.blogspot.co.id/2016/04/menghitung-umur-dengan-php.html
function umur($tgl_lahir){
    $tgl=explode("-",$tgl_lahir);
    $cek_jmlhr1=cal_days_in_month(CAL_GREGORIAN,$tgl['1'],$tgl['2']);
    $cek_jmlhr2=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    $sshari=$cek_jmlhr1-$tgl['0'];
    $ssbln=12-$tgl['1']-1;
    $hari=0;
    $bulan=0;
    $tahun=0;
	//hari+bulan
    if($sshari+date('d')>=$cek_jmlhr2){
        $bulan=1;
        $hari=$sshari+date('d')-$cek_jmlhr2;
    }else{
        $hari=$sshari+date('d');
    }
    if($ssbln+date('m')+$bulan>=12){
        $bulan=($ssbln+date('m')+$bulan)-12;
        $tahun=date('Y')-$tgl['2'];
    }else{
        $bulan=($ssbln+date('m')+$bulan);
        $tahun=(date('Y')-$tgl['2'])-1;
    }

    $selisih = $tahun." Tahun ".$bulan." Bulan ".$hari." Hari";
    return $selisih;
}

function desa_andoolo(){
	$arr = array("","PELANDIA", "RANAOHA LESTARI", "ANDOOLO UTAMA", "SILEA JAYA", "TIRTA MARTANI", "PUDURIA JAYA", "TETENGGOLASA", "RAHAMENDA", "BUKE", "AWALO", "ASEMBU MULYA", "ANGGOKOTI", "WULELE JAYA", "WONUA MAROA", "ADAKA JAYA", "ADAYU INDAH", "ALANGGA", "ANDOOLO", "POTORO", "ALENGGE AGUNG", "PAPAWU", "LALONGGOMBU", "ANESSE", "BEKENGGASU", "WATUMOKALA", "LALOBAO", "BENUA", "BUMI RAYA", "MATEUPE", "BIMAMAROA", "WAWOBENDE", "PUNGGAPU");	
	return json_encode( $arr );
}

function toIDR($number){	
	return number_format($number,0,',','.');
}

function mynumber_pad($number,$n=6) {
	return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

/*
	http://blog.s-widodo.com/artikel-mengompress-gambar-dengan-php.html
*/
function compress_gambar($source_url, $quality) {
    $info = getimagesize($source_url);
  
    if ($info['mime'] == 'image/jpeg') $gambar = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif') $gambar = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png') $gambar = imagecreatefrompng($source_url);
  
    imagejpeg($gambar, $source_url, $quality);
    return $source_url;
}

function userlevel(){
	$this->session->userdata('item');
}

function lb1_penyakit_kasusUmur($penyakit, $month=''){
	$CI =& get_instance();
    $CI->load->database();
	
	if(empty($month)) $month = date("m");	
	$result = $CI->db->query("SELECT 
		count(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) <1 THEN 1 END) as umur1,
		count(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 1 AND 4 THEN 1 END) as umur2,
		count(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 5 AND 14 THEN 1 END) as umur3,
		count(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 15 AND 44 THEN 1 END) as umur4,
		count(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >45 THEN 1 END) as umur5
	FROM tbl_pasien a LEFT JOIN tbl_rekamedis b  ON b.no_index=a.no_index
	WHERE b.penyakit='{$penyakit}' AND MONTH(b.tgl_register) = '{$month}'
	GROUP BY b.penyakit");
	//echo $CI->db->last_query()."<br>";
	if($result->result()) return $result->result();
}

function lb1_penyakit_kasus($penyakit, $month=''){
	$CI =& get_instance();
    $CI->load->database();
	
	if(empty($month)) $month = date("m");
	$result = $CI->db->query("SELECT
		count(CASE WHEN a.kunjungan='BARU' THEN 1 END) AS baru,
		count(CASE WHEN a.kunjungan='LAMA' THEN 1 END) AS lama
	FROM tbl_pasien a LEFT JOIN tbl_rekamedis b ON b.no_index=a.no_index
	WHERE b.penyakit='{$penyakit}' AND MONTH(b.tgl_register) = '{$month}'
	GROUP BY b.penyakit");
	//echo $CI->db->last_query();
	if($result->result()) return $result->result();
}

/**
 * Check if a string is serialized
 * @param string $string
 */
function is_serial($string) {
    return (@unserialize($string) !== false || $string == 'b:0;');
}

function getObat($idObat){	
	$CI =& get_instance();
    $CI->load->database();
	
	if(is_serial($idObat)) return;
	
	$obat = explode(",",$idObat);
	$i=1;
	$html = '<ul>';
	foreach($obat as $obatid){
		if(getNamaObat($obatid)){
			$html .= '<li>'.ucwords(getNamaObat($obatid)).'</li>';
		}
		$i++;
	}
	$html .= '</ul>';
	return $html;
	//return implode(", ", $data);
}

function getNamaObat($id){
	$CI =& get_instance();
    $CI->load->database();
	
	if($id){
		$query = $CI->db->query("SELECT * FROM tbl_obat WHERE id_obat=$id")->row();
		return $query->nama_obat;
	}
}

function list_poli(){	
	$CI =& get_instance();
    $CI->load->database();

    $CI->db->where('status', 1);
    $query = $CI->db->get('tbl_poli');
	foreach($query->result() as $row){
		$result[] = $row;
	}
	return $result;
}

function slugy($string){ 
    //$string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
	$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $string)));
	return $slug;
}

// Generate your multidimensional array from the linear array
function GenerateNavArray($arr, $parent = 0)
{
    $pages = Array();
    foreach($arr as $page)
    {
        if($page->parent == $parent)
        {
            $page->sub = isset($page->sub) ? $page->sub : GenerateNavArray($arr, $page->code);
            $pages[] = $page;
        }
    }
    return $pages;
}

// loop the multidimensional array recursively to generate the HTML
function GenerateNavHTML($nav)
{
    $pages = Array();
	foreach($nav as $page)
    {
        $page->sub = isset($page->sub) ? $page->sub : GenerateNavHTML($arr, $page->code);
        $pages[] = $page;
    }
    return $pages;
}