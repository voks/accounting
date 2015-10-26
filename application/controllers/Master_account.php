<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_account extends CI_Controller {
	public function index(){
		if ($this->session->userdata('islogged')) {
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
		}
		else{
			redirect('login');
		}
	}

	public function load_page(){
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Set Up');
			$this->session->set_userdata('page_title', 'Master Account');
			$this->session->set_userdata('current_page', 'master_account');
			$this->load->model('master_account_model');
			$account_title = array('account_title' => $this->master_account_model->get_title());
			$this->load->view('modules/master_account',$account_title);
		}
		else{
			redirect('login');
		}
	}

	public function save_master_account(){
		$this->load->model('master_account_model');
		$master_account_data = $this->input->post('master');
		$err = validates(array($master_account_data), array());

		if (count($err)) {
			echo jcode(array(
								'success' => 3, 
								'err' 	  => $err
							)
					);
		} else {

			$masterCode = isset($master_account_data['master_code']) ? $master_account_data['master_code']: '';
			$check_id = $this->master_account_model->master_account_exist($masterCode);
			
			if ($check_id) {
				echo jcode(array('success' => 2));
			} else {
				
				$account_info = $this->master_account_model->get_account_title($master_account_data['master_subsidiary'])->row();
				if ($account_info) {
					$data = array(
									'project_id' 			=> $master_account_data['project_id'],
									'master_code'			=> $master_account_data['master_code'],
									'master_date'			=> $master_account_data['master_date'],
									'master_name'			=> $master_account_data['master_name'],
									'master_type'			=> $master_account_data['master_type'],
									'master_add'			=> $master_account_data['master_add'],
									'master_terms_payment'  => $master_account_data['master_terms_payment'],
									'master_contact_person' => $master_account_data['master_contact_person'],
									'master_position'		=> $master_account_data['master_position'],
									'master_tel_no'			=> $master_account_data['master_tel_no'],
									'master_email'			=> $master_account_data['master_email'],
									'master_fax_no'			=> $master_account_data['master_fax_no']
								);
					$this->master_account_model->master_account_add($data);
					
					$sub_data = array(
										'project_id' 		=> $master_account_data['project_id'],
										'sub_date'			=> $master_account_data['master_date'],
										'account_code'		=> $master_account_data['master_subsidiary'],
										'account_title'		=> $account_info->account_title,
										'account_type'		=> $account_info->account_type,
										'sub_code'			=> $master_account_data['master_subsidiary'].' - '.$master_account_data['master_code'],
										'sub_name'			=> $account_info->account_title. ' - ' . $master_account_data['master_name'],
										'master_link'		=> $master_account_data['master_code']
									 );
					$this->master_account_model->create_sub($sub_data);
					echo jcode(array('success' => 1));					
				} else {
					$data = array(
									'project_id' 			=> $master_account_data['project_id'],
									'master_code'			=> $master_account_data['master_code'],
									'master_date'			=> $master_account_data['master_date'],
									'master_name'			=> $master_account_data['master_name'],
									'master_type'			=> $master_account_data['master_type'],
									'master_add'			=> $master_account_data['master_add'],
									'master_terms_payment'  => $master_account_data['master_terms_payment'],
									'master_contact_person' => $master_account_data['master_contact_person'],
									'master_position'		=> $master_account_data['master_position'],
									'master_tel_no'			=> $master_account_data['master_tel_no'],
									'master_email'			=> $master_account_data['master_email'],
									'master_fax_no'			=> $master_account_data['master_fax_no']
								);
					$this->master_account_model->master_account_add($data);
					echo jcode(array('success' => 1));	
				}
				
			}
			
		}
	}

	public function search_master(){
		$this->load->model("master_account_model");
		$account_search = $this->input->post('searchMaster');
		$data = $this->master_account_model->master_account_get($account_search['searchMaster_name'],$account_search['searchMaster_type']);
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
										<td>".$key->master_name."</td>
										<td>".$key->master_add."</td>
										<td>".$key->master_contact_person."</td>
										<td>".$key->master_tel_no."</td>
									</tr>
								";
						}

						echo jcode(array('success' => 1,'response' => $html));
				}
			}
		}
	}

	public function report_tbl(){
		$this->load->model('master_account_model');
		if ($this->session->userdata('islogged')) {
			
			$master_name = $this->input->get('mn');
			$master_add = $this->input->get('ma');
			$master_con_person = $this->input->get('mcp');
			$master_con_num = $this->input->get('mcn');
			$html = $this->config->item('report_header');

			$data = array(
					'master_account' => $this->master_account_model->master_account_get($master_name,$master_add,$master_con_person,$master_con_num)->result()
				);
			$html.= $this->load->view('report/master_account_search', $data, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'filename');
		}
		else{
			redirect('login');
		}
	}
}
