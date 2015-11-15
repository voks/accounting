<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trial_balance extends CI_Controller {
	public function index(){
		$this->load->model('trial_balance_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Ledger',
				'page_title' 	=> 'Trial Balance'
				);
			//$this->load->view('parts/header',load_data($page_info));
			//$this->load->view('parts/sidebar',load_data($page_info));
			$trial = array();
			$assets = $this->trial_data('Assets');
			$liabilities = $this->trial_data('Liabilities');
			$capital = $this->trial_data('Capital');
			$revenue = $this->trial_data('Revenue');
			$expense = $this->trial_data('Expense');

			$trial = array_merge($assets,$liabilities,$capital,$revenue,$expense);
			 //print_r($trial);
			$test = array('trial' => $trial );			
			$this->load->view('modules/trial_balance', $test);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function trial_data($type,$date_fr,$date_to){
			$accounts = $this->trial_balance_model->get_title($type);
			$trial = array();
			foreach ($accounts as $key) {
					$sub = $this->trial_balance_model->get_sub($key->account_code,$date_fr,$date_to);
					if ($sub==0) {
						if ($this->trial_balance_model->checktrans($key->account_code)>0) {
							$account_code = $this->trial_balance_model->get_trans_main($key->account_code,$date_fr,$date_to); 
							foreach ($account_code as $data) {
								$trial[] = array(
													'code'  	=> $key->account_code,
													'subcode'	=> $data->sub_code,
													'title'		=> $data->account_name,
													'debit'		=> $data->sdebit,
													'credit'	=> $data->scredit
												);
								
							}
						}
					}
					else{
						foreach ($sub as $subkey) {
							if ($this->trial_balance_model->checktrans($subkey->sub_code)>0) {
								$account_code = $this->trial_balance_model->get_trans_sub($subkey->sub_code); 
								foreach ($account_code as $data) {
									$trial[] = array(
														'code'  	=> $key->account_code,
														'subcode'	=> $data->sub_code,
														'title'		=> $data->account_name,
														'debit'		=> $data->sdebit,
														'credit'	=> $data->scredit
													);
									
								}
							}
						}
					}
			}
			return $trial;
	}

	public function load_page(){
		$this->load->model('trial_balance_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Ledger');
			$this->session->set_userdata('page_title', 'Trial Balance');
			$this->session->set_userdata('current_page', 'trial_balance');

			$trial = array();
			$assets = $this->trial_data('Assets');
			$liabilities = $this->trial_data('Liabilities');
			$capital = $this->trial_data('Capital');
			$revenue = $this->trial_data('Revenue');
			$expense = $this->trial_data('Expense');

			$trial = array_merge($assets,$liabilities,$capital,$revenue,$expense);

			$test = array('trial' => $trial );			
			$this->load->view('modules/trial_balance', $test);
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function search_trial(){
		$this->load->model('trial_balance_model');
		$trial =  $this->input->post('trial');
		$account_code = $trial['ctr_acct'];
		$date_fr = $trial['from_date'];
		$date_to = $trial['to_date'];
		$trans = $trial['journal_type'];
		$html ='';

		$trial = array();
		$assets = $this->trial_data('Assets');
		$liabilities = $this->trial_data('Liabilities');
		$capital = $this->trial_data('Capital');
		$revenue = $this->trial_data('Revenue');
		$expense = $this->trial_data('Expense');

		$trial = array_merge($assets,$liabilities,$capital,$revenue,$expense);

		
		
	}

	public function trial_summary_report(){
		$this->load->model("trial_balance_model");
		if ($this->session->userdata('islogged')) {

			$ctr_acct 	= $this->input->get('in');
			$from_date 	= $this->input->get('invd');
			$to_date 	= $this->input->get('mn');

			$account_code = $this->input->get('in');
			$date_fr = $this->input->get('invd');
			$date_to = $this->input->get('mn');
			$trans = $this->input->get('trans');

			$html = $this->config->item('report_header');
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'filename');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}
}
