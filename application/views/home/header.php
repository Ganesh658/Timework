<?php
$jsonObj=@json_decode($jsonObj);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Timework</title>
	<meta name="description" content="Timework">
	<meta name="keywords" content="Timework">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?php echo base_url() ?>includes/img/fav_icon.png" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/jobportal.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>includes/css/responsive.css">
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
<style type="text/css">
	.home { border-bottom: 1px solid #272727;}
	.dashactive{background: #fff;color: #05AEE5 !important;font-size: 17px;font-family: 'OpenSans-Bold';}
</style>
<header>
	<nav class="navbar navbar-default navbar-fixed-top home">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed action-nav mob-tgle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="background-color:#000;">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand mylogo" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>includes/img/logo.png" class="img-responsive"></a>
				<ul>
					<?php
					if(@$this->session->userdata("is_logged_in") !='')
					{
						if(@$this->session->userdata("usertype") == '3')
						{
					?>
						<li style="list-style: none !important;">
							<a class="post posts hidden-sm hidden-md hidden-lg" href="<?php echo base_url(); ?>jobseeker/postjobs"  style='color: #fff !important;'> POST NEED JOB</a>
						</li>
					<?php 
						}
						if(@$this->session->userdata("usertype") == '5')
						{
					?>
						<li style="list-style: none !important;">
							<a class="post posts hidden-sm hidden-md hidden-lg" href="<?php echo base_url(); ?>recruiter/postjobs"  style='color: #fff !important;'> POST JOB</a>
						</li>
					<?php 
						}
					}
					else
					{
					?>
						<li class="update hidden-lg hidden-md hidden-sm"  style="list-style: none;">
							<a href="<?php echo base_url(); ?>login" class=" post" >Login</a>
						</li>
						<!-- <li class="update hidden-lg hidden-md hidden-sm">
							<a href="<?php echo base_url(); ?>registration-process" class=" post1" style="color:#000 !important;">Register </a>
						</li> -->
					<?php
					}
					?>
					
				</ul>
			</div>			
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right home1 home1-nav mainmenus">
					
				<?php 
					if( @$this->session->userdata("usertype") == '3')
					{
					?>
						<li>
							<a href="<?php echo base_url() ?>" class="hidden-sm hidden-md hidden-lg"> Search Jobs</a>
						</li>
						<li>
							<a class="btn btn-default website-btn2 outline needpost hidden-xs" href="<?php echo base_url(); ?>jobseeker/postjobs" > POST NEED JOB</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>jobseeker/suggestedjobs">Suggested Jobs</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>jobseeker/likedjobs">Liked Jobs</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>jobseeker/myJobs">My Posts</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>jobseeker/editprofile">My profile</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url(); ?>pricing">Pricing</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url(); ?>credits">Credits</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>jobseeker/changepassword">Settings</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url(); ?>login/logout">Log Out</a>
						</li>
					<?php 
					}
					if( @$this->session->userdata("usertype") == '5')
					{
					?>
						<li>
							<a href="<?php echo base_url() ?>" class="hidden-sm hidden-md hidden-lg">Search Candidates</a>
						</li>
						<li>
							<a class="btn btn-default website-btn2 outline needrecpost hidden-xs" href="<?php echo base_url(); ?>recruiter/postjobs" style='color: #fff !important;'> POST JOB</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>recruiter/suggestedjobs">Suggested Candidates</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>recruiter/likedjobs">Liked Candidates</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>recruiter/jobpostings">My Posts</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>recruiter/editprofile">My profile</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url(); ?>pricing">Pricing</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url(); ?>credits">Credits</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url();?>recruiter/changepassword">Settings</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url(); ?>login/logout">Log Out</a>
						</li>
					<?php 
					}
					?>
					<?php
					if(@$this->session->userdata("is_logged_in") !='')
					{
					?>	
						<li class="hidden-xs nact mchildren <?php if(@$jsonObj->homeActive == 'pages'){echo "active";}; ?>">
							<a href="javascript:;" class="parent-a" style="color: #fff !important;">My Account <span class="caret"></span></a>
							<ul class="sub-menu">
								
								<li>
									<a href="<?php echo @$this->session->userdata("folder"); ?>" style='color: #000 !important;'><?php echo @$jsonObj->userInfo[0]->firstname; ?></a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>login/logout" style='color: #000 !important;'>Logout</a>
								</li>
							</ul>
						</li>
							
					<?php 
					}
					else
					{
					?>
						<li class="update hidden-xs">
							<a href="<?php echo base_url(); ?>login" class=" post" style="color:#fff !important;"> Login</a>
						</li>
						<li class="update hidden-xs">
							<a href="<?php echo base_url(); ?>registration-process" class=" post" style="color:#fff !important;"> Register</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url() ?>">Search Jobs</a>
						</li>
						<li class=" hidden-sm hidden-md hidden-lg"><a  href="<?php echo base_url(); ?>registration-process">Register</a></li>
						<li class=" hidden-sm hidden-md hidden-lg">
							<a href="<?php echo base_url(); ?>pricing">Pricing</a>
						</li>
					<?php
					}
					?>
					
				</ul>
			</div>
		</div>
	</nav>  
</header>
<section class="mt-5p lgdes">
	<div class="container-fluid just">	
		<div class="row">
			<div class="col-sm-2 col-md-2 hidden-xs nopadding">
				<div class="main-side">
					<ul class="nav navbar-nav side-navbar">
						
						<?php
						if(@$this->session->userdata("is_logged_in") =='')
						{
						?>	
							<li class=" home-a">
								<a class="<?php if(@$jsonObj->homeActive == 'sjobs'){ echo "dashactive";} ?>" href="<?php echo base_url() ?>">Search Jobs</a>
							</li>
							<li><a class="<?php if(@$jsonObj->homeActive == 'rcpr'){ echo "dashactive";} ?>" href="<?php echo base_url(); ?>registration-process">Register</a></li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'pricing'){ echo "dashactive";} ?>" href="<?php echo base_url(); ?>pricing">Pricing</a>
							</li>
						<?php 
						}
						if( @$this->session->userdata("usertype") == '3')
						{
						?>
							<li class=" home-a">
								<a class="<?php if(@$jsonObj->homeActive == 'sjobs'){ echo "dashactive";} ?>" href="<?php echo base_url() ?>">Search Jobs</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'suggestedjobs'){ echo "dashactive";} ?>" href="<?php echo base_url();?>jobseeker/suggestedjobs">Suggested Jobs</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'likedjobs'){ echo "dashactive";} ?>" href="<?php echo base_url();?>jobseeker/likedjobs">Liked Jobs</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'myJobs'){ echo "dashactive";} ?>" href="<?php echo base_url();?>jobseeker/myJobs">My Posts</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'editprofile'){ echo "dashactive";} ?>" href="<?php echo base_url();?>jobseeker/editprofile">My profile</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'pricing'){ echo "dashactive";} ?>" href="<?php echo base_url(); ?>pricing">Pricing</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'credits'){ echo "dashactive";} ?>" href="<?php echo base_url(); ?>credits">Credits</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'chngpwd'){ echo "dashactive";} ?>" href="<?php echo base_url();?>jobseeker/changepassword">Settings</a>
							</li>
							<!-- <li>
								<a href="<?php echo base_url(); ?>login/logout">Log Out</a>
							</li> -->
						<?php 
						}
						if( @$this->session->userdata("usertype") == '5')
						{
						?>
							<li class=" home-a">
								<a class="<?php if(@$jsonObj->homeActive == 'sjobs'){ echo "dashactive";} ?>" href="<?php echo base_url() ?>">Search Candidates</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'suggestedjobs'){ echo "dashactive";} ?>" href="<?php echo base_url();?>recruiter/suggestedjobs">Suggested Candidates</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'likedjobs'){ echo "dashactive";} ?>" href="<?php echo base_url();?>recruiter/likedjobs">Liked Candidates</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'jobpostings'){ echo "dashactive";} ?>" href="<?php echo base_url();?>recruiter/jobpostings">My Posts</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'editprofile'){ echo "dashactive";} ?>" href="<?php echo base_url();?>recruiter/editprofile">My profile</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'pricing'){ echo "dashactive";} ?>" href="<?php echo base_url(); ?>pricing">Pricing</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'credits'){ echo "dashactive";} ?>" href="<?php echo base_url(); ?>credits">Credits</a>
							</li>
							<li>
								<a class="<?php if(@$jsonObj->homeActive == 'chngpwd'){ echo "dashactive";} ?>" href="<?php echo base_url();?>recruiter/changepassword">Settings</a>
							</li>
							<!-- <li>
								<a href="<?php echo base_url(); ?>login/logout">Log Out</a>
							</li> -->
						<?php 
						}
						?>
					</ul>
				</div>
			</div>
			<div class="col-sm-10 col-md-10 col-xs-12 nopadding mobnopadding">









