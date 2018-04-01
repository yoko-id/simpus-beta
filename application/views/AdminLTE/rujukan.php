<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			RUJUKAN
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
		?>
		
		<div id="MyDiv" class="row">
			<div class="col-lg-12 col-xs-12">				
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Tambah Daftar Rujukan</h3>
					</div>					
					<div class="box-body">						
						<form class="form-inline" role="search" method="POST">
							<div class="form-group">
								<label class="sr-only">Nama Rujukan</label>
								<input type="text" class="form-control" name="rujukan" placeholder="Nama Rujukan ...">
							</div>
							<div class="form-group">
								<label class="sr-only">Alamat</label>
								<input type="text" class="form-control" name="alamat" placeholder="Alamat ...">
							</div>
							<div class="form-group">
								<label class="sr-only">Telp.</label>
								<input type="text" class="form-control" name="telp" placeholder="Telp ...">
							</div>
							<input type="hidden" name="id">
							<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-plus"></span></button>
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
						<h3 class="box-title">DAFTAR RUJUKAN</h3>
					</div>
					
					<div class="box-body">
						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="2%">ID</th>
                                    <th>NAMA RUJUKAN</th>
                                    <th>ALAMAT</th>
                                    <th>TELP.</th>
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
                                    <td><p class="lead">'.$row->rujukan.'</p></td>
                                    <td><p class="">'.$row->alamat.'</p></td>
                                    <td><p class="lead">'.$row->telp.'</p></td>
                                    <td>
										<div class="btn-group" role="group">
										  <button type="button" class="btn btn-default edit" data-value="'.$row->id.'"><i class="glyphicon glyphicon-pencil"></i></button>
										  <button type="button" class="btn btn-danger delete" data-value="'.$row->id.'"><i class="glyphicon glyphicon-remove"></i></button>
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
		$(".edit").on('click',function(e){
			e.preventDefault();
			
			var id = $(this).attr("data-value");
			$.getJSON( base_url + "api/rujukan", { id: id }, function(data, status){
				if(status=="success"){
					console.log( data );
					$("input[name='rujukan']").val( data[0].rujukan );
					$("input[name='alamat']").val( data[0].alamat );
					$("input[name='telp']").val( data[0].telp );
					$("input[name='id']").val( data[0].id );
					$("form>button.btn").html( '<i class="glyphicon glyphicon-floppy-saved"></i> Update' );
					
					$('html, body').animate({
						scrollTop: $("#MyDiv").offset().top
					}, 500);
				};
			});
		});
		$(".delete").on('click',function(e){
			e.preventDefault();
			
			var id = $(this).attr("data-value");
			console.log( id );
			//$(location).attr('href', base_url + 'diagnosa/histori/' + no_index);
		});
	});
	</script>
  
<?php $this->load->view('AdminLTE/footer'); ?>