<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {
	public function index(){
		$this->load->model('management_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Reports',
				'page_title' 	=> 'Management'
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar');
			$this->load->view('modules/management');
			$this->load->view('parts/footer');
		}
		else{
			redirect('login');
		}
	}

	public function load_page(){
		$this->load->model('management_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Reports');
			$this->session->set_userdata('page_title', 'Management');
			$this->session->set_userdata('current_page', 'management');
			$this->load->view('modules/management');
		}
		else{
			redirect('login');
		}
	}

	public function report(){
		$this->load->model('management_model');
		if ($this->session->userdata('islogged')) {
			$report_type = $this->input->get('rt');
			$mgt = $this->input->get('mgt');
			$date_from = $this->input->get('fr');
			$date_to = $this->input->get('to');
			$html = $this->config->item('report_header');
			
			if ($report_type == 1) {
				$viewData = array(
					'fs_bank' 	  => $this->management_model->get_fs_bank($date_from,$date_to),
					'fs_bank_tot' => $this->management_model->get_fs_bank_tot($date_from,$date_to),
					'fs_ar' 	  => $this->management_model->get_fs_ar($date_from,$date_to),
					'fs_ar_tot'   => $this->management_model->get_fs_ar_tot($date_from,$date_to),
					'fs_ap' 	  => $this->management_model->get_fs_ap($date_from,$date_to),
					'fs_ap_tot'   => $this->management_model->get_fs_ap_tot($date_from,$date_to)
					);
				$html.= $this->load->view('report/financial_statement', $viewData, true);
			} elseif ($report_type == 2) {
				$viewData = array(
					'bs_assets' 		=> $this->management_model->bs_assets_report(),
					'bs_nonAssets'		=> $this->management_model->bs_nonAssets_report(),
					'bs_otherAssets' 	=> $this->management_model->bs_otherAssets_report(),
					'bs_liabilities' 	=> $this->management_model->bs_liabilities_report(),
					'bs_equity' 		=> $this->management_model->bs_equity_report()
					);
				$html.= $this->load->view('report/balance_sheet', $viewData, true);
			} elseif ($report_type == 3) {
				$viewData = array();
				$html.= $this->load->view('report/bank_recon', $viewData, true);
			} elseif ($report_type == 4) {
				$viewData = array();
				$html.= $this->load->view('report/cash_position', $viewData, true);
			} elseif ($report_type == 5) {
				$viewData = array(
					'income_statement' => $this->management_model->income_statement_report()
					);
				$html.= $this->load->view('report/income_statement', $viewData, true);
			} elseif ($report_type == 6) {
				$viewData = array();
				$html.= $this->load->view('report/profit_loss', $viewData, true);
			} elseif ($report_type == 7) {
				$viewData = array(
					'ap_trade' => $this->management_model->get_ap_trade($date_from,$date_to),
					'ap_trade_tot' => $this->management_model->get_ap_trade_tot($date_from,$date_to)
					);
				$html.= $this->load->view('report/ap_trade_report', $viewData, true);
			} elseif ($report_type == 8) {
				$viewData = array(
					'ap_Ntrade' => $this->management_model->get_ap_Ntrade($date_from,$date_to),
					'ap_Ntrade_tot' => $this->management_model->get_ap_Ntrade_tot($date_from,$date_to)
					);
				$html.= $this->load->view('report/ap_nTrade_report', $viewData, true);
			} elseif ($report_type == 9) {
				$viewData = array(
					'ap_other' => $this->management_model->get_ap_other($date_from,$date_to),
					'ap_other_tot' => $this->management_model->get_ap_other_tot($date_from,$date_to)
					);
				$html.= $this->load->view('report/ap_others_report', $viewData, true);
			} elseif ($report_type == 10) {
				$viewData = array();
				$html.= $this->load->view('report/ar_trade_report', $viewData, true);
			} elseif ($report_type == 11) {
				$viewData = array();
				$html.= $this->load->view('report/ar_nTrade_report', $viewData, true);
			} elseif ($report_type == 12) {
				$viewData = array();
				$html.= $this->load->view('report/ar_others_report', $viewData, true);
			} elseif ($report_type == 13) {
				$viewData = array();
				$html.= $this->load->view('report/emp_advances_report', $viewData, true);
			} elseif ($report_type == 14) {
				$viewData = array();
				$html.= $this->load->view('report/officer_advances_report', $viewData, true);
			} elseif ($report_type == 15) {
				$viewData = array();
				$html.= $this->load->view('report/cash_flow', $viewData, true);
			} elseif ($report_type == 16) {
				$viewData = array(
					'expense' => $this->management_model->get_expenses($date_from,$date_to)
					);
				$html.= $this->load->view('report/operating_expenses', $viewData, true);
			} elseif ($report_type == 17) {
				$viewData = array(
					'trial_report' => $this->management_model->trial_balance_report()
					);
				$html.= $this->load->view('report/trial_balance', $viewData, true);
			} elseif ($report_type == 18) {
				$viewData = array();
				$html.= $this->load->view('report/taxes_report', $viewData, true);
			} elseif ($report_type == 19) {
				$viewData = array();
				$html.= $this->load->view('report/prepaid_expenses', $viewData, true);
			} elseif ($report_type == 20) {
				$viewData = array();
				$html.= $this->load->view('report/security_deposit', $viewData, true);
			} elseif ($report_type == 21) {
				$viewData = array();
				$html.= $this->load->view('report/prepaid_rent', $viewData, true);
			} elseif ($report_type == 22) {
				$viewData = array();
				$html.= $this->load->view('report/computer_equipment', $viewData, true);
			} elseif ($report_type == 23) {
				$viewData = array();
				$html.= $this->load->view('report/office_furnitures', $viewData, true);
			} elseif ($report_type == 24) {
				$viewData = array();
				$html.= $this->load->view('report/intagible_assets', $viewData, true);
			} elseif ($report_type == 25) {
				$viewData = array();
				$html.= $this->load->view('report/leashold_improvement', $viewData, true);
			}

			$html.= $this->config->item('report_footer');
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			redirect('login');
		}
	}


}
