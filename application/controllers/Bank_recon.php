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
			redirect('login');
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
			redirect('login');
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
				echo "Fields are Empty";
			}
			
		}else{
			if (!$data->num_rows()) {
				echo jcode(array('success' => 2));
			}
			else{
				foreach ($data->result() as $key) {
					$html .="
					<tr>
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
			$data = $this->bank_recon_model->bank_recon_get($bank_name,$bank_month,$bank_year,$bank_balance)->result();
			$html = $this->config->item('report_header');
			$html.= "
			<div class='jumbotron'>
				<span>Bank Reconciliation Record</span>
			</div>
		</div>
		";
		$html.= "
		<div class='content row'>
			<table class='table'>
				<thead>
					<tr >
						<th class='one-half text-left'>Bank Name</th>
						<th class='one-fourth text-left'>Month</th>
						<th class='one-fourth text-left'>Year</th>
						<th class='one-half text-left'>Balance</th>
					</tr>
				</thead>
				<tbody>
					";
					foreach($data as $key){
						$html.="
						<tr >
							<td class='one-half text-left'>".$key->bank_name."</td>
							<td class='one-fourth text-left'>".$key->bank_month."</td>
							<td class='one-fourth text-left'>".$key->bank_year."</td>
							<td class='one-half text-left'>".$key->bank_balance."</td>
						</tr>
						";
					}
					$html.="
				</tbody>
			</table>
		</div>
		";
		$html.= $this->config->item('report_footer');
		pdf_create($html, 'Bank-Recon');
		//echo $html;
	}
	else{
		redirect('login');
	}
}
}
