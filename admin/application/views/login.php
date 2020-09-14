<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo @$sitename[0]->configValue;?> | Login</title>

    <link href="<?php echo base_url()?>externals/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>externals/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url()?>externals/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url()?>externals/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
				<?php 
                if(@$sitename[0]->logo_img != '')
                {
                ?>
                    <img style="background-color: #25252f;margin: 0 auto;" src="<?php echo base_url();?>../includes/img/<?php echo @$sitename[0]->logo_img; ?>" class='img-responsive'> 
                <?php 
                }
                else
                {
                ?>
                     <img style="background-color: #25252f;margin: 0 auto;" src="<?php echo base_url();?>../includes/img/logo.png" class='img-responsive'> 
                <?php
                }
                ?>
				<h2 class="font-bold" style="text-align: center;">Admin Dashboard</h2>
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
					<?php
					if(@$this->session->userdata("success") != '')
					{
					?>
						<div class="alert alert-success alert-dismissable">
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							<?php
							echo @$this->session->userdata("success");
							@$this->session->unset_userdata("success");
							?>
						</div>
					<?php
					}
					if(@$this->session->userdata("fail") != '')
					{
					?>
						<div class="alert alert-danger alert-dismissable">
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							<?php
							echo @$this->session->userdata("fail");
							@$this->session->unset_userdata("fail");
							?>
						</div>
					<?php
					}
					?>
                    <form class="m-t" role="form" method="POST" action="<?php echo base_url()?>index.php/home/verify">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Id" name="email" id="email" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required="">
                        </div>
                        
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                         <a href="<?php echo base_url();?>index.php/home/forgotpassword">
                            <small>Forgot password?</small>
                        </a>

                    </form>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright <?php echo @$sitename[0]->configValue;?>
            </div>
            <div class="col-md-6 text-right">
               <small>© <?php echo @date("Y");?></small>
            </div>
        </div>
    </div>

</body>

</html>
