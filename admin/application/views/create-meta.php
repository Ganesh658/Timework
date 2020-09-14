<style type="text/css">
	input[type="button" i]:disabled, input[type="submit" i]:disabled, input[type="reset" i]:disabled, input[type="file" i]:disabled::-webkit-file-upload-button, button:disabled, select:disabled, optgroup:disabled, option:disabled, select[disabled] > option {
    color: #ccc;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Add Data</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/meta">Meta Data</a>
			</li>
			<li class="active">
				<strong>Add Data</strong>
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
							<form method="POST" action="<?php echo base_url()?>index.php/home/savemeta" class="form-horizontal" enctype="multipart/form-data">
								<?php
								$banArray=array();
								if(@sizeOf($banners) > 0)
								{
									for($b=0;$b<@sizeOf($banners);$b++)
									{
										$banArray[$b]=$banners[$b]->page_type;
									}
								}
								//print_r($banArray);
								?>
								<div class="form-group">
									<label class="col-sm-4 control-label">Page</label>
									<div class="col-sm-8">
										<select name="page_type" id="page_type" class="form-control" required>
											<option value="">Select Page</option>
											<option  value="1" <?php if(@in_array(1,$banArray)){echo "disabled=disabled";}?>>Home Page</option>
											<option <?php if(@in_array(2,$banArray)){echo "disabled=disabled";}?> value="2">About Us</option>
											<option <?php if(@in_array(3,$banArray)){echo "disabled";}?> value="3">Contact</option>
											<option <?php if(@in_array(4,$banArray)){echo "disabled";}?> value="4">Faqs For Candidates</option>
											<option <?php if(@in_array(5,$banArray)){echo "disabled";}?> value="5">Faqs  For Recruiters</option>										
											<option <?php if(@in_array(6,$banArray)){echo "disabled";}?> value="6">Registration</option>
											<option <?php if(@in_array(7,$banArray)){echo "disabled";}?> value="7">Login</option>
										</select>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Title</label>
									<div class="col-sm-8">
										<input type="text" name="meta_title" id="meta_title" class="form-control" required />
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Description</label>
									<div class="col-sm-8">
										<textarea name="meta_desc" id="meta_desc" class="form-control" required></textarea>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Key Words</label>
									<div class="col-sm-8">
										<input type="text" name="meta_keywords" id="meta_keywords" class="form-control" required />
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
	