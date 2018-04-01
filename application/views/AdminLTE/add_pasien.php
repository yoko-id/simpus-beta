<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>
	
	<style>
		<!--
			.input-group-addon { padding: 0px 12px !important; }
		//-->
	</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			REGISTER PASIEN BARU & KUNJUNGAN
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12 col-xs-12">				
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Register Pasien & Kunjungan</h3>
						<div class="box-tools pull-right">
							
						</div>
					</div>					
					<div class="box-body">
					<?php
					if($this->session->flashdata('response')){
					?>
						<div class="row clearfix">
							<div class="col-xs-12">
								<div class="alert alert-warning">
									<h4>
										<i class="glyphicon glyphicon-info-sign"></i>
										<?=$this->session->flashdata('response');?>
									</h4>
									<?php if($this->session->flashdata('response')=="Data Tersimpan"){ ?>
									<p>
										<a target="_blank" href="<?=site_url('api/kartu/cetak?nokartu='.mynumber_pad($no_index-1));?>" onclick="window.open(this.href, '', 'width=500,height=290');return false;"> Cetak Kartu <i class="glyphicon glyphicon-print"></i></a>
									</p>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php
					}
					?>
						
						<form data-toggle="validator" role="form" method="POST">
							<div class="row clearfix">
								<div class="col-md-2">
									<div class="form-group">											
										<label class="form-label">ID PASIEN</label>
										<input type="text" class="form-control" name="noindex" value="<?php echo mynumber_pad($no_index);?>">
									</div>									
								</div>								
								<div class="col-md-4">									
									<div class="form-group">
										<label class="form-label">NAMA PASIEN</label>
										<input type="text" class="form-control" name="nama_pasien" required>
									</div>
								</div>									
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">NO.BPJS</label>
										<input type="text" class="form-control" name="nobpjs" id="nobpjs">
									</div>
								</div>										
								<div class="col-md-2">									
									<div class="form-group">										
										<label class="form-label">STATUS BPJS</label>
										<select name="status_bpjs" class="form-control">
											<option value="1" selected>AKTIF</option>
											<option value="0">TIDAK AKTIF</option>
										</select>
									</div>
								</div>										
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">NO.KTP/NIK</label>
										<input type="text" class="form-control" name="nonik">
									</div>
								</div>	
							</div>
							<div class="row clearfix">
								<div class="col-md-3">
									<div class="form-group">
										<label class="form-label">UMUR / TGL. LAHIR</label>
										<div class="input-group">
											<input type="text" class="form-control" name="umur">
											<span class="input-group-addon">
												<select name="mode_lahir" id="modeUmur">
													<option value="TH" selected>TAHUN</option>
													<option value="BL">BULAN</option>
												</select>
												<!--<select name="mode_umur" id="modeUmur">
													<option value="umur" selected>UMUR</option>
													<option value="tgl_lahir">TGL. LAHIR</option>
												</select>-->
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="form-label">KELAMIN</label>
										<select name="gender" class="form-control">
											<option value="L">L</option>
											<option value="P">P</option>
										</select>
									</div>
								</div>
								<!--<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">ALAMAT</label>
										<input type="text" class="form-control" name="alamat">
									</div>
								</div>-->
								<div class="col-md-3">
									<div class="form-group">
										<label class="form-label">KELURAHAN (DESA)</label>
										<select name="desa" class="form-control">										
											<?php
											$list_desa = json_decode( desa_andoolo(), true );
											asort($list_desa);
											foreach($list_desa as $vdesa){
												echo '<option value="'.$vdesa.'">'.$vdesa.'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">HUBUNGAN KELUARGA</label>
										<select name="status_peserta" class="form-control">
											<option value=""></option>
											<option value="Bapak">Bapak</option>
											<option value="Istri">Istri</option>
											<option value="Anak">Anak</option>
											<option value="Orang Tua">Orang Tua</option>
											<option value="Mertua">Mertua</option>
										</select>
									</div>
								</div>
							</div>
								
							<div class="row clearfix">
								
								<div class="col-md-4">
									<div class="form-group">
										<label class="form-label">STATUS KEPESERTAAN</label>
										<select name="jenis_peserta" class="form-control">
											<option value=""></option>
											<option value="Kader/Gratis">Kader/Gratis</option>
											<option value="Umum">Umum</option>
											<option value="BPJS/KIS">BPJS/KIS</option>
											<option value="BPJS MANDIRI">BPJS MANDIRI</option>
										</select>
									</div>
								</div>							
								<div class="col-md-2">
									<div class="form-group">
										<label class="form-label">RUJUKAN DARI</label>
										<select name="dari_rujukan" class="form-control">									
											<option value=""></option>
											<option value="Rumah Sakit">Rumah Sakit</option>
											<option value="Sendiri/Keluarga">Sendiri/Keluarga</option>
											<option value="Umum">Umum</option>
											<option value="Kader">Kader</option>
											<option value="UKS">UKS</option>
											<option value="Polindes">Polindes</option>
											<option value="Pustu">Pustu</option>
											<option value="Poskesdes">Poskesdes</option>
											<option value="Lainnya">Lainnya</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="form-label">POLI TUJUAN</label>
										<select name="tujuan_poli" class="form-control">
											<option value="POLI UMUM">POLI UMUM</option>
											<option value="POLI AKUPRESURE">POLI AKUPRESURE</option>
											<option value="POLI ANAK">POLI ANAK</option>
											<option value="POLI GIGI">POLI GIGI</option>
											<option value="PROGRAMMER/KONSELING GIZI">PROGRAMMER/KONSELING GIZI</option>
											<option value="PROGRAMMER IMUNISASI">PROGRAMMER IMUNISASI</option>
											<option value="POLI KIA/KB">POLI KIA/KB</option>
											<option value="POLI LABORATORIUM">POLI LABORATORIUM</option>
											<option value="POSBINDU PTM">POSBINDU PTM</option>
											<option value="POLI MTBS">POLI MTBS</option>
											<option value="POLI IGD">POLI IGD</option>
											<option value="RUMAH SAKIT">RUMAH SAKIT</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="form-label">KEPERLUAN</label>
										<select name="kperluan" class="form-control">
											<option value="Berobat">Berobat</option>
											<option value="Kontrol/Ambil Obat">Kontrol/Ambil Obat</option>
											<option value="Konsultasi">Konsultasi</option>
											<option value="Chek Up/ Surat Ket. Sehat">Chek Up/ Surat Ket. Sehat</option>
											<option value="Posyandu/Imunisasi">Posyandu/Imunisasi</option>
											<option value="Periksa Hamil/Nifas/Bayi Baru Lahir">Periksa Hamil/Nifas/Bayi Baru Lahir</option>
											<option value="Melahirkan/ Bed Rest">Melahirkan/ Bed Rest</option>
											<option value="Surat Rujukan Ke Rumah Sakit">Surat Rujukan Ke Rumah Sakit</option>
										</select>
									</div>
								</div>
							</div>
							
							<div class="row clearfix">
								<div class="col-md-2">
									<div class="form-group">
										<label class="form-label">KUNJUNGAN</label>
										<div class="btn-group">
											<input type='hidden' name="kasus" value="BARU">
											<button type="button" data-value="BARU" class="btn btn-default baru active">BARU</button>
											<button type="button" data-value="LAMA" class="btn btn-default lama">LAMA</button>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="form-label">TGL REGISTER</label>
										<input type="text" name="tgl_register" class="form-control" id="datepicker" data-date-format="yyyy-mm-dd">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="form-label">TGL KUNJUNGAN</label>
										<input type="text" name="date_kunjungan" class="form-control" id="datepicker" data-date-format="yyyy-mm-dd">
									</div>
								</div>
								
								<div class="col-md-6" style="padding-top:25px;">									
									<button class="btn btn-warning waves-effect" type="submit">SIMPAN PASIEN</button>
									<input type="hidden" name="ppk" value="P7405021201">
								</div>
							</div>
                        </form>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<!-- /.row -->		
				
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Daftar Kunjungan Peserta Sakit/Sehat</h3>
						<div class="pull-right hide">
						
						</div>
					</div>
					
					<div class="box-body">
						<div class="panel panel-default">
							<div class="panel-body">
								<form class="form-inline">
									<div class="form-group">
										<div class="radio">
											<label> <input type="radio"  name="modePilihan" value="1" checked> Harian </label>
										</div>
										<input type="text" class="form-control" name="tgl" id="datepicker" placeholder="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd">
									</div>
									<div class="form-group">
										<div class="radio">
											<label> <input type="radio" name="modePilihan" value="2"> Bulanan </label>
										</div>
										<?php
										$bln = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
										$yearNow = date("Y");
										$yearEnd = ($yearNow-5);
										$years = range($yearNow, $yearEnd);
										?>
										
										<select name="bln" class="form-control">
											<?php foreach($bln as $key => $bl){
											echo '<option value="'.$key.'">'.$bl.'</option>';
											} ?>
										</select>
										<select name="thn" class="form-control">
											<?php foreach($years as $th){
											echo '<option value="'.$th.'">'.$th.'</option>';
											} ?>
										</select>
									</div>
									<div class="form-group">
										<div class="radio">
											<label> <input type="radio" name="modePilihan" value="3"> Individu </label>
										</div>
										<input type="text" class="form-control" name="individu">
									</div>
									<button type="button" class="btn btn-default" id="cariData">Cari Data</button>
									<button type="button" class="btn btn-default" id="cetakData">Cetak</button>
								</form>
							</div>
						</div>
						
						<table id="_example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NO INDEX</th>
                                    <th>NAMA PASIEN</th>
                                    <th>KELAMIN</th>
                                    <th>UMUR</th>
                                    <th>ALAMAT</th>
                                    <th>NO BPJS</th>
                                    <th>KUNJUNGAN</th>
                                    <th>TGL. KUNJUNGAN</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							foreach($visits as $row){
                            ?>
								<tr>
                                    <td><?=$i;?>.</td>
                                    <td><?=$row->no_index;?></td>
                                    <td><?=$row->nama_pasien;?></td>
                                    <td><?=$row->gender;?></td>
                                    <td><?=get_age($row->tgl_lahir);?> Th</td>
                                    <td><?=$row->desa;?></td>
                                    <td><?=$row->no_bpjs;?></td>
                                    <td><?=$row->kunjungan;?></td>
									<td><?=tgl_indo(date("D, d-m-Y", strtotime($row->date_kunjungan)));?></td>
									<td><button class="btn btn-default" id="play" onclick="mulai(<?=(int)$row->no_antrian;?>,'<?=$row->jenis_poli;?>');"><i class="glyphicon glyphicon-volume-up"></i> <?=$row->no_antrian;?></button></td>
                                </tr>
							<?php
								$i++;
							}
							?>
                            </tbody>
                        </table>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<!-- Modal -->
	<div class="modal fade" id="my_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Tambah Desa</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-inline">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Tambah Nama Desa">
				</div>
				<button type="submit" class="btn btn-default">Tambah Desa</button>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary">Simpan</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<audio id="suarabel" src="<?php echo base_url();?>assets/sound/dingdong0.wav"></audio>
	<audio id="suarabelnomorurut" src="<?php echo base_url();?>assets/sound/nomor-urut.wav"  ></audio> 
	<audio id="suarabelsuarabelloket" src="<?php echo base_url();?>assets/sound/loket.wav"  ></audio>
	<audio id="suaraloket" src="<?php echo base_url();?>assets/sound/1.wav"  ></audio>
	
	<audio id="belas" src="<?php echo base_url();?>assets/sound/belas.wav"  ></audio> 
	<audio id="sebelas" src="<?php echo base_url();?>assets/sound/sebelas.wav"  ></audio> 
    <audio id="puluh" src="<?php echo base_url();?>assets/sound/puluh.wav"  ></audio> 
    <audio id="sepuluh" src="<?php echo base_url();?>assets/sound/sepuluh.wav"  ></audio> 
    <audio id="ratus" src="<?php echo base_url();?>assets/sound/ratus.wav"  ></audio> 
    <audio id="seratus" src="<?php echo base_url();?>assets/sound/seratus.wav"  ></audio> 
    
	<audio id="suarabel0" src="<?php echo base_url();?>assets/sound/1.wav" ></audio>
	<audio id="suarabel1" src="<?php echo base_url();?>assets/sound/1.wav" ></audio>
	
	<script type="text/javascript">
	function mulai(antrian,loket){
		var panjang = antrian.toString().length;
		console.log(antrian + ', ' + panjang + ', ' + loket);		
		
		if (loket == 'POLI GIGI'){
			document.getElementById("suaraloket").src = base_url + "assets/sound/2.wav";
		} else if (loket == 'APOTEK'){
			document.getElementById("suaraloket").src = base_url + "assets/sound/3.wav";
		} else if (loket == 'POLI UMUM'){
			document.getElementById("suaraloket").src = base_url + "assets/sound/1.wav";
		}
		
		//MAINKAN SUARA BEL PADA SAAT AWAL
		document.getElementById('suarabel').pause();
		document.getElementById('suarabel').currentTime=0;
		document.getElementById('suarabel').play();
				
		//SET DELAY UNTUK MEMAINKAN REKAMAN NOMOR URUT		
		totalwaktu=document.getElementById('suarabel').duration*1000;	

		//MAINKAN SUARA NOMOR URUT		
		setTimeout(function() {
				document.getElementById('suarabelnomorurut').pause();
				document.getElementById('suarabelnomorurut').currentTime=0;
				document.getElementById('suarabelnomorurut').play();
		}, totalwaktu);
		totalwaktu=totalwaktu+1000;
		
		var myarray = antrian.toString().split('');
		for(var i = 0; i < myarray.length; i++)
		{
		   document.getElementById("suarabel" + i).src = base_url + "assets/sound/" + myarray[i] + ".wav";
		   //console.log(myarray[i]);
		}
		
		if (antrian<10){
			setTimeout(function() {
				document.getElementById('suarabel0').pause();
				document.getElementById('suarabel0').currentTime=0;
				document.getElementById('suarabel0').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
			setTimeout(function() {
				document.getElementById('suarabelsuarabelloket').pause();
				document.getElementById('suarabelsuarabelloket').currentTime=0;
				document.getElementById('suarabelsuarabelloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;			
			
			setTimeout(function() {
				document.getElementById('suaraloket').pause();
				document.getElementById('suaraloket').currentTime=0;
				document.getElementById('suaraloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
		} else if (antrian ==10){
			setTimeout(function() {
				document.getElementById('sepuluh').pause();
				document.getElementById('sepuluh').currentTime=0;
				document.getElementById('sepuluh').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
			setTimeout(function() {
				document.getElementById('suarabelsuarabelloket').pause();
				document.getElementById('suarabelsuarabelloket').currentTime=0;
				document.getElementById('suarabelsuarabelloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;			
			
			setTimeout(function() {
				document.getElementById('suaraloket').pause();
				document.getElementById('suaraloket').currentTime=0;
				document.getElementById('suaraloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
		} else if (antrian ==11){		
			setTimeout(function() {
				document.getElementById('sebelas').pause();
				document.getElementById('sebelas').currentTime=0;
				document.getElementById('sebelas').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
			setTimeout(function() {
				document.getElementById('suarabelsuarabelloket').pause();
				document.getElementById('suarabelsuarabelloket').currentTime=0;
				document.getElementById('suarabelsuarabelloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;			
			
			setTimeout(function() {
				document.getElementById('suaraloket').pause();
				document.getElementById('suaraloket').currentTime=0;
				document.getElementById('suaraloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
		} else if (antrian < 20){		
			setTimeout(function() {
				document.getElementById('suarabel1').pause();
				document.getElementById('suarabel1').currentTime=0;
				document.getElementById('suarabel1').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
			setTimeout(function() {
				document.getElementById('belas').pause();
				document.getElementById('belas').currentTime=0;
				document.getElementById('belas').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
			setTimeout(function() {
				document.getElementById('suarabelsuarabelloket').pause();
				document.getElementById('suarabelsuarabelloket').currentTime=0;
				document.getElementById('suarabelsuarabelloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;			
			
			setTimeout(function() {
				document.getElementById('suaraloket').pause();
				document.getElementById('suaraloket').currentTime=0;
				document.getElementById('suaraloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
		} else if (antrian < 100){				
			setTimeout(function() {
				document.getElementById('suarabel0').pause();
				document.getElementById('suarabel0').currentTime=0;
				document.getElementById('suarabel0').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
			setTimeout(function() {
				document.getElementById('puluh').pause();
				document.getElementById('puluh').currentTime=0;
				document.getElementById('puluh').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
			setTimeout(function() {
				document.getElementById('suarabel1').pause();
				document.getElementById('suarabel1').currentTime=0;
				document.getElementById('suarabel1').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
						
			setTimeout(function() {
				document.getElementById('suarabelsuarabelloket').pause();
				document.getElementById('suarabelsuarabelloket').currentTime=0;
				document.getElementById('suarabelsuarabelloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
			
			setTimeout(function() {
				document.getElementById('suaraloket').pause();
				document.getElementById('suaraloket').currentTime=0;
				document.getElementById('suaraloket').play();
			}, totalwaktu);
			totalwaktu=totalwaktu+1000;
		} else {
			//JIKA LEBIH DARI 100 
			//Karena aplikasi ini masih sederhana maka logina konversi hanya sampai 100
			//Selebihnya akan langsung disebutkan angkanya saja 
			//tanpa kata "RATUS", "PULUH", maupun "BELAS"
			
			for(i=0;i<panjang;i++){
				totalwaktu=totalwaktu+1000;
				setTimeout(function() {
					document.getElementById('suarabel' + i ).pause();
					document.getElementById('suarabel' + i ).currentTime=0;
					document.getElementById('suarabel' + i ).play();
				}, totalwaktu);
			}
		}
	}
	</script>
	
	<script>
		function ucwords (str) {
			return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
				return $1.toUpperCase();
			});
		}

		function strtolower (str) {
			return (str+'').toLowerCase();
		}
		
		function getAge(birth) { 
			var today = new Date();
			var nowyear = today.getFullYear();
			var nowmonth = today.getMonth();
			var nowday = today.getDate();
		 
			var birthyear = birth.getFullYear();
			var birthmonth = birth.getMonth();
			var birthday = birth.getDate();
		 
			var age = nowyear - birthyear;
			var age_month = nowmonth - birthmonth;
			var age_day = nowday - birthday;
			
			if(age_month < 0 || (age_month == 0 && age_day <0)) {
				age = parseInt(age) -1;
			}
			return (age);
		}
		
		$(document).ready(function(){
			$("#play").click(function(){
				document.getElementById('suarabel').play();		
			});
			
			$("#cetakData").click(function(){
				var valData = $("form.form-inline").serialize();
				window.location = base_url + "api/laporanpdf/?"+valData;
				console.log(valData);
				return false;
			});
			
			$("#cariData").click(function(){
				var valData = $("form.form-inline").serialize();
				$.ajax({
					type: "GET",
					url: base_url + "api/cariData/",
					data: valData,
					success: function(data){
						$('table.table >tbody').html(data);
					}
				});
				return false;
			});
			
			$("input#nobpjs").focusout(function(){
				var n = parseInt($(this).val());
				$(this).val( pad(n) );
			});
			
			$("select#modeUmur").change(function(){
				var modeUmur = $(this).val();
				if(modeUmur=='tgl_lahir'){
					$("input[name='umur']").datepicker("enable");
				}else{
					$("input[name='umur']").datepicker("remove");
				}
			});
			
			$('.btn-group .btn').click(function () {
				$(this).parent().find('input').val($(this).data("value"));
				$(this).parent().find('button').removeClass('active');
				$(this).addClass('active');
			});
			
			$("input[name='noindex']").focus();
			
			$("input[name='noindex']").change(function(){
				var n = parseInt($(this).val().replace('*',''));
				var noindex = $(this).val( sixpad(n) );
				
				//alert("The text has been changed.");				
				$.getJSON( base_url + "api/kartu", { no_index: $(this).val() }, function(data, status){
					console.log(data);
					if(status=="success"){
						$("input[name='nama_pasien']").val( data[0].nama_pasien );
						$("input[name='nobpjs']").val( data[0].no_bpjs );						
						$("select[name='status_bpjs']").val( data[0].status_bpjs ).change();						
						var umur = getAge(new Date(data[0].tgl_lahir));
						$("input[name='umur']").val(umur);						
						$("select[name='gender']").val( data[0].gender ).change();
						$("select[name='desa']").val( data[0].desa ).change();
						
						if(data[0].kunjungan=='LAMA'){
							$("input[name='kasus']").val(data[0].kunjungan);
							$('.btn-group .baru').removeClass('active');
							$('.btn-group .lama').addClass('active');
						}
						
						var jenis_peserta = data[0].jenis_peserta;
						jenis_peserta = jenis_peserta.toLowerCase().replace(/\b[a-z]/g, function(letter) {
							return letter.toUpperCase();
						});
						//alert (jenis_peserta);
						
						$("select[name='jenis_peserta']").val( jenis_peserta ).change();
						
						var status_peserta = data[0].status_peserta;
						status_peserta = status_peserta.toLowerCase().replace(/\b[a-z]/g, function(letter) {
							return letter.toUpperCase();
						});
						$("select[name='status_peserta']").val( status_peserta ).change();
						
						var dateregister = new Date(data[0].tgl_register);
						$("input[name='tgl_register']").datepicker('setDate', dateregister);
					}
				});
				
				return false;
			});
			
			$("input[name='nama_pasien']").autocomplete({
				source: function( request, response ) {
					$.ajax({
						url: base_url + 'api/pasien',
						dataType: "json",
						data: {
							term: request.term
						},
						success: function (data) {
							var results = [];
							$.each(data, function(i, item) {
								var itemToAdd = {
									value : item.nama_pasien,
									label : item.nama_pasien,									
									id : item.id,
									no_index : item.no_index,
									no_bpjs : item.no_bpjs,
									status_bpjs : item.status_bpjs,
									jenis_peserta : item.jenis_peserta,
									status_peserta : item.status_peserta,
									tgl_lahir : item.tgl_lahir,
									gender : item.gender,
									desa : item.desa,
									tgl_register : item.tgl_register,
								};
								results.push(itemToAdd);
							});
							return response(results);
						}
					});
				},
				minLength: 3,
				select: function( event, ui ) {
					$(this).val(ui.item.nama_pasien);
					//console.log( ui.item.no_index );
					$("input[name='noindex']").val( ui.item.no_index );
					$("input[name='nobpjs']").val( ui.item.no_bpjs );						
					$("select[name='status_bpjs']").val( ui.item.status_bpjs ).change();						
					var umur = getAge(new Date(ui.item.tgl_lahir));
					$("input[name='umur']").val(umur);						
					$("select[name='gender']").val( ui.item.gender ).change();
					$("select[name='desa']").val( ui.item.desa ).change();
					
					var jenis_peserta = ui.item.jenis_peserta;
					jenis_peserta = jenis_peserta.toLowerCase().replace(/\b[a-z]/g, function(letter) {
						return letter.toUpperCase();
					});
					//alert (jenis_peserta);
					
					$("select[name='jenis_peserta']").val( jenis_peserta ).change();
					
					var status_peserta = ui.item.status_peserta;
					status_peserta = status_peserta.toLowerCase().replace(/\b[a-z]/g, function(letter) {
						return letter.toUpperCase();
					});
					$("select[name='status_peserta']").val( status_peserta ).change();
					
					var dateregister = new Date(ui.item.tgl_register);
					$("#datepicker").datepicker('setDate', dateregister);
				}
			});		
	
			//Date picker
			$('input#monthPicker').datepicker({
				changeMonth: true,
				 changeYear: true,
				 dateFormat: 'MM yy',
				   
				 onClose: function() {
					var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
					var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
					$(this).datepicker('setDate', new Date(iYear, iMonth, 1));
				 },
				   
				 beforeShow: function() {
				   if ((selDate = $(this).val()).length > 0) 
				   {
					  iYear = selDate.substring(selDate.length - 4, selDate.length);
					  iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
					  $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
					   $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
				   }
				}
			});
		});
	</script>
  
<?php $this->load->view('AdminLTE/footer'); ?>