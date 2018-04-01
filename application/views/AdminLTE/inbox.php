<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			DATA PETUGAS
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
						<h3 class="box-title">Data Petugas</h3>
					</div>
					
					<div class="box-body">
						<div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
									<thead>
										<tr>
											<th width='1%'><div align="center">#</div></th>
											<th width='20%' align='left'>Nomor Tujuan</th>
											<th width='40%' align='left'>Isi Pesan</th>
											<th width='10%' align='left'>Waktu Terima</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$b=1;
									foreach($result as $row){
										$alt = '';
										//if ($row->SenderNumber=='TELKOMSEL') $alt = 'class="alert alert-info"';
										echo "<tr $alt>
											<td><div align=\"center\">".$b.".</div></td>
											<td>".($row->SenderNumber)."</td>
											<td>".$row->TextDecoded."</td>
											<td>".date("d/m/Y H:m",strtotime($row->ReceivingDateTime))."</td>
										</tr>
										";
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
		</div>
		<!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php $this->load->view('AdminLTE/footer'); ?>