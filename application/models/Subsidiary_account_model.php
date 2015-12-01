<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subsidiary_account_model extends CI_Model {

	public function sub_account_exist($accountId){
		$sql = "select * from tb_account_subsidiary where project_id=".$this->session->userdata('project_id')." and sub_code = ?";
		$data = array($accountId);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function sub_account_add($sub_account_data){
		$this->db->insert('tb_account_subsidiary', $sub_account_data);
		return $this->db->insert_id();
	}

	public function show_accountCode(){
		return $this->db->get('tb_account_title');
	}

	public function sub_account_get($sub_code,$sub_name,$account_type){
		$sql = "select * from tb_account_subsidiary where project_id=".$this->session->userdata('project_id')." and sub_code like ? and sub_name like ? and account_type = ?";
		return $this->db->query($sql, array("%$sub_code%","%$sub_name%",$account_type));
	}

	public function get_accounts(){
		return $this->db->query("select * from tb_account_title where project_id=".$this->session->userdata('project_id')."");
	}

	public function search_subsidiarymainaccount($account_type,$account_code,$account_title){
		$sql = "select * from  tb_account_subsidiary where project_id=".$this->session->userdata('project_id')." and  sub_code like ? and sub_name like ? and account_type = ?";
		return $this->db->query($sql, array("%$account_code%","%$account_title%",$account_type));
	}

	public function if_used($sub_code){
		$sql = "
			SELECT * FROM tb_journal_trans WHERE sub_code='".$sub_code."'
		";
		$query = $this->db->query($sql)->num_rows();
		return $query;
	}

	public function get_subinfo($sub_code){
		$sql = "
			SELECT * FROM tb_account_subsidiary WHERE sub_code = ?
		";
		$query = $this->db->query($sql,array($sub_code));
		$result = $query->result();
		return $result;
	}

	public function delete_subinfo($sub_code){
		$sql = "
			DELETE FROM tb_account_subsidiary WHERE sub_code = ?
		";
		return $query = $this->db->query($sql, array($sub_code));
	}

	public function get_last_subnum(){
		$sql = "SELECT MAX(RIGHT(sub_code, 5)) + 1 AS sub_code  from tb_account_subsidiary";
		$query = $this->db->query($sql);
		return $query->result();
	}

}
