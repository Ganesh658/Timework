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
	.keyskill{    margin-left: -3em;margin-bottom: 5em;}
	.form-horizontal .form-group{margin: 0}
	.mypostskills{color: #000;font-size: 15px;}
	
</style>

<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard-responsive.css">
<div class="just1 mbmrtp5">
	<div class="col-sm-1 col-md-1 col-xs-12 nopadding"></div>
	<div class="col-sm-9 col-md-9 col-xs-12 mt-2" style="<?php echo $mrbtm; ?>">
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
						<a class="activepost col-xs-4 <?php echo @$postactive3; ?>" href="<?php echo base_url(); ?>jobseeker/myJobs/3">Pending Posts</a>
						
						<a class="activepost col-xs-4 <?php echo @$postactive1; ?>" href="<?php echo base_url(); ?>jobseeker/myJobs">Active Posts</a>
					
						<a class="activepost col-xs-4 <?php echo @$postactive2; ?>"  href="<?php echo base_url(); ?>jobseeker/myJobs/2">Expired Posts</a>
					</div>
				</div>
			</div>
			<div class="col-sm-9 col-md-9 col-xs-12">
				<div class="media applyed">
					<div class="media-left">
						<a href="#">
							<img class="media-object" src="<?php echo base_url() ?>includes/images/objective.png" alt="img-123">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo "Posted ".@sizeOf($results)." Need Jobs"; ?>
						</h4>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-md-3 col-xs-4">
				<!-- <a class="btn btn-default website-btn2 outline" href="<?php echo base_url(); ?>jobseeker/postjobs"><i class="fa fa-plus" aria-hidden="true"></i>NEED POST JOB</a> -->
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
								<a><?php echo @ucwords($results[$r]->job_title); ?> </a>
							</h4>
						</div>
					</div>
					<div class="col-xs-3 hidden-sm hidden-md hidden-lg ">
						<?php echo @$statusInfo; ?>
					</div>
					<div class="col-sm-3 col-md-3 col-xs-12">
						<h5 class="expire"><?php echo @$expires; ?> : <?php echo @date('d-M-Y',strtotime(@$results[$r]->expire_date)); ?></h5>
					</div>
					<div class="col-sm-1 col-md-1 hidden-xs">
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
		                        <a href="<?php echo base_url(); ?>jobseeker/editJobs/<?php echo @$results[$r]->id; ?>" class="editConfirm">Edit Post</a>
		                        <a href="<?php echo base_url(); ?>jobseeker/deleteJobs/<?php echo @$results[$r]->id; ?>/1" class="deleteConfirm">Delete Post</a>
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
								<a href="<?php echo base_url(); ?>jobseeker/jobStatusChange/2/<?php echo @$results[$r]->id; ?>">Hide Post</a>
								<?php 
								}
								else if(@$results[$r]->status == '2')
								{
								?>
									<a href="<?php echo base_url(); ?>jobseeker/jobStatusChange/1/<?php echo @$results[$r]->id; ?>">Show Post</a>
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
					<div class="col-sm-4 col-md-4 col-xs-12">
						<div class="media del-exp">
							<div class="media-body">
								<?php 
								if(@$results[$r]->expInfo[0]->cat_name != '')
								{
								?>
									<a><h4 class="media-heading"><span class="fntbold">Experiance</span>: <?php echo @$results[$r]->expInfo[0]->cat_name; ?></h4></a>
								<?php 
								}
								else
								{
								?>
									<a><h4 class="media-heading"><span class="fntbold">Experiance:Not Specified</span></h4></a>
								<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-sm-8 col-md-8 col-xs-12">
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
									<a><h4 class="media-heading"><span class="fntbold">Location</span> :Not Specified</h4></a>
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
								if(@$results[$r]->joining_type != '')
								{
									if(@$results[$r]->joining_type == 1)
									{
										$joiningType = 'Immediate';
									}
									if(@$results[$r]->joining_type == 2)
									{
										$joiningType = 'Within This Week';
									}
									if(@$results[$r]->joining_type == 3)
									{
										$joiningType = 'Next Week';
									}
									if(@$results[$r]->joining_type == 4)
									{
										$joiningType = '1st Of Next Month';
									}
								?>
									<a><h4 class="media-heading"><span class="fntbold">Joining Type</span> : <?php echo @$joiningType; ?></h4></a>
								<?php 
								}
								else
								{
								?>
									<a><h4 class="media-heading"><span class="fntbold">Joining Type</span> : Not Specified</h4></a>
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
								if(@$results[$r]->preferred_shift != '')
								{
									if(@$results[$r]->preferred_shift == 1)
									{
										$preferredShift = 'Any Shift';
									}
									if(@$results[$r]->preferred_shift == 2)
									{
										$preferredShift = 'Morning Shift';
									}
									if(@$results[$r]->preferred_shift == 3)
									{
										$preferredShift = 'Afternoon Shift';
									}
									if(@$results[$r]->preferred_shift == 4)
									{
										$preferredShift = 'Evening Shift';
									}
									if(@$results[$r]->preferred_shift == 5)
									{
										$preferredShift = 'Night Shift';
									}
								?>
									<a><h4 class="media-heading"><span class="fntbold">Preferred Shift</span> : <?php echo @$preferredShift; ?></h4></a>
								<?php 
								}
								else
								{
								?>
									<a><h4 class="media-heading"><span class="fntbold">Preferred Shift</span> : Not Specified</h4></a>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row mr-t1e mmr-t1e">
					<div class="col-sm-12 col-md-12 col-xs-12">
						<div class="mypostdesc">
							<?php
							if(@$results[$r]->job_skills != '')
							{
								echo "<p class='mypostskills'><span class='fntbold'>Skills I Have</span> :".@$results[$r]->job_skills."<p>";
							}
							if(@strip_tags(@$results[$r]->description) != '')
							{
							?>
								<p><span class="fntbold">Need Job Descripition:</span> <?php echo @$results[$r]->description; ?></p>
							<?php 
							}
							
							?>
								
						</div>
					</div>
				</div>
				<div class="row myposthr">
					<hr style="">
				</div>
				<div class="row dmrtop">
					<div class="col-sm-4 col-md-4  col-xs-12">
						<div class="mypst fntbold">
							<p>Post Viewed <i class="fa fa-eye" aria-hidden="true"></i> (<?php echo @$results[$r]->total_views; ?>)</p>
						</div>
						<div class="row hidden-sm hidden-md hidden-lg">
							<hr style="border-top: 1px solid #bbbbbb;margin: 10px 0;">
						</div>
					</div>
					
					<div class="col-sm-4 col-md-4  col-xs-12">
						<div class="mypst fntbold">
							<p>Liked <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> (<?php echo @$results[$r]->total_likes; ?>)</p>
						</div>
						<div class="row hidden-sm hidden-md hidden-lg">
							<hr style="border-top: 1px solid #bbbbbb;margin: 10px 0;">
						</div>
					</div>
					
					<div class="col-sm-4 col-md-4  col-xs-12">
						<div class="mypst fntbold mmrbtm4">
							<p>Resume Downloaded <i class="fa fa-download" aria-hidden="true"></i> (<?php echo @$results[$r]->download_count; ?>)</p>
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