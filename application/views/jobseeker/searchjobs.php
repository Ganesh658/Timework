<?php
$jsonObj=@json_decode($jsonObj);
?>
<style type="text/css">
	.resumes-input{text-transform: capitalize;}
	.bootstrap-tagsinput{margin-bottom: 1em;padding: 9px 15px !important;    border-radius: 35px !important;color: #565656 !important;}
	.bootstrap-tagsinput input{width: 100% !important;color: #565656 !important;}
	.bootstrap-tagsinput .label-info{padding: 5px;font-size: 14px;border-radius: 4px;line-height: 2;}
</style>
<link rel="stylesheet" href="<?php echo base_url()?>includes/tags/bootstrap-tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/chosen.css">
<div class="col-sm-8 col-md-8 col-xs-12">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12">
			<div class="board">
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
				<h4 style="text-align: center;">hi <?php echo @$jsonObj->userInfo[0]->firstname; ?> welcome to JOBSEEKER DASHBOARD</h4>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-1 col-md-2 col-xs-12">
		</div>
		<div class="col-sm-10 col-md-8 col-xs-12">
			<div class="resumes1">
				<h3 style="text-align: center;">search resumes</h3>
			</div>
		</div>
		<div class="col-sm-1 col-md-2 col-xs-12">
		</div>		
	</div>	
	<div class="row">
		<div class="col-sm-1 col-md-2 col-xs-1">
		</div>
		<div class="col-sm-10 col-md-8 col-xs-10">					
			<div class="row recchosen">
				<?php 
				$formType = base_url()."jobseeker/search";
				?>
				<form class="form-horizontal" method="GET" action="<?php echo @$formType; ?>">
					<div class="form-group">
						<div class="col-sm-12 col-md-12 col-xs-12">
							<input type="text" class="form-control resumes-input" id="keyword" name="keyword" placeholder="search by position / key word"  data-role="tagsinput">
							<p style="color: #c3c3c3;margin-top: -13px;float: right;font-size: 12px;">Please Enter position / key word and Press Enter</p>
						</div>
						<div class="col-sm-12 col-md-12 col-xs-12">
							<input type="text" class="form-control resumes-input" id="skills" name="skills" placeholder="Enter Skills" data-role="tagsinput">
							<p style="color: #c3c3c3;margin-top: -13px;float: right;font-size: 12px;">Please Enter Key Skill and Press Enter</p>
						</div>
						<div class="col-sm-12 col-md-12 col-xs-12">
							<input type="text" class="form-control resumes-input" id="exp" name="exp" placeholder="years of experience">
						</div>
						<div class="col-sm-12 col-md-12 col-xs-12">
							<input type="text" class="form-control resumes-input" id="location" name="location" placeholder="location">
						</div>
						
						<?php 
						if(@sizeOf($jsonObj->categories) > 0)
						{
						?>
							<div class="col-sm-12 col-md-12 col-xs-12">
								<select class="form-control resumes-input resumes-input1  chosen-select" id="industry" name="industry">
									<option value="">Select Industry</option>
									<?php
									for ($i=0; $i < sizeOf($jsonObj->categories); $i++) 
									{
									?>
										<option value="<?php echo @$jsonObj->categories[$i]->id; ?>"><?php echo @$jsonObj->categories[$i]->cat_name; ?></option>
									<?php 
									}
									?>
								</select>
							</div>
						<?php 
						}
						?>
					</div>
					<div class="form-group">
						<div class="col-sm-3 col-md-3 col-xs-12">
							<button type="submit" class="btn btn-default resumes-btn outline">Submit Now</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-sm-1 col-md-2 col-xs-1">
		</div>
	</div>
</div>
			<!-- Below Two divs from dashboard header -->
		</div>
	</div>
</section>
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
}</script>
<script src="<?php echo base_url();?>includes/tags/bootstrap-tagsinput.js" type="text/javascript" charset="utf-8"></script>

