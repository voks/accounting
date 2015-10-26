<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management_model extends CI_Model {

	public function financial_statement_report(){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')."";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	public function bs_assets_report(){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')." and account_type = 'Assets'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	public function bs_nonAssets_report(){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')." and account_type = 'Non Assets'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	public function bs_otherAssets_report(){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')." and account_type = 'Other Assets'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	public function bs_liabilities_report(){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')." and account_type = 'Liabilities'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	public function bs_equity_report(){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')." and account_type = 'Equity'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function income_statement_report(){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')." and account_type = 'Expense'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function trial_balance_report(){
		$sql = "select * from tb_account_title where project_id=".$this->session->userdata('project_id')."";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function get_expenses($date_from,$date_to){
		$sql = "
		select * from tb_journal_trans where project_id=".$this->session->userdata('project_id')." 
		and trans_date between ? and ? and account_code between '50000' and '59999' group by account_code
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}

	public function get_fs_bank($date_from,$date_to){
		$sql = "
		Select account_code, sub_code, account_name, trans_dr, sum(trans_cr) as trans_cr 
		from tb_journal_trans where project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code = '10001' 
		group by account_name
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}
	public function get_fs_bank_tot($date_from,$date_to){
		$sql = "
		Select account_code, sum(trans_cr) as subtotal from tb_journal_trans where project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code = '10001'
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}
	public function get_fs_ar($date_from,$date_to){
		$sql = "
		Select account_code, sub_code, account_name, trans_dr, sum(trans_cr) as trans_cr 
		from tb_journal_trans where project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code between '40001' and '40003' 
		group by account_name
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}
	public function get_fs_ar_tot($date_from,$date_to){
		$sql = "
		Select account_code, sum(trans_cr) as subtotal
		from tb_journal_trans where project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code between '40001' and '40003'
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}
	public function get_fs_ap($date_from,$date_to){
		$sql = "
		Select account_code, sub_code, account_name, trans_dr, sum(trans_cr) as trans_cr 
		from tb_journal_trans where project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code between '20001' and '20003' 
		group by account_name
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}
	public function get_fs_ap_tot($date_from,$date_to){
		$sql = "
		Select account_code, sum(trans_cr) as subtotal
		from tb_journal_trans where project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code between '20001' and '20003'
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}

	public function get_ap_trade($date_from,$date_to){
		$sql = "
		select jtb.project_id, jtb.ap_id,jtb.ap_invoice_date, jtb.ap_invoice_date, jtb.ap_master_name,sum(jtb.ap_invoice_amount) as ap_invoice_amount, 
		jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code = '20001'
		group by account_name
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}

	public function get_ap_trade_tot($date_from,$date_to){
		$sql = "
		select jtb.project_id, jtb.ap_id, sum(jtb.ap_invoice_amount) as ap_invoice_amount, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code = '20001'
		group by account_name
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}

	public function get_ap_Ntrade($date_from,$date_to){
		$sql = "
		select jtb.project_id, jtb.ap_id,jtb.ap_invoice_date, jtb.ap_invoice_date, jtb.ap_master_name,sum(jtb.ap_invoice_amount) as ap_invoice_amount, 
		jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code = '20002'
		group by account_name
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}

	public function get_ap_Ntrade_tot($date_from,$date_to){
		$sql = "
		select jtb.project_id, jtb.ap_id, sum(jtb.ap_invoice_amount) as ap_invoice_amount, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code = '20002'
		group by account_name
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}

	public function get_ap_other($date_from,$date_to){
		$sql = "
		select jtb.project_id, jtb.ap_id,jtb.ap_invoice_date, jtb.ap_invoice_date, jtb.ap_master_name,sum(jtb.ap_invoice_amount) as ap_invoice_amount, 
		jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code = '20003'
		group by account_name
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}

	public function get_ap_other_tot($date_from,$date_to){
		$sql = "
		select jtb.project_id, jtb.ap_id, sum(jtb.ap_invoice_amount) as ap_invoice_amount, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')."
		and trans_date between ? and ? and account_code = '20003'
		group by account_name
		";
		$data = $this->db->query($sql, array("$date_from","$date_to"));
		return $data;
	}
	
}
