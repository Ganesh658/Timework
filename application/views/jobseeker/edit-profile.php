<?php
$jsonObj=@json_decode($jsonObj);
?> 
<style type="text/css">
	.pd-t0{padding-top: 0 !important;}
	.form-horizontal .form-group{margin: 0}
	.chosen-container-multi .chosen-choices li.search-field input[type="text"]{    height: 34px !important;border-radius: 10px;}
.chosen-choices{border-radius: 10px;}
select.website-sel {
    color: #9a9a9a !important;
}
.help-inline {
    padding-left: 0em !important;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard-responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/chosen.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<form class="form-horizontal" id="candpersonalinfo" method="POST" action="<?php echo base_url(); ?>jobseeker/updateProfile"  autocomplete='off'  enctype="multipart/form-data">
<div class="just1 mbmrtp2">
	<div class="col-sm-1 col-md-1 col-xs-12 nopadding"></div>
	<div class="col-sm-11 col-md-11 col-xs-12 nopadding">
		<div class="col-sm-12 col-md-12 col-xs-12">
			<?php
				if(@$this->session->userdata("success") != '')
				{
				?>
					<div class="row">
						<div class="col-sm-8 col-md-8 col-xs-12">
							<div class="alert alert-success alert-dismissable">
			                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			                    <?php
								echo @$this->session->userdata("success");
								@$this->session->unset_userdata("success");
								?>
			                </div>
			            </div>
			        </div>
				<?php
				}
				if(@$this->session->userdata("fail") != '')
				{
				?>
					<div class="row">
						<div class="col-sm-8 col-md-8 col-xs-12">
							<div class="alert alert-danger alert-dismissable">
			                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			                    <?php
								echo @$this->session->userdata("fail");
								@$this->session->unset_userdata("fail");
								?>
			                </div>
			            </div>
			        </div>
				<?php
				}
				?>
			<div class="changepwd">
				<h3>My Profile</h3>
			</div>
		</div>
	</div>
</div>
<div class="just1">
<div class="col-sm-1 col-md-1 col-xs-12 nopadding"></div>
<div class="col-sm-8 col-md-8 col-xs-12 nopadding">
	<div class="dash-basic dash-basics">
		<div class="form-group frmgrp">
			<div class="col-sm-6 col-md-6 col-xs-12">
				<label>Name<span class="mandatory">*</span></label>
				<input type="text" class="form-control website-input"  placeholder="Your Name" value="<?php echo @$jsonObj->userInfo[0]->firstname; ?>" name='v_name' required id='v_name'>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<label>Email</label>
				<input type="email" class="form-control website-input"  placeholder="Your Login E-Mail" value="<?php echo @$jsonObj->userInfo[0]->email; ?>" readonly>
				
			</div>
		</div>
		<div class="form-group frmgrp">
			<div class="col-sm-6 col-md-6 col-xs-12 mrtop1_8">
				<label>Mobile<span class="mandatory">*</span></label>
				<input type="text" class="form-control website-input"  placeholder="Mobile" value="<?php echo @$jsonObj->userInfo[0]->mobile; ?>" name='mobile' id='mobile' required>
				<div class="mobileMsg"></div>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<label>Gender<span class="mandatory">*</span></label>
				<select class="form-control website-input website-sel" name='user_gender' id="user_gender" required>
					<option value="Male" <?php if(@$jsonObj->userInfo[0]->user_gender == 'Male'){ echo "selected";} ?>>MALE</option>
					<option value="Female" <?php if(@$jsonObj->userInfo[0]->user_gender == 'Female'){ echo "selected";} ?>>FEMALE</option>
					<option value="TRANSGENDER" <?php if(@$jsonObj->userInfo[0]->user_gender == 'TRANSGENDER'){ echo "selected";} ?>>TRANSGENDER</option>
				</select>
			</div>
		</div>
		<div class="form-group frmgrp">
			<div class="col-sm-6 col-md-6 col-xs-12 mrtop1_8">
				<label>Date Of Birth<span class="mandatory">*</span></label>
				<input type="text" class="form-control website-input"  placeholder="Date Of Birth" value="<?php echo @$jsonObj->userInfo[0]->date_of_birth; ?>" name='date_of_birth' id="date_of_birth" required>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<label>Marital Status</label>
				<select class="form-control website-input website-sel" name='marital_status' id="marital_status">
					<option value="married" <?php if(@$jsonObj->userInfo[0]->marital_status == 'married'){ echo "selected";} ?>>MARRIED</option>
					<option value="unmarried" <?php if(@$jsonObj->userInfo[0]->marital_status == 'unmarried'){ echo "selected";} ?>>UNMARRIED</option>
				</select>
			</div>
		</div>
		<div class="form-group frmgrp">
			<div class="col-sm-12 col-md-12 col-xs-12 mrtop1_8">
				<label>Languages known</label>
				<input type="text" class="form-control website-input"  placeholder="Ex:English, Hindi" value="<?php echo @$jsonObj->userInfo[0]->languages_known; ?>" name='languages_known' id="languages_known">
			</div>
		</div>
		<div class="form-group frmgrp"  style="margin-bottom: 1em;">
			<div class="col-sm-12 col-md-12 col-xs-12 mrtop1_8">
				<label>Skills</label>
				<select id="job_skills" name="job_skills[]" class="form-control website-input chosen-selects" data-placeholder="Select Job Skills Upto 20 Skills" multiple>
		    		<option></option>
		    		<?php 
		    		$job_skills = @explode(",", $jsonObj->userInfo[0]->job_skills);
		    		if(@sizeOf($jsonObj->jobskills) > 0)
		    		{
			    		for ($sk=0; $sk < sizeOf($jsonObj->jobskills); $sk++) 
			    		{ 
			    			$jobskillsSel = '';
			    			if(in_array(@$jsonObj->jobskills[$sk]->skill_name, $job_skills))
			    			{
			    				$jobskillsSel = 'selected';
			    			}
			    		?>
			    			<option <?php echo @$jobskillsSel; ?> value="<?php echo @$jsonObj->jobskills[$sk]->skill_name; ?>"><?php echo @ucwords($jsonObj->jobskills[$sk]->skill_name); ?></option>
			    		<?php
			    		}
		    		}
		    		?>
		    	</select>
			</div>
		</div>
		<div class="form-group frmgrp">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<label>Career Objective</label>
				<textarea class="form-control website-input"  placeholder="Career Objective"  name='career_objective' ><?php echo @$jsonObj->userInfo[0]->career_objective; ?></textarea>
			</div>
		</div>
		<div class="form-group frmgrp">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<label>Desired Job Roles</label>
				<textarea class="form-control website-input"  placeholder="Ex:software engineer, project manager"  name='job_roles' ><?php echo @$jsonObj->userInfo[0]->roles_info; ?></textarea>
			</div>
		</div>
		<div class="form-group frmgrp" style="margin-bottom: 1em;">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<label>Desired Job City/Town</label>
				<select class="form-control website-input website-sel chosen-select" name='job_locations[]' id="job_locations" multiple data-placeholder='Select City/Town'>
					<option></option>
					<?php 
					$desiredcities = @$jsonObj->desiredcities;
					$job_locations = @$jsonObj->userInfo[0]->job_locations;
					$jobLocations = @explode("||", $job_locations);
					if(sizeOf($desiredcities) > 0)
					{
						for ($d=0; $d < sizeOf($desiredcities); $d++) 
						{
							$desiredAct = '';
							if(@in_array($desiredcities[$d]->id, $jobLocations))
							{
								$desiredAct = 'selected';
							}
					?>
						<option <?php echo $desiredAct; ?> value="<?php echo $desiredcities[$d]->id; ?>"><?php echo @$desiredcities[$d]->city_name; ?></option>
					<?php 
						}
					}
					?>	
				</select>
			</div>
		</div>
		<div class="form-group frmgrp">
			
			<div class="col-sm-6 col-md-6 col-xs-12">
				<label for="pwd">Profile Picture<span class="mandatory">*</span></label>
				<input type="file" class="form-control website-input" name='profile_pic' <?php if(@$jsonObj->userInfo[0]->profile_pic == ''){echo "required";} ?> accept="image/*">
			</div>

			<div class="col-sm-6 col-md-6 col-xs-12 hidden-xs ">
				<label for="pwd">Resume</label>
				<input type="file" class="form-control website-input" name='user_resume' accept=".doc,.docx,.pdf" id="user_resume">
			</div>
		</div>	
		<div class="form-group frmgrp">
			<?php 
			if(@$jsonObj->userInfo[0]->profile_pic != '')
			{
			?>
				<div class="col-sm-2 col-md-2 col-xs-6 mrtop1_8">
				
					<img src="<?php echo base_url(); ?>admin/uploads/users/<?php echo @$jsonObj->userInfo[0]->profile_pic; ?>">
				</div>
				<div class="col-sm-4 col-md-4 col-xs-6 mrtop1_8 rmvpic">
				
					<a href="<?php echo base_url(); ?>jobseeker/removeimagedata/2" style="background: #eb2e33;color: #fff;padding: 7px;border-radius: 5px;text-decoration: none;" class='deleteItem'><i class="fa fa-trash" aria-hidden="true"></i> Remove PIC</a>
				</div>
			<?php 
			}
			?>
			<div class="col-xs-12 hidden-md hidden-lg hidden-sm ">
				<label for="pwd">Resume</label>
				<input type="file" class="form-control website-input" name='user_resume' accept=".doc,.docx,.pdf" id="user_resume">
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12 mrtop1_8" style="margin: 10px 0px;">
				<?php 
				if(@$jsonObj->userInfo[0]->user_resume != '')
				{
				?>
					<a href="<?php echo base_url(); ?>admin/uploads/users/<?php echo @$jsonObj->userInfo[0]->user_resume; ?>" download style="background: #080808;color: #fff;padding: 7px;border-radius: 5px;text-decoration: none;"><i class="fa fa-download" aria-hidden="true" ></i> Download Resume</a> 

					<a href="<?php echo base_url(); ?>jobseeker/removeimagedata/1" style="background: #eb2e33;color: #fff;padding: 7px;border-radius: 5px;text-decoration: none;" class='deleteItem'><i class="fa fa-trash" aria-hidden="true"></i> Remove Resume</a>
				<?php 
				}
				?>
			</div>
		</div>
				
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<div class="changepwd">
					<h3>Present Address</h3>
				</div>
			</div>
			
		</div>
		<div class="dash-basic dash-basics">
			<div class="form-group frmgrp">
				<div class="col-sm-12 col-md-12 col-xs-12">
					<label for="pwd">Address</label>
					<textarea class="form-control website-input" name='address' id="address"><?php echo @$jsonObj->userInfo[0]->address; ?></textarea>
				</div>
			</div>
			<div class="form-group frmgrp">
				<div class="col-sm-6 col-md-6 col-xs-12">
					<label>State/UN</label>
					<select class="form-control website-input website-sel" name='v_state' id="v_state" >
						<?php 
						$states = $jsonObj->states;
						if(sizeOf($states) > 0)
						{
							for ($s=0; $s < sizeOf($states); $s++) 
							{
								$stateAct = '';
								if($states[$s]->id == @$jsonObj->userInfo[0]->state_id)
								{
									$stateAct = 'selected';
								}
						?>
							<option <?php echo $stateAct; ?> value="<?php echo $states[$s]->id; ?>"><?php echo $states[$s]->state_name; ?></option>
						<?php 
							}
						}
						?>	
					</select>
				</div>	
				<div class="col-sm-6 col-md-6 col-xs-12 mrtop1_8">
					<label>City/Town</label>
					<select class="form-control website-input website-sel" name='v_city' id="v_city">
						<?php 
						$cities = $jsonObj->citiesInfo;
						if(sizeOf($cities) > 0)
						{
							for ($c=0; $c < sizeOf($cities); $c++) 
							{
								$cityAct = '';
								if($cities[$c]->id == @$jsonObj->userInfo[0]->city_id)
								{
									$cityAct = 'selected';
								}
						?>
							<option <?php echo $cityAct; ?> value="<?php echo $cities[$c]->id; ?>"><?php echo $cities[$c]->city_name; ?></option>
						<?php 
							}
						}
						?>			
					</select>
				</div>
			</div>	
			<div class="form-group frmgrp">
				<div class="col-sm-6 col-md-6 col-xs-12">
					<label>Location/Area</label>
					<select class="form-control website-input website-sel" name='v_location' id="v_location">
						<?php 
			    		if(@sizeOf($jsonObj->locations) > 0)
			    		{
				    		for ($l=0; $l < sizeOf($jsonObj->locations); $l++) 
				    		{ 
				    			$locationSel = '';
				    			if(@$jsonObj->locations[$l]->location_name == @$jsonObj->userInfo[0]->area_info)
				    			{
				    				$locationSel = 'selected';
				    			}
				    		?>
				    			<option <?php echo @$locationSel; ?> value="<?php echo @$jsonObj->locations[$l]->location_name; ?>"><?php echo @ucwords($jsonObj->locations[$l]->location_name); ?></option>
				    		<?php
				    		}
			    		}
			    		?>	
					</select>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-12 mrtop1_8">
					<label>Pincode</label>
					<input type="text" class="form-control website-input"  placeholder="Area Pin Code" name='v_zipcode' value="<?php echo @$jsonObj->userInfo[0]->city_zipcode; ?>">
				</div>
			</div>
			
						
		</div>
		<div class="form-group" style="margin-bottom: 1em;">
			<div class="col-sm-12 col-md-12 col-xs-12 text-center">
				<input type="hidden" name='hiddenprofile_pic' value="<?php echo @$jsonObj->userInfo[0]->profile_pic; ?>">
				<input type="hidden" name='hiddenuser_resume' value="<?php echo @$jsonObj->userInfo[0]->user_resume; ?>">
				<button class="btn btn-default website-btn2 outline" type="submit">submit</button>
			</div>
		</div>		
	</div>
			
	</div>
</form>
<script src="<?php echo base_url();?>includes/js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
		var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : {allow_single_deselect:true},
  '.chosen-select-no-single' : {disable_search_threshold:10},
  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
  '.chosen-select-width'     : {width:"95%"}
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}

var config1 = {
  '.chosen-selects'           : {max_selected_options:20},
  '.chosen-select-deselect'  : {allow_single_deselect:true},
  '.chosen-select-no-single' : {disable_search_threshold:10},
  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
  '.chosen-select-width'     : {width:"95%"}
}
for (var selector1 in config1) {
  $(selector1).chosen(config1[selector1]);
}
</script>
