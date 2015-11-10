<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trial_balance extends CI_Controller {
	public function index(){
		$this->load->model('trial_balance_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Ledger',
				'page_title' 	=> 'Trial Balance'
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$trial = array();
			$trial[] = $this->trial_data('Assets');
			$trial[] = $this->trial_data('Liabilities');
			$trial[] = $this->trial_data('Capital');
			$trial[] = $this->trial_data('Revenue');
			$trial[] = $this->trial_data('Expense');

			// print_r($trial);
			$test = array('trial' => $trial );			
			$this->load->view('modules/trial_balance', $test);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function trial_data($type){
			$accounts = $this->trial_balance_model->get_title($type);
			$trial = array();
			foreach ($accounts as $key) {
					$sub = $this->trial_balance_model->get_sub($key->account_code);
					if ($sub==0) {
							$account_code = $this->trial_balance_model->get_trans_main($key->account_code); 
							foreach ($account_code as $data) {
								$trial[] = array(
													'Code'  	=> $key->account_code,
													'subcode'	=> $data->sub_code,
													'title'		=> $data->account_name,
													'debit'		=> $data->sdebit,
													'credit'	=> $data->scredit
												);
							}
					}
					else{
						foreach ($sub as $subkey) {
							$account_code = $this->trial_balance_model->get_trans_sub($subkey->sub_code); 
							foreach ($account_code as $data) {
								$trial[] = array(
													'Code'  	=> $key->account_code,
													'subcode'	=> $data->sub_code,
													'title'		=> $data->account_name,
													'debit'		=> $data->sdebit,
													'credit'	=> $data->scredit
												);
							}
						}
					}
			}
			return $trial;
	}

	public function load_page(){
		$this->load->model('trial_balance_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Ledger');
			$this->session->set_userdata('page_title', 'Trial Balance');
			$this->session->set_userdata('current_page', 'trial_balance');

			$trial = array();
			$trial[] = $this->trial_data('Assets');
			$trial[] = $this->trial_data('Liabilities');
			$trial[] = $this->trial_data('Capital');
			$trial[] = $this->trial_data('Revenue');
			$trial[] = $this->trial_data('Expense');

			// print_r($trial);
			$test = array('trial' => $trial );			
			$this->load->view('modules/trial_balance', $test);
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function search_trialold(){
		$this->load->model('trial_balance_model');
		if ($this->session->userdata('islogged')){

			$search = $this->input->post('trial');
			$j_type = $this->input->post('trial[journal_type]');
			if ($j_type == 3) {
				$data = $this->trial_balance_model->search_trial_ap($search['ctr_acct'],$search['from_date'],$search['to_date']);
				// print_r($this->db->last_query());
				$html="";
				$err = validates(array($search), array());

				if ($err) {
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
							$html.="
							<tr>
								<td>".$key->account_code."</td>
								<td>".$key->account_name."</td>
								<td class='text-right'>".$key->trans_dr."</td>
								<td class='text-right'>0.00</td>
								<td class='text-center'><a href=# class='btn btn-style-1'><i class='fa fa-file-text'></i></a></td>
							</tr>";
						}
						echo jcode(array('success' => 1,'data' => $html));
					}
				}
			} elseif($j_type == 4) {
				$data = $this->trial_balance_model->search_trial_cd($search['ctr_acct'],$search['from_date'],$search['to_date']);
				// print_r($this->db->last_query());
				$html="";
				$err = validates(array($search), array());

				if ($err) {
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
							$html.="
							<tr>
								<td>".$key->code."</td>
								<td>".$key->trans_name."</td>
								<td class='text-right'>".$key->dr."</td>
								<td class='text-right'>0.00</td>
								<td><a href=# class='btn btn-style-1'><i class='fa fa-file-text'></i></a></td>
							</tr>";
						}
						echo jcode(array('success' => 1,'data' => $html));
					}
				}
			}
		} else {
			echo jcode(array('success' => 1));
		}
	}

	public function search_trial(){
		$this->load->model('trial_balance_model');
		$trial =  $this->input->post('trial');
		$account_code = $trial['ctr_acct'];
		$date_fr = $trial['from_date'];
		$date_to = $trial['to_date'];
		$trans = $trial['journal_type'];
		$html ='';
		if (strlen($account_code)>0) {
			$exist = $this->trial_balance_model->check_exist($account_code,$trans,$date_fr,$date_to);
			if ($exist) {
				$entry = $this->trial_balance_model->get_main($account_code)->row_array();
				$entry_title = $entry['account_title']; //src:http://stackoverflow.com/questions/14788695/codeigniter-single-result-without-foreach-loop
				$entries = $this->trial_balance_model->get_summary($account_code,$trans,$date_fr,$date_to);
				// print_r($this->db->last_query());
				$tot_amt = $this->trial_balance_model->get_summary_tot($account_code,$trans,$date_fr,$date_to);
				// print_r($this->db->last_query());
				$total_dr =0;
				$total_cr =0;				
				foreach ($entries->result() as $key) {
					$total_dr += $key->trans_dr;
					$total_cr += $key->trans_cr;
				}
				$html.="
				<tr>
					<td class='table-td-outline-right'>".$account_code."</td>
					<td class='table-td-outline-right'>".$entry_title."</td>
					<td class='text-right'>".number_format($total_dr, 2)."</td>
					<td class='text-right'>".number_format($total_cr, 2)."</td>
					<td class='text-center'><a href=# class='btn btn-style-1'><i class='fa fa-file-text'></i></a></td>
				</tr>
				"; 
				foreach ($tot_amt->result() as $key) {
					$total_dr = $key->trans_dr;
					$total_cr = $key->trans_cr;
				}
				$html.="
				<tr>
					<td class='table-td-outline-right'>TOTAL</td>
					<td class='table-td-outline-right'></td>
					<td class='text-right'>".number_format($total_dr, 2)."</td>
					<td class='text-right'>".number_format($total_cr, 2)."</td>
				</tr>
				";
				echo jcode(array('success'=>1,'data' =>$html));
			}else{
				echo jcode(array('success'=>2));
			}
		} else {
			
			$titles = $this->trial_balance_model->get_titles()->result();
			foreach ($titles as $key) {
				if ($this->trial_balance_model->check_exist($key->account_code,$trans,$date_fr,$date_to)) {
					$entry = $this->trial_balance_model->get_main($key->account_code)->row_array();
					$entry_title = $entry['account_title']; //src:http://stackoverflow.com/questions/14788695/codeigniter-single-result-without-foreach-loop
					$entries = $this->trial_balance_model->get_summary($key->account_code,$trans,$date_fr,$date_to);
					$total_dr =0;
					$total_cr=0;				
					foreach ($entries->result() as $val) {
						$total_dr += $val->trans_dr;
						$total_cr += $val->trans_cr;
					}
					$html.="
					<tr>
						<td class='table-td-outline-right'>".$key->account_code."</td>
						<td class='table-td-outline-right'>".$entry_title."</td>
						<td class='text-right'>".number_format($total_dr, 2)."</td>
						<td class='text-right'>".number_format($total_cr, 2)."</td>
						<td class='text-center'><a href=# class='btn btn-style-1'><i class='fa fa-file-text'></i></a></td>
					</tr>
					";	
				}
			}
			echo jcode(array('success'=>1,'data' =>$html));
		}
	}

	public function trial_summary_report(){
		$this->load->model("trial_balance_model");
		if ($this->session->userdata('islogged')) {

			$ctr_acct 	= $this->input->get('in');
			$from_date 	= $this->input->get('invd');
			$to_date 	= $this->input->get('mn');

			$account_code = $this->input->get('in');
			$date_fr = $this->input->get('invd');
			$date_to = $this->input->get('mn');
			$trans = $this->input->get('trans');

			$html = $this->config->item('report_header');

			$html.="	<div class='jumbotron'>
			<span>Trial Balance Summary Report</span>
		</div>
	</div>
	<div class='content row'>
		<table class='table text-tbody table-bordered'>
			<thead>
				<tr >
					<th class=''>Account Code</th>
					<th class=''>Account Name</th>
					<th class=''>Debit</th>
					<th class=''>Credit</th>
				</tr>
			</thead>
			<tbody>"
				;


				if (strlen($account_code)>0) {
					if ($this->trial_balance_model->check_exist($account_code,$trans,$date_fr,$date_to)) {
						$entry = $this->trial_balance_model->get_main($account_code)->row_array();
					$entry_title = $entry['account_title']; //src:http://stackoverflow.com/questions/14788695/codeigniter-single-result-without-foreach-loop
					$entries = $this->trial_balance_model->get_summary($account_code,$trans,$date_fr,$date_to);
					$total_dr =0;
					$total_cr=0;				
					foreach ($entries->result() as $key) {
						$total_dr += $key->trans_dr;
						$total_cr += $key->trans_cr;
					}
					$html.="<tr>
					<td class='padding-left-10'>".$account_code."</td>
					<td class='padding-left-10'>".$entry_title."</td>
					<td class='padding-left-10'>".cash_value(number_format((float)$total_dr, 2, '.', ''))."</td>
					<td class='padding-right-5 text-right'>".cash_value(number_format((float)$total_cr, 2, '.', ''))."</td>
				</tr>
				";
			}
		} else {
			$titles = $this->trial_balance_model->get_titles()->result();
			foreach ($titles as $key) {
				if ($this->trial_balance_model->check_exist($key->account_code,$trans,$date_fr,$date_to)) {
					$entry = $this->trial_balance_model->get_main($key->account_code)->row_array();
						$entry_title = $entry['account_title']; //src:http://stackoverflow.com/questions/14788695/codeigniter-single-result-without-foreach-loop
						$entries = $this->trial_balance_model->get_summary($key->account_code,$trans,$date_fr,$date_to);
						$total_dr =0;
						$total_cr=0;				
						foreach ($entries->result() as $val) {
							$total_dr += $val->trans_dr;
							$total_cr += $val->trans_cr;
						}
						$html.="<tr>
						<td class='padding-left-10'>".$key->account_code."</td>
						<td class='padding-left-10'>".$entry_title."</td>
						<td class='padding-left-10'>".cash_value(number_format((float)$total_dr, 2, '.', ''))."</td>
						<td class='padding-right-5 text-right'>".cash_value(number_format((float)$total_cr, 2, '.', ''))."</td>
					</tr>
					";
				}
			}
		}


		$html.="	</tbody>
	</table>
</div>";
$html.= $this->config->item('report_footer');
pdf_create($html, 'filename');
}
else{
	echo jcode(array('success' => 1));
}
}

}
