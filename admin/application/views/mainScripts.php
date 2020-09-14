<style>
.center{
	text-align:center;
}
ul.spekul{
	margin-bottom:5%;
	padding:0;
}
ul.spekul li{
	list-style:none;
	padding:5px 10px;
	float:left;
}
ul.spekul li a{	
	background-color:#428bca;
	border:1px solid;
	padding:5px 10px;
	color:#fff;
}
</style>
<?php 
if(@$page_type == 8)
{
	$pageName = "Head Section";
}
if(@$page_type == 9)
{
	$pageName = "Cookies Content";
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li class="active">
				<strong><?php echo @$pageName; ?></strong>
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox">
<!-- 						<div class="row">
							<div class="col-sm-12">
								<ul class="spekul">
									<li><a <?php if(@$type == 6){echo 'style="background-color:#fff;color:#000;"';}?> href="<?php echo base_url();?>index.php/home/mainScripts/6">Google Analytics</a></li>
									<li><a <?php if(@$type == 7){echo 'style="background-color:#fff;color:#000;"';}?> href="<?php echo base_url();?>index.php/home/mainScripts/7">Tawk</a></li> 
								</ul>
							</div>
						</div> -->
						<div class="ibox-content">
							<?php
							if(@$this->session->userdata("success") != '')
							{
							?>
								<div class="alert alert-success alert-dismissable">
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
								<div class="alert alert-danger alert-dismissable">
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
									<?php
									echo @$this->session->userdata("fail");
									@$this->session->unset_userdata("fail");
									?>
								</div>
							<?php
							}
							?>
							<?php
							if(@sizeOf($info) > 0)
							{
							?>
							<div class="row">
								<div class="col-sm-12" style="margin-bottom:2%">
									<a class="btn btn-info pull-right" href="<?php echo base_url();?>index.php/home/deletemainScripts/<?php echo @$info[0]->id;?>/<?php echo @$type;?>">Delete	</a>
								</div>
							</div>
							<?php
							}
							?>
							<form method="POST" action="<?php echo base_url()?>index.php/home/savemainScripts" class="form-horizontal" enctype="multipart/form-data">
							
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php echo @$pageName; ?></label>
									<div class="col-sm-8">
										<textarea rows="10" name="long_desc" id="long_desc" class="form-control txtcls"><?php echo @$info[0]->long_desc;?></textarea>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<?php 
								if(@$page_type == 8)
								{
								?>
									<div class="form-group">
										<label class="col-sm-2 control-label">Body Section</label>
										<div class="col-sm-8">
											<textarea rows="10" name="short_desc" id="short_desc" class="form-control txtcls"><?php echo @$info[0]->short_desc;?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
								<?php 
								}
								?>
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<!--<button class="btn btn-white" type="reset">Reset</button>-->
										<input type="hidden" name="page_type" id="page_type" value="<?php echo @$type;?>">
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$info[0]->id;?>">
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