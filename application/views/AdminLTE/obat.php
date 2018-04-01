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
						<h3 class="box-title">Tambah Data Obat</h3>
					</div>					
					<div class="box-body">
						<?php
						if($this->session->flashdata('response')){
							echo '<div class="alert alert-success">'.$this->session->flashdata('response').'</div>';
						}
						?>
						
						<form method="POST">
							<div class="row clearfix">									
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">KODE OBAT</label>
										<input type="text" class="form-control" name="kode" required>
									</div>
								</div>	
								<div class="col-md-4">
									<div class="form-group">											
										<label class="form-label">NAMA OBAT</label>
										<input type="text" class="form-control" name="nama_obat" required>
									</div>									
								</div>								
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">KATEGORI</label>
										<select name="kategori" class="form-control">
											<option value=""></option>
											<?php foreach($kategori as $cat){?>
											<option value="<?=$cat->id_kategori;?>"><?=strtoupper($cat->kategori);?></option>
											<?php } ?>
										</select>
									</div>
								</div>									
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">SATUAN</label>
										<input type="text" class="form-control" name="satuan" placeholder="PCS">
									</div>
								</div>									
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">STOK</label>
										<input type="text" class="form-control" name="stok">
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">TGL MASUK</label>
										<input type="text" class="form-control" name="masuk" id="datepicker">
									</div>
								</div>										
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">TGL EXPIRED</label>
										<input type="text" class="form-control" name="expired" id="datepicker2">
									</div>
								</div>										
								<div class="col-md-4">									
									<div class="form-group">
										<label class="form-label">PRODUSEN</label>
										<input type="text" class="form-control" name="produsen">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">											
										<label class="form-label">HARGA BELI</label>
										<input type="text" class="form-control" name="hargabeli">
									</div>									
								</div>									
								<div class="col-md-2">									
									<div class="form-group">
										<label class="form-label">HARGA JUAL</label>
										<input type="text" class="form-control" name="hargajual">
									</div>
								</div>
							</div>
							<button class="btn btn-primary" type="submit">SIMPAN DATA OBAT</button>
                        </form>
					</div>
					<!-- /.box-body -->
					<div class="box-footer hide">
						
					</div>
				</div>			
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Data Stok Obat</h3>
					</div>
					
					<div class="box-body">
						<table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>KATEGORI</th>
                                    <th>KODE</th>
                                    <th>NAMA OBAT</th>
                                    <th>SATUAN</th>
                                    <th>STOK</th>
                                    <th>BELI</th>
                                    <th>JUAL</th>
                                    <th>MASUK</th>
                                    <th>EXPIRED</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)):
							foreach($result as $row){
                                echo '<tr>
                                    <th scope="row">'.$i.'.</th>
                                    <td>'.get_kategoriObat($row->id_kategori).'</td>
                                    <td>'.$row->kode_obat.'</td>
                                    <td>'.$row->nama_obat.'</td>
                                    <td>'.$row->satuan.'</td>
                                    <td>'.toIDR($row->stok).'</td>
                                    <td>'.toIDR($row->harga_beli).'</td>
                                    <td>'.toIDR($row->harga).'</td>
                                    <td>'.$row->tgl_masuk.'</td>
                                    <td>'.$row->expired.'</td>
                                    <td><a class="del" href="javascript:void(0)" data-id="'.$row->id_obat.'" data-kode="'.$row->kode_obat.'"><i class="glyphicon glyphicon-remove"></i></a></td>
                                </tr>';
								$i++;
							}
							endif;
							?>
                            </tbody>
                        </table>
						
						<script>
						$(function () {
							$('table tr td a.del').click(function(){
								var del_id = $(this).attr("id");
								var kode_obat = $(this).attr("kode");
								var info = 'id=' + del_id;								
								if(confirm("Yakin ingin menghapus Data Stok Obat dengan ID = " + kode_obat + "?")){
									$.ajax({
										type: "GET",
										url: "<?php echo site_url("api/obat/delete");?>",
										data: info,
										success: function(data){
											//
										}
									});
									$(this).parent().parent().css("background-color","#FF3700");
									$(this).fadeOut(400, function(){
										$(this).parent().parent().remove();
									});
								}
								return false;
							});	
						});
						</script>
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