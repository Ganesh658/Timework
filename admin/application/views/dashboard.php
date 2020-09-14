<div class="wrapper wrapper-content">
	<div class="row mrTop">
		<h1 style="text-align:center;font-weight: bolder;">Welcome To Admin Panel</h1>
	</div> 
	<div class="ibox">
		<div class="ibox-title">
			<h5 style="font-size: 18px;">Users</h5>
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
		</div>
		<div class="ibox-content">
			<div class="row">
				<div class="col-lg-3">
					<a href="#">
						<div class="ibox float-e-margins">
							<div class="ibox-title lipinkbg">
								<h5>All Users</h5>
							</div>
							<div class="ibox-content lipinkbg_box">
								<h1 class="no-margins"><img src="<?php echo base_url(); ?>externals/icons/allusers.png" class="iconimg"><?php echo @$allusers; ?></h1>
								<small>Total Users</small>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-3">
					<a href="<?php echo base_url(); ?>index.php/home/users/3">
						<div class="ibox float-e-margins">
							<div class="ibox-title librownbg">
								<h5>Job Seekers</h5>
							</div>
							<div class="ibox-content librownbg_box">
								<h1 class="no-margins"><img src="<?php echo base_url(); ?>externals/icons/owners.png" class="iconimg"><?php echo @$jobseekers; ?></h1>
								<small>Total Users</small>
							</div>
						</div>
					</a>
				</div>
				
				<div class="col-lg-3">
					<a href="<?php echo base_url(); ?>index.php/home/users/5">
						<div class="ibox float-e-margins">
							<div class="ibox-title liorangebg">
								<h5>Recruiters</h5>
							</div>
							<div class="ibox-content liorangebg_box">
								<h1 class="no-margins"><img src="<?php echo base_url(); ?>externals/icons/home-service.png" class="iconimg"><?php echo @$recruiters; ?></h1>
								<small>Total Users</small>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="ibox border-bottom">
			<div class="ibox-title">
				<h5 style="font-size: 18px;">Revenue</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-3">
						<a href="#0">
							<div class="ibox float-e-margins">
								<div class="ibox-title liciyanbg">
									<h5>Total Revenue</h5>
								</div>
								<div class="ibox-content liciyanbg_box">
									<h1 class="no-margins">
										<img src="<?php echo base_url(); ?>externals/icons/revenue.png" class="iconimg"> 
										<?php echo @$totalRevenue; ?>									
									</h1>
									<small>Total Amount</small>
								</div>
							</div>
						</a>
					</div>

					
				</div>
			</div>
		</div>
	</div>
</div>
