<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			DATA PETUGAS
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
						<form class="form-inline" name="form1" method="get"><div class="row" style="margin-bottom:10px;">
								<div class="col-lg-12">
									<div class="form-group">
										<select class="form-control" name="plh_group" id="plh_group" onChange="submit()">
											<option value="">Semua Group</option>
											<?php
											foreach($groups as $group){
											echo '<option value="'.$group->ID.'"';
											if(isset($_GET['plh_group'])==$group->ID) echo 'selected';
											echo '>'.$group->Name.'</option>';
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<input class="form-control" style="width:450px;" name="q" type="text" placeholder="Cari...">
									</div>
									<button type="submit" class="btn btn-success">Cari</button>
									<span class="pull-right">
										<a data-toggle="modal" data-target="#myModal" href="tambah_group.php" class="btn btn-primary modal-link"><i class="fa fa-plus"></i> Tambah Group</a>
										<a data-toggle="modal" data-target="#myModal" href="tambah_phbook.php" class="btn btn-primary modal-link"><i class="fa fa-plus"></i> Tambah Kontak</a>
									</span>
								</div>
							</div>
						</form>
						
						<div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th width='5%'>No.</th>
										<th>Nama</th>
										<th width='20%'>Nomer</th>
										<th width='10%'>Group</th>
										<th width='20%'>#</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$d=1;
								foreach($result as $row){
									echo "<tr>
										<td>".$d.".</td>
										<td>".strtoupper($row->Name)."</td>
										<td>".$row->Number."</td>
										<td>-</td>
										<td>
											<a class=\"btn btn-info\" href=\"?edit=".$row->ID."\"><i class=\"fa fa-close\"></i> Edit</a>
											<a class=\"btn btn-danger\" href=\"?del=".$row->ID."\"><i class=\"fa fa-close\"></i> Hapus</a>
										</td>
									</tr>";
									$d++;
								}
								?>
								</tbody>
							</table>
						</div>
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