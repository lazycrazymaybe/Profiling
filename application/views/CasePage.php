<!-- MAIN -->
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">List Of <?= $profile->lname.', '.$profile->fname.' '.$profile->mname.'\'s'.' cases.'?></h3>
							<input type="hidden" name="profileID" value="<?= $profile->profileID?>" id="profile_ID">
							<div class="right">
								<a href="<?= base_url()?>Routes/profiles"><button type="button" class="back_button">Back to profiles</button></a>
							</div>
							<a href="<?= base_url()?>Routes/addCasePage/<?= $profile->profileID?>"><button type="button" id="createUser" data-toggle="modal" data-target="#edit-data" class="btn btn-success" style="margin-top:10px;background-color:#676A6D;width: 90px; height: 30px;"><i class="fa fa-plus"></i> Add Case </button></a>
							<span id="error_message"></span>
						</div>
						<div class="panel-body no-padding">
							<?php if(count($cases) > 0){ ?>
							<table id="	" class="table table-hover">
								<thead>
									<tr>
										<th width="10%">Case Title</th>
										<th width="12%">By Whome</th>
										<th width="12%">Lupon</th>
										<th width="8%">Status</th>
										<th width="10%">Date</th>
										<th width="26%">Description</th>
										<th width="22%">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($cases as $case) { ?>
										<tr>
											<td><?= $case->caseTitle?></td>
											<td><?= $case->byWhome?></td>
											<td><?= $case->lupon?></td>
											<?php if($case->status == "Served"){ ?>
											<td><span class="label label-success"><?= $case->status?></span></td>
											<?php }else{ ?>
											<td><span class="label label-danger"><?= $case->status?></span></td>
											<?php } ?>
											<td><?= $case->date?></td>
											<td><?= $case->description?></td>
											<td>
												<div class="action_buttons">
													<a href="<?= base_url()?>Routes/updateCasePage/<?= $case->caseID?>"><button class="change_button" id="<?= $case->caseID?>">Change</button></a>
													<?php if($case->status == "Served"){ ?>
													<button class="served_button">Served</button>
													<?php }if($case->status == "Not Served"){ ?>
													<a href="<?= base_url()?>Cases/changeStatus/<?= $case->caseID?>"><button class="serve_button">Serve</button></a>
													<?php } ?>
													<?php if($case->status == "Served"){ ?>
													<button type="button" class="remove_button" id="<?= $case->caseID?>">Remove</button>
													<?php }else{ ?>
													<button class="removed_button">Remove</button>
													<?php } ?>
												</div>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<?php }else{ ?>
								<center><h3>This person has no case record.</h3></center>
							<?php } ?>
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