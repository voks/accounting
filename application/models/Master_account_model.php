<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_account_model extends CI_Model {

	public function master_account_exist($masterCode){
		$sql = "select * from tb_master where project_id=".$this->session->userdata('project_id')." and master_code = ?";
		$data = array($masterCode);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function master_account_add($master_account_data){
		$this->db->insert('tb_master', $master_account_data);
		return $this->db->insert_id();
	}

	public function master_account_get($master_name,$master_type){
		$sql = "select * from tb_master where project_id=".$this->session->userdata('project_id')." and master_name like ? and master_type like ?";
		return $this->db->query($sql, array("%$master_name%","%$master_type%"));
	}

	public function get_title(){
		$sql = "select * from tb_account_title where project_id='".$this->session->userdata('project_id')."'";
		return $this->db->query($sql);
	}

	public function get_account_title($code){
		$sql = "select * from tb_account_title where project_id='".$this->session->userdata('project_id')."' and account_code='".$code."'";
		return $this->db->query($sql);
	}

	public function create_sub($master_account_data){
		$this->db->insert('tb_account_subsidiary', $master_account_data);
		return $this->db->insert_id();
	}

}
