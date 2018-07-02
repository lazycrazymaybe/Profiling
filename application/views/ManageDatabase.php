<!-- MAIN -->
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title" style="color: red">*Backup your database here.</h3>
						</div>
						<div class="panel-body no-padding">
							<div class="col-md-4">
								<form id="backupForm" action="<?= base_url()?>Databases/backup">
									<div>
										<button class="btn btn-primary" style="margin-bottom: 15px"> Backup <span class="fa fa-download"></span></button>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>