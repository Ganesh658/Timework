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
<style type="text/css">
	.del-exp h4 {font-size: 13px !important;}
</style>
<div class="row">	
	<div class="col-sm-9 col-md-9 col-xs-7">
		<div class="media applyed">
			<div class="media-left">
				<a href="#">
					<img class="media-object" src="<?php echo base_url() ?>includes/images/objective.png" alt="img-123">
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?php echo "Total ".@sizeOf($results)." Jobs"; ?>
				</h4>
			</div>
		</div>
	</div>
	<div class="col-xs-5 hidden-sm hidden-md hidden-lg mbmrtp1 text-right">
		<span class=" open-cls" style="font-size:13px;cursor:pointer;border:1px solid #ccc;" onclick="openNavs()">Filter By &#9776; </span>
	</div>
</div>
<div class="res" style="<?php echo @$mrbtm; ?>">
<?php 
if(@sizeOf($results) > 0)
{
	for ($r=0; $r < sizeOf($results); $r++) 
	{
?>
	<div class="del-sm8 mob-del-sm8">
		<div class="row">
			<div class="col-sm-8 col-md-8 col-xs-8">
				<div class="dev ">
					<h4>
						<a href="#0"><?php echo @ucwords($results[$r]->job_title); ?> </a>
					</h4>
					<h3><a href="#"><?php echo @$results[$r]->userData[0]->business_name; ?></a></h3>
				</div>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-4">
				<div class="business_logo">
					<?php 
					if(@$results[$r]->userData[0]->business_logo != '')
					{
					?>
						<img src="<?php echo base_url(); ?>admin/uploads/users/<?php echo @$results[$r]->userData[0]->business_logo; ?>" class="img-responsive">
					<?php 
					}
					?>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 1em">
			<div class="col-sm-4 col-md-4 col-xs-12">
				<div class="media del-exp">
					
					<div class="media-body">
						<?php 
						if(@$results[$r]->expInfo[0]->cat_name != '')
						{
						?>
							<a href="#"><h4 class="media-heading"><span class="fntbold">Experience : </span> <?php echo @$results[$r]->expInfo[0]->cat_name; ?></h4></a>
						<?php 
						}
						else
						{
						?>
							<a href="#"><h4 class="media-heading"><span class="fntbold">Experience : </span>:Not Specified</h4></a>
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
						if(@$results[$r]->stateInfo[0]->state_name != '')
						{
						?>
							<a href="#"><h4 class="media-heading"><span class="fntbold">Location</span>: <?php echo @$results[$r]->cityInfo[0]->city_name.", ".@$results[$r]->stateInfo[0]->state_name; ?></h4></a>
						<?php 
						}
						else
						{
						?>
							<a href="#"><h4 class="media-heading"><span class="fntbold">Location</span>:Not Specified</h4></a>
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
						if(@$results[$r]->salary != '')
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
							<a><h4 class="media-heading"><span class="fntbold">Salary</span> : <?php echo @$results[$r]->salary." <span class='fntbold'>(".@$salaryType.")</span>"; ?></h4></a>
						<?php 
						}
						else
						{
						?>
							<a><h4 class="media-heading"><span class="fntbold">Salary</span>: Not Specified</h4></a>
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
						if(@$results[$r]->employment_type != '')
						{
						?>
							<a><h4 class="media-heading"><span class="fntbold">Employment Type</span> : <?php echo @$results[$r]->employment_type; ?></h4></a>
						<?php 
						}
						else
						{
						?>
							<a><h4 class="media-heading"><span class="fntbold">Employment Type</span>: Not Specified</h4></a>
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
							<a><h4 class="media-heading"><span class="fntbold">Joining Type</span>: Not Specified</h4></a>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-xs-12">
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
		<div class="row" style="margin-top: 1em">
			<div class="postinfo">
				<div class="col-sm-4 col-md-4  postpading hidden-xs">
				
					<p>Posted : <?php echo @$results[$r]->timeago; ?></p>
				</div>
				<div class="col-sm-4 col-md-4  col-xs-6">
					<div class="like-symbol">
						<?php 
						if(@$this->session->userdata("is_logged_in") !='')
						{
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
								<a href="#0" data-id='<?php echo @$results[$r]->id; ?>' class='liked_jobs' data-type='1'>
									<img src="<?php echo base_url(); ?>includes/images/like.png" class="img-responsive" id="like_<?php echo @$results[$r]->id; ?>">
								</a>
								
							<?php
							}
						}
						else
						{
						?>
							<a href="<?php echo base_url(); ?>login">
								<img src="<?php echo base_url(); ?>includes/images/like.png" class="img-responsive">
							</a>
						<?php
						}
						?>
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-xs-6">
					<div class="read-more">
						<?php 
						if(@$this->session->userdata("is_logged_in") !='')
						{
						?>
							<a href="#0" id="<?php echo @$results[$r]->id; ?>"  class="jobdetails">Read More</a>
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
			</div>
			<div class="postinfo  hidden-sm hidden-md hidden-lg">
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