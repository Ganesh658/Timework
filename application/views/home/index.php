<?php
$jsonObj=@json_decode($jsonObj);
if( @$this->session->userdata("usertype") == '3')
{
	$homeCntrl = 'jobseeker';
}
else if( @$this->session->userdata("usertype") == '5')
{
	$homeCntrl = 'recruiter';
}
else
{
	$homeCntrl = 'jobseeker';
}
if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
{
	$serId = '';
	$serType = 'submit';
}
else if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
{
	$serId = '';
	$serType = 'submit';
}
else
{
	$serId = '';
	$serType = 'submit';
}
?>
<div class="just1">
	<div class="col-sm-12 col-md-12 col-xs-12 nopadding">
		<div class="s01">
			<form name="search-form" method="GET" action="<?php echo base_url(); ?>index.php/<?php echo @$homeCntrl; ?>/search">
				<!-- <fieldset>
					<legend>Discover the Amazing City</legend>
				</fieldset> -->
				<div class="inner-form">
					<div class="input-field first-wrap">
						<label>Keyword</label>
						<input id="skillnames" type="text" placeholder="Enter Skill or Employment Type" name="skillnames" />
					</div>
					<div class="input-field second-wrap">
						<label>Location</label>
						<input id="location" type="text" placeholder="Enter City" name="location" />
					</div>
					<div class="input-field third-wrap">

						<button class="btn-search" type="<?php echo @$serType; ?>" id="<?php echo @$serId; ?>">Search</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
