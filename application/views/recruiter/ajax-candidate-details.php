<?php 
$jsonObj=@json_decode($jsonObj);
$results = @$jsonObj->results;
$userInfo = @$jsonObj->userInfo;
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/jquery.mCustomScrollbar.css">
<div class="row">
	<div class="col-sm-12 col-md-12 col-xs-12 recdet" style="height: 75vh;overflow: auto;">
		 <table class="table table-bordered">
		    <thead>
		      	<tr>
					<th class="text-right" style="width: 25%;">Title</th>
					<th><?php echo @ucwords($results[0]->job_title); ?></th>
		      	</tr>
		      	<tr>
					<th class="text-right" style="width: 25%;">Candidate Name</th>
					<th><?php echo @ucwords($userInfo[0]->firstname); ?></th>
		      	</tr>
		      	<tr>
					<th class="text-right" style="width: 25%;">Candidate Mobile</th>
					<th><?php echo @$userInfo[0]->mobile; ?></th>
		      	</tr>
		      	<tr>
					<th class="text-right" style="width: 25%;">Candidate Email</th>
					<th><?php echo @$userInfo[0]->email; ?></th>
		      	</tr>
				<tr>
					<th class="text-right" style="width: 25%;vertical-align: top">Need Job Description</th>
					<th><?php echo @$results[0]->description; ?></th>
		      	</tr>
			    
		    </thead>
		</table>
	</div>
</div>
