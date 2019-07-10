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
<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
<script>
	$(document).ready(function(){
		// Sembunyikan alert validasi kosong
		$("#kosong").hide();
	});
	</script>
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
      <h3>Form Import Excel Data Tanaman Jagung</h3>
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Form Import Excel</h5>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="widget-content nopadding">
              <?php echo form_open_multipart('Admin/form',array(
                      'class' => 'form-horizontal'
                  )); ?>
                <div class="control-group">
                  <label class="control-label">Download Format :</label>
                  <div class="controls">
                    <a class="btn btn-default" href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">File Excel :</label>
                  <div class="controls">
                    <input class="span11" type="file" name="file">
                  </div>
                </div>
                <div class="form-actions">
                  <input class="btn btn-success" type="submit" name="preview" value="Preview">
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="widget-box">
          <div class="widget-content nopadding">
          	<div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
	          <h5>Preview</h5>
	        </div>
            <?php
	if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
		if(isset($upload_error)){ // Jika proses upload gagal
			echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
			die; // stop skrip
		}
		
		// Buat sebuah tag form untuk proses import data ke database
		echo "<form method='post' action='".base_url("index.php/Admin/import")."'>";
		
		// Buat sebuah div untuk alert validasi kosong
		echo "<div style='color: red;' id='kosong'>
		Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
		</div>";
		
		echo "<table border='1' cellpadding='8'>
		<tr>
			<th colspan='5'>Preview Data</th>
		</tr>
		<tr>
			<th>ID Lokasi</th>
			<th>Produksi</th>
			<th>Luas Panen</th>
			<th>Produktivitas</th>
			<th>Tahun</th>
		</tr>";
		
		$numrow = 1;
		$kosong = 0;
		
		// Lakukan perulangan dari data yang ada di excel
		// $sheet adalah variabel yang dikirim dari controller
		foreach($sheet as $row){ 
			// Ambil data pada excel sesuai Kolom
			$fk_lokasi = $row['A']; // Ambil data NIS
			$produksi = $row['B']; // Ambil data nama
			$luas_panen = $row['C']; // Ambil data jenis kelamin
			$produktivitas = $row['D']; // Ambil data alamat
			$tahun = $row['E']; // Ambil data alamat
			
			// Cek jika semua data tidak diisi
			if(empty($fk_lokasi) && empty($produksi) && empty($luas_panen) && empty($produktivitas) && empty($tahun))
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
			
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Validasi apakah semua data telah diisi
				$fk_lokasi_td = ( ! empty($fk_lokasi))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
				$produksi_td = ( ! empty($produksi))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
				$luas_panen_td = ( ! empty($luas_panen))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
				$produktivitas_td = ( ! empty($produktivitas))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
				$tahun_td = ( ! empty($tahun))? "" : " style='background: #E07171;'";
				
				// Jika salah satu data ada yang kosong
				if(empty($fk_lokasi) or empty($produksi) or empty($luas_panen) or empty($produktivitas) or empty($tahun)){
					$kosong++; // Tambah 1 variabel $kosong
				}
				
				echo "<tr>";
				echo "<td".$fk_lokasi_td.">".$fk_lokasi."</td>";
				echo "<td".$produksi_td.">".$produksi."</td>";
				echo "<td".$luas_panen_td.">".$luas_panen."</td>";
				echo "<td".$produktivitas_td.">".$produktivitas."</td>";
				echo "<td".$tahun_td.">".$tahun."</td>";
				echo "</tr>";
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		echo "</table>";
		
		// Cek apakah variabel kosong lebih dari 0
		// Jika lebih dari 0, berarti ada data yang masih kosong
		// if($kosong > 0){
		?>	
			<!-- <script>
			$(document).ready(function(){
				// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
				$("#jumlah_kosong").html('<?php echo $kosong; ?>');
				
				$("#kosong").show(); // Munculkan alert validasi kosong
			});
			</script> -->
		<?php
		// }else{ // Jika semua data sudah diisi
			echo "<hr>";
			
			// Buat sebuah tombol untuk mengimport data ke database
			echo "<button class='btn btn-success' type='submit' name='import'>Import</button>";
			echo "<a class='btn btn-danger pull-right' href='".base_url("index.php/Admin/kelola_jagung")."'>Cancel</a>";
		// }
		
		echo "</form>";
	}
	?>
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
