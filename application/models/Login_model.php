<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password',base64_encode($password));
		$query = $this->db->get('user');
		if($query->num_rows()==1){
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function register()
	{
		$object = array('username' => $this->input->post('username'),
		'password' => base64_encode($this->input->post('password')),
		'nama' => $this->input->post('nama'),
		'email' => $this->input->post('email'),
		'level' => '2' );
		$this->db->insert('user', $object);
	}
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */