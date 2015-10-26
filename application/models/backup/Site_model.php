<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends CI_Model {
	
	public function search_chartaccount($account_code,$account_title,$sub_code,$sub_name){
		$sql = "
				select ma.account_code,ma.account_title,sa.sub_code,sa.sub_name from tb_account_title ma
				inner join  tb_account_subsidiary sa on sa.account_code = ma.account_code
				where ma.project_id=".$this->session->userdata('project_id')." 
				and  ma.account_code like ? and ma.account_title like ? or sa.sub_code like ? and sa.sub_name like ?
				";
		return $this->db->query($sql, array("%$account_code%","%$account_title%","%$sub_code%","%$sub_name%"));
	}

}
	