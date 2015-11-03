<!-- Page content Start -->
<div class="row">
	<form class="mainaccount-form">
		<!-- Title -->
		<div class="row">
			<div class="dv-header col-md-12">
				<span class="page-title"> » Charts of Accounts</span>
				<hr/>
			</div>
		</div>
		<!-- Alerts -->
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success alert-dismissible fade in  main-alert-success" role="alert">
					<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong>Success!</strong> Added New Main Account Record.
				</div>

				<div class="alert alert-warning alert-dismissible fade in  main-alert-warning" role="alert">
					<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong>Warning!</strong> Main Account already exist.
				</div>
			</div>
		</div>
		<!-- FirstRow -->
		<div class="row">
			<input  type="hidden" value="<?=$this->session->userdata('project_id')?>" name="mainAccount[project_id]" >
			<div class="col-md-3">
				<span class="txt">Date:</span>
				<input type="text" id="account_date" name="mainAccount[account_date]" class="form-control datepicker main_txtbox" date-format="mm/dd/yyyy" Placeholder="mm/dd/yyyy"/>
			</div>

			<div class="col-md-2">
				<span class="txt">Account Type:</span>
				<select class="form-control main_txtbox accountype-placeholder select2-dropdown" id="account_type" name="mainAccount[account_type]">
					<option value="Assets">Assets</option>
					<option value="Liabilities">Liabilities</option>
					<option value="Capital">Capital</option>
					<option value="Revenue">Revenue</option>
					<option value="Expense">Expense</option>
				</select>
			</div>

			<div class="col-md-2 txt-account-code">
				<span class="txt">Account Code</span>
				<input type="text" class="form-control main_txtbox accountcode-placeholder" Placeholder="1000" id="account_code" name="mainAccount[account_code]" />
			</div>

			<div class="col-md-5">
				<span class="txt">Account Title:</span>
				<input type="text" class="form-control main_txtbox" id="account_title" name="mainAccount[account_title]" />
			</div>
		</div>
		<!-- Second Row -->
		<div class="row">
			<div class="col-md-5">
				<span class="txt">Account Group:</span>
				<select class="form-control main_txtbox select2-dropdown " id="account_group" name="mainAccount[account_group]">
					<option> -- Select Account Group -- </option>
					<?php 
						foreach ($account_group as $data) {
							echo "<option>".$data->account_groupname."</option>";
						}
					?>
				</select>
			</div>
			<div class="col-md-7">
				<button type="submit" class="btn btn-style-1 animate-4 margin-top-30 pull-right"><i class="fa fa-plus"></i> Add Account </button>
			</div>
		</div>
	</form>
</div>

<!-- Sub Title -->
<div class="row">
	<div class="dv-header col-md-12">
		<span class="page-title"> » Accounts Record</span>
		<hr/>
	</div>
</div>
<!-- Alerts -->
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning alert-dismissible fade in  search-alert-warning" role="alert">
			<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>Warning!</strong> Main Account is not existing.
		</div>
	</div>
</div>
<!-- Search Fiellds -->
<form class="searchaccount-form">
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Account Type:</span>
			<select id="searchAccount_type" class="form-control select2-dropdown" name="search_account[search_accountgroup]">
				<option value="Assets">Assets</option>
				<option value="Liabilities">Liabilities</option>
				<option value="Capital">Capital</option>
				<option value="Revenue">Revenue</option>
				<option value="Expense">Expense</option>
			</select>
		</div>

		<div class="col-md-3">
			<span class="txt">Account Code:</span>
			<input type="text" class="form-control main_txtbox" Placeholder="1000" id="searchaccount_code" name="search_account[searchaccount_code]" />
		</div>
		<div class="col-md-4">
			<span class="txt">Account Tile:</span>
			<input type="text" class="form-control"  name="search_account[searchaccount_title]" id="searchaccount_title" />
		</div>

		<div class="col-md-2">
			<button type="submit" class="btn btn-style-1 animate-4 pull-left margin-top-35"><i class="fa fa-search"></i> Search </button>
		</div>
	</div>
</form>
<!-- Search Result Table List -->
<div class="row">
	<div class="col-md-11">
		<table class="table margin-top-20 search-table">
			<thead>
				<tr>
					<th>Account Type</th>
					<th>Account Code</th>
					<th>Account Name</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- Print Button -->
<div class="row">
	<div class="col-md-11">
		<a href="#" class="btn-style-1 animate-4 pull-left mainaccount-report-print"><i class="fa fa-print"></i> Print Result List</a>
	</div>
</div>
<!-- Modal content Start -->
<div class="modal fade accountsummary"  role="dialog" aria-labelledby="" aria-hidden="true" id="accountsummary">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-bg">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id=""></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<span class="modal-subtitle"> » Account Title Information</span>
						<hr/>
					</div>
				</div>
				<form class="">
					<div class="row">
						<div class="col-md-3">
							<span class="txt">Account Code</span>
							<input type="text" class="form-control entry-text" value="" id="accountcodeSummary">
						</div>

						<div class="col-md-9">
							<span class="txt">Account Title</span>
							<input type="text"  class="form-control sub-input-masked entry-subcode" id="accounttitleSummary" >
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<span class="txt">Account Type</span>
							<input type="text" class="form-control entry-text" value="" id="accounttypeSummary">
						</div>

						<div class="col-md-6">
							<span class="txt">Account Group</span>
							<input type="text"  class="form-control sub-input-masked entry-subcode "  id="accountgroupSummary">
						</div>

						<div class="col-md-3">
							<span class="txt">Date Created</span>
							<input type="text"  class="form-control sub-input-masked entry-subcode "  id="accountdateSummary">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-style2 " data-dismiss="modal" aria-label="Close"> Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade deleteConfirmation"  role="dialog" aria-labelledby="" aria-hidden="true" id="deleteConfirmation">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header modal-header-bg">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="">» Delete Confirmation</h4>
			</div>
			<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<span class="txt">» Do you want to Delete this Account?</span>
							<span class="txt txttitle"></span>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-style-2 deleteTitle"> Delete</button>
				<button class="btn btn-style2 " data-dismiss="modal" aria-label="Close"> Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- Modal content Start -->