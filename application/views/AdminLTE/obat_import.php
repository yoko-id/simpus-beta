<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			LAPORAN DATA STOK OBAT
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->		
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Data Obat Expired</h3>
					</div>
					
					<div class="box-body">
						<div class="well">
							<?php echo form_open_multipart('obat/obat_import');?>

							<input type="file" id="file_upload" name="userfile" size="20" />
							<br />

							<input type="submit" value="Upload" />

							<?php echo form_close();?>
						</div>
						
						<table class="table">
							<tr>
								<th>Nama Obat</th>
								<th>Satuan</th>
								<th>Stok Awal</th>
								<th>Penerimaan</th>
								<th>Persediaan</th>
								<th>Pemakaian</th>
								<th>Sisa Stok</th>
								<th>Harga Satuan</th>
							</tr>
						<?php
						if(isset($result)){
							$i=0;
							foreach($result as $key => $val){
								$obat = explode(";",trim($val));
								if($key>=12 && $key<=207 && $obat){
									echo "<tr>
										<td>".$obat[1]."</td>
										<td>".$obat[2]."</td>
										<td>".$obat[3]."</td>
										<td>".$obat[4]."</td>
										<td>".$obat[5]."</td>
										<td>".$obat[6]."</td>
										<td>".$obat[7]."</td>
									</tr>";
								}
								$i++;
							}
						}
						?>
						
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
  
<?php $this->load->view('AdminLTE/footer'); ?>