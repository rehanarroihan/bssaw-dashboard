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
    
    public function get(){
        return $this->db
                    ->select('id AS id_user, full_name, username')
                    ->where('role', 'EMPLOYEE')
                    ->get('users')
                    ->result();
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