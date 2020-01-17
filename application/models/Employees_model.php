<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {

    public function insert($full_name, $username, $password){
		$data = array(
			'full_name' => $full_name,
			'username'  => $username,
            'password'  => md5($password),
            'role'      => 'EMPLOYEE'
		);

		$this->db->insert('users', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
    }

    public function update($param){
        $willSubmit = array();
        if ($param->isChangePassword) {
            $willSubmit = array(
                'full_name' => $param->full_name,
                'username'  => $param->username,
                'password'  => md5($param->password)
            );
        } else {
            $willSubmit = array(
                'full_name' => $param->full_name,
                'username'  => $param->username
            );
        }
		$this->db->where('id', $param->id_user)->update('users', $willSubmit);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
    }
    
    public function get(){
        return $this->db
                    ->select('id AS id_user, full_name, username')
                    ->where('role', 'EMPLOYEE')
                    ->get('users')
                    ->result();
    }
	
	public function delete($id){
        return $this->db->where('id', $id)->delete('users');
    }
}