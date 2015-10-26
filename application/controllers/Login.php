<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		if (!$this->session->userdata('islogged')) {
			$this->load->model('login_model');

			$data = array(
							'page_title' => 'Login'
						 );
			$projects = array(
								'project_list' => $this->login_model->project_list()
							 );
			$this->load->view('modules/login',load_data(array_merge($data,$projects)));
			$this->load->view('parts/footer');
		}
	}

	public function login_user(){
		$this->load->model('login_model');
		$count = $this->login_model->login_process($this->input->post('username'),$this->input->post('pwd'),$this->input->post('project_id'));
		if ($count->num_rows()) {		
			$data = $this->login_model->login_process($this->input->post('username'),$this->input->post('pwd'),$this->input->post('project_id'))->result_array();	
			$sessiondata = $this->login_model->session_data($data[0]['project_id'],$data[0]['user_id']);
			$this->session->set_userdata($sessiondata);
			echo jcode(array('success' => 1));
		}
		else{
			echo jcode(array('success' => 2));
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
