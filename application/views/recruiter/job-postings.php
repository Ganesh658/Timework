<?php
$jsonObj=@json_decode($jsonObj);
$results = @$jsonObj->results;
$mrbtm = '';
if(@sizeOf($results) == 0)
{
	$mrbtm = 'margin-bottom: 11.4%';
}
?>
<style type="text/css">
	.keyskill li{padding: 5px 20px;background-color: #05AEE5}
	.keyskill{margin-left: -3em;margin-bottom: 5em;}
	.take {margin-top: 0;}
	.datepicker-dropdown{margin-top: 0 !important}
	.del-exp h4 {font-size: 13px !important;}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard-responsive.css">
<div class="just1 mbmrtp3">
	<div class="col-sm-1 col-md-1 col-xs-12 nopadding"></div>
	<div class="col-sm-8 col-md-8 col-xs-12 mt-2" style="<?php echo $mrbtm; ?>">
			<div class="row">
				<?php
				if(@$this->session->userdata("success") != '')
				{
				?>
					<div class="col-sm-12 col-md-12 col-xs-12">
						<div class="alert alert-success alert-dismissable">
		                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		                    <?php
							echo @$this->session->userdata("success");
							@$this->session->unset_userdata("success");
							?>
		                </div>
		            </div>
				<?php
				}
				if(@$this->session->userdata("fail") != '')
				{
				?>
					<div class="col-sm-12 col-md-12 col-xs-12">
						<div class="alert alert-danger alert-dismissable">
		                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		                    <?php
							echo @$this->session->userdata("fail");
							@$this->session->unset_userdata("fail");
							?>
		                </div>
		            </div>
				<?php
				}
				
				if(@$jsonObj->page_type == 2)
				{
					$postactive1 = $postactive3 = '';
					$postactive2 = 'postactive';
					$expires = "Expired";
					
				}
				else if(@$jsonObj->page_type == 3)
				{
					$postactive1 = $postactive2 ='';
					$postactive3 = 'postactive';
					$expires = "Expired";
					
				}
				else
				{
					$postactive2 = $postactive3 = '';
					$postactive1 = 'postactive';
					$expires = "Expires On";
				}
				?>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xs-12">
						<div class="col-sm-12 col-xs-12 active-post">
							<a class="activepost active-posts <?php echo @$postactive3; ?>" href="<?php echo base_url(); ?>recruiter/jobpostings/3">Pending Posts</a>

							<a class="activepost active-posts <?php echo @$postactive1; ?>" href="<?php echo base_url(); ?>recruiter/jobpostings/1">Active Posts</a>
						
							<a class="activepost active-posts <?php echo @$postactive2; ?>"  href="<?php echo base_url(); ?>recruiter/jobpostings/2">Expired Posts</a>
						</div>
					</div>
				</div>
				<div class="col-sm-9 col-md-9 col-xs-8">
					<div class="media applyed">
						<div class="media-left">
							<a>
								<img class="media-object" src="<?php echo base_url() ?>includes/images/objective.png" alt="img-123">
							</a>
						</div>
						<div class="media-body">
							<h4 class="media-heading"><?php echo "Posted ".@sizeOf($results)." Jobs"; ?>
							</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-xs-4">
					<!-- <a class="btn btn-default website-btn2 outline" href="<?php echo base_url(); ?>recruiter/postjobs"><i class="fa fa-plus" aria-hidden="true"></i> POST JOB</a> -->
				</div>
			</div>
			<?php 
			if(@sizeOf($results) > 0)
			{
				for ($r=0; $r < sizeOf($results); $r++) 
				{
					if(@$results[$r]->status == '0')
					{
						$statusInfo = '<span class="actspan" style="background: #e50505;">Pending</span>';
					}
					else if(@$results[$r]->status == '1')
					{
						$statusInfo = '<span class="actspan">Active</span>';
					}
					else if(@$results[$r]->status == '2')
					{
						$statusInfo = '<span class="actspan" style="background: #e50505;">In-Active</span>';
					}
			?>
				<div class="del-sm8">
					<div class="row">
						<div class="col-sm-7 col-md-7 col-xs-9">
							<div class="dev ">
								<h4>
									<a target="_blank" href="<?php echo base_url(); ?>jobdetails/<?php echo @strtolower($results[$r]->alias_name); ?>/<?php echo @str_replace("=","_",base64_encode(@$results[$r]->id)); ?>"><?php echo @ucwords($results[$r]->job_title); ?> </a>
								</h4>
								<h3><a href="#"><?php echo @$results[$r]->companyInfo[0]->firstname; ?></a></h3>
							</div>
						</div>
						<div class="col-xs-3 hidden-sm hidden-md hidden-lg ">
							<?php echo @$statusInfo; ?>
						</div>
						<div class="col-sm-3 col-md-3 col-xs-12">
							<h5 class="expire fs-13"><?php if(@$jsonObj->page_type != 3){ echo @$expires; ?>:<?php echo @date('d-M-Y',strtotime(@$results[$r]->expire_date)); } ?></h5>
						</div>
						<div class="col-sm-1 col-md-1 col-xs-12 hidden-xs">
							<?php echo @$statusInfo; ?>
						</div>
						<div class="col-sm-1 col-md-1 col-xs-12">
						
							<!-- three dot menu -->
			                <div class="portaldrop">
			                    <!-- three dots -->
			                    <ul class="dropbtn icons btn-right showLeft" onclick="showportaldrop(<?php echo @$r+1; ?>)">
			                        <li></li>
			                        <li></li>
			                        <li></li>
			                    </ul>
			                    <!-- menu -->
			                    <div id="myportaldrop_<?php echo @$r+1; ?>" class="portaldrop-content">
			                        <a href="<?php echo base_url(); ?>recruiter/editJobs/<?php echo @$results[$r]->id; ?>" class="editConfirm">Edit Post</a>
			                        <a href="<?php echo base_url(); ?>recruiter/deleteJobs/<?php echo @$results[$r]->id; ?>/1" class="deleteConfirm">Delete Post</a>
			                        <?php 
									if(@$results[$r]->status == '0')
									{
									?>
										<a href="#0">Pending From Admin</a>
									<?php 
									}
									else if(@$results[$r]->status == '1')
									{
									?>
									<a href="<?php echo base_url(); ?>recruiter/jobStatusChange/2/<?php echo @$results[$r]->id; ?>">Hide Post</a>
									<?php 
									}
									else if(@$results[$r]->status == '2')
									{
									?>
										<a href="<?php echo base_url(); ?>recruiter/jobStatusChange/1/<?php echo @$results[$r]->id; ?>">Show Post</a>
									<?php 
									}
									else
									{
										echo "N/A";
									}
									?>
			                    </div>
			                </div>
						</div>
					</div>
					<div class="row myposthr">
						<hr style="">
					</div>
					<div class="row mr-t1e mmr-t1e">
						<div class="col-sm-3 col-md-3 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->expInfo[0]->cat_name != '')
									{
									?>
										<a><h4 class="media-heading"><span class='fntbold'>Exp:</span> <?php echo @$results[$r]->expInfo[0]->cat_name; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class='fntbold'>Exp:</span> Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-9 col-md-9 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->cityInfo[0]->city_name != '')
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Location</span> : <?php if(@$results[$r]->locationsInfo[0]->location_name != ''){ echo @$results[$r]->locationsInfo[0]->location_name.", "; } if(@$results[$r]->cityInfo[0]->city_name != ''){ echo @$results[$r]->cityInfo[0]->city_name.", "; } if(@$results[$r]->stateInfo[0]->state_name != ''){ echo @$results[$r]->stateInfo[0]->state_name; } ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class='fntbold'>Location:</span> Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						
					</div>
					<div class="row mr-t1e mmr-t1e">
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->employment_type != '')
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Employment Type</span> : <?php echo @$results[$r]->employment_type; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Employment Type</span> :Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->no_of_openings != '')
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">No.of Openings</span> : <?php echo @$results[$r]->no_of_openings; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">No.of Openings:</span> :Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->notice_peroid != '')
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Notice Period</span> : <?php echo @$results[$r]->notice_peroid; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Notice Period:</span> :Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row mr-t1e mmr-t1e">
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->salary_type != '')
									{
										if(@$results[$r]->salary_type == 1)
										{
											$salaryType = 'Hourly';
										}
										if(@$results[$r]->salary_type == 2)
										{
											$salaryType = 'Daily';
										}
										if(@$results[$r]->salary_type == 3)
										{
											$salaryType = 'Weekly';
										}
										if(@$results[$r]->salary_type == 4)
										{
											$salaryType = 'Monthly';
										}
										if(@$results[$r]->salary_type == 5)
										{
											$salaryType = 'Yearly';
										}
									?>
										<a><h4 class="media-heading"><span class="fntbold">Salary Type</span> : <?php echo @$salaryType; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Salary Type:</span> :Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->from_time != '' || @$results[$r]->to_time != '')
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Job Timings : </span><?php echo @$results[$r]->from_time."-".@$results[$r]->to_time; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Job Timings:</span> :Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->salary != '')
									{
									?>
										<a><h4 class="media-heading"><span class='fntbold'>Salary:</span> <?php echo @$results[$r]->salary; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class='fntbold'>Salary:</span> Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<?php 
					if(@$results[$r]->job_skills != '')
					{
					?>
						<div class="row mr-t1e mmr-t1e">
							<div class="col-sm-12 col-md-12 col-xs-12">
								<div class="media del-exp">
									<div class="media-body">
										<?php 
										
											echo "<p class='mypostskills'><span class='fntbold'>Job Skills : </span> ".@$results[$r]->job_skills."<p>";
										?>
									</div>
								</div>
							</div>
						</div>
					<?php 
					}
					if(@$results[$r]->web_link != '')
					{
					?>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-xs-12">
								<div class="media del-exp">
									<div class="media-body">
										<span class="fntbold">Useful Web Link</span> : <a target="_blank" href="<?php echo @$results[$r]->web_link; ?>" class='btn btn-success' style='color: #fff'>Click Here</a>
									</div>
								</div>
							</div>
						</div>
					<?php 
					}
					if(@strip_tags(@$results[$r]->job_description) != '')
					{
					?>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-xs-12">
								<div class="take">
									<p><span class="fntbold fs-14">Job Descripition:</span> <?php echo @$results[$r]->job_description; ?></p>
								</div>
							</div>
						</div>
					<?php 
					}
					if(@strip_tags(@$results[$r]->interview_details) != '')
					{
					?>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-xs-12">
								<div class="take">
									<p><span class="fntbold fs-14">Interview Details:</span> <?php echo @$results[$r]->interview_details; ?></p>
								</div>
							</div>
						</div>
					<?php 
					}
					?>
					<div class="row myposthr">
						<hr style="">
					</div>
					<div class="row">
						<div class="col-sm-6 col-md-6  col-xs-6">
							<div class="mypst fntbold mypstview">
								<p>Post Viewed <i class="fa fa-eye" aria-hidden="true"></i> (<?php echo @$results[$r]->total_views; ?>)</p>
							</div>
						</div>

						<div class="col-sm-6 col-md-6  col-xs-6">
							<div class="mypst fntbold mypstview">
								<p>Liked <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> (<?php echo @$results[$r]->total_likes; ?>)</p>
							</div>
						</div>
					</div>
				</div> 
			<?php
				}
			}
			else
			{
			?>
				<div class="del-sm8">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-xs-12">
							<p style="text-align: center;color: red;font-size: 18px;">No Results Found</p>
						</div>
					</div>
				</div>
			<?php
			}
			?>
	</div>
</div>
<script>
function showportaldrop(oVal) {
	$('.portaldrop-content').removeClass('show');
    document.getElementById("myportaldrop_"+oVal).classList.toggle("show");
}

// Close the portaldrop if the user clicks outside of it
 window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var portaldrops = document.getElementsByClassName("portaldrop-content");
        var i;
        for (i = 0; i < portaldrops.length; i++) {
            var openportaldrop = portaldrops[i];
            if (openportaldrop.classList.contains('show')) {
                openportaldrop.classList.remove('show');
            }
        }
    }
}
   
</script>