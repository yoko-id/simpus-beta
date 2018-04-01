<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->		
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Aplikasi Laporan Gizi</h3>
						<div class="pull-right">
							
						</div>
					</div>
					
					<div class="box-body">
						<?php
						if($this->session->flashdata('response')){
							echo '<div class="alert alert-warning">'.$this->session->flashdata('response').'</div>';
						}
						?>
						<form method="POST">
							<div class="row clearfix">							
								<div class="col-md-3">									
									<div class="form-group">
										<label class="form-label">NAMA BAYI/BALITA</label>
										<input type="text" class="form-control" name="nama_bayi" required>
									</div>
								</div>									
								<div class="col-md-3">									
									<div class="form-group">
										<label class="form-label">NAMA ORANGTUA</label>
										<input type="text" class="form-control" name="nama_orangtua">
									</div>
								</div>										
								<div class="col-md-2">									
									<div class="form-group">										
										<label class="form-label">JENIS KELAMIN</label>
										<select name="kelamin" class="form-control">
											<option value="l">L</option>
											<option value="p">P</option>
										</select>
									</div>
								</div>										
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">TGL LAHIR</label>
										<input type="text" class="form-control" name="tgl_lahir" id="datepicker">
									</div>
								</div>											
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">BERAT LAHIR</label>
										<input type="text" class="form-control" name="bb_lahir">
									</div>
								</div>	
							</div>
							<div class="row clearfix">							
								<div class="col-md-3">									
									<div class="form-group">
										<label class="form-label">ALAMAT</label>
										<input type="text" class="form-control" name="alamat_bayi">
									</div>
								</div>								
								<div class="col-md-3">									
									<div class="form-group">
										<label class="form-label">BB. SAAT INI</label>
										<input type="text" class="form-control" name="alamat_bayi">
									</div>
								</div>								
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">DATANG</label>
										<input type="text" class="form-control" name="alamat_bayi">
									</div>
								</div>								
								<div class="col-md-4">									
									<div class="form-group">
										<label class="form-label">ALAMAT</label>
										<input type="text" class="form-control" name="" disabled>
									</div>
								</div>
							</div>
							<button class="btn btn-warning waves-effect" type="submit">SIMPAN BAYI/BALITA</button>
							<input type="hidden" name="desa_id" value="<?php echo $_GET['desa'];?>">
							<div class="pull-right">
								<a href="<?php echo base_url().'poli/program_gizi/import/?desa='.$_GET['desa'];?>" class="btn btn-warning waves-effect" target="_blank">IMPORT</a>
							</div>
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
						<h3 class="box-title">PENCATAN STATUS GIZI BALITA DI POSYANDU</h3>
						<?php $id = (int)$_GET['desa']-1; ?>
						<p>DESA  : <?=$list_desa[$id]->nama_desa;?></p>
					</div>
					
					<div class="box-body">
						<?php //var_dump ($all_balita);?>
						<table id="_example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
									<td rowspan="4" width="36"><div valign="middle">NO</div></td>
									<td rowspan="4" width="125"><div valign="middle">NAMA BAYI/BALITA</div></td>
									<td rowspan="4" width="117"><div valign="middle">NAMA ORANG TUA</div></td>
									<td rowspan="4" width="53"><div valign="middle">KELAMIN</div></td>
									<td rowspan="4" width="88"><div valign="middle">TGL LAHIR</div></td>
									<td rowspan="4" width="55"><div valign="middle">BB LAHIR</div></td>
									<td rowspan="4" width="64"><div valign="middle">ALAMAT</div></td>
									<td colspan="9" width="348"><div align="center">HASIL KEGIATAN BLN <?=strtoupper(date("F, Y", strtotime($_GET['thn'].'-'.$_GET['bln'])));?></div></td>
								  </tr>
								  <tr>
									<td rowspan="2" width="77"><div align="center">UMUR SAAT INI</div></td>
									<td rowspan="2" width="66"><div align="center">BB</div></td>
									<td colspan="6"><div align="center">KETERANGAN</div></td>
									<td rowspan="2" width="51"><div align="center">STATUS GIZI</div></td>
								  </tr>
								  <tr>
									<td width="33"><div align="center">K </div></td>
									<td width="33"><div align="center">D</div></td>
									<td width="33"><div align="center">N</div></td>
									<td width="33"><div align="center">T</div></td>
									<td width="33"><div align="center">O</div></td>
									<td width="33"><div align="center">B</div></td>
								  </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							foreach($all_balita as $row){
								$bb_lahir 	= isset($row->bb_lahir) ? $row->bb_lahir : 0;
								$bb_sekra 	= isset($row->bb) ? $row->bb : 0;
								$datang 	= '--';								
								$naik 		= '--';
								$turun 		= '--';
								$statusgizi = '--';
								$selisihbb 	= '--';
								
								if($bb_sekra){
									//if($bb_sekra > $row->bb_lahir) $naik = "Y";
									//if($bb_sekra < $row->bb_lahir) $turun = "Y";
									$selisihbb 	= ($row->bb_lahir-$bb_sekra);
									$statusbb 	= balita_statusbb(count_months2($row->tgl_lahir), $selisihbb);
									$naik		= $statusbb['N'];
									$turun		= $statusbb['T'];
									$datang		= 'Y';
								
									//$selisihbb 	= ($row->bb_lahir-$bb_sekra);
									//$statusgizi = balita_statusgizi(count_months2($row->tgl_lahir), $selisihbb);
								}
								$param 	= $_GET['desa'].'#'.$_GET['bln'].'#'.$_GET['thn'];
							?>
								<tr id="<?=$row->id;?>" class="edit_tr">
                                    <td><?=$i;?>.</td>
                                    <td><?=$row->nama_bayi;?></td>
                                    <td><?=$row->nama_orangtua;?></td>
                                    <td><?=$row->kelamin;?></td>
                                    <td><?=date("d-m-Y", strtotime($row->tgl_lahir));?></td>
                                    <td class="editable" id="<?=$row->id.'#bb_lahir#'.$param;?>"><?=$bb_lahir;?></td>
                                    <td><?=$row->alamat_bayi;?></td>
                                    <td><?=balita_umur(count_months2($row->tgl_lahir));?></td>
                                    <td class="editable" id="<?=$row->id.'#bb#'.$param;?>"><?=$bb_sekra;?></td>
                                    <td>K</td>
                                    <td><?=$datang;?></td>
                                    <td><?=$naik;?></td>
                                    <td><?=$turun;?></td>
                                    <td class="editable" id="<?=$row->id.'#O#'.$param;?>">--</td>
                                    <td class="editable" id="<?=$row->id.'#B#'.$param;?>">--</td>
                                    <td>
										<select name="statusgizi" class="statusgizi" id="<?=$row->id;?>">
											<option value=""></option>
											<option value="KURANG">KURANG</option>
											<option value="BURUK">BURUK</option>
											<option value="LEBIH">LEBIH</option>
											<option value="BAIK">BAIK</option>
											<option value="BGMBARU">BGMBARU</option>
											<option value="BGMLAMA">BGMLAMA</option>
										</select>
									</td>
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
  
	<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/jquery.jeditable.js"></script>
	<script>
	$(document).ready(function(){
		//Date picker
		$('#datepicker').datepicker({
			autoclose: true,
			dateFormat: 'yyyy-mm-dd'
		});
		
		$(".editable").editable(base_url + "api/giziActivity/", {
			indicator : "<img src='" + base_url + "dist/images/loading.gif'>",
			submitdata: { _method: "POST" },
			select : true,
			submit : 'Update',
			cssclass : "editable",
			width : "12",
			loadtext  : 'Updating'
		});
	});
	</script>
	  
	  
  
<?php $this->load->view('AdminLTE/footer'); ?>