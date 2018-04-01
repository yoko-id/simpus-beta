<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			LAPORAN DATA STOK OBAT
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
						<h3 class="box-title">Data Obat Expired</h3>
					</div>
					
					<div class="box-body">
						<table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAMA OBAT</th>
                                    <th>KODE</th>
                                    <th>PRODUSEN</th>
                                    <th>MASUK</th>
                                    <th>EXPIRED</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
							foreach($result as $row){
                                echo '<tr>
                                    <th scope="row">'.$i.'.</th>
                                    <td>'.$row->nama_obat.'</td>
                                    <td>'.$row->kode_obat.'</td>
                                    <td>'.$row->produsen.'</td>
                                    <td>'.$row->tgl_masuk.'</td>
                                    <td>'.$row->expired.' ( '.count_days($row->expired).' hari )</td>
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
  
<?php $this->load->view('AdminLTE/footer'); ?>