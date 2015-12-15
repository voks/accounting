<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_cd_model extends CI_Model {

	public function journal_cd_exist($voucherNo){
		$sql = "select * from tb_journal_cd where project_id=".$this->session->userdata('project_id')." and cd_voucher_no = ?";
		$data = array($voucherNo);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function journal_cd_add($journal_cd_data){
		$this->db->insert('tb_journal_cd', $journal_cd_data);
		return $this->db->insert_id();
	}

	public function journal_cd_trans_add($data){
		$this->db->insert('tb_journal_trans', $data);
	}

	public function journal_cd_get($cd_check_no,$cd_date_frm,$cd_date_to){
		$sql = "select * from tb_journal_cd 
		where project_id=".$this->session->userdata('project_id')." 
		and cd_check_no like ? or cd_date between ? and ?";
		return $this->db->query($sql, array("%$cd_check_no%","$cd_date_frm","$cd_date_to"));
	}

	public function journal_get_entries($cd_id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr
		from tb_journal_cd jtb left join tb_journal_trans jtr on jtb.cd_id=jtr.trans_id
		where jtb.project_id=".$this->session->userdata('project_id')." and cd_id = ? 
		and jtr.trans_journal = 'cd'
		";
		return $this->db->query($sql, array($cd_id));
	}

	public function show_bank(){
		$sql = "tb_account_subsidiary 
		where account_title = 'Cash in Bank' 
		and project_id='".$this->session->userdata('project_id')."'";
		$query = $this->db->get($sql)->result();
		return $query;
	}

	public function journal_cd_get_total($cd_check_no,$cd_date_frm,$cd_date_to){
		$sql = "
		SELECT sum(cd_check_amount) as tot_amt FROM tb_journal_cd 
		WHERE project_id=".$this->session->userdata('project_id')." 
		and cd_check_no like ? or cd_date between ? and ?";
		return $this->db->query($sql, array("%$cd_check_no%","$cd_date_frm","$cd_date_to"));
	}

	public function show_cdinfo($id){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr
		from tb_journal_cd jtb left join tb_journal_trans jtr on jtb.cd_id=jtr.trans_id
		where jtb.project_id=".$this->session->userdata('project_id')." and cd_id = ? 
		and jtr.trans_journal = 'cd'
		";
		$query = $this->db->query($sql, array($id));
		return $query->result();
	}

	public function get_last_vnum(){
		$sql = "SELECT MAX(cd_voucher_no) + 1 AS v_num  from tb_journal_cd";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function detailed_report_data(){
		$sql = "
		SELECT * FROM tb_journal_cd
		";
		$query = $this->db->query($sql);
		return $query;
	}

	public function summary_report_data(){
		$sql = "
		select jtb.*, jtr.account_code, jtr.sub_code, jtr.account_name, jtr.trans_dr, jtr.trans_cr
		from tb_journal_cd jtb left join tb_journal_trans jtr on jtb.cd_id=jtr.trans_id
		where jtb.project_id=".$this->session->userdata('project_id')."
		and jtr.trans_journal = 'cd'
		";
		$query = $this->db->query($sql);
		return $query;
	}

	public function update_cd($date, $vnum, $payee, $chckno, $master,  $chckamt, $part, $cd_id){
		$sql = "
		UPDATE tb_journal_cd 
		SET cd_date = ?,
		cd_voucher_no = ?,
		cd_payee_name = ?,
		cd_check_no = ?,
		cd_master_name = ?,
		cd_check_amount = ?,
		cd_particulars= ?
		WHERE cd_id = ?
		";
		$query = $this->db->query($sql, array($date, $vnum, $payee, $chckno, $master, $chckamt, $part, $cd_id));
	}

}
