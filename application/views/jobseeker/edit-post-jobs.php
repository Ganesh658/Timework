<?php
$jsonObj=@json_decode($jsonObj);
?>
<style type="text/css">
#last_date{
    background: url('<?php echo base_url(); ?>includes/img/calendar.png')no-repeat 96% 50%;
    cursor: pointer;
}
.chosen-container-multi .chosen-choices li.search-field input[type="text"]{    height: 34px !important;border-radius: 35px;}
.chosen-choices{border-radius: 35px;}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard-responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url()?>includes/tags/bootstrap-tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url()?>includes/summernote/summernote.css">

<div class="just1 mbmrtp3">
	<div class="col-sm-1 col-md-1 col-xs-12 nopadding"></div>
	<div class="col-sm-8 col-md-8 col-xs-12 mt-2">
		<div class="dash-basic">
			<form method="POST" action="<?php echo base_url("index.php/jobseeker/updatePostJobs");?>" id="lang_info" class="form-horizontal updatePassword" name="" autocomplete='off'>
				<div class="">
					<?php
					if(@$this->session->userdata("success") != '')
					{
					?>
					<div class="alert alert-success  alert-dismissable">
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
					<div class="alert alert-danger  alert-dismissable">
						 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
					<?php
						echo @$this->session->userdata("fail");
						@$this->session->unset_userdata("fail");
					?>
					</div>
					<?php
					}
					$results = @$jsonObj->results;
					?>
					<div class="row">
						<h4>Edit Need Job
							<a href="<?php echo base_url(); ?>jobseeker/myJobs" class='backlist'><i class="fa fa-arrow-left" aria-hidden="true"></i> Back To My Posts</a>
						</h4>
					</div>
					<div class="row hamsterchosen">
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Job Title<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<input type="text" class="form-control website-input" id="job_title" name="job_title" placeholder="Enter Job Title" required value="<?php echo @$results[0]->job_title; ?>">
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">State/UN<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<select id="job_state" name="job_state" class="form-control website-input chosen-select" data-placeholder="Select Job State" required>
						    		
						    		<?php 
						    		if(@sizeOf($jsonObj->states) > 0)
						    		{
							    		for ($sr=0; $sr < sizeOf($jsonObj->states); $sr++) 
							    		{ 
							    			$stateSel = '';
							    			if(@$jsonObj->states[$sr]->id == @$results[0]->state_id)
							    			{
							    				$stateSel = 'selected';
							    			}
							    		?>
							    			<option <?php echo @$stateSel; ?> value="<?php echo @$jsonObj->states[$sr]->id; ?>"><?php echo @ucwords($jsonObj->states[$sr]->state_name); ?></option>
							    		<?php
							    		}
						    		}
						    		?>
						    	</select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">City/Town<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<select id="job_city" name="job_city" class="form-control website-input chosen-select" data-placeholder="Select Job City" required>
						    		<?php 
						    		if(@sizeOf($jsonObj->cities) > 0)
						    		{
							    		for ($v=0; $v < sizeOf($jsonObj->cities); $v++) 
							    		{ 
							    			$citySel = '';
							    			if(@$jsonObj->cities[$v]->id == @$results[0]->city_id)
							    			{
							    				$citySel = 'selected';
							    			}
							    		?>
							    			<option <?php echo @$citySel; ?> value="<?php echo @$jsonObj->cities[$v]->id; ?>"><?php echo @ucwords($jsonObj->cities[$v]->city_name); ?></option>
							    		<?php
							    		}
						    		}
						    		?>
						    	</select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Location/Area:</label>
						    <div class="col-sm-8">
						    	<select id="job_location" name="job_location" class="form-control website-input chosen-select" data-placeholder="Select Job Location">
						    		<?php 
						    		if(@sizeOf($jsonObj->locations) > 0)
						    		{
							    		for ($l=0; $l < sizeOf($jsonObj->locations); $l++) 
							    		{ 
							    			$locationSel = '';
							    			if(@$jsonObj->locations[$l]->id == @$results[0]->location_id)
							    			{
							    				$locationSel = 'selected';
							    			}
							    		?>
							    			<option <?php echo @$locationSel; ?> value="<?php echo @$jsonObj->locations[$l]->id; ?>"><?php echo @ucwords($jsonObj->locations[$l]->location_name); ?></option>
							    		<?php
							    		}
						    		}
						    		?>
						    	</select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Job Skills<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<select id="job_skills" name="job_skills[]" class="form-control website-input chosen-selects" data-placeholder="Select Job Skills Upto 10 Skills" required multiple>
						    		<?php 
						    		$job_skills = @explode(",", $results[0]->job_skills);

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
						
						
						<?php 
						$categories = @$jsonObj->categories;
			    		if(@sizeOf($categories) > 0)
			    		{
				    		for ($c=0; $c < sizeOf($categories); $c++) 
				    		{ 
				    			if($categories[$c]->id != '2')
				    			{
					    			if($categories[$c]->id == '4')
					    			{
					    				$clmName = 'experience';
					    			}
					    			if($categories[$c]->id == '6')
					    			{
					    				$clmName = 'employment_type';
					    			}
					    		?>
								<div class="form-group">
								    <label class="control-label col-sm-3" for="email"><?php echo @ucwords($categories[$c]->cat_name); ?><span class="mandatory">*</span>:</label>
								    <div class="col-sm-8">
								    	<select name="<?php echo @$clmName; ?>" class="form-control website-input chosen-select" data-placeholder="Select <?php echo @ucwords($categories[$c]->cat_name); ?>">
								    		<option></option>
								    		<?php 
								    		$subCategories = @$categories[$c]->subCategories;
								    		if(@sizeOf($subCategories) > 0)
								    		{
									    		for ($s=0; $s < sizeOf($subCategories); $s++) 
									    		{ 
									    			$catSel = '';
									    			if(@$subCategories[$s]->id == @$results[0]->salary)
									    			{
									    				$catSel = 'selected';
									    			}
									    			if(@$subCategories[$s]->id == @$results[0]->experience)
									    			{
									    				$catSel = 'selected';
									    			}
									    			if(@$subCategories[$s]->cat_name == @$results[0]->employment_type)
									    			{
									    				$catSel = 'selected';
									    			}
									    			
									    			if($categories[$c]->id == '4')
									    			{
									    				$clmVal = @$subCategories[$s]->id;
									    			}
									    			if($categories[$c]->id == '6')
									    			{
									    				$clmVal = @$subCategories[$s]->cat_name;
									    			}
									    		?>
									    			<option <?php echo @$catSel; ?> value="<?php echo @$clmVal; ?>"><?php echo @ucwords($subCategories[$s]->cat_name); ?></option>
									    		<?php
									    		}
								    		}
								    		?>
								    	</select>
								    </div>
								</div>
							<?php
								}
				    		}
			    		}
			    		?>
			    		<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Joining Type<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<select id="joining_type" name="joining_type" class="form-control website-input" required>
						    		<option value="1" <?php if(@$results[0]->joining_type == '1'){echo "selected";} ?>>Immediate</option>
						    		<option value="2" <?php if(@$results[0]->joining_type == '2'){echo "selected";} ?>>With This Week</option>
						    		<option value="3" <?php if(@$results[0]->joining_type == '3'){echo "selected";} ?>>Next Week</option>
						    		<option value="4" <?php if(@$results[0]->joining_type == '4'){echo "selected";} ?>>1st Of Next Month</option>
						    	</select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Preferred Shift<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<select id="preferred_shift" name="preferred_shift" class="form-control website-input" required>
						    		<option value="1" <?php if(@$results[0]->preferred_shift == '1'){echo "selected";} ?>>Any Shift</option>
						    		<option value="2" <?php if(@$results[0]->preferred_shift == '2'){echo "selected";} ?>>Morning Shift</option>
						    		<option value="3" <?php if(@$results[0]->preferred_shift == '3'){echo "selected";} ?>>Afternoon Shift</option>
						    		<option value="4" <?php if(@$results[0]->preferred_shift == '4'){echo "selected";} ?>>Evening Shift</option>
						    		<option value="5" <?php if(@$results[0]->preferred_shift == '5'){echo "selected";} ?>>Night Shift</option>
						    	</select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Need Job Description<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<textarea id="short_description" name="description" class="form-control website-input txtcls"><?php echo @$results[0]->description; ?></textarea>
						    </div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3"></label>
						    <div class="col-sm-8">
								<button type="submit" class="btn btn-default website-btn2 outline">SUBMIT</button>
								<input type="hidden" id="rowId" name="rowId" value="<?php echo @$jsonObj->rowId; ?>" />
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
		
<script src="<?php echo base_url();?>includes/js/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>includes/tags/bootstrap-tagsinput.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>includes/summernote/summernote.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.txtcls').summernote({
		height: 250,
		toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline', 'clear']],
	    ['fontsize', ['fontsize']],
	    ['color', ['color']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['height', ['height']]
	  ],
	  
	});
});
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
  '.chosen-selects'           : {max_selected_options:10},
  '.chosen-select-deselect'  : {allow_single_deselect:true},
  '.chosen-select-no-single' : {disable_search_threshold:10},
  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
  '.chosen-select-width'     : {width:"95%"}
}
for (var selector1 in config1) {
  $(selector1).chosen(config1[selector1]);
}

$('#job_state').change(function(){
	var stateId = $(this).val();
	if(stateId != '')
	{
		$.ajax({
	      type:"POST",
	      url: baseurl+"home/getCitieslist/"+stateId,
	      data:"segmentid="+stateId,
	      async:false,
	      success:function(catInfo)
	      {
	     
	          var appendOpt='';
	          if(catInfo.length > 0)
	          {
	          	appendOpt += ("<option></option>");
	            for(i=0; i<catInfo.length; i++) 
	            {
	            	appendOpt += ("<option value="+catInfo[i].id+">"+catInfo[i].city_name+"</option>");    
	            }
	            $('select#job_city').html(appendOpt);
	            $('select#job_city').trigger("chosen:updated");
	            $('select#job_location').html('');
				$('select#job_location').trigger("chosen:updated");
	          }
	          else
	          {
				$('select#job_city').html('');
				$('select#job_city').trigger("chosen:updated");
				$('select#job_location').html('');
				$('select#job_location').trigger("chosen:updated");
	          }

	      
	      }
	      
	    });
    }
});
$('#job_city').change(function(){
	var stateId = $('#job_state').val();
	var cityId = $(this).val();
	if(stateId != '' && cityId != '')
	{
		$.ajax({
	      type:"POST",
	      url: baseurl+"home/getLocationslist/"+stateId+"/"+cityId,
	      data:"segmentid="+stateId,
	      async:false,
	      success:function(catInfo)
	      {
	     
	          var appendOpt='';
	          if(catInfo.length > 0)
	          {
	            for(i=0; i<catInfo.length; i++) 
	            {
	            	appendOpt += ("<option value="+catInfo[i].id+">"+catInfo[i].location_name+"</option>");    
	            }
	            $('select#job_location').html(appendOpt);
	            $('select#job_location').trigger("chosen:updated");
	          }
	          else
	          {
				$('select#job_location').html('');
				$('select#job_location').trigger("chosen:updated");
	          }

	      
	      }
	      
	    });
    }
});

</script>
