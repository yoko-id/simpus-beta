<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			LAPORAN LB1
			<small></small>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row hide">
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
									<div class="col-sm-3">
										<div class="form-group">
											<label class="form-label">KODE PENYAKIT</label>
											<input type="text" class="form-control" name="kode_penyakit" id="kode_penyakit" required>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label class="form-label">GOLONGAN UMUR</label>
											<select name="umur" class="form-control">
												<option value="1"><1 TH</option>
												<option value="0">1 - 4 TH</option>
												<option value="0">5 - 14 TH</option>
												<option value="0">15 - 44 TH</option>
												<option value="0">>45 TH</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label class="form-label">JUMLAH</label>
											<input type="text" class="form-control" name="jumlah">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label class="form-label">KASUS</label>
											<select name="kasus" class="form-control">
												<option value="BARU">BARU</option>
												<option value="LAMA">LAMA</option>
											</select>
										</div>
									</div>
								</div>
								
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
					<div class="box-header with-border hide">
						<h3 class="box-title">BUKU KONTROL</h3>
					</div>
					
					<div class="box-body">
						<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
									<td width="2%" rowspan="2"><div align="center">NO</div></td>
									<td width="3%" rowspan="2"><div align="center">CODE</div></td>
									<td width="45%" rowspan="2"><div align="center">JENIS PENYAKIT </div></td>
									<td colspan="5"><div align="center">JENIS KASUS MENURUT GOLONGAN UMUR </div></td>
									<td colspan="2"><div align="center">JUMLAH KASUS </div></td>
									<td width="10%" rowspan="2"><div align="center">JUMLAH KUNJUNGAN </div></td>
									<td width="10%" rowspan="2"><div align="center">JML KASUS DIRUJUK </div></td>
								</tr>
								<tr>
									<td width="8%"><div align="center">&lt;1TH</div></td>
									<td width="8%"><div align="center">1-4TH</div></td>
									<td width="8%"><div align="center">5-14TH</div></td>
									<td width="8%"><div align="center">15-44TH</div></td>
									<td width="8%"><div align="center">&gt;45TH</div></td>
									<td width="8%"><div align="center">BARU</div></td>
									<td width="8%"><div align="center">LAMA</div></td>
								</tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							
							if(!empty($penyakit)){
								foreach($penyakit as $row){
									
									$html = '<tr>
										<td>'.$i.'.</td>
										<td align="right"><strong>'.$row->code.'</strong></td>
										<td><strong>'.$row->penyakit.'</strong></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>';
									
									$tot = 0;
									foreach($row->sub as $sub){
										$kasusumur = lb1_penyakit_kasusUmur($sub->code);
										$umur_1 = isset($kasusumur[0]->umur1) ? $kasusumur[0]->umur1 : '0';
										$umur_2 = isset($kasusumur[0]->umur2) ? $kasusumur[0]->umur2 : '0';
										$umur_3 = isset($kasusumur[0]->umur3) ? $kasusumur[0]->umur3 : '0';
										$umur_4 = isset($kasusumur[0]->umur4) ? $kasusumur[0]->umur4 : '0';
										$umur_5 = isset($kasusumur[0]->umur5) ? $kasusumur[0]->umur5 : '0';
										
										$kasus	= lb1_penyakit_kasus($sub->code);
										$baru	= isset($kasus[0]->baru) ? $kasus[0]->baru : '0';
										$lama	= isset($kasus[0]->lama) ? $kasus[0]->lama : '0';
										
										$rujuk	= '0';
										
										$html .= '<tr>
											<td>'.$i.'.</td>
											<td align="right">'.$sub->code.'</td>
											<td>'.$sub->penyakit.'</td>
											<td align="center">'.$umur_1.'</td>
											<td align="center">'.$umur_2.'</td>
											<td align="center">'.$umur_3.'</td>
											<td align="center">'.$umur_4.'</td>
											<td align="center">'.$umur_5.'</td>
											<td align="center">'.$baru.'</td>
											<td align="center">'.$lama.'</td>
											<td align="center">'.count($kasus).'</td>
											<td align="center">'.$rujuk.'</td>
										</tr>';
										//$tot += count($kasus);
									}
									$tot = $tot+count($kasus);
									echo $html;									
									$i++;
								}
							}
							?>
                            </tbody>
							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td>JUMLAH</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td align="center"><?=$tot;?></td>
									<td></td>
								</tr>
							</tfoot>
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
		$('body').addClass('sidebar-collapse');
		
		$('#example2').dataTable({
			
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