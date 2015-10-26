<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_ap_model extends CI_Model {

	public function journal_ap_exist($invNo){
		$sql = "select * from tb_journal_ap where project_id=".$this->session->userdata('project_id')." and ap_invoice_no = ?";
		$data = array($invNo);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function journal_ap_add($journal_ap_data){
		$this->db->insert('tb_journal_ap', $journal_ap_data);
		return $this->db->insert_id();
	}

	public function journal_ap_trans_add($data){
		$this->db->insert('tb_journal_trans', $data);
	}

	public function journal_ap_get($ap_invoice_no,$ap_invoice_date_frm,$ap_invoice_date_to){
		$sql = "select * from tb_journal_ap 
		where project_id=".$this->session->userdata('project_id')." 
		and ap_invoice_no like ? or ap_invoice_date between ? and ?";
		return $this->db->query($sql, array("%$ap_invoice_no%","$ap_invoice_date_frm","$ap_invoice_date_to"));
	}

	public function journal_get_entries($ap_id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id
		where jtb.project_id=".$this->session->userdata('project_id')." and ap_id = ? and jtr.trans_journal = 'ap'
		";
		return $this->db->query($sql, array($ap_id));
	}

	public function show_expense_name(){
		$sql = "tb_account_title where project_id=".$this->session->userdata('project_id')." and account_type = 'Expense' ";
		$query = $this->db->get($sql)->result();
		return $query;
	}

	public function search_transaction($account_code,$account_title,$sub_code,$sub_name){
		$sql = "select account_code as accountcode, account_title as accountdesc from tb_account_title where account_code like ? and account_title like ? 
		union select sub_code as accountcode, sub_name as accountdesc from tb_account_subsidiary where sub_code like ? and sub_name like ?";
		$query = $this->db->query($sql, array("%$account_code%","%$account_title%","%$sub_code%","%$sub_name%"));
		return $query;
	}

}
