<!-- MAIN -->
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading"  style="background: #E5E5E5">
							<h3 class="panel-title"><span id="bloter_title">ADD BLOTTER RECORD FOR</span> <b><?= $fname." ".$mname." ".$lname?></b></h3>
							<div class="right">
								<a href="<?= base_url()?>Routes/casePage/<?= $profileID?>"><button type="button" class="back_button">Back to cases</button></a>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<span class="panel-note" style="margin-left: 20px;"><b><span style="color: darkred;">Note: </span>All fields that has * are required. The rest are Optional.</b></span>
							</div>
							<span id="error_message"></span>
							<form method="post" name="add_case_form" id="add_case_form">
								<!-- Address -->
								<span class="col-md-12"><p class="form_title"><b>CASE INFO</b></p></span>
								<div class="col-md-6">
									<div class="form_style">
										<label for="ctitle">*Case Title<br>
											<input type="input" name="ctitle" id="ctitle" aria-describedby="ctitle" value="" >
										</label >
										<label for="clupon">*Lupon<br>
											<input type="input" name="clupon" id="clupon" aria-describedby="clupon" value="" >
										</label>
										<label for="cdate">*Date Filed<br>
											<input type="date" name="cdate" id="cdate" aria-describedby="cdate">
										</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form_style">
										<label for="cwhome">*By_Whom<br>
											<input type="input" name="cwhome" id="cwhome" aria-describedby="cwhome" value="" >
										</label> 
										<label for="cstatus">*Status<br>
											<select name="cstatus" id="cstatus" aria-describedby="Status">
												<option value="">Select</option>
												<option value="Served">Served</option>
												<option value="Not Served">Not Served</option>
											</select>
										</label>
										<label for="cDescription">*Description<br>
											<textarea name="cdescription" id="cdescription"></textarea>
										</label>
									</div>
								</div>
								<div class="col-md-12 submit_button">
									<input type="hidden" class="form-control" name="profileID" id="profileID" value="<?= $profileID?>">
									<input type="hidden" id="add_case_action" name="add_case_action" value="addCase" />
									<input type="submit" id="add_case_action" name="add_case_action" value="Confirm" />
								</div>
				</div>
			</div>
		</div>
	</div>
</div>