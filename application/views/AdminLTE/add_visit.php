<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			REGISTER KUNJUNGAN
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
                                    <th>NO</th>
                                    <th>TGL. REGISTER</th>
                                    <th>NAMA PASIEN</th>
                                    <th>KELAMIN</th>
                                    <th>UMUR</th>
                                    <th>ALAMAT</th>
                                    <th>NO INDEX</th>
                                    <th>NO BPJS</th>
                                    <th>KUNJUNGAN</th>
                                    <th>KETERANGAN</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							foreach($result as $row){
                            ?>
								<tr>
                                    <td><?=$i;?></td>
                                    <td><?=$row->tgl_register;?></td>
                                    <td><?=$row->nama_pasien;?></td>
                                    <td><?=$row->gender;?></td>
                                    <td><?=get_age($row->tgl_lahir);?> Th</td>
                                    <td><?=$row->desa;?></td>
                                    <td><?=$row->no_index;?></td>
                                    <td><?=$row->no_bpjs;?></td>
                                    <td><?=$row->kunjungan;?></td>
                                    <td>#</td>
                                </tr>
							<?php
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
  
<?php $this->load->view('AdminLTE/footer'); ?>