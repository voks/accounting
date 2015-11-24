<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function index(){
		if ($this->session->userdata('islogged')) {
			switch ($this->session->userdata('current_page')) {
				case 'system_settings':
				$this->load->model("system_settings_model");
				$this->session->set_userdata('page_tab', 'Administrator');
				$this->session->set_userdata('page_title', 'System Settings');
				$this->session->set_userdata('current_page', 'system_settings');
				$page_info = array(
					'page_tab' 		=> 'Administrator',
					'page_title' 	=> 'System Settings');
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar',load_data($page_info));

				$copyright = array('copyright' => $this->system_settings_model->copyrights_show()->result_array());
				$account_group = array('account_group' => $this->system_settings_model->account_group_show()->result());

				$this->load->view('modules/system_settings',array_merge($copyright,$account_group));
				$this->load->view('parts/footer');
				break;

				case 'main_account':
				$this->load->model("system_settings_model");
				$this->load->model("main_account_model");
				$this->session->set_userdata('page_tab', 'Set Up');
				$this->session->set_userdata('page_title', 'Main Account');
				$this->session->set_userdata('current_page', 'main_account');
				
				$page_info = array(
					'page_tab' 		=> 'Set Up',
					'page_title' 	=> 'Main Account');
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar',load_data($page_info));
				$account_group = array('account_group' => $this->system_settings_model->account_group_get('Assets')->result());
				//$master_name = array('master_name' => $this->main_account_model->show_master_name()->result());
				$this->load->view('modules/main_account',$account_group);
				$this->load->view('parts/footer');
				break;

				case 'subsidiary_account':
				$this->load->model("system_settings_model");
				$this->load->model("main_account_model");
				$this->load->model("subsidiary_account_model");
				$this->session->set_userdata('page_tab', 'Set Up');
				$this->session->set_userdata('page_title', 'Subsidiary Account');
				$this->session->set_userdata('current_page', 'subsidiary_account');
				
				$page_info = array(
					'page_tab' 		=> 'Set Up',
					'page_title' 	=> 'Subsidiary Account');
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar',load_data($page_info));

				$account_list = array('account_list' => $this->system_settings_model->account_group_get('Assets')->result());
				$account_title = array('account_title' => $this->subsidiary_account_model->get_accounts()->result());
				$master_name = array('master_name' => $this->main_account_model->show_master_name()->result());
				$this->load->view('modules/subsidiary_account',array_merge($account_list,$account_title,$master_name));

				$this->load->view('parts/footer');
				break;
				
				case 'user_access':
				$this->load->model('user_access_model');
				$page_info = array(
					'page_tab' 		=> 'Administrator',
					'page_title'	=> 'User Access' 
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar',load_data($page_info));
				$data = array(
					'user_access_type' 	=> $this->user_access_model->show_user_type()->result(),
					'u_id' 				=> $this->user_access_model->get_last_record(),
					'user_access' 		=> $this->user_access_model->show_user_access()->result(),
					'project_list' 		=> $this->user_access_model->project_list()
					);
				$this->load->view('modules/user_access', $data);
				$this->load->view('parts/footer');
				break;
				// Use to show the Bank name in the bank recon module under select field 
				case 'bank_recon':
				$this->load->model('bank_recon_model');
				$page_info = array(
					'page_tab' 		=> 'Set Up',
					'page_title' 	=> 'Bank Recon'
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar',load_data($page_info));
				$bank_recon = array('bank_recon' => $this->bank_recon_model->show_bank());
				$this->load->view('modules/bank_recon', $bank_recon);
				$this->load->view('parts/footer');
				break;

				// Use to show the Master 
				case 'master_account':
				$page_info = array(
					'page_tab' 		=> 'Set Up',
					'page_title' 	=> 'Master Account'
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar',load_data($page_info));
				$this->load->model('master_account_model');
				$account_title = array('account_title' => $this->master_account_model->get_title());
				$this->load->view('modules/master_account',$account_title);
				$this->load->view('parts/footer');
				break;
				
				// Use to show the Expenses name in the accounts payable module under select field 
				case 'accounts_payable':
				$this->load->model('journal_ap_model');
				$this->load->model('bank_recon_model');
				$this->load->model('subsidiary_account_model');
				$this->load->model('site_model');
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
				break;

				// Use to show the Bank name in the check dis module under select field 
				case 'check_dis':
				$this->load->model('journal_cd_model');
				$this->load->model('subsidiary_account_model');
				$this->load->model('site_model');
				$page_info = array(
					'page_tab' 		=> 'Journal',
					'page_title'	=> 'Check Disbursement' 
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar');
				$viewData = array(
					'journal_cd' => $this->journal_cd_model->show_bank(),
					'account_title' => $this->subsidiary_account_model->get_accounts(),
					'all_accounts' => $this->site_model->load_all_accounts(),
					'v_num' => $this->journal_cd_model->get_last_vnum()
					);
				$this->load->view('modules/check_dis', $viewData);
				$this->load->view('parts/footer');
				break;
				
				
				// Use to show the Customer name in the sales journal module under select field 
				case 'sales_journal':
				$this->load->model('journal_sj_model');
				$this->load->model('subsidiary_account_model');
				$this->load->model('site_model');
				$page_info = array(
					'page_tab' 		=> 'Journal',
					'page_title' 	=> 'Sales Journal'
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar');
				$viewData = array(
					'journal_sj' => $this->journal_sj_model->show_customer(),
					'account_title' => $this->subsidiary_account_model->get_accounts(),
					'all_accounts' => $this->site_model->load_all_accounts(),
					'bi_num' => $this->journal_sj_model->get_last_binum()
					);
				$this->load->view('modules/sales_journal', $viewData);
				$this->load->view('parts/footer');
				break;


				// Use to show the Customer name and bank name in the cash receipts module under select field 
				case 'cash_receipts':
				$this->load->model('journal_cr_model');
				$this->load->model('subsidiary_account_model');
				$this->load->model('site_model');
				$page_info = array(
					'page_tab'		=> 'Journal',
					'page_title' 	=> 'Cash Receipts' 
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar');
				$viewData = array(
					'journal_cr_customer' => $this->journal_cr_model->show_customer(),
					'journal_cr_bank' => $this->journal_cr_model->show_bank(),
					'account_title' => $this->subsidiary_account_model->get_accounts(),
					'bi_no' => $this->journal_cr_model->get_bi(),
					'all_accounts' => $this->site_model->load_all_accounts()
					);
				$this->load->view('modules/cash_receipts', $viewData);
				$this->load->view('parts/footer');
				break;

				// Use to show the account title and general journal module under select field 
				case 'general_journal':
				$this->load->model('subsidiary_account_model');
				$this->load->model('site_model');
				$page_info = array(
					'page_tab'		=> 'Journal',
					'page_title' 	=> 'General Journal' 
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar');
				$viewData = array(
					'account_title' => $this->subsidiary_account_model->get_accounts(),
					'all_accounts' => $this->site_model->load_all_accounts()
					);
				$this->load->view('modules/general_journal', $viewData);
				$this->load->view('parts/footer');
				break;

				// Use to show the account title and general journal module under select field 
				case 'general_ledger':
				$this->load->model('general_ledger_model');
				$page_info = array(
					'page_tab' 		=> 'Ledger',
					'page_title' 	=> 'General Ledger'
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar',load_data($page_info));
				$viewData = array(
					'account_title' => $this->general_ledger_model->get_accounts()
					);
				$this->load->view('modules/general_ledger', $viewData);
				$this->load->view('parts/footer');
				break;

				// Use to show the account title and general journal module under select field 
				case 'trial_balance':
				$this->load->model('trial_balance_model');
				$page_info = array(
					'page_tab' 		=> 'Ledger',
					'page_title' 	=> 'Trial Balance'
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar',load_data($page_info));
				$viewData = array(
					'trial_balance' => $this->trial_balance_model->get_accounts()
					);
				$this->load->view('modules/trial_balance', $viewData);
				$this->load->view('parts/footer');
				break;

				case 'accounts_receivable':
				$this->load->model('accounts_receivable_model');
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
				break;
				
				default:
				$page_info = array(
					'page_tab' 		=> $this->session->userdata('page_tab'),
					'page_title'	=> $this->session->userdata('page_title') 
					);
				$this->load->view('parts/header',load_data($page_info));
				$this->load->view('parts/sidebar',load_data($page_info));
				$this->load->view('modules/'.$this->session->userdata('current_page'));
				$this->load->view('parts/footer');
				break;
			}
		}
		else{
			redirect('login');
		}
	}

	public function get_sub(){
		$this->load->model('site_model');
		$data = $this->site_model->get_sub($this->input->post('account_code'))->result();
		$html = "";
		if ($data) {
			$html.="<option> -- Select Subsidiary -- </option>";
			foreach ($data as $d) {
				$html.="<option value='".$d->sub_code."'>".$d->sub_name."</option>";
			}
			echo jcode(array('success' => 1,'html' => $html));
		}
		else{
			echo jcode(array('success' => 2));
		}
	}

	public function trial_data($type){
		$accounts = $this->trial_balance_model->get_title($type);
		$trial = array();
		foreach ($accounts as $key) {
			$sub = $this->trial_balance_model->get_sub($key->account_code);
			if ($sub==0) {
				if ($this->trial_balance_model->checktrans($key->account_code)>0) {
					$account_code = $this->trial_balance_model->get_trans_main($key->account_code); 
					foreach ($account_code as $data) {
						$trial[] = array(
							'code'  	=> $key->account_code,
							'subcode'	=> $data->sub_code,
							'title'		=> $data->account_name,
							'debit'		=> $data->sdebit,
							'credit'	=> $data->scredit
							);

					}
				}
			}
			else{
				foreach ($sub as $subkey) {
					if ($this->trial_balance_model->checktrans($subkey->sub_code)>0) {
						$account_code = $this->trial_balance_model->get_trans_sub($subkey->sub_code); 
						foreach ($account_code as $data) {
							$trial[] = array(
								'code'  	=> $key->account_code,
								'subcode'	=> $data->sub_code,
								'title'		=> $data->account_name,
								'debit'		=> $data->sdebit,
								'credit'	=> $data->scredit
								);

						}
					}
				}
			}
		}
		return $trial;
	}

	public function search_chartaccount(){
		$this->load->model('site_model');
		$chart_search = $this->input->post('chart');
		$data = $this->site_model->search_chartaccount($chart_search['account_code'], $chart_search['sub_code']);
		$html = "";

		$err = validates(array($chart_search), array());
		
		//if (count($err)) {
		if ($err<1) {
			echo jcode(array(
				'success' 	=> 3,
				'err' 		=> $err
				));
		} 
		else {
			if (!$data->num_rows()) {
				echo jcode(array(
					'success' 	=> 2
					));
			} 
			else 
			{
				if (!$chart_search['sub_code']){
					if ($this->site_model->has_sub($chart_search['account_code'])) {
						foreach ($data->result() as $key) {
							$html .="
							<tr>
								<td class='col-md-1'><label><input type='checkbox' class='' value='0' id='check' data-subcode='".$key->sub_code."' data-subname='".$key->sub_name."'><label>	</td>
								<td class='col-md-1'>".$key->account_code."</td>
								<td class='col-md-3'>".$key->account_title."</td>
								<td class='col-md-2'>".$key->sub_code."</td>
								<td class='col-md-4'>".$key->sub_name."</td>
							</tr>
							";
						}
					}					
					else{
						foreach ($data->result() as $key) {
							$html .="
							<tr>
								<td><label><input type='checkbox' class='' value='0' id='check' data-subcode='".$key->account_code."' data-subname='".$key->account_title."'><label>	</td>
								<td>".$key->account_code."</td>
								<td>".$key->account_title."</td>
								<td>none</td>
								<td>none</td>
							</tr>
							";		
						}
					}
				}
				else{
					foreach ($data->result() as $key) {
						$html .="
						<tr>
							<td><label><input type='checkbox' class='' value='0' id='check' data-subcode='".$key->sub_code."' data-subname='".$key->sub_name."'><label>	</td>
							<td>".$key->account_code."</td>
							<td>".$key->account_title."</td>
							<td>".$key->sub_code."</td>
							<td>".$key->sub_name."</td>
						</tr>
						";
					}
				}
				echo jcode(array('success' => 1,'response' => $html));
			}
			
		}
		//}
	}

	// Need to polish this coding, separate the query; move query in the site_model. -mich
	//Journal get subsiiary in auto generate entries in Journals
	public function get_j_ap(){
		$sql= "
		SELECT * from tb_account_title,tb_account_subsidiary 
		where tb_account_title.account_code=tb_account_subsidiary.account_code 
		and tb_account_subsidiary.master_link='".$this->input->post('mcode')."' 
		and tb_account_title.account_title like '%Accounts Payable%' and tb_account_subsidiary.project_id='".$this->session->userdata('project_id')."'
		";
		$data = $this->db->query($sql);
		echo jcode(array('success' => 1,'row' =>  $data->result()));
	}

	public function get_j_ap_expense(){
		$sql = "";
		$data = $this->db->query($sql);
		echo jcode(array('success' => 1,'row' =>  $data->result()));
	}	

	public function get_j_bank(){
		$data = $this->db->query("select * from tb_account_subsidiary where sub_code='".$this->input->post('code')."' and account_title like '%Cash in Bank%'");
		echo jcode(array('success' => 1,'row' =>  $data->result()));
	}

	public function get_j_sj(){
		$data = $this->db->query("select * from tb_account_subsidiary where master_link='".$this->input->post('mcode')."' and account_title like '%Accounts Receivable%'");
		echo jcode(array('success' => 1,'row' =>  $data->result()));
	}

	// Reset all accounts in the search accounts
	public function reset_all_accounts(){
		$this->load->model('site_model');
		$data = $this->site_model->load_all_accounts();
		$html = "";
		foreach ($data->result() as $key) {
			$html .= "
			<tr>
				<td class='col-md-1'><label><input type='checkbox' class='' value='0' id='check' data-subcode='".$key->sub_code."' data-subname='".$key->sub_name."'><label></td>
				<td class='col-md-1'>".$key->account_code."</td>
				<td class='col-md-3'>".$key->account_title."</td>
				<td class='col-md-2'>".$key->sub_code."</td>
				<td class='col-md-4' colspan='2'>".$key->sub_name."</td>
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
