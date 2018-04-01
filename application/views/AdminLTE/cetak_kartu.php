<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CETAK KARTU</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Custom styles for this template -->
    <style>
		<!--
			body { font-size: 12px; height:16em; }
			.container { padding-top: 10px; left: 0px; }
			.panel { width: 88mm !important; height: 55mm !important; }
			.panel h4 { font-size: 12px; }
			.panel table td { font-size: 11px; }
			.row-no-padding > [class*="col-"] {
				padding-left: 0 !important;
				padding-right: 0 !important;
			}
		//-->
	</style>
	
    <script src="<?php echo base_url();?>assets/plugins/jQuery/query.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

	<div class="container">
		<?php
		if($this->session->flashdata('response') || $result==null){
			echo '<div class="alert alert-warning">'.$this->session->flashdata('response').'</div>';
		}else{
		?>
			
			<div class="row row-no-padding">
				<?php
				$total = count($result);
				$colom = $total/3;
				?>
				
				<?php foreach($result as $kartu){ ?>
				<div class="col-xs-5 clearfix">
				<div class="panel panel-default">
					<div class="panel-body">
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td width="30%" valign="top"><img src="<?php echo base_url();?>assets/logo_dinkes.png"></td>
								<td valign="top">
									<h4>PUSKESMAS ANDOOLO UTAMA <small style="display:block">Jl. Poros Pasar DU, Ds. Andoolo Utama, Kec. Buke, Kab. Konawe Selatan</small></h4>
									<table>
										<tr>
											<td>NAMA&nbsp;</td>
											<td>:</td>
											<td>&nbsp;<?=$kartu->nama_pasien;?></td>
										</tr>
										<tr>
											<td>ALAMAT&nbsp;</td>
											<td>:</td>
											<td>&nbsp;<?=$kartu->desa;?></td>
										</tr>
										<tr>
											<td>ID PASIEN&nbsp;</td>
											<td>:</td>
											<td>&nbsp;<?=$kartu->no_index;?></td>
										</tr>
										<tr>
											<td colspan="3" align="left">
												<img src="<?php echo base_url();?>api/kartu/view?nokartu=<?=$kartu->no_index;?>">
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<p class="text-center">Harap Bawa Ini Ketika Berobat ke Puskesmas</p>
					</div>
				</div>
				</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div><!-- /.row -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script>
	requestFullScreen();
	function requestFullScreen() {
	  var el = document.body;

	  // Supports most browsers and their versions.
	  var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen 
	  || el.mozRequestFullScreen || el.msRequestFullScreen;

	  if (requestMethod) {

		// Native full screen.
		requestMethod.call(el);

	  } else if (typeof window.ActiveXObject !== "undefined") {

		// Older IE.
		var wscript = new ActiveXObject("WScript.Shell");

		if (wscript !== null) {
		  wscript.SendKeys("{F11}");
		}
	  }
	}
	</script>
</body>
</html>