<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_recon_model extends CI_Model {

	public function bank_recon_exist($bID){
		$sql = "select * from tb_bank_recon where bank_name = ?";
		$data = array($bID);
		$query = $this->db->query($sql,$data);
		return $query->num_rows();
	}

	public function bank_recon_add($bank_recon_data){
		$this->db->insert('tb_bank_recon', $bank_recon_data);
		return $this->db->insert_id();
	}

	public function show_user_type(){
		return $this->db->get('tb_user_type');
	}

	public function bank_recon_get($bank_name){
		$sql = "select * from tb_bank_recon where project_id=".$this->session->userdata('project_id')."
		and bank_name like ?";
		return $this->db->query($sql, array("%$bank_name%"));
	}

	public function show_bank(){
		$sql = "tb_account_subsidiary where account_title='Cash in Bank' ";
		$query = $this->db->get($sql)->result();
		return $query;
	}

	public function show_supplier(){
		$sql = "tb_master where master_type = 'Supplier' ";
		$query = $this->db->get($sql)->result();
		return $query;
	}

}
