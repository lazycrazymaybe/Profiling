<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar" style="width: 220px"
>
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=base_url()?>Administrators/dashboard" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?=base_url().'Administrators/employeesList'?>" class=""><i class="lnr lnr-users"></i> <span>Employees</span></a></li>
				<li><a href="<?=base_url().'Administrators/addProfilePage'?>" class=""><i class="lnr lnr-users"></i> <span>Add Profile</span></a></li>
				<li><a href="<?=base_url()?>Administrators/profiles" class=""><i class="fa fa-list-alt"></i> <span>Profiles</span></a></li>
				<li><a href="<?=base_url()?>Administrators/removedProfiles" class=""><i class="lnr lnr-inbox"></i> <span>Removed Profiles</span></a></li>
			</ul>
		</nav>
	</div>
</div>
<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<!-- OVERVIEW -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Administrator's Overview</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="overiding_overview">
							<div class="col-md-3">
								<a href="<?=base_url()?>Administrators/employeesList">
									<div class="metric">
										<span class="icon"><i class="fa fa-users" style="margin-top: 15px;"></i></span>
										<p>
											<span class="number" style="font-color:black"><b><?= $admins?></b></span>
											<span class="title">Admins</span>
										</p>
									</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="<?=base_url()?>Administrators/employeesList">
									<div class="metric">
										<span class="icon"><i class="fa fa-users" style="margin-top: 15px;"></i></span>
										<p>
											<span class="number" style="font-color:black"><b><?= $employees?></b></span>
											<span class="title">Employees</span>
										</p>
									</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="<?=base_url()?>Administrators/profiles">
									<div class="metric">
										<span class="icon"><i class="fa fa-list-alt" style="margin-top: 15px;"></i></span>
										<p>
											<span class="number"><b><?= $totalPeople ?></b></span>
											<span class="title">Total Profiles</span>
										</p>
									</div>
								</a>
							</div>
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-qq" style="margin-top: 15px;"></i></span>
									<p>
										<span class="number"><b><?= $monthlyInputs?></b></span>
										<span class="title">New Profiles</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END OVERVIEW -->
			<!-- New Registrations -->
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">New Registered Employees</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body no-padding">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>User ID</th>
										<th>Name</th>
										<th>Username</th>
										<th>Phone Number</th>
										<th>Date Created</th>
										<th>User Type</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($newRegistrations as $value) {?>
									<tr>
										<td><?=$value['empID']?></td>
										<td><?=$value['lname'].", ".$value['fname']." ".substr($value['mname'],0,1)."."?></td>
										<td><?=$value['username']?></td>
										<td><?=$value['phone']?></td>
										<td><?=date('Y-m-d h:i A',strtotime($value['date']))?></td>
										<td><?=$value['type']?></td>
										<?php if($value['isactive'] == 1){ ?>
										<td><span class="label label-success">Active</span></td>
										<?php }else{ ?>
										<td><span class="label label-danger">Deactivate</span></td>
										<?php } ?>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<!-- MODAL -->
							<div id="edit-data" class="modal fade">
							  <div class="modal-dialog">
							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title text-center">Update User</h4>
							      </div>
							      <div class="modal-body">
							        <form method="post" id="user-form" novalidate>
							        	<div class="form-group">
											    <label for="fname">First Name</label>
											    <input type="input" class="form-control" name="fname" id="fname" aria-describedby="firstName" placeholder="First Name" required>
											  </div>
										   	<div class="form-group">
											    <label for="lname">Last Name</label>
											    <input type="input" class="form-control" name="lname" id="lname" aria-describedby="lastName" placeholder="Last Name">
											  </div>
											  <div class="form-group">
											    <label for="mname">Middle Name</label>
											    <input type="input" class="form-control" name="mname" id="mname" aria-describedby="lastName" placeholder="Last Name">
											  </div>
											  <div class="form-group">
											    <label for="username">Username</label>
											    <input type="input" class="form-control" name="username" id="username" aria-describedby="username" placeholder="Username">
											  </div>
											  <div class="form-group">
											    <label for="password">Password</label>
											    <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Passowrd" readonly>
											  </div>
											  <div class="form-group">
											  	<label for="userType">User Type</label>
													<select class="form-control" aria-describedby="userType" name="userType" id="userType">
												  	<?php $userType = array("User"=>"User","Admin"=>"Admin");
												  	  foreach($userType as $key => $value){ echo $key;?>
													  	<option value="<?=$key?>"><?=$value?></option>
													  	<?php } ?>
													</select>
												</div>
												<input type="checkbox" name="isActive" id="isActive" data-toggle="toggle" data-on="Activate" data-off="Deactivate" data-size="small">
												<label  id="resetWord" style="margin-left: 40px;" class="label label-default">Reset Password</label>
												<button type="button" class="btn btn-primary edit-data" name="resetPass" id="resetPass" style="margin-left:5px; height: 30px;"><i class="fa fa-refresh"></i></button>
							      </div>
								      <div class="modal-footer">
								      	<input type="hidden" class="form-control" name="userID" id="userID" aria-describedby="user_id">
								      	<input type="hidden" class="form-control" name="date" id="date">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        <input type="submit" id="action" name="action" value="Update" class="btn btn-primary"/>
								      </div>
							     		</form>

							    </div>

							  </div>
							</div>
							<!-- MODAL -->
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> This <?= date('F',strtotime('this month'))?>. Only 10 recent registrations are displayed.</span></div>
								<div class="col-md-6 text-right"><a href="<?=base_url().'Admins/users'?>" class="btn btn-primary">View All Users</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End New Registrations -->
			<!-- New Recent Logs -->
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">New Profiles
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body no-padding">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Age</th>
										<th>Birth Date</th>
										<th>Gender</th>
										<th>Address</th>
										<th>Status</th>
										<th>BHW</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($newProfiles as $value) { ?>
									<tr>
										<td><?=$value['fname'].', '.$value['lname'].' '.$value['mname']?>.</td>
										<?php $now = new DateTime(date('Y-m-d')); 
										      $bd = new DateTime(date('Y-m-d',strtotime($value['birth']))); 
										      $getDiff = $now->diff($bd);
										      $age=$getDiff->y; ?>
										<td><?=$age?></td>
										<td><?=$value['birth']?></td>
										<td><?=$value['gender']?></td>
										<td><?=$value['sitio'].', '.$value['brgy'].', '.$value['city']?></td>
										<td><?=$value['civilstatus']?></td>
										<td><?=$value['bhw']?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Today <?= date('F')?>. Only 20 recent logs are displayed</span></div>
								<div class="col-md-6 text-right"><a href="<?=base_url().'Admins/logs'?>" class="btn btn-primary">View All Logs</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Recent Logs -->
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->


