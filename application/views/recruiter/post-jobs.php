<?php
$jsonObj=@json_decode($jsonObj);
?>
<style type="text/css">
#last_date{
    background: url('<?php echo base_url(); ?>includes/img/calendar.png')no-repeat 96% 50%;
    cursor: pointer;
}
.chosen-container-multi .chosen-choices li.search-field input[type="text"]{    height: 34px !important;border-radius: 10px;}
.chosen-choices{border-radius: 10px;}
textarea{    padding: 20px 15px !important;}
.datepicker-dropdown {margin-top: 4.5em !important;}
.del-exp h4 {font-size: 13px !important;}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard-responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/chosen.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>includes/tags/bootstrap-tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url()?>includes/summernote/summernote.css">

<div class="just1">
	<div class="col-sm-1 col-md-1 col-xs-12 nopadding"></div>
	<div class="col-sm-8 col-md-8 col-xs-12 nopadding">
		<div class="dash-basic">
			<form method="POST" action="<?php echo base_url("index.php/recruiter/savePostJobs");?>" id="lang_info" class="form-horizontal updatePassword" name="" autocomplete='off'>
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
					?>
					<h4>Post Job
						<a href="<?php echo base_url(); ?>recruiter/jobpostings" class='backlist'><i class="fa fa-arrow-left" aria-hidden="true"></i> Back To My Posts</a>
					</h4>
					<div class="row hamsterchosen">
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Job Title<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<input type="text" class="form-control website-input" id="job_title" name="job_title" placeholder="Enter Job Title" required>
						    </div>
						</div>
						
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">State/UN<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<select id="job_state" name="job_state" class="form-control website-input chosen-select" data-placeholder="Select Job State" required>
						    		<option></option>
						    		<?php 
						    		if(@sizeOf($jsonObj->states) > 0)
						    		{
							    		for ($s=0; $s < sizeOf($jsonObj->states); $s++) 
							    		{ 
							    		?>
							    			<option value="<?php echo @$jsonObj->states[$s]->id; ?>"><?php echo @ucwords($jsonObj->states[$s]->state_name); ?></option>
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
						    		<option></option>
						    		
						    	</select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Location/Area:</label>
						    <div class="col-sm-8">
						    	<select id="job_location" name="job_location" class="form-control website-input chosen-select" data-placeholder="Select Job Location">
						    		<option></option>
						    		
						    	</select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Job Skills<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<select id="job_skills" name="job_skills[]" class="form-control website-input chosen-selects" data-placeholder="Select Job Skills Upto 20 Skills" required multiple>
						    		<option></option>
						    		<?php 
						    		if(@sizeOf($jsonObj->jobskills) > 0)
						    		{
							    		for ($sk=0; $sk < sizeOf($jsonObj->jobskills); $sk++) 
							    		{ 
							    		?>
							    			<option value="<?php echo @$jsonObj->jobskills[$sk]->skill_name; ?>"><?php echo @ucwords($jsonObj->jobskills[$sk]->skill_name); ?></option>
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
				    			if($categories[$c]->id == '2')
				    			{
				    				$clmName = 'salary';
				    				$clmVal = @$subCategories[$s]->id;
				    			}
				    			if($categories[$c]->id == '4')
				    			{
				    				$clmName = 'experience';
				    				$clmVal = @$subCategories[$s]->id;
				    			}
				    			if($categories[$c]->id == '6')
				    			{
				    				$clmName = 'employment_type';
				    				$clmVal = @$subCategories[$s]->cat_name;
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
								    			if($categories[$c]->id == '2')
								    			{
								    				$clmVal = @$subCategories[$s]->id;
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
								    			<option value="<?php echo @$clmVal; ?>"><?php echo @ucwords($subCategories[$s]->cat_name); ?></option>
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
			    		?>
			    		<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Salary Type<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<select id="salary_type" name="salary_type" class="form-control website-input" required>
						    		<option value="1">Hourly</option>
						    		<option value="2">Daily</option>
						    		<option value="3">Weekly</option>
						    		<option value="4">Monthly</option>
						    		<option value="5">Yearly</option>
						    	</select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Salary<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<input type="text" class="form-control website-input" id="job_salary" name="job_salary" placeholder="Ex:5000" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">No.of Openings<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<input type="text" class="form-control website-input" id="no_of_posts" name="no_of_posts" placeholder="Enter No.of Openings" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Joining Type<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<select id="joining_type" name="joining_type" class="form-control website-input" required>
						    		<option value="1">Immediate</option>
						    		<option value="2">Within This Week</option>
						    		<option value="3">Next Week</option>
						    		<option value="4">1st Of Next Month</option>
						    	</select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email" style="text-align: left;"></label>
						    <label class="control-label col-sm-9" for="email" style="text-align: left;margin-bottom: 1%;">Job Timings:</label>
						    <label class="control-label col-sm-3" for="email">From:</label>
						    <div class="col-sm-3">
						    	 <input type='text' class="form-control  website-input" value="<?php echo @$results[0]->from_time; ?>" name='from_time' placeholder="Ex:9:00 AM"/>
						    </div>
						    <label class="control-label col-sm-1" for="email">To:</label>
						    <div class="col-sm-3">
						    	<input type='text' class="form-control  website-input"  value="<?php echo @$results[0]->to_time; ?>"  name='to_time' placeholder="Ex:6:00  PM"/>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Notice Period:</label>
						    <div class="col-sm-8">
						    	<input type="text" class="form-control website-input" id="notice_period" name="notice_period" placeholder="Enter Notice Period">
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Useful Web Link:</label>
						    <div class="col-sm-8">
						    	<input type="text" class="form-control website-input" id="web_link" name="web_link" placeholder="Enter Useful Web Link">
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Interview Location:</label>
						    <div class="col-sm-8">
						    	<textarea id="interview_location" name="interview_location" class="form-control website-input" placeholder="Copy and Paste the Google Maps Location URL"></textarea>
						    </div>
						</div>
						<!-- <div class="form-group">
						    <label class="control-label col-sm-3" for="email">Business Address:</label>
						    <div class="col-sm-8">
						    	<textarea id="business_adrs" name="business_adrs" class="form-control website-input"></textarea>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Map Location:</label>
						    <div class="col-sm-8">
						    	<textarea id="map_locations" name="map_locations" class="form-control website-input"></textarea>
						    </div>
						</div>
						 -->
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Interview Details:</label>
						    <div class="col-sm-8">
						    	<textarea id="short_description" name="description" class="form-control website-input txtcls"></textarea>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3" for="email">Job Description<span class="mandatory">*</span>:</label>
						    <div class="col-sm-8">
						    	<textarea id="job_description" name="job_description" class="form-control website-input txtcls"></textarea>
						    </div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3"></label>
						    <div class="col-sm-8">
								<button type="submit" class="btn btn-default website-btn2 outline">SUBMIT</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>includes/summernote/summernote.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>includes/js/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>includes/tags/bootstrap-tagsinput.js" type="text/javascript" charset="utf-8"></script>

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
  '.chosen-selects'           : {max_selected_options:20},
  '.chosen-select-deselect'  : {allow_single_deselect:true},
  '.chosen-select-no-single' : {disable_search_threshold:10},
  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
  '.chosen-select-width'     : {width:"95%"}
}
for (var selector1 in config1) {
  $(selector1).chosen(config1[selector1]);
}

$(function () {
	$('#last_date').datepicker({
		startDate : 'today',
		todayHighlight:'TRUE',
		autoclose: true,
	});
});

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
