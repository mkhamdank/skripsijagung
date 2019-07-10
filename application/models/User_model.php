<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function getJagung($tahun)
	{
		$this->db->where('tahun', $tahun);
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join');
		return $this->db->get('tanaman')->result();
	}

	public function getTahun()
	{
		$this->db->distinct();
		$this->db->group_by('tahun');
		return $this->db->get('tanaman')->result();
	}

	public function getJagungByLokasi($lokasi)
	{
		$this->db->where('fk_lokasi', $lokasi);
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join');
		return $this->db->get('tanaman')->result();
	}

	public function getLokasi()
	{
		return $this->db->get('lokasi')->result();
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */