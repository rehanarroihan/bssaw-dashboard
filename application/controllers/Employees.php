<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in') == false){
			redirect('login');
		}
		$this->load->model('Employees_model');
	}

	public function index(){
		$data = array(
			'title' => 'Hello',
			'content_view' => 'employee_view'
		);
		$this->load->view('template_view', $data);
	}

	public function get(){
		echo json_encode($this->Employees_model->get());
	}

	public function insert() {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$this->Employees_model->insert(
			$data->full_name,
			$data->username,
			$data->password
		);

		$output = array(
			'success' => true
		);
		echo json_encode($output);
	}

	public function update() {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$this->Employees_model->update($data);

		$output = array(
			'success' => true
		); 
		echo json_encode($output);
	}

	public function delete(){
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$this->Employees_model->delete($data->id);
		
		$output = array(
			'success' => true
		);
		echo json_encode($output);
	}
}
