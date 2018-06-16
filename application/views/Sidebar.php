<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar" style="width: 220px">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=base_url()?>Routes/dashboard" class="<?= $is_active[0]?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?=base_url().'Routes/employeesList'?>" class="<?= $is_active[1]?>"><i class="lnr lnr-users"></i> <span>Employees</span></a></li>
				<li><a href="<?=base_url().'Routes/addProfilePage'?>" class="<?= $is_active[2]?>"><i class="lnr lnr-users"></i> <span>Add Profile</span></a></li>
				<li><a href="<?=base_url()?>Routes/profiles" class="<?= $is_active[3]?>"><i class="fa fa-list-alt"></i> <span>Profiles</span></a></li>
				<li><a href="<?=base_url()?>Routes/removedProfiles" class="<?= $is_active[4]?>"><i class="lnr lnr-inbox"></i> <span>Removed Profiles</span></a></li>
			</ul>

		</nav>
	</div>
</div>
<!-- END LEFT SIDEBAR -->