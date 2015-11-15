<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trial_balance extends CI_Controller {

	public function index(){
		$this->load->model('trial_balance_model');
		if ($this->session->userdata('islogged')) {
			$page_info = array(
				'page_tab' 		=> 'Ledger',
				'page_title' 	=> 'Trial Balance'
				);
			//$this->load->view('parts/header',load_data($page_info));
			//$this->load->view('parts/sidebar',load_data($page_info));
			

			$ap = $this->trial_data('ap','09/09/2015','10/13/2015');
			$cd = $this->trial_data('cd','09/09/2015','10/13/2015');
			$sj = $this->trial_data('sj','09/09/2015','10/13/2015');
			$cr = $this->trial_data('cr','09/09/2015','10/13/2015');
			$gj = $this->trial_data('gj','09/09/2015','10/13/2015');

			$trial = array_merge($ap,$cd,$sj,$cr,$gj);

			$sumd=0;
					$sumc=0;
					echo "<table><tbody>";
					foreach ($trial as $key) {
						echo "	
								<tr>
									<td>".element('subcode',$key)."</td>
									<td class='title'>".element('title',$key)."</td>
									<td>".element('debit',$key)."</td>
									<td>".element('credit',$key)."</td>
									<td>
										<a href='#' data-ac='".element('code',$key)."' data-sb='".element('subcode',$key)."' class='btn-style-1 animate-4 viewLedger'><i class='fa fa-eye'></i></a>
									</td>
								</tr>
							";
							$sumd+=element('debit',$key);
							$sumc+=element('credit',$key);
					}
						echo "
								<tr>
									<td></td>
									<td class='title'>Total:</td>
									<td>".$sumd."</td>
									<td>".$sumc."</td>
								</tr>"
							;
					echo "</tbody></table>";
			//print_r($trial);
			//$test = array('trial' => $trial );			
			//$this->load->view('modules/trial_balance', $test);
			$this->load->view('parts/footer');
		}
		else{
			echo jcode(array('success' => 1));
		}

	}

	public function trial_data($type,$date_fr,$date_to,$ac){
		$trial = array();
		if ($ac=='') {
			$accounts = $this->trial_balance_model->get_title($type);

			
			foreach ($accounts as $key) {
					$sub = $this->trial_balance_model->get_sub($key->account_code);
					if ($sub==0) {
						if ($this->trial_balance_model->checktrans($key->account_code,$date_fr,$date_to,$type)>0) {
							$account_code = $this->trial_balance_model->get_trans_main($key->account_code,$date_fr,$date_to,$type); 
							foreach ($account_code as $data) {
								$trial[] = array(
													'code'  	=> $key->account_code,
													'subcode'	=> $data->sub_code,
													'title'		=> $data->account_name,
													'debit'		=> $data->sdebit,
													'credit'	=> $data->scredit
												);
								
							}
						}
					}
					else{
						foreach ($sub as $subkey) {
							if ($this->trial_balance_model->checktrans($subkey->sub_code,$date_fr,$date_to,$type)>0) {
								$account_code = $this->trial_balance_model->get_trans_sub($subkey->sub_code,$date_fr,$date_to,$type); 
								foreach ($account_code as $data) {
									$trial[] = array(
														'code'  	=> $key->account_code,
														'subcode'	=> $data->sub_code,
														'title'		=> $data->account_name,
														'debit'		=> $data->sdebit,
														'credit'	=> $data->scredit
													);
									
								}
							}
						}
					}
			}
			return $trial;
		}
		else{
			$sub = $this->trial_balance_model->get_sub($ac);
					if ($sub==0) {
						if ($this->trial_balance_model->checktrans($ac,$date_fr,$date_to,$type)>0) {
							$account_code = $this->trial_balance_model->get_trans_main($ac,$date_fr,$date_to,$type); 
							foreach ($account_code as $data) {
								$trial[] = array(
													'code'  	=> $ac,
													'subcode'	=> $data->sub_code,
													'title'		=> $data->account_name,
													'debit'		=> $data->sdebit,
													'credit'	=> $data->scredit
												);
								
							}
						}
					}
					else{
						foreach ($sub as $subkey) {
							if ($this->trial_balance_model->checktrans($subkey->sub_code,$date_fr,$date_to,$type)>0) {
								$account_code = $this->trial_balance_model->get_trans_sub($subkey->sub_code,$date_fr,$date_to,$type); 
								foreach ($account_code as $data) {
									$trial[] = array(
														'code'  	=> $ac,
														'subcode'	=> $data->sub_code,
														'title'		=> $data->account_name,
														'debit'		=> $data->sdebit,
														'credit'	=> $data->scredit
													);
									
								}
							}
						}
					}
			return $trial;
		}
	}

	public function load_page(){
		$this->load->model('trial_balance_model');
		if ($this->session->userdata('islogged')) {
			$this->session->set_userdata('page_tab', 'Ledger');
			$this->session->set_userdata('page_title', 'Trial Balance');
			$this->session->set_userdata('current_page', 'trial_balance');
			$this->load->view('modules/trial_balance');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}

	public function search_trial(){
		$this->load->model('trial_balance_model');
		$trial =  $this->input->post('trial');
		$account_code = $trial['ctr_acct'];
		$date_fr = $trial['from_date'];
		$date_to = $trial['to_date'];
		$trans = $trial['journal_type'];
		$html ='';
		$trial = array();

		if ($account_code==''&&$trans=='') {
			# code...
		}
		elseif ($account_code=='') {
			# code...
		}
		elseif ($trans=='') {
			# code...
		}
		else{
			$data = $this->trial_data($trans,$date_fr,$date_to,$account_code);

			$trial = array_merge($data);


			$sumd=0;
			$sumc=0;
			foreach ($trial as $key) {
				$html.= "	
						<tr>
							<td>".element('subcode',$key)."</td>
							<td class='title'>".element('title',$key)."</td>
							<td>".element('debit',$key)."</td>
							<td>".element('credit',$key)."</td>
							<td>
								<a href='#' data-ac='".element('code',$key)."' data-sb='".element('subcode',$key)."' class='btn-style-1 animate-4 viewLedger'><i class='fa fa-eye'></i></a>
							</td>
						</tr>
					";
					$sumd+=element('debit',$key);
					$sumc+=element('credit',$key);
			}
				$html.= "
						<tr>
							<td></td>
							<td class='title'>Total:</td>
							<td>".$sumd."</td>
							<td>".$sumc."</td>
						</tr>"
					;

			echo jcode(array(
								'success' => 1,
								'html'	  => $html
					));
		}

		
		
	}

	public function trial_summary_report(){
		$this->load->model("trial_balance_model");
		if ($this->session->userdata('islogged')) {

			$ctr_acct 	= $this->input->get('in');
			$from_date 	= $this->input->get('invd');
			$to_date 	= $this->input->get('mn');

			$account_code = $this->input->get('in');
			$date_fr = $this->input->get('invd');
			$date_to = $this->input->get('mn');
			$trans = $this->input->get('trans');

			$html = $this->config->item('report_header');
			$html.= $this->config->item('report_footer');
			pdf_create($html, 'filename');
		}
		else{
			echo jcode(array('success' => 1));
		}
	}
}
