<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_settings extends CI_Controller {

	public function index(){
		if ($this->session->userdata('islogged')) {
			$page_info = array(
								'page_tab' 		=> '',
								'page_title'	=> '' 
							  );
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$this->load->view('modules/account_settings');
			$this->load->view('parts/footer');
		}
		else{
			redirect('login');
		}
	}

	public function load_page(){
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Administrator');
			$this->session->set_userdata('page_title', 'Account Settings');
			$this->session->set_userdata('current_page', 'account_settings');
			$this->load->view('modules/account_settings');
		}
		else{
			redirect('login');
		}
	}

}
