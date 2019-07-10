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
<?php 	$this->db->query('truncate table hasil_klaster'); ?>

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
      <h3>Hasil Pengelompokan Jagung Tahun <?php echo $thn ?></h3>
      <a style="align-content: right" class="btn btn-default" href="<?php echo site_url('Klaster') ?>">Mulai Awal</a>
    <div class="row-fluid">

      <div class="widget-box">
          <div class="widget-content nopadding">
          	<div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
	          <h5>Centroid Non-Medoids</h5>
	        </div>
              <?php foreach ($centroid_temp_by_c as $val) { ?>
					<?php $c[] = $val->c; ?>
				<?php } ?>
				<?php foreach ($centroid_temp_by_iterasi as $key) { ?>
					<?php $q = $this->db->query('select * from centroid_temp where iterasi='.$key->iterasi.''); ?>
					<?php $no = 1; ?>
					<!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"> -->
					<center><b style="font-size: 20px">Iterasi ke-<?php echo $key->iterasi ?></b></center>
					<div style="overflow-x: auto;">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><center>No.</center></th>
									<th><center>Jenis</center></th>
									<?php for ($i=0; $i < count($c); $i++) { ?>
										<th><center><?php echo strtoupper($c[$i]); ?></center></th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
					                <?php foreach($q->result() as $tq) { ?>
						              <tr align="center">
						              	<td><?php echo $no ?></td>
						              	<td><?php if ($tq->jenis == "M") {
						              		echo "Medoids";
						              	}
						              	else{
						              		echo "Non-Medoids";
						              	} ?></td>
						              	<?php for ($j=0; $j < COUNT($c); $j++) { 
						              		if ($tq->c == $c[$j]) { ?>
						              			<td bgcolor='#FFFF00'>1</td>
						              		<?php }
						              		else{
						              			echo "<td>0</td>";
						              		}
						              	} ?>
						              </tr>
						            <?php $no++ ?>
					              <?php } ?>
							</tbody>
						</table>
					</div>
					<!-- </div> -->
				<?php } ?>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-content nopadding">
          	<div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
	          <h5>Hasil Pengelompokan</h5>
	          <?php foreach ($centroid_temp_by_iterasi as $key) {
					if ($key->iterasi == 1) {
						$it = $key->iterasi;
					}
					else{
						$it = $key->iterasi-1;
					}
				} ?>
				<?php $q2 = $this->db->query('select * from centroid_temp where iterasi='.$it.''); ?>
				<?php foreach ($q2->result() as $vil) {
					$hc[] = $vil->c;
				} ?>
				<?php $no = 0 ?>
	        </div>
            <div style="overflow-x: auto;">
            	<table class="table table-bordered">
					<thead>
						<th><center>No.</center></th>
						<th><center>Lokasi</center></th>
						<?php for ($i=0; $i < count($c); $i++) { ?>
							<th><center><?php echo strtoupper($c[$i]); ?></center></th>
						<?php } ?>
					</thead>
					<tbody>
						<?php foreach ($jagung as $key) { ?>
							<tr align="center">
								<td><?php echo $no+1 ?></td>
								<td><?php echo $key->nama_lokasi ?></td>
								<?php for ($k=0; $k < count($c); $k++) { ?>
									<?php if ($hc[$no] == $c[$k]){ ?>
										<td bgcolor='#FFFF00'>1</td>
										<?php $kk = $k+1; ?>
										<?php $q3 = "insert into hasil_klaster(fk_tanaman,c) values('".$key->id_tanaman."','c".$kk."')";
              							$this->db->query($q3); ?>
									<?php }
									else{
										echo "<td>0</td>";
									} ?>
								<?php } ?>
							</tr>
							<?php $no++ ?>
						<?php } ?>
					</tbody>
				</table>
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
