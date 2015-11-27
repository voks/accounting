<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_settings_model extends CI_Model {

	public function check_exist($account_type,$account_group){
		$sql = "select * from tb_account_groups where account_type=? and account_groupname=?";
		$param = array($account_type,$account_group);
		return $this->db->query($sql,$param)->num_rows();
	}

	public function save_account($account_type,$account_group){
		$data = array(
						'account_type' 		=> $account_type,
						'account_groupname' => $account_group
					 );
		$this->db->insert("tb_account_groups",$data);
		return $this->db->insert_id();
	}


	public function copyrights_exist(){
		return $this->db->query("select * from tb_copyrights")->num_rows();
	}

	public function copyrights_add($copyrights_data){
		$this->db->insert('tb_copyrights', $copyrights_data);
		return $this->db->insert_id();
	}

	public function copyrights_show(){
		return $this->db->get('tb_copyrights');
	}

	public function copyrights_update($copyrights_data){
		// $this->db->update('tb_copyrights', $copyrights_data);
		// return $this->db->affected_rows();
	}

	public function account_group_show(){
		return $this->db->get(' tb_account_groups');
	}

	public function account_group_get($type){
		return $this->db->query("select * from tb_account_groups where account_type='".$type."'");
	}

	public function delete_group($id){
		$sql = "
		DELETE FROM tb_account_groups WHERE id = $id;
		";
		$query = $this->db->query($sql, $id);
		return $query;
	}
}
