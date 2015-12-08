<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_trail extends CI_Controller {
	public function index(){
		$this->load->model('audit_trail_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Administrator',
				'page_title'	=> 'Audit Trail' 
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar');
			$data = array(
				'audit_data' 	=> $this->audit_trail_model->load_records(),
				'user' 			=> $this->audit_trail_model->load_users()
				);
			$this->load->view('modules/audit_trail', $data);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		$this->load->model('audit_trail_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Administrator');
			$this->session->set_userdata('page_title', 'Audit Trail');
			$data = array(
				'audit_data' 	=> $this->audit_trail_model->load_records(),
				'user' 			=> $this->audit_trail_model->load_users()
				);
			$this->session->set_userdata('current_page', 'audit_trail');
			$this->load->view('modules/audit_trail', $data);
		}else{
			echo jcode(array('success' => 1));
		}
	}

	public function search_records(){
		$this->load->model('audit_trail_model');
		$a_search 			= $this->input->post('searchAudit');
		$date_frm 			= $a_search['searchAudit_dateFRM'];
		$date_to 			= $a_search['searchAudit_dateTO'];
		$date_frm_format 	= date_format(new DateTime($date_frm), "Y/m/d");
		$date_to_format 	= date_format(new DateTime($date_to), "Y/m/d");
		$data = $this->audit_trail_model->search($a_search['searchAudit_user'],$date_frm_format,$date_to_format);
		$html = "";
		$err = validates(array($a_search), array());
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
						<td class=''>".$key->full_name."</td>
						<td class=''>".$key->user_type."</td>
						<td class=''>".$key->a_action."</td>
						<td class=''>".$key->a_date."</td>
					</tr>
					";
				}
				auditrecord("Searched Records in Audit Trail.");
				echo jcode(array('success' => 1,'response' => $html));
			}
		}
	}
}
