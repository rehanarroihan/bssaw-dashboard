<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function getReport($timeStart, $timeEnd) {
		$taskListQuery = $this->db
							->select('tasks.id AS id_task, type, start_time, end_time, users.id AS id_user, users.full_name')
							->where("start_time >=", $timeStart)
							->where("end_time <=", $timeEnd)
							->join('users', 'users.id = tasks.id_user')
							->order_by('start_time', 'desc')
							->get('tasks')->result();
		$result = [
			"summary" => $this->getSummary(),
			"data" => $taskListQuery
		];
		return $result;
	}
    
    private function getSummary(){
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

	public function getDashboardData() {
		// db time format Y/m/d H:i:s
		$now = date("Y/m/d H:i:s");
		$runningTaskQuery = $this->db
								->where('start_time <', $now)
								->where('end_time >', $now)
								->get('tasks')->num_rows();
		$firstTaskDate = $this->db
								->order_by('start_time', 'asc')
								->get('tasks')->result();
		$lastTaskDate = $this->db
								->order_by('end_time', 'desc')
								->get('tasks')->result();
		$result = [
			"employees" => $this->db->where('role', 'EMPLOYEE')->get('users')->num_rows(),
			"running_tasks" => $runningTaskQuery,
			"first_task_date" => $firstTaskDate[0]->start_time,
			"last_task_date" => $lastTaskDate[0]->end_time
		];
		return $result;
	}
}