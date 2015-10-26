<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_ledger_model extends CI_Model {

	// Query for Searching Cash Receipts entries
	public function search_gl_all(){
		$sql = "
		Select
		crt.cr_trans_account_code as code,
		crt.cr_trans_sub_name as description,
		crt.cr_trans_dr as dr,
		crt.cr_trans_cr as cr,

		cr.cr_or_no as transcode,
		cr.cr_or_date as date,
		cr.cr_particulars as particulars,
		cr.cr_master_name_bank as masterm

		from tb_journal_cr_trans crt
		inner join tb_journal_cr cr  on crt.cr_id=cr.cr_id

		where cr.project_id=".$this->session->userdata('project_id')."

		UNION ALL 

		select
		apt.ap_trans_account_code as code,
		apt.ap_trans_sub_name as description,
		apt.ap_trans_dr as dr,
		apt.ap_trans_cr as cr,

		ap.ap_invoice_no as transcode,
		ap.ap_invoice_date as date,
		ap.ap_master_name as masterm,
		ap.ap_particulars as particulars

		from tb_journal_ap_trans apt 
		inner join tb_journal_ap ap on apt.ap_id=ap.ap_id

		where ap.project_id=".$this->session->userdata('project_id')." 

		UNION ALL

		select
		cdt.cd_trans_account_code as code,
		cdt.cd_trans_sub_name as description,
		cdt.cd_trans_dr as dr,
		cdt.cd_trans_cr as cr,

		cd.cd_voucher_no as transcode,
		cd.cd_date as date,
		cd.cd_payee_name as masterm,
		cd.cd_particulars as particulars

		from tb_journal_cd_trans cdt 
		inner join tb_journal_cd cd on cdt.cd_id=cd.cd_id

		where cd.project_id=".$this->session->userdata('project_id')."

		UNION ALL

		select
		sjt.sj_trans_account_code as code,
		sjt.sj_trans_sub_name as description,
		sjt.sj_trans_dr as dr,
		sjt.sj_trans_cr as cr,

		sj.sj_si_no as transcode,
		sj.sj_si_date as date,
		sj.sj_master_name as masterm,
		sj.sj_particulars as particulars

		from tb_journal_sj_trans sjt 
		inner join tb_journal_sj sj on sjt.sj_id=sj.sj_id

		where sj.project_id=".$this->session->userdata('project_id')."

		UNION ALL

		select
		gjt.gj_trans_account_code as code,
		gjt.gj_trans_sub_name as description,
		gjt.gj_trans_dr as dr,
		gjt.gj_trans_cr as cr,

		gj.gj_code as transcode,
		gj.gj_date as date,
		gj.gj_amount as amount,
		gj.gj_particulars as particulars

		from tb_journal_gj_trans gjt 
		inner join tb_journal_gj gj on gjt.gj_id=gj.gj_id

		where gj.project_id=".$this->session->userdata('project_id')."

		";

		$data = $this->db->query($sql);
		return $data;
	}

	public function sglall_total(){
		$sql = "
		Select
		sum(cr_trans_dr) as totdr,
		sum(crt.cr_trans_cr) as totcr
		from tb_journal_cr_trans crt
		inner join tb_journal_cr cr  on crt.cr_id=cr.cr_id
		where cr.project_id=".$this->session->userdata('project_id')."
		";
		$data = $this->db->query($sql);
		return $data;
	}


	// Query for Searching Cash Receipts entries
	public function search_gl_cash($account_title,$cr_trans_sub_name,$from_date,$to_date){
		
		$sql = "
		Select
		crt.cr_trans_account_code as code,
		crt.cr_trans_sub_name as description,
		crt.cr_trans_dr as dr,
		crt.cr_trans_cr as cr,

		cr.cr_or_no as transcode,
		cr.cr_or_date as date,
		cr.cr_or_amount as date,
		cr.cr_particulars as particulars,
		cr.cr_master_name_bank as masterm

		from tb_journal_cr_trans crt
		inner join tb_journal_cr cr  on crt.cr_id=cr.cr_id

		where cr.project_id=".$this->session->userdata('project_id')." and
		cr_trans_sub_name like ? or cr_trans_account_code like ? and
		cr_or_date between ? and ?
		";


		$data = $this->db->query($sql, array("%$account_title%","%$cr_trans_sub_name%","$from_date","$to_date"));
		return $data;
	}

	public function sglc_total(){
		$sql = "
		Select
		sum(cr_trans_dr) as totdr,
		sum(crt.cr_trans_cr) as totcr
		from tb_journal_cr_trans crt
		inner join tb_journal_cr cr  on crt.cr_id=cr.cr_id
		where cr.project_id=".$this->session->userdata('project_id')."
		";
		$data = $this->db->query($sql);
		return $data;
	}
	// Query for searching Accounts payable entries
	public function search_gl_ap($ap_trans_sub_name, $from_date,$to_date){

		$sql = "
		select
		apt.ap_trans_account_code as code,
		apt.ap_trans_sub_name as description,
		apt.ap_trans_dr as dr,
		apt.ap_trans_cr as cr,

		ap.ap_invoice_no as transcode,
		ap.ap_invoice_date as invDate,
		ap.ap_master_name as mastername,
		ap.ap_particulars as particulars

		from tb_journal_ap_trans apt 
		inner join tb_journal_ap ap on apt.ap_id=ap.ap_id

		where ap.project_id=".$this->session->userdata('project_id')." and 
		ap_trans_sub_name like ? and ap_invoice_date between ? and ?
		";


		$data = $this->db->query($sql, array("%$ap_trans_sub_name%","$from_date","$to_date"));
		return $data;
	}

	// Query for getting the total of debit credit for searched ap
	public function sglap_total($ap_trans_sub_name,$from_date,$to_date){

		$sql = "
		Select
		sum(ap_trans_dr) as totdr,
		sum(ap.ap_trans_cr) as totcr
		from tb_journal_ap_trans apt
		inner join tb_journal_ap ap  on apt.ap_id=ap.ap_id
		where ap.project_id=".$this->session->userdata('project_id')." and 
		ap_trans_sub_name like ? and ap_invoice_date between ? and ?
		";

		$data = $this->db->query($sql, array("%$ap_trans_sub_name%","$from_date","$to_date"));
		return $data;
	}

	// Query for searching Check Disburesemnt entries
	public function search_gl_cd(){
		$sql = "
		select
		cdt.cd_trans_account_code as code,
		cdt.cd_trans_sub_name as description,
		cdt.cd_trans_dr as dr,
		cdt.cd_trans_cr as cr,

		cd.cd_voucher_no as transcode,
		cd.cd_date as date,
		cd.cd_payee_name as masterm,
		cd.cd_master_name as mastername,
		cd.cd_particulars as particulars

		from tb_journal_cd_trans cdt 
		inner join tb_journal_cd cd on cdt.cd_id=cd.cd_id

		where cd.project_id=".$this->session->userdata('project_id')."
		";

		$data = $this->db->query($sql);
		return $data;
	}

	// Query for total of Check Disburesement
	public function sglcd_total(){
		$sql = "
		Select
		sum(cd_trans_dr) as totdr,
		sum(cdt.cd_trans_cr) as totcr
		from tb_journal_cd_trans cdt
		inner join tb_journal_cd cd on cdt.cd_id=cd.cd_id
		where cd.project_id=".$this->session->userdata('project_id')."
		";
		$data = $this->db->query($sql);
		return $data;
	}

	// Query for searching Sales Journal entries
	public function search_gl_sj(){
		$sql = "
		select
		sjt.sj_trans_account_code as code,
		sjt.sj_trans_sub_name as description,
		sjt.sj_trans_dr as dr,
		sjt.sj_trans_cr as cr,

		sj.sj_si_no as transcode,
		sj.sj_si_date as date,
		sj.sj_master_name as masterm,
		sj.sj_particulars as particulars

		from tb_journal_sj_trans sjt 
		inner join tb_journal_sj sj on sjt.sj_id=sj.sj_id

		where sj.project_id=".$this->session->userdata('project_id')."
		";

		$data = $this->db->query($sql);
		return $data;
	}

	// Query for total of Sales Journal
	public function sglsj_total(){
		$sql = "
		Select
		sum(sj_trans_dr) as totdr,
		sum(sjt.sj_trans_cr) as totcr
		from tb_journal_sj_trans sjt
		inner join tb_journal_sj sj on sjt.sj_id=sj.sj_id
		where sj.project_id=".$this->session->userdata('project_id')."
		";
		$data = $this->db->query($sql);
		return $data;
	}

	// Query for searching General Journal entries
	public function search_gl_gj(){
		$sql = "
		select
		gjt.gj_trans_account_code as code,
		gjt.gj_trans_sub_name as description,
		gjt.gj_trans_dr as dr,
		gjt.gj_trans_cr as cr,

		gj.gj_code as transcode,
		gj.gj_date as date,
		gj.gj_particulars as particulars

		from tb_journal_gj_trans gjt 
		inner join tb_journal_gj gj on gjt.gj_id=gj.gj_id

		where gj.project_id=".$this->session->userdata('project_id')."
		";

		$data = $this->db->query($sql);
		return $data;
	}

	// Query for total of General Journal
	public function sglgj_total(){
		$sql = "
		Select
		sum(gj_trans_dr) as totdr,
		sum(gjt.gj_trans_cr) as totcr
		from tb_journal_gj_trans gjt
		inner join tb_journal_gj gj on gjt.gj_id=gj.gj_id
		where gj.project_id=".$this->session->userdata('project_id')."
		";
		$data = $this->db->query($sql);
		return $data;
	}

	public function get_accounts(){
		$sql = "
		select account_code as code, account_title as title from tb_account_title where project_id=".$this->session->userdata('project_id')." 
		UNION
		Select master_code as code, master_name as title from tb_master where project_id=".$this->session->userdata('project_id')."
		";

		return $this->db->query($sql)->result();
	}

}
