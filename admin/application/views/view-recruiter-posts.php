<?php
$jsonObj=@json_decode($jsonObj);
$results = @$jsonObj->results;
$page_type = @$jsonObj->page_type;
$oVal = @$jsonObj->oVal;
if($oVal == 1)
{
	$reUrl = base_url()."index.php/home/recruiterposts/".$page_type;
}
?>
<style>
.center{
	text-align:center;
}
</style>
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Recruiter Post Details</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url()?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url()?>">Recruiter Posts</a>
			</li>
			<li class="active">
				<strong>Post Details</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo @$reUrl; ?>" class="btn btn-w-m btn-default pull-right">Back to List</a>
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="ibox">                        
					<div class="ibox-content">
						<?php
						if(@$this->session->userdata("success") != '')
						{
						?>
							<div class="alert alert-success alert-dismissable">
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
							<div class="alert alert-danger alert-dismissable">
	                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                            <?php
								echo @$this->session->userdata("fail");
								@$this->session->unset_userdata("fail");
								?>
	                        </div>
						<?php
						}
						?>
						<table class="table table-striped table-bordered table-hover " id="editable" >
							<thead>
								<tr>
									<th class="text-right" style="width: 20%;">Status</th>
									<th class="text-left">
										<?php
										if(@$results[0]->status == 0)
										{
										?>
											<a style="color: #fff;font-weight: bold;" href="<?php echo base_url();?>index.php/home/approveposts/<?php echo @$results[0]->id?>" class='btn btn-primary'>Approve Post</a>
										<?php 
										}
										else
										{
											echo "Approved";
										}
										?>
									</th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Job Title</th>
									<th class="text-left"><?php echo @ucwords($results[0]->job_title); ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">State/UN</th>
									<th class="text-left"><?php echo @ucwords($results[0]->stateInfo[0]->state_name); ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">City/Town</th>
									<th class="text-left"><?php echo @ucwords($results[0]->cityInfo[0]->city_name); ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Location/Area</th>
									<th class="text-left"><?php echo @ucwords($results[0]->locationsInfo[0]->location_name); ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Job Skills</th>
									<th class="text-left"><?php echo @$results[0]->job_skills; ?></th>
								</tr>
								
								<tr>
									<th class="text-right" style="width: 20%;">No Of Openings</th>
									<th class="text-left"><?php echo @$results[0]->no_of_openings; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Employment Type</th>
									<th class="text-left"><?php echo @$results[0]->employment_type; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Experience</th>
									<th class="text-left"><?php echo @$results[0]->expInfo[0]->cat_name; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Salary</th>
									<th class="text-left"><?php echo @$results[0]->salaryInfo[0]->cat_name;?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Salary Type</th>
									<th class="text-left"><?php echo @$results[0]->salary_type; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Joining Type</th>
									<th class="text-left"><?php echo @$results[0]->joining_type; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Job Timings</th>
									<th class="text-left"><?php echo @$results[0]->from_time." ".@$results[0]->to_time; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Notice Period</th>
									<th class="text-left"><?php echo @$results[0]->notice_peroid; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Useful Web Link</th>
									<th class="text-left">
										<a href="<?php echo @$results[0]->web_link; ?>" target='_blank'>View</a>
									</th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Interview Location</th>
									<th class="text-left"><?php echo @$results[0]->interview_location; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Interview Details</th>
									<th class="text-left"><?php echo @$results[0]->interview_details; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Job Description</th>
									<th class="text-left"><?php echo @$results[0]->job_description; ?></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>