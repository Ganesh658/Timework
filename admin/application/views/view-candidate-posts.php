<?php
$jsonObj=@json_decode($jsonObj);
$results = @$jsonObj->results;
$page_type = @$jsonObj->page_type;
$oVal = @$jsonObj->oVal;
if($oVal == 1)
{
	$reUrl = base_url()."index.php/home/candidateposts/".$page_type;
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
											<a style="color: #fff;font-weight: bold;" href="<?php echo base_url();?>index.php/home/approveposts/<?php echo @$results[0]->id?>/2" class='btn btn-primary'>Approve Post</a>
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
									<th class="text-right" style="width: 20%;">Employment Type</th>
									<th class="text-left"><?php echo @$results[0]->employment_type; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Experience</th>
									<th class="text-left"><?php echo @$results[0]->expInfo[0]->cat_name; ?></th>
								</tr>
								
								<?php 
								if(@$results[0]->joining_type == 1)
								{
									$joiningType = 'Immediate';
								}
								if(@$results[0]->joining_type == 2)
								{
									$joiningType = 'Within This Week';
								}
								if(@$results[0]->joining_type == 3)
								{
									$joiningType = 'Next Week';
								}
								if(@$results[0]->joining_type == 4)
								{
									$joiningType = '1st Of Next Month';
								}
								if(@$results[0]->preferred_shift == 1)
								{
									$preferredShift = 'Any Shift';
								}
								if(@$results[0]->preferred_shift == 2)
								{
									$preferredShift = 'Morning Shift';
								}
								if(@$results[0]->preferred_shift == 3)
								{
									$preferredShift = 'Afternoon Shift';
								}
								if(@$results[0]->preferred_shift == 4)
								{
									$preferredShift = 'Evening Shift';
								}
								if(@$results[0]->preferred_shift == 5)
								{
									$preferredShift = 'Night Shift';
								}
								?>
								<tr>
									<th class="text-right" style="width: 20%;">Joining Type</th>
									<th class="text-left"><?php echo @$joiningType; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Preferred Shift</th>
									<th class="text-left"><?php echo @$preferredShift; ?></th>
								</tr>
								<tr>
									<th class="text-right" style="width: 20%;">Need Job Description</th>
									<th class="text-left"><?php echo @$results[0]->description; ?></th>
								</tr>
								
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>