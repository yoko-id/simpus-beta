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
						<h3>DATA DESA/KELURAHAN</h3>
						
						<?php $bln = listBulan(); $years = listTahun();	?>
						<form method="get" action="<?php echo base_url();?>poli/program_gizi/input/">
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group"><select name="desa" class="form-control">
									<?php foreach($list_desa as $list_desa){ ?>
									<option value="<?=$list_desa->id;?>"><?=$list_desa->nama_desa;?></option>
									<?php } ?>
								</select></div>
							</div>
							<div class="col-xs-4">
								<div class="form-group"><select name="bln" class="form-control">
									<?php foreach($bln as $key => $bl){
									echo '<option value="'.$key.'">'.$bl.'</option>';
									} ?>
								</select></div>
							</div>
							<div class="col-xs-4">
								<div class="form-group"><select name="thn" class="form-control">
									<?php foreach($years as $th){
									echo '<option value="'.$th.'">'.$th.'</option>';
									} ?>
								</select></div>
							</div>
						</div>
						
						<div class="row clearfix">
							<div class="col-xs-12">
								<p><button type="submit" class="btn btn-lg btn-primary">Master Laporan</button></p>
							</div>
						</div>
						</form>
						
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
  
	<script>
	$(document).ready(function(){
		
	});
	</script>
	  
	  
  
<?php $this->load->view('AdminLTE/footer'); ?>