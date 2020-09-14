<?php 
$jsonObj=@json_decode($jsonObj);
$results = @$jsonObj->results;
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/jquery.mCustomScrollbar.css">
<div class="row">
	<div class="col-sm-12 col-md-12 col-xs-12 recdet ajxinfo">
		 <table class="table table-bordered">
		    <thead>
		      	<tr>
					<th class="text-right">Job Name</th>
					<th><?php echo @ucwords($results[0]->job_title); ?></th>
		      	</tr>
		      	<tr>
					<th class="text-right">Recruiter Name</th>
					<th><?php echo @ucwords($results[0]->userData[0]->firstname); ?></th>
		      	</tr>
		      	<tr>
					<th class="text-right">Recruiter Mobile</th>
					<th><?php echo @$results[0]->userData[0]->mobile; ?></th>
		      	</tr>
		      	<tr>
					<th class="text-right">Recruiter Email</th>
					<th><?php echo @$results[0]->userData[0]->email; ?></th>
		      	</tr>
		      	<?php 
				if(@$results[0]->employment_type != '')
				{
				?>
					<tr>
						<th class="text-right">Employment Type</th>
						<th><?php echo @$results[0]->employment_type; ?></th>
			      	</tr>
			    <?php 
				}
				if(@$results[0]->expInfo[0]->cat_name != '')
				{
				?>
					<tr>
						<th class="text-right">Experience</th>
						<th><?php echo @$results[0]->expInfo[0]->cat_name; ?></th>
					</tr>
				<?php 
				}
				if(@$results[0]->stateInfo[0]->state_name != '')
				{
				?>
					<tr>
						<th class="text-right">Location</th>
						<th><?php echo @$results[0]->cityInfo[0]->city_name.", ".@$results[0]->stateInfo[0]->state_name; ?></th>
					</tr>
				<?php 
				}
				if(@$results[0]->salaryInfo[0]->cat_name != '')
				{
				?>
					<tr>
						<th class="text-right">Salary</th>
						<th><?php echo @$results[0]->salaryInfo[0]->cat_name; ?></th>
					</tr>
				<?php 
				}
				if(@$results[0]->no_of_openings != '')
				{
				?>
					<tr>
						<th class="text-right">No.Of Openings</th>
						<th><?php echo @$results[0]->no_of_openings; ?></th>
					</tr>
				<?php 
				}
				if(@$results[0]->joining_date != '')
				{
				?>
					<tr>
						<th class="text-right">Joining Date</th>
						<th><?php echo @$results[0]->joining_date; ?></th>
					</tr>
				<?php 
				}
				if(@$results[0]->from_time != '')
				{
				?>
					<tr>
						<th class="text-right">Timmings</th>
						<th><?php echo @$results[0]->from_time." ".@$results[0]->to_time; ?></th>
					</tr>
				<?php 
				}
				if(@$results[0]->notice_peroid != '')
				{
				?>
					<tr>
						<th class="text-right">Notice Peroid</th>
						<th><?php echo @$results[0]->notice_peroid; ?></th>
					</tr>
				<?php 
				}
				if(@$results[0]->job_skills != '')
				{
				?>
					<tr>
						<th class="text-right">Skills</th>
						<th>
							<ul class="keyskill" style="    margin-bottom: 0;">
							<?php
							$job_skills = @$results[0]->job_skills; 
							$jobSkills = @explode(",", $job_skills);
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
						</th>
			      	</tr>
				<?php
				}
				if(@$results[0]->interview_location != '')
				{
				?>
					<tr>
						<th class="text-right">Interview Location</th>
						<th><?php echo @$results[0]->interview_location; ?></th>
					</tr>
				<?php 
				}
				if(@strip_tags($results[0]->interview_details) != '')
				{
				?>
					<tr>
						<th class="text-right">Interview Details</th>
						<th><?php echo @$results[0]->interview_details; ?></th>
					</tr>
				<?php 
				}
				if(@strip_tags($results[0]->job_description) != '')
				{
				?>
					<tr>
						<th class="text-right">Job Description</th>
						<th><?php echo @$results[0]->job_description; ?></th>
					</tr>
				<?php 
				}
				?>
		    </thead>
		</table>
	</div>
</div>
