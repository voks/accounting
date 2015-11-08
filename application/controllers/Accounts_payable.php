<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_payable extends CI_Controller {
	
	public function index(){
		$this->load->model('journal_ap_model');
		$this->load->model('bank_recon_model');
		$this->load->model('subsidiary_account_model');
		$this->load->model('site_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Journal',
				'page_title'	=> 'Accounts Payable' 
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar');
			$viewData = array(
				'accounts_payable' => $this->journal_ap_model->show_expense_name(),
				'bank_recon' => $this->bank_recon_model->show_supplier(),
				'account_title' => $this->subsidiary_account_model->get_accounts(),
				'all_accounts' => $this->site_model->load_all_accounts()
				);
			$this->load->view('modules/accounts_payable', $viewData);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		$this->load->model('journal_ap_model');
		$this->load->model('bank_recon_model');
		$this->load->model('subsidiary_account_model');
		$this->load->model('site_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Journal');
			$this->session->set_userdata('page_title', 'Accounts Payable');
			$this->session->set_userdata('current_page', 'accounts_payable');
			$viewData = array(
				'accounts_payable' => $this->journal_ap_model->show_expense_name(),
				'bank_recon' => $this->bank_recon_model->show_supplier(),
				'account_title' => $this->subsidiary_account_model->get_accounts(),
				'all_accounts' => $this->site_model->load_all_accounts()
				);
			$this->load->view('modules/accounts_payable', $viewData);
		}else{
			echo jcode(array('success' => 1));
		}
	}

	public function save_journal_ap(){
		$this->load->model('journal_ap_model');
		$this->load->model('site_model');
		$journal_ap_data = $this->input->post('ap');
		$ap_entry = $this->input->post('ap_entry');
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
				$trans_data = array(
					'project_id' 		=> $this->session->userdata('project_id'),
					'ap_invoice_no' 	=> $journal_ap_data['ap_invoice_no'],
					'ap_invoice_date'	=> $journal_ap_data['ap_invoice_date'],
					'ap_po_no'			=> $journal_ap_data['ap_po_no'],
					'ap_terms'			=> $journal_ap_data['ap_terms'],
					'ap_master_name'	=> substr($journal_ap_data['ap_master_name'],8),
					'ap_invoice_amount'	=> real_value($journal_ap_data['ap_invoice_amount']),
					'ap_particulars'	=> $journal_ap_data['ap_particulars'],
					'total_debit'		=> real_value($journal_ap_data['total_debit']),
					'total_credit'		=> real_value($journal_ap_data['total_credit'])
					);
				$trans_id = $this->journal_ap_model->journal_ap_add($trans_data);

				for ($i = 0;$i<count($ap_entry['code']);$i++) {		
					$account_group = $this->site_model->get_group_account(substr($ap_entry['code'][$i],0,5));				
					$data = array(
						'project_id'			=> $this->session->userdata('project_id'),
						'trans_id' 				=> $trans_id, 
						'trans_date'			=> $journal_ap_data['ap_invoice_date'],
						'account_code'			=> substr($ap_entry['code'][$i],0,5),
						'sub_code' 				=> $ap_entry['code'][$i],
						'account_name'		    => $ap_entry['accname'][$i],
						'trans_dr'				=> real_value($ap_entry['accdebit'][$i]),
						'trans_cr'				=> real_value($ap_entry['acccredit'][$i]),
						'trans_journal'			=> 'ap',
						'account_group'			=> $account_group[0]['account_group']
						);
					$this->journal_ap_model->journal_ap_trans_add($data);
				}
				
				echo jcode(array('success' => 1));
			}
			
		}
	}

	public function search_ap(){
		$this->load->model('journal_ap_model');
		$account_search = $this->input->post('searchAP');
		$data = $this->journal_ap_model->journal_ap_get($account_search['searchAP_invNo'], $account_search['searchAP_date_frm'], $account_search['searchAP_date_to']);
		$data_total = $this->journal_ap_model->journal_ap_get_total($account_search['searchAP_invNo'], $account_search['searchAP_date_frm'], $account_search['searchAP_date_to']);
		$html = "";
		$err = validates(array($account_search), array());
		
		
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
						<td class='col-md-2'>".$key->ap_invoice_no."</td>
						<td class='col-md-2'>".$key->ap_invoice_date."</td>
						<td class='col-md-3'>".$key->ap_master_name."</td>
						<td class='col-md-4'>".$key->ap_particulars."</td>
						<td class='col-md-2 text-right'>".number_format($key->ap_invoice_amount,2)."</td>
						<td class='col-md-1'><a href='#' data-id='".$key->ap_id."' class='btn-style-1 animate-4 pull-right account-report-print'><i class='fa fa-print'></i></a></td>
						<td class='col-md-1'><a href='#' data-id='".$key->ap_id."' data-invdate='".$key->ap_invoice_date."' data-invno='".$key->ap_invoice_no."' data-po='".$key->ap_po_no."' data-terms='".$key->ap_terms."' data-supp='".$key->ap_master_name."' data-invamt='".$key->ap_invoice_amount."' data-part='".$key->ap_particulars."' class='btn-style-1 animate-4 pull-left account-report-edit'><i class='fa fa-edit'></i></a></td>
					</tr>
					";
				}
				foreach ($data_total->result() as $key) {
					$html .="
					<tr>
						<td class='col-md-2'>TOTAL</td>
						<td class='col-md-2'></td>
						<td class='col-md-3'></td>
						<td class='col-md-4'></td>
						<td class='col-md-2 text-right'>".number_format($key->tot_amt,2)."</td>
					</tr>
					";
				}
				echo jcode(array('success' => 1,'response' => $html));
			}

		}
		
	}

	public function ap_report(){
		$this->load->model('journal_ap_model');
		if ($this->session->userdata('islogged')) {
			$id = (int)$this->input->get('id');
			$html = $this->config->item('report_header');
			$viewData = array(
				'ap_entries' => $this->journal_ap_model->journal_get_entries($id)
				);
			$html.= $this->load->view('report/ap_entries', $viewData, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			echo jcode(array('success' => 1));
		}
	}

	public function ap_summary_report(){
		$this->load->model("journal_ap_model");
		if ($this->session->userdata('islogged')) {
			
			$ap_invoice_no 		= $this->input->get('in');
			$ap_invoice_date 	= $this->input->get('invd');
			$ap_master_name 	= $this->input->get('mn');
			$ap_po_no 			= $this->input->get('po');
			$html = $this->config->item('report_header');

			$data = array(
				'accounts' => $this->journal_ap_model->journal_ap_get($ap_invoice_no,$ap_invoice_date,$ap_master_name,$ap_po_no)->result(),
				'accounts_total' => $this->journal_ap_model->journal_ap_get_total($ap_invoice_no,$ap_invoice_date,$ap_master_name,$ap_po_no)->result()
				);
			$html.= $this->load->view('report/ap_search_report', $data, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'filename');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function view_trans(){
		$this->load->model('general_ledger_model');
		if ($this->session->userdata('islogged')) {
			$id = (int)$this->input->get('id'); 
			$page_info = array(
				'page_tab' 		=> 'Journal',
				'page_title'	=> 'Accounts Payable' 
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar');
			$viewData = array(
				'transdata' => $this->general_ledger_model->view_ap($id)->result()
				);
			$this->load->view('modules/edit_accounts_payable', $viewData);
			$this->load->view('parts/footer');
		}

	}

	// Showing of all chart of accounts
	public function load_all_accounts(){
		$this->load->model('site_model');
		$data = $this->site_model->load_all_accounts();
		// print_r($this->db->last_query());
		$html = "";
		foreach ($data->result() as $key) {
			$html .="
			<tr>
				<td>".$key->title."</td>
				<td>".$key->code."</td>
			</tr>
			";
		}
	}

	// Get all info of specific account for editting purposes (shows in modal) -mich
	public function show_apinfo(){
		$this->load->model('journal_ap_model');
		$id = $this->input->post('ap_id');
		$data = $this->journal_ap_model->show_apinfo($id);
		$html = "";
		foreach ($data as $key) {
			$html .="
			<tr>
				<td>".$key->sub_code."</td>
				<td>".$key->account_name."</td>
				<td><input type='text' class='form-control text-right' value='".number_format($key->trans_dr,2)."'></td>
				<td><input type='text' class='form-control text-right' value='".number_format($key->trans_cr,2)."'></td>
			</tr>
			";
		}
		echo jcode(
			array('success' => 1, 
				'response' => $data,
				'html' => $html 
				)
			);
	}

}