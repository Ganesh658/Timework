<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Frontiers Meetings | Login</title>

    <link href="<?php echo base_url()?>externals/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>externals/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url()?>externals/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url()?>externals/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Forgot Password</h2>

                <p>
                    Reset Your Password.
                </p>


            </div>
            <div class="col-md-6">
                
				<div class="ibox-content" id="forgotForm">
					<?php
					if(@$this->session->userdata("fail") != '')
					{
						echo $this->session->userdata("fail");
						$this->session->unset_userdata("fail");
					}
					?>
                    <form class="m-t" role="form" method="POST" action="<?php echo base_url()?>index.php/home/savepassword">
						<div id="forgotmsg"></div>
                        <div class="form-group">
                            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Enter New Password" name="password" id="password" /> 
                        </div>
						
						 <div class="form-group">
                            <input class="form-control form-control-solid placeholder-no-fix" type="password" onBlur="checkPassword()" autocomplete="off" placeholder="Confirm Password" name="cnfpassword" id="cnfpassword" /> 
                        </div>
                        <input class="" type="hidden" name="email" id="email" value="<?php echo @$email;?>" />
                        <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>


                    </form>
                </div>
              
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Frontiers Meetings
            </div>
            <div class="col-md-6 text-right">
               <small>© <?php echo @date("Y");?></small>
            </div>
        </div>
    </div>

</body>
 <script src="<?php echo base_url()?>externals/js/jquery-2.1.1.js"></script>
<script>
	function checkPassword()
	{
		var pwd=$("#password").val();
		var cnfpwd=$("#cnfpassword").val();
		if(pwd !== cnfpwd)
		{
			$("#password").attr("placeholder","Passwords did not match");
			$("#password").css({"border":"1px solid #ff0000"});
			$("#password").val("");
			$("#cnfpassword").val("");
			$("#cnfpassword").css({"border":"1px solid #ff0000"});
		}
	}
</script>
