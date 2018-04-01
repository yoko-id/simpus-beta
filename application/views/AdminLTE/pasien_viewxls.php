<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$pdfFilePath");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<h3>Data Pasien Puskesmas Andoolo Utama </h3>   
		<table border="1" class="table table-bordered">
            <thead>
				<tr>
					<th>NO</th>
					<th>NO INDEX</th>
					<th>NAMA PASIEN</th>
					<th>UMUR</th>
					<th>KELAMIN</th>
					<th>ALAMAT</th>
					<th>NO BPJS</th>
					<th>KUNJUNGAN</th>
					<th>KET</th>
				</tr>
            </thead>
            <tbody>
			<?php
			$i=1;
			foreach($result as $row){
				echo '<tr>
					<td>'.$i.'.</td>
					<td>'.$row->no_index.'</td>
					<td>'.$row->nama_pasien.'</td>
					<td>'.get_age($row->tgl_lahir).' Th</td>
					<td>'.$row->gender.'</td>
					<td>'.$row->desa.'</td>
					<td>'.$row->no_bpjs.'</td>
					<td>'.$row->kunjungan.'</td>
					<td>'.date("d/m/Y", strtotime($row->tgl_register)).'</td>
				</tr>';
				$i++;
			}
			?>
            </tbody>
        </table>
	</div> 

</body>
</html>