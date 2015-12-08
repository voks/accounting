<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_journal extends CI_Controller {
	public function index(){
		$this->load->model('subsidiary_account_model');
		$this->load->model('site_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Journal',
				'page_title' 	=> 'General Journal'
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar');
			$viewData = array(
				'account_title' => $this->subsidiary_account_model->get_accounts(),
				'all_accounts' 	=> $this->site_model->load_all_accoounts()
				);
			$this->load->view('modules/general_journal', $viewData);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		$this->load->model('subsidiary_account_model');
		$this->load->model('site_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Journal');
			$this->session->set_userdata('page_title', 'General Journal');
			$this->session->set_userdata('current_page', 'general_journal');
			$viewData = array(
				'account_title' => $this->subsidiary_account_model->get_accounts(),
				'all_accounts' 	=> $this->site_model->load_all_accounts()
				);
			$this->load->view('modules/general_journal', $viewData);
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function save_journal_gj(){
		$this->load->model('journal_gj_model');
		$this->load->model('site_model');
		$journal_gj_data = $this->input->post('gj');
		$ap_entry = $this->input->post('ap_entry');
		$err = validates(array($journal_gj_data), array('gj_cleared_date'));

		if (count($err)) {
			echo jcode(array(
				'success' 	=> 3,
				'err' 		=> $err
				));
		} else {
			$gjCode = isset($journal_gj_data['gj_code']) ? $journal_gj_data['gj_code']: '';
			$check_id = $this->journal_gj_model->journal_gj_exist($gjCode);
			
			if ($check_id) {
				echo jcode(array('success' => 2));
			} else {
				$trans_data = array(
					'project_id' 		=> $this->session->userdata('project_id'),
					'gj_code' 			=> $journal_gj_data['gj_code'],
					'gj_date'			=> $journal_gj_data['gj_date'],
					'gj_amount'			=> real_value($journal_gj_data['gj_amount']),
					'gj_particulars'	=> $journal_gj_data['gj_particulars'],
					'total_debit'		=> real_value($journal_gj_data['total_debit']),
					'total_credit'		=> real_value($journal_gj_data['total_credit'])

					);
				$trans_id = $this->journal_gj_model->journal_gj_add($trans_data);

				for ($i = 0;$i<count($ap_entry['code']);$i++) {						
						// $data = array(
						// 						'gj_id' 				=> $trans_id, 
						// 						'project_id'			=> $this->session->userdata('project_id'),
						// 						'gj_trans_account_code' => $ap_entry['code'][$i],
						// 						'gj_trans_sub_name'		=> $ap_entry['accname'][$i],
						// 						'gj_trans_dr'			=> $ap_entry['accdebit'][$i],
						// 						'gj_trans_cr'			=> $ap_entry['acccredit'][$i]
						// 					);
					$account_group = $this->site_model->get_group_account(substr($ap_entry['code'][$i],0,5));	
					$data = array(
						'project_id'			=> $this->session->userdata('project_id'),
						'trans_id' 				=> $trans_id, 
						'trans_date'			=> $journal_gj_data['gj_date'],
						'account_code'			=> substr($ap_entry['code'][$i],0,5),
						'sub_code' 				=> $ap_entry['code'][$i],
						'account_name'		    => $ap_entry['accname'][$i],
						'trans_dr'				=> real_value($ap_entry['accdebit'][$i]),
						'trans_cr'				=> real_value($ap_entry['acccredit'][$i]),
						'trans_journal'			=> 'gj',
						'account_group'			=> $account_group[0]['account_group']
						);
					$this->journal_gj_model->journal_gj_trans_add($data);
				}
				auditrecord("Added New General Journal Record. Journal#:".$journal_gj_data['gj_code']."");
				echo jcode(array('success' => 1));
			}
		}
		
	}

	public function search_gj(){
		$this->load->model('journal_gj_model');
		$account_search = $this->input->post('searchGJ');
		$data = $this->journal_gj_model->journal_gj_get($account_search['searchGJ_code'],$account_search['searchGJ_date_frm'],$account_search['searchGJ_date_to']);
		$data_total = $this->journal_gj_model->journal_gj_get_total($account_search['searchGJ_code'],$account_search['searchGJ_date_frm'],$account_search['searchGJ_date_to']);
		
		// print_r($this->db->last_query());
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
						<td class='col-md-2'>".$key->gj_code."</td>
						<td class='col-md-2'>".$key->gj_date."</td>
						<td class='col-md-3'>".$key->gj_particulars."</td>
						<td class='col-md-2 text-right'>".number_format($key->gj_amount,2)."</td>
						<td class='col-md-1'><a href='#' data-id='$key->gj_id' data-jn='$key->gj_code' class='btn-style-1 account-report-print animate-4 pull-right'><i class='fa fa-print'></i></a></td>
						<td class='col-md-1'><a href='#' data-id='$key->gj_id' class='btn-style-1 animate-4 pull-left account-report-edit'><i class='fa fa-edit'></i></a></td>
					</tr>
					";
				}
				foreach ($data_total->result() as $key) {
					$html .="
					<tr>
						<td class='col-md-2'>TOTAL</td>
						<td class='col-md-2'></td>
						<td class='col-md-3'></td>
						<td class='col-md-2 text-right'>".number_format($key->tot_amt,2)."</td>
					</tr>
					";
				}
				auditrecord("Searched Records in General Jouranl.");
				echo jcode(array('success' => 1,'response' => $html));
			}
		}
	}

	public function gj_report(){
		$this->load->model('journal_gj_model');
		if ($this->session->userdata('islogged')) {
			$id = (int)$this->input->get('id');
			$jn = $this->input->get('jn');
			$html = $this->config->item('report_header');
			$viewData = array(
				'gj_entries' => $this->journal_gj_model->journal_get_entries($id)
				);
			$html.= $this->load->view('report/gj_entries', $viewData, true);
			$html.= $this->config->item('report_footer');
			auditrecord("Generated Journal Report(JV#:".$jn.")");
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			echo jcode(array('success' => 1));
		}
	}

	public function gj_summary_report(){
		$this->load->model("journal_gj_model");
		if ($this->session->userdata('islogged')) {
			$gj_code 	= $this->input->get('jn');
			$gj_date_frm	= $this->input->get('jndfrm');
			$gj_date_to	= $this->input->get('jndto');
			$html = $this->config->item('report_header');
			$data = array(
				'accounts' => $this->journal_gj_model->journal_gj_get($gj_code,$gj_date_frm,$gj_date_to)->result(),
				'accounts_total' => $this->journal_gj_model->journal_gj_get_total($gj_code,$gj_date_frm,$gj_date_to)->result()
				);
			$html.= $this->load->view('report/gj_search_report', $data, true);
			$html.= $this->config->item('report_footer');
			auditrecord("Generated Journal Summary Report (PDF)");
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
				'page_title' 	=> 'General Journal'
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar');
			$viewData = array(
				'transdata' => $this->general_ledger_model->view_gj($id)->result()
				);
			$this->load->view('modules/edit_gen_journal', $viewData);
			$this->load->view('parts/footer');
			
		}
	}

	public function show_gjinfo(){
		$this->load->model('journal_gj_model');
		$id = $this->input->post('gj_id');
		$data = $this->journal_gj_model->show_gjinfo($id);
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
