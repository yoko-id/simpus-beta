<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			LAPORAN PEMAKAIAN OBAT BULAN INI
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
						<table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Obat</th>
                                    <th>Satuan</th>
                                    <th>Stok Awal</th>
                                    <th>Pemakaian</th>
                                    <th>Sisa Stok</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
							foreach($result as $row){
                                if($row->nama_obat){
									echo '<tr>
										<th scope="row">'.$i.'.</th>
										<td>'.$row->nama_obat.'</td>
										<td>'.$row->satuan.'</td>
										<td>'.$row->stok.'</td>
										<td>'.$row->tot.'</td>
										<td>'.($row->stok-$row->tot).'</td>
										<td>'.toIDR($row->harga).'</td>
										<td>'.toIDR(($row->stok-$row->tot)*$row->harga).'</td>
									</tr>';
								}
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
		$('button#sinc').click(function () {
			var no_index = $(this).attr("data-value");
			//alert(no_index);
			$.get( base_url + "api/sink", { no_index: no_index }, function(data, status){
				console.log(data);
			});
		});
	});
	</script>
  
<?php $this->load->view('AdminLTE/footer'); ?>