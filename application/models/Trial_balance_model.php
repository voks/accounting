<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trial_balance_model extends CI_Model {

	
	public function get_charts_title(){
		$sql = "select ap_expenses as title FROM tb_journal_ap 
		UNION
		select cd_payee_name as title FROM tb_journal_cd
		UNION
		select cr_master_name_bank as title FROM tb_journal_cr
		ORDER BY title ";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	public function get_accounts(){
		$sql = "
		select * from tb_account_title where project_id=".$this->session->userdata('project_id')."";
		return $this->db->query($sql)->result();
	}

	public function get_title($type){
			$sql = "select * from tb_journal_trans where trans_journal='".$type."' GROUP BY account_code ";
			return $this->db->query($sql)->result();
	}

	public function get_sub($code){
		$sql = "select * from tb_account_subsidiary where account_code='".$code."'";
		$data =  $this->db->query($sql);
		if ($data->num_rows()>0) {
			return $data->result();
		}
		else{
			return 0;
		}
	}

	public function get_trans_main($code,$date1,$date2,$type){
		return $this->db->query("select sum(trans_dr) as sdebit,sum(trans_cr) as scredit,sub_code,account_name from tb_journal_trans where account_code='".$code."' and trans_date between '".$date1."' and '".$date2."' and trans_journal='".$type."' GROUP BY account_code ")->result();
	}

	public function get_trans_sub($code,$date1,$date2,$type){
		return $this->db->query("select sum(trans_dr) as sdebit,sum(trans_cr) as scredit,sub_code,account_name from tb_journal_trans where sub_code='".$code."' and trans_date between '".$date1."' and '".$date2."' and trans_journal='".$type."'  GROUP BY account_code ")->result();
	}

	public function checktrans($code,$date1,$date2,$type){
		return $this->db->query("select * from tb_journal_trans where account_code='".$code."' or sub_code='".$code."' and trans_date between '".$date1."' and '".$date2."' and trans_journal='".$type."' GROUP BY account_code ")->num_rows();
	}
}
