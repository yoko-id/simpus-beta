<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			REGISTER PEGAWAI
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<?php
		//if(isset($this->session->flashdata('response'))) {
		if($this->session->flashdata('response')){
			echo '<div class="alert alert-warning">'.$this->session->flashdata('response').'</div>';
		}
		
		//var_dump ($profile);
		$id = isset($profile[0]->id) ? $profile[0]->id : '';
		$nip = isset($profile[0]->nip) ? $profile[0]->nip : '';
		$nama = isset($profile[0]->nama) ? $profile[0]->nama : '';
		$jabatan = isset($profile[0]->jabatan) ? $profile[0]->jabatan : '';
		$pangkat = isset($profile[0]->pangkat) ? $profile[0]->pangkat : '';
		$pendidikan = isset($profile[0]->pendidikan) ? $profile[0]->pendidikan : '';
		$pangkat = isset($profile[0]->pangkat) ? $profile[0]->pangkat : '';
		$phone = isset($profile[0]->phone) ? $profile[0]->phone : '';
		?>
		
		<div class="row">
			<div class="col-lg-12 col-xs-12">				
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Register Pegawai</h3>
					</div>					
					<div class="box-body">						
						<form action="<?php echo base_url()."user/addpegawai";?>" method="POST" enctype="multipart/form-data">
							<div class="row clearfix">
								<div class="col-md-2">
									<div class="form-group">											
										<label class="form-label">NIP</label>
										<input type="text" class="form-control" name="nip" value="<?=$nip;?>">
									</div>									
								</div>								
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">NAMA</label>
										<input type="text" class="form-control" name="nama" value="<?=$nama;?>" required>
									</div>
								</div>											
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">JABATAN</label>
										<input type="text" class="form-control" name="jabatan" value="<?=$jabatan;?>">
									</div>
								</div>		
								<div class="col-md-2">
									<div class="form-group">											
										<label class="form-label">PANGKAT / GOL</label>
										<input type="text" class="form-control" name="pangkat" value="<?=$pangkat;?>">
									</div>									
								</div>
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">PENDIDIKAN</label>
										<input type="text" class="form-control" name="pendidikan" value="<?=$pendidikan;?>">
									</div>
								</div>
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">NO HP</label>
										<input type="text" class="form-control" name="phone" value="<?=$phone;?>">
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="col-md-4">									
									<div class="form-group">
										<label class="form-label">UNGGAH FOTO</label>
										<input type="file" name="fileToUpload" class="form-control">
									</div>
								</div>
							</div>
							<button class="btn btn-warning waves-effect" type="submit">SIMPAN PEGAWAI</button>
							<?php if($profile) echo '<input type="hidden" name="update" value="1">'; ?> 
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
						<h3 class="box-title">DATA PEGAWAI</h3>
					</div>
					
					<div class="box-body">
						<div class="table-responsive">
						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>FOTO</th>
                                    <th>NAMA</th>
                                    <th>PENDIDIKAN</th>
                                    <th>NO HP</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
							foreach($result as $row){
                                $photo 		= '';
								$nip 		= "NIP";
								if(strlen($row->nip)<=11)
									$nip = 'NRPTT';
								if($row->photo)
									$photo = '<img src="'.base_url().'uploads/'.$row->photo.'" width="80" height="80">';
								
								echo '<tr>
                                    <td>'.$i.'.</td>
                                    <td>'.$photo.'</td>
                                    <td>
										<strong>'.$row->nama.'</strong>
										<span class="clearfix">'.$nip.'. '.$row->nip.'</span>
										<span class="clearfix">'.$row->jabatan.'</span>
										<span class="clearfix">'.$row->pangkat.'</span>
                                    </td>
									<td>'.$row->pendidikan.'</td>
                                    <td>'.$row->phone.'</td>
                                    <td>
										<div class="btn-group" role="group">
											<a href="'.base_url('user/addpegawai/'.$row->id.'').'" class="btn btn-default">Edit</a>
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
		$('table td a.delete').click(function(){
			var valData = $(this).attr('data-value');
			//console.log( id );
			if(confirm("Apa Anda ingin menghapus data ini??")){
				$.ajax({
					type: "GET",
					url: base_url + "api/pegawai/delete",
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
		
		setTimeout(function() {
			$(".alert-warning").remove();
		}, 2000);
	});
	</script>
  
<?php $this->load->view('AdminLTE/footer'); ?>