<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaskType extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Task_type_model');
		if($this->session->userdata('logged_in') != true){
			redirect('login');
		}
	}

	public function index(){
		$role = $this->session->userdata('role');
		$data = array(
			'title' => 'Hello',
			'content_view' => 'task_type_view'
		);
		if ($this->session->userdata('role') == 'ADMIN') {
			$this->load->view('template_view', $data);
		} else {
			redirect('tasks');
		}
	}

	public function insert() {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$this->Task_type_model->insert($data->task_type_name);

		$output = array(
			'success' => true
		);
		echo json_encode($output);
	}

	public function update() {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$this->Task_type_model->update($data);

		$output = array(
			'success' => true
		);
		echo json_encode($output);
	}

	public function get(){
		echo json_encode($this->Task_type_model->get());
	}

	public function delete(){
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$this->Task_type_model->delete($data->id);
		
		$output = array(
			'success' => true
		);
		echo json_encode($output);
	}
}
