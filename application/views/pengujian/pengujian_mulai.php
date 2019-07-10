<!DOCTYPE html>
<html lang="en">
<head>
<title>Pengelompokan Tanaman Jagung Jatim</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/select2.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/maruti-style.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/template-admin/HTML/css/maruti-media.css" class="skin-color" />
</head>
<body>

<!--Header-part-->
<div id="header">
  <h2><a href="<?php echo site_url('Home') ?>">Pengelompokan Tanaman Jagung Jawa Timur</a></h2>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="<?php echo site_url('Login/logout') ?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->

<div id="sidebar">
	<ul>
		<li class="active"><a href="<?php echo site_url('User') ?>"><i class="icon icon-home"></i> <span>Home</span></a> </li>
	    <li><a href="<?php echo site_url('User/jagung') ?>"><i class="icon icon-file"></i><span>Data Jagung</span></a></li>
		<li><a href="<?php echo site_url('Klaster') ?>"><i class="icon icon-signal"></i><span>Pengelompokan</span></a></li>
		<li><a href="<?php echo site_url('Pengujian') ?>"><i class="icon icon-cog"></i><span>Pengujian</span></a></li>
  </ul>
</div>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo site_url('User') ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
      <h3>Pengujian Pengelompokan Jagung Menggunakan Silhouette Coefficient</h3>
      <a class="btn btn-default" href="<?php echo site_url('Pengujian/lanjut_pengujian') ?>">Lanjutkan Pengujian</a>
      <?php $this->db->query('truncate table hasil_pengujian'); ?>
    <div class="row-fluid">
      <?php foreach ($hasilByC as $vil) { ?>
				<?php unset($c_prod); ?>
				<?php unset($c_prodv); ?>
				<?php unset($c_lp); ?>
				<?php $kondisiC  = $vil->c; ?>
				<?php $q2 = $this->db->query('select * from hasil_klaster  join tanaman on tanaman.id_tanaman=hasil_klaster.fk_tanaman JOIN lokasi ON tanaman.fk_lokasi=lokasi.id_lokasi where c="'.$kondisiC.'"'); ?>
				<?php foreach ($q2->result() as $vel) {
												$c_prod[] = $vel->produksi;
												$c_prodv[] = $vel->produktivitas;
												$c_lp[] = $vel->luas_panen;
											} ?>
				<h3><center>Hasil Perhitungan Jarak Ke Klaster Ke-<?php echo substr($vil->c, -1); ?></center></h3>
				<?php $cc = 0; ?>
				<?php unset($hp) ?>
				<?php foreach ($hasilByC as $key) { ?>
					<h4><center>Klaster ke-<?php echo $clus = substr($key->c, -1); ?></center></h4>
					<?php $q = $this->db->query('select * from hasil_klaster  join tanaman on tanaman.id_tanaman=hasil_klaster.fk_tanaman JOIN lokasi ON tanaman.fk_lokasi=lokasi.id_lokasi where c="'.$key->c.'"'); ?>
					<?php $no = 0; ?>
					<div style="overflow-x:auto;">
						<table class="table table-bordered" style="overflow-x:auto;">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Lokasi</th>
									<th>Produksi (Ton)</th>
									<th>Produktivitas (Ku/Ha)</th>
									<th>Luas Panen (Ha)</th>
									<?php $jarak = 0; ?>
									<?php for ($i=0; $i < count($c_prod); $i++) { ?>
										<th>Jarak ke-<?php echo $i+1 ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($q->result_array() as $val) { ?>
									<tr>
										<td><?php echo $no+1 ?></td>
										<td><?php echo $val['nama_lokasi'] ?></td>
										<td><?php echo $val['produksi'] ?></td>
										<td><?php echo $val['produktivitas'] ?></td>
										<td><?php echo $val['luas_panen'] ?></td>
										<?php for ($i=0; $i < count($c_prod); $i++) { ?>
											<td>
												<!-- <?php echo $c_lp[$i] ?> -->
												<?php echo $ccc = sqrt(pow(($c_prod[$i]-$val['produksi']),2)+pow(($c_prodv[$i]-$val['produktivitas']),2)+pow(($c_lp[$i]-$val['luas_panen']),2)) ?>
												<?php $cc = $cc + $ccc ?>
											</td>
										<?php } ?>
										<?php $no++ ?>
									</tr>
								<?php } ?>
								<?php $jml = count($c_prod) ?>
								<tr>
									<td colspan="<?php echo $jml+4 ?>" align="right"><b>Rata-rata</b></td>
									<td><b><?php echo $hp[] = $cc/($no*$jml); ?></b></td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php $cc++ ?>
				<?php } ?>
				<!-- <?php var_dump($hp) ?> -->
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>a(i)</th>
							<th>b(i)</th>
							<th>S(i)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $a1[] = $hp[substr($vil->c, -1)-1];$ai = $hp[substr($vil->c, -1)-1]; ?></td>
							<td><?php $array = array_diff($hp, $a1); echo $bi = min($array)?></td>
							<td><?php echo $si[] = ($bi-$ai)/(MAX($bi,$ai)) ?></td>
						</tr>
					</tbody>
				</table>
			<?php } ?>
			<?php for ($o=0; $o < count($si); $o++) {
				$q3 = "insert into hasil_pengujian(c,si) values('".$o."','".$si[$o]."')";
              							$this->db->query($q3);
			} ?>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy; Mokhamad Khamdan Khabibi</div>
</div>
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/excanvas.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/jquery.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/jquery.uniform.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/select2.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/maruti.js"></script> 
<script src="<?php echo base_url() ?>assets/template-admin/HTML/js/maruti.tables.js"></script>
 

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
