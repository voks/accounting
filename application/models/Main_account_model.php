<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_account_model extends CI_Model {

	public function main_account_exist($accountId){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')." and account_code = ?";
		$data = array($accountId);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function main_account_add($main_account_data){
		$this->db->insert('tb_account_title', $main_account_data);
		return $this->db->insert_id();
	}

	public function main_account_get($account_code,$account_title,$account_type){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')." and account_code like ? and account_title like ? and account_type = ?";
		return $this->db->query($sql, array("%$account_code%","%$account_title%",$account_type));
	}
	
	public function searc_mainaccount($account_type,$account_code,$account_title){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')." and  account_code like ? and account_title like ? and account_type = ?";
		return $this->db->query($sql, array("%$account_code%","%$account_title%",$account_type));
	}

	public function show_master_name(){
		$sql = "select * from tb_master";
		$query = $this->db->query($sql);
		return $query;
	}

	public function if_used($account_code){
		return $query = $this->db->query("select * from tb_journal_trans where account_code='".$account_code."'")->num_rows();
	}

	public function get_accountinfo($account_code){
		return $this->db->query("select * from tb_account_title where account_code='".$account_code."'")->result();
	}

	public function delete_acctinfo($account_code){
		$sql = "
			DELETE FROM tb_account_title WHERE account_code = ?
		";
		return $query = $this->db->query($sql, array($account_code));
	}

}
	