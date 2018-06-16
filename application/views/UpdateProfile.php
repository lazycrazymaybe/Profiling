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

<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading"  style="background: #E5E5E5">
							<h3 class="panel-title">UPDATE PROFILE</h3>
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
											<input type="input" name="region" id="region" aria-describedby="Region" value="<?= $data->region?>" readonly>
										</label >
										<label for="city">*City/Minicipality<br>
											<input type="input" name="city" id="city" aria-describedby="City" value="<?= $data->city?>" readonly>
										</label>
										<label for="sitio">*Sitio<br>
											<input type="input" name="sitio" id="sitio" value="<?= $data->sitio?>" aria-describedby="Sitio">
										</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form_style">
										<label for="province">*Province<br>
											<input type="input" name="province" id="province" aria-describedby="Province" value="<?= $data->province?>" readonly>
										</label> 
										<label for="barangay">*Brangay<br>
											<input type="input" name="barangay" id="barangay" aria-describedby="Brangay" value="<?= $data->brgy?>" readonly>
										</label>
									</div>
								</div>
								<!-- Personal Information -->
								<span class="col-md-12"><p class="form_title"><b>META INFORMATION</b></p></span>
								<div class="col-md-6">
									<div class="form_style">
										<label for="fristName">*First Name<br>
											<input type="input" name="firstName" id="firstName" aria-describedby="First Name" value="<?= $data->fname?>">
										</label><br>
										<label for="lastName">*Last Name<br>
											<input type="input" name="lastName" id="lastName" aria-describedby="Last Name" value="<?= $data->lname?>">
										</label><br>
										<label for="middleName">*Middle Name<br>
											<input type="input" name="middleName" id="middleName" aria-describedby="Middle Name"  value="<?= $data->mname?>">
										</label><br>
										<label for="name_extension">Extension<br>
											<input type="input" name="name_extension" id="name_extension" aria-describedby="Extension" value="<?= $data->extension?>">
										</label><br>
										<label for="pob">*Place Of Birth<br>
											<input type="input" name="pob" id="pob" aria-describedby="Place Of Birth" value="<?= $data->pob?>">
										</label><br>
										<label for="dob">*Date Of Birth<br>
											<input type="date" name="dob" id="dob" aria-describedby="Date Of Birth" value="<?= $data->birth?>">
										</label><br>
										<label for="gender">*Gender<br>
											<select name="gender" id="gender" aria-describedby="Gender">
												<option selected="<?=$data->gender?>" value="<?=$data->gender?>"><?=$data->gender?></option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</label><br>
										<label for="vin">Vin Number<br>
											<input type="input" name="vin" id="vin" aria-describedby="Vin Number" value="<?= $data->vin?>">
										</label><br>
										<label for="no_siblings">Number Of Siblings<br>
											<input type="number" name="no_siblings" id="no_siblings" aria-describedby="Number Of Siblings" min="0" value="<?= $data->nos?>">
										</label><br>
										<label for="present_address">Present Address<br>
											<input type="input" name="present_address" id="present_address" aria-describedby="Present Address" value="<?= $data->presadd?>">
										</label><br>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form_style">
										<label for="civil_status">*Civil Satus<br>
											<select name="civil_status" id="civil_status" aria-describedby="Civil Status">
												<option selected="<?=$data->civilstatus?>" value="<?=$data->civilstatus?>"><?=$data->civilstatus?></option>
												<option value="Single">Single</option>
												<option value="Married">Married</option>
												<option value="Widow">Widow</option>
												<option value="Widower">Widower</option>
												<option value="Separated">Separated</option>
											</select>
										</label><br>
										<label for="spouse">Spouse<br>
											<input type="input" name="spouse" id="spouse" aria-describedby="Spouce" value="<?= $data->spouse?>">
										</label><br>
										<label for="occupation">Profession/Occupation<br>
											<input type="input" name="occupation" id="occupation" aria-describedby="Profession" value="<?= $data->profession?>">
										</label><br>
										<label for="mother">Mother<br>
											<input type="input" name="mother" id="mother" aria-describedby="Mother" value="<?= $data->mother?>">
										</label><br>
										<label for="mother_occupation">Occupation<br>
											<input type="input" name="mother_occupation" id="mother_occupation" aria-describedby="Occupation" value="<?= $data->occupationm?>">
										</label><br>
										<label for="father">Father<br>
											<input type="input" name="father" id="father" aria-describedby="Father" value="<?= $data->father?>">
										</label><br>
										<label for="father_occupation">Occupation<br>
											<input type="input" name="father_occupation" id="father_occupation" aria-describedby="Occupation" value="<?= $data->occupationf?>">
										</label><br>
										<label for="comelect_status">*Comelec Status<br>
											<select name="comelect_status" id="comelect_status" aria-describedby="Comelec Status">
												<option selected="<?=$data->comstat?>" value="<?=$data->comstat?>"><?=$data->comstat?></option>
												<option value="Registered">Registered</option>
												<option value="Unregistered">Unregistered</option>
											</select>
										</label><br>
										<label for="no_children">Number Of Children<br>
											<input type="number" name="no_children" id="no_children" aria-describedby="Number Of Children" min="0" value="<?= $data->noc?>">
										</label><br>
										<label for="bhw">*BHW<br>
											<input type="input" name="bhw" id="bhw" aria-describedby="bhw" value="<?= $data->bhw?>">
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
										<?php $count = 0; 
										if(count($fmember) != 0){
										  foreach($fmember as $value){ 
										      	$count++; ?>
										    <tr class="form_style" id="row<?=$value->fmemberID?>">
											<td>
												<input type="input" name="name[]" id="name" placeholder="Enter Family Member" class="name_list" style="width: 90%" value="<?=$value->name?>">
											</td>
											<input type="hidden" name="fmemberID[]" id="fmemberID" class="name_list" value="<?=$value->fmemberID?>">
											<td>
												<select name="relationship[]" id="relationship" class="relationship_list" style="width: 90%">
													<option selected="<?=$value->relation?>" value="<?=$value->relation?>"><?=ucfirst($value->relation)?></option>												
													<option value="son">Son</option>													
													<option value="daughter">Daughter</option>													
													<option value="sister">Sister</option>													
													<option value="brother">Brother</option>													
													<option value="mother">Mother</option>													
													<option value="father">Father</option>													
													<option value="gradpa">Grand Father</option>													
													<option value="gradma">Grand Mother</option>
													<option value="gradson">Grand Son</option>													
													<option value="graddaughter">Grand Daughter</option>													
												</select>
											</td>
											<td>
												<button type="button" name="remove" id="<?=$value->fmemberID?>" class="btn btn-danger btn_remove"><span class="fa fa-minus"></span></button>
											</td>
										</tr>
										<?php }}?>
									</table>
								</div>
								<div class="col-md-12 submit_button">
									<input type="hidden" class="form-control" name="add_profile_option" value="updateProfile" id="add_profile_option">
									<input type="hidden" class="form-control" name="yes_no" value="yes" id="yes_no">
									<input type="hidden" class="form-control" name="addressID" value="<?=$data->addressID?>" id="addressID">
									<input type="hidden" class="form-control" name="profileID" value="<?=$data->profileID?>" id="profileID">
									<input type="submit" id="add_profile_action" name="add_profile_action" value="Update Profile" style="width: 150px" />
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