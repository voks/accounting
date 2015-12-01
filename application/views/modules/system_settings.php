<!-- Page content Start -->
<!-- Title -->
<div class="row">
	<div class="dv-header col-md-12">
		<span class="page-title"> » System Settings</span>
		<hr/>
	</div>
</div>
<!-- Sub Title  -->
<div class="row">	
	<div class="col-md-2">	
		<span class="page-subtitle">Accounts Group</span>
	</div>
</div>
<!-- FirstRow -->
<div class="row">
	<form class="accountgroup-form">
		<div class="row">
			<div class="col-md-6">
				<div class="alert alert-success alert-dismissible fade in  accountgroup-alert-success" role="alert">
				  <button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				  <strong>Success!</strong> New Account Group is Added.
				</div>

				<div class="alert alert-warning alert-dismissible fade in  accountgroup-alert-warning" role="alert">
				  <button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				  <strong>Warning!</strong> Account Group is already exist.
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<span class="txt">Account Type:</span>
				<select name="accountType" class="form-control" id="accountType">
					<option value="Assets">Assets</option>
					<option value="Liabilities">Liabilities</option>
					<option value="Capital">Capital</option>
					<option value="Revenue">Revenue</option>
					<option value="Expense">Expense</option>
				</select>
			</div>

			<div class="col-md-4">
				<span class="txt">Account Group Name:</span>
				<input type="text" name="accountGroup" id="accountGroup" class="form-control" />
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-style-1 animate-4 margin-top-30"><i class="fa fa-plus"></i> Add Account</button>
			</div>
		</div>
		
	</form>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="alert alert-danger alert-dismissible fade in  accountgroup-alert-danger" role="alert">
		  <button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
		  <strong>Success!</strong> Account Group deleted.
		</div>

		<div class="alert alert-danger alert-dismissible fade in  accountgroup-alert-danger" role="alert">
		  <button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
		  <strong>Warning!</strong> Do you want to delete this Account Group?.
		  	<a class="btn-style-2 pointer">Yes</a>
		  	<a class="btn-style-0 pointer">No</a>
		</div>
	</div>
</div>
<br/>
<!-- row -->
<div class="row">
	<div class="col-md-offset-4 col-md-2">
		<span class="txt">Account Type:</span>
		<select class="form-control" id="filter">
			<option value="All">All</option>
			<option value="Assets">Assets</option>
			<option value="Liabilities">Liabilities</option>
			<option value="Capital">Capital</option>
			<option value="Revenue">Revenue</option>
			<option value="Expense">Expense</option>
		</select>
	</div>
</div>
<!-- /row -->
<!-- Table List -->
<div class="row">
	<div class="col-md-6" id="table-account-group">
		<table class="table accountgroup-table animate-6" id="accountgroup-table">
			<thead>
				<tr>
					<th>Account Type</th>
					<th>Account Group</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($account_group as $data) {
						echo "
								<tr class='animate-6'>
								<td>".$data->account_type."</td>
								<td>".$data->account_groupname."</td>
								<td><i class='fa fa-trash-o btn-style-2 animate-4 pointer accountgroup-item' data-item='".$data->id."'></i></td>
								</tr>
							 ";
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-md-2">
		<span class="page-subtitle">Copyright</span>
	</div>
</div>

<form class="form-copyrights">
	<div class="row">
		<div class="col-md-6">
			<div class="alert alert-success alert-dismissible fade in  copyrights-alert-success" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Success!</strong> Copyrights Updated.
			</div>

			<div class="alert alert-warning alert-dismissible fade in  copyrights-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Coprights can't Add.
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<span class="txt">Company Name:</span>
			<input type="text" name="copyrights[company_name]" id="company_name" class="form-control" value="<?=$copyright[0]['company_name']?>" disabled="true">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<span class="txt">Year</span>
			<input type="text" name="copyrights[year]" id="year" class="form-control" value="<?=$copyright[0]['year']?>" disabled="true">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<span class="txt">Footer info</span>
			<textarea class="form-control" name="copyrights[footer]" id="footer" cols="30" rows="10" disabled="true"><?=$copyright[0]['footer']?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-30 pull-right"><i class="fa fa-plus"></i> Update Copyrights </button>
		</div>
	</div>
</form>

<!--Delete Account group Modal-->
<div class="modal fade deleteGroup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="deleteGroup">
	<div class="modal-dialog modal-s">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-offset-2 col-md-5">
						<span class="txt">Are you sure to delete the user?</span>
					</div>
					<div class="col-md-3">
						<button class="btn btn-style-1" type="button"  id="btn_delgroup">Yes</button>
						<button class="btn btn-style2 " data-dismiss="modal" aria-label="Close"> No</button>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<!--Confirmation Modal Modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="del-success">
	<div class="modal-dialog modal-s">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-offset-1 col-md-9">
						<span class="txt"> Account group has been successfully deleted!</span>
					</div>
					<div class="col-md-2">
						<button class="btn btn-style2" id="btn_ok" data-dismiss="modal" aria-label="Close"> OK</button>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- Page content end -->