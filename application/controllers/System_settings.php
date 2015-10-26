<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_settings extends CI_Controller {
	public function index(){
		$this->load->model("system_settings_model");
		if ($this->session->userdata('islogged')) {
			$page_info = array(
									'page_tab' 		=> 'Administrator',
									'page_title' 	=> 'System Settings'
							  );
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$copyright = array('copyright' => $this->system_settings_model->copyrights_show()->result_array());
			$account_group = array('account_group' => $this->system_settings_model->account_group_show()->result());

			$this->load->view('modules/system_settings',array_merge($copyright,$account_group));
			$this->load->view('parts/footer');
		}
		else{
			redirect('login');
		}
	}

	public function load_page(){
		if ($this->session->userdata('islogged')) {
			$this->load->model("system_settings_model");
			$this->session->set_userdata('page_tab', 'Administrator');
			$this->session->set_userdata('page_title', 'System Settings');
			$this->session->set_userdata('current_page', 'system_settings');
			$copyright = array('copyright' => $this->system_settings_model->copyrights_show()->result_array());
			$account_group = array('account_group' => $this->system_settings_model->account_group_show()->result());

			$this->load->view('modules/system_settings',array_merge($copyright,$account_group));
		}
		else{
			redirect('login');
		}
	}

	public function add_accountgroup(){
		$this->load->model("system_settings_model");
		$account_type  = $this->input->post('account_type');
		$account_group = $this->input->post('accountgroup');

		if ($this->system_settings_model->check_exist($account_type,$account_group)) {
			echo jcode(array('success' => 2));
		}
		else{
			$id = $this->system_settings_model->save_account($account_type,$account_group);
			$html = "
						<tr>
							<td>".$account_type."</td>
							<td>".$account_group."</td>
							<td><i class='fa fa-trash-o btn-style-2 animate-4 accountgroup-item' data-item='".$id."'></i></td>
						</tr>
					";
			echo jcode(array('success' => 1,'response' => $html));
		}
	}


	public function save_copyrights(){
		$this->load->model("system_settings_model");
		$copyrights_data = $this->input->post('copyrights');
		if ($this->system_settings_model->copyrights_exist()) {
			
		}
		else{
			$validation 	 = array($copyrights_data);
			$exemption 		 = array();
			$err 			 = validates($validation, $exemption);
		}

		if (count($err)) {
			echo jcode(array(
								'success' => 3, 
								'err' 	  => $err
							)
					);
		} 
		else {
			$this->system_settings_model->copyrights_add($copyrights_data);
			echo jcode(array('success' => 1));
		}	
	}

	public function get_accountgroup(){
		$this->load->model("system_settings_model");
		$type = $this->input->post('type');
		$data = $this->system_settings_model->account_group_get($type);
		$response = "";
		foreach ($data->result() as $key) {
			$response .="<option>".$key->account_groupname."</option>";
		}
		echo jcode(
					array(
							'success' => 1,
							'response' => $response
						 )
				  );
	}

}
