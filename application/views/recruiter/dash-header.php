<?php
$jsonObj=@json_decode($jsonObj);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Job Portal</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/dashboard-responsive.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/jquery.mCustomScrollbar.css">
	<script src="<?php echo base_url() ?>includes/js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url() ?>includes/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var baseurl = '<?php echo base_url(); ?>';
	</script>
  	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<body>
<header>
	<nav class="navbar navbar-default navbar-fixed-top career-nav">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed action-nav" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="background-color:#fff;">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand mylogo dashlogo" href="<?php echo base_url() ?>">
					<img src="<?php echo base_url() ?>includes/images/logo.png" class="img-responsive">
				</a>
			</div>			
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right home1 home1-nav hamster-nav">
					<li class="dropdown career-ul career-ul-a">
						<a href="#" class="dropdown-toggle careerdrp" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="seeker-img">
								<?php 
								if(@$jsonObj->userInfo[0]->profile_pic != '')
								{
								?>
									<img class="media-object" src="<?php echo base_url() ?>admin/uploads/users/<?php echo @$jsonObj->userInfo[0]->profile_pic; ?>" alt="img-22">
								<?php 
								}
								else
								{
								?>
									<img class="media-object" src="<?php echo base_url() ?>includes/images/image-profile.jpg" alt="img-22">
								<?php
								}
								?>
							</span>
							<?php 
							if( @$this->session->userdata("usertype") == '3')
							{
								echo "job seeker";
							}
							if( @$this->session->userdata("usertype") == '5')
							{
								echo "Recruiter";
							}
							?>

							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu career-menu">
							<li><a href="<?php echo @$this->session->userdata("folder");?>"><?php echo @$jsonObj->userInfo[0]->firstname; ?></a></li>
							<li><a href="<?php echo base_url();?>login/logout">logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>  
</header>
<section class="employee dashemp">
	<div class="container">
		<div class="row">			
			<div class="col-sm-12 col-md-12 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url(); ?>">Home</a></li>
					<?php 
					if( @$this->session->userdata("usertype") == '3')
					{
					?>
						<li><a href="<?php echo base_url(); ?>jobseeker">jobseeker Dashboard</a></li>
					<?php
					}
					if( @$this->session->userdata("usertype") == '5')
					{
					?>
						<li><a href="<?php echo base_url(); ?>recruiter">Recruiter Dashboard</a></li>
					<?php
					}
					?>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="del">
	<div class="container">
		<div class="row">			
			<div class="col-sm-3 col-md-3 col-xs-12">
				<div class="del-sm4">
					<div class="media arora">
						
						<div class="media-body">
							<h4 class="media-heading"><?php echo @$jsonObj->userInfo[0]->firstname; ?></h4>
							<p><?php echo @$jsonObj->userInfo[0]->email; ?></p>
							<p>Contact&nbsp;:&nbsp;<?php echo @$jsonObj->userInfo[0]->mobile; ?></p>
							<p>Joined&nbsp;:&nbsp;<?php echo @date("d/m/Y",strtotime($jsonObj->userInfo[0]->regDate)); ?></p>
							
						</div>
					</div>
					<?php 
					if( @$this->session->userdata("usertype") == '3')
					{
					?>
						<div class="account">
							<h4 class="<?php if(@$jsonObj->dashAct == 'dashboard'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>jobseeker">Dashboard</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'sjobs'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>jobseeker/searchjobs">Search Jobs</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'sgstjobs'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>jobseeker/suggestedjobs">Suggested Jobs</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'likedjobs'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>jobseeker/likedjobs">Liked Jobs</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'myjobs'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url();?>jobseeker/myJobs">My Posts</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'editprofile'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>jobseeker/editprofile">My profile</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'myjobs'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url();?>jobseeker/myJobs">Pricing</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'myjobs'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url();?>jobseeker/myCredits">Credits</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'chngpwd'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url();?>jobseeker/changepassword">Settings</a>
							</h4>
							<h4 >
								<a href="<?php echo base_url();?>login/logout">log out</a>
							</h4>
						</div>
					<?php
					}
					
					if( @$this->session->userdata("usertype") == '5')
					{
					?>
						<div class="account">
							<h4 class="<?php if(@$jsonObj->dashAct == 'dashboard'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>recruiter">Dashboard</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'sjobs'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>recruiter/jobseeker">Search Jobs</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'dashboard'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>recruiter/suggestedjobs">Suggested Jobs</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'dashboard'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>recruiter/likedjobs">Liked Jobs</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'jobpostings'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url();?>recruiter/jobpostings">My Posts</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'editprofile'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url(); ?>jobseeker/editprofile">My profile</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'myjobs'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url();?>recruiter/myJobs">Pricing</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'myjobs'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url();?>recruiter/myCredits">Credits</a>
							</h4>
							<h4 class="<?php if(@$jsonObj->dashAct == 'chngpwd'){ echo "account-h4";} ?>">
								<a href="<?php echo base_url();?>recruiter/changepassword">Settings</a>
							</h4>
							<h4 >
								<a href="<?php echo base_url();?>login/logout">log out</a>
							</h4>
						</div>
					<?php
					}
					?>					
				</div>
			</div>








