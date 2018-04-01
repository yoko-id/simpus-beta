<?php $this->load->view('AdminLTE/header'); ?>
<?php $this->load->view('AdminLTE/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <?php  ?>
	
	<!-- Main content -->
    <section class="content">
		<!-- Info boxes -->
		<div class="row">
			<div class="col-md-12">
			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Statistik Register Pasien</h3>

				  <div class="box-tools pull-right">
					<select id="statMonth" class="form-control clearfix">
						<?php
						for ($i=0; $i<=12; $i++) { 
						echo '<option value="'.date('Y-m', strtotime("-$i month")).'">'.date('F, Y', strtotime("-$i month")).'</option>';
						} ?>
					</select>
				  </div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-md-8">
						  <p class="text-center hide">
							<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
						  </p>

						  <div class="chart">
							<!-- Sales Chart Canvas -->
							<canvas id="salesChart" style="height:380px;"></canvas>
						  </div>
						  <!-- /.chart-responsive -->
						</div>
						<!-- /.col -->
						<div class="col-md-4">
							<p class="text-center hide">
								<strong>Asal Pasien</strong>
							</p>
							
							<div class="desaBar" style="height:380px;overflow:auto;padding-right:10px;">
								<?php					
								$bar = array('progress-bar-aqua', 'progress-bar-green', 'progress-bar-red', 'progress-bar-yellow');
								//shuffle($bar);
								
								if($stat['statDesa']){
									$tot = 0;
									foreach($stat['statDesa'] as $statDesa){
										$tot += $statDesa['tot'];
									}
									
									foreach($stat['statDesa'] as $statDesa){
										$percent = ($statDesa['tot']/$tot)*100;
									  
										echo '<div class="progress-group">
											<span class="progress-text">'.$statDesa['desa'].'</span>
											<span class="progress-number"><b>'.$statDesa['tot'].'</b>/'.$tot.'</span>

											<div class="progress sm">
											  <div class="progress-bar '.$bar[array_rand($bar)].'" style="width: '.(int)$percent.'%"></div>
											</div>
										  </div>
										  <!-- /.progress-group -->';
									}
								}
								?>
							</div>
						</div>
						<!-- /.col -->
					</div>
				</div>
				<!-- ./box-body -->
			  </div>
			  <!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
		
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Daftar Kunjungan Peserta Sakit/Sehat</h3>
						<div class="pull-right hide">
						
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
										<?php $bln = listBulan(); $years = listTahun();	?>
										
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
						
						<table id="_example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NO INDEX</th>
                                    <th>NAMA PASIEN</th>
                                    <th>KELAMIN</th>
                                    <th>UMUR</th>
                                    <th>ALAMAT</th>
                                    <th>NO BPJS</th>
                                    <th>KUNJUNGAN</th>
                                    <th>TGL. REGISTER</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							foreach($visits as $row){
                            ?>
								<tr>
                                    <td><?=$i;?>.</td>
                                    <td><?=$row->no_index;?></td>
                                    <td><?=$row->nama_pasien;?></td>
                                    <td><?=$row->gender;?></td>
                                    <td><?=get_age($row->tgl_lahir);?> Th</td>
                                    <td><?=$row->desa;?></td>
                                    <td><?=$row->no_bpjs;?></td>
                                    <td><?=$row->kunjungan;?></td>
                                    <td><?=tgl_indo(date("D, d-m-Y", strtotime($row->tgl_register)));?></td>
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
	
	<!-- ChartJS 1.0.1 -->
	<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
	<script>	
	$(function () {
		/* ChartJS
		* -------
		* Here we will create a few charts using ChartJS
		*/

		//-----------------------
		//- MONTHLY SALES CHART -
		//-----------------------

		// Get context with jQuery - using jQuery's .get() method.
		var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var salesChart = new Chart(salesChartCanvas);

		var salesChartData = {
			type: 'line',
			labels: ["<?=$stat['labels'];?>"],
			datasets: [
			  {
				fillColor: "rgba(60,141,188,0.9)",
				strokeColor: "rgba(60,141,188,0.8)",
				pointColor: "#3b8bba",
				pointStrokeColor: "rgba(60,141,188,1)",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(60,141,188,1)",
				data: [<?=$stat['data'];?>]
			  }
			]
		};

		var salesChartOptions = {
			//Boolean - If we should show the scale at all
			showScale: true,
			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: true,
			//String - Colour of the grid lines
			scaleGridLineColor: "rgba(0,0,0,.05)",
			//Number - Width of the grid lines
			scaleGridLineWidth: 1,
			//Boolean - Whether to show horizontal lines (except X axis)
			scaleShowHorizontalLines: true,
			//Boolean - Whether to show vertical lines (except Y axis)
			scaleShowVerticalLines: true,
			//Boolean - Whether the line is curved between points
			bezierCurve: true,
			//Number - Tension of the bezier curve between points
			bezierCurveTension: 0.3,
			//Boolean - Whether to show a dot for each point
			pointDot: true,
			//Number - Radius of each point dot in pixels
			pointDotRadius: 4,
			//Number - Pixel width of point dot stroke
			pointDotStrokeWidth: 1,
			//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			pointHitDetectionRadius: 20,
			//Boolean - Whether to show a stroke for datasets
			datasetStroke: true,
			//Number - Pixel width of dataset stroke
			datasetStrokeWidth: 2,
			//Boolean - Whether to fill the dataset with a color
			datasetFill: false,
			//String - A legend template
			legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
			//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true
		};

		//Create the line chart
		salesChart.Line(salesChartData, salesChartOptions);
		
		$("#cariData").click(function(){
			var valData = $("form.form-inline").serialize();
			$.ajax({
				type: "GET",
				url: base_url + "api/cariData/",
				data: valData,
				success: function(data){
					//console.log(data);
					//$('#results').html(data);
					$('table.table >tbody').html(data);
				}
			});
			return false;
		});
			
		$('select#statMonth').on('change', function() {
			var myDate = this.value;			
			$.ajax({
				type: "GET",
				url: base_url + "api/statmonthDesa/",
				data: { myDate: myDate },
				success: function(data){
					$('.desaBar').html(data);
				}
			});
		});
		
		$('select#statMonth').on('change', function() {
			//window.location = base_url + "admin/?month=" + this.value;
			
			var myDate = this.value;			
			$.ajax({
				type: "GET",
				url: base_url + "api/statmonth/",
				data: { myDate: myDate },
				success: function(data){					
					var result = $.parseJSON(data);
					var tempLabels = result['labels'] ;
					
					// Create the chart.js data structure using 'labels' and 'data'
					var tempData = {
						labels : result['labels'],
						datasets : [{
							fillColor: "rgba(60,141,188,0.9)",
							strokeColor: "rgba(60,141,188,0.8)",
							pointColor: "#3b8bba",
							pointStrokeColor: "rgba(60,141,188,1)",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(60,141,188,1)",
							data : result['data']
						}]
					};
					
					//console.log(tempData);
					// Get the context of the canvas element we want to select
					var ctx = document.getElementById("salesChart").getContext("2d");

					// Instantiate a new chart
					var myLineChart = new Chart(ctx).Line(tempData, salesChartOptions);						
				},
			});
			
			return false;
		});
	});
	</script>

<?php $this->load->view('AdminLTE/footer'); ?>