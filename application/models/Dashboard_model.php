<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    
    public function getSummary(){
		$result = [
			"maintenance" => $this->taskTypeCount('MAINTENANCE'),
			"installation" => $this->taskTypeCount('INSTALLATION'),
			"preventive" => $this->taskTypeCount('PREVENTIVE'),
			"visit" => $this->taskTypeCount('VISIT'),
			"bts" => $this->taskTypeCount('BTS'),
		];
        return $result;
	}
	
	private function taskTypeCount($type) {
		return $this->db->where('type', $type)->get('tasks')->num_rows();
	}
}