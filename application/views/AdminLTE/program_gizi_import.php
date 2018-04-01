<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->		
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Aplikasi Laporan Gizi</h3>
						<div class="pull-right">
							
						</div>
					</div>
					
					<div class="box-body">
						<?php
						if($msg){ echo '<div class="alert alert-warning">'.$msg['msg'].'</div>'; }
						?>
						<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
						<form method="post" enctype="multipart/form-data">
							<div class="row clearfix">							
								<div class="col-md-6">									
									<div class="form-group">
										<label class="form-label">PENCATAN STATUS GIZI BALITA DI POSYANDU </label>
										<input type="file" name="fileToUpload" class="form-control">
									</div>
								</div>							
								<div class="col-md-6">									
									<div class="well">
										
									</div>
								</div>	
							</div>
							<button class="btn btn-warning waves-effect" type="submit">SIMPAN BAYI/BALITA</button>
							<input type="hidden" name="desa_id" value="<?php echo $_GET['desa'];?>">
							<input type="hidden" name="action" value="import">
						</form>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<!-- /.row -->
		
		<div class="row clearfix">
			<?php if($result){ ?>
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
					</div>
						
					<div class="box-body">
						<?php
						$json = json_decode($result, true);
						?>
						<table class="table table">
							<thead>
								<th>NO</th>
								<th>NAMA BAYI/BALITA</th>
								<th>NAMA ORANG TUA</th>
								<th>KELAMIN</th>
								<th>TGL. LAHIR</th>
								<th>BB LAHIR</th>
								<th>BB KINI</th>
								<th>DESA</th>
							</thead>
							<tbody>
							<?php
							$i=1;
							foreach($json as $k => $v){
								if($v['E']){
									// m-d-y => Y-m-d
									$curDate = explode("-",str_replace("/","-",$v['E']));
									$tgl = $curDate[1];
									$bln = $curDate[0];		
									if(!is_numeric($tgl)){
										$bln = date("m", strtotime($tgl));
										$tgl = $curDate[0];
									}
									$thn = $curDate[2];
									if(strlen($thn)==2) $thn = "20".$thn;
									
									$newdate = $thn.'-'.$bln.'-'.$tgl;
									echo '<tr>
									<td>'.($i).'.</td>
									<td>'.$v['B'].'</td>
									<td>'.$v['C'].'</td>
									<td>'.$v['D'].'</td>
									<td><!--'.$v['E'].'-->'.$newdate.'</td>
									<td>'.$v['F'].'</td>
									<td>'.$v['H'].'</td>
									<td>'.$v['G'].'</td>
									</tr>';
								}
								$i++;
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php }	?>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<script>
	$(document).ready(function(){
		//Date picker
		$('#datepicker').datepicker({
			autoclose: true,
			dateFormat: 'yyyy-mm-dd'
		});
	});
	</script>
	  
	  
  
<?php $this->load->view('AdminLTE/footer'); ?>