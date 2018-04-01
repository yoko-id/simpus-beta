<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <style>
	<!--
		.panel-body { padding: 10px; }
		.box-body table { font-size: 16px; font-weight: bold; }
		.box-body table th, td { text-align: center; }
		.date-part { padding-top:30px; }
		.time-part { font-size: 24px; }
		.list-group .panel { margin-bottom: 10px !important; }
	//-->
	</style>
  
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
</head>
<body>
<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" style="margin-left:0px;">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="row">
				<div class="col-lg-8">
					<div class="row">
						<div class="col-lg-2">
							<img src="<?php echo base_url();?>assets/logo_dinkes.png" height="90">
						</div>
						<div class="col-lg-8">
							<h4>PUSKESMAS ANDOOLO UTAMA</h4>
							<p>Jl. Poros Andoolo Utama, Kec. Buke, Kab. Konawe Selatan</p>
							<strong>MELAYANI DENGAN HATI</strong>
						</div>
						<div class="col-lg-2">
							<img src="<?php echo base_url();?>assets/logo_kab_konsel.png" height="90">
						</div>
					</div>
				</div>
				<div class="col-lg-4 text-left">
					<div class="date-part"><?=date("d F Y");?></div>
					<div class="time-part"><?=date("H:m:s");?></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-9 col-xs-12">
					<div class="box box-info">						
						<div class="box-body">
							<div class="table-responsive">
								<style>
								<!--
									table tbody { height:230px; overflow:auto; display:block; }
									table thead tr, table tbody tr {
										display:table;
										width:100%;
										table-layout:fixed;/* even columns width , fix width of table too*/
									}
								//-->
								</style>
								
								<table class="table table-bordered">
									<thead>
										<tr>
											<th width="15%">ANTRIAN</th>
											<!--<th>ID PASIEN</th>-->
											<th>NAMA PASIEN</th>
											<th>TUJUAN</th>
											<th>JAM MASUK</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$b=1;
									foreach($result as $row){
										echo "<tr>
											<td align='center'>".$row->no_antrian."</td>
											<!--<td>".($row->no_index)."</td>-->
											<td>".$row->nama_pasien."</td>
											<td>".$row->poli_tujuan."</td>
											<td><!--".date("H:i",strtotime($row->date_kunjungan))."--></td>
										</tr>";
										$b++;
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- /.box-body -->
					</div>				
				</div>
				
				<div class="col-lg-3 col-xs-12">
					<div class="row">
						<?php
						foreach($loket as $row){
						?>
						<div class="col-md-12">
							<div class="panel text-center">
								<h1>LOKET <?=$row->loket_id;?></h1>
								<h4> <?=$row->loket_nama;?></h4>					
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
		
	</div>
	<!-- /.content-wrapper -->
  
</div>
<!-- ./wrapper -->
  
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/jsclock-0.8.min.js"></script>
<script>
var base_url = '<?php echo base_url();?>';
var audio = new Audio('<?php echo base_url();?>assets/sound/dingdong.wav');
function play_sound() {
	//if(audio.paused){
		audio.play();
	//}
	//audio.pause();
}
	
document.body.style.zoom="130%";
$(document).ready(function() {
    /*setInterval(function() {
		var date = new Date();
		var Minutes = ( date.getMinutes() < 10 ? "0" : "" ) + date.getMinutes();;
		$('.time-part').html(
			date.getHours() + ":" + Minutes + ":" + date.getSeconds()
		);
	}, 500);*/
	
	$('.time-part').jsclock();
	
	setInterval(function(){
		$.get( base_url + "/api/antrian" , function(data, status){
			$("table.table > tbody").html( data );
		});
		//play_sound();
	}, 5000);
});
</script>

</body>
</html>