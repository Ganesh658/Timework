<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Add States</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/states">Cities</a>
			</li>
			<li class="active">
				<strong>Add State</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/states" class="btn btn-w-m btn-default pull-right">Back to List</a>
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
							<form method="POST" action="<?php echo base_url()?>index.php/home/savestates" class="form-horizontal" enctype="multipart/form-data">

								<div class="form-group">
									<label class="col-sm-4 control-label">State Name </label>
									<div class="col-sm-8">
										<input type="text" name="state_name" id="state_name" class="form-control" required />
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$bannerid;?>">
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
	