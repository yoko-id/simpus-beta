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
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">User Login</h3>
					</div>
					
					<div class="box-body">
						<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Petugas</th>
                                    <th>Level</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							foreach($result as $row){
                                echo '<tr>
                                    <td>'.$i.'.</td>
                                    <td>'.$row->username.'</td>
                                    <td>************</td>
                                    <td>'.$row->nama.'</td>
                                    <td>'.$row->level.'</td>
                                    <td>
										<div class="btn-group" role="group">
											<a href="'.base_url().'/user/edit/'.$row->id.'" class="btn btn-info btn-edit" id="'.$row->id.'"><i class="glyphicon glyphicon-edit"></i></a>
											<button type="button" class="btn btn-danger btn-delete" id="'.$row->id.'"><i class="glyphicon glyphicon-trash"></i></button>
										</div>
									</td>
                                </tr>';
								$i++;
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