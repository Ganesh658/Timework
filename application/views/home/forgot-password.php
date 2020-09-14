<?php
$jsonObj=@json_decode($jsonObj);
?>
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
					<div class="row">
						<div class="col-sm-3 col-md-3 col-xs-12"></div>
						<div class="col-sm-6 col-md-6 col-xs-12">
							<div class="alert alert-success alert-dismissable">
	                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                            <?php
								echo @$this->session->userdata("logsuccess");
								@$this->session->unset_userdata("logsuccess");
								?>
	                        </div>
	                    </div>
	                    <div class="col-sm-3 col-md-3 col-xs-12"></div>
	                </div>
				<?php
				}
				if(@$this->session->userdata("regfail") != '')
				{
				?>
					<div class="row">
						<div class="col-sm-3 col-md-3 col-xs-12"></div>
						<div class="col-sm-6 col-md-6 col-xs-12">
							<div class="alert alert-danger alert-dismissable">
	                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	                            <?php
								echo @$this->session->userdata("regfail");
								@$this->session->unset_userdata("regfail");
								?>
	                        </div>
                       	</div>
                       	<div class="col-sm-3 col-md-3 col-xs-12"></div>
	                </div>
				<?php
				}
				?>	
				<h4 style="text-align: center;">Forgot Password</h4>
				<div class="tab-content">			
					<div class="tab-pane active" id="tab111">
						<div class="row">
							<div class="col-sm-3 col-md-3 col-xs-12"></div>
							<div class="col-sm-6 col-md-6 col-xs-12">
								<div class="login2 submission" style="min-height: 0">
									<form class="form-horizontal" name="forgotpwd" id="forgotpwd" method="POST" action="<?php echo base_url(); ?>login/forgotPassword" autocomplete='off'>
										<div class="media firscld">						
											<div class="media-body">
												<h4 class="media-heading">
													<input type="email" class="form-control forgetten" name="forgotemail" id="forgotemail" placeholder="Email Address" autocomplete='off'>
												</h4>
											</div>
											<span for="forgotemail" class="help-inline"></span>
											
										</div>
										
										<div class="form-group mt-3p">
											<div class="col-sm-5 col-xs-4">
												<button type="submit" class="btn btn-default login-btn3 frgbtn" role="submit">Submit</button>	
											</div>
											<div class="col-sm-7  col-xs-8">
												<a href="<?php echo base_url(); ?>login" class="btn btn-default login-btn3 frgbtn" style='text-decoration: none;background-color: #05aee5 !important;border: 1px solid #05aee5;'>Login To Your Account</a>
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
