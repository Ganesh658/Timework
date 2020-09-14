<?php
$jsonObj=@json_decode($jsonObj);
?>
<div class="just1">
	<div class="col-sm-12 col-md-12 col-xs-12 nopadding">
		<div class="s01">
			<form name="search-form" method="GET" action="<?php echo base_url(); ?>index.php/recruiter/search">
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
						<button class="btn-search" type="submit">Search</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
