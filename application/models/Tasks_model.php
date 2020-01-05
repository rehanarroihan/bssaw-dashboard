<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks_model extends CI_Model {

    public function insert($type, $start_time, $end_time, $id_user){
		$data = array(
			'type' => $type,
			'start_time'  => $start_time,
            'end_time'  => $end_time,
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
        if ($id_user != null) {
            $query = $this->db
                    ->select('id, type, start_time', 'end_time')
                    ->where('id_user', $id_user)
                    ->get('tasks')
                    ->result();
        } else {
            $query = $this->db
                    ->select('id, type, start_time, end_time')
                    ->get('tasks')
                    ->result();
        }
        return $query;
    }
	
	public function update($id, $label){
		$data = array(
			'label'		=> $label,
			'slug'		=> strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $label)))
		);

		$this->db->where('id', $id)->update('sport_match', $data);
		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
    }
	
	public function delete($id){
        return $this->db->where('id', $id)->delete('sport_match');
    }

    // Transaction
    public function insertTransaction($array){
		$this->db->insert('purchase_order', $array);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
    }
    
    // PDF
    public function reportData() {
        $categoryList = $this->db->get('sport_category')->result();
        return array(
            'category' => $categoryList,
            'match' => $this->get(),
        );
        
    }
}