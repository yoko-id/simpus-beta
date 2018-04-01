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
					<div class="well">
						<form class="form-inline" action="<?php echo base_url('api/demo');?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<input type="file" name="file" class="form-control">
								<input type="submit" value="Upload file" class="btn btn-default">
							</div>
						</form>
					</div>					
					
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nama Obat</th>
								<th>Satuan</th>
								<th>Awal</th>
								<th>Baru</th>
								<th>Keluar</th>
								<th>Harga</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if($data){
							//var_dump ($data);
							$i=0;
							foreach($data as $ndata){
								if($i>10 && $i<=207) {
									echo '<tr>
										<td>'.$ndata['nama_obat'].'</td>
										<td>'.$ndata['satuan'].'</td>
										<td>'.$ndata['stok_awal'].'</td>
										<td>'.$ndata['stok_tambah'].'</td>
										<td>'.$ndata['stok_keluar'].'</td>
										<td>'.$ndata['harga'].'</td>
									</tr>';
								}
								$i++;
							};
						}
						?>
						</tbody>
					</table>
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
		
		$("input[name='no_index']").change(function(){
			var n = parseInt($(this).val());
			$(this).val( sixpad(n) );
			
			//alert("The text has been changed.");				
			$.getJSON( base_url + "api/kartu", { no_index: $(this).val() }, function(data, status){
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
	});
	</script>
  
<?php $this->load->view('AdminLTE/footer'); ?>