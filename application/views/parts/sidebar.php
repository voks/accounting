<!-- Page side panel start -->
		<div class="dv-page-left-panel">
			<ul>
				<li role="tab" id="headingjournal">
					<a href="#user" data-parent="#menu" data-toggle="collapse" aria-expanded="false" aria-controls="user">
						<i class='fa fa-user'></i><span><?=$fullname?></span>
					</a>
					<ul class="collapse animate-10" id="user" role="tabpanel" aria-labelledby="headingjournal">
						<li class=""><a href="<?=($page_title=='Account Settings') ? 'active': ''?> menu-link" id="account_settings" data-tab="tab-journal" data-ul="journal" data-menu="account_settings" data-address="account_settings"><a href="javascript:;">Account Settings</a></li>
						<li class=""><a href="<?=site_url()?>login/logout">Log Out</a></li>
					</ul>
				</li>
				<!-- <li role="tab" class="menu-link tab-link <?=($page_tab=='Dashboard') ? 'active' : '' ?>" id="tab-dashboard" data-tab="tab-dashboard" data-ul="" data-menu="" data-address="dashboard">
					<a href="javascript:;"><i class='fa fa-dashboard'></i><span>Dashboard</span></a>
				</li> -->
				<li class="tab-link <?=($page_tab=='Set Up') ? 'active' : '' ?>" role="tab" id="tab-setup">
					<a href="#setup" data-parent="#menu" data-toggle="collapse" aria-expanded="false" aria-controls="setup">
						<i class='fa fa-cogs'></i><span>Setup</span>
					</a>
					<ul class="ul-link collapse animate-10 <?=($page_tab=='Set Up') ? 'in': ''?>" id="setup">
						<li class="<?=($page_title=='Main Account') ? 'active': ''?> menu-link" id="main-account" data-tab="tab-setup" data-ul="setup" data-menu="main-account" data-address="main_account"><a href="javascript:;">Chart of Accounts</a></li>
						<li class="<?=($page_title=='Subsidiary Account') ? 'active': ''?> menu-link" id="subsidiary-account" data-tab="tab-setup" data-ul="setup" data-menu="subsidiary-account" data-address="subsidiary_account"><a href="javascript:;">Subsidiary Account</a></li>
						<li class="<?=($page_title=='Master Account') ? 'active': ''?> menu-link" id="master-account" data-tab="tab-setup" data-ul="setup" data-menu="master-account" data-address="master_account"><a href="javascript:;">Master Account</a></li>
						<li class="<?=($page_title=='Bank Recon') ? 'active': ''?> menu-link" id="bank-recon" data-tab="tab-setup" data-ul="setup" data-menu="bank-recon" data-address="bank_recon"><a href="javascript:;">Bank Recon Balance</a></li>
					</ul>
				</li>
				<li role="tab" id="tab-journal" class="tab-link <?=($page_tab=='Journal') ? 'active' : '' ?>" >
					<a href="#journal" data-parent="#menu" data-toggle="collapse" aria-expanded="false" aria-controls="journal">
						<i class='fa fa-book'></i><span>Transaction</span>
					</a>
					<ul class="ul-link collapse animate-10 <?=($page_tab=='Journal') ? 'in': ''?>" id="journal">
						<li class="<?=($page_title=='Accounts Payable') ? 'active': ''?> menu-link" id="accounts_payable" data-tab="tab-journal" data-ul="journal" data-menu="accounts_payable" data-address="accounts_payable"><a href="javascript:;">Accounts Payable</a></li>
						<li class="<?=($page_title=='Check Disbursement') ? 'active': ''?> menu-link" id="check_dis" data-tab="tab-journal" data-ul="journal" data-menu="check_dis" data-address="check_dis"><a href="javascript:;">Check Disbursement</a></li>
						<li class="<?=($page_title=='Sales Journal') ? 'active': ''?> menu-link" id="sales_journal" data-tab="tab-journal" data-ul="journal" data-menu="sales_journal" data-address="sales_journal"><a href="javascript:;">Sales Journal</a></li>
						<li class="<?=($page_title=='Cash Receipts') ? 'active': ''?> menu-link" id="cash_receipts" data-tab="tab-journal" data-ul="journal" data-menu="cash_receipts" data-address="cash_receipts"><a href="javascript:;">Cash Reciepts</a></li>
						<li class="<?=($page_title=='General Journal') ? 'active': ''?> menu-link" id="general_journal" data-tab="tab-journal" data-ul="journal" data-menu="general_journal" data-address="general_journal"><a href="javascript:;">General Journal</a></li>
					</ul>
				</li>
				<li class="tab-link <?=($page_tab=='Ledger') ? 'active' : '' ?>" role="tab" id="tab-ledger">
					<a href="#ledger" data-parent="#menu" data-toggle="collapse" aria-expanded="false" aria-controls="ledger">
						<i class='fa fa-table'></i><span>Ledger</span>
					</a>
					<ul class="ul-link collapse animate-10 <?=($page_tab=='Ledger') ? 'in': ''?>" id="ledger">
						<li class="<?=($page_title=='Trial Balance') ? 'active': ''?> menu-link" id="trial_balance" data-tab="tab-ledger" data-ul="ledger" data-menu="trial_balance" data-address="trial_balance"><a href="javascript:;">Trial Balance</a></li>
						<li class="<?=($page_title=='General Ledger') ? 'active': ''?> menu-link" id="general_ledger" data-tab="tab-ledger" data-ul="ledger" data-menu="general_ledger" data-address="general_ledger"><a href="javascript:;">General Ledger</a></li>
						<li class="<?=($page_title=='Accounts Receivable') ? 'active': ''?> menu-link" id="accounts_receivable" data-tab="tab-ledger" data-ul="ledger" data-menu="accounts_receivable" data-address="accounts_receivable"><a href="javascript:;">Accounts Recievable</a></li>
					</ul>
				</li>
				<li class="tab-link <?=($page_tab=='Reports') ? 'active' : '' ?>" role='tab' id='tab-reports'>
					<a href="#reports" data-parent="#menu" data-toggle="collapse" aria-expanded="false" aria-controls="reports">
						<i class='fa fa-line-chart'></i><span>Reports</span>
					</a>
					<ul class="ul-link collapse animate-10 <?=($page_tab=='Reports') ? 'in': ''?>" id="reports">
						<li class="<?=($page_title=='summary') ? 'active' : '' ?> menu-link" id="summary" data-tab="tab-reports" data-ul="reports" data-menu="summary" data-address="summary"><a href="javascript:;">Summary</a></li>
						<li class="<?=($page_title=='aging') ? 'active' : '' ?> menu-link" id="aging" data-tab="tab-reports" data-ul="reports" data-menu="aging" data-address="aging"><a href="javascript:;">Aging</a></li>
						<li class="<?=($page_title=='sales_expense') ? 'active' : '' ?> menu-link" id="sales_expense" data-tab="tab-reports" data-ul="reports" data-menu="sales_expense" data-address="sales_expense"><a href="javascript:;">Sales & Expenses</a></li>
						<li class="<?=($page_title=='management') ? 'active' : '' ?> menu-link" id="management" data-tab="tab-reports" data-ul="reports" data-menu="management" data-address="management"><a href="javascript:;">Management</a></li>
					</ul>
				</li>
				<li class="tab-link <?=($page_tab=='Administrator') ? 'active' : '' ?>" role="tab" id="tab-admin">
					<a href="#admin" data-parent="#menu" data-toggle="collapse" aria-expanded="true" aria-controls="admin">
						<i class='fa fa-user'></i><span>Administrator</span>
					</a>
					<ul class="ul-link collapse animate-10 <?=($page_tab=='Administrator') ? 'in': ''?>" id="admin">
						<li class="<?=($page_title=='User Access') ? 'active' : '' ?> menu-link" id="user_access" data-tab="tab-admin" data-ul="admin" data-menu="user_access" data-address="user_access"><a href="javascript:;">User Access</a></li>
						<li class="<?=($page_title=='System Settings') ? 'active' : '' ?> menu-link" id="system_settings" data-tab="tab-admin" data-ul="admin" data-menu="system_settings" data-address="system_settings"><a href="javascript:;">System Settings</a></li>
						<li class="<?=($page_title=='Audit Trail') ? 'active' : '' ?> menu-link" id="audit_trail" data-tab="tab-admin" data-ul="admin" data-menu="audit_trail" data-address="audit_trail"><a href="javascript:;">Audit Trail</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- Page side panel end -->
		<div class="dv-page-main">
			<div class="dv-content" style="margin-left:0px;">