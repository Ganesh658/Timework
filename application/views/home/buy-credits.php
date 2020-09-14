<?php
$jsonObj=@json_decode($jsonObj);
$credits_amount = 0;
$credits_amount = @$jsonObj->userInfo[0]->credits_amount; 
?>
<style type="text/css">
	.touch1 li{list-style: none;float: left;margin-bottom: 1em;}
	.touch1 li a{border:none !important;}
	.credits-content a{margin-bottom: 0}
	thead tr:first-child {
	    background: #05AEE5;
	    color: #fff;
	    font-size: 18px;
	}
	tbody tr{    font-family: 'OpenSans-Bold';}
</style>
<div class="">
	<div class="just1 mbmrtp2">
		<div class="col-sm-3 col-md-3"></div>
		</div>
		<div class="col-sm-9 col-md-9 col-xs-12">
			<?php
			if(@$this->session->userdata("success") != '')
			{
			?>
				<div class="col-sm-8 col-md-8 col-xs-12" style="margin-top: 2em">
					<div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?php
						echo @$this->session->userdata("success");
						@$this->session->unset_userdata("success");
						?>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-xs-12" style="margin-top: 2em"></div>
			<?php
			}
			if(@$this->session->userdata("fail") != '')
			{
			?>
				<div class="col-sm-8 col-md-8 col-xs-12" style="margin-top: 2em">
					<div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?php
						echo @$this->session->userdata("fail");
						@$this->session->unset_userdata("fail");
						?>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-xs-12" style="margin-top: 2em"></div>
			<?php
			}
			?>
			<div class="row">
				<div class="col-sm-8 col-md-8 col-xs-12">
					<h4 class="question crqtn text-center">Credits Available : <span style="color: #05AEE5 !important;border-bottom: 1px solid #000;"><?php echo @$credits_amount; ?></span></h4>
					<h5 class="buy-crd text-center">Select Credit Package to Buy</h5>
				</div>
			</div>
			<div class="credits-content">
				<div class="row">
					<div class="col-sm-8 col-md-8 col-xs-12">
						<div class="table-responsive">
							<table class="table table-bordered">
							    <thead>
							      <tr>
							       	<th class="text-center">Cost</th>
							      	<th class="text-center">Credits</th>
							        <!-- <th class="text-center">Payable Amount</th> -->
							        <th class="text-center">Select</th>
							      </tr>
							    </thead>

							    <tbody>
									<?php 
									$creditAmounts = @$jsonObj->creditAmounts;
									if(@sizeOf($creditAmounts) > 0)
									{
										for ($c=0; $c < sizeOf($creditAmounts); $c++) 
										{
											$rowId = @str_replace("=","_",base64_encode(@$creditAmounts[$c]->id));
											$gstAmt = ((@$creditAmounts[$c]->credit_price*18)/100);
											$finalAmount = @$creditAmounts[$c]->credit_price+@$gstAmt;
									?>
										<tr>
											<td class="text-center">INR <?php echo @$creditAmounts[$c]->credit_price; ?></td>
											<td class="text-center"><?php echo @$creditAmounts[$c]->credits; ?></td>
											
											<!-- <td class="text-center">INR <?php echo @$finalAmount; ?></td> -->
											<td class="text-center">
												<a href="<?php echo base_url(); ?>checkout/<?php echo @$rowId; ?>" class='btn btn-success'>Click Here To Pay</a>
											</td>
										</tr>
									<?php 
										}
									}
									?>
							    </tbody>
							</table>
						</div>
						<div class="timework-desc buydesc text-center">
							<!--<p>* 18% GST Applied On Cost</p>-->
							<p>* There is no expiry date for credits.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>