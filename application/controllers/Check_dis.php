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
				'all_accounts' => $this->site_model->load_all_accounts()
				);
			$this->load->view('modules/check_dis', $viewData);
			$this->load->view('parts/footer');
		}
		else{
			redirect('login');
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
				'all_accounts' => $this->site_model->load_all_accounts()
				);
			$this->load->view('modules/check_dis', $viewData);
		}
		else{
			redirect('login');
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
				echo jcode(array('success' => 1));
			}
		}

	}

	public function search_cd(){
		$this->load->model('journal_cd_model');
		$account_search = $this->input->post('searchCD');
		$data = $this->journal_cd_model->journal_cd_get($account_search['searchCD_checkNo'], $account_search['searchCD_voucherDate_frm'], $account_search['searchCD_voucherDate_to']);
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
						<td class='col-md-2'>".number_format($key->cd_check_amount,2)."</td>
						<td class='col-md-1'><a href='#' data-id='$key->cd_id' class='btn-style-1 account-report-print animate-4 pull-left'><i class='fa fa-print'></i></a></td>
						<td class='col-md-1'><a href='#' data-id='$key->cd_id' class='btn-style-1 print-check animate-4 pull-left'><i class='fa fa-check-square-o'></i></a></td>
						<td class='col-md-1'><a href='#' data-id='$key->cd_id' class='btn-style-1 animate-4 pull-left account-report-edit'><i class='fa fa-edit'></i></a></td>
					</tr>
					";
				}
				echo jcode(array('success' => 1,'response' => $html));
			}
		}
	}

	public function cd_report(){
		$this->load->model('journal_cd_model');
		if ($this->session->userdata('islogged')) {
			$id = (int)$this->input->get('id');
			$html = $this->config->item('report_header');
			$viewData = array(
				'cd_entries' => $this->journal_cd_model->journal_get_entries($id)
				);
			$html.= $this->load->view('report/cd_entries', $viewData, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			redirect('login');
		}
	}

	public function cd_check(){
		$this->load->model('journal_cd_model');
		if ($this->session->userdata('islogged')) {
			$id = (int)$this->input->get('id');
			$html ="";
			$viewData = array(
				'cd_entries' => $this->journal_cd_model->journal_get_entries($id)
				);
			$html.= $this->load->view('report/cd_check', $viewData, true);
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			redirect('login');
		}
	}

	public function cd_summary_report(){
		$this->load->model("journal_cd_model");
		if ($this->session->userdata('islogged')) {
			$cd_voucher_no 	= $this->input->get('vn');
			$cd_date 		= $this->input->get('vd');
			$cd_payee_name 	= $this->input->get('pyee');
			$cd_check_no 	= $this->input->get('cn');
			$html = $this->config->item('report_header');
			$data = array(
				'accounts' => $this->journal_cd_model->journal_cd_get($cd_voucher_no,$cd_date,$cd_payee_name,$cd_check_no)->result()
				);
			$html.= $this->load->view('report/cd_search_report', $data, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'filename');
		}
		else{
			redirect('login');
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
}
