<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header text-center">
		<h1>
			DIAGNOSA PASIEN HISTORY
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
						<table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0">
							<tr>
								<td width="15%">Nama Pasien </td>
								<td width="35%">: <?=$pasien->nama_pasien;?> </td>
								<td width="15%">Jenis Lelamin </td>
								<td width="35%">: <?=$pasien->gender;?></td>
							</tr>
							<tr>
								<td>Kepala Keluarga </td>
								<td>: - </td>
								<td>Umur</td>
								<td>: <?=get_age($pasien->tgl_lahir);?> Tahun / -- Bulan </td>
							</tr>
							<tr>
								<td>Pekerjaan</td>
								<td>: - </td>
								<td>No Kartu BPJS </td>
								<td>: <?=$pasien->no_bpjs;?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td colspan="3">: <?=$pasien->desa;?></td>
							</tr>
						</table>
						
						<br>
						<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="15%">Tanggal</th>
                                    <th width="40%">Pemeriksaan</th>
                                    <th width="45%">Pengobatan</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
								foreach($result as $row){
									echo '<tr>
										<td>'.tgl_indo(date("D, d-m-Y", strtotime($row->tgl_register))).'</td>
										<td>'.$row->keluhan.'</td>
										<td>'.getObat($row->obat).'</td>
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