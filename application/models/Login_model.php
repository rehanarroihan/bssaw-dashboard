<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function userCheck(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$now = date('d-m-Y H:i:s');

		$kueri = $this->db->where('username', $username)->where('password', md5($password))->get('users');
		if($kueri->num_rows() > 0){
			$data = array(
				'username'	=> $kueri->row()->username,
				'logged_in'	=> true,
				'full_name'	=> $kueri->row()->full_name,
				'user_id'	=> $kueri->row()->id,
				'role'		=> $kueri->row()->role
			);
			
			$this->session->set_userdata($data);
			return true;
		}else{
			return false;
		}
	}

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */