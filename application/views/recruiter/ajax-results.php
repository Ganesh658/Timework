<?php
$jsonObj=@json_decode($jsonObj);
$results = @$jsonObj->results;
$mrbtm = '';
if(@sizeOf($results) == 0)
{
	$mrbtm = 'margin-bottom: 32em';
}
else
{
	$mrbtm = 'margin-bottom: 16em';
}
?>
<div class="res" style="<?php echo @$mrbtm; ?>">
	<div class="row">
		<div class="col-sm-9 col-md-9 col-xs-7">
			<div class="media applyed recaply">
				<div class="media-left">
					<a href="#">
						<img class="media-object" src="<?php echo base_url() ?>includes/images/objective.png" alt="img-123">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading"><?php echo "Total Results ".@sizeOf($results)." Jobs"; ?>
					</h4>
				</div>
			</div>
		</div>
		<div class="col-xs-5 hidden-sm hidden-md hidden-lg mbmrtp1 text-right">
			<span class=" open-cls" style="font-size:13px;cursor:pointer;border:1px solid #ccc;" onclick="openNavs()">Filter By &#9776; </span>
		</div>
	</div>
	<?php 
	if(@sizeOf($results) > 0)
	{
		for ($r=0; $r < sizeOf($results); $r++) 
		{
	?>
			<div class="del-sm8 recdel mob-del-sm8">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xs-12">
						<div class="dev ">
							<h4>
								<a><?php echo @ucwords($results[$r]->job_title); ?> </a>
							</h4>
						</div>
					</div>
					
				</div>
				<div class="row myposthr">
					<hr style="">
				</div>
				<div class="row mr-t1e">
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
				<div class="row mr-t1e mmrbtm4">
					<div class="col-sm-12 col-md-12 col-xs-12">
						<div class="mypostdesc">
							<div class="take">
							<?php $job_skills = @$results[$r]->job_skills; ?>
							<?php 
							$jobSkills = @explode(",", $job_skills);
							if(@sizeOf($jobSkills) > 0)
							{
							?>
								<ul class="keyskill" style="margin-bottom: 0;">
									<li class="firsskl">Skills :</li>
									<?php
									for ($js=0; $js < sizeOf($jobSkills); $js++) 
									{ 
										if($jobSkills[$js] != '')
										{
									?>
										<li><?php echo @ucwords($jobSkills[$js]); ?></li>
									<?php
										}
									}
									?>
								</ul>
							<?php
							}
							?>
								
						</div>
						</div>
					</div>
				</div>
				<div class="row myposthr">
					<hr style="">
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-4  hidden-xs">
						<div class="mypst fntbold">
							<p>Posted : <?php echo @$results[$r]->timeago; ?></p>
						</div>
					</div>
					<div class="col-sm-4 col-md-4  col-xs-6">
						<div class="like-symbol">
							<?php 
							$likedJobs = @$results[$r]->likedJobs;
							if(@$likedJobs == '1')
							{
							?>
								<a href="#0" class='alrdyliked_jobs'>
									<img src="<?php echo base_url(); ?>includes/images/liked.png" class="img-responsive">
								</a>
							<?php 
							}
							else
							{
							?>
								<a href="#0" data-id='<?php echo @$results[$r]->id; ?>' class='liked_jobs' data-type='2'>
									<img src="<?php echo base_url(); ?>includes/images/like.png" class="img-responsive" id="like_<?php echo @$results[$r]->id; ?>">
								</a>
								
							<?php
							}
							?>
						</div>
					</div>
					<div class="col-sm-4 col-md-4  col-xs-6">
						<div class="read-more">
							<?php 
							if(@$this->session->userdata("is_logged_in") !='')
							{
							?>
								<a href="#0" id="<?php echo @$results[$r]->id; ?>"  class="recjobdetails">Read More</a>
							<?php
							}
							else
							{
							?>
								<a href="<?php echo base_url(); ?>login">
									Read More
								</a>
							<?php
							}
							?>
						</div>
					</div>
					<div class="postinfo hidden-sm hidden-md hidden-lg">
						<div class="col-xs-12">
						
							<p>Posted : <?php echo @$results[$r]->timeago; ?></p>
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