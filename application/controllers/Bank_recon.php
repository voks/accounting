<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_recon extends CI_Controller {
	public function index(){
		$this->load->model('bank_recon_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Set Up',
				'page_title' 	=> 'Bank Recon'
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$bank_recon = array('bank_recon' => $this->bank_recon_model->show_bank());
			$this->load->view('modules/bank_recon', $bank_recon);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		$this->load->model('bank_recon_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Set Up');
			$this->session->set_userdata('page_title', 'Bank Recon');
			$this->session->set_userdata('current_page', 'bank_recon');
			$bank_recon = array('bank_recon' => $this->bank_recon_model->show_bank());
			$this->load->view('modules/bank_recon', $bank_recon);
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function save_bank_recon(){
		$this->load->model('bank_recon_model');
		$bank_recon_data = $this->input->post('bank');
		$err = validates(array($bank_recon_data), array());

		if (count($err)) {
			echo jcode(array(
				'success' => 3, 
				'err' 	  => $err
				)
			);
		} else {

			$bID = isset($bank_recon_data['bank_id']) ? $bank_recon_data['bank_id']: '';
			$check_id = $this->bank_recon_model->bank_recon_exist($bID);
			
			if ($check_id) {
				echo jcode(array('success' => 2));
			} else {
				$this->bank_recon_model->bank_recon_add($bank_recon_data);
				auditrecord("Added New Bank Record");
				echo jcode(array('success' => 1));
			}
			
		}

	}

	public function search_bank(){
		$this->load->model("bank_recon_model");
		$account_search = $this->input->post('searchBank');
		$data = $this->bank_recon_model->bank_recon_get($account_search['searchBank_name']);
		// print_r($this->db->last_query());
		$html = "";
		$err = validates(array($account_search), array());

		if (count($err)) {
			if ($err<1) {
				echo jcode(array(
					'success' => 3, 
					'err' 	  => $err
					)
				);
			}else{
				echo jcode(array('success' => 2));
			}
			
		}else{
			if (!$data->num_rows()) {
				echo jcode(array('success' => 2));
			}
			else{
				foreach ($data->result() as $key) {
					$html .="
					<tr>
						<td><input type='checkbox'></td>
						<td>".$key->bank_name."</td>
						<td>".$key->bank_month."</td>
						<td>".$key->bank_year."</td>
						<td>".$key->bank_balance."</td>
					</tr>
					";
				}

				echo jcode(array('success' => 1,'response' => $html));
			}
		}
	}
	
	public function report_tbl(){
		$this->load->model("bank_recon_model");
		if ($this->session->userdata('islogged')) {
			$bank_name = $this->input->get('bn');
			$bank_month = $this->input->get('bm');
			$bank_year = $this->input->get('byr');
			$bank_balance = $this->input->get('bal');
			$data = array(
				'bank_data' => $this->bank_recon_model->bank_recon_get($bank_name,$bank_month,$bank_year,$bank_balance)->result()
				);
			$html = $this->config->item('report_header');
			$html.= $this->load->view('report/bankrecon', $data, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'Bank-Recon');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function test_journal(){
		echo "
		<table class='table fixed-table table-condensed search-table'>
			<tbody class='tran_data'>	
				";

				$data_trans = $this->db->query("select * from tb_journal_trans where sub_code='10001 - 10000' and trans_journal='cd'")->result();
				foreach ($data_trans as $data_trans) {
					$data_entry = $this->db->query("select cd_check_no,cd_date,cd_master_name from tb_journal_cd where cd_id=".$data_trans->trans_id."")->result();
					foreach ($data_entry as $data_entry) {
						echo "
						<tr>
							<td><input type='checkbox'/></td>
							<td>".$data_entry->cd_check_no."</td>
							<td".$data_entry->cd_date."<</td>
							<td>".$data_trans->account_name."</td>
							<td>".$data_entry->cd_master_name."</td>
							<td>".$data_trans->trans_dr."</td>
							<td>".$data_trans->trans_cr."</td>
						</tr>
						";
					}
				}

				echo "
			</tbody>
		</table>	
		";
	}

	public function test_all(){
		$html =  "
		<table class='table fixed-table table-condensed search-table'>
			<tbody class='tran_data'>	
				";

				$data_trans = $this->db->query("select * from tb_journal_trans where sub_code='10001 - 10000'")->result();
				foreach ($data_trans as $data_trans) {
					if ($data_trans->trans_journal='cd') {
						$data_entry = $this->db->query("select cd_check_no as code,cd_date as trans_date,cd_master_name as payee from tb_journal_cd where cd_id=".$data_trans->trans_id."")->result();
					}
					elseif ($data_trans->trans_journal='cr') {
						$data_entry = $this->db->query("select cr_or_no as code,cr_date as trans_date,cr_master_name_customer as payee from tb_journal_cr where cr_id=".$data_trans->trans_id."")->result();
					}
					elseif ($data_trans->trans_journal='gj') {
						$data_entry = $this->db->query("select gj_code as code,gj_date as trans_date,gj_particulars as payee from tb_journal_gj where gj_id=".$data_trans->trans_id."")->result();
					}
					foreach ($data_entry as $data_entry) {
						$html.= "
						<tr>
							<td><input type='checkbox'/></td>
							<td>".$data_entry->code."</td>
							<td>".$data_entry->trans_date."</td>
							<td>".$data_trans->account_name."</td>
							<td>".$data_entry->payee."</td>
							<td>".$data_trans->trans_dr."</td>
							<td>".$data_trans->trans_cr."</td>
						</tr>
						";
					}
				}

				$html.= "
			</tbody>
		</table>	
		";

		echo $html;
	}
}
