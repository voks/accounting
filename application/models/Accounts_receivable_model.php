<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_receivable_model extends CI_Model {

	public function show_customer_name(){
		$sql = "tb_master where master_type = 'Customer' ";
		$query = $this->db->get($sql)->result();
		return $query;
	}

	public function search_ar($customer){
		$sql = "Select * from tb_journal_sj where project_id =".$this->session->userdata('project_id')." and sj_master_name = ?";
		$data = $this->db->query($sql, array($customer));
		return $data;
	}

	public function search_ar_tot($customer){
		$sql = "
			SELECT sum(total_debit) as tot_debit, sum(total_credit) as tot_credit
			from tb_journal_sj where project_id = ".$this->session->userdata('project_id')."
			and sj_master_name = ?
		";
		$data = $this->db->query($sql, $customer);
		return $data;
	}

	public function summary_ar($customer){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_sj jtb left join tb_journal_trans jtr on jtb.sj_id=jtr.trans_id
		where jtb.project_id =".$this->session->userdata('project_id')." and
		sj_master_name = ? and trans_journal = 'sj' group by jtb.sj_si_no
		";
		$data = $this->db->query($sql, array($customer));
		return $data;
	}

	public function print_ar($id){
		$sql = "Select * from tb_journal_sj where sj_id = ?";
		$data = $this->db->query($sql, array($id));
		return $data;
	}
}
