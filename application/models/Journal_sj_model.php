<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_sj_model extends CI_Model {

	public function journal_sj_exist($siNo){
		$sql = "select * from tb_journal_sj where project_id=".$this->session->userdata('project_id')." and sj_si_no = ?";
		$data = array($siNo);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function journal_sj_add($journal_sj_data){
		$this->db->insert('tb_journal_sj', $journal_sj_data);
		return $this->db->insert_id();
	}

	public function journal_sj_trans_add($data){
		$this->db->insert('tb_journal_trans', $data);
	}

	public function journal_sj_get($sj_si_no,$sj_si_date_frm,$sj_si_date_to){
		$sql 	= "select * from tb_journal_sj where 
		project_id=".$this->session->userdata('project_id')." 
		and sj_si_no like ? or sj_si_date between ? and ?";
		$query	= $this->db->query($sql, array("%$sj_si_no%","$sj_si_date_frm","$sj_si_date_to"));
		return $query;
	}

	public function journal_get_entries($sj_id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr
		from tb_journal_sj jtb left join tb_journal_trans jtr on jtb.sj_id=jtr.trans_id
		where jtb.project_id=".$this->session->userdata('project_id')." and sj_id = ? and jtr.trans_journal = 'sj'
		";
		return $this->db->query($sql, array($sj_id));
	}

	public function show_customer(){
		$sql = "tb_master where project_id=".$this->session->userdata('project_id')." and master_type = 'Customer' ";
		$query = $this->db->get($sql)->result();
		return $query;
	}
}
