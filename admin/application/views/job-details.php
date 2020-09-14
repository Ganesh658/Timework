<style type="text/css">
	.cswidth{width: 15%;}
	.table-bordered > thead > tr > th{background-color: #FFFFFF !important;}
#editable tr:nth-child(even) {background-color: #f2f2f2;}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="ibox">                        
					<div class="ibox-content">
						<div class="col-sm-8">
							<?php
							if(@$this->session->userdata("success") != '')
							{
							?>
								<div class="alert alert-success alert-dismissable" style="margin-bottom: 0px;">
	                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                                <?php
									echo @$this->session->userdata("success");
									@$this->session->unset_userdata("success");
									?>
	                            </div>
							<?php
							}
							if(@$this->session->userdata("fail") != '')
							{
							?>
								<div class="alert alert-danger alert-dismissable" style="margin-bottom: 0px;">
	                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                                <?php
									echo @$this->session->userdata("fail");
									@$this->session->unset_userdata("fail");
									?>
	                            </div>
							<?php
							}
							?>
						</div>
						<div class="col-sm-4">
							<h2 style="margin-bottom: 2em;">
								<?php 
								if(@$vendorId != '')
								{
								?>
									<a href="<?php echo base_url()?>index.php/home/joblistings/<?php echo @$vendorId; ?>/<?php echo @$usertype; ?>" class="btn btn-w-m btn-default pull-right">Back to List</a>
								<?php 
								}
								else
								{
								?>
									<a href="<?php echo base_url()?>index.php/home/joblistings" class="btn btn-w-m btn-default pull-right">Back to List</a>
								<?php
								}
								?>
								<?php 
								if(@$usertype != '')
								{
								?>
									<a href="<?php echo base_url()?>index.php/home/users/<?php echo @$usertype; ?>" class="btn btn-w-m btn-default pull-right" style='    margin-right: 2em;'>Back to Vendor List</a>
								<?php 
								}
								?>
							</h2>
						</div>
						<table class="table table-striped table-bordered table-hover " id="editable" >
							<thead>
								<tr >
									<th class="center" colspan='2' style="text-align: center;font-size: 22px;color: #3c3cff;">Job Details</th>
								</tr>
								<tr>
									<th class="center cswidth">Status</th>
									<th class="center">
										<?php 
										if(@$jobslistings[0]->status == '0')
										{
										?>
											<span style="color: red;font-weight: bold;">Pending</span>
											<br>
											<?php 
											if(@$vendorId != '')
											{
											?>
												<a href="<?php echo base_url(); ?>index.php/home/jobStatusChange/1/<?php echo @$jobslistings[0]->id; ?>/1/<?php echo @$vendorId; ?>/<?php echo @$usertype; ?>"  style="color: green;text-decoration: none;font-weight: bold;">Make It Active</a>
											<?php 
											}
											else
											{
											?>
												<a href="<?php echo base_url(); ?>index.php/home/jobStatusChange/1/<?php echo @$jobslistings[0]->id; ?>/1"  style="color: green;text-decoration: none;font-weight: bold;">Make It Active</a>
											<?php
											}
											?>
										<?php 
										}
										else if(@$jobslistings[0]->status == '1')
										{
										?>
										<span style="color: green;font-weight: bold;">Active</span>
										<br>
										<?php 
											if(@$vendorId != '')
											{
											?>
												<a href="<?php echo base_url(); ?>index.php/home/jobStatusChange/2/<?php echo @$jobslistings[0]->id; ?>/1/<?php echo @$vendorId; ?>/<?php echo @$usertype; ?>"  style="color: #05aee5;text-decoration: none;font-weight: bold;">Make It In-Active</a>
											<?php 
											}
											else
											{
											?>
												<a href="<?php echo base_url(); ?>index.php/home/jobStatusChange/2/<?php echo @$jobslistings[0]->id; ?>/1"  style="color: #05aee5;text-decoration: none;font-weight: bold;">Make It In-Active</a>
											<?php 
											}
											?>
										<?php 
										}
										else if(@$jobslistings[0]->status == '2')
										{
										?>
											<span style="color: #05aee5;font-weight: bold;">In-Active</span>
											<br>
											<?php 
											if(@$vendorId != '')
											{
											?>
												<a href="<?php echo base_url(); ?>index.php/home/jobStatusChange/1/<?php echo @$jobslistings[0]->id; ?>/1/<?php echo @$vendorId; ?>/<?php echo @$usertype; ?>"  style="color: green;text-decoration: none;font-weight: bold;">Make It Active</a>
											<?php 
											}
											else
											{
											?>
												<a href="<?php echo base_url(); ?>index.php/home/jobStatusChange/1/<?php echo @$jobslistings[0]->id; ?>/1"  style="color: green;text-decoration: none;font-weight: bold;">Make It Active</a>
											<?php 
											}
											?>
										<?php 
										}
										else
										{
											echo "N/A";
										}
										?>
									</th>
								</tr>
								<tr>
									<th class="center cswidth">Job Unique Id</th>
									<th class="center"><?php echo @$jobslistings[0]->job_unique_id;?></th>
								</tr>
								<tr>
									<th class="center cswidth">Job Title</th>
									<th class="center"><?php echo @$jobslistings[0]->job_title;?></th>
								</tr>
								<tr>
									<th class="center cswidth">Location</th>
									<th class="center"><?php echo @$locationInfo[0]->location_name;?></th>
								</tr>
								<tr>
									<th class="center cswidth">Zip Code</th>
									<th class="center"><?php echo @$jobslistings[0]->zip_code;?></th>
								</tr>
								<tr>
									<th class="center cswidth">No.of Vacancies</th>
									<th class="center"><?php echo @$jobslistings[0]->no_of_posts;?></th>
								</tr>
								<tr>
									<th class="center cswidth">Last Date To Apply</th>
									<th class="center"><?php echo @date("Y-m-d",strtotime($jobslistings[0]->last_date));?></th>
								</tr>
								<tr>
									<th class="center cswidth">Interview Type</th>
									<th class="center">
										<?php 
										if(@$jobslistings[0]->interview_type == '1'){echo "Regular Jobs"; }
										if(@$jobslistings[0]->interview_type == '2'){echo "Walk In Jobs"; }
										?>
									</th>
								</tr>
								<tr>
									<th class="center cswidth">Short Description</th>
									<th class="center"><?php echo @$jobslistings[0]->short_description;?></th>
								</tr>
								
								<?php 
								if(@sizeOf($attributesInfo) > 0)
								{
									for ($a=0; $a < sizeOf($attributesInfo); $a++) 
									{
								?>
									<tr>
										<th class="center cswidth"><?php echo @$attributesInfo[$a]['catInfo'][0]->cat_name; ?></th>
										<th class="center"><?php echo @$attributesInfo[$a]['subcatInfo'][0]->cat_name; ?></th>
									</tr>
								<?php 
									}
								}
								?>
								<tr>
									<th class="center" colspan='2' style="text-align: center;font-size: 22px;color: #3c3cff;">Vendor Information</th>
								</tr>
								<tr>
									<th class="center cswidth">Name</th>
									<th class="center"><?php echo @$userInfo[0]->firstname;?></th>
								</tr>
								<tr>
									<th class="center cswidth">Email</th>
									<th class="center"><?php echo @$userInfo[0]->email;?></th>
								</tr>
								<tr>
									<th class="center cswidth">Mobile</th>
									<th class="center"><?php echo @$userInfo[0]->mobile;?></th>
								</tr>
								<tr>
									<th class="center" colspan='2' style="text-align: center;font-size: 22px;color: #3c3cff;">Job Content</th>
								</tr>
								<?php 
								if(@sizeOf($jobInfo) > 0)
								{
									for ($j=0; $j < sizeOf($jobInfo); $j++) 
									{
								?>
									<tr>
										<th class="center cswidth"><?php echo @$jobInfo[$j]->main_title; ?></th>
										<th class="center"><?php echo @$jobInfo[$j]->description; ?></th>
									</tr>
								<?php 
									}
								}
								?>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>