<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			INPUT OBAT
			<small></small>
		</h1>
    </section>

    <style>
	<!--
		.select2 { width: 100% !important }
	//-->
	</style>
	
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
											<input type="text" class="form-control" name="no_index" id="no_index" value="<?=$data[0]->no_index;?>" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label">NAMA PASIEN</label>
											<input type="text" class="form-control" name="nama_pasien" value="<?=$data[0]->nama_pasien;?>">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label">UMUR</label>
											<input type="text" class="form-control" name="umur">
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
												<label>DIAGNOSA</label>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<textarea name="diagnosa" class="form-control" rows="3"></textarea>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-4 form-control-label">
												<label>OBAT</label>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<select id="obat" name="obat[]" class="form-control" multiple="multiple">
														<?php
														foreach($obats as $obat){
															echo '<option value="'.$obat->id_obat.'">'.ucwords($obat->nama_obat).'</option>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>								
								
									<div class="col-md-4">
										
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<script>
	$(function () {
		//
		$("#obat").select2();
		
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