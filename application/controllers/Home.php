<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form','file');
		$this->load->library('form_validation');
		$this->load->model('Home_model');
	}

	public function index()
	{
		$data['lokasi'] = $this->Home_model->getLokasi();
		$this->load->view('home/home',$data);
	}

	public function filter_grafik()
	{
		$data['lokasi'] = $this->Home_model->getLokasi();
		$this->form_validation->set_rules('hidden', 'Lokasi', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['error'] = "Pilih Tahun";
			$this->load->view('home/home', $data);
		} else {
			$lokasi = $this->input->post('lokasi');
			$data['jagung'] = $this->Home_model->getJagungByLokasi($lokasi);
			$data['lks'] = $lokasi;
			$this->load->view('home/home_filter',$data);
		}
	}

}

/* End of file Awal.php */
/* Location: ./application/controllers/Awal.php */