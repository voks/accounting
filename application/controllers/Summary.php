<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summary extends CI_Controller {
	public function index(){
		if ($this->session->userdata('islogged')) {
			$page_info = array(
								'page_tab' 		=> 'Reports',
								'page_title'	=> 'Summary' 
							  );
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$this->load->view('modules/summary');
			$this->load->view('parts/footer');
		}
		else{
			redirect('login');
		}
	}

	public function load_page(){

		if ($this->session->userdata('islogged')) {
			$this->load->view('modules/summary');
		}else{
			redirect('login');
		}
	}
}
