<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_payable extends CI_Controller {
	public function index(){
		$this->load->model('journal_ap_model');
		$this->load->model('bank_recon_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Journal',
				'page_title'	=> 'Accounts Payable' 
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar');
			$viewData = array(
				'accounts_payable' => $this->journal_ap_model->show_expense_name(),
				'bank_recon' => $this->bank_recon_model->show_supplier()
			);
			$this->load->view('modules/accounts_payable', $viewData);
			$this->load->view('parts/footer');
		}
		else{
			redirect('login');
		}
	}

	public function load_page(){
		$this->load->model('journal_ap_model');
		$this->load->model('bank_recon_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Journal');
			$this->session->set_userdata('page_title', 'Accounts Payable');
			$this->session->set_userdata('current_page', 'accounts_payable');
			$viewData = array(
				'accounts_payable' => $this->journal_ap_model->show_expense_name(),
				'bank_recon' => $this->bank_recon_model->show_supplier()
			);
			$this->load->view('modules/accounts_payable', $viewData);
		}else{
			redirect('login');
		}
	}

	public function save_journal_ap(){
		$this->load->model('journal_ap_model');
		$journal_ap_data = $this->input->post('ap');
		$err = validates(array($journal_ap_data), array());

		if (count($err)) {
			echo jcode(array(
				'success' => 3, 
				'err' 	  => $err
				)
			);
		} else {

			$invNo = isset($journal_ap_data['ap_invoice_no']) ? $journal_ap_data['ap_invoice_no']: '';
			$check_id = $this->journal_ap_model->journal_ap_exist($invNo);
			
			if ($check_id) {
				echo jcode(array('success' => 2));
			} else {
				$this->journal_ap_model->journal_ap_add($journal_ap_data);
				echo jcode(array('success' => 1));
			}
			
		}
	}

	public function search_ap(){
		$this->load->model('journal_ap_model');
		$account_search = $this->input->post('searchAP');
		$data = $this->journal_ap_model->journal_ap_get($account_search['searchAP_invNo'], $account_search['searchAP_date'], $account_search['searchAP_suppName'], $account_search['searchAP_po']);
		$html = "";

		$err = validates(array($account_search), array());
		
		if (count($err)) {
			if ($err<1) {
				echo jcode(array(
					'success' 	=> 3,
					'err' 		=> $err
					));
			} else {
				if (!$data->num_rows()) {
					echo jcode(array(
						'success' 	=> 2
						));
				} else {
					foreach ($data->result() as $key) {
						$html .="
						<tr>
							<td>".$key->ap_invoice_no."</td>
							<td>".$key->ap_master_name."</td>
							<td>".$key->ap_particulars."</td>
							<td>".$key->ap_invoice_amount."</td>
							<td><a href='#' class='btn-style-1 animate-4 pull-left'><i class='fa fa-print'></i></a></td>
						</tr>
						";
					}
					echo jcode(array('success' => 1,'response' => $html));
				}
				
			}
		}
	}

	public function search_chartaccount(){
		$this->load->model('site_model');
		$chart_search = $this->input->post('chart');
		$data = $this->site_model->search_chartaccount($chart_search['account_code'], $chart_search['account_title'], $chart_search['sub_code'], $chart_search['sub_name']);
		$html = "";
		// echo $this->db->last_query();
		$err = validates(array($chart_search), array());
		
		if (count($err)) {
			if ($err<1) {
				echo jcode(array(
					'success' 	=> 3,
					'err' 		=> $err
					));
			} else {
				if (!$data->num_rows()) {
					echo jcode(array(
						'success' 	=> 2
						));
				} else {
					foreach ($data->result() as $key) {
						$html .="
						<tr>
							<td><label><input type='checkbox' class='' value='0' id='check' data-subcode='".$key->sub_code."' data-subname='".$key->sub_name."'><label>	</td>
							<td>".$key->account_code."</td>
							<td>".$key->account_title."</td>
							<td>".$key->sub_code."</td>
							<td>".$key->sub_name."</td>
						</tr>
						";
					}
					echo jcode(array('success' => 1,'response' => $html));
				}
				
			}
		}
	}
}
