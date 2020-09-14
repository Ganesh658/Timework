<?php
$jsonObj=@json_decode($jsonObj);
?>
<style type="text/css">
	.just1 li a {
    color: #ffffff !important;}
</style>
<div class="just1 mbmrtp">
	<div class="col-sm-12 col-md-12 col-xs-12 mb-2p">
		<div class="leave-row">
			<?php
			if(@$this->session->userdata("success") != '')
			{
			?>
				<div class="col-sm-12 col-md-12 col-xs-12">
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
				<div class="col-sm-12 col-md-12 col-xs-12">
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
			<div class="col-sm-2 col-md-2 col-xs-12"></div>			
			<div class="col-sm-8 col-md-8 col-xs-12">				
				<div class="leave">
					<h4>leave a message</h4>
					<form class="form-horizontal contact-form" autocomplete="off" name="contactForm" id="contactForm" method="POST" action="<?php echo base_url(); ?>home/saveContactInfo">
						<div class="col-sm-12">							
							<div class="form-group">
								<div class="col-sm-6 col-md-6 col-xs-12">
									<input type="text" class="form-control message" id="user_name" name="user_name" placeholder="Your name"  autocomplete="off">
								</div>
								<div class="col-sm-6 col-md-6 col-xs-12">
									<input type="email" class="form-control message" id="user_email" name="user_email" placeholder="Email Address"  autocomplete="off">
								</div>
								
							</div>							
						</div>
						<div class="col-sm-12">							
							<div class="form-group">
								<div class="col-sm-6 col-md-6 col-xs-12">
									<input type="text" class="form-control message" id="user_phone" name="user_phone" placeholder="Phone"  autocomplete="off">
								</div>
								<div class="col-sm-6 col-md-6 col-xs-12">
									<input type="text" class="form-control message" id="user_subject" name="user_subject" placeholder="Subject"  autocomplete="off">
								</div>
							</div>							
						</div>
						<div class="col-sm-12">							
							<div class="form-group">
								<div class="col-sm-12 col-md-12 col-xs-12">
									<textarea class="form-control message message1" id="user_msg" name="user_msg" rows="5" placeholder="Message"  autocomplete="off"></textarea>
								</div>
							</div>							
						</div>
						<div class="row">	
							<div class="form-group">
								<div class="col-sm-1 col-md-1 col-xs-2">
								</div>
								<div class="col-sm-10 col-md-10 col-xs-8">					
								<button type="submit" class="btn btn-default message-sub" style="margin-bottom: 0">Submit Message</button>
								</div>
								<div class="col-sm-1 col-md-1 col-xs-2">
								</div>
							</div>
						</div>
					</form>
				</div>
				
			</div>
			<!-- <div class="col-sm-6 col-md-6 col-xs-12">	
				<?php
				if(@sizeOf($jsonObj->totaladdress) > 0)
				{
				?>
					<div class="leave1">
						<?php 
						for ($c=0; $c < sizeOf($jsonObj->totaladdress); $c++) 
						{
							if($c%2 == 0)
							{
								$usa = '';
							}
							else
							{
								$usa = 'usa';
							}
						?>
							<h3 class="h-blue <?php echo @$usa; ?>">
							contact information
							</h3>
							<ul>
								<?php 
								if(@$jsonObj->totaladdress[$c]->company_address != '')
								{ 
								?>
									<li class="session33"><a href="#" class="web"><span>Address:</span>
										<?php echo @$jsonObj->totaladdress[$c]->company_address; ?></a>
									</li>
								<?php 
								}
								if(@$jsonObj->totaladdress[$c]->company_phone != '')
								{
								?>
									<li class="session44"><a href="tel:<?php echo @$jsonObj->totaladdress[$c]->company_phone; ?>" class="web"><span>Phone:</span><?php echo @$jsonObj->totaladdress[$c]->company_phone; ?></a> </li>
								<?php 
								}
								if(@$jsonObj->totaladdress[$c]->company_email != '')
								{
								?>
									<li class="session55"><a href="mailto:<?php echo @$jsonObj->totaladdress[$c]->company_email; ?>" class="web"><span>Email:</span><?php echo @$jsonObj->totaladdress[$c]->company_email; ?></a></li>
								<?php 
								}
								?>	
							</ul>
							<?php 
							if($c%2 == 0)
							{
							?>
							<hr class="skills-hr usa-hr">
						<?php 
							}
						}
						?>
					</div>
				<?php
				}
				?>
			</div> -->
		</div>
	</div>
</div>
