<?php
$jsonObj=@json_decode($jsonObj);
?>
<style type="text/css">
.account-active{margin: 0 auto 20px;}
select{    color: #9a9a9a !important;}
</style>
<div class="just1 mbmrtp">
	<div class="col-sm-12 col-md-12 col-xs-12 mb-2p">
		<div class="row">
		<div class="col-sm-1 col-md-2 col-xs-1">
		</div>
		<div class="col-sm-10 col-md-8 col-xs-10">
			<div class="row">
				<div class="account1">
					<h4>create your account using your email</h4>
				</div>	
				<div class="col-sm-12 col-md-12 col-xs-12">
					<div class="account1" style="text-align: center;">	
						<?php
						if(@$this->session->userdata("logsuccess") != '')
						{
						?>
							<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?php
								echo @$this->session->userdata("logsuccess");
								@$this->session->unset_userdata("logsuccess");
								?>
                            </div>
						<?php
						}
						if(@$this->session->userdata("regfail") != '')
						{
						?>
							<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?php
								echo @$this->session->userdata("regfail");
								@$this->session->unset_userdata("regfail");
								?>
                            </div>
						<?php
						}
						if(@$jsonObj->rcType == 5)
						{
							$regType3 = 'display:none';
							$regType5 = 'display:block';
						}
						else
						{
							$regType3 = 'display:block';
							$regType5 = 'display:none';
						}
						?>
						<button class="btn btn-default regType  account-active outline" type="button" onclick="regType('3')"  id="3" style="<?php echo @$regType3; ?>">Candidate Registration</button>
						<button class="btn btn-default regType account-active outline" type="button" onclick="regType('5')"  id="5" style="<?php echo @$regType5; ?>">Recruiter Registration</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-1 col-md-2 col-xs-1">
		</div>		
	</div>	
	<!--Candidate Registration Starts -->
	
		<div class="jobreg" id="job_3" style="<?php echo @$regType3; ?>">
			<form class="form-horizontal" id='jobseekarregister' name="jobseekarregister" method="POST" autocomplete="off" action="<?php echo base_url(); ?>login/saveJobSeekerInfo" enctype="multipart/form-data">
				<div class="row" >
					<div class="col-sm-2 col-md-3 col-xs-1">
					</div>
					<div class="col-sm-10 col-md-6 col-xs-10">					
						<div class="row">
							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Name </label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control account-input" id="js_name" placeholder="Enter Your Name" name="js_name" autocomplete="off" required>
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Mobile Number </label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control account-input" id="js_mobile" placeholder="Enter Mobile Number" name="js_mobile" autocomplete="off" required onblur="checkMobile()">
							      <div class="mobileMsg"></div>
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Email Id </label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control account-input" id="js_email" placeholder="Enter Email Address" name="js_email" autocomplete="off" required onblur="checkEmail()">
							      <div class="emailMsg"></div>
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Password </label>
							    <div class="col-sm-8">
							      <input type="password" class="form-control account-input" id="js_password" placeholder="Enter Password" name="js_password" autocomplete="off" required >
							      <img src="<?php echo base_url(); ?>includes/img/password_show.png" class="img-responsive student-pwd student-pwd-hide" alt="img-3">
							      <img src="<?php echo base_url(); ?>includes/img/password_hide.png" class="img-responsive student-pwd student-pwd-show" alt="img-3" style='display: none;'>
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Confirm Password </label>
							    <div class="col-sm-8">
							      <input type="password" class="form-control account-input" id="js_cnfrmpassword" placeholder="Enter Password Again" name="js_cnfrmpassword" autocomplete="off" required >
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Referral Code </label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control account-input" id="js_referralcode" placeholder="Enter Referral Code" name="js_referralcode" autocomplete="off" value="<?php echo @$this->session->userdata("referralCode"); ?>">
							    </div>
							</div>
							<div class="form-group mbtext-center">
							    <label class="control-label col-sm-4" for="email"></label>
							    <div class="col-sm-4">
							    	<button class="btn btn-default advertisers-btn1 outline" type="submit">Register Now</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-1 col-md-3 col-xs-1"></div>
				</div>
			</form>
		</div>
	<!--Jobseeker Registration Ends -->
	<!--Recruiter Registration Starts -->
		<div class="jobreg" id="job_5" style="<?php echo @$regType5; ?>">
			<form class="form-horizontal" id='vendorregister' name="vendorregister" method="POST" autocomplete="off" action="<?php echo base_url(); ?>login/saveVendorInfo" enctype="multipart/form-data">
				<div class="row" >
					<div class="col-sm-2 col-md-3 col-xs-1">
					</div>
					<div class="col-sm-10 col-md-6 col-xs-10">					
						<div class="row">
							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Name </label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control account-input" id="v_name" placeholder="Enter Your Name" name="v_name" autocomplete="off" required>
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Mobile Number </label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control account-input" id="v_mobile" placeholder="Enter Mobile Number" name="v_mobile" autocomplete="off" required onblur="checkVendorMobile()">
							      <div class="vmobileMsg"></div>
							    </div>
							</div>
							<div class="form-group">
								 <label class="control-label col-sm-3" for="email">You Are</label>
								 <div class="col-sm-8">
									<select class="form-control account-input" id="rec_type" name="rec_type" autocomplete="off" required>
										<option value="">Select You Are</option>
										<option value="1">Human Resource</option>
										<option value="2">Manager</option>
										<option value="3">Business Owner</option>
									</select>
								</div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Business Name </label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control account-input" id="v_businessname" placeholder="Enter Your Business Name" name="v_businessname" autocomplete="off" required>
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Business Address </label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control account-input" id="v_address" placeholder="Enter Your Business Address" name="v_address" autocomplete="off" required>
							    </div>
							</div>
							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">State/UN</label>
							    <div class="col-sm-8">
									<select class="form-control account-input" id="v_state" name="v_state" autocomplete="off" required>
										<option value="">Select State/UN</option>
										<?php 
										$states = $jsonObj->states;
										if(sizeOf($states) > 0)
										{
											for ($s=0; $s < sizeOf($states); $s++) 
											{
										?>
											<option value="<?php echo $states[$s]->id; ?>"><?php echo $states[$s]->state_name; ?></option>
										<?php 
											}
										}
										?>
									</select> 
							    </div>
							</div>
							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">City</label>
							    <div class="col-sm-8">
									<select class="form-control account-input" id="v_city" name="v_city" autocomplete="off" required>
										<option value="">Select City</option>
									</select> 
							    </div>
							</div>
							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Area</label>
							    <div class="col-sm-8">
									<input type="text" class="form-control account-input" id="v_area" placeholder="Enter Area" name="v_area" autocomplete="off" required >
							    </div>
							</div>
							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Pincode</label>
							    <div class="col-sm-8">
									<input type="text" class="form-control account-input" id="v_zipcode" placeholder="Enter Pincode" name="v_zipcode" autocomplete="off" required >
							    </div>
							</div>
							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Email Id </label>
							    <div class="col-sm-8">
							    	<input type="text" class="form-control account-input" id="v_email" placeholder="Enter Email Address" name="v_email" autocomplete="off" required onblur="checkVendorEmail()">
							    	<div class="vemailMsg"></div>
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Password </label>
							    <div class="col-sm-8">
							     	<input type="password" class="form-control account-input" id="v_password" placeholder="Enter Password" name="v_password" autocomplete="off" required >
							     	<img src="<?php echo base_url(); ?>includes/img/password_show.png" class="img-responsive student-pwd rec-pwd-hide" alt="img-3">
							     	<img src="<?php echo base_url(); ?>includes/img/password_hide.png" class="img-responsive student-pwd rec-pwd-show" alt="img-3" style='display: none;'>
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Confirm Password </label>
							    <div class="col-sm-8">
							     	<input type="password" class="form-control account-input" id="v_cnfrmpassword" placeholder="Enter Password Again" name="v_cnfrmpassword" autocomplete="off" required >
							    </div>
							</div>
							<div class="form-group">
							    <label class="control-label col-sm-3" for="email">Referral Code </label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control account-input" id="v_referralcode" placeholder="Enter Referral Code" name="v_referralcode" autocomplete="off" value="<?php echo @$this->session->userdata("referralCode"); ?>">
							    </div>
							</div>
							<div class="form-group mbtext-center">
							    <label class="control-label col-sm-4" for="email"></label>
							    <div class="col-sm-4">
							    	<button class="btn btn-default advertisers-btn1 outline" type="submit">Register Now</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-1 col-md-3 col-xs-1">
					</div>
				</div>
			</form>
		</div>
	<!--Recruiter Registration Ends -->
	</div>
</div>
