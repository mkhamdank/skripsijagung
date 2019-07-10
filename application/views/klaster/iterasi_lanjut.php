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
      <h3>Pengelompokan Jagung Tahun <?php echo $thn ?> Iterasi Ke-<?php echo $this->uri->segment(5)+1 ?></h3>
      <?php $it = $iterasi+1 ?>
    	<a style="align-content: right" class="btn btn-default" href="<?php echo site_url('Klaster/iterasi_lanjut/'.$thn.'/'.$jml.'/'.$it) ?>">Lanjutkan Iterasi</a>
    <div class="row-fluid">

      <div class="widget-box">
          <div class="widget-content nopadding">
          	<div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
	          <h5>Hasil Medoids</h5>
	        </div>
              <div class="jumbotron">
					<div class="container">
						<p>Dikarenakan hasil selisih antara Medoids dengan Non-Medoids di bawah 0, maka hasil dari Non-Medoids dijadikan sebagai Medoids. Dan dibentuk perhitungan untuk Non-Medoids baru.</p>
						<h4>
							Hasil Medoids : <?php foreach ($hasil_iterasi as $key) {
								echo $medoids = $key->total_non_medoids;
							} ?>
						</h4>
					</div>
				</div>
          </div>
        </div>

      <div class="widget-box">
          <div class="widget-content nopadding">
          	<div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
	          <h5>Centroid Non-Medoids</h5>
	        </div>
              <div style="overflow-x: auto;">
              	<table class="table table-bordered">
		            <thead>
							<tr>
								<th>Centroid ke-</th>
								<th>Lokasi</th>
								<th>Produksi (Ton)</th>
								<th>Produktivitas (Ku/Ha)</th>
								<th>Luas Panen (Ha)</th>
								<th>Tahun</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1 ?>
							<?php foreach ($jagung_rand as $m1) { ?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $m1->nama_lokasi ?></td>
									<td><?php echo $m1->produksi ?></td>
									<td><?php echo $m1->produktivitas ?></td>
									<td><?php echo $m1->luas_panen ?></td>
									<td><?php echo $m1->tahun ?></td>
									<?php $no++ ?>
								</tr>
							<?php } ?>
						</tbody>
		          </table>
              </div>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-content nopadding">
          	<div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
	          <h5>Iterasi Non-Medoids</h5>
	        </div>
              <div style="overflow-x: auto;">
              	<table class="table table-bordered data-table">
		            <thead>
							<tr>
								<th rowspan="2">No.</th>
								<th rowspan="2">Lokasi</th>
								<th rowspan="2">Produksi (Ton)</th>
								<th rowspan="2">Produktivitas (Ku/Ha)</th>
								<th rowspan="2">Luas Panen (Ha)</th>
								<th rowspan="2">Tahun</th>
								<?php $c = 1 ?>
								<?php foreach ($jagung_rand as $m) { ?>
									<th colspan="3">Centroid <?php echo $c; $c++ ?></th>
								<?php } ?>
								<?php $d = 1 ?>
								<?php foreach ($jagung_rand as $m) { ?>
									<th rowspan="2">C<?php echo $d; $d++ ?></th>
								<?php } ?>
							</tr>
							<tr>
								<?php foreach ($jagung_rand as $m1) { ?>
									<th><?php $c_prod[] = $m1->produksi; echo $m1->produksi ?></th>
									<th><?php $c_prodt[] = $m1->produktivitas; echo $m1->produktivitas ?></th>
									<th><?php $c_lp[] = $m1->luas_panen; echo $m1->luas_panen ?></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							$tc0 = 0;
							$tc = 0 ?>
							<?php foreach ($jagung as $key) { ?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $key->nama_lokasi ?></td>
									<td><?php echo $key->produksi ?></td>
									<td><?php echo $key->produktivitas ?></td>
									<td><?php echo $key->luas_panen ?></td>
									<td><?php echo $key->tahun ?></td>
									<?php $no++ ?>
									<!-- <td><?php $hm1 = sqrt(pow(($key->produksi-$c_prod[0]),2)+pow(($key->produktivitas-$c_prodt[0]),2)+pow(($key->luas_panen-$c_lp[0]),2));
										echo $hm1;?>
									</td>
									<td>
										<?php $hm2 = sqrt(pow(($key->produksi-$c_prod[0]),2)+pow(($key->produktivitas-$c_prodt[0]),2)+pow(($key->luas_panen-$c_lp[0]),2));
										echo $hm2;?>
									</td>
									<td>
										<?php $hm3 = sqrt(pow(($key->produksi-$c_prod[0]),2)+pow(($key->produktivitas-$c_prodt[0]),2)+pow(($key->luas_panen-$c_lp[0]),2));
										echo $hm3;?>
									</td>
									<td><?php echo $c_prod[1]; ?></td>
									<td><?php echo $c_prodt[1]; ?></td>
									<td><?php echo $c_lp[1]; ?></td> -->
									<?php $e = 0;
									$tc = array(); ?>
									<?php foreach ($jagung_rand as $k) { ?>
										<td colspan="3"><?php $hm[$e] = sqrt(pow(($key->produksi-$c_prod[$e]),2)+pow(($key->produktivitas-$c_prodt[$e]),2)+pow(($key->luas_panen-$c_lp[$e]),2));
										echo $hm[$e];
										$hc[$e] = $hm[$e];
										// $tc[$e] = array_sum($hc[$e]);
										?>
										</td>
										<?php $e++ ?>
									<?php } ?>
									<?php for ($i=0; $i < COUNT($hc); $i++) { ?>
										<?php if ($hc[$i] == MIN($hc)) { ?>
											<td bgcolor='#FFFF00'>1</td>
											<?php
											$cm = $i+1;
											$q = "insert into centroid_temp(jenis,iterasi,c) values('NM','".$it."','c".$cm."')";
	              							$this->db->query($q);
										}
										else{
											echo "<td>0</td>";
										}
										?>
									<?php } ?>
									<?php 
										for ($j=0; $j < COUNT($hc); $j++) { 
											// if ($j == 0) {
												$tc0 = $tc0 + $hc[$j];
												$ttc[] = $tc0;
											// }
											// else{
												
											// }
										}
										// echo "<td>".$tc0."</td>";
									?>
								</tr>
							<?php } ?>
							<tr align="center">
								<td colspan="6"><b>TOTAL</b></td>
								<td colspan="12"><b><?php echo $ttc[37].'/'.end($ttc) ?></b></td>
							</tr>
						</tbody>
		          </table>
              </div>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-content nopadding">
          	<div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
	          <h5>Selisih antara Non-Medoids dengan Medoids</h5>
	        </div>
              <div class="jumbotron">
					<div class="container">
						<h4>
						Total Medoids : <?php echo $medoids ?><br><br>
						Total Non Medoids : <?php echo $ttc[37] ?><br><br>
						Selisih : <?php echo $selisih = $ttc[37] - $medoids ?><br><br>
						<?php $n = "insert into hasil_iterasi(iterasi,total_medoids,total_non_medoids,selisih) values('".$it."','".$medoids."','".$ttc[37]."','".$selisih."')";
              							$this->db->query($n); ?>
						</h4>
					</div>
				</div>
          </div>
        </div>

        

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
