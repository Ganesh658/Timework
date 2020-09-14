<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>externals/tags/bootstrap-tagsinput.css">
<style type="text/css">
	.bootstrap-tagsinput{border-radius: 0}
	.bootstrap-tagsinput input{width: 100%;}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Add skill</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/skills">Skills</a>
			</li>
			<li class="active">
				<strong>Add skill</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/skills" class="btn btn-w-m btn-default pull-right">Back to List</a>
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
							<form method="POST" action="<?php echo base_url()?>index.php/home/saveskills" class="form-horizontal" enctype="multipart/form-data">
								
								<div class="form-group">
									<label class="col-sm-4 control-label">Skill Name</label>
									<div class="col-sm-8">
										<input type="text" name="skill_names" id="skill_names" class="form-control" required data-role="tagsinput" placeholder="Enter Skill Name and Press Enter.."/>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<button class="btn btn-white" type="reset">Reset</button>
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
<script src="<?php echo base_url();?>externals/tags/bootstrap-tagsinput.js" type="text/javascript" charset="utf-8"></script>