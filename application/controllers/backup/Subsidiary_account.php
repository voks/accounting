<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subsidiary_account extends CI_Controller {
	public function index(){
		if ($this->session->userdata('islogged')) {
			$page_info = array(
								'page_tab' 		=> 'Set Up',
								'page_title'	=> 'Subsidiary Account' 
							  );
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$this->load->view('modules/subsidiary_account');
			$this->load->view('parts/footer');
		}
		else{
			redirect('login');
		}
	}

	public function load_page(){
		$this->load->model("system_settings_model");
		$this->load->model("subsidiary_account_model");
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Set Up');
			$this->session->set_userdata('page_title', 'Subsidiary Account');
			$this->session->set_userdata('current_page', 'subsidiary_account');

			$account_list = array('account_list' => $this->system_settings_model->account_group_get('Assets')->result());
			$account_title = array('account_title' => $this->subsidiary_account_model->get_accounts()->result());

			$this->load->view('modules/subsidiary_account',array_merge($account_list,$account_title));
		}
		else{
			redirect('login');
		}
	}


	public function save_subsidiary(){
		$this->load->model("subsidiary_account_model");
		$sub_account_data = $this->input->post('subsidiary');
		$err = validates(array($sub_account_data), array());

		if (count($err)) {
			echo jcode(array(
								'success' => 3, 
								'err' 	  => $err
							)
					);
		} else {

			$accountId = isset($sub_account_data['sub_code']) ? $sub_account_data['sub_code']: '';
			$check_id = $this->subsidiary_account_model->sub_account_exist($accountId);
			
			if ($check_id) {
				echo jcode(array('success' => 2));
			} else {
				//foreach ($sub_account_data as $key => $value) {
					 $sub_account_data['sub_code'] = $sub_account_data['account_code']."-".$sub_account_data['sub_code'];
				//}
				$this->subsidiary_account_model->sub_account_add($sub_account_data);
				echo jcode(array('success' => 1));
			}
			
		}
	}


	public function show_accountCode(){
		return $this->db->get('tb_account_title');
	}

	public function get_mainaccounts(){
		$data =  $this->db->query("select * from tb_account_title where account_type='".$this->input->post('type')."'")->result();
		$html = "";
		foreach ($data as $title) {
			$html.="<option>".$title->account_code." - ".$title->account_title."</option>";"";
		}
		echo jcode(array('success' => 1, 'html' => $html));
	}

	public function search_subsidiary(){
		$this->load->model("subsidiary_account_model");
		$account_search = $this->input->post('searchAccount');
		$data = $this->subsidiary_account_model->sub_account_get($account_search['searchAccount_code'],$account_search['searchAccount_name'],$account_search['searchAccount_type']);
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
										<td>".$key->sub_code."</td>
										<td>".$key->sub_name."</td>
									</tr>
								";
						}

						echo jcode(array('success' => 1,'response' => $html));
				}
			}
		} 	
	}

	public function report_tbl(){
		$this->load->model("subsidiary_account_model");
		if ($this->session->userdata('islogged')) {
			$account_type = $this->input->get('at');
			$sub_code = $this->input->get('sc');
			$sub_name = $this->input->get('sn');
			$html = $this->config->item('report_header');
			$data = array(
					'sub_account_search' => $this->subsidiary_account_model->search_subsidiarymainaccount($account_type,$sub_code,$sub_name)->result()
				);
			$html.= $this->load->view('report/sub_account_search', $data, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'filename');
		}
		else{
			redirect('login');
		}
	}
}
