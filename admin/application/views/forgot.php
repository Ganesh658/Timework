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
                <h2 class="font-bold">Forgot Password</h2>

                <p>
                    Enter Your Email To Reset Your Password.
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
                    <form class="m-t" role="form" method="POST" action="<?php echo base_url()?>index.php/home/forgot">
						<div id="forgotmsg"></div>
                        <div class="form-group">
                            <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" id="forgotemail" onblur="forgotpwd(this.value)" required/>
                        </div>
                        
                        <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>

                         <a href="<?php echo base_url();?>">
                            <small>Back To Login?</small>
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
 <script src="<?php echo base_url()?>externals/js/jquery-2.1.1.js"></script>
<script>
function forgotpwd(oVal){
	
		var baseurl = "<?php echo base_url();?>";
	$.ajax({
		type:"POST",
		url:baseurl+"index.php/home/forgotcheck", 
		data: '&forgotemail='+oVal,
		async:false,
		success:function(resp)
		{
			if(resp == 0){
			$('#forgotemail').val('');	
			$('#forgotmsg').html('<p style="color: #fff;background: #C52A2A;padding: 10px;border-radius: 6px !important;">Invalid Email. Please Enter Valid Email</p>');
			}
			
		}
	});
}
</script>
</html>