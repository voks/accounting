<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_trail_model extends CI_Model {

	public function load_records(){
		$sql = "SELECT * FROM tb_audit_trail";
		$query = $this->db->query($sql);
		return $query;
	}

	public function load_users(){
		$sql = "SELECT * FROM tb_users";
		$query = $this->db->query($sql);
		return $query;
	}

	public function search($uname, $date_fr, $date_to){
		$sql = "SELECT * FROM tb_audit_trail 
		WHERE project_id = ".$this->session->userdata('project_id')." and full_name = ?
		and a_date BETWEEN ? and ?";
		return $query = $this->db->query($sql, array($uname, $date_fr, $date_to));
	}

}
