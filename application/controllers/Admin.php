<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $filename = "import_data";

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$this->load->helper('url','form','file');
				$this->load->library('form_validation');
				$this->load->model('Admin_model');
				$this->load->library('curl');
		}
		else{
			redirect('login','refresh');
		}
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['lokasi'] = $this->Admin_model->getLokasi();
			    // $data['admin'] = $this->Admin_model->getAdmin();

				if ($level == 1) {
					$this->load->view('admin/admin_view',$data);
				}
				elseif ($level == 2) {
					redirect('User','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function filter_grafik()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['lokasi'] = $this->Admin_model->getLokasi();
			    $this->form_validation->set_rules('hidden', 'Lokasi', 'trim|required');

			    if ($this->form_validation->run() == FALSE) {
			    	$data['error'] = "Pilih Tahun";
			    	$this->load->view('admin/admin_view', $data);
			    } else {
			    	$lokasi = $this->input->post('lokasi');
			    	$data['jagung'] = $this->Admin_model->getJagungByLokasi($lokasi);
			    	$data['lks'] = $lokasi;
			    	$this->load->view('admin/admin_filter',$data);
			    }
		}
		else{
			redirect('login','refresh');
		}
	}

	public function kelola_admin()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['admin'] = $this->Admin_model->getAdmin();

				$this->load->view('admin/kelola_admin',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function kelola_user()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['user'] = $this->Admin_model->getUser();

				$this->load->view('admin/kelola_user',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function kelola_lokasi()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['lokasi'] = $this->Admin_model->getLokasi();

				$this->load->view('admin/kelola_lokasi',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function kelola_jagung()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['tahun'] = $this->Admin_model->getTahun();

				$this->load->view('admin/kelola_jagung',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function filter_jagung()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['tahun'] = $this->Admin_model->getTahun();
			    $this->form_validation->set_rules('hidden', 'Tahun', 'trim|required');

			    if ($this->form_validation->run() == FALSE) {
			    	$data['error'] = "Pilih Tahun";
			    	$this->load->view('admin/kelola_jagung', $data);
			    } else {
			    	$tahun = $this->input->post('tahun');
			    	$data['jagung'] = $this->Admin_model->getJagung($tahun);
			    	$data['thn'] = $tahun;
			    	$this->load->view('admin/kelola_jagung_filter',$data);
			    }
		}
		else{
			redirect('login','refresh');
		}
	}

	public function tambah_admin()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['tahun'] = $this->Admin_model->getTahun();
			    $this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/tambah_admin',$data);
				}
				else
				{
					$this->Admin_model->addAdmin();
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('Admin/kelola_admin','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function tambah_user()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/tambah_user',$data);
				}
				else
				{
					$this->Admin_model->addUser();
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('Admin/kelola_user','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function tambah_jagung($tahun)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['lokasi'] = $this->Admin_model->getLokasi();

			    $this->form_validation->set_rules('fk_lokasi', 'Lokasi', 'trim|required');
				$this->form_validation->set_rules('produksi', 'Produksi', 'trim|required');
				$this->form_validation->set_rules('luas_panen', 'Luas Panen', 'trim|required');
				$this->form_validation->set_rules('produktivitas', 'Produktivitas', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/tambah_jagung',$data);
				}
				else
				{
					$this->Admin_model->addJagung($tahun);
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('Admin/kelola_jagung','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function tambah_lokasi()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $this->form_validation->set_rules('nama_lokasi', 'Lokasi', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/tambah_lokasi',$data);
				}
				else
				{
					$this->Admin_model->addLokasi();
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('Admin/kelola_lokasi','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function delete_admin($id_admin)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

					$this->Admin_model->deleteUser($id_admin);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('Admin/kelola_admin','refresh');
		}
		else{
			redirect('login','refresh');
		}
	}

	public function delete_user($id)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

					$this->Admin_model->deleteUser($id);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('Admin/kelola_user','refresh');
		}
		else{
			redirect('login','refresh');
		}
	}

	public function delete_lokasi($id_lokasi)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

					$this->Admin_model->deleteLokasi($id_lokasi);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('Admin/kelola_lokasi','refresh');
		}
		else{
			redirect('login','refresh');
		}
	}

	public function delete_jagung($id_tanaman)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

					$this->Admin_model->deleteJagung($id_tanaman);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('Admin/kelola_jagung','refresh');
		}
		else{
			redirect('login','refresh');
		}
	}

	public function edit_lokasi($id_lokasi)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['lokasi'] = $this->Admin_model->getLokasiById($id_lokasi);

			    $this->form_validation->set_rules('nama_lokasi', 'Lokasi', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/edit_lokasi',$data);
				}
				else
				{
					$this->Admin_model->edit_lokasi($id_lokasi);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('Admin/kelola_lokasi','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function edit_admin($id_admin)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['admin'] = $this->Admin_model->getAdminById($id_admin);

			    $this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/edit_admin',$data);
				}
				else
				{
					$this->Admin_model->edit_admin($id_admin);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('Admin/kelola_admin','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function edit_user($id)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['user'] = $this->Admin_model->getUserById($id);

			    $this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/edit_user',$data);
				}
				else
				{
					$this->Admin_model->edit_user($id);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('Admin/kelola_user','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function edit_jagung($id_tanaman)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['jagung'] = $this->Admin_model->getJagungById($id_tanaman);
				$data['tahun'] = $this->Admin_model->getTahun();
				$data['lokasi'] = $this->Admin_model->getLokasi();

			    $this->form_validation->set_rules('fk_lokasi', 'Lokasi', 'trim|required');
				$this->form_validation->set_rules('produksi', 'Produksi', 'trim|required');
				$this->form_validation->set_rules('luas_panen', 'Luas Panen', 'trim|required');
				$this->form_validation->set_rules('produktivitas', 'Produktivitas', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/edit_jagung',$data);
				}
				else
				{
					$this->Admin_model->edit_jagung($id_tanaman);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('Admin/kelola_jagung','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function form(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->Admin_model->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->load->view('Admin/form', $data);
	}

	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					'fk_lokasi'=>$row['A'],
					'produksi'=>$row['B'], 
					'luas_panen'=>$row['C'], 
					'produktivitas'=>$row['D'],
					'tahun'=>$row['E'],
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->Admin_model->insert_multiple($data);
		
		redirect("Admin/kelola_jagung"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

	public function dataapi()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				// $data['jagung'] = $this->Admin_model->getJagungById($id_tanaman);
				$data['tahun'] = $this->Admin_model->getTahun();
				$data['lokasi'] = $this->Admin_model->getLokasi();

			    $this->form_validation->set_rules('hidden', 'Hidden', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/dataapi',$data);
				}
				else
				{
					$tahun_awal = $this->input->post('tahun_awal');
					$tahun_akhir = $this->input->post('tahun_akhir');
					// $this->Admin_model->edit_jagung($id_tanaman);
					// echo "<script>alert('Update Data Berhasil')</script>";
					$base_url = base_url('index.php/Admin/apiluaspanen/'.$tahun_awal.'/'.$tahun_akhir);
					echo "<script>window.open('".$base_url."','_blank');</script>";
					$base_url2 = base_url('index.php/Admin/apiproduksi/'.$tahun_awal.'/'.$tahun_akhir);
					echo "<script>window.open('".$base_url2."','_blank');</script>";
					$base_url3 = base_url('index.php/Admin/apiproduktivitas/'.$tahun_awal.'/'.$tahun_akhir);
					echo "<script>window.open('".$base_url3."','_blank');</script>";
					// redirect('Admin/api/'.$tahun_awal.'/'.$tahun_akhir,'refresh');
					redirect('Admin/dataapi','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function apiluaspanen($tahun_awal,$tahun_akhir)
	{

		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;

				$curl = curl_init();

			  curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://aplikasi2.pertanian.go.id/bdsp/id/lokasi/result/",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "subsektor=01&level=03&prov=35&satuan=3&sts_angka=6&sumb_data=00&tahunAwal=".$tahun_awal."&tahunAkhir=".$tahun_akhir."&subsektorcd=01&subsektornm=Tanaman+Pangan&level=03&levelnm=Kabupaten&prov=35&provnm=Jawa+Timur&sts_angka=6&sts_angkanm=Angka+Tetap&sumb_data=00&sumb_datanm=--+Pilih+Sumber+Data+--&satuannm=Ha++++++++++++++++++&komoditas=01027&komoditasnm=JAGUNG&indikator=0103&indikatornm=LUAS+PANEN++++",
			  CURLOPT_COOKIE => "ci_session=0876153d6f3dbcef7dffff0609cb88513615d14f",
			  CURLOPT_HTTPHEADER => array(
			    "accept: */*",
			    "accept-encoding: gzip, deflate, br",
			    "accept-language: id,en-US;q=0.7,en;q=0.3",
			    "connection: keep-alive",
			    "content-length: 381",
			    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
			    "cookie: _ga=GA1.3.1607154194.1544102543; _gid=GA1.3.1496625.1552262066; ci_session=b72ce42b8fbaecc5b59973778929cef59b848247; _gat_gtag_UA_107417379_1=1",
			    "host: aplikasi2.pertanian.go.id",
			    "referer: https://aplikasi2.pertanian.go.id/bdsp/id/lokasi",
			    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0",
			    "x-requested-with: XMLHttpRequest"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			// $resp = json_decode($response, TRUE);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
				$data['response'] = $response;
				$this->load->view('admin/dataapihasil', $data);
			  // echo $response;
			}
					
		}
		else{
			redirect('login','refresh');
		}
	}

	public function apiproduksi($tahun_awal,$tahun_akhir)
	{

		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;

				$curl = curl_init();

			  curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://aplikasi2.pertanian.go.id/bdsp/id/lokasi/result/",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "subsektor=01&level=03&prov=35&satuan=20&sts_angka=6&sumb_data=00&tahunAwal=".$tahun_awal."&tahunAkhir=".$tahun_akhir."&subsektorcd=01&subsektornm=Tanaman+Pangan&level=03&levelnm=Kabupaten&prov=35&provnm=Jawa+Timur&sts_angka=6&sts_angkanm=Angka+Tetap&sumb_data=00&sumb_datanm=--+Pilih+Sumber+Data+--&satuannm=Ton+++++++++++++++++&komoditas=01027&komoditasnm=JAGUNG&indikator=0104&indikatornm=PRODUKSI++++++++++++++++++++++++++++++++++++++++++++++++++++",
			  CURLOPT_COOKIE => "ci_session=5bb3ded03c9cc94b09e689ce7ca956af74154cd8",
			  CURLOPT_HTTPHEADER => array(
			    "accept: */*",
			    "accept-encoding: gzip, deflate, br",
			    "accept-language: id,en-US;q=0.7,en;q=0.3",
			    "connection: keep-alive",
			    "content-length: 428",
			    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
			    "cookie: _ga=GA1.3.1607154194.1544102543; _gid=GA1.3.1496625.1552262066; ci_session=5bb3ded03c9cc94b09e689ce7ca956af74154cd8; _gat_gtag_UA_107417379_1=1",
			    "host: aplikasi2.pertanian.go.id",
			    "referer: https://aplikasi2.pertanian.go.id/bdsp/id/lokasi",
			    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0",
			    "x-requested-with: XMLHttpRequest"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
				$data['response'] = $response;
				$this->load->view('admin/dataapihasil', $data);
			  // echo $response;
			}
					
		}
		else{
			redirect('login','refresh');
		}
	}

	public function apiproduktivitas($tahun_awal,$tahun_akhir)
	{

		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;

				$curl = curl_init();

			  curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://aplikasi2.pertanian.go.id/bdsp/id/lokasi/result/",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "subsektor=01&level=03&prov=35&satuan=9&sts_angka=6&sumb_data=00&tahunAwal=".$tahun_awal."&tahunAkhir=".$tahun_akhir."&subsektorcd=01&subsektornm=Tanaman+Pangan&level=03&levelnm=Kabupaten&prov=35&provnm=Jawa+Timur&sts_angka=6&sts_angkanm=Angka+Tetap&sumb_data=00&sumb_datanm=--+Pilih+Sumber+Data+--&satuannm=Ku%2FHa+++++++++++++++&komoditas=01027&komoditasnm=JAGUNG&indikator=0105&indikatornm=PRODUKTIVITAS+++++++++++++++++++++++++++++++++++++++++++++++",
			  CURLOPT_COOKIE => "ci_session=5bb3ded03c9cc94b09e689ce7ca956af74154cd8",
			  CURLOPT_HTTPHEADER => array(
			    "accept: */*",
			    "accept-encoding: gzip, deflate, br",
			    "accept-language: id,en-US;q=0.7,en;q=0.3",
			    "connection: keep-alive",
			    "content-length: 428",
			    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
			    "cookie: _ga=GA1.3.1607154194.1544102543; _gid=GA1.3.1496625.1552262066; ci_session=5bb3ded03c9cc94b09e689ce7ca956af74154cd8; _gat_gtag_UA_107417379_1=1",
			    "host: aplikasi2.pertanian.go.id",
			    "referer: https://aplikasi2.pertanian.go.id/bdsp/id/lokasi",
			    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0",
			    "x-requested-with: XMLHttpRequest"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
				$data['response'] = $response;
				$this->load->view('admin/dataapihasil', $data);
			  // echo $response;
			}
					
		}
		else{
			redirect('login','refresh');
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */