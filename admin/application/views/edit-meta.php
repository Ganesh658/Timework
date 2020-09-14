<?php
if(@$info[0]->page_type == 1)
{
$pageName="Home";
}
elseif(@$info[0]->page_type == 2)
{
$pageName="About Us";
}
elseif(@$info[0]->page_type == 3)
{
$pageName="Contact";
}
elseif(@$info[0]->page_type == 4)
{
$pageName="Faqs";
}
elseif(@$info[0]->page_type == 5)
{
$pageName="Job Listings";
}
elseif(@$info[0]->page_type == 6)
{
$pageName="Job Seeker";
}
elseif(@$info[0]->page_type == 7)
{
$pageName="Post Job";
}
elseif(@$info[0]->page_type == 8)
{
$pageName="Search Resume(Recruiter)";
}
elseif(@$info[0]->page_type == 9)
{
$pageName="Registration";
}
elseif(@$info[0]->page_type == 10)
{
$pageName="Login";
}
elseif(@$info[0]->page_type == 11)
{
$pageName="Testimonial";
}
elseif(@$info[0]->page_type == 12)
{
$pageName="Top Consultants";
}
elseif(@$info[0]->page_type == 13)
{
$pageName="Upload Resume";
}
elseif(@$info[0]->page_type == 14)
{
$pageName="Value Plans(vendor)";
}
elseif(@$info[0]->page_type == 15)
{
$pageName="Job Posting(vendor)";
}
elseif(@$info[0]->page_type == 16)
{
$pageName="Bench Sales Groups";
}
elseif(@$info[0]->page_type == 17)
{
$pageName="Bench Sales Groups Results";
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Edit <?php echo @$pageName; ?> Meta Data</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/meta">Meta Data</a>
			</li>
			<li class="active">
				<strong>Edit <?php echo @$pageName; ?> Meta Data</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/meta" class="btn btn-w-m btn-default pull-right">Back to List</a>
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
							
							<form method="POST" action="<?php echo base_url()?>index.php/home/updatemeta" class="form-horizontal" enctype="multipart/form-data">
							
								<div class="form-group">
									<label class="col-sm-4 control-label">Title</label>
									<div class="col-sm-8">
										<input type="text" name="meta_title" id="meta_title" class="form-control" required value="<?php echo @$info[0]->meta_title;?>"/>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Description</label>
									<div class="col-sm-8">
										<textarea name="meta_desc" id="meta_desc" class="form-control" required><?php echo @$info[0]->meta_desc;?></textarea>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Key Words</label>
									<div class="col-sm-8">
										<input type="text" name="meta_keywords" id="meta_keywords" class="form-control" required value="<?php echo @$info[0]->meta_keywords;?>" />
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