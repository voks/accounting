<!-- Page content Start -->
<!-- Title -->
<div class="row">
	<div class="dv-header col-md-12">
		<span class="page-title"><i class="fa fa-key"></i> Account Settings</span>
	</div>
</div>

<form class="userAccess-form">
	<!--Add New User-->
	<div class="row">
		<div class="col-md-1 margin-top-10">
			<hr/>
		</div>
		<div class="col-md-3">
			<span class="page-subtitle">Add New System User</span>
		</div>
		<div class="col-md-8 margin-top-10">
			<hr/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<span class="txt">First Name</span>
			<input type="text" class="form-control">
		</div>

		<div class="col-md-3">
			<span class="txt">Last Name</span>
			<input type="text" class="form-control">
		</div>

		<div class="col-md-3">
			<span class="txt">Username</span>
			<input type="text" class="form-control">
		</div>

		<div class="col-md-3">
			<span class="txt">Password</span>
			<input type="text" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<span class="txt">User Type</span>
			<select name="userType" id="" class="form-control">
				<option value=""></option>
			</select>
		</div>
		<div class="col-md-3">
			<button class="btn btn-style-1 margin-top-30" onclick="show_option();"><i class='fa fa-plus'></i> Add Option</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<span class="modal-subtitle">Add New User Type</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<span class="txt">User Type</span>
					<input type="text" placeholder="Ex. Administrator" class="form-control">
				</div>
			
				<div class="col-md-1 margin-top-30 margin-right-30">
					<button class="btn btn-style-1"><i class="fa fa-check"></i> Save Option</button>
				</div>
				<div class="col-md-1 margin-top-30">
					<button class="btn btn-style-2"><i class="fa fa-remove"></i> Cancel </button>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="#" class="btn btn-style-1 pull-right " id="alert" data-toggle="modal" data-target=".addnew"><i class="fa fa-plus"></i> Add New System User</a>
		</div>
	</div>
</form>
<div class="row">
	<div class="col-md-1 margin-top-10">
		<hr/>
	</div>
	<div class="col-md-3">
		<span class="page-subtitle">System User Credentials</span>
	</div>
	<div class="col-md-8 margin-top-10">
		<hr/>
	</div>
</div>

<!-- Table User-->
<div class="row">
	<div class="col-md-12">
		<table class="table userlist">
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Password</th>
					<th>User Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>	        
				<tr>
					<td>1</td>
					<td>Michelle</td>
					<td>Anne</td>
					<td>admin</td>
					<td>admin</td>
					<td>Administrator</td>
					<td><span class='action'><a href="#" class="" id="alert" data-toggle="modal" data-target=".userAccess"><i class='fa fa-edit'></i> Update</a></span> | <span class='action'><i class='fa fa-trash-o'></i> <a href='#' onclick=''>Delete</a></span></td>
				</tr>
			</tbody>
		</table>

	</div>
</div>
<!-- Page content end -->