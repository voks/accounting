<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aging extends CI_Controller {
	public function index(){
		if ($this->session->userdata('islogged')) {
			$page_info = array(
								'page_tab' 		=> 'Reports',
								'page_title'	=> 'Aging' 
							  );
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$this->load->view('modules/aging');
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){

		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Reports');
			$this->session->set_userdata('page_title', 'Aging');
			$this->session->set_userdata('current_page', 'aging');
			$this->load->view('modules/aging');
		}else{
			echo jcode(array('success' => 1));
		}
	}

        public function report(){
		if ($this->session->userdata('islogged')) {
			$report_type = $this->input->get('rt');
			$html = $this->config->item('report_header');

			if ($report_type == 1) {
				$viewData = array();
				$html.= $this->load->view('report/aging_payables_report', $viewData, true);
			} elseif ($report_type == 2) {
				$viewData = array();
				$html.= $this->load->view('report/aging_receivables_report', $viewData, true);
			} 

			$html.= $this->config->item('report_footer');
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			echo jcode(array('success' => 1));
		}
	}


}
