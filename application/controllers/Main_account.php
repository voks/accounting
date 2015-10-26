<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_account extends CI_Controller {
	
	public function index()
	{
		$this->load->model("main_account_model");
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Set Up',
				'page_title'	=> 'Main Account' 
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$account_group = array('account_group' => $this->system_settings_model->account_group_get('Assets')->result());
			//$master_name = array('master_name' => $this->main_account_model->show_master_name()->result());
			$this->load->view('modules/main_account',$account_group);
			$this->load->view('parts/footer');
		}
		else{
			redirect('login');
		}
	}

	public function load_page(){
		$this->load->model("main_account_model");
		if ($this->session->userdata('islogged')) {
			$this->load->model("system_settings_model");
			$this->session->set_userdata('page_tab', 'Set Up');
			$this->session->set_userdata('page_title', 'Main Account');
			$this->session->set_userdata('current_page', 'main_account');
			//$master_name = array('master_name' => $this->main_account_model->show_master_name()->result());
			$account_group = array('account_group' => $this->system_settings_model->account_group_get('Assets')->result());
			$this->load->view('modules/main_account',$account_group);
		}
		else{
			redirect('login');
		}
	}

	public function save_main_account(){

		$this->load->model("main_account_model");
		$main_account_data = $this->input->post('mainAccount');
		$err = validates(array($main_account_data), array());

		if (count($err)) {
			echo jcode(array(
				'success' => 3, 
				'err' 	  => $err
				)
			);
		} else {

			$accountId = isset($main_account_data['account_code']) ? $main_account_data['account_code']: '';
			$check_id = $this->main_account_model->main_account_exist($accountId);
			
			if ($check_id) {
				echo jcode(array('success' => 2));
			} else {
				$this->main_account_model->main_account_add($main_account_data);
				echo jcode(array('success' => 1));
			}
			
		}
	}

	public function search_accountcode(){
		$this->load->model("main_account_model");
		$account_search = $this->input->post('search_account');
		$data = $this->main_account_model->main_account_get($account_search['searchaccount_code'],$account_search['searchaccount_title'],$account_search['search_accountgroup']);
		$html = "";
		$err = validates(array($account_search), array());

		if (count($err)) {
			if ($err<1) {
				echo jcode(array(
					'success' => 3, 
					'err' 	  => $err
					)
				);
			}
			else {
				if (!$data->num_rows()) {
					echo jcode(array('success' => 2));
				}
				else{
					foreach ($data->result() as $key) {
						$html .="
						<tr>
							<td>".$key->account_type."</td>
							<td>".$key->account_code."</td>
							<td>".$key->account_title."</td>
						</tr>
						";
					}

					echo jcode(array('success' => 1,'response' => $html));
				}
			}
		} 	
	}
	
	public function report_tbl(){
		$this->load->model("main_account_model");
		if ($this->session->userdata('islogged')) {
			
			$account_type = $this->input->get('at');
			$account_code = $this->input->get('ac');
			$account_title = $this->input->get('atits');
			$html = $this->config->item('report_header');

			$data = array(
				'main_account' => $this->main_account_model->searc_mainaccount($account_type,$account_code,$account_title)->result()
				);
			$html.= $this->load->view('report/main_account_search', $data, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'filename');
		}
		else{
			redirect('login');
		}
	}
}
