<?php
$jsonObj=@json_decode($jsonObj);
?>
<div class="">
	<div class="just1 mbmrtp">
		<div class="col-sm-1 col-md-1 col-xs-12">
		</div>
		<div class="col-sm-10 col-md-10 col-xs-12">
			<h4 class="question">question &amp; answers</h4>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php 
				$faqsContent = @$jsonObj->faqsContent;
				if(@sizeOf($faqsContent) > 0)
				{
					for ($c=0; $c < @sizeOf($faqsContent); $c++) 
					{
						$openans = '';
						$clpsin = '';
						$extrue = 'false';
					?>
						<div class="panel panel-default card_<?php echo @$faqsContent[$c]->id; ?> faqcms <?php echo @$openans; ?>" id='<?php echo @$faqsContent[$c]->id; ?>'>
							<div class="panel-heading" role="tab" id="heading_<?php echo @$faqsContent[$c]->id; ?>">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo @$faqsContent[$c]->id; ?>" aria-expanded="<?php echo @$extrue; ?>" aria-controls="collapse_<?php echo @$faqsContent[$c]->id; ?>">
										<?php echo @$faqsContent[$c]->cms_title; ?>
									</a>
								</h4>
							</div>
							<div id="collapse_<?php echo @$faqsContent[$c]->id; ?>" class="panel-collapse collapse <?php echo @$clpsin; ?>" role="tabpanel" aria-labelledby="heading_<?php echo @$faqsContent[$c]->id; ?>">
								<div class="panel-body">
								 <?php echo @$faqsContent[$c]->long_desc; ?>
								</div>
							</div>
						</div>

					<?php 
					}
				}
				else
				{
					echo "<p style='color: red;font-size: 20px;'>Question &amp; Answers Not Available</p>";
				}
				?>
			</div>
		</div>
		<div class="col-sm-1 col-md-1 col-xs-12">
		</div>			
	</div>	
</div>			
