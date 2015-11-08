<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index(){
		if ($this->session->userdata('islogged')) {
			$page_info = array(
								'page_tab' 		=> 'Dashboard',
								'page_title'	=> 'Dashboard' 
							);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$this->load->view('modules/dashboard');
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Dashboard');
			$this->session->set_userdata('page_title', 'Dashboard');
			$this->session->set_userdata('current_page', 'dashboard');
			$this->load->view('modules/dashboard');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}
	
}
