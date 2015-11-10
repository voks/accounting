<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_ledger extends CI_Controller {
	public function index(){
		$this->load->model('general_ledger_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Ledger',
				'page_title' 	=> 'General Ledger'
				);
			$this->load->view('parts/header',load_data($page_info));
			$this->load->view('parts/sidebar',load_data($page_info));
			$viewData = array(
				'account_title' => $this->general_ledger_model->get_accounts()
				);
			$this->load->view('modules/general_ledger', $viewData);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function load_page(){
		$this->load->model('general_ledger_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Ledger');
			$this->session->set_userdata('page_title', 'General Ledger');
			$this->session->set_userdata('current_page', 'general_ledger');
			$viewData = array(
				'account_title' => $this->general_ledger_model->get_accounts()
				);
			$this->load->view('modules/general_ledger', $viewData);
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function search_list(){
		$this->load->model('general_ledger_model');
		if ($this->session->userdata('islogged')) {
			
			$search = $this->input->post('gl-search');
			$search_type = $this->input->post('gl-search[journal]');
			$subs = $search['sub_account'];
			$main = $search['account'];
			if ($search_type == 1) { 
			//Search Journal: ALL Journals

				$search = $this->input->post('gl-search');
				$data = $this->general_ledger_model->search_gl_all($main,$subs,$search['from_date'],$search['to_date']);
				// print_r($this->db->last_query());
				$html="";
				$err = validates(array($search), array());

				if ($err) {
					echo jcode(array(
						'success' 	=> 3,
						'err' 		=> $err
						));
				} else {
					if (!$data->num_rows()) {
						echo jcode(array(
							'success' 	=> 2
							));
					} else {
						foreach ($data->result() as $key) {
							$data_ap = $this->general_ledger_model->get_in_ap($key->trans_id);
							if ($key->trans_journal=='ap') {
								foreach ($data_ap->result() as $key_ap) {
									$html.="
									<tr>
										<td>".$key_ap->ap_invoice_date."</td>
										<td>".$key->account_name."</td>
										<td>".$key_ap->ap_particulars."</td>
										<td>".$key_ap->ap_invoice_no."</td>
										<td class='text-right'>".$key_ap->total_debit."</td>
										<td class='text-right'>".$key_ap->total_credit."</td>

									</tr>";
								}
							}
							elseif ($key->trans_journal=='cd') {
								$data_cd = $this->general_ledger_model->get_in_cd($key->trans_id);
								foreach ($data_cd->result() as $key_cd) {
									$html.="
									<tr>
										<td>".$key_cd->cd_date."</td>
										<td>".$key->account_name."</td>
										<td>".$key_cd->cd_particulars."</td>
										<td>".$key_cd->cd_voucher_no."</td>
										<td class='text-right'>".$key_cd->total_debit."</td>
										<td class='text-right'>".$key_cd->total_credit."</td>

									</tr>";
								}
							}
							elseif ($key->trans_journal=='cr') {
								$data_cr = $this->general_ledger_model->get_in_cr($key->trans_id);
								foreach ($data_cr->result() as $key_cr) {
									$html.="
									<tr>
										<td>".$key_cr->cr_or_date."</td>
										<td>".$key->account_name."</td>
										<td>".$key_cr->cr_particulars."</td>
										<td>".$key_cr->cr_or_no."</td>
										<td class='text-right'>".$key_cr->total_debit."</td>
										<td class='text-right'>".$key_cr->total_credit."</td>

									</tr>";
								}
							}
							elseif ($key->trans_journal=='cr') {
								$data_cr = $this->general_ledger_model->get_in_cr($key->trans_id);
								foreach ($data_cr->result() as $key_cr) {
									$html.="
									<tr>
										<td>".$key_cr->cr_or_date."</td>
										<td>".$key->account_name."</td>
										<td>".$key_cr->cr_particulars."</td>
										<td>".$key_cr->cr_or_no."</td>
										<td class='text-right'>".$key_cr->total_debit."</td>
										<td class='text-right'>".$key_cr->total_credit."</td>

									</tr>";
								}
							}
							elseif ($key->trans_journal=='gj') {
								$data_gj = $this->general_ledger_model->get_in_gj($key->trans_id);
								foreach ($data_gj->result() as $key_gj) {
									$html.="
									<tr>
										<td>".$key_gj->gj_date."</td>
										<td>".$key->account_name."</td>
										<td>".$key_gj->gj_particulars."</td>
										<td>".$key_gj->gj_code."</td>
										<td class='text-right'>".$key_gj->total_debit."</td>
										<td class='text-right'>".$key_gj->total_credit."</td>

									</tr>";
								}
							}
							elseif ($key->trans_journal=='sj') {
								$data_sj = $this->general_ledger_model->get_in_sj($key->trans_id);
								foreach ($data_sj->result() as $key_sj) {
									$html.="
									<tr>
										<td>".$key_sj->sj_si_date."</td>
										<td>".$key->account_name."</td>
										<td>".$key_sj->sj_particulars."</td>
										<td>".$key_sj->sj_si_no."</td>
										<td class='text-right'>".$key_sj->total_debit."</td>
										<td class='text-right'>".$key_sj->total_credit."</td>
									</tr>";
								}
							}
							
						}
						echo jcode(array('success' => 1,'data' => $html));
					}
				}
			} elseif ($search_type == 2){ 
				//Search Journal: Cash Receipts
				$search = $this->input->post('gl-search');
				$new_mainaccount = substr($search['main_account'], 8);
				$data = $this->general_ledger_model->search_gl_cash($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				// print_r($this->db->last_query());
				$tot_data = $this->general_ledger_model->gl_cash_total($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				$html="";
				$err = validates(array($search), array());

				if ($err) {
					echo jcode(array(
						'success' 	=> 3,
						'err' 		=> $err
						));
				} else {
					if (!$data->num_rows()) {
						echo jcode(array(
							'success' 	=> 2
							));
					} else {
						foreach ($data->result() as $key) {
							$html.="
							<tr>
								<td>".$key->cr_or_date."</td>
								<td>".$key->cr_master_name_bank."</td>
								<td>".$key->cr_particulars."</td>
								<td>".$key->cr_or_no."</td>
								<td class='text-right'>".$key->trans_dr."</td>
								<td class='text-right'>".$key->trans_cr."</td>
								<td><a href=# data-id='".$key->cr_id."' data-journal='".$search['journal']."' class='btn btn-style-1 view_account'><i class='fa fa-file-text'></i></a></td>
							</tr>";
						}

						foreach ($tot_data->result() as $key) {
							$html.="
							<tr>
								<td>TOTAL</td>
								<td></td>
								<td></td>
								<td></td>
								<td class='text-right'>".$key->tot_dr."</td>
								<td class='text-right'>".$key->tot_cr."</td>
							</tr>";
						}
						echo jcode(array('success' => 1,'data' => $html));
					}
				}
			} elseif ($search_type == 3){ 
				// Search Journal: Acconts Payable
				$search = $this->input->post('gl-search');
				$new_mainaccount = substr($search['main_account'], 8);
				$data = $this->general_ledger_model->search_gl_ap($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				// print_r($this->db->last_query());
				$tot_data = $this->general_ledger_model->gl_ap_total($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				$html="";
				$err = validates(array($search), array());

				if ($err) {
					echo jcode(array(
						'success' 	=> 3,
						'err' 		=> $err
						));
				} else {
					if (!$data->num_rows()) {
						echo jcode(array(
							'success' 	=> 2
							));
					} else {
						foreach ($data->result() as $key) {
							$html.="
							<tr>
								<td>".$key->ap_invoice_date."</td>
								<td>".$key->ap_master_name."</td>
								<td>".$key->ap_particulars."</td>
								<td>".$key->ap_invoice_no."</td>
								<td class='text-right'>".$key->trans_dr."</td>
								<td class='text-right'>".$key->trans_cr."</td>
								<td><a href=# data-id='".$key->ap_id."' data-journal='".$search['journal']."' class='btn btn-style-1 view_account'><i class='fa fa-file-text'></i></a></td>
							</tr>";
						}
						foreach ($tot_data->result() as $key) {
							$html.="
							<tr>
								<td>TOTAL</td>
								<td></td>
								<td></td>
								<td></td>
								<td class='text-right'>".$key->tot_dr."</td>
								<td class='text-right'>".$key->tot_cr."</td>
							</tr>";
						}
						echo jcode(array('success' => 1,'data' => $html));
					}
				}
			} elseif ($search_type == 4){ 
				//Search Journal:Check Disbursement
				$search = $this->input->post('gl-search');
				$new_mainaccount = substr($search['main_account'], 8);
				$data = $this->general_ledger_model->search_gl_cd($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				$tot_data = $this->general_ledger_model->gl_cd_total($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				$html="";
				$err = validates(array($search), array());

				if ($err) {
					echo jcode(array(
						'success' 	=> 3,
						'err' 		=> $err
						));
				} else {
					if (!$data->num_rows()) {
						echo jcode(array(
							'success' 	=> 2
							));
					} else {
						foreach ($data->result() as $key) {
							$html.="
							<tr>
								<td>".$key->cd_date."</td>
								<td>".$key->cd_master_name."</td>
								<td>".$key->cd_particulars."</td>
								<td>".$key->cd_voucher_no."</td>
								<td class='text-right'>".$key->trans_dr."</td>
								<td class='text-right'>".$key->trans_cr."</td>
								<td><a href=# data-id='".$key->cd_id."' data-journal='".$search['journal']."' class='btn btn-style-1 view_account'><i class='fa fa-file-text'></i></a></td>
							</tr>";
						}

						foreach ($tot_data->result() as $key) {
							$html.="
							<tr>
								<td>TOTAL</td>
								<td></td>
								<td></td>
								<td></td>
								<td class='text-right'>".$key->tot_dr."</td>
								<td class='text-right'>".$key->tot_cr."</td>
							</tr>";
						}
						echo jcode(array('success' => 1,'data' => $html));
					}
				}
			} elseif ($search_type == 5){ 
				//Search Journal:Sales Journal
				$search = $this->input->post('gl-search');
				$new_mainaccount = substr($search['main_account'], 8);
				$data = $this->general_ledger_model->search_gl_sj($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				$tot_data = $this->general_ledger_model->gl_sj_total($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				$html="";
				$err = validates(array($search), array());

				if ($err) {
					echo jcode(array(
						'success' 	=> 3,
						'err' 		=> $err
						));
				} else {
					if (!$data->num_rows()) {
						echo jcode(array(
							'success' 	=> 2
							));
					} else {
						foreach ($data->result() as $key) {
							$html.="
							<tr>
								<td>".$key->sj_si_date."</td>
								<td>".$key->sj_master_name."</td>
								<td>".$key->sj_particulars."</td>
								<td>".$key->sj_si_no."</td>
								<td class='text-right'>".$key->trans_dr."</td>
								<td class='text-right'>".$key->trans_cr."</td>
								<td><a href=# data-id='".$key->sj_id."' data-journal='".$search['journal']."' class='btn btn-style-1 view_account'><i class='fa fa-file-text'></i></a></td>
							</tr>";
						}

						foreach ($tot_data->result() as $key) {
							$html.="
							<tr>
								<td>TOTAL</td>
								<td></td>
								<td></td>
								<td></td>
								<td class='text-right'>".$key->tot_dr."</td>
								<td class='text-right'>".$key->tot_cr."</td>
							</tr>";
						}
						echo jcode(array('success' => 1,'data' => $html));
					}
				}
			} elseif ($search_type == 6){ 
				//Search Journal:General Journal
				$search = $this->input->post('gl-search');
				$new_mainaccount = substr($search['main_account'], 8);
				$data = $this->general_ledger_model->search_gl_gj($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				$tot_data = $this->general_ledger_model->gl_gj_total($search['account'],$search['sub_account'],$search['from_date'],$search['to_date']);
				// print_r($this->db->last_query());
				$html="";
				$err = validates(array($search), array());

				if ($err) {
					echo jcode(array(
						'success' 	=> 3,
						'err' 		=> $err
						));
				} else {
					if (!$data->num_rows()) {
						echo jcode(array(
							'success' 	=> 2
							));
					} else {
						foreach ($data->result() as $key) {
							$html.="
							<tr>
								<td>".$key->gj_date."</td>
								<td></td>
								<td>".$key->gj_particulars."</td>
								<td>".$key->gj_code."</td>
								<td class='text-right'>".$key->trans_dr."</td>
								<td class='text-right'>".$key->trans_cr."</td>
								<td><a href=# data-id='".$key->gj_id."' data-journal='".$search['journal']."' class='btn btn-style-1 view_account'><i class='fa fa-file-text'></i></a></td>
							</tr>";
						}

						foreach ($tot_data->result() as $key) {
							$html.="
							<tr>
								<td>TOTAL</td>
								<td></td>
								<td></td>
								<td></td>
								<td class='text-right'>".$key->tot_dr."</td>
								<td class='text-right'>".$key->tot_cr."</td>
							</tr>";
						}
						echo jcode(array('success' => 1,'data' => $html));
					}
				}
			}
		} else {
			echo jcode(array('success' => 1));
		}
	}

	public function view_account(){
		$this->load->model('general_ledger_model');
		$id = (int)$this->input->post('id');
		$journal = $this->input->post('journal');
		if ($this->session->userdata('islogged')) {
			if($journal==1) {
				echo "ALL";
			}else if($journal==2) {
				$this->load->model('journal_cr_model');
				$data = $this->journal_cr_model->show_crinfo($id);
				$html = "";
				foreach ($data as $key) {
					$html .="
					<tr>
						<td>".$key->sub_code."</td>
						<td>".$key->account_name."</td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_dr,2)."'></td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_cr,2)."'></td>
					</tr>
					";
				}
				echo jcode(
					array(
						'success' 	=> 1, 
						'response' 	=> $data,
						'html' 		=> $html 
						)
					);
			}else if($journal==3) {
				$this->load->model('journal_ap_model');
				$data = $this->journal_ap_model->show_apinfo($id);
				$html = "";
				foreach ($data as $key) {
					$html .="
					<tr>
						<td>".$key->sub_code."</td>
						<td>".$key->account_name."</td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_dr,2)."'></td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_cr,2)."'></td>
					</tr>
					";
				}
				echo jcode(
					array(
						'success' 	=> 1, 
						'response' 	=> $data,
						'html' 		=> $html 
						)
					);
			}else if($journal==4) {
				$this->load->model('journal_cd_model');
				$data = $this->journal_cd_model->show_cdinfo($id);
				$html = "";
				foreach ($data as $key) {
					$html .="
					<tr>
						<td>".$key->sub_code."</td>
						<td>".$key->account_name."</td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_dr,2)."'></td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_cr,2)."'></td>
					</tr>
					";
				}
				echo jcode(
					array(
						'success' 	=> 1, 
						'response' 	=> $data,
						'html' 		=> $html 
						)
					);
			}else if($journal==5) {
				$this->load->model('journal_sj_model');
				$data = $this->journal_sj_model->show_sjinfo($id);
				$html = "";
				foreach ($data as $key) {
					$html .="
					<tr>
						<td>".$key->sub_code."</td>
						<td>".$key->account_name."</td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_dr,2)."'></td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_cr,2)."'></td>
					</tr>
					";
				}
				echo jcode(
					array(
						'success' 	=> 1, 
						'response' 	=> $data,
						'html' 		=> $html 
						)
					);
			}else if($journal==6) {
				$this->load->model('journal_gj_model');
				$data = $this->journal_gj_model->show_gjinfo($id);
				$html = "";
				foreach ($data as $key) {
					$html .="
					<tr>
						<td>".$key->sub_code."</td>
						<td>".$key->account_name."</td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_dr,2)."'></td>
						<td><input type='text' class='form-control text-right' value='".number_format($key->trans_cr,2)."'></td>
					</tr>
					";
				}
				echo jcode(
					array(
						'success' 	=> 1,
						'response' 	=> $data,
						'html' 		=> $html
						)
					);
			}
		}else{
			echo "7";
		}
	}

	public function summary_report(){
		$this->load->model("general_ledger_model");
		if ($this->session->userdata('islogged')) {

			$ctr_acct = $this->input->get('ctr');
			$sub_acct = $this->input->get('sub');
			$from = $this->input->get('fr');
			$to = $this->input->get('to');
			$html = $this->config->item('report_header');
			$data = array(
				'ledger' => $this->general_ledger_model->search_gl_cash($account_title,$cr_trans_sub_name, $from_date,$to_date)->result()
				);
			$html.= $this->load->view('report/gl_search_report', $data, true);
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'filename');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}
}