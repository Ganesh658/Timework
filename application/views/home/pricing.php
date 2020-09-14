<?php
$jsonObj=@json_decode($jsonObj);
?>
<style type="text/css">
.account1 .table {
    width: 50%;
    max-width: 100%;
    margin-bottom: 20px;
}
.just1 ul li,.just1 ul li span{font-size: 17px !important;color: #000;}
tr:first-child{    background: #05AEE5;
    color: #fff;
    font-size: 18px;
}
</style>
<div class="just1">
	<div class="col-sm-12 col-md-12 col-xs-12 mb-2p">
		<div class="reg-process">
			<div class="row">
				<div class="col-sm-3 col-md-3"></div>
				<div class="col-sm-6 col-md-6 col-xs-12">
					<h2>Pricing</h2>
				</div>
				<div class="col-sm-3 col-md-3"></div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-md-3"></div>
				<div class="col-sm-6 col-md-6 col-xs-12">
					<?php 
					if(@sizeOf($jsonObj->cmsInfo) > 0)
					{
						for ($i=0; $i <sizeOf($jsonObj->cmsInfo) ; $i++) 
						{

					?>
						<div class="timework-desc">
							<?php 
							if( @$jsonObj->cmsInfo[$i]->cms_title != '')
							{
							?>
								<h5><u><?php echo @$jsonObj->cmsInfo[$i]->cms_title; ?></u></h5>
							<?php 
							}
							?>
							<?php echo @$jsonObj->cmsInfo[$i]->long_desc; ?>
						</div>
					<?php 
						}
					}
					?>
				</div>
				<div class="col-sm-3 col-md-3"></div>
			</div>
			<div class="row">
			<div class="col-sm-3 col-md-3 col-xs-12"></div>
			<div class="col-sm-9 col-md-9 col-xs-12">
				<?php
				if(@$this->session->userdata("is_logged_in") !='')
				{
				?>
					<a href="<?php echo base_url(); ?>buy-credits" class="btn btn-default message-sub" style="margin: 2em 0;">Buy Credits</a>
				<?php 
				}
				else
				{
				?>
					<a href="<?php echo base_url(); ?>login" class="btn btn-default message-sub" style="margin: 2em 0;">Buy Credits</a>
				<?php
				}
				?>
			</div>
		</div>
		</div>
	</div>
</div>
