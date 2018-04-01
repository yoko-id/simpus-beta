<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>LOKET</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url("pasien/add");?>"><i class="fa fa-circle-o"></i> Register Pasien</a></li>
            <!--<li><a href="<?php echo site_url("pasien/addvisit");?>"><i class="fa fa-circle-o"></i> Register Kunjungan</a></li>//-->
            <li><a href="<?php echo site_url("pasien/view");?>"><i class="fa fa-circle-o"></i> Data Pasien</a></li>
            <li><a href="<?php echo site_url("pasien/printkartu");?>"><i class="fa fa-circle-o"></i> Cetak Kartu</a></li>
            <!--<li><a href="<?php echo site_url("pasien/viewvisit");?>"><i class="fa fa-circle-o"></i> Data Kunjungan</a></li>//-->
            <li><a target="_blank" href="<?php echo site_url("pasien/antrian");?>"><i class="fa fa-circle-o"></i> Antrian</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>POLI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<?php
			$listpoli = list_poli();
			foreach($listpoli as $poli){
			?>
            <li><a href="<?php echo site_url("poli/".slugy($poli->nama));?>"><i class="fa fa-circle-o"></i> <?=$poli->nama;?></a></li>
			<?php } ?>
			<li><a href="<?php echo site_url("poli/addpoli");?>"><i class="fa fa-circle-o"></i> SETTING POLI</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-list-alt"></i>
            <span>REKAM MEDIS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url("diagnosa/histori");?>"><i class="fa fa-circle-o"></i> History Pasien </a></li>
			<li><a href="<?php echo site_url("diagnosa");?>"><i class="fa fa-circle-o"></i> Diagnosa</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>APOTEK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url("apotek/resep");?>"><i class="fa fa-circle-o"></i> Data Resep </a></li>
            <li><a href="<?php echo site_url("apotek/laporan");?>"><i class="fa fa-circle-o"></i> Laporan Penggunaan Obat</a></li>
            <li><a href="<?php echo site_url("apotek/obat/stok");?>"><i class="fa fa-circle-o"></i> Ketersediaan Obat </a></li>
            <li><a href="<?php echo site_url("apotek/obat/masuk");?>"><i class="fa fa-circle-o"></i> Data Obat Masuk</a></li>
            <li><a href="<?php echo site_url("apotek/obat/keluar");?>"><i class="fa fa-circle-o"></i> Data Obat Keluar</a></li>
            <li><a href="<?php echo site_url("apotek/obat/expired");?>"><i class="fa fa-circle-o"></i> Data Obat Expired</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>LAPORAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url("laporan/gizi");?>"><i class="fa fa-circle-o"></i> LAPORAN GIZI</a></li>
            <li><a href="<?php echo site_url("laporan/gigi");?>"><i class="fa fa-circle-o"></i> LAPORAN POLI GIGI </a></li>
            <li><a href="<?php echo site_url("laporan/lb1");?>"><i class="fa fa-circle-o"></i> LB1 </a></li>
            <li><a href="<?php echo site_url("laporan/lplpo");?>"><i class="fa fa-circle-o"></i> LPLPO </a></li>
            <li><a href="<?php echo site_url("laporan/diare");?>"><i class="fa fa-circle-o"></i> P2 DIARE </a></li>
            <li><a href="<?php echo site_url("laporan/ispa");?>"><i class="fa fa-circle-o"></i> P2 ISPA </a></li>
            <li><a href="<?php echo site_url("laporan/posbindu");?>"><i class="fa fa-circle-o"></i> POSBINDU </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-envelope"></i> <span>SMS CENTER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url("sms/inbox");?>"><i class="fa fa-circle-o"></i> Inbox </a></li>
            <li><a href="<?php echo site_url("sms/outbox");?>"><i class="fa fa-circle-o"></i> Outbox </a></li>
            <li><a href="<?php echo site_url("sms/phonebok");?>"><i class="fa fa-circle-o"></i> Phonebok </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="<?php echo site_url("monitor");?>" target="_blank">
            <i class="glyphicon glyphicon-user"></i> <span>MONITOR</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-user"></i> <span>MANAJEMEN USER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url("user/addpetugas");?>"><i class="fa fa-circle-o"></i> Tambah Petugas </a></li>
            <li><a href="<?php echo site_url("user");?>"><i class="fa fa-circle-o"></i> Data User </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#" target="_blank">
            <i class="glyphicon glyphicon-user"></i> <span>PEGAWAI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  <ul class="treeview-menu">
            <li><a href="<?php echo site_url("user/addpegawai");?>"><i class="fa fa-circle-o"></i> Data Pegawai </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#" target="_blank">
            <i class="glyphicon glyphicon-copy"></i> <span>RUJUKAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  <ul class="treeview-menu">
            <li><a href="<?php echo site_url("rujukan");?>"><i class="fa fa-circle-o"></i> Rujukan </a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>