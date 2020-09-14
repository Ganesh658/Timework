
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Edit Seo Info</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/seoinfo">Meta Data</a>
			</li>
			<li class="active">
				<strong>Edit Seo Info</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/seoinfo" class="btn btn-w-m btn-default pull-right">Back to List</a>
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-lg-8">
					<div class="ibox">
						
						<div class="ibox-content">
							
							<form method="POST" action="<?php echo base_url()?>index.php/home/updateseoinfo" class="form-horizontal" enctype="multipart/form-data">
							
								
								<div class="form-group">
									<label class="col-sm-4 control-label">Description</label>
									<div class="col-sm-8">
										<textarea name="seo_description" id="seo_description" class="form-control" required rows='10'><?php echo @$info[0]->seo_description;?></textarea>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
							

								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<!--<button class="btn btn-white" type="reset">Reset</button>-->
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$bannerid;?>">
										<button class="btn btn-primary" type="submit">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>