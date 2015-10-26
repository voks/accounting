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

	public function show_user_access(){
		return $this->db->get('tb_users');
	}

	public function show_user_type(){
		return $this->db->get('tb_user_type');
	}

	public function update_user($user_type,$fname,$lname,$uname,$pwd,$user_id){
		$sql = "update tb_users SET user_type =?, fname=?, lname=?, uname=?, pwd=? WHERE user_id = ?";
		$data = $this->db->query($sql,array($user_type,$fname,$lname,$uname,$pwd,$user_id));
		return $data;
	}

}
