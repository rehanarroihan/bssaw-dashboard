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
		$data = array(
			'title' => 'Hello',
			'content_view' => 'tasks_view'
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
			$data->id_user,
		);

		$output = array(
			'success' => true
		);
		echo json_encode($output);
	}

	public function get($id_user){
		echo json_encode($this->Tasks_model->get($id_user));
	}
}
