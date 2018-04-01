<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			TAMBAH LAYANAN POLI
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-12 col-xs-12">				
				<div class="box box-info">					
					<div class="box-body">
						<?php
						if($this->session->flashdata('response')){
							echo '<div class="alert alert-success">'.$this->session->flashdata('response').'</div>';
						}
						
						$poli_kode		= isset($poli[0]->id) ? $poli[0]->id : '';
						$poli_status 	= isset($poli[0]->status) ? $poli[0]->status : '';
						$poli_nama 		= isset($poli[0]->nama) ? $poli[0]->nama : '';
						?>
						
						<form action="<?php echo base_url()."poli/addpoli";?>" method="POST">
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-label">NAMA POLI</label>
											<input type="text" class="form-control" name="nama" value="<?=$poli_nama;?>" required>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="form-label">STATUS</label>
											<select name="status" class="form-control">
												<option value="1" <?php if($poli_status==1) echo 'selected';?>>AKTIF</option>
												<option value="0" <?php if($poli_status==0) echo 'selected';?>>TIDAK AKTIF</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div style="padding-top:25px">
											<button class="btn btn-primary btn-block waves-effect" type="submit">SIMPAN</button>
											<?php if($poli) {
												echo '<input type="hidden" name="update" value="1">'; 
												echo '<input type="hidden" name="id" value="'.$poli_kode.'">'; 
											} ?>
										</div>
									</div>
								</div>
                        </form>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<!-- /.row -->
		
				
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">LAYANAN POLI</h3>
					</div>
					
					<div class="box-body">
						<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>NAMA POLI</th>
                                    <th>STATUS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
							foreach($result as $row){
                                echo '<tr>
                                    <td>'.$i.'.</td>
                                    <td>'.$row->nama.'</td>
                                    <td>'.$row->status.'</td>
                                    <td>
										<div class="btn-group" role="group">
											<a href="'.base_url('poli/addpoli/'.$row->id.'').'" class="btn btn-default">Edit</a>
											<a href="#" class="btn btn-danger delete" data-value="'.$row->id.'">Delete</a>
										</div>
									</td>
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
  
	<script>
	$(function () {	
		$('#example2').dataTable({
			paging: false
		});
		
		$('table td a.delete').click(function(){
			var valData = $(this).attr('data-value');
			//console.log( id );
			if(confirm("Apa Anda ingin menghapus data ini??")){
				$.ajax({
					type: "GET",
					url: base_url + "api/poli/delete",
					data: {id:valData},
					success: function(data){
						
					}
				});
				$(this).parent().parent().parent().css("background-color","#FF3700");
				$(this).fadeOut(400, function(){
					$(this).parent().parent().parent().remove();
				});
			}			
			return false;
		});
		
		window.setTimeout(function() {
			$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
				$(this).remove(); 
			});
		}, 2000);
	});
	</script>
	
<?php $this->load->view('AdminLTE/footer'); ?>