<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			POLI GIZI
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
						<h3 class="box-title">Data Petugas</h3>
					</div>
					
					<div class="box-body">
						<table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAMA PETUGAS</th>
                                    <th>ALAMAT</th>
                                    <th>TELP</th>
                                    <th>JAM JAGA</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if($result): foreach($result as $row){
                                echo '<tr>
                                    <th scope="row">'.$i.'.</th>
                                    <td>'.$row->nama_petugas.'</td>
                                    <td>'.$row->alamat_petugas.'</td>
                                    <td>'.$row->telp.'</td>
                                    <td>'.$row->jam_jaga.'</td>
                                </tr>';
								$i++;
							} endif;
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