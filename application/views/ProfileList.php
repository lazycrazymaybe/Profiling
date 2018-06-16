<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar" style="width: 220px">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=base_url()?>Administrators/dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?=base_url().'Administrators/employeesList'?>" class=""><i class="lnr lnr-users"></i> <span>Employees</span></a></li>
				<li><a href="<?=base_url().'Administrators/addProfilePage'?>" class=""><i class="lnr lnr-users"></i> <span>Add Profile</span></a></li>
				<li><a href="<?=base_url()?>Administrators/profiles" class="active"><i class="fa fa-list-alt"></i> <span>Profiles</span></a></li>
				<li><a href="<?=base_url()?>Administrators/removedProfiles" class=""><i class="lnr lnr-inbox"></i> <span>Removed Profiles</span></a></li>
			</ul>
		</nav>
	</div>
</div>
<!-- END LEFT SIDEBAR


<!-- MAIN -->
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">List Of Resident Personal Profile</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body no-padding">
							<div class="table-responsive">
								<table id="profile_list" class="table table-hover">
									<thead>
										<tr>
											<th>Name</th>
											<th>Birth Date</th>
											<th>Gender</th>
											<th>Address</th>
											<th>BHW</th>
											<th>Action</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Today <?= date('M d, Y')?></span></div>
							</div>
						</div>
						<div class="dialog_background">
							<dialog id="confirm-removal" class="confirm_removal">
								<header class="dialog_header">
									<p>Please Confirm</p>
								</header>
								<div class="dialog_content">
									
									<p id="dialog_body"><br><span id="name_of_to_remove"></span></p>
								</div>
								<footer class="dialog_footer">
									<button class="btn btn-danger" id="confirm">Confirm</button>
									<button id="cancel" type="button">Cancel</button>
								</footer>
							</dialog>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

