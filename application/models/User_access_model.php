<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_access_model extends CI_Model {

	public function project_list(){
		return $this->db->get('tb_project')->result();
	}

	public function user_exist($fname){
		$sql = "select * from tb_users where fname = ?";
		$data = array($fname);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function add_user_access($user_access_data){
		$this->db->insert('tb_users', $user_access_data);
		return $this->db->insert_id();
	}

	public function add_tab_access($tab_access){
		$this->db->insert('tb_user_access', $tab_access);
		return $this->db->insert_id();
	}

	public function get_last_record(){
		$sql = "SELECT MAX(user_id) + 1 AS user_id  from tb_users";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function show_user_access(){
		$sql = "select ui.*,
		ua.*
		from tb_users ui
		inner join tb_user_access ua on ua.user_id=ui.user_id";
		return $this->db->query($sql);
	}

	public function show_user_type(){
		return $this->db->get('tb_user_type');
	}

	public function update_user($user_type,$fname,$lname,$uname,$pwd,$user_id,$trans,$ledger,$report,$admin,$setup){
		$sql = "update tb_users SET user_type =?, fname=?, lname=?, uname=?, pwd=? WHERE user_id = ?";
		$this->db->query($sql,array($user_type,$fname,$lname,$uname,$pwd,$user_id));

		$sql2 = "update tb_user_access set tab_transaction=?,tab_ledger=?,tab_report=?,tab_admin=?,tab_setup=? WHERE user_id = ?";
		$this->db->query($sql2,array($trans,$ledger,$report,$admin,$setup,$user_id));
	}

	public function delete_user($user_id){
		$sql = "
			DELETE u.*, a.* 
			FROM tb_users u, tb_user_access a 
			WHERE u.user_id = a.user_id AND a.user_id ?
		";
		$this->db->query($sql, $user_id);
	}

}
