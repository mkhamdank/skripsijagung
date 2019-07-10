<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function getLokasi()
	{
		return $this->db->get('lokasi')->result();
	}

	public function getJagungByLokasi($lokasi)
	{
		$this->db->where('fk_lokasi', $lokasi);
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join');
		return $this->db->get('tanaman')->result();
	}

}

/* End of file Home_model.php */
/* Location: ./application/models/Home_model.php */