<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tasks_model');
		if($this->session->userdata('logged_in') != true){
			redirect('login');
		}
	}

	public function index(){
		$role = $this->session->userdata('role');
		$data = array(
			'title' => 'Hello',
			'content_view' => $role == 'ADMIN' ? 'admin_tasks_view' : 'tasks_view'
		);
		$this->load->view('template_view', $data);
	}

	public function insert() {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$this->Tasks_model->insert(
			$data->type,
			$data->start_time,
			$data->end_time,
			$data->note,
			$data->attachment,
			$data->id_user
		);

		$output = array(
			'success' => true
		);
		echo json_encode($output);
	}

	public function update() {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$this->Tasks_model->update($data);

		$output = array(
			'success' => true
		);
		echo json_encode($output);
	}

	public function uploadSingleFile() {
		$config['upload_path']          = './assets/upload/';
		$config['overwrite']						= true;
		$config['allowed_types']        = 'gif|jpg|png|docx|pptx|doc|pdf';
		$config['max_size']             = 8024; // 1MB

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file')) {
			echo $this->upload->data("file_name");
		}
	}

	public function get($id_user){
		echo json_encode($this->Tasks_model->get($id_user));
	}

	public function delete(){
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$this->Tasks_model->delete($data->id);
		
		$output = array(
			'success' => true
		);
		echo json_encode($output);
	}
}
