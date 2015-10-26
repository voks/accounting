<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_ledger_model extends CI_Model {

	// Query for searching Cash Receipts entries
	public function search_gl_all($account_code,$sub_code, $from_date,$to_date){

		// $sql = "
		// select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		// from tb_journal_cr jtb left join tb_journal_trans jtr on jtb.cr_id=jtr.trans_id

		// where jtb.project_id=".$this->session->userdata('project_id')." and 
		// account_code = ? and cr_or_date between ? and ?
		// ";
		$has = $this->db->query("select * from tb_account_subsidiary where account_code='".$account_code."'")->num_rows();
		if ($has>0) {
			$sql = "
					select * from tb_journal_trans 
					where 
					sub_code='".$sub_code."' and
					trans_date between '".$from_date."' and '".$to_date."'
			   ";
		} else {
			$sql = "
					select * from tb_journal_trans 
					where 
					account_code='".$account_code."' and
					trans_date between '".$from_date."' and '".$to_date."'
			   ";
		}
		
		

		$data = $this->db->query($sql);
		return $data;
	}

	public function get_in_ap($trans_id){
		return $this->db->query("select * from tb_journal_ap where ap_id='".$trans_id."'");
	}

	public function get_in_cd($trans_id){
		return $this->db->query("select * from tb_journal_cd where cd_id='".$trans_id."'");
	}

	public function get_in_cr($trans_id){
		return $this->db->query("select * from tb_journal_cr where cr_id='".$trans_id."'");
	}

	public function get_in_sj($trans_id){
		return $this->db->query("select * from tb_journal_sj where sj_id='".$trans_id."'");
	}

	public function get_in_gj($trans_id){
		return $this->db->query("select * from tb_journal_gj where gj_id='".$trans_id."'");
	}

	// Query for searching Cash Receipts entries
	public function search_gl_cash($account_code, $sub_code, $from_date,$to_date){

		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_cr jtb left join tb_journal_trans jtr on jtb.cr_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and 
		account_code = ? and sub_code = ? and cr_or_date between ? and ? and jtr.trans_journal = 'cr'
		order by cr_or_date
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}

	public function gl_cash_total($account_code, $sub_code, $from_date,$to_date){

		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, 
		sum(jtr.trans_dr) as tot_dr, 
		sum(jtr.trans_cr) as tot_cr 
		from tb_journal_cr jtb left join tb_journal_trans jtr on jtb.cr_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and 
		account_code = ? and sub_code = ? and cr_or_date between ? and ? and jtr.trans_journal = 'cr'
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}

	// Query for searching Accounts payable entries
	public function search_gl_ap($account_code, $sub_code, $from_date,$to_date){

		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and 
		account_code = ? and sub_code = ? and ap_invoice_date between ? and ? and jtr.trans_journal = 'ap'
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}

	public function gl_ap_total($account_code, $sub_code, $from_date,$to_date){

		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, 
		sum(jtr.trans_dr) as tot_dr, 
		sum(jtr.trans_cr) as tot_cr
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and 
		account_code = ? and sub_code = ? and ap_invoice_date between ? and ? and jtr.trans_journal = 'ap'
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}

	// Query for searching Check Disburesemnt entries
	public function search_gl_cd($account_code, $sub_code, $from_date,$to_date){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_cd jtb left join tb_journal_trans jtr on jtb.cd_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and 
		account_code = ? and sub_code = ? and cd_date between ? and ? and jtr.trans_journal = 'cd'
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}

	public function gl_cd_total($account_code, $sub_code, $from_date,$to_date){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, 
		sum(jtr.trans_dr) as tot_dr, 
		sum(jtr.trans_cr) as tot_cr 
		from tb_journal_cd jtb left join tb_journal_trans jtr on jtb.cd_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and 
		account_code = ? and sub_code = ? and cd_date between ? and ? and jtr.trans_journal = 'cd'
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}


	// Query for searching Sales Journal entries
	public function search_gl_sj($account_code, $sub_code, $from_date,$to_date){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_sj jtb left join tb_journal_trans jtr on jtb.sj_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and
		account_code = ? and sub_code = ? and sj_si_date between ? and ? and jtr.trans_journal = 'sj'
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}

	public function gl_sj_total($account_code, $sub_code, $from_date,$to_date){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, 
		sum(jtr.trans_dr) as tot_dr, 
		sum(jtr.trans_cr) as tot_cr 
		from tb_journal_sj jtb left join tb_journal_trans jtr on jtb.sj_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and
		account_code = ? and sub_code = ? and sj_si_date between ? and ? and jtr.trans_journal = 'sj'
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}

	// Query for searching General Journal entries
	public function search_gl_gj($account_code, $sub_code, $from_date,$to_date){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_gj jtb left join tb_journal_trans jtr on jtb.gj_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and
		account_code = ? and sub_code = ? and gj_date between ? and ? and jtr.trans_journal = 'gj'
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}

	public function gl_gj_total($account_code, $sub_code, $from_date,$to_date){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, 
		sum(jtr.trans_dr) as tot_dr, 
		sum(jtr.trans_cr) as tot_cr 
		from tb_journal_gj jtb left join tb_journal_trans jtr on jtb.gj_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and
		account_code = ? and sub_code = ? and gj_date between ? and ? and jtr.trans_journal = 'gj'
		";

		$data = $this->db->query($sql, array("$account_code","$sub_code","$from_date","$to_date"));
		return $data;
	}

	public function get_accounts(){
		$sql = "
		select * from tb_account_title where project_id=".$this->session->userdata('project_id')." 
		";
		return $this->db->query($sql)->result();
	}

	public function get_sub(){
		$sql = "Select * FROM tb_account_subsidiary where project_id=".$this->session->userdata('project_id')." ";
		return $this->db->query($sql)->result();
	}


	public function view_ap($id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_ap jtb left join tb_journal_trans jtr on jtb.ap_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and ap_id = ?
		and trans_journal = 'ap'
		";

		$data = $this->db->query($sql, array($id));
		return $data;
	}

	public function view_cr($id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_cr jtb left join tb_journal_trans jtr on jtb.cr_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and cr_id = ? 
		and trans_journal = 'cr'
		";
		$data = $this->db->query($sql, array($id));
		return $data;
	}

	public function view_cd($id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_cd jtb left join tb_journal_trans jtr on jtb.cd_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and cd_id =?
		and trans_journal = 'cd'
		";
		$data = $this->db->query($sql, array($id));
		return $data;
	}

	public function view_sj($id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_sj jtb left join tb_journal_trans jtr on jtb.sj_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and sj_id =?
		and trans_journal = 'sj'
		";
		$data = $this->db->query($sql, array($id));
		return $data;
	}

	public function view_gj($id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr 
		from tb_journal_gj jtb left join tb_journal_trans jtr on jtb.gj_id=jtr.trans_id

		where jtb.project_id=".$this->session->userdata('project_id')." and gj_id = ?
		and trans_journal = 'gj'
		";
		$data = $this->db->query($sql, array($id));
		return $data;
	}

}
