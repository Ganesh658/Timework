<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Address</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li class="active">
				<strong>Update Address</strong>
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
							<form method="POST" action="<?php echo base_url()?>index.php/home/saveaddress" class="form-horizontal" enctype="multipart/form-data">
							
								<div class="form-group">
									<label class="col-sm-2 control-label">Address</label>
									<div class="col-sm-8">
										<textarea name="company_address" id="company_address" class="form-control txtcls" required><?php echo @$info[0]->company_address;?></textarea>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Phone</label>
									<div class="col-sm-8">
										<input type="text" name="company_phone" id="company_phone" class="form-control txtcls" value="<?php echo @$info[0]->company_phone;?>" required>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Primary Email Id</label>
									<div class="col-sm-8">
										<input type="email" name="company_email" id="company_email" class="form-control txtcls" value="<?php echo @$info[0]->company_email;?>" required/>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Whatsapp Number</label>
									<div class="col-sm-8">
										<input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control txtcls" value="<?php echo @$info[0]->whatsapp_number;?>" required/>
									</div>
								</div>
								<div class="hr-line-dashed"></div>

								<!-- <div class="form-group">
									<label class="col-sm-2 control-label">Map Latitude</label>
									<div class="col-sm-8">
										<input type="text" name="map_latitude" id="map_latitude" class="form-control txtcls" value="<?php echo @$info[0]->map_latitude;?>" />
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Map Longitude</label>
									<div class="col-sm-8">
										<input type="text" name="map_longitude" id="map_longitude" class="form-control txtcls" value="<?php echo @$info[0]->map_longitude;?>" />
									</div>
								</div>
								<div class="hr-line-dashed"></div> -->
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<!--<button class="btn btn-white" type="reset">Reset</button>-->
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