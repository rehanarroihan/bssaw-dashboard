<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function getReport($timeStart, $timeEnd, $taskType = "") {
		$reportQuery = $this->db
							->select('tasks.id AS id_task, start_time, end_time, users.id AS id_user, users.full_name, job_type.job_type AS type')
							->where("start_time >=", $timeStart)
							->where("end_time <=", $timeEnd)
							->join('users', 'users.id = tasks.id_user')
							->join('job_type', 'job_type.id = tasks.id_job_type')
							->order_by('start_time', 'desc')
							->get('tasks');
		if ($taskType != "") {
			$reportQuery = $this->db
							->select('tasks.id AS id_task, start_time, end_time, users.id AS id_user, users.full_name, job_type.job_type AS type')
							->where("start_time >=", $timeStart)
							->where("end_time <=", $timeEnd)
							->where("id_job_type", $taskType)
							->join('users', 'users.id = tasks.id_user')
							->join('job_type', 'job_type.id = tasks.id_job_type')
							->order_by('start_time', 'desc')
							->get('tasks');
		}
		$result = [
			"timeStart" => $timeStart,
			"timeEnd" => $timeEnd,
			"summary" => $this->getSummary($timeStart, $timeEnd),
			"data" => $reportQuery->result()
		];
		return $result;
	}
    
    private function getSummary($timeStart, $timeEnd){
		$result = [];
		$taskList = $this->db->get('job_type')->result();
		for ($i=0; $i < count($taskList); $i++) {
			$countQuery = $this->db->select('COUNT(*) as count')
									->where('id_job_type', $taskList[$i]->id)
									->where("start_time >=", $timeStart)
									->where("end_time <=", $timeEnd)
									->get('tasks')
									->result();
			array_push($result, array(
				"name" => $taskList[$i]->job_type,
				"count" => $countQuery[0]->count
			));
		}
		return $result;
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
			"first_task_date" => count($firstTaskDate) > 0 ? $firstTaskDate[0]->start_time : '',
			"last_task_date" => count($lastTaskDate) ? $lastTaskDate[0]->end_time : ''
		];
		return $result;
	}
}