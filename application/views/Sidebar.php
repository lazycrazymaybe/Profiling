<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar" style="width: 220px">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li>
					<a href="<?=base_url()?>Routes/dashboard" class="<?= $is_active[0]?>"><i class="fa fa-home"></i> <span>Dashboard</span></a>
				</li>
				<li>
					<a href="<?=base_url().'Routes/employeesList'?>" class="<?= $is_active[1]?>"><i class="fa fa-user-circle"></i> <span>Employees</span></a>
				</li>
				<?php if ($this->session->userdata('type') === 'Admin'): ?>
				<li>
					<a href="<?=base_url().'Routes/addProfilePage'?>" class="<?= $is_active[2]?>"><i class="fa fa-user-plus"></i> <span>Add Profile</span></a>
				</li>
				<?php endif ?>
				<li>
					<a href="<?=base_url()?>Routes/profiles" class="<?= $is_active[3]?>"><i class="fa fa-users"></i> <span>Profiles</span></a>
				</li>
				<li>
					<a href="<?=base_url()?>Routes/removedProfiles" class="<?= $is_active[4]?>"><i class="fa fa-archive"></i> <span>Removed Profiles</span></a>
				</li>
				<?php if($this->session->userdata('type') === 'Admin'){ ?>
				<li>
					<a href="<?=base_url()?>Routes/backupDatabase" class="<?= $is_active[5]?>"><i class="fa fa-database"></i> <span>Manage Database</span></a>
				</li>
				<?php } ?>
			</ul>
		</nav>
	</div>
</div>
<!-- END LEFT SIDEBAR -->