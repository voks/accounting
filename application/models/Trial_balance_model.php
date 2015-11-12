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
		select * from tb_account_title where project_id=".$this->session->userdata('project_id')." 
		";
		return $this->db->query($sql)->result();
	}

	public function get_title($type){
		if ($type=='Assets') {
			$sql = "select * from tb_account_title where account_type='Assets'";
			return $this->db->query($sql)->result();
		}
		else if ($type=='Liabilities') {
			$sql = "select * from tb_account_title where account_type='Liabilities'";
			return $this->db->query($sql)->result();
		}
		else if ($type=='Revenue') {
			$sql = "select * from tb_account_title where account_type='Revenue'";
			return $this->db->query($sql)->result();
		}
		else if ($type=='Capital') {
			$sql = "select * from tb_account_title where account_type='Capital'";
			return $this->db->query($sql)->result();
		}
		else if ($type=='Expense') {
			$sql = "select * from tb_account_title where account_type='Expense'";
			return $this->db->query($sql)->result();
		}
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

	public function get_trans_main($code){
		$sql = "select sum(trans_dr) as sdebit,sum(trans_cr) as scredit,sub_code,account_name from tb_journal_trans where account_code='".$code."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	public function get_trans_sub($code){
		return $this->db->query("select sum(trans_dr) as sdebit,sum(trans_cr) as scredit,sub_code,account_name from tb_journal_trans where sub_code='".$code."'")->result();
	}

	public function search_trial_all($ap_code, $from_date,$to_date){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id
		where 
		";
		$data = $this->db->query($sql, array("$ap_code","$from_date","$to_date"));
		return $data;
	}

	public function search_trial_ap($ap_code, $from_date,$to_date){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, sum(jtr.trans_dr) as trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and 
		account_code = ? and ap_invoice_date between ? and ?
		";
		$data = $this->db->query($sql, array("$ap_code","$from_date","$to_date"));
		return $data;
	}

	public function search_trial_cd($cd_code, $from_date,$to_date){
		$sql = "
		select
		cd.cd_id as id,
		cd.cd_voucher_no as invcode,
		cd.cd_date as invDate,
		cd.cd_master_name as mastername,
		cd.cd_particulars as particulars,
		cd.cd_check_amount as tot_amount,
		cdt.cd_trans_account_code as code,
		cdt.cd_trans_sub_name as trans_name,
		sum(cdt.cd_trans_dr) as dr,
		cdt.cd_trans_cr as cr

		from tb_journal_cd cd
		inner join tb_journal_cd_trans cdt on cd.cd_id=cdt.cd_id

		where cd.project_id=".$this->session->userdata('project_id')." and 
		cd_trans_account_code = ? and cd_date between ? and ?
		";
		$data = $this->db->query($sql, array("$cd_code","$from_date","$to_date"));
		return $data;
	}

	public function get_titles(){
		return $this->db->query('select * from tb_account_title');
	}

	public function get_main($code){
		if ($code) {
			$sql="select * from tb_account_title where account_code='".$code."'";
		}
		else{
			$sql="select * from tb_account_title";
		}
		return $this->db->query($sql);
	}

	public function check_exist($code,$trans,$date_fr,$date_to){
		if (strlen($trans)>0) {
			return $this->db->query("select * from tb_journal_trans where account_code='".$code."'
								 and trans_journal='".$trans."' and trans_date between '".$date_fr."' and '".$date_to."'
								")->num_rows();
		} else {
			return $this->db->query("select * from tb_journal_trans where account_code='".$code."'
								 and trans_date between '".$date_fr."' and '".$date_to."'
								")->num_rows();
		}
	}

	public function get_summary($account_code,$trans,$date_fr,$date_to){
		if (strlen($trans)>0) {
			$sql="select * from tb_journal_trans where account_code='".$account_code."'
			  and trans_journal='".$trans."' and trans_date between '".$date_fr."' and '".$date_to."'
			 ";
		} else {
			$sql="select * from tb_journal_trans where account_code='".$account_code."'
			  and trans_date between '".$date_fr."' and '".$date_to."'
			 ";
		}
		return $this->db->query($sql);
	}

	public function get_summary_tot($account_code,$trans,$date_fr,$date_to){
		if (strlen($trans)>0) {
			$sql = "
			SELECT sum(trans_dr) as trans_dr, sum(trans_cr) as trans_cr FROM tb_journal_trans 
			WHERE account_code = '".$account_code."' and trans_journal = '".$trans."' 
			and trans_date BETWEEN '".$date_fr."' AND '".$date_to."'
			";
		}else{
			$sql = "
			SELECT sum(trans_dr) as trans_dr, sum(trans_cr) as trans_cr FROM tb_journal_trans
			WHERE account_code = '".$account_code."' and trans_date BETWEEN '".$date_fr."' AND '".$date_to."'
			";
		}
		$query = $this->db->query($sql);
		return $query;
	}
}
