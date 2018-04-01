<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			POLI GIGI
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
						<?php
						if($this->session->flashdata('response')){
							echo '<div class="alert alert-success">'.$this->session->flashdata('response').'</div>';
						}
						?>
						
						<form method="POST">
								<div class="row clearfix">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label">NOMOR KARTU</label>
											<input type="text" class="form-control" name="no_index" id="no_index" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label">NAMA PASIEN</label>
											<input type="text" class="form-control" name="nama_pasien">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label">TGL. LAHIR</label>
											<input type="text" class="form-control" name="tgl_lahir" id="datepicker" data-date-format='yyyy-mm-dd'>
										</div>
									</div>
								</div>
								
								<div class="row clearfix">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label">JENIS KELAMIN</label>
											<div class="form-inline">
												<input type="radio" name="gender" id="male" value="l" class="flat-red">Laki-laki
												<input type="radio" name="gender" id="female" value="p" class="flat-red">Perempuan
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label">JENIS PESERTA</label>
											<input type="text" class="form-control" name="jenis_peserta">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label">STATUS PESERTA</label>
											<input type="text" class="form-control" name="status_peserta">
										</div>
									</div>
								</div>
								
								<hr>
								<div class="row clearfix">
									<div class="col-md-8">
										<div class="row clearfix">
											<div class="col-md-4 form-control-label">
												<label>KELUHAN</label>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<textarea name="keluhan" class="form-control" rows="3"></textarea>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-4 form-control-label">
												<label>TERAPI</label>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<textarea name="terapi" class="form-control"></textarea>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-4 form-control-label">
												<label>DIAGNOSA</label>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<div class="input-group">
														<input name="diagnosa" class="form-control">
														<span class="input-group-btn">
															<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-4 form-control-label">
												<label>PENYAKIT</label>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<div class="input-group">
														<input name="penyakit" class="form-control">
														<span class="input-group-btn">
															<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-4 form-control-label">
												<label>KASUS</label>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<select name="kasus" class="form-control">
														<option value="BARU">BARU</option>
														<option value="LAMA">LAMA</option>
													</select>
												</div>
											</div>
										</div>
									</div>								
								
									<div class="col-md-4">
										<div class="page-header hide">
											<h4>PEMERIKSAAN FISIK</h4>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Tinggi Badan</label>
												<div class="input-group">
													<input type="text" class="form-control" name="tb">
													<span class="input-group-addon">Cm</span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Berat Badan</label>
												<div class="input-group">
													<input type="text" class="form-control" name="bb">
													<span class="input-group-addon">Kg</span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Sistole</label>
												<div class="input-group">
													<input type="text" class="form-control" name="sistole">
													<span class="input-group-addon">mmHg</span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Diastole</label>
												<div class="input-group">
													<input type="text" class="form-control" name="diastole">
													<span class="input-group-addon">mmHg</span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Respiratory Rate</label>
												<div class="input-group">
													<input type="text" class="form-control" name="respiratory">
													<span class="input-group-addon">/ minute</span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Heart Rate</label>
												<div class="input-group">
													<input type="text" class="form-control" name="heart">
													<span class="input-group-addon">bpm</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<hr>
								<button class="btn btn-primary waves-effect" type="submit">SIMPAN</button>
								<button class="btn btn-primary waves-effect" type="reset">BATAL</button>
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
						<h3 class="box-title">BUKU KONTROL</h3>
					</div>
					
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>TGL</th>
                                    <th>NAMA</th>
                                    <th>UMUR</th>
                                    <th>JK</th>
                                    <th>KELUHAN</th>
                                    <th>THERAPY</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							if(!empty($result)){
							foreach($result as $row){
                                if($row->antrian==0) $status=$row->jenis_poli; else $status="PULANG";
								echo '<tr>
                                    <td>'.$i.'.</td>
                                    <td>'.tgl_indo(date("D, d-m-Y", strtotime($row->tgl_register))).'</td>
                                    <td>'.$row->nama_pasien.'</td>
                                    <td>'.get_age($row->tgl_lahir).' Th</td>
                                    <td>'.$row->gender.'</td>
                                    <td>'.$row->keluhan.'</td>
                                    <td>'.$row->terapi.'</td>
                                    <td>'.$status.'</td>
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
		$('#example2').dataTable({
			
		});
		
		$( "input[name='diagnosa']" ).autocomplete({
            source: base_url + "api/diagnosa",
            minLength: 3
        });
		
		$( "input[name='penyakit']" ).autocomplete({
            source: base_url + "api/penyakit",
            minLength: 3,
			select: function(event, ui) {
				event.preventDefault();
				$(this).val(ui.item.label);
				$(this).val(ui.item.label);
			},
			focus: function(event, ui) {
				event.preventDefault();
				$(this).val(ui.item.label);
			}
        });
		
		$("input[name='no_index']").change(function(){
				var n = parseInt($(this).val());
				$(this).val( sixpad(n) );
				
				//alert("The text has been changed.");				
				$.getJSON( base_url + "api/kartu", { no_index: $(this).val() }, function(data, status){
					console.log(data);
					if(status=="success"){
						$("input[name='nama_pasien']").val( data[0].nama_pasien );
						$("input[name='nobpjs']").val( data[0].no_bpjs );						
						$("select[name='status_bpjs']").val( data[0].status_bpjs ).change();						
						var umur = getAge(new Date(data[0].tgl_lahir));
						$("input[name='umur']").val(umur);						
						$("select[name='gender']").val( data[0].gender ).change();
						$("select[name='desa']").val( data[0].desa ).change();
						
						var jenis_peserta = data[0].jenis_peserta;
						jenis_peserta = jenis_peserta.toLowerCase().replace(/\b[a-z]/g, function(letter) {
							return letter.toUpperCase();
						});
						//alert (jenis_peserta);
						
						$("select[name='jenis_peserta']").val( jenis_peserta ).change();
						
						var status_peserta = data[0].status_peserta;
						status_peserta = status_peserta.toLowerCase().replace(/\b[a-z]/g, function(letter) {
							return letter.toUpperCase();
						});
						$("select[name='status_peserta']").val( status_peserta ).change();
					}
				});
			});
	});
	</script>
  
<?php $this->load->view('AdminLTE/footer'); ?>