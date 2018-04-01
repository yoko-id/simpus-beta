<?php

function balita_umur($umur_bln){
	// 0-5 bln, 6-11 bln, 12-23 bln, 24-59 bln
	// SELECT * FROM tbl_gizi WHERE tgl_lahir > DATE_SUB(NOW(), INTERVAL 59 MONTH) ORDER BY tgl_lahir DESC;
	
	if($umur_bln>=0 && $umur_bln<=5){
		echo "0-5 BL";
	}elseif($umur_bln>=6 && $umur_bln<=11){
		echo "6-11 BL";
	}elseif($umur_bln>=12 && $umur_bln<=23){
		echo "12-23 BL";
	}elseif($umur_bln>=24 && $umur_bln<=59){
		echo "24-59 BL";
	}
}

function balita_statusbb($umur_bln,$selisihbb){
	$status_bb 	= array();
	$selisihbb	= abs($selisihbb*1000);
	
	if($umur_bln>=12){
		if($selisihbb >= 200) $status_bb = array("N" => "Y", "T" => "--"); else $status_bb = array("N" => "--", "T" => "Y"); 
	}
	if($umur_bln>=8 && $umur_bln<=11){
		if($selisihbb >= 300) $status_bb = array("N" => "Y", "T" => "--"); else $status_bb = array("N" => "--", "T" => "Y"); 
	}
	if($umur_bln>=6 && $umur_bln<=7){
		if($selisihbb >= 400) $status_bb = array("N" => "Y", "T" => "--"); else $status_bb = array("N" => "--", "T" => "Y"); 
	}
	if($umur_bln==5){
		if($selisihbb >= 500) $status_bb = array("N" => "Y", "T" => "--"); else $status_bb = array("N" => "--", "T" => "Y"); 
	}
	if($umur_bln==4){
		if($selisihbb >= 500) $status_bb = array("N" => "Y", "T" => "--"); else $status_bb = array("N" => "--", "T" => "Y"); 
	}
	if($umur_bln==3){
		if($selisihbb >= 800) $status_bb = array("N" => "Y", "T" => "--"); else $status_bb = array("N" => "--", "T" => "Y"); 
	}
	if($umur_bln==2){
		if($selisihbb >= 900) $status_bb = array("N" => "Y", "T" => "--"); else $status_bb = array("N" => "--", "T" => "Y"); 
	}
	if($umur_bln==1){
		if($selisihbb >= 800) $status_bb = array("N" => "Y", "T" => "--"); else $status_bb = array("N" => "--", "T" => "Y"); 
	}
	return $status_bb;
}