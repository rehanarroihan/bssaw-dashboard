<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks_model extends CI_Model {

    public function insert($type, $start_time, $end_time, $note, $attachment, $id_user){
		$data = array(
			'id_job_type' => $type,
			'start_time'  => $start_time,
            'end_time'  => $end_time,
            'note'  => $note,
            'attachment'  => $attachment,
            'id_user'      => $id_user
		);

		$this->db->insert('tasks', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
    }
    
    public function get($id_user){
        if ($id_user != "xx") {
            // INFO : non admin call
            $query = $this->db
                    ->select('tasks.id, start_time, end_time, note, attachment, job_type.job_type as type')
                    ->where('id_user', $id_user)
                    ->join('job_type', 'job_type.id = tasks.id_job_type')
                    ->get('tasks')
                    ->result();
        } else {
            // INFO : if called from admin task view, will bring "xx" param
            $query = $this->db
                ->select('tasks.id AS id, start_time, end_time, users.id AS id_user, users.full_name AS employee, tasks.attachment, tasks.note, job_type.job_type AS type')
                ->join('users', 'users.id = tasks.id_user')
                ->join('job_type', 'job_type.id = tasks.id_job_type')
                ->order_by('start_time', 'desc')
                ->get('tasks')->result();
        }
        return $query;
    }
	
	public function update($param){
        $willSubmit = array();
        if ($param->isEditFile) {
            $willSubmit = array(
                'type' => $param->type,
                'start_time'  => $param->start_time,
                'end_time'  => $param->end_time,
                'note' => $param->note,
                'attachment' => $param->attachment
            );
        } else {
            $willSubmit = array(
                'type' => $param->type,
                'start_time'  => $param->start_time,
                'end_time'  => $param->end_time,
                'note' => $param->note
            );
        }
		$this->db->where('id', $param->id_task)->update('tasks', $willSubmit);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
    }
	
	public function delete($id){
        return $this->db->where('id', $id)->delete('tasks');
    }
}