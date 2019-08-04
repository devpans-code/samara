<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
	<title>Crud Operation using AJAX.</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assests/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assests/datatables/css/dataTables.bootstrap.css">
	<script type="text/javascript" src="<?= base_url();?>assests/jquery/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assests/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assests/datatables/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assests/datatables/js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assests/js/book.js"></script>
</head>
<body>
<div class="container">
	<center>
		<h2>Learn Crud Operation in CodeIgniter using Ajax and Bootstrap</h2>
		<hr>
		<h3><b>Person Information</b></h3>
	</center>
	<button class="btn btn-success" onclick="add_book();"><i class="glyphicon glyphicon-plus"></i> Add Person
	</button>
	<br><br>
	<table id="table_id" class="table table-striped table-bordered" cellspacing="5" width="100%">
		<thead>
			<tr>
				<th>Person ID</th>
				<th>Name</th>
				<th>Age</th>
				<th>Date of Birth</th>
				<th>Mobile</th>
				<th>Email</th>
				<th>Address 1</th>
				<th>Address 2</th>
				<th>City</th>
				<th>State</th>
				<th>Country</th>
				<th>Postal Code</th>
				<th style="width:80px;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php  
				foreach ($books as $book) 
				{
			?>
				<tr>
					<td><?= $book -> id;?></td>
					<td><?= $book -> name;?></td>
					<td><?= $book -> age;?></td>
					<td><?= $book -> dob;?></td>
					<td><?= $book -> mobile;?></td>
					<td><?= $book -> email;?></td>
					<td><?= $book -> add1;?></td>
					<td><?= $book -> add2;?></td>
					<td><?= $book -> city_name;?></td>
					<td><?= $book -> state_name;?></td>
					<td><?= $book -> country_name;?></td>
					<td><?= $book -> pincode;?></td>
					<td>
						<button class="btn btn-warning" onclick="edit_book(<?= $book -> id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
						<button class="btn btn-danger" onclick="delete_book(<?= $book -> id;?>)"><i class="glyphicon glyphicon-remove"></i></button>
					</td>
				</tr>
			<?php
				}
			?>
		</tbody>
	</table>
</div>

<!----------------------------------------------FORM CONTENT---------------------------------------------->

<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">
				&times;</span></button>
        		<h3 class="modal-title">Books Form</h3>
			</div>
			<div class="modal-body form">
        		<form id="form" class="form-horizontal" method="POST" enctype="multipart/form-data">
          			<input type="hidden" value="" name="id"/>
          			<div class="form-body">
	            		<div class="form-group">
	             	 		<label class="control-label col-md-3">Name</label>
	             			<div class="col-md-4">
	                			<input name="name" placeholder="First Name" class="form-control" type="text">
	              			</div>
	            		</div>
			            <div class="form-group">
			            	<label class="control-label col-md-3">Age</label>
			              	<div class="col-md-4">
			                	<input name="age" placeholder="Age" class="form-control" type="text">
			              	</div>
			            </div>
			            <div class="form-group">
							<label class="control-label col-md-3">DOB</label>
							<div class="col-md-4">
								<input name="dob" placeholder="Date-of-Birth" class="form-control" type="date">
							</div>
						</div>
						<div class="form-group">
			            	<label class="control-label col-md-3">Mobile</label>
			              	<div class="col-md-6">
			                	<input name="mobile" placeholder="Mobile" class="form-control" type="text">
			              	</div>
			            </div>
			            <div class="form-group">
			            	<label class="control-label col-md-3">Email</label>
			              	<div class="col-md-6">
			                	<input name="email" placeholder="Email Address" class="form-control" type="email">
			              	</div>
			            </div>
			            <div class="form-group">
			            	<label class="control-label col-md-3">Password</label>
			              	<div class="col-md-6">
			                	<input name="Password" placeholder="Password" class="form-control" type="password">
			              	</div>
			            </div>
			            <div class="form-group">
			            	<label class="control-label col-md-3">Confirm</label>
			              	<div class="col-md-6">
			                	<input name="confirm" placeholder="Confirm" class="form-control" type="password">
			              	</div>
			            </div>
	            		<div class="form-group">
	             			<label class="control-label col-md-3">Address 1</label>
	              			<div class="col-md-6">
								<input name="add1" placeholder="Enter Local Address" class="form-control" type="text">
	              			</div>
	            		</div>
	            		<div class="form-group">
	             			<label class="control-label col-md-3">Address 2</label>
	              			<div class="col-md-6">
								<input name="add2" placeholder="Near by location" class="form-control" type="text">
	              			</div>
	            		</div>
	            		<div class="form-group row">
							<label class="control-label col-sm-3">Country Name</label>
							<div class="col-sm-4">
								<select class="form-control" name="Country" id="country">
									<option value="">Select Country</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-3">State Name</label>
							<div class="col-sm-4">
								<select class="form-control action" name="State" id="state">
									<option value="">Select State</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-3">City Name</label>
							<div class="col-sm-4">
								<select class="form-control" name="City" id="city">
									<option value="">Select City</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
	             			<label class="control-label col-md-3">Pincode</label>
	              			<div class="col-md-4">
								<input name="pincode" placeholder="Enter Pincode" class="form-control" type="text">
	              			</div>
	            		</div>
          			</div>
        		</form>
        		<div class="modal-footer">
           	 		<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          		</div>
          	</div>
		</div>
	</div>	
</div>
</body>
</html>

