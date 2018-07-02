<!-- MAIN -->
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-profile">
				<div class="clearfix">
					<!-- PROFILE HEADER -->
					<div class="profile-header">
						<div class="overlay"></div>
						<div class="profile-main">
							<h3 class="name"><?=$this->session->userdata('fname')." ".$this->session->userdata('lname')?></h3>
							<h3 class="name"><?=$this->session->userdata('username')?></h3>
							<span class="label label-primary">Administrator</span>
							<p></p>
							<div class="text-center"><a href="#" data-toggle="modal" data-target="#edit-data" id="<?=$this->session->userdata('empID')?>" class="btn btn-primary edit-data"><span class="lnr lnr-pencil"></span> &nbsp;Edit Profile</a></div>
						</div>
					</div>
					<!-- END PROFILE HEADER -->
					<!-- MODAL -->
					<div id="edit-data" class="modal fade">
					  <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					      	<div class="modal-header">
					        	<button type="button" class="close" data-dismiss="modal">&times;</button>
					        	<h4 class="modal-title text-center">Update Profile</h4>
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
										    <label for="mname">Middel Name</label>
										    <input type="input" class="form-control" name="mname" id="mname" aria-describedby="lastName" placeholder="Middle Name">
										</div>
										<div class="form-group">
										    <label for="contact_number">Contact Number</label>
										    <input type="number" class="form-control" name="contact_number" id="contact_number" aria-describedby="Contact Number" placeholder="Contact Number">
										</div>
										<div class="form-group">
											<label for="username">Username</label>
											<input type="input" class="form-control" name="username" id="username" aria-describedby="username" placeholder="Username">
										</div>
										<div class="form-group">
										    <label for="password1">Password</label>
										    <input type="password" class="form-control" name="password1" id="password1" aria-describedby="password1" placeholder="Password">
										</div>	
						    </div>
							<div class="modal-footer">
						      	<input type="hidden" class="form-control" name="option" id="option">
						      	<input type="hidden" class="form-control" name="empID" id="empID">
						      	<input type="hidden" class="form-control" name="password" id="password">
						      	<input type="hidden" class="form-control" name="isActive" id="isActive">
						      	<input type="hidden" class="form-control" name="userType" id="userType">
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
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->
