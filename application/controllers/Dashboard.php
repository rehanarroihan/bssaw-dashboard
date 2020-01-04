<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Login_model');
		if($this->session->userdata('logged_in') == false){
			redirect('login');
		}
	}

	public function index(){
		$data = array(
			'title' => 'Hello',
			'content_view' => 'dashboard_view'
		);
		if ($this->session->userdata('role') == 'ADMIN') {
			$this->load->view('template_view', $data);
		} else {
			redirect('tasks');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
