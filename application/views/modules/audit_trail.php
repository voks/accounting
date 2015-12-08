<!-- Page content Start -->
<!-- Title -->
<div class="row">
	<div class="dv-header col-md-12">
		<span class="page-title"> » Audit Trail</span>
		<hr/>
	</div>
</div>
<form class="auditSearch-form">
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning alert-dismissible fade in  search-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Accounts Payable is not existing.
			</div>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Username</span>
			<select id="searchAudit_user" name="searchAudit[searchAudit_user]" class="form-control select2-dropdown" >
				<option value="">-- Select User --</option>
				<?php
				foreach ($user->result() as $key) {
					echo "<option>".$key->fname." ".$key->lname."</option>";
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<span class="txt">From</span>
			<input type="text" id="searchAudit_dateFRM" name="searchAudit[searchAudit_dateFRM]" placeholder="mm/dd/yyyy" class="form-control datepicker">
		</div>
		<div class="col-md-3">
			<span class="txt">To</span>
			<input type="text" id="searchAudit_dateTO" name="searchAudit[searchAudit_dateTO]" placeholder="mm/dd/yyyy" class="form-control datepicker">
		</div>
		<div class="col-md-3 margin-top-30">
			<button class="btn btn-style-1"><i class="fa fa-search"></i> Search</button>
		</div>
	</div>
</form>
<!--Table List Result-->
<div class="row">
	<div class="col-md-12">
		<table class="table search-table">
			<thead>
				<tr>
					<th>User</th>
					<th>User Type</th>
					<th>Action</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($audit_data->result() as $key){
					echo "<tr>
					<td class=''>".$key->full_name."</td>
					<td class=''>".$key->user_type."</td>
					<td class=''>".$key->a_action."</td>
					<td class=''>".$key->a_date."</td>
				</tr>";
			}
			?>
		</tbody>
	</table>
</div>
</div>
<!-- Page content end -->