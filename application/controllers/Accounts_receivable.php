<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_receivable extends CI_Controller {
	public function index(){
		$this->load->model('accounts_receivable_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
								'page_tab' 		=> 'Ledger',
								'page_title'	=> 'Accounts Receivable' 
							  );
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$viewData = array(
				'accounts_receivable' => $this->accounts_receivable_model->show_customer_name()
			);
			$this->load->view('modules/accounts_receivable', $viewData);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		$this->load->model('accounts_receivable_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Ledger');
			$this->session->set_userdata('page_title', 'Accounts Receivable');
			$this->session->set_userdata('current_page', 'accounts_receivable');
			$viewData = array(
				'accounts_receivable' => $this->accounts_receivable_model->show_customer_name()
			);
			$this->load->view('modules/accounts_receivable', $viewData);
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function search_ar(){
		$this->load->model('accounts_receivable_model');
		$ar 		= $this->input->post('ar');
		$data 		= $this->accounts_receivable_model->search_ar($ar['ar_customer']);
		$data_total = $this->accounts_receivable_model->search_ar_tot($ar['ar_customer']);
		// print_r($this->db->last_query());
		$html = "";
		$err = validates(array($ar), array());
		
		
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
						<td>".$key->sj_si_no."</td>
						<td>".$key->sj_si_date."</td>
						<td>".$key->sj_particulars."</td>
						<td style='text-align:right;'>".number_format($key->total_debit,2)."</td>
						<td style='text-align:right;'>".number_format($key->total_credit,2)."</td>
						<td><a href='#' data-id='".$key->sj_id."' class='btn-style-1 animate-4 pull-right ar-report-print'><i class='fa fa-print'></i></a></td>
						<td><a href='#' data-id='".$key->sj_id."' class='btn-style-1 animate-4 pull-left ar-report-edit'><i class='fa fa-edit'></i></a></td>
					</tr>
					";

				}
				foreach ($data_total->result() as $key) {
					$html .="
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td style='text-align:right;'>".number_format($key->tot_debit,2)."</td>
						<td style='text-align:right;'>".number_format($key->tot_credit,2)."</td>
					</tr>
					";
					
				}
				echo jcode(array('success' => 1,'response' => $html));
			}

		}
	}

	public function print_ar_billing(){
		$this->load->model('accounts_receivable_model');
		if ($this->session->userdata('islogged')) {
			$id = (int)$this->input->get('id');
			$html = $this->config->item('report_header');
			$viewData = array(
				'sj_entries' => $this->accounts_receivable_model->print_ar($id)
				);
			$html.= $this->load->view('report/ar_billing', $viewData, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'EPS-Accounting-Report');
		}else {
			echo jcode(array('success' => 1));
		}
	}

	public function ar_summary_report(){
		$this->load->model("accounts_receivable_model");
		if ($this->session->userdata('islogged')) {
			$ar_customer = $this->input->get('ar');
			$html = $this->config->item('report_header');
			$data = array(
					'ar' 		=> $this->accounts_receivable_model->summary_ar($ar_customer)->result(),
					'ar_tot'	=> $this->accounts_receivable_model->search_ar_tot($ar_customer)->result()
				);
			$html.= $this->load->view('report/ar_summary_report', $data, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'Accounts-Receivable');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}
}
