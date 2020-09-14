<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-11">
		<h2>Edit Recruiters</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url()?>index.php/home/users/<?php echo @$usertype; ?>">Recruiters</a>
			</li>
			<li class="active">
				<strong>Edit Recruiters</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-1 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/users/<?php echo @$usertype; ?>" class="btn btn-w-m btn-default pull-right">Back to List</a>
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-lg-7">
					<div class="ibox">
						
						<div class="ibox-content">
							
							<form method="POST" id="adminform" action="<?php echo base_url()?>index.php/home/updateusers" class="form-horizontal" enctype="multipart/form-data">
								<div class="form-group">
									<label class="col-sm-4 control-label">First Name</label>
									<div class="col-sm-8">
										<input type="text" name="firstname" id="firstname" class="form-control" required value="<?php echo @$info[0]->firstname; ?>" />
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<!-- <div class="form-group">
									<label class="col-sm-4 control-label">Last Name</label>
									<div class="col-sm-8">
										<input type="text" name="lastname" id="lastname" class="form-control" required value="<?php echo @$info[0]->firstname; ?>"/>
									</div>
								</div>
								<div class="hr-line-dashed"></div> -->
								<div class="form-group">
									<label class="col-sm-4 control-label">Email</label>
									<div class="col-sm-8">
										<input type="email" name="email" id="email" class="form-control" required onblur="checkEmail()" value="<?php echo @$info[0]->email; ?>"/>
										<div class="regMsg"></div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Mobile Number</label>
									<div class="col-sm-8">
										<input type="text" name="mobile" id="mobile" class="form-control" required onblur="checkMobile()" value="<?php echo @$info[0]->mobile; ?>"/>
										<div class="regmobileMsg"></div>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Password</label>
									<div class="col-sm-5">
										<input type="text" name="password" id="password" class="form-control" required value="<?php echo @$info[0]->shw_pass; ?>"/>
									</div>
									<div class="col-sm-3">
										<button type="button" name="gCoupon" id="gCoupon" class="btn btn-success">Generate</button>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<input type="hidden" name="usertype" id="usertype" class="form-control" required value="<?php echo @$usertype; ?>" />
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$bannerid;?>">
										<input type="hidden" name="org_email" id="org_email" value="<?php echo @$info[0]->email; ?>">
										<input type="hidden" name="org_mobile" id="org_mobile" value="<?php echo @$info[0]->mobile; ?>">
										<button class="btn btn-white" type="reset">Reset</button>
										<button class="btn btn-primary" type="submit">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function checkEmail()
{
	var email = $('#email').val();
	var org_email = $('#org_email').val();
	if(email != org_email)
	{
		if(email != '')
		{
			var urlpath = '<?php echo base_url(); ?>index.php/home/checkEmailExist';
			$.ajax({
				type: "POST",
				url: urlpath,
				data: '&email='+email,
				success:function(msg)
				{
					if(msg == 'success')
					{
						$('.regMsg').html('');
					}
					else if(msg == 'exist')
					{
						$('.regMsg').html('');
						$('.regMsg').html('<span style="color:red;font-size:14px;">Email id already Exist. Please use another Email id</span>');
						$('#email').val('');
					}
					else
					{
						$('.regMsg').html('');
						$('#email').val('');
					}
				}

			});
		}
		else
		{
			$('#email').val(org_email);
		}	
	}
	else
	{
		$('#email').val(org_email);
	}
}	
function checkMobile()
{
	var mobile = $('#mobile').val();
	var org_mobile = $('#org_mobile').val();
	if(mobile != org_mobile)
	{
		if(mobile != '')
		{
			var urlpath = '<?php echo base_url(); ?>index.php/home/checkMobileExist';
			$.ajax({
				type: "POST",
				url: urlpath,
				data: '&mobile='+mobile,
				success:function(msg)
				{
					if(msg == 'success')
					{
						$('.regmobileMsg').html('');
					}
					else if(msg == 'exist')
					{
						$('.regmobileMsg').html('');
						$('.regmobileMsg').html('<span style="color:red;font-size:14px;">Mobile Number already Exist. Please use another Mobile Number</span>');
						$('#mobile').val('');
					}
					else
					{
						$('.regmobileMsg').html('');
						$('#mobile').val('');
					}
				}

			});
		}
		else
		{
			$('#mobile').val('');
		}
	}
	else
	{
		$('#mobile').val(org_mobile);
	}
}
$(document).ready(function() {
    $("#mobile").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
$("#gCoupon").unbind().on("click",function(){
		$.post('<?php echo base_url() ?>index.php/home/random_code/8',function(data,success){
			if(data != '')
			{
				$("#password").val(data);
			}
		});
	});
</script>