<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Statistik Pasien Hari <?php echo tgl_indo(date("D, d F Y"));?>
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-aqua">
				<div class="inner">
				  <h3><?=$stat['stat_pasienToday'];?></h3>

				  <p>Pasien Hari Ini</p>
				</div>
				<div class="icon">
				  <i class="ion ion-bag"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-green">
				<div class="inner">
				  <h3><?=$stat['stat_pasienTotal'];?></h3>

				  <p>Total Pasien</p>
				</div>
				<div class="icon">
				  <i class="ion ion-stats-bars"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <h3><?=$stat['stat_pasienMale'];?></h3>

				  <p>Pasien Pria</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-add"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-red">
				<div class="inner">
				  <h3><?=$stat['stat_pasienFemale'];?></h3>

				  <p>Pasien Wanita</p>
				</div>
				<div class="icon">
				  <i class="ion ion-pie-graph"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<!-- ./col -->
		</div>
		<!-- /.row -->
		
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Daftar Pasien</h3>
						<div class="pull-right">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default" id="cetakpdf">PDF</button>
								<button type="button" class="btn btn-default" id="cetakcsv">Excel</button>
							</div>
						</div>
					</div>
					
					<div class="box-body">
						<table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%">NO INDEX</th>
                                    <th>NAMA PASIEN</th>
                                    <th width="5%">UMUR</th>
                                    <th width="5%">KELAMIN</th>
                                    <th>ALAMAT</th>
                                    <th>NO BPJS</th>
                                    <th width="15%">CETAK KARTU</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							foreach($result as $row){
                            ?>
								<tr>
                                    <td><?=$row->no_index;?></td>
                                    <td><?=$row->nama_pasien;?></td>
                                    <td><?=get_age($row->tgl_lahir);?> Th</td>
                                    <td><?=$row->gender;?></td>
                                    <td><?=$row->desa;?></td>
                                    <td><?=$row->no_bpjs;?></td>
                                    <td align="center">
										<a class="btn btn-info" target="_blank" href="<?=site_url("api/kartu/cetak?nokartu=$row->no_index");?>" onclick="window.open(this.href, 'mywin','width=500,height=290'); return false;"> <i class="glyphicon glyphicon-print"></i> </a>
									</td>
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
  
	<script>
	$(document).ready(function(){
		$("button#cetakpdf").click(function(){
			//window.open(base_url + 'laporan/pasien/pdf', '_blank');
		});
		$("button#cetakcsv").click(function(){
			window.open(base_url + 'laporan/pasien/xls', '_blank');
		});
	});
	</script>
	  
	  
  
<?php $this->load->view('AdminLTE/footer'); ?>