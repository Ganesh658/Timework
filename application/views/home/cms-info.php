<?php
$jsonObj=@json_decode($jsonObj);
$cmsInfo = @$jsonObj->cmsInfo; 
$page_type = @$jsonObj->page_type; 
if(@$page_type == '3')
{
	$pageTitle = 'privacy policy';
}
else
{
	$pageTitle = 'Terms &amp; Conditions';
}
?>
<div class="just1 mbmrtp2">
	<div class="col-sm-1 col-md-1"></div>
	<div class="col-sm-10 col-md-10 col-xs-12">
		
		<div class="row">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<h4 class="question crqtn text-center questioncms"><?php echo @$pageTitle; ?></h4>
			</div>
		</div>
		<?php 
		if(@sizeOf($cmsInfo) > 0)
		{
			for ($c=0; $c < sizeOf($cmsInfo); $c++) 
			{ 
			?>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xs-12">
						<h5 style="color: #000;font-size: 24px;font-family: 'OpenSans-Bold';"><?php echo @$cmsInfo[$c]->cms_title; ?></h5>
						<p><?php echo @$cmsInfo[$c]->long_desc; ?></p>
					</div>
				</div>
			<?php
			}
		}
		?>
	</div>
</div>
