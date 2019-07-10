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
  <h1><a href="<?php echo site_url('Admin') ?>">Admin</a></h1>
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
    <li class="active"><a href="<?php echo site_url('Admin') ?>"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Master</span></a>
      <ul>
        <li><a href="<?php echo site_url('Admin/kelola_admin') ?>">Data Admin</a></li>
		<li><a href="<?php echo site_url('Admin/kelola_user') ?>">Data User</a></li>
		<li><a href="<?php echo site_url('Admin/kelola_jagung') ?>">Data Jagung</a></li>
		<li><a href="<?php echo site_url('Admin/kelola_lokasi') ?>">Data Lokasi</a></li>
      </ul>
    </li>
  </ul>
</div>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo site_url('Admin') ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
      <h3>Kelola Data Tanaman Jagung Tahun <?php echo $thn ?></h3>
      <a class="btn btn-default" href="<?php echo site_url('Admin/form') ?>">Import Excel</a>
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Filter Berdasarkan Tahun</h5>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="widget-content nopadding">
              <?php echo form_open('Admin/filter_jagung',array(
                      'class' => 'form-horizontal'
                  )); ?>
                <div class="control-group">
                  <label class="control-label">Tahun :</label>
                  <div class="controls">
                    <select name="tahun" id="inputTahun" class="span11" required="required">
          						<?php foreach ($tahun as $key) { ?>
          						<?php if ($key->tahun == $key->tahun): ?>
          							<option value="<?php echo $key->tahun ?>"><?php echo $key->tahun ?></option>
          						<?php endif ?>
          						<?php } ?>
          					</select>
                    <input type="hidden" name="hidden"class="form-control" value="Tahun">
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-success">Filter</button>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="widget-box">
          <div class="widget-content nopadding">
          	<div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
	          <h5>Data Tanaman Jagung Tahun <?php echo $thn ?></h5>
	        </div>
            <a class="btn btn-default" href="<?php echo site_url('Admin/tambah_jagung/'.$thn) ?>">Tambah Data Jagung</a>
              <table class="table table-bordered data-table">
	            <thead>
	              <tr>
	                <th>No.</th>
					<th>Lokasi</th>
					<th>Produksi (Ton)</th>
					<th>Produktivitas (Ku/Ha)</th>
					<th>Luas Panen (Ha)</th>
					<th>Tahun</th>
					<th>Action</th>
	              </tr>
	            </thead>
	            <tbody>
	            	<?php $no = 1 ?>
					<?php foreach ($jagung as $key) { ?>
						<tr>
							<td><?php echo $no ?></td>
							<td><?php echo $key->nama_lokasi ?></td>
							<td><?php echo $key->produksi ?></td>
							<td><?php echo $key->produktivitas ?></td>
							<td><?php echo $key->luas_panen ?></td>
							<td><?php echo $key->tahun ?></td>
							<td>
								<a class="btn btn-primary" href="<?php echo site_url('Admin/edit_jagung/'.$key->id_tanaman) ?>">Edit</a>
								<a class="btn btn-danger" href="<?php echo site_url('Admin/delete_jagung/'.$key->id_tanaman) ?>">Delete</a>
							</td>
							<?php $no++ ?>
						</tr>
					<?php } ?>
	            </tbody>
	          </table>
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
