<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			REGISTER PETUGAS
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12 col-xs-12">				
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Register Petugas</h3>
					</div>					
					<div class="box-body">
						<?php
						//if(isset($this->session->flashdata('response'))) {
						if($this->session->flashdata('response')){
							echo '<div class="alert alert-warning">'.$this->session->flashdata('response').'</div>';
						}
						?>
						
						<form data-toggle="validator" role="form" method="POST">
							<div class="row clearfix">
								<div class="col-md-2">
									<div class="form-group">											
										<label class="form-label">NIP</label>
										<input type="text" class="form-control" name="nip_petugas">
									</div>									
								</div>								
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">NAMA PETUGAS</label>
										<input type="text" class="form-control" name="nama_petugas" required>
									</div>
								</div>											
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">JABATAN</label>
										<div class="input-group">
											<input type="text" class="form-control" name="jabatan">
										</div>
									</div>
								</div>		
								<div class="col-md-2">
									<div class="form-group">											
										<label class="form-label">UNIT KERJA</label>
										<input type="text" class="form-control" name="unit">
									</div>									
								</div>
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">ALAMAT</label>
										<input type="text" class="form-control" name="alamat_petugas">
									</div>
								</div>										
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">NO TELP</label>
										<input type="text" class="form-control" name="telp">
									</div>
								</div>	
							</div>
							
							<hr>
							<div class="row clearfix">
								<div class="col-md-3">
									<div class="form-group">											
										<label class="form-label">Username</label>
										<input type="text" class="form-control" name="username">
									</div>									
								</div>	
								<div class="col-md-3">
									<div class="form-group">											
										<label class="form-label">Password</label>
										<input type="password" class="form-control" name="password">
									</div>									
								</div>	
								<div class="col-md-3">
									<div class="form-group">											
										<label class="form-label">Ulangi Password</label>
										<input type="password" class="form-control" name="re_password">
									</div>									
								</div>	
							</div>
							<button class="btn btn-primary waves-effect" type="submit">SIMPAN PETUGAS</button>
                        </form>
					</div>
					<!-- /.box-body -->
				</div>
				
				<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-header">
							<a class="close" data-dismiss="modal">×</a>
							<h3>Contact us</h3>
						</div>
						<div class="modal-content">
							<form class="contact">
							 <fieldset>
									  <div class="modal-body">
									  <ul class="nav nav-list">
										 <li class="nav-header">Name</li>
										 <li><input class="input-xlarge" value=" krizna" type="text" name="name"></li>
										 <li class="nav-header">Email</li>
										 <li><input class="input-xlarge" value=" user@krizna.com" type="text" name="Email"></li>
										 <li class="nav-header">Message</li>
										 <li><textarea class="input-xlarge" name="sug" rows="3"> Thanks for the article and demo
										 </textarea></li>
									 </ul> 
									 </div>
							 </fieldset>
							 </form>
						</div>
						<div class="modal-footer">
							  <button class="btn btn-success" id="submit">submit</button>
							  <a href="#" class="btn" data-dismiss="modal">Close</a>
					   </div>
					</div>
				</div>
				
				<!-- model content -->
			</div>
		</div>
		<!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php $this->load->view('AdminLTE/footer'); ?>