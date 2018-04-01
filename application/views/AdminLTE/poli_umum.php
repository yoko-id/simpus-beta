<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			POLI UMUM
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-12 col-xs-12">				
				<div class="box box-info">					
					<div id="collapseExample" class="box-body">
						<?php
						if($this->session->flashdata('response')){
							echo '<div class="alert alert-success">'.$this->session->flashdata('response').'</div>';
						}
						?>
						
						<form id="poliUmumForm" method="POST">
							<div class="row clearfix">
								<div class="col-sm-2">
									<div class="form-group">
										<label class="form-label">NOMOR KARTU</label>
										<input type="text" class="form-control" name="no_index" id="no_index" required>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label class="form-label">NAMA PASIEN</label>
										<input type="text" class="form-control" name="nama_pasien">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label class="form-label">JENIS KELAMIN</label>
										<div class="form-inline">
											<input type="radio" name="gender" id="male" value="l" class="flat-red"> Laki-laki
											<input type="radio" name="gender" id="female" value="p" class="flat-red"> Perempuan
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label class="form-label">UMUR</label>
										<div class="input-group">
											<input type="text" class="form-control" name="umur">
											<span class="input-group-addon">TH</span>
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label class="form-label">NO BPJS</label>
										<input type="text" class="form-control" name="no_bpjs">
									</div>
								</div>
							</div>
							
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="form-label">ALAMAT</label>
										<input type="text" class="form-control" name="desa">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label class="form-label">PEKERJAAN</label>
										<input type="text" class="form-control" name="pekerjaan">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label class="form-label">KEPALA KELUARGA</label>
										<input type="text" class="form-control" name="kk">
									</div>
								</div>
							</div>
							
							<div class="row clearfix">
								<div class="col-md-8">
									<div class="row clearfix">
										<div class="col-md-4 form-control-label">
											<label>KELUHAN</label>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<textarea name="keluhan" class="form-control" rows="3" required></textarea>
											</div>
										</div>
									</div>
									<div class="row hide clearfix">
										<div class="col-md-4 form-control-label">
											<label>TERAPI</label>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<textarea name="terapi" class="form-control"></textarea>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-md-4 form-control-label">
											<label>DIAGNOSA</label>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<select id="diagnosa" class="diagnosa form-control" name="diagnosa[]"></select>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-md-4 form-control-label">
											<label>PENGOBATAN</label>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<select id="pengobatan" name="pengobatan[]" class="form-control pengobatan"></select>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-md-4 form-control-label">
											<label>RUJUKAN</label>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<!--<textarea name="rujukan" class="form-control rujukan"></textarea>-->
												<select class="rujukan form-control" name="rujukan[]"></select>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-md-4 form-control-label">
											<label>KASUS</label>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<select name="kasus" class="form-control">
													<option value="BARU">BARU</option>
													<option value="LAMA">LAMA</option>
												</select>
											</div>
										</div>
									</div>
								</div>								
							
								<div class="col-md-4">
									<div class="page-header hide">
										<h4>PEMERIKSAAN FISIK</h4>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-label">Tinggi Badan</label>
											<div class="input-group">
												<input type="text" class="form-control" name="tb">
												<span class="input-group-addon">Cm</span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-label">Berat Badan</label>
											<div class="input-group">
												<input type="text" class="form-control" name="bb">
												<span class="input-group-addon">Kg</span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-label">Sistole</label>
											<div class="input-group">
												<input type="text" class="form-control" name="sistole">
												<span class="input-group-addon">mmHg</span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-label">Diastole</label>
											<div class="input-group">
												<input type="text" class="form-control" name="diastole">
												<span class="input-group-addon">mmHg</span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-label">Pernafasan</label>
											<div class="input-group">
												<input type="text" class="form-control" name="respiratory">
												<span class="input-group-addon">/ minute</span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-label">Denyut Nadi</label>
											<div class="input-group">
												<input type="text" class="form-control" name="heart">
												<span class="input-group-addon">bpm</span>
											</div>
										</div>
									</div>
								</div>
							</div>
								
							<hr>
							<input type="hidden" name="tgl_register" value="">
							<button class="btn btn-primary" type="submit">SIMPAN</button>
							<button class="btn btn-primary reset" type="reset">BATAL</button>
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
						<h3 class="box-title">BUKU KONTROL</h3>
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
						
						<table id="" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="10%">TGL</th>
                                    <th>NAMA</th>
                                    <th>KELUHAN</th>
                                    <th>PENGOBATAN</th>
                                    <th width="20%">HISTORY</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
							foreach($result as $row){
                                //if($row->antrian==0) $status=$row->poli_tujuan; else $status="PULANG";
								//$row->keluhan = isset($row->keluhan) ? $row->keluhan : '-';
								
								$histori_url = base_url("diagnosa/histori/".$row->no_index);
								
								echo '<tr>
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
                                    <td>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-default" data-toggle="collapse" href="#collapseExample"><i class="glyphicon glyphicon-pencil"></i></button>
											<a target="_blank" class="btn btn-default" href="'.$histori_url.'"><i class="glyphicon glyphicon-eye-open"></i></a>';?>
										
											<button class="btn btn-default" id="play" onclick="mulai(<?=(int)getAntrian($row->no_index);?>, '1');"><i class="glyphicon glyphicon-volume-up"></i> <?=getAntrian($row->no_index);?></button>
										
									<?php
									echo '</div>
									</td>
                                </tr>';
								$i++;
							}
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
	function getAge(dateString){
		var today = new Date();
		var birthDate = new Date(dateString);
		var age = today.getFullYear() - birthDate.getFullYear();
		var m = today.getMonth() - birthDate.getMonth();
		if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
		{
			age--;
		}
		return age;
	}

	$(function () {		
		$(".diagnosa").select2({
			placeholder: 'Pilih Diagnosa',
			multiple: true,
			ajax: {
				url: base_url + 'api/diagnosa',
				dataType: 'json',
				delay: 250,
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});
		
		$(".pengobatan").select2({
			placeholder: 'Pilih Pengobatan',
			multiple: true,
			escapeMarkup : function(text){
				text = text.split("~");
				return '<span>'+text[0]+'</span><span class="pull-right">Stok: '+text[1]+'</span>';
			},
			ajax: {
				url: base_url + 'api/pengobatan',
				dataType: 'json',
				delay: 250,
				processResults: function (data) {
					console.log(data);
					return {
						results: data
					};
				},
				cache: true
			}
		});
		
		$(".rujukan").select2({
			placeholder: 'Pilih Rujukan',
			multiple: false,
			ajax: {
				url: base_url + 'api/getrujukan',
				dataType: 'json',
				delay: 250,
				processResults: function (data) {
					console.log(data);
					return {
						results: data
					};
				},
				cache: true
			}
		});
		
		$("input[name='no_index']").change(function(){
			var n = parseInt($(this).val());
			$(this).val( sixpad(n) );
			
			//alert("The text has been changed.");				
			$.getJSON( base_url + "api/diagnosa/histori", { no_index: $(this).val() }, function(data, status){
				console.log(data);
				if(status=="success"){
					$("input[name='nama_pasien']").val( data[0].nama_pasien );
					$("input[name='no_bpjs']").val( data[0].no_bpjs );						
					var umur = getAge(new Date(data[0].tgl_lahir));
					$("input[name='umur']").val(umur);						
					$("select[name='gender']").val( data[0].gender );
					$("input[name='desa']").val( data[0].desa );
					
					$("textarea[name='keluhan']").val( data[0].keluhan );
					$("input[name='tgl_register']").val( data[0].tgl_register );
					
					var diagnosa_id = data[0].diagnosa;
					var arrayDiagnosa = diagnosa_id.split(',');
					//$("#diagnosa").select2('val',arrayDiagnosa);
					$("#diagnosa").select2({multiple:true}).select2("data", [{ id:diagnosa_id }]);
					console.log ( diagnosa_id );
					
					/*var jenis_peserta = data[0].jenis_peserta;
					jenis_peserta = jenis_peserta.toLowerCase().replace(/\b[a-z]/g, function(letter) {
						return letter.toUpperCase();
					});					
					$("select[name='jenis_peserta']").val( jenis_peserta ).change();
					
					var status_peserta = data[0].status_peserta;
					status_peserta = status_peserta.toLowerCase().replace(/\b[a-z]/g, function(letter) {
						return letter.toUpperCase();
					});
					$("select[name='status_peserta']").val( status_peserta ).change();*/
				}
			});
		});
		
		$(".viewHistory").click(function(){
			//var no_index = $(this).attr("data-value");				
			//$(location).attr('href', base_url + 'diagnosa/histori/' + no_index);
		});
		
		$('button.reset').click(function(){
			$('#poliUmumForm')[0].reset();
		});
		
		$("#cariData").click(function(){
			var valData = $("form.form-inline").serialize();
			$.ajax({
				type: "GET",
				url: base_url + "api/cariDataPoliUmum/",
				data: valData,
				success: function(data){
					$('table.table >tbody').html(data);
				}
			});
			return false;
		});
	});
	</script>
  
<?php $this->load->view('AdminLTE/footer'); ?>