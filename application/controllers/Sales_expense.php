<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_expense extends CI_Controller {
	public function index(){
		if ($this->session->userdata('islogged')) {
			$page_info = array(
								'page_tab' 		=> 'Reports',
								'page_title'	=> 'Sales and Expense' 
							  );
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$this->load->view('modules/sales_expense');
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){

		if ($this->session->userdata('islogged')) {
			$this->load->view('modules/sales_expense');
		}else{
			echo jcode(array('success' => 1));
		}
	}
}
