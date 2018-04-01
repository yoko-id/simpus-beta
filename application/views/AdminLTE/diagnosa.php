<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			DIAGNOSA
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
						<h3 class="box-title">Tambah Diagnosa</h3>
					</div>					
					<div class="box-body">
						<?php
						if($this->session->flashdata('response')){
							echo '<div class="alert alert-success">'.$this->session->flashdata('response').'</div>';
						}
						?>
						
						<form method="POST">
							<div class="row clearfix">									
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">KODE</label>
										<input type="text" class="form-control" name="kode_diagosa" required>
									</div>
								</div>		
								<div class="col-md-10">
									<div class="form-group">											
										<label class="form-label">NAMA DIAGNOSA</label>
										<input type="text" class="form-control" name="nama_diagosa" required>
									</div>									
								</div>	
							</div>
							<button class="btn btn-primary" type="submit">SIMPAN DIAGNOSA</button>
                        </form>
					</div>
					<!-- /.box-body -->
					<div class="box-footer hide">
						
					</div>
				</div>			
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Data Stok Obat</h3>
					</div>
					
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th width="10%">KODE</th>
                                    <th>NAMA DIAGNOSA</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
							foreach($result as $row){
                                echo '<tr>
                                    <th>'.$i.'.</th>
                                    <td>'.$row->kode.'</td>
                                    <td>'.$row->keterangan.'</td>
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
  
<?php $this->load->view('AdminLTE/footer'); ?>