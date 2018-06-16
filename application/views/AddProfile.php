<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar" style="width: 220px">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=base_url()?>Administrators/dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?=base_url().'Administrators/employeesList'?>" class=""><i class="lnr lnr-users"></i> <span>Employees</span></a></li>
				<li><a href="<?=base_url().'Administrators/addProfilePage'?>" class="active"><i class="lnr lnr-users"></i> <span>Add Profile</span></a></li>
				<li><a href="<?=base_url()?>Administrators/profiles" class=""><i class="fa fa-list-alt"></i> <span>Profiles</span></a></li>
				<li><a href="<?=base_url()?>Administrators/removedProfiles" class=""><i class="lnr lnr-inbox"></i> <span>Removed Profiles</span></a></li>
			</ul>
		</nav>
	</div>
</div>
<!-- END LEFT SIDEBAR

<!-- MAIN -->
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading"  style="background: #E5E5E5">
							<h3 class="panel-title">ADD PROFILE</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<span class="panel-note" style="margin-left: 20px;"><b><span style="color: darkred;">Note: </span>All fields that has * are required. The rest are Optional.</b></span>
							</div>
							<span id="error_message"></span>
							<form method="post" name="add_profile_form" id="add_profile_form">
								<!-- Address -->
								<span class="col-md-12"><p class="form_title"><b>ADDRESS</b></p></span>
								<div class="col-md-6">
									<div class="form_style">
										<label for="region">*Region<br>
											<input type="input" name="region" id="region" aria-describedby="Region" value="REGION X" readonly>
										</label >
										<label for="city">*City/Minicipality<br>
											<input type="input" name="city" id="city" aria-describedby="City" value="CAGAYAN DE ORO CITY" readonly>
										</label>
										<label for="sitio">*Sitio<br>
											<input type="input" name="sitio" id="sitio" aria-describedby="Sitio">
										</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form_style">
										<label for="province">*Province<br>
											<input type="input" name="province" id="province" aria-describedby="Province" value="MISAMIS ORIENTAL" readonly>
										</label> 
										<label for="barangay">*Brangay<br>
											<input type="input" name="barangay" id="barangay" aria-describedby="Brangay" value="CAMAMAN-AN" readonly>
										</label>
									</div>
								</div>
								<!-- Personal Information -->
								<span class="col-md-12"><p class="form_title"><b>META INFORMATION</b></p></span>
								<div class="col-md-6">
									<div class="form_style">
										<label for="fristName">*First Name<br>
											<input type="input" name="firstName" id="firstName" aria-describedby="First Name">
										</label><br>
										<label for="lastName">*Last Name<br>
											<input type="input" name="lastName" id="lastName" aria-describedby="Last Name">
										</label><br>
										<label for="middleName">*Middle Name<br>
											<input type="input" name="middleName" id="middleName" aria-describedby="Middle Name">
										</label><br>
										<label for="name_extension">Extension<br>
											<input type="input" name="name_extension" id="name_extension" aria-describedby="Extension">
										</label><br>
										<label for="pob">*Place Of Birth<br>
											<input type="input" name="pob" id="pob" aria-describedby="Place Of Birth">
										</label><br>
										<label for="dob">*Date Of Birth<br>
											<input type="date" name="dob" id="dob" aria-describedby="Date Of Birth">
										</label><br>
										<label for="gender">*Gender<br>
											<select name="gender" id="gender" aria-describedby="Gender">
												<option value="">Select</option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</label><br>
										<label for="vin">Vin Number<br>
											<input type="input" name="vin" id="vin" aria-describedby="Vin Number">
										</label><br>
										<label for="no_siblings">Number Of Siblings<br>
											<input type="number" name="no_siblings" id="no_siblings" aria-describedby="Number Of Siblings" min="0">
										</label><br>
										<label for="present_address">Present Address<br>
											<input type="input" name="present_address" id="present_address" aria-describedby="Present Address" min="0">
										</label><br>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form_style">
										<label for="civil_status">*Civil Satus<br>
											<select name="civil_status" id="civil_status" aria-describedby="Civil Status">
												<option value="">Select</option>
												<option value="Single">Single</option>
												<option value="Married">Married</option>
												<option value="Widow">Widow</option>
												<option value="Widower">Widower</option>
												<option value="Separated">Separated</option>
											</select>
										</label><br>
										<label for="spouse">Spouse<br>
											<input type="input" name="spouse" id="spouse" aria-describedby="Spouce">
										</label><br>
										<label for="occupation">Profession/Occupation<br>
											<input type="input" name="occupation" id="occupation" aria-describedby="Profession">
										</label><br>
										<label for="mother">Mother<br>
											<input type="input" name="mother" id="mother" aria-describedby="Mother">
										</label><br>
										<label for="mother_occupation">Occupation<br>
											<input type="input" name="mother_occupation" id="mother_occupation" aria-describedby="Occupation">
										</label><br>
										<label for="father">Father<br>
											<input type="input" name="father" id="father" aria-describedby="Father">
										</label><br>
										<label for="father_occupation">Occupation<br>
											<input type="input" name="father_occupation" id="father_occupation" aria-describedby="Occupation">
										</label><br>
										<label for="comelect_status">*Comelec Status<br>
											<select name="comelect_status" id="comelect_status" aria-describedby="Comelec Status">
												<option value="">Select</option>
												<option value="Registered">Registered</option>
												<option value="Unregistered">Unregistered</option>
											</select>
										</label><br>
										<label for="no_children">Number Of Children<br>
											<input type="number" name="no_children" id="no_children" aria-describedby="Number Of Children" min="0">
										</label><br>
										<label for="bhw">*BHW<br>
											<input type="input" name="bhw" id="bhw" aria-describedby="bhw">
										</label><br>
									</div>
								</div>
								<!-- Add Family Member -->
								<span class="col-md-12"><p class="form_title"><b>ADD FAMILY MEMBER</b></p></span>
								<div class="col-md-12">
									<table name="dynamic_forms" id="dynamic_forms">
										<tr>
											<td>
											<button type="button" name="add_family_member" id="add_family_member" class="btn btn-success"><span class="fa fa-plus"></span></button>
											</td>
										</tr>
									</table>
								</div>
								<div class="col-md-12 submit_button">
									<input type="hidden" class="form-control" name="add_profile_option" value="addProfile" id="add_profile_option">
									<input type="hidden" class="form-control" name="yes_no" value="no" id="yes_no">
									<input type="submit" id="add_profile_action" name="add_profile_action" value="Add Profile" />
								</div>
							
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
								<button type="submit" class="btn btn-danger" id="confirm">Confirm</button>
								</form>
								<button id="cancel" type="button">Cancel</button>
							</footer>
						</dialog>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>