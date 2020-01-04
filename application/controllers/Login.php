<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Login_model');
		if($this->session->userdata('logged_in') == true){
			redirect('dashboard');
		}
	}

	public function index() {
		$this->load->view('login_view');
    }
    
    public function dologin() {
        if($this->input->post('login')){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == true) {
				if($this->Login_model->userCheck() == true){
					$src = $this->input->get('src');
					if(!empty($src)){
						redirect($src);
					}else{
						if($this->session->userdata('role') == 'ADMIN') {
							redirect('dashboard');
						} else {
							redirect('tasks');
						}
                    }
				}else{
					$this->session->set_flashdata('announce', 'Invalid username or password');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('login');
			}
		} else {
            redirect('login');
        }
	}
}
