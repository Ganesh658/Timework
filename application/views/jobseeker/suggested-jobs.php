<?php
$jsonObj=@json_decode($jsonObj);
$results = @$jsonObj->results;
$mrbtm = '';
if(@sizeOf($results) == 0)
{
	$mrbtm = 'margin-bottom: 20%';
}
if(@sizeOf($results) == 1)
{
	$mrbtm = 'margin-bottom: 20%';
}
if(@sizeOf($results) == 2)
{
	$mrbtm = 'margin-bottom: 20%';
}
?>
<style type="text/css">
.keyskill li{padding: 5px 20px;background-color: #05AEE5}
	.keyskill{    margin-left: -3em;margin-bottom: 5em;}
	#jobdetails{margin-top: 0}
	.bs-example .panel-heading {padding: 10px 15px 10px 0;}
	.bs-example .panel-heading a{text-decoration: none !important;}
	.del-exp h4 {font-size: 13px !important;}
	.gobtn{margin: 4px 0 0 0;}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard.css">
<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard-responsive.css">
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<div class="just1 ">
	<div class="col-sm-12 mt-2  hidden-sm hidden-md hidden-lg" style="<?php echo $mrbtm; ?>" >
		
		<div class="panel-group hidden-sm hidden-lg hidden-md" id="mobaccordion">
			<div class="sidenav " id="mySidenav">
				<a href="javascript:void(0)" class="closebtn open-cls" onclick="closeNavs()">&times;</a>
				<div class="row space_1">
					<div class="panel-group pnlgrp" >
						<?php 
						$statesInfo = @$jsonObj->statesInfo;
						if(@sizeOf($statesInfo) > 0)
						{
						?>
							<div class="panel panel-default">
								<div class="prod-pan mrt-2p acrdn">
									<a data-toggle="collapse" data-parent="#mobaccordion" href="#mobcollapseOne" class="collapsed" aria-expanded="false">
										<div class="prodt-head" role="tab" id="mobcourseOne">
											<div class="panel-heading">
												<h4 class="panel-title prodt-title">
													 States
												</h4>
											</div>
										</div>
									</a> 
									<div id="mobcollapseOne" class="panel-collapse collapse">
										<div class="pan-body all-location">
											<div class="row">
												<div class="col-sm-12 col-md-12 col-xs-12">
													<?php 
													for ($q=0; $q < sizeOf($statesInfo); $q++) 
													{ 
														$stateCkd = '';
														if(@$statesInfo[$q]->id == @$jsonObj->state_id)
														{
															$stateCkd = 'checked';
														}
													?>
														<div class="checkbox-inner rdbtn">
							                                <label class="chkcontainer rdio">
																<input type="radio" value="<?php echo @$statesInfo[$q]->id; ?>" class="filter_products" name="statesType" data-id='2'  <?php echo @$stateCkd; ?>><?php echo @$statesInfo[$q]->state_name; ?>
																<span class="chkbox"></span>
															</label>
							                            </div>
													<?php 
													}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php 
						}
						$citiesInfo = @$jsonObj->citiesInfo;
						$cityShow = 'display:none;';
						if(@sizeOf($citiesInfo) > 0)
						{
							$cityShow = 'display:block;';
						}
						?>
						<div class="panel panel-default" id='cityInfo' style="<?php echo @$cityShow; ?>">
							<div class="prod-pan mrt-2p acrdn" >
								<a data-toggle="collapse" data-parent="#mobaccordion" href="#mobcollapseTwo">
									<div class="prodt-head" role="tab" id="courseOne">
										<div class="panel-heading">
											<h4 class="panel-title prodt-title">
												Cities
											</h4>
										</div>
									</div>
								</a>
								<div id="mobcollapseTwo" class="panel-collapse collapse">
									<div class="pan-body all-location">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-xs-12" id="city-info">
												<?php 
												for ($l=0; $l < sizeOf($citiesInfo); $l++) 
												{ 
													$cityCkd = '';
													if(@$citiesInfo[$l]->id == @$jsonObj->city_id)
													{
														$cityCkd = 'checked';
													}
												?>
													<div class="checkbox-inner rdbtn">
						                                <label class="chkcontainer">
															<input type="checkbox" value="<?php echo @$citiesInfo[$l]->id; ?>" class="filterproducts" name="cityType" <?php echo @$cityCkd; ?>><?php echo @$citiesInfo[$l]->city_name; ?>
															<span class="chkbox"></span>
														</label>
						                            </div>
												<?php 
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="prod-pan mrt-2p acrdn">
								<a data-toggle="collapse" data-parent="#mobaccordion" href="#mobcollapseSix" class="collapsed" aria-expanded="false">
									<div class="prodt-head" role="tab" id="courseFour">
										<div class="panel-heading">
							                <h4 class="panel-title  prodt-title">
							                    Salary Type
							                </h4>
							            </div>
									</div>
								</a>
								<div id="mobcollapseSix" class="panel-collapse collapse">
									<div class="pan-body all-location">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-xs-12">
												<div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer rdio">
														<input type="radio" value="1" class="filterproducts" name="salarytype">Hourly
														<span class="chkbox"></span>
													</label>
					                            </div>
					                            <div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer rdio">
														<input type="radio" value="2" class="filterproducts" name="salarytype">Daily
														<span class="chkbox"></span>
													</label>
					                            </div>
					                            <div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer rdio">
														<input type="radio" value="3" class="filterproducts" name="salarytype">Weekly
														<span class="chkbox"></span>
													</label>
					                            </div>
					                            <div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer rdio">
														<input type="radio" value="4" class="filterproducts" name="salarytype">Monthly
														<span class="chkbox"></span>
													</label>
					                            </div>
					                            <div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer rdio">
														<input type="radio" value="5" class="filterproducts" name="salarytype">Yearly
														<span class="chkbox"></span>
													</label>
					                            </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="prod-pan mrt-2p acrdn">
								<a data-toggle="collapse" data-parent="#mobaccordion" href="#mobcollapseFive"  class="collapsed" aria-expanded="false">
									<div class="prodt-head" role="tab" id="courseFour">
										<div class="panel-heading">
							                <h4 class="panel-title  prodt-title">
							                     Salary
							                </h4>
							            </div>
									</div>
								</a>
								<div id="mobcollapseFive" class="panel-collapse collapse">
									<div class="pan-body all-location">
										<div class="row">
											<div class="col-sm-8 col-md-8 col-xs-8">
												<input type="text" class="form-control" name="salaryrangeInfo" placeholder="Ex:5000" id="salaryrangeInfo">
											</div>
											<div class="col-sm-4 col-md-4 col-xs-4">
												<button name="button" type="button" class="gobtn filterproducts">GO</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php 
						$empInfo = @$jsonObj->empInfo;
						if(@sizeOf($empInfo) > 0)
						{
						?>
							<div class="panel panel-default">
								<div class="prod-pan mrt-2p acrdn">
									<a data-toggle="collapse" data-parent="#mobaccordion" href="#mobcollapseThree" class="collapsed" aria-expanded="false">
										<div class="prodt-head" role="tab" id="courseOne">
											<div class="panel-heading">
												<h4 class="panel-title prodt-title">
													Employment Type 
												</h4>
											</div>
										</div>
									</a>
									<div id="mobcollapseThree" class="panel-collapse collapse">
										<div class="pan-body all-location">
											<div class="row">
												<div class="col-sm-12 col-md-12 col-xs-12">
													<?php 
													for ($e=0; $e < sizeOf($empInfo); $e++) 
													{ 
														$empseltd = '';
														if(@strtolower($empInfo[$e]->cat_name) == @strtolower($jsonObj->skillnames))
														{
															$empseltd = 'checked';
														}
													?>
														<div class="checkbox-inner rdbtn">
							                                <label class="chkcontainer">
																<input type="checkbox" value="<?php echo @$empInfo[$e]->cat_name; ?>" class="filterproducts" name="employmentType" <?php echo @$empseltd; ?>><?php echo @$empInfo[$e]->cat_name; ?>
																<span class="chkbox"></span>
															</label>
							                            </div>
													<?php 
													}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php 
						}
						$experienceInfo = @$jsonObj->experienceInfo;
						if(@sizeOf($experienceInfo) > 0)
						{
						?>
							<div class="panel panel-default">
								<div class="prod-pan mrt-2p acrdn">
									<a data-toggle="collapse" data-parent="#mobaccordion" href="#mobcollapseFour" class="collapsed" aria-expanded="false">
										<div class="prodt-head" role="tab" id="courseTwo">
											<div class="panel-heading">
								                <h4 class="panel-title  prodt-title">
								                    Experience
								                </h4>
								            </div>
										</div>
									</a>
									<div id="mobcollapseFour" class="panel-collapse collapse">
										<div class="pan-body all-location">
											<div class="row">
												<div class="col-sm-12 col-md-12 col-xs-12">
													<?php 
													for ($r=0; $r < sizeOf($experienceInfo); $r++) 
													{ 
													?>
														<div class="checkbox-inner rdbtn">
							                                <label class="chkcontainer">
																<input type="checkbox" value="<?php echo @$experienceInfo[$r]->id; ?>" class="filterproducts" name="experienceinfo"><?php echo @$experienceInfo[$r]->cat_name; ?>
																<span class="chkbox"></span>
															</label>
							                            </div>
													<?php 
													}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php 
						}
						
						?>
						<div class="panel panel-default">
							<div class="prod-pan mrt-2p acrdn">
								<a data-toggle="collapse" data-parent="#mobaccordion" href="#mobcollapseFives"  class="collapsed" aria-expanded="false">
									<div class="prodt-head" role="tab" id="courseFours">
										<div class="panel-heading">
							                <h4 class="panel-title  prodt-title">
							                     Joining Type
							                </h4>
							            </div>
									</div>
								</a>
								<div id="mobcollapseFives" class="panel-collapse collapse">
									<div class="pan-body all-location">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-xs-12">
												
												<div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer">
														<input type="checkbox" value="1" class="filterproducts" name="joiningtype">Immediate
														<span class="chkbox"></span>
													</label>
					                            </div>
												<div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer">
														<input type="checkbox" value="2" class="filterproducts" name="joiningtype">Within This Week
														<span class="chkbox"></span>
													</label>
					                            </div>
					                            <div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer">
														<input type="checkbox" value="3" class="filterproducts" name="joiningtype">Next Week
														<span class="chkbox"></span>
													</label>
					                            </div>
					                            <div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer">
														<input type="checkbox" value="4" class="filterproducts" name="joiningtype">1st Of Next Month
														<span class="chkbox"></span>
													</label>
					                            </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="prod-pan mrt-2p acrdn">
								<a data-toggle="collapse" data-parent="#mobaccordion" href="#mobcollapseSeven" class="collapsed" aria-expanded="false">
									<div class="prodt-head" role="tab" id="courseFive">
										<div class="panel-heading">
							                <h4 class="panel-title  prodt-title">
							                    Job Freshness
							                </h4>
							            </div>
									</div>
								</a>
								<div id="mobcollapseSeven" class="panel-collapse collapse">
									<div class="pan-body all-location">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-xs-12">
												<div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer">
														<input type="checkbox" value="1" class="filterproducts" name="jobfressness">< 3 Days Old
														<span class="chkbox"></span>
													</label>
					                            </div>
					                            <div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer">
														<input type="checkbox" value="2" class="filterproducts" name="jobfressness">< 7 Days Old
														<span class="chkbox"></span>
													</label>
					                            </div>
					                            <div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer">
														<input type="checkbox" value="3" class="filterproducts" name="jobfressness">< 15 Days Old
														<span class="chkbox"></span>
													</label>
					                            </div>
					                            <div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer">
														<input type="checkbox" value="4" class="filterproducts" name="jobfressness">> 15 Days Old
														<span class="chkbox"></span>
													</label>
					                            </div>
					                           
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	
	</div>
	<div class="col-sm-3 col-md-3 mt-2  hidden-xs" style="<?php echo $mrbtm; ?>" >
		<div class="filters filtercss">
			<div class="bs-example">

    			<div class="panel-group" id="accordion">
					<?php 
					$statesInfo = @$jsonObj->statesInfo;
					if(@sizeOf($statesInfo) > 0)
					{
					?>
						<div class="panel panel-default">
							<div class="prod-pan mrt-2p acrdn">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false">
									<div class="prodt-head" role="tab" id="courseOne">
										<div class="panel-heading">
											<h4 class="panel-title prodt-title">
												 States
											</h4>
										</div>
									</div>
								</a> 
								<div id="collapseOne" class="panel-collapse collapse">
									<div class="pan-body all-location">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-xs-12">
												<?php 
												for ($q=0; $q < sizeOf($statesInfo); $q++) 
												{ 
													$stateCkd = '';
													if(@$statesInfo[$q]->id == @$jsonObj->state_id)
													{
														$stateCkd = 'checked';
													}
												?>
													<div class="checkbox-inner rdbtn">
						                                <label class="chkcontainer rdio">
															<input type="radio" value="<?php echo @$statesInfo[$q]->id; ?>" class="filter_products" name="statesType" data-id='2'  <?php echo @$stateCkd; ?>><?php echo @$statesInfo[$q]->state_name; ?>
															<span class="chkbox"></span>
														</label>
						                            </div>
												<?php 
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php 
					}
					$citiesInfo = @$jsonObj->citiesInfo;
					$cityShow = 'display:none;';
					if(@sizeOf($citiesInfo) > 0)
					{
						$cityShow = 'display:block;';
					}
					?>
					<div class="panel panel-default" id='cityInfo' style="<?php echo @$cityShow; ?>">
						<div class="prod-pan mrt-2p acrdn" >
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
								<div class="prodt-head" role="tab" id="courseOne">
									<div class="panel-heading">
										<h4 class="panel-title prodt-title">
											Cities
										</h4>
									</div>
								</div>
							</a>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="pan-body all-location">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-xs-12" id="city-info">
											<?php 
											for ($l=0; $l < sizeOf($citiesInfo); $l++) 
											{ 
												$cityCkd = '';
												if(@$citiesInfo[$l]->id == @$jsonObj->city_id)
												{
													$cityCkd = 'checked';
												}
											?>
												<div class="checkbox-inner rdbtn">
					                                <label class="chkcontainer">
														<input type="checkbox" value="<?php echo @$citiesInfo[$l]->id; ?>" class="filterproducts" name="cityType" <?php echo @$cityCkd; ?>><?php echo @$citiesInfo[$l]->city_name; ?>
														<span class="chkbox"></span>
													</label>
					                            </div>
											<?php 
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="prod-pan mrt-2p acrdn">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed" aria-expanded="false">
								<div class="prodt-head" role="tab" id="courseFour">
									<div class="panel-heading">
						                <h4 class="panel-title  prodt-title">
						                    Salary Type
						                </h4>
						            </div>
								</div>
							</a>
							<div id="collapseSix" class="panel-collapse collapse">
								<div class="pan-body all-location">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-xs-12">
											<div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer rdio">
													<input type="radio" value="1" class="filterproducts" name="salarytype">Hourly
													<span class="chkbox"></span>
												</label>
				                            </div>
				                            <div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer rdio">
													<input type="radio" value="2" class="filterproducts" name="salarytype">Daily
													<span class="chkbox"></span>
												</label>
				                            </div>
				                            <div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer rdio">
													<input type="radio" value="3" class="filterproducts" name="salarytype">Weekly
													<span class="chkbox"></span>
												</label>
				                            </div>
				                            <div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer rdio">
													<input type="radio" value="4" class="filterproducts" name="salarytype">Monthly
													<span class="chkbox"></span>
												</label>
				                            </div>
				                            <div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer rdio">
													<input type="radio" value="5" class="filterproducts" name="salarytype">Yearly
													<span class="chkbox"></span>
												</label>
				                            </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="prod-pan mrt-2p acrdn">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"  class="collapsed" aria-expanded="false">
								<div class="prodt-head" role="tab" id="courseFour">
									<div class="panel-heading">
						                <h4 class="panel-title  prodt-title">
						                     Salary
						                </h4>
						            </div>
								</div>
							</a>
							<div id="collapseFive" class="panel-collapse collapse">
								<div class="pan-body all-location">
									<div class="row">
										<div class="col-sm-8 col-md-8 col-xs-8">
											<input type="text" class="form-control" name="salaryrangeInfo" placeholder="Ex:5000" id="salaryrangeInfo">
										</div>
										<div class="col-sm-4 col-md-4 col-xs-8">
											<button name="button" type="button" class="gobtn filterproducts">GO</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 
					$empInfo = @$jsonObj->empInfo;
					if(@sizeOf($empInfo) > 0)
					{
					?>
						<div class="panel panel-default">
							<div class="prod-pan mrt-2p acrdn">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
									<div class="prodt-head" role="tab" id="courseOne">
										<div class="panel-heading">
											<h4 class="panel-title prodt-title">
												Employment Type 
											</h4>
										</div>
									</div>
								</a>
								<div id="collapseThree" class="panel-collapse collapse">
									<div class="pan-body all-location">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-xs-12">
												<?php 
												for ($e=0; $e < sizeOf($empInfo); $e++) 
												{ 
													$empseltd = '';
													if(@strtolower($empInfo[$e]->cat_name) == @strtolower($jsonObj->skillnames))
													{
														$empseltd = 'checked';
													}
												?>
													<div class="checkbox-inner rdbtn">
						                                <label class="chkcontainer">
															<input type="checkbox" value="<?php echo @$empInfo[$e]->cat_name; ?>" class="filterproducts" name="employmentType" <?php echo @$empseltd; ?>><?php echo @$empInfo[$e]->cat_name; ?>
															<span class="chkbox"></span>
														</label>
						                            </div>
												<?php 
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php 
					}
					$experienceInfo = @$jsonObj->experienceInfo;
					if(@sizeOf($experienceInfo) > 0)
					{
					?>
						<div class="panel panel-default">
							<div class="prod-pan mrt-2p acrdn">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false">
									<div class="prodt-head" role="tab" id="courseTwo">
										<div class="panel-heading">
							                <h4 class="panel-title  prodt-title">
							                    Experience
							                </h4>
							            </div>
									</div>
								</a>
								<div id="collapseFour" class="panel-collapse collapse">
									<div class="pan-body all-location">
										<div class="row">
											<div class="col-sm-12 col-md-12 col-xs-12">
												<?php 
												for ($r=0; $r < sizeOf($experienceInfo); $r++) 
												{ 
												?>
													<div class="checkbox-inner rdbtn">
						                                <label class="chkcontainer">
															<input type="checkbox" value="<?php echo @$experienceInfo[$r]->id; ?>" class="filterproducts" name="experienceinfo"><?php echo @$experienceInfo[$r]->cat_name; ?>
															<span class="chkbox"></span>
														</label>
						                            </div>
												<?php 
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php 
					}
					
					?>
					<div class="panel panel-default">
						<div class="prod-pan mrt-2p acrdn">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseFives"  class="collapsed" aria-expanded="false">
								<div class="prodt-head" role="tab" id="courseFours">
									<div class="panel-heading">
						                <h4 class="panel-title  prodt-title">
						                     Joining Type
						                </h4>
						            </div>
								</div>
							</a>
							<div id="collapseFives" class="panel-collapse collapse">
								<div class="pan-body all-location">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-xs-12">
											
											<div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer">
													<input type="checkbox" value="1" class="filterproducts" name="joiningtype">Immediate
													<span class="chkbox"></span>
												</label>
				                            </div>
											<div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer">
													<input type="checkbox" value="2" class="filterproducts" name="joiningtype">Within This Week
													<span class="chkbox"></span>
												</label>
				                            </div>
				                            <div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer">
													<input type="checkbox" value="3" class="filterproducts" name="joiningtype">Next Week
													<span class="chkbox"></span>
												</label>
				                            </div>
				                            <div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer">
													<input type="checkbox" value="4" class="filterproducts" name="joiningtype">1st Of Next Month
													<span class="chkbox"></span>
												</label>
				                            </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel panel-default">
						<div class="prod-pan mrt-2p acrdn">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" class="collapsed" aria-expanded="false">
								<div class="prodt-head" role="tab" id="courseFive">
									<div class="panel-heading">
						                <h4 class="panel-title  prodt-title">
						                    Job Freshness
						                </h4>
						            </div>
								</div>
							</a>
							<div id="collapseSeven" class="panel-collapse collapse">
								<div class="pan-body all-location">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-xs-12">
											<div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer">
													<input type="checkbox" value="1" class="filterproducts" name="jobfressness">< 3 Days Old
													<span class="chkbox"></span>
												</label>
				                            </div>
				                            <div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer">
													<input type="checkbox" value="2" class="filterproducts" name="jobfressness">< 7 Days Old
													<span class="chkbox"></span>
												</label>
				                            </div>
				                            <div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer">
													<input type="checkbox" value="3" class="filterproducts" name="jobfressness">< 15 Days Old
													<span class="chkbox"></span>
												</label>
				                            </div>
				                            <div class="checkbox-inner rdbtn">
				                                <label class="chkcontainer">
													<input type="checkbox" value="4" class="filterproducts" name="jobfressness">> 15 Days Old
													<span class="chkbox"></span>
												</label>
				                            </div>
				                           
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8 col-md-8 col-xs-12 mt-2" style="<?php echo $mrbtm; ?>">
		<div class="row">
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
		</div>
		<div id='ajaxloader' style='display: none;text-align: center;'>
            <img src='<?php echo base_url(); ?>includes/images/ajaxloader.gif'>
        </div>
		<div class="targetResults" id="targetResults">
			<div class="row">
				<div class="col-sm-9 col-md-9 col-xs-7">
					<div class="media applyed">
						<div class="media-left">
							<a href="#">
								<img class="media-object" src="<?php echo base_url() ?>includes/images/objective.png" alt="img-123">
							</a>
						</div>
						<div class="media-body">
							<h4 class="media-heading"><?php echo "Total ".@sizeOf($results)." Jobs"; ?>
							</h4>
						</div>
					</div>
				</div>
				<div class="col-xs-5 hidden-sm hidden-md hidden-lg mbmrtp1 text-right">
					<span class=" open-cls" style="font-size:13px;cursor:pointer;border:1px solid #ccc;" onclick="openNavs()">Filter By &#9776; </span>
				</div>
			</div>
			<?php 
			if(@sizeOf($results) > 0)
			{
				for ($r=0; $r < sizeOf($results); $r++) 
				{
			?>
				<div class="del-sm8 mob-del-sm8">
					<div class="row">
						<div class="col-sm-8 col-md-8 col-xs-8">
							<div class="dev ">
								<h4>
									<a href="#0"><?php echo @ucwords($results[$r]->job_title); ?> </a>
								</h4>
								<h3><a href="#"><?php echo @$results[$r]->userData[0]->business_name; ?></a></h3>
							</div>
						</div>
						<div class="col-sm-4 col-md-4 col-xs-4">
							<div class="business_logo">
								<?php 
								if(@$results[$r]->userData[0]->business_logo != '')
								{
								?>
									<img src="<?php echo base_url(); ?>admin/uploads/users/<?php echo @$results[$r]->userData[0]->business_logo; ?>" class="img-responsive">
								<?php 
								}
								?>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 1em">
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								
								<div class="media-body">
									<?php 
									if(@$results[$r]->expInfo[0]->cat_name != '')
									{
									?>
										<a href="#"><h4 class="media-heading"><span class="fntbold">Experience : </span> <?php echo @$results[$r]->expInfo[0]->cat_name; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a href="#"><h4 class="media-heading"><span class="fntbold">Experience : </span>:Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-8 col-md-8 col-xs-12">
							<div class="media del-exp">
								
								<div class="media-body">
									<?php 
									if(@$results[$r]->stateInfo[0]->state_name != '')
									{
									?>
										<a href="#"><h4 class="media-heading"><span class="fntbold">Location</span>: <?php echo @$results[$r]->cityInfo[0]->city_name.", ".@$results[$r]->stateInfo[0]->state_name; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a href="#"><h4 class="media-heading"><span class="fntbold">Location</span>:Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="row mr-t1e mmr-t1e">
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->salary != '')
									{
										if(@$results[$r]->salary_type == 1)
										{
											$salaryType = 'Hourly';
										}
										if(@$results[$r]->salary_type == 2)
										{
											$salaryType = 'Daily';
										}
										if(@$results[$r]->salary_type == 3)
										{
											$salaryType = 'Weekly';
										}
										if(@$results[$r]->salary_type == 4)
										{
											$salaryType = 'Monthly';
										}
										if(@$results[$r]->salary_type == 5)
										{
											$salaryType = 'Yearly';
										}
									?>
										<a><h4 class="media-heading"><span class="fntbold">Salary</span> : <?php echo @$results[$r]->salary." <span class='fntbold'>(".@$salaryType.")</span>"; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Salary</span>: Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->employment_type != '')
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Employment Type</span> : <?php echo @$results[$r]->employment_type; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Employment Type</span>: Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-4 col-md-4 col-xs-12">
							<div class="media del-exp">
								<div class="media-body">
									<?php 
									if(@$results[$r]->joining_type != '')
									{
										if(@$results[$r]->joining_type == 1)
										{
											$joiningType = 'Immediate';
										}
										if(@$results[$r]->joining_type == 2)
										{
											$joiningType = 'Within This Week';
										}
										if(@$results[$r]->joining_type == 3)
										{
											$joiningType = 'Next Week';
										}
										if(@$results[$r]->joining_type == 4)
										{
											$joiningType = '1st Of Next Month';
										}
									?>
										<a><h4 class="media-heading"><span class="fntbold">Joining Type</span> : <?php echo @$joiningType; ?></h4></a>
									<?php 
									}
									else
									{
									?>
										<a><h4 class="media-heading"><span class="fntbold">Joining Type</span>: Not Specified</h4></a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-xs-12">
							<div class="take">
								<?php $job_skills = @$results[$r]->job_skills; ?>
								<?php 
								$jobSkills = @explode(",", $job_skills);
								if(@sizeOf($jobSkills) > 0)
								{
								?>
									<ul class="keyskill" style="margin-bottom: 0;">
										<li class="firsskl">Skills :</li>
										<?php
										for ($js=0; $js < sizeOf($jobSkills); $js++) 
										{ 
											if($jobSkills[$js] != '')
											{
										?>
											<li><?php echo @ucwords($jobSkills[$js]); ?></li>
										<?php
											}
										}
										?>
									</ul>
								<?php
								}
								?>
									
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 1em">
						<div class="postinfo">
							<div class="col-sm-4 col-md-4  postpading hidden-xs">
							
								<p>Posted : <?php echo @$results[$r]->timeago; ?></p>
							</div>
							<div class="col-sm-4 col-md-4  col-xs-6">
								<div class="like-symbol">
									<?php 
									if(@$this->session->userdata("is_logged_in") !='')
									{
										$likedJobs = @$results[$r]->likedJobs;
										if(@$likedJobs == '1')
										{
										?>
											<a href="#0" class='alrdyliked_jobs'>
												<img src="<?php echo base_url(); ?>includes/images/liked.png" class="img-responsive">
											</a>
										<?php 
										}
										else
										{
										?>
											<a href="#0" data-id='<?php echo @$results[$r]->id; ?>' class='liked_jobs' data-type='1'>
												<img src="<?php echo base_url(); ?>includes/images/like.png" class="img-responsive" id="like_<?php echo @$results[$r]->id; ?>">
											</a>
											
										<?php
										}
									}
									else
									{
									?>
										<a href="<?php echo base_url(); ?>login">
											<img src="<?php echo base_url(); ?>includes/images/like.png" class="img-responsive">
										</a>
									<?php
									}
									?>
								</div>
							</div>
							<div class="col-sm-4 col-md-4 col-xs-6">
								<div class="read-more">
									<?php 
									if(@$this->session->userdata("is_logged_in") !='')
									{
									?>
										<a href="#0" id="<?php echo @$results[$r]->id; ?>"  class="jobdetails">Read More</a>
									<?php
									}
									else
									{
									?>
										<a href="<?php echo base_url(); ?>login">
											Read More
										</a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="postinfo  hidden-sm hidden-md hidden-lg">
							<div class="col-xs-12">
							
								<p>Posted : <?php echo @$results[$r]->timeago; ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php
				}
			}
			else
			{
			?>
				<div class="del-sm8 mob-del-sm8">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-xs-12">
							<p style="text-align: center;color: red;font-size: 18px;">No Results Found</p>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>

<!--Reset Password Modal Starts-->  
<div class="modal fade login-modal" id="jobdetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog login-dailog rec-job-details" role="document">
		<div class="modal-content login-content ">
			<div class="modal-header login-head">
				<button type="button" class="close resetclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title login-title" id="myModalLabel">Job Details</h4>
			</div>
			<div class="modal-body login-body" id="job_details">
				
				
			</div>
		</div>
	</div>
</div>
<!--END Forgot OF MODAL-->
<input type="hidden" value="<?php echo @$jsonObj->pagetype; ?>" id="pagetype" name="pagetype">

