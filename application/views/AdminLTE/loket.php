<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			SETTING LOKET ANTRIAN
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->		
		<div class="row">
			<?php
			foreach($result as $row){
			?>
			<div class="col-md-4">
				<div class="panel text-center">
					<h1>LOKET <?=$row->loket_id;?></h1>
					<h4> <?=$row->loket_nama;?></h4>					
				</div>
			</div>
			<?php } ?>
		</div>
		<!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php $this->load->view('AdminLTE/footer'); ?>