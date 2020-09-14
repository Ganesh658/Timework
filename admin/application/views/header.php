<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo @$sitename[0]->configValue;?> | Dashboard</title>

    <link href="<?php echo base_url()?>externals/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>externals/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url()?>externals/css/plugins/chosen/chosen.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="<?php echo base_url()?>externals/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url()?>externals/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
	<link href="<?php echo base_url()?>externals/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="<?php echo base_url()?>externals/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url()?>externals/css/style.css" rel="stylesheet">	
	<script src="<?php echo base_url()?>externals/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url()?>externals/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>externals/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url()?>externals/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>externals/css/jquery.mCustomScrollbar.css">
	<script src="<?php echo base_url()?>externals/js/inspinia.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>externals/css/chosen.css">
	<script type="text/javascript">
		var baseurl="<?php echo base_url()?>";
	</script>
</head>


<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
					<li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <!--<img alt="image" class="img-circle" src="<?php echo base_url()?>externals/img/profile_small.jpg" />-->
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo @$this->session->userdata("firstname")." ".@$this->session->userdata("lastname");?></strong>
							<?php
							if(@$this->session->userdata("usertype") == "1" )
							{
								$reso="Super Admin";
							}
							elseif(@$this->session->userdata("usertype") == "2")
							{
								$reso="Admin";
							}
							?>
                             </span> <span class="text-muted text-xs block"><?php echo @$reso;?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo base_url()?>index.php/home/changepassword">Change Password</a></li>
                                <li><a href="<?php echo base_url()?>index.php/home/logout">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                   
				<?php				
				if(@$this->session->userdata("usertype") == "1")			
				{
				?>	
					<li class="<?php if(@$menu == "homeact"){echo "active";}?>">
						<a href="<?php echo base_url()?>"><i class="fa fa-bars"></i><span class="nav-label">Dashboard</span> </a>
					</li>
					<li class="<?php if(@$menu == "pricingcontent"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/benchcms/8"><i class="fa fa-sitemap"></i><span class="nav-label">Pricing Content</span> </a>
					</li>
					<li class="<?php if(@$menu == "catAct"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/categories"><i class="fa fa-sitemap"></i><span class="nav-label">Categories</span> </a>
					</li>
					<li class="<?php if(@$menu == "skills"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/skills"><i class="fa fa-sitemap"></i><span class="nav-label">Skills</span> </a>
					</li>
					<li class="<?php if(@$menu == "hban"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/banners"><i class="fa fa-image"></i><span class="nav-label">Banners</span> </a>
					</li>
					
					<li class="<?php if(@$menu == "counAct"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/states/1"><i class="fa fa-image"></i><span class="nav-label">States</span> </a>
					</li>

					<li class="<?php if(@$menu == "rcposts"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/recruiterposts"><i class="fa fa-image"></i><span class="nav-label">Recruiter Posts</span> </a>
					</li>
					<li class="<?php if(@$menu == "candpost"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/candidateposts"><i class="fa fa-user"></i><span class="nav-label">Candidates Posts</span> </a>
					</li>

					<li class="<?php if(@$menu == "bpage_1" || @$menu == "bpage_2"  || @$menu == "bpage_3"  || @$menu == "bpage_4"  || @$menu == "bpage_5"  || @$menu == "bpage_6" || @$menu == "page_4" || @$menu == "adrAct" || @$menu == "socAct" || @$menu == "bpage_7" ){echo "active";}?>">
						<a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">CMS</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">							
							
							<li class="<?php if(@$menu == "bpage_3"){echo "active";}?>">
								<a href="<?php echo base_url()?>index.php/home/benchcms/3"><i class="fa fa-building-o"></i><span class="nav-label">Privacy &amp; Policy</span> </a>
							</li>
							<li class="<?php if(@$menu == "bpage_4"){echo "active";}?>">
								<a href="<?php echo base_url()?>index.php/home/benchcms/4"><i class="fa fa-building-o"></i><span class="nav-label">Terms &amp; Conditions</span> </a>
							</li>
							<li class="<?php if(@$menu == "bpage_6"){echo "active";}?>">
								<a href="<?php echo base_url()?>index.php/home/benchcms/6"><i class="fa fa-building-o"></i><span class="nav-label">FAQ's For Candidates</span> </a>
							</li>
							<li class="<?php if(@$menu == "bpage_7"){echo "active";}?>">
								<a href="<?php echo base_url()?>index.php/home/benchcms/7"><i class="fa fa-building-o"></i><span class="nav-label">FAQ's For Recruiters</span> </a>
							</li>
							<li class="<?php if(@$menu == "page_4"){echo "active";}?>">
								<a href="<?php echo base_url()?>index.php/home/pagecontent/4"><i class="fa fa-building-o"></i><span class="nav-label">Testimonials</span> </a>
							</li>
							<li class="<?php if(@$menu == "adrAct"){echo "active";}?>">
								<a href="<?php echo base_url()?>index.php/home/address"><i class="fa fa-map-marker"></i><span class="nav-label">Address</span> </a>
							</li>
							
							<li class="<?php if(@$menu == "socAct"){echo "active";}?>">
								<a href="<?php echo base_url()?>index.php/home/social"><i class="fa fa-facebook"></i><span class="nav-label">Social Links</span> </a>
							</li>
						</ul>
					</li>
					
					<li class="<?php if(@$menu == "users_3" || @$menu == "users_4" || @$menu == "users_5" || @$menu == "users_6" || @$menu == "users_7"){echo "active";}?>">
						<a href="#"><i class="fa fa-users"></i> <span class="nav-label">Registered Users</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">							
							<li class="<?php if(@$menu == "users_3"){echo "active";}?>">
								<a href="<?php echo base_url()?>index.php/home/users/3"><i class="fa fa-user"></i><span class="nav-label">Candidates</span> </a>
							</li>
							<li class="<?php if(@$menu == "users_5"){echo "active";}?>">
								<a href="<?php echo base_url()?>index.php/home/users/5"><i class="fa fa-user"></i><span class="nav-label">Recruiters</span> </a>
							</li>
						</ul>
					</li>
					
					
					<li class="<?php if(@$menu == "enqAct"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/enquiries"><i class="fa fa-question-circle"></i><span class="nav-label">Enquiries</span> </a>
					</li>
					<li class="<?php if(@$menu == "metaAct"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/meta"><i class="fa fa-book"></i><span class="nav-label">Meta Data</span> </a>
					</li>
					<li class="<?php if(@$menu == "page_8"){echo "active";}?>">
						<a href="<?php echo base_url()?>index.php/home/mainScripts/8"><i class="fa fa-building-o"></i><span class="nav-label">Google Analytics</span> </a>
					</li>
				<?php
				}
				?>
                </ul>
            </div>
        </nav>
		
		

		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					<?php 
						$scountryId = @$this->session->userdata("countryId");
						$countriesInfo = @$this->session->userdata("countriesInfo"); 
					?>
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i> </a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						
						<li>
							<span class="m-r-sm text-muted welcome-message" style="color: blue;font-weight: bold;font-size:15px; ">Welcome to <?php echo @$sitename[0]->configValue; ?> Admin Panel.</span>
						</li>
						<li>
							<a href="<?php echo base_url()?>index.php/home/logout">
								<i class="fa fa-sign-out"></i> Log out
							</a>
						</li>
					</ul>
				</nav>
			</div>
