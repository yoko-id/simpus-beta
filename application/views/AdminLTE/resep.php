<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			RESEP
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
						<h3 class="box-title">RESEP</h3>
						<div class="pull-right">
							
						</div>
					</div>
					
					<div class="box-body">
						<div class="panel panel-default">
							<div class="panel-body">
								<form class="form-inline">
									<div class="form-group">
										<div class="radio">
											<label> <input type="radio"  name="modePilihan" value="1" checked> Harian </label>
										</div>
										<input type="text" class="form-control" name="tgl" id="datepicker" placeholder="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd">
									</div>
									<div class="form-group">
										<div class="radio">
											<label> <input type="radio" name="modePilihan" value="2"> Bulanan </label>
										</div>
										<?php
										$bln = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
										$yearNow = date("Y");
										$yearEnd = ($yearNow-5);
										$years = range($yearNow, $yearEnd);
										?>
										
										<select name="bln" class="form-control">
											<?php foreach($bln as $key => $bl){
											echo '<option value="'.$key.'">'.$bl.'</option>';
											} ?>
										</select>
										<select name="thn" class="form-control">
											<?php foreach($years as $th){
											echo '<option value="'.$th.'">'.$th.'</option>';
											} ?>
										</select>
									</div>
									<div class="form-group">
										<div class="radio">
											<label> <input type="radio" name="modePilihan" value="3"> Individu </label>
										</div>
										<input type="text" class="form-control" name="individu">
									</div>
									<button type="button" class="btn btn-default" id="cariData">Cari Data</button>
									<button type="button" class="btn btn-default" id="cetakData">Cetak</button>
								</form>
							</div>
						</div>
						
						<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NO INDEX</th>
                                    <th>NAMA</th>
                                    <th>UMUR</th>
                                    <th>KELUHAN</th>
                                    <th>RESEP OBAT</th>
                                    <th>TGL. KUNJUNGAN</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
							foreach($result as $row){
								$attr = '';
								$btn = 'btn-danger';
								if($row->antrian==1) {
									$attr ='disabled';
									$btn = 'btn-default';
								}
								
                                echo '<tr>
                                    <td>'.$i.'.</td>
                                    <td>'.$row->no_index.'</td>
                                    <td>'.$row->nama_pasien.'</td>
                                    <td>'.get_age($row->tgl_lahir).' Th</td>
                                    <td>'.$row->keluhan.'</td>
                                    <td>'.getObat($row->obat).'</td><td>'.tgl_indo(date("D, d-m-Y", strtotime($row->tgl_register))).'</td>
                                    <td>
										<div class="btn-group" role="group">
											<button class="btn btn-info hide" id="inputObat" data-value="'.$row->no_index.'">INPUT OBAT</button>
											<button class="btn '.$btn.'" id="signApotek" data-value="'.$row->no_index.'" '.$attr.'>RESEP SUDAH DI TEBUS</button>
										</div>
									</td>
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
		
		$('button#signApotek').click(function () {
			var no_index = $(this).attr("data-value");
			//alert(no_index);
			$.get( base_url + "api/sign_apotek", { no_index: no_index }, function(data, status){
				console.log(data);
				location.reload();
			});
		});
		
		$('#inputObat').click(function () {
			var no_index = $(this).attr("data-value");				
			$(location).attr('href', base_url + 'apotek/obat/' + no_index)
		});
		
		$("#cariData").click(function(){
			var valData = $("form.form-inline").serialize();
			$.ajax({
				type: "GET",
				url: base_url + "api/cariDataApotek/",
				data: valData,
				success: function(data){
					$('table.table >tbody').html(data);
				}
			});
			return false;
		});
	});
	</script>
  
<?php $this->load->view('AdminLTE/footer'); ?>