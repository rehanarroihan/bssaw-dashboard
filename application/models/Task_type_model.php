<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_type_model extends CI_Model {

    public function insert($data){
        // get last position
        $lastPosition = $this->db->order_by('position', 'DESC')
                                    ->get('job_type', 1)
                                    ->row()->position;

		$data = array(
            'job_type' => $data,
            'position' => $lastPosition != null ? (int) $lastPosition + 1 : 0
		);

		$this->db->insert('job_type', $data);
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
                    ->select('id AS id_task_type, job_type, position')
                    ->order_by('position', 'ASC')
                    ->get('job_type')
                    ->result();
    }
	
	public function delete($id){
        return $this->db->where('id', $id)->delete('users');
    }
}