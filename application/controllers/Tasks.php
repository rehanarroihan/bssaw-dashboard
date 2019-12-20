<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	public function index(){
		$data = array(
			'title' => 'Hello',
			'content_view' => 'tasks_view'
		);
		$this->load->view('template_view', $data);
	}
}
