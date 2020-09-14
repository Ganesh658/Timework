<?php
$jsonObj=@json_decode($jsonObj);
?>
<style type="text/css">
	.form-horizontal .form-group{margin: 0}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard-responsive.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<div class="just1 mbmrtp3">
	<div class="col-sm-1 col-md-1 col-xs-12 nopadding"></div>
	<div class="col-sm-8 col-md-8 col-xs-12 nopadding">
		<div class="dash-basic">
			<form class="form-horizontal" id="personalinfo" method="POST" action="<?php echo base_url(); ?>recruiter/updateUserPassword"  autocomplete='off'  enctype="multipart/form-data">		
				<?php
				if(@$this->session->userdata("success") != '')
				{
				?>
				<div class="alert alert-success  alert-dismissable">
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
				<div class="alert alert-danger  alert-dismissable">
					 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<?php
					echo @$this->session->userdata("fail");
					@$this->session->unset_userdata("fail");
				?>
				</div>
				<?php
				}
				?>
				<div class="col-sm-12 col-md-12 col-xs-12">
					<div class="changepwd">
						<h3>change password</h3>
					</div>
				</div>
				<div class="">	
					<div class="form-group frmgrp">
						<div class="col-sm-6 col-md-6 col-xs-12" id="show_hide_password">
							<input type="password" class="form-control website-input"  placeholder="Enter Old Password" value="" required  name="oldpassword" id="oldpassword">
							
							<a href=""><i class="fa fa-eye-slash" id="togglePassword_old" style="margin-left: 380px;cursor: pointer;top: -11px;position: absolute;margin-top: 24px;" aria-hidden="true"></i></a>
							<!--<i class="far fa-eye" id="togglePassword_old" style="margin-left: 380px;cursor: pointer;top: -11px;position: absolute;margin-top: 24px;" ></i>-->
						
							<div class="oldMsg"></div>
						</div>
					</div>
					<div class="form-group frmgrp">
						<div class="col-sm-6 col-md-6 col-xs-12" id="new">
							<input type="password" class="form-control website-input"  placeholder="Enter New Password" value="" required  name="upassword" id="upassword">
							<a href=""><i class="fa fa-eye-slash" id="togglePassword_new" style="margin-left: 380px;cursor: pointer;top: -11px;position: absolute;margin-top: 24px;" aria-hidden="true"></i></a>
							<!--<i class="ffa fa-eye-slash" id="togglePassword_new" style="margin-left: 380px;cursor: pointer;top: -11px;position: absolute;margin-top: 24px;"></i>-->
						</div>
					</div>
					<div class="form-group frmgrp">
						<div class="col-sm-6 col-md-6 col-xs-12">
							<input type="password" class="form-control website-input"  placeholder="Enter Confirm New Password" required name="npassword" id="npassword">
						</div>
					</div>
				</div>		
				<div class="form-group">
					<div class="col-sm-12 col-md-12 col-xs-12">
						<button class="btn btn-default website-btn2 outline" type="submit">submit</button>
					</div>
				</div>
			</form>
		</div>
		<div class="dash-basic">
			<form class="form-horizontal" id="personalinfo" method="POST" action="<?php echo base_url(); ?>recruiter/accountstatus"  autocomplete='off'  enctype="multipart/form-data">		
				<div class="col-sm-12 col-md-12 col-xs-12">
					<div class="changepwd">
						<?php 
						if(@$jsonObj->userInfo[0]->is_online == 1)
						{
							$status = 0;
						?>
							<h3>Deactivate Your Account</h3>
						<?php 
						}
						if(@$jsonObj->userInfo[0]->is_online == 0)
						{
							$status = 1;
						?>
							<h3>Activate Your Account</h3>
						<?php
						}
						?>
					</div>
				</div>	
				<div class="form-group frmgrp">
					<div class="col-sm-6 col-md-6 col-xs-12">
						<input type="password" class="form-control website-input"  placeholder="Enter Password" value="" required  name="actpwd" id="actpwd" >
						<div class="oldMsg"></div>
					</div>
				</div>						
				<div class="form-group">
					<div class="col-sm-12 col-md-12 col-xs-12">
						<input type="hidden" value="<?php echo @$status; ?>" name="status" id="status" >
						<button class="btn btn-default website-btn2 outline" type="submit">submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo base_url() ?>includes/js/eyeicon.js"></script>