<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_access extends CI_Controller {
	public function index(){
		if ($this->session->userdata('islogged')) {
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
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		if ($this->session->userdata('islogged')) {
			$this->load->model("user_access_model");
			$data = array(
				'user_access_type' 	=> $this->user_access_model->show_user_type()->result(),
				'u_id' 				=> $this->user_access_model->get_last_record(),
				'user_access' 		=> $this->user_access_model->show_user_access()->result(),
				'project_list' 		=> $this->user_access_model->project_list()
				);
			$this->load->view('modules/user_access', $data);
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function save_user_access(){

		$this->load->model("user_access_model");
		$user_access_data = $this->input->post('ua');
		$tab_access = $this->input->post('tab');
		$err = validates(array($user_access_data), array());

		if (count($err)) {
			echo jcode(array(
				'success' => 3, 
				'err' 	  => $err
				)
			);
		} else {

			$fname = isset($user_access_data['fname']) ? $user_access_data['fname']: '';
			$check_id = $this->user_access_model->user_exist($fname);
			
			if ($check_id) {
				echo jcode(array('success' => 2));
			} else {
				
				$id = $this->user_access_model->add_user_access($user_access_data);
				$tb_id = $this->user_access_model->add_tab_access($tab_access);
				$html = "
				<tr>
					<td>".$user_access_data['fname']."</td>
					<td>".$user_access_data['lname']."</td>
					<td>".$user_access_data['uname']."</td>
					<td>".$user_access_data['pwd']."</td>
					<td>".$user_access_data['user_type']."</td>
					<td>
						<span class='action'><a href='#' class='' id='alert' data-toggle='modal' data-target='.userAccess'><i class='fa fa-edit' data-item='".$id."'></i> Update</a></span> |
						<span class='action'> <a href='#' class='btn_deluser' data-id='".$id."' data-fname='".$user_access_data['fname']."' ><i class='fa fa-trash-o' data-item=''></i> Delete</a></span>
					</td>
				</tr>
				";
				auditrecord("Added New System User (".$user_access_data['fname'].")");
				echo jcode(array('success' => 1,'response' => $html));
			}
			
		}
	}

	public function update_user_access(){
		$this->load->model("user_access_model");
		$user_access_data = $this->input->post('user');
		$err = validates(array($user_access_data), array());

		if (count($err)) {
			echo jcode(array(
				'success' => 3, 
				'err' 	  => $err
				)
			);
		} else {
			$this->user_access_model->update_user(
				$user_access_data['utype'],
				$user_access_data['fname'],
				$user_access_data['lname'],
				$user_access_data['uname'],
				$user_access_data['pass'],
				$user_access_data['user_id'],
				$user_access_data['tab_transaction'],
				$user_access_data['tab_ledger'],
				$user_access_data['tab_report'],
				$user_access_data['tab_admin'],
				$user_access_data['tab_setup']
				);
			auditrecord("Updated User Access for User ".$user_access_data['fname']."");
			echo jcode(array('success' => 1));
		}

	}

	public function del_user_access(){
		$this->load->model('user_access_model');
		$user_id = $this->input->post('id');
		$fname = $this->input->post('fname');
		$data = $this->user_access_model->delete_user($user_id);
		auditrecord("Deleted User ".$fname."");
		echo jcode(array(
			'success' => 1,
			'response' => $data
			));
	}

	public function load_all_user(){
		$this->load->model('user_access_model');
		$data = $this->user_access_model->show_user_access();
		$html = "";
		foreach ($data->result() as $key) {
			$html .= "
			<tr>
				<td>".$key->fname."</td>
				<td>".$key->lname."</td>
				<td>".$key->uname."</td>
				<td>".$key->pwd."</td>
				<td>".$key->user_type."</td>
				<td>
					<span class='action'><a href='#' class='' id='alert' data-toggle='modal' data-target='.userAccess'><i class='fa fa-edit' data-item='".$key->id."'></i> Update</a></span> |
					<span class='action'> <a href='#' class='btn_deluser' data-id='".$key->id."' data-id='".$key->fname."'><i class='fa fa-trash-o' data-item=''></i> Delete</a></span>
				</td>
			</tr>
			";
		}
		echo jcode(
			array(
				'success' 	=> 1,
				'response' 	=> $html
				)
			);
	}
}
