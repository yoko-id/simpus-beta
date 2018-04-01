<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			MANAJEMEN USER
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">User Login</h3>
					</div>
					
					<div class="box-body">
						<form method="post">
							<div class="col-md-6">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" value="<?=$result[0]->username;?>">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Petugas</label>
									<select name="petugas" class="form-control">
										<option value=""></option>
										<?php foreach($pegawai as $staff){
											echo '<option value="'.$staff->id.'"';
											if($staff->id==$result[0]->petugas) echo 'selected';
											echo '>'.$staff->nama.' -- <span class="pull-right">'.$staff->jabatan.'</span></option>';
										} ?>
									</select>
								</div>
								<div class="form-group">
									<label>Level</label>
									<select name="level" class="form-control">
										<option value="Administrator" <?php if($result[0]->level=='Administrator') echo 'selected';?>>Administrator</option>
										<option value="Operator" <?php if($result[0]->level=='Operator') echo 'selected';?>>Operator</option>
										<option value="Staff" <?php if($result[0]->level=='Staff') echo 'selected';?>>Staff</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="btn btn-warning">Simpan</button>
								<input type="hidden" name="id" value="<?=$result[0]->id;?>">
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
	$(document).ready(function() {
		$("button.btn-delete").click(function() {
			var id = $(this).attr("id");			
			if(confirm("Yakin?")){
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('user/delete'); ?>/" + id,
					data: {id:id},
					success: function(data){
						$('#front').html(data);
					}
				});
				$(this).parents("tr").animate({ backgroundColor: "#fbc7c7" }, "fast")
				.animate({ opacity: "hide" }, "slow");

			}
			return false;
		});
	});
	</script>
  
  
<?php $this->load->view('AdminLTE/footer'); ?>