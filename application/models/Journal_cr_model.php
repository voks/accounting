<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_cr_model extends CI_Model {

	public function journal_cr_exist($orNo){
		$sql = "select * from tb_journal_cr where project_id=".$this->session->userdata('project_id')." and cr_or_no = ?";
		$data = array($orNo);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function journal_cr_add($journal_cr_data){
		$this->db->insert('tb_journal_cr', $journal_cr_data);
		return $this->db->insert_id();
	}

	public function journal_cr_trans_add($data){
		$this->db->insert('tb_journal_trans', $data);
	}

	public function journal_cr_get($cr_or_no,$cr_or_date_frm,$cr_or_date_to){
		$sql 	= "select * from tb_journal_cr 
		where project_id=".$this->session->userdata('project_id')." 
		and cr_or_no like ? or cr_or_date between ? and ?";
		$query 	= $this->db->query($sql, array("%$cr_or_no%","$cr_or_date_frm","$cr_or_date_to"));
		return $query;
	}

	public function journal_get_entries($cr_id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr
		from tb_journal_cr jtb left join tb_journal_trans jtr on jtb.cr_id=jtr.trans_id
		where jtb.project_id=".$this->session->userdata('project_id')." and cr_id = ? and jtr.trans_journal = 'cr'
		";
		return $this->db->query($sql, array($cr_id));
	}

	public function show_customer(){
		$sql = "tb_master where project_id=".$this->session->userdata('project_id')." and master_type = 'Customer' ";
		$query = $this->db->get($sql)->result();
		return $query;
	}

	public function show_bank(){
		//$sql = "tb_master where project_id=".$this->session->userdata('project_id')." and master_type = 'Bank' ";
		$sql = "tb_account_subsidiary where account_title = 'Cash in Bank' and project_id='".$this->session->userdata('project_id')."'";
		$query = $this->db->get($sql)->result();
		return $query;
	}

	public function get_bi(){
		$sql = "SELECT sj_si_no FROM tb_journal_sj";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

}
