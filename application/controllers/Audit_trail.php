<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_trail extends CI_Controller {
	public function index(){
		if ($this->session->userdata('islogged')) {
			$page_info = array(
								'page_tab' 		=> 'Administrator',
								'page_title'	=> 'Audit Trail' 
							  );
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$this->load->view('modules/audit_trail');
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){

		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Administrator');
			$this->session->set_userdata('page_title', 'Audit Trail');
			$this->session->set_userdata('current_page', 'audit_trail');
			$this->load->view('modules/audit_trail');
		}else{
			echo jcode(array('success' => 1));
		}
	}
}
