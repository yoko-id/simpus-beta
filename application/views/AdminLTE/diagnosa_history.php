<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			DIAGNOSA HISTORY
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
						<h3 class="box-title">HISTORY DIAGNOSA</h3>
						<div class="pull-right">
							<div class="form-inline">
								<label class="form-label">NOMOR INDEX</label>
								<input type="text" class="form-control" name="no_index" id="no_index2" required>
							</div>
						</div>
					</div>
					
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>TGL</th>
                                    <th>NAMA</th>
                                    <th>UMUR</th>
                                    <th>JK</th>
                                    <th>KELUHAN</th>
                                    <th>THERAPY</th>
                                    <th>KASUS</th>
                                    <th>HISTORY</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
							foreach($result as $row){
                                echo '<tr>
                                    <td>'.$i.'.</td>
                                    <td>'.tgl_indo(date("D, d-m-Y", strtotime($row->tgl_register))).'</td>
                                    <td>'.$row->nama_pasien.'</td>
                                    <td>'.get_age($row->tgl_lahir).' Th</td>
                                    <td>'.$row->gender.'</td>
                                    <td>'.$row->keluhan.'</td>
                                    <td>'.$row->terapi.'</td>
                                    <td>'.$row->kasus.'</td>
                                    <td><a target="_blank" class="btn btn-default" href="'.base_url("diagnosa/histori/".$row->no_index).'"><i class="glyphicon glyphicon-eye-open"></i> History</a></td>
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
		//		
		//var table = $('#example2').DataTable();		
		$("#no_index2").change(function(){
				var n = parseInt($(this).val());
				$(this).val( sixpad(n) );
				
				$.get( base_url + "api/rekam_medis", { no_index: $(this).val() }, function(data, status){
					console.log(data);
					if(status=="success"){
						$('table#example2 tbody').html(data);
					}
				});
			});
	});
	</script>
  
<?php $this->load->view('AdminLTE/footer'); ?>