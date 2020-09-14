<?php
$jsonObj=@json_decode($jsonObj);
?>
<style type="text/css">
</style>
<div class="just1">
	<div class="col-sm-12 col-md-12 col-xs-12 mb-2p">		
			<div class="col-sm-1 col-md-1 col-xs-12">
			</div>
			<div class="col-sm-10 col-md-10 col-xs-12">
				<div class="login1">
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
					?>	
					<div class="row">
						<div class="col-sm-3 col-md-3 col-xs-12"></div>
						<div class="col-sm-6 col-md-6 col-xs-12">
							<h4>login to your account using your email</h4>
						</div>
						<div class="col-sm-3 col-md-3 col-xs-12"></div>
					</div>
 					<!-- <div class="row">
 						<div class="col-sm-4 col-md-4 col-xs-12"></div>
						<div class="col-sm-8 col-md-8 col-xs-12">	
							<ul class="nav nav-pills login-ul">
								<li role="presentation" >
									<a href="#joblogin" data-toggle="tab" class="active loginul loginul_3" id="3">Candidate Login </a>
								</li>
								<li role="presentation">
									<a href="#joblogin" data-toggle="tab" class="loginul loginul_5" id="5">Recruiter Login </a>
								</li>
								
							</ul>	
						</div>									
					</div>
					<input type='hidden' id='regUrl' value='3'> -->
					<div class="tab-content">			
						<div class="tab-pane fade in active" id="joblogin">
							<div class="row">
								<div class="col-sm-3 col-md-3 col-xs-12"></div>
								<div class="col-sm-6 col-md-6 col-xs-12">
									<div class="login2 submission">
										<h5>Login into <span>TIMEWORK</span></h5>	
										<form class="form-horizontal" name="j_login" id="j_login" method="POST" action="<?php echo base_url(); ?>login/loginCheck" autocomplete='off'>
											<div class="media firscld">						
												<div class="media-body">
													<h4 class="media-heading">
														<input type="text" class="form-control forgetten" name="loginemail" id="loginemail" placeholder="Email Address" autocomplete='off'>
													</h4>
												</div>
												<div class="media-left">
													<a href="#">
														<img src="<?php echo base_url(); ?>includes/img/mailbox.png" class="img-responsive login-mail" alt="img-3">
													</a>
												</div>
											</div>
											<div class="media firscld">						
												<div class="media-body">
													<h4 class="media-heading">
														<input type="password" class="form-control forgetten" name="loginpassword" id="loginpassword" placeholder="Password" autocomplete='off'>
													</h4>
												</div>
												<div class="media-left">
													<a href="#0">
														<img src="<?php echo base_url(); ?>includes/img/password_show.png" class="img-responsive login-mail1 pwdicon pwdshow" alt="img-3">
														<img src="<?php echo base_url(); ?>includes/img/password_hide.png" class="img-responsive login-mail1 pwdicon pwdhide" alt="img-3" style='display: none'>
													</a>
												</div>
											</div>
											<div class="form-group mt-3p mb text-center">
												<div class="">
													<div class="col-sm-7 col-md-7 col-xs-12 regspan">
														<span>Don't have an account?&nbsp;</span>
														<a href="<?php echo base_url(); ?>registration-process"><u>Register</u></a>
													</div>
													<div class="col-sm-5 col-md-5 col-xs-12">
														<a href="<?php echo base_url(); ?>forgot-password"><u>Forgot Password?</u></a>
													</div>	
												</div>
											</div>
											<div class="form-group mb text-center">
												<div class="col-sm-12">
													<button type="submit" class="btn btn-default login-btn3" role="submit" id='loginbtn'>Login</button>	
												</div>
												
											</div>
										</form>
									 </div>
								 </div>
							</div>						
						</div>	
					</div>	
				</div>
				<div class="col-sm-1 col-md-1 col-xs-12">
				</div>			
			</div>	
		</div>			
	</div>
