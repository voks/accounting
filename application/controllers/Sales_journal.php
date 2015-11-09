<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_journal extends CI_Controller {

	public function index(){
		$this->load->model('journal_sj_model');
		$this->load->model('subsidiary_account_model');
		$this->load->model('site_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Journal',
				'page_title' 	=> 'Sales Journal'
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar');
			$viewData = array(
				'journal_sj' => $this->journal_sj_model->show_customer(),
				'account_title' => $this->subsidiary_account_model->get_accounts(),
				'all_accounts' => $this->site_model->load_all_accounts()
				);
			$this->load->view('modules/sales_journal', $viewData);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		$this->load->model('journal_sj_model');
		$this->load->model('subsidiary_account_model');
		$this->load->model('site_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Journal');
			$this->session->set_userdata('page_title', 'Sales Journal');
			$this->session->set_userdata('current_page', 'sales_journal');
			$viewData = array(
				'journal_sj' => $this->journal_sj_model->show_customer(),
				'account_title' => $this->subsidiary_account_model->get_accounts(),
				'all_accounts' => $this->site_model->load_all_accounts()
				);
			$this->load->view('modules/sales_journal', $viewData);
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function save_journal_sj(){
		$this->load->model('journal_sj_model');
		$this->load->model('site_model');
		$journal_sj_data = $this->input->post('sj');
		$ap_entry = $this->input->post('ap_entry');
		$err = validates(array($journal_sj_data), array());

		if (count($err)) {
			echo jcode(array(
				'success' 	=> 3,
				'err' 		=> $err
				));
		} else {
			$siNo = isset($journal_sj_data['sj_si_no']) ? $journal_sj_data['sj_si_no']: '';
			$check_id = $this->journal_sj_model->journal_sj_exist($siNo);
			
			if ($check_id) {
				echo jcode(array('success' => 2));
			} else {
				$trans_data = array(
					'project_id' 		=> $this->session->userdata('project_id'),
					'sj_si_date' 		=> $journal_sj_data['sj_si_date'],
					'sj_si_no'			=> $journal_sj_data['sj_si_no'],
					'sj_master_name'	=> substr($journal_sj_data['sj_master_name'],8),
					'sj_terms'			=> $journal_sj_data['sj_terms'],
					'sj_si_amount'		=> real_value($journal_sj_data['sj_si_amount']),
					'sj_particulars'	=> $journal_sj_data['sj_particulars'],
					'total_debit'		=> real_value($journal_sj_data['total_debit']),
					'total_credit'		=> real_value($journal_sj_data['total_credit'])
					);
				$trans_id = $this->journal_sj_model->journal_sj_add($trans_data);

				for ($i = 0;$i<count($ap_entry['code']);$i++) {						
						// $data = array(
						// 						'sj_id' 				=> $trans_id, 
						// 						'project_id'			=> $this->session->userdata('project_id'),
						// 						'sj_trans_account_code' => $ap_entry['code'][$i],
						// 						'sj_trans_sub_name'		=> $ap_entry['accname'][$i],
						// 						'sj_trans_dr'			=> $ap_entry['accdebit'][$i],
						// 						'sj_trans_cr'			=> $ap_entry['acccredit'][$i]
						// 					);
					$account_group = $this->site_model->get_group_account(substr($ap_entry['code'][$i],0,5));	
					$data = array(
						'project_id'			=> $this->session->userdata('project_id'),
						'trans_id' 				=> $trans_id, 
						'trans_date'			=> $journal_sj_data['sj_si_date'],
						'account_code'			=> substr($ap_entry['code'][$i],0,5),
						'sub_code' 				=> $ap_entry['code'][$i],
						'account_name'		    => $ap_entry['accname'][$i],
						'trans_dr'				=> real_value($ap_entry['accdebit'][$i]),
						'trans_cr'				=> real_value($ap_entry['acccredit'][$i]),
						'trans_journal'			=> 'sj',
						'account_group'			=> $account_group[0]['account_group']
						);
					$this->journal_sj_model->journal_sj_trans_add($data);
				}
				echo jcode(array('success' => 1));
			}
		}
	}

	public function search_sj(){
		$this->load->model('journal_sj_model');
		$account_search = $this->input->post('searchSJ');
		$data = $this->journal_sj_model->journal_sj_get($account_search['searchSJ_siNo'],$account_search['searchSJ_siDate_frm'],$account_search['searchSJ_siDate_to']);
		$data_total = $this->journal_sj_model->journal_sj_get_total($account_search['searchSJ_siNo'],$account_search['searchSJ_siDate_frm'],$account_search['searchSJ_siDate_to']);
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
							<td class='col-md-1'>".$key->sj_si_no."</td>
							<td class='col-md-1'>".$key->sj_si_date."</td>
							<td class='col-md-3'>".$key->sj_master_name."</td>
							<td class='col-md-4'>".$key->sj_particulars."</td>
							<td class='col-md-1'>".number_format($key->sj_si_amount,2)."</td>
							<td class='col-md-1'><a href='#' data-id='$key->sj_id' class='btn-style-1 account-report-print animate-4 pull-right'><i class='fa fa-print'></i></a></td>
							<td class='col-md-1'><a href='#' data-id='$key->sj_id' class='btn-style-1 animate-4 pull-left account-report-edit'><i class='fa fa-edit'></i></a></td>
						</tr>
						";
					}
					foreach ($data_total->result() as $key) {
						$html .="
						<tr>
							<td class='col-md-1'>TOTAL</td>
							<td class='col-md-1'></td>
							<td class='col-md-3'></td>
							<td class='col-md-4'></td>
							<td class='col-md-1'>".number_format($key->tot_amt,2)."</td>
						</tr>
						";
					}
					echo jcode(array('success' => 1,'response' => $html));
				}
				
			}
	}

	public function sj_report(){
		$this->load->model('journal_sj_model');
		if ($this->session->userdata('islogged')) {
			$id = (int)$this->input->get('id');
			$html = $this->config->item('report_header');
			$viewData = array(
				'sj_entries' => $this->journal_sj_model->journal_get_entries($id)
				);
			$html.= $this->load->view('report/sj_entries', $viewData, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			echo jcode(array('success' => 1));
		}
	}

	public function sj_summary_report(){
		$this->load->model("journal_sj_model");
		if ($this->session->userdata('islogged')) {
			$sj_si_no 	= $this->input->get('si');
			$sj_si_date_frm	= $this->input->get('sidfrm');
			$sj_si_date_to	= $this->input->get('sidto');
			$html = $this->config->item('report_header');
			$data = array(
				'accounts' => $this->journal_sj_model->journal_sj_get($sj_si_no,$sj_si_date_frm,$sj_si_date_to)->result(),
				'accounts_total' => $this->journal_sj_model->journal_sj_get_total($sj_si_no,$sj_si_date_frm,$sj_si_date_to)->result()
				);
			$html.= $this->load->view('report/sj_search_report', $data, true);
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
				'page_title' 	=> 'Sales Journal'
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar');
			$viewData = array(
				'transdata' => $this->general_ledger_model->view_sj($id)->result()
				);
			$this->load->view('modules/edit_sales_journal', $viewData);
			$this->load->view('parts/footer');
			
		}
	}

	// Get all info of specific account for editting purposes (shows in modal) -mich
	public function show_sjinfo(){
		$this->load->model('journal_sj_model');
		$id = $this->input->post('sj_id');
		$data = $this->journal_sj_model->show_sjinfo($id);
		// print_r($this->db->last_query());
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
			array(
				'success' 	=> 1, 
				'response' 	=> $data,
				'html' 		=> $html 
				)
			);
	}
}
