<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			DAFTAR PASIEN
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
						<h3 class="box-title">Daftar Pasien</h3>
					</div>
					
					<div class="box-body">
						<table class="table">
                            <thead>
                                <tr>
                                    <th>NO INDEX</th>
                                    <th>NAMA PASIEN</th>
                                    <th>JENIS KUNJUNGAN</th>
                                    <th>PERAWATAN</th>
                                    <th>POLI</th>
                                    <th>KELUHAN</th>
                                    <th>TERAPI</th>
                                    <th>DIAGNOSA</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							foreach($result as $row){
                            ?>
								<tr>
                                    <td><?=$row->no_index;?></td>
                                    <td><?=$row->nama_pasien;?></td>
                                    <td><?=$row->jns_kunjungan;?></td>
                                    <td><?=$row->jenis_rawat;?></td>
                                    <td><?=$row->jenis_poli;?></td>
                                    <td><?=$row->keluhan;?></td>
                                    <td><?=$row->terapi;?></td>
                                    <td><?=$row->diagnosa;?></td>
                                </tr>
							<?php
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