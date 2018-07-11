<!-- MAIN -->
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">List Of Removed Resident Personal Profile</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
							<?php if ($this->session->userdata('type') === 'Employee'){ ?>
								<div class="row">
									<span class="panel-note" style="margin-left: 20px;"><b><span style="color: darkred;">Note: </span>Only an Admin can add or delete Resident Personal Informations.</b></span>
								</div>
							<?php } ?>
						</div>
						<div class="panel-body no-padding">
							<table id="removed_profile_list" class="table table-hover">
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

