<html>
<head>
	<title>Form Import</title>
	
	<!-- Load File jquery.min.js yang ada difolder js -->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
	
	<script>
	$(document).ready(function(){
		// Sembunyikan alert validasi kosong
		$("#kosong").hide();
	});
	</script>
</head>
<body>
	<h3>Form Import</h3>
	<hr>
	
	<a href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
	<br>
	<br>
	
	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
	<?php echo form_open_multipart('Admin/form'); ?>
	<!-- <form method="post" action="<?php echo base_url("index.php/Admin/form"); ?>" enctype="multipart/form-data"> -->
		<!-- 
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->
		<input type="file" name="file">
		
		<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
		<input type="submit" name="preview" value="Preview">
	<?php echo form_close(); ?>
	
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
			echo "<button type='submit' name='import'>Import</button>";
			echo "<a href='".base_url("index.php/Admin/kelola_jagung")."'>Cancel</a>";
		// }
		
		echo "</form>";
	}
	?>
</body>
</html>
