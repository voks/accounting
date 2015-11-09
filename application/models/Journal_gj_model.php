<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_gj_model extends CI_Model {

	public function journal_gj_exist($gjCode){
		$sql = "select * from tb_journal_gj where project_id=".$this->session->userdata('project_id')." and gj_code = ?";
		$data = array($gjCode);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function journal_gj_add($journal_gj_data){
		$this->db->insert('tb_journal_gj', $journal_gj_data);
		return $this->db->insert_id();
	}

	public function journal_gj_trans_add($data){
		$this->db->insert('tb_journal_trans', $data);
	}

	public function journal_gj_get($gj_code,$gj_date_frm,$gj_date_to){
		$sql 	= "select * from tb_journal_gj 
		where project_id=".$this->session->userdata('project_id')." and 
		gj_code like ? or gj_date between ? and ?";
		$query 	= $this->db->query($sql, array("%$gj_code%","$gj_date_frm","$gj_date_to"));
		return $query;
	}

	public function journal_get_entries($gj_id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr
		from tb_journal_gj jtb left join tb_journal_trans jtr on jtb.gj_id=jtr.trans_id
		where jtb.project_id=".$this->session->userdata('project_id')." and gj_id = ?
		and jtr.trans_journal = 'gj'
		";
		return $this->db->query($sql, array($gj_id));
	}

	public function journal_gj_get_total($gj_code,$gj_date_frm,$gj_date_to){
		$sql = "
		SELECT sum(gj_amount) AS tot_amt FROM tb_journal_gj 
		WHERE project_id=".$this->session->userdata('project_id')." and 
		gj_code like ? or gj_date between ? and ?";
		$query 	= $this->db->query($sql, array("%$gj_code%","$gj_date_frm","$gj_date_to"));
		return $query;
	}

	public function show_gjinfo($id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr
		from tb_journal_gj jtb left join tb_journal_trans jtr on jtb.gj_id=jtr.trans_id
		where jtb.project_id=".$this->session->userdata('project_id')." and gj_id = ?
		and jtr.trans_journal = 'gj'
		";
		$query = $this->db->query($sql, array($id));
		return $query->result();
	}
}
