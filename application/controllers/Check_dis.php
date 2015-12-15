<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_dis extends CI_Controller {
	public function index(){
		$this->load->model('journal_cd_model');
		$this->load->model('subsidiary_account_model');
		$this->load->model('site_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Journal',
				'page_title'	=> 'Check Disbursement' 
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$viewData = array(
				'journal_cd' => $this->journal_cd_model->show_bank(),
				'account_title' => $this->subsidiary_account_model->get_accounts(),
				'all_accounts' => $this->site_model->load_all_accounts(),
				'v_num' => $this->journal_cd_model->get_last_vnum()
				);
			$this->load->view('modules/check_dis', $viewData);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		$this->load->model('journal_cd_model');
		$this->load->model('subsidiary_account_model');
		$this->load->model('site_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Journal');
			$this->session->set_userdata('page_title', 'Check Disbursement');
			$this->session->set_userdata('current_page', 'check_dis');
			$viewData = array(
				'journal_cd' => $this->journal_cd_model->show_bank(),
				'account_title' => $this->subsidiary_account_model->get_accounts(),
				'all_accounts' => $this->site_model->load_all_accounts(),
				'v_num' => $this->journal_cd_model->get_last_vnum()
				);
			$this->load->view('modules/check_dis', $viewData);
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function save_journal_cd(){
		$this->load->model('journal_cd_model');
		$this->load->model('site_model');
		$journal_cd_data = $this->input->post("cd");
		$ap_entry = $this->input->post('ap_entry');
		$err = validates(array($journal_cd_data), array('cd_cleared_date','cd_released_date'));

		if (count($err)) {
			echo jcode(array(
				'success'	=> 3,
				'err' 		=> $err
				));
		} else {
			$voucherNo = isset($journal_cd_data['cd_voucher_no']) ? $journal_cd_data['cd_voucher_no']: '';
			$check_id = $this->journal_cd_model->journal_cd_exist($voucherNo);
			
			if ($check_id) {
				echo jcode(array('success' => 2));
			} else {
				$trans_data = array(
					'project_id' 		=> (int)$this->session->userdata('project_id'),
					'cd_date' 			=> $journal_cd_data['cd_date'],
					'cd_voucher_no'		=> $journal_cd_data['cd_voucher_no'],
					'cd_payee_name'		=> $journal_cd_data['cd_payee_name'],
					'cd_check_no'		=> $journal_cd_data['cd_check_no'],
					'cd_master_name'	=> $journal_cd_data['cd_master_name'],
					// 'cd_released'		=> $journal_cd_data['cd_released'],
					// 'cd_released_date'	=> $journal_cd_data['cd_released_date'],
					// 'cd_cleared'		=> $journal_cd_data['cd_cleared'],
					// 'cd_cleared_date'	=> $journal_cd_data['cd_cleared_date'],
					'cd_check_amount'	=> real_value($journal_cd_data['cd_check_amount']),
					'cd_particulars'	=> $journal_cd_data['cd_particulars'],
					'total_debit'		=> real_value($journal_cd_data['total_debit']),
					'total_credit'		=> real_value($journal_cd_data['total_credit'])
					);
				$trans_id = $this->journal_cd_model->journal_cd_add($trans_data);

				for ($i = 0;$i<count($ap_entry['code']);$i++) {						

					$account_group = $this->site_model->get_group_account(substr($ap_entry['code'][$i],0,5));	
					$data = array(
						'project_id'			=> $this->session->userdata('project_id'),
						'trans_id' 				=> $trans_id, 
						'trans_date'			=> $journal_cd_data['cd_date'],
						'account_code'			=> substr($ap_entry['code'][$i],0,5),
						'sub_code' 				=> $ap_entry['code'][$i],
						'account_name'		    => $ap_entry['accname'][$i],
						'trans_dr'				=> real_value($ap_entry['accdebit'][$i]),
						'trans_cr'				=> real_value($ap_entry['acccredit'][$i]),
						'trans_journal'			=> 'cd',
						'account_group'			=> $account_group[0]['account_group']
						);
					$this->journal_cd_model->journal_cd_trans_add($data);
				}
				auditrecord("Added New Check Disbursement Record. Voucher#:".$journal_cd_data['cd_voucher_no']."");
				echo jcode(array('success' => 1));
			}
		}

	}

	public function search_cd(){
		$this->load->model('journal_cd_model');
		$account_search = $this->input->post('searchCD');
		$data = $this->journal_cd_model->journal_cd_get($account_search['searchCD_checkNo'], $account_search['searchCD_voucherDate_frm'], $account_search['searchCD_voucherDate_to']);
		$data_total = $this->journal_cd_model->journal_cd_get_total($account_search['searchCD_checkNo'], $account_search['searchCD_voucherDate_frm'], $account_search['searchCD_voucherDate_to']);
		$html = "";
		$err = validates(array($account_search), array());

		
		if ($err<1) {
			echo jcode(array(
				'success' 	=> 3,
				'err' 		=> $err
				));
		}else {
			if (!$data->num_rows()) {
				echo jcode(array(
					'success' 	=> 2
					));
			} else {
				foreach ($data->result() as $key) {
					$html .="
					<tr>
						<td class='col-md-2'>".$key->cd_check_no."</td>
						<td class='col-md-2'>".$key->cd_date."</td>
						<td class='col-md-3'>".$key->cd_master_name."</td>
						<td class='col-md-3'>".$key->cd_particulars."</td>
						<td class='col-md-2 text-right'>".number_format($key->cd_check_amount,2)."</td>
						<td class='col-md-1'><a href='#' data-id='$key->cd_id' data-vn='$key->cd_voucher_no' class='btn-style-1 account-report-print animate-4 pull-left'><i class='fa fa-print'></i></a></td>
						<td class='col-md-1'><a href='#' data-id='$key->cd_id' data-cn='$key->cd_check_no' class='btn-style-1 print-check animate-4 pull-left'><i class='fa fa-check-square-o'></i></a></td>
						<td class='col-md-1'><a href='#' data-id='$key->cd_id' data-vn='$key->cd_voucher_no' class='btn-style-1 animate-4 pull-left account-report-edit'><i class='fa fa-edit'></i></a></td>
					</tr>
					";
				}

				foreach ($data_total->result() as $key) {
					$html .="
					<tr>
						<td class='col-md-2'>TOTAL</td>
						<td class='col-md-2'></td>
						<td class='col-md-3'></td>
						<td class='col-md-3'></td>
						<td class='col-md-2 text-right'>".number_format($key->tot_amt,2)."</td>
					</tr>
					";
				}
				auditrecord("Searched Records in Check Disbursement.");
				echo jcode(array('success' => 1,'response' => $html));
			}
		}
	}

	public function cd_report(){
		$this->load->model('journal_cd_model');
		if ($this->session->userdata('islogged')) {
			$id = (int)$this->input->get('id');
			$vn = $this->input->get('vn');
			$html = $this->config->item('report_header');
			$viewData = array(
				'cd_entries' => $this->journal_cd_model->journal_get_entries($id)
				);
			$html.= $this->load->view('report/cd_entries', $viewData, true);
			$html.= $this->config->item('report_footer');
			auditrecord("Generated Check Voucher (".$vn.")");
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			echo jcode(array('success' => 1));
		}
	}

	public function cd_check(){
		$this->load->model('journal_cd_model');
		if ($this->session->userdata('islogged')) {
			$id = (int)$this->input->get('id');
			$cn = $this->input->get('cn');
			$html ="";
			$viewData = array(
				'cd_entries' => $this->journal_cd_model->journal_get_entries($id)
				);
			$html.= $this->load->view('report/cd_check', $viewData, true);
			auditrecord("Generated Check (".$cn.")");
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			echo jcode(array('success' => 1));
		}
	}

	public function cd_summary_report(){
		$this->load->model("journal_cd_model");
		if ($this->session->userdata('islogged')) {
			$cd_check_no 	= $this->input->get('cn');
			$cd_date_frm 		= $this->input->get('dfrm');
			$cd_date_to 		= $this->input->get('dto');
			$html = $this->config->item('report_header');
			$data = array(
				'accounts' => $this->journal_cd_model->journal_cd_get($cd_check_no,$cd_date_frm,$cd_date_to)->result(),
				'accounts_total' => $this->journal_cd_model->journal_cd_get_total($cd_check_no,$cd_date_frm,$cd_date_to)->result()
				);
			$html.= $this->load->view('report/cd_search_report', $data, true);
			$html.= $this->config->item('report_footer');
			auditrecord("Generated Check Disbursement Summary(PDF)");
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
				'page_title'	=> 'Check Disbursement' 
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$viewData = array(
				'transdata' => $this->general_ledger_model->view_cd($id)->result()
				);
			$this->load->view('modules/edit_check_dis', $viewData);
			$this->load->view('parts/footer');
			
		}
	}

	// Get all info of specific account for editting purposes (shows in modal) -mich
	public function show_cdinfo(){
		$this->load->model('journal_cd_model');
		$id = $this->input->post('cd_id');
		$data = $this->journal_cd_model->show_cdinfo($id);
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
	// Export Detailed Report into Excel
	public function export_detailed(){
		$this->load->model('journal_cd_model');
		$this->load->helper('check_dis_detailed');
		$data = $this->journal_cd_model->detailed_report_data();
		auditrecord("Export Detailed Check Disbursement (Excel)");
		check_dis_detailed($data);
	}
	// Export SummaryReport into Excel
	public function export_summary(){
		$this->load->model('journal_cd_model');
		$this->load->helper('check_dis_summary');
		$data = $this->journal_cd_model->summary_report_data();
		auditrecord("Export Summary Check Disbursement (Excel)");
		check_dis_summary($data);
	}

	// Update Transaction
	public function update_cd_trans(){
		$this->load->model('journal_cd_model');
		$u_cd = $this->input->post('u_cd');
		$err = validates(array($u_cd), array());
		if (count($err)) {
			echo jcode(array(
				'success' => 3, 
				'err' 	  => $err
				)
			);
		} else {
			$this->journal_cd_model->update_cd(
				$u_cd['vdate'], 
				$u_cd['vnum'],
				$u_cd['payee'],
				$u_cd['chcknum'], 
				$u_cd['master'],
				$u_cd['chckamt'], 
				$u_cd['part'],
				$u_cd['cd_id']
				);
			// print_r($this->db->last_query());
			echo jcode(array('success' 	=> 1));
		}
	}
}
