<?php
$jsonObj=@json_decode($jsonObj);
$credits_amount = 0;
$referral_code = @$jsonObj->userInfo[0]->referral_code; 
$credits_amount = @$jsonObj->userInfo[0]->credits_amount; 
$email = @$jsonObj->userInfo[0]->email; 
$emailId = @str_replace("=","_",base64_encode(@$email));
?>
<style type="text/css">
	.touch1 li{list-style: none;float: left;margin-bottom: 1em;}
	.touch1 li a{border:none !important;}
</style>
<div class="">
	<div class="just1 mbmrtp2">
		<div class="col-sm-1 col-md-1 col-xs-12">
		</div>
		<div class="col-sm-10 col-md-10 col-xs-12">
			<?php
			if(@$this->session->userdata("success") != '')
			{
			?>
				<div class="col-sm-12 col-md-12 col-xs-12" style="margin-top: 2em">
					<div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?php
						echo @$this->session->userdata("success");
						@$this->session->unset_userdata("success");
						?>
                    </div>
                </div>
			<?php
			}
			if(@$this->session->userdata("fail") != '')
			{
			?>
				<div class="col-sm-12 col-md-12 col-xs-12" style="margin-top: 2em">
					<div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?php
						echo @$this->session->userdata("fail");
						@$this->session->unset_userdata("fail");
						?>
                    </div>
                </div>
			<?php
			}
			?>
			<h4 class="question">Credits Available : <span style="color: #05AEE5 !important;border-bottom: 1px solid #000;"><?php echo @$credits_amount; ?></span></h4>
			<div class="credits-content">
				<?php
				if(@$this->session->userdata("is_logged_in") !='')
				{
				?>
					<a href="<?php echo base_url(); ?>buy-credits" class="btn btn-default message-sub bycrd">Buy Credits</a>
				<?php 
				}
				else
				{
				?>
					<a href="<?php echo base_url(); ?>login" class="btn btn-default message-sub bycrd">Buy Credits</a>
				<?php
				}
				?>
				<h4>Invite and Earn Credits</h4>
				<p>Invite Your Friends to timework. You can earn 100 credits for each friend and<br> your each friend gets 200 credits on registration</p>
				<p class="ref-code">Your Referral Code : <?php echo @$referral_code; ?></p>
				<p class="share-code"><a>Share Your Referral Code</a></p>
				<div class="refferal-email">
					<form class="form-horizontal contact-form" autocomplete="off" name="contactForm" id="contactForm" method="POST" action="<?php echo base_url(); ?>home/sharereffalCode">
						<div class="form-group">
							<div class="col-sm-3 col-md-3 col-xs-12">
								<p>Your Friend Email Id</p>
							</div>
							<div class="col-sm-6 col-md-6 col-xs-12">
								<input type="email" class="form-control message" id="user_email" name="user_email" placeholder="Email Address" autocomplete="off">
							</div>
							<div class="col-sm-3 col-md-3 col-xs-12">
								<button type="submit" class="btn btn-default message-sub crmb">Share</button>
							</div>
						</div>		
					</form>

				</div>
				<p class="text-center">(OR)</p>
				<div class="refferal-share">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-xs-12">
							<div class="form-group">
								<p>Share Refferal Code Through Following Social Media : </p>
							</div>
							<div class="foot1">
								<ul class="touch1">
									<li class="">
										<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url();?>registration-process/<?php echo @$referral_code; ?>/<?php echo @$emailId; ?>" target="_blank">
											<img src="<?php echo base_url(); ?>includes/images/s_facebook.png" class="img-responsive" alt="img123">
										</a>
									</li>
									<li class="">
										<a href="https://www.linkedin.com/cws/share?url=<?php echo base_url();?>registration-process/<?php echo @$referral_code; ?>/<?php echo @$emailId; ?>" target="_blank">
											<img src="<?php echo base_url(); ?>includes/images/s_linkedin.png" class="img-responsive" alt="img167">
										</a>
									</li>
									<li class=""> 
										<a href="http://twitter.com/share?text=An%20Awesome%20Link&url=<?php echo base_url();?>registration-process/<?php echo @$referral_code; ?>/<?php echo @$emailId; ?>" target="_blank">
											<img src="<?php echo base_url(); ?>includes/images/s_twitter.png" class="img-responsive" alt="img167">
										</a>
									</li>
									<li class=""> 
										<a target="_blank" href="https://wa.me/918019811981?text=<?php echo base_url();?>registration-process/<?php echo @$referral_code; ?>/<?php echo @$emailId; ?>" title="Contact Owner" class="float">
											<img class="img-responsive" src="<?php echo base_url(); ?>includes/images/s_whatsapp.png" class="img-responsive" alt="img167">
										</a>
									</li>
									
								</ul>
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
