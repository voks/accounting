<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function project_list(){
		return $this->db->get('tb_project')->result();
	}

	public function login_process($username,$pwd,$project_id){
		$query = "
					select * from tb_users 
					where 
					uname=? and pwd=? and project_id=?";
		$param = array($username,$pwd,$project_id);
		$exist = $this->db->query($query,$param);
		return $exist;
	}

	public function session_data($id,$user_id){
		$query = "
					select ud.*,
						   pd.*,
						   ac.*
						   from tb_users  ud
						   inner join tb_project pd on pd.project_id = ud.project_id
						   inner join tb_user_access ac on ac.user_id = ud.user_id
						   where ud.project_id=".$id." and ud.user_id=".$user_id."
				 ";
		$param = array($id,$user_id);
		$data =  $this->db->query($query,$param)->result_array();
		$session_data = array(
								'project_id' 	=> $data[0]['project_id'],
								'project_name'	=> $data[0]['project_name'],
								'fullname'		=> $data[0]['fname'].' '.$data[0]['lname'],
								'u_type'		=> $data[0]['user_type'],
								'user_id'		=> $data[0]['user_id'],
								'islogged'		=> 1,
								'current_page'	=> 'accounts_payable',
								'page_tab' 		=> 'Journal',
								'page_title'	=> 'Accounts Payable',
								'tab_trans'		=> $data[0]['tab_transaction'],
								'tab_ledger'	=> $data[0]['tab_ledger'],
								'tab_report'	=> $data[0]['tab_report'],
								'tab_admin'		=> $data[0]['tab_admin'],
								'tab_setup'		=> $data[0]['tab_setup']
							 );
		$this->session->set_userdata('page_tab', 'Journal');
		$this->session->set_userdata('page_title', 'Accounts Payable');
		$this->session->set_userdata('current_page', 'accounts_payable');
		return $session_data;
	}
}
