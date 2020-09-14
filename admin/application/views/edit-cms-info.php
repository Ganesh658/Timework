<?php 
if(@$page_type == 1)
{
	$pageName = 'Designations';
}
if(@$page_type == 2)
{
	$pageName = 'User Categories';
}
if(@$page_type == 3)
{
	$pageName = 'Departments';
}
if(@$page_type == 4)
{
	$pageName = 'Years';
}
if(@$page_type == 5)
{
	$pageName = 'Article Types';
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Edit <?php echo @$pageName; ?> Content</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/cmsInfo/<?php echo @$page_type; ?>"><?php echo @$pageName; ?></a>
			</li>
			<li class="active">
				<strong>Edit <?php echo @$pageName; ?> Content</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url();?>index.php/home/cmsInfo/<?php echo @$page_type; ?>" class="btn btn-w-m btn-default pull-right">Back to List</a>
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox">
						
						<div class="ibox-content">
							
							<form method="POST" action="<?php echo base_url()?>index.php/home/updatecmsInfo" class="form-horizontal" enctype="multipart/form-data">
							
								<div class="form-group">
									<label class="col-sm-2 control-label">Title</label>
									<div class="col-sm-8">
										<input type="text" name="cms_title" id="cms_title" class="form-control" required value="<?php echo @$info[0]->cms_title;?>"/>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
															
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$bannerid;?>">
										<input type="hidden" name="page_type" id="page_type" value="<?php echo @$page_type;?>">
										
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

