<?php
$jsonObj=@json_decode($jsonObj);
?>
<!--Reset Password Modal Starts-->  
<div class="modal fade login-modal" id="candjobdetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog login-dailog rec-job-details" role="document">
		<div class="modal-content login-content ">
			<div class="modal-header login-head">
				<button type="button" class="close resetclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title login-title" id="myModalLabel">Candidate Details</h4>
			</div>
			<div class="modal-body login-body" id="candjob_details">
				
				
			</div>
		</div>
	</div>
</div>
<!--END Forgot OF MODAL-->
<footer class="hidden-xs">
	<div class="col-sm-12 col-md-12 col-xs-12  foot">
		<div class="row nopadding">
			<div class="foot1">	
				<div class="nopadding">				
					<div class="col-sm-4 col-md-4 col-xs-12">
						<div class="site">
							<h3 class="job">Company</h3>	
							<ul>
								<li><a href="<?php echo base_url(); ?>about-us">About Us</a></li>
								<!-- <li><a href="<?php echo base_url(); ?>blog">Blog</a></li> -->
								<li><a href="<?php echo base_url(); ?>faqs-candidates">FAQ's For Candidates</a></li>
								<li><a href="<?php echo base_url(); ?>faqs-recruiters">FAQ's For Recruiters</a></li>
								<li><a href="<?php echo base_url(); ?>feedback">Feedback</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-xs-12">
						<div class="site">
							<h3 class="job">Legals</h3>	
							<ul>
								
								<li><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
								<li><a href="<?php echo base_url(); ?>terms-conditions">Terms And Conditions</a></li>
								<li><a>CIN: U74999TG2020PTC139285</a></li>							
							</ul>
							
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-xs-12">
						<div class="touch">
							<h3 class="site-h3">ADDRESS</h3>
							<ul>
								<?php 
								if(@$jsonObj->address[0]->company_address != '')
								{ 
								?>
									<li class="session3"><a href="#">
										<P><?php echo @$jsonObj->address[0]->company_address; ?></P></a>
									</li>
								<?php 
								}
								if(@$jsonObj->address[0]->company_phone != '')
								{
								?>
									<li class="session4"><a href="tel:<?php echo @$jsonObj->address[0]->company_phone; ?>"><?php echo @$jsonObj->address[0]->company_phone; ?></a> </li>
								<?php 
								}
								if(@$jsonObj->address[0]->company_email != '')
								{
								?>
									<li class="session5"><a href="mailto:<?php echo @$jsonObj->address[0]->company_email; ?>"><?php echo @$jsonObj->address[0]->company_email; ?></a></li>
								<?php 
								}
								?>	
									
							</ul>
							<h4 class="get1  hidden-sm">Follow Us On</h4>
							<ul class="touch1">
								<?php 
								if(@$jsonObj->sociallinks[0]->facebook_link != '')
								{ 
								?>
									<li class="media-left">
										<a href="<?php echo @$jsonObj->sociallinks[0]->facebook_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/facebook.png" class="img-responsive" alt="img123">
										</a>
									</li>
								<?php 
								}
								if(@$jsonObj->sociallinks[0]->google_link != '')
								{ 
								?>
									<li class="media-left">
										<a href="<?php echo @$jsonObj->sociallinks[0]->google_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/instagram.png" class="img-responsive" alt="img145">
										</a>
									</li>
								<?php 
								}
								if(@$jsonObj->sociallinks[0]->linkdin_link != '')
								{ 
								?>
									<li class="media-left">
										<a href="<?php echo @$jsonObj->sociallinks[0]->linkdin_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/linkedin.png" class="img-responsive" alt="img167">
										</a>
									</li>
								<?php 
								}
								if(@$jsonObj->sociallinks[0]->twitter_link != '')
								{ 
								?>
									<li class="media-left"> 
										<a href="<?php echo @$jsonObj->sociallinks[0]->twitter_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/twittr.png" class="img-responsive" alt="img167">
										</a>
									</li>
								<?php 
								}
								if(@$jsonObj->sociallinks[0]->youtube_link != '')
								{ 
								?>
									<li class="media-left"> 
										<a href="<?php echo @$jsonObj->sociallinks[0]->youtube_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/youtube.png" class="img-responsive" alt="img167">
										</a>
									</li>
								<?php 
								}
								?>
							</ul>	
						</div>	
					</div>
				</div>					
			</div>
		</div>
	</div>	
</footer>
<!-- Below Three divs and section from header -->
			</div>
		</div>
	</div>
</section>
<!-- Above Three divs and section from header -->
<footer class="hidden-sm hidden-md hidden-lg">
	<div class="col-sm-12 col-md-12 col-xs-12  foot">
		<div class="row nopadding">
			<div class="foot1">	
				<div class="nopadding">				
					<div class="col-sm-4 col-md-4 col-xs-12">
						<div class="site">
							<h3 class="job">Company</h3>	
							<ul>
								<li><a href="<?php echo base_url(); ?>about-us">About Us</a></li>
								<!-- <li><a href="<?php echo base_url(); ?>blog">Blog</a></li> -->
								<li><a href="<?php echo base_url(); ?>faqs-candidates">FAQ's For Candidates</a></li>
								<li><a href="<?php echo base_url(); ?>faqs-recruiters">FAQ's For Recruiters</a></li>
								<li><a href="<?php echo base_url(); ?>feedback">Feedback</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-xs-12">
						<div class="site">
							<h3 class="job">Legals</h3>	
							<ul>
								
								<li><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
								<li><a href="<?php echo base_url(); ?>terms-conditions">Terms And Conditions</a></li>
								<li><a href="#0">CIN: U74999TG2020PTC139285</a></li>							
							</ul>
							
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-xs-12">
						<div class="touch">
							<h3 class="site-h3">ADDRESS</h3>
							<ul>
								<?php 
								if(@$jsonObj->address[0]->company_address != '')
								{ 
								?>
									<li class="session3"><a href="#">
										<P><?php echo @$jsonObj->address[0]->company_address; ?></P></a>
									</li>
								<?php 
								}
								if(@$jsonObj->address[0]->company_phone != '')
								{
								?>
									<li class="session4"><a href="tel:<?php echo @$jsonObj->address[0]->company_phone; ?>"><?php echo @$jsonObj->address[0]->company_phone; ?></a> </li>
								<?php 
								}
								if(@$jsonObj->address[0]->company_email != '')
								{
								?>
									<li class="session5"><a href="mailto:<?php echo @$jsonObj->address[0]->company_email; ?>"><?php echo @$jsonObj->address[0]->company_email; ?></a></li>
								<?php 
								}
								?>	
									
							</ul>
							<h4 class="get1  hidden-sm">Follow Us On</h4>
							<ul class="touch1">
								<?php 
								if(@$jsonObj->sociallinks[0]->facebook_link != '')
								{ 
								?>
									<li class="media-left">
										<a href="<?php echo @$jsonObj->sociallinks[0]->facebook_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/facebook.png" class="img-responsive" alt="img123">
										</a>
									</li>
								<?php 
								}
								if(@$jsonObj->sociallinks[0]->google_link != '')
								{ 
								?>
									<li class="media-left">
										<a href="<?php echo @$jsonObj->sociallinks[0]->google_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/instagram.png" class="img-responsive" alt="img145">
										</a>
									</li>
								<?php 
								}
								if(@$jsonObj->sociallinks[0]->linkdin_link != '')
								{ 
								?>
									<li class="media-left">
										<a href="<?php echo @$jsonObj->sociallinks[0]->linkdin_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/linkedin.png" class="img-responsive" alt="img167">
										</a>
									</li>
								<?php 
								}
								if(@$jsonObj->sociallinks[0]->twitter_link != '')
								{ 
								?>
									<li class="media-left"> 
										<a href="<?php echo @$jsonObj->sociallinks[0]->twitter_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/twittr.png" class="img-responsive" alt="img167">
										</a>
									</li>
								<?php 
								}
								if(@$jsonObj->sociallinks[0]->youtube_link != '')
								{ 
								?>
									<li class="media-left"> 
										<a href="<?php echo @$jsonObj->sociallinks[0]->youtube_link; ?>" target="_blank">
											<img src="<?php echo base_url() ?>includes/img/youtube.png" class="img-responsive" alt="img167">
										</a>
									</li>
								<?php 
								}
								?>
							</ul>	
						</div>	
					</div>
				</div>					
			</div>
		</div>
	</div>	
</footer>
<!--Reset Password Modal Starts-->  
<div class="modal fade login-modal" id="resetpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog login-dailog" role="document">
		<div class="modal-content login-content">
			<div class="modal-header login-head">
				<!-- <button type="button" class="close resetclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
				<h4 class="modal-title login-title" id="myModalLabel">Reset Password</h4>
			</div>
			<form class="form-horizontal login-frm" name="resetForm" id="resetForm" method="POST" action="<?php echo base_url(); ?>index.php/login/updatePassword" autocomplete="off">
				<div class="modal-body login-body">
					<?php
					if(@$this->session->userdata('resetfail') != '')
					{
					?>
					<div class="alert alert-success custalert">
					<button aria-hidden="true" data-dismiss="alert" class="close custclose" type="button">×</button>
					<?php
					echo @$this->session->userdata('resetfail');
					@$this->session->unset_userdata('resetfail');

					?>
					</div>
					<?php
					}
					?>
					<div class="forgotMsg" id="forgotMsg"></div>
					<div class="form-group login-grp">
						<input type="text" class="form-control login-ctrl" id="forgot_otp" name="forgot_otp" placeholder="Please Enter Reference Code" autocomplete="off">
					</div>
					<div class="form-group login-grp">
						<input type="password" class="form-control login-ctrl" id="reset_pwd" name="reset_pwd" placeholder="Please Enter New Password" autocomplete="off">
					</div>
					<div class="form-group login-grp">
						<input type="password" class="form-control login-ctrl" id="reset_cnpwd" name="reset_cnpwd" placeholder="Please Confirm The Password" autocomplete="off">
					</div>
				</div>
				<div class="modal-footer login-foot register-foot">
					<input type="hidden" class="form-control cart-form" id="resetEmail" name="resetEmail" value="<?php echo @$this->session->userdata('resetEmail')?>" required />
					<button type="submit" class="btn btn-primary reg-popbtn">Submit</button>
					<ul class="login-list">
						<li><a href="<?php echo base_url(); ?>login">Remember Password? Login here</a></li>
					</ul>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END Forgot OF MODAL-->
<?php 
$sercities = $this->db->query("select * from cities where status =1 ");
if($sercities->num_rows() > 0)
{
	$sercitieslist = $sercities->result();
	$cityNames = array();
	if(@sizeOf($sercitieslist) > 0)
	{
		for($a=0;$a<@sizeOf($sercitieslist);$a++)
		{
			$cityNames[] = $sercitieslist[$a]->city_name;
		}
	}
	$cityNames = @array_values(array_unique( $cityNames, SORT_REGULAR ) );
	$cityInfo = json_encode($cityNames);
}
$catNamesArray = array();
$catinfo = $this->db->query("select * from categories where status =1 AND parent_id = 6");
if($catinfo->num_rows() > 0)
{
	$catinfolist = $catinfo->result();
	$catNamesArray = array();
	if(@sizeOf($catinfolist) > 0)
	{
		for($c=0;$c<@sizeOf($catinfolist);$c++)
		{
			$catNamesArray[] = $catinfolist[$c]->cat_name;
		}
	}
	$catNamesArray = @array_values(array_unique( $catNamesArray, SORT_REGULAR ) );
}

$skillsinfo = $this->db->query("select * from job_skills where status =1");
if($skillsinfo->num_rows() > 0)
{
	$skillslist = $skillsinfo->result();
	if(@sizeOf($skillslist) > 0)
	{
		for($s=0;$s<@sizeOf($skillslist);$s++)
		{
			$catNamesArray[] = $skillslist[$s]->skill_name;
		}
	}
	$catNamesArray = @array_values(array_unique( $catNamesArray, SORT_REGULAR ) );
	
}
$catnamesinfo = json_encode($catNamesArray);
?>

<script src="<?php echo base_url() ?>includes/js/owl.carousel.js"></script>
<script src="<?php echo base_url() ?>includes/js/main.js"></script>
<script src="<?php echo base_url() ?>includes/js/jquery.validate.js"></script>
<script src="<?php echo base_url() ?>includes/js/jobportal.js"></script>
<script src="<?php echo base_url();?>includes/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>includes/js/jquery-ui.js"></script>
<script>
$(document).ready(function(){
	<?php
	if(@$this->session->userdata("rst") == 1)
	{
	?>
		$("#resetpassword").modal('show');
	<?php
		@$this->session->unset_userdata("rst");
	}
	?>
});
$('.loginul').click(function(){
	var oVal = $(this).attr('id');
	if(oVal != '')
	{
		$('.help-inline').css('display',"none");
		$('.loginul').removeClass('active');
		$('.loginul_'+oVal).addClass('active');
		$('#oVal').val('');
		$('#oVal').val(oVal);
		if(oVal == 5)
		{
			$('#regUrl').val(5);
			$('#loginbtn').html('');
			$('#loginbtn').html('Login as Recruiters');
			$("#login_newimg").attr("src","<?php echo base_url(); ?>includes/img/login_vendor.jpg");
		}
		else 
		{
			$('#regUrl').val(3);
			$('#loginbtn').html('');
			$('#loginbtn').html('Login as Login as Jobseeker');
			$("#login_newimg").attr("src","<?php echo base_url(); ?>includes/img/login_recruiter.jpg");
		}
	}
});
$("#v_state").change(function(){
	var stateId = $(this).val();
	if (stateId != "")
	{
    	var post_url = baseurl+'home/getCitieslist/' +stateId;
    	$.ajax({
			type: "POST",
			url: post_url,
			success: function(citiesInfo)
			{
				var toAppend = '';
				$('#v_city').empty();
				$('#v_city').show();
				if((citiesInfo.length) > 0)
				{
					
					for(i=0; i<citiesInfo.length; i++) 
					{
						$('#v_city').append("<option value="+citiesInfo[i].id+">"+citiesInfo[i].city_name+"</option>");
					}
				}
				else 
				{
					var opts = $('<option value="">Select City</option>');
					$('#v_city').html(opts);
				}
			} 
   		}); 
	} 
	else 
	{
		var opts = $('<option value="">Select City</option>');
		$('#v_city').html(opts);
	}
});
$(document).on('click', '.alrdyliked_jobs', function(){
	alert("Already Liked This Job");
});
$(document).on('click', '.loginportal', function(){
	alert("Please Login Into The Website");
});
$(document).on('click', '.liked_jobs', function(){
	var jobId = $(this).attr('data-id');
	var dataType = $(this).attr('data-type');
	if(jobId != '')
	{
		var urlpath = baseurl+"index.php/home/checkLikedJob/"+jobId+"/"+dataType;
	    $.ajax({

	      type: "POST",

	      url: urlpath,

	      success:function(msg)
	      {

	      	if(msg == 'success')
	      	{
	      		$("#like_"+jobId).attr('src',"<?php echo base_url(); ?>includes/images/liked.png");
	      		alert("Successfully Liked The Job");

	      	}
	      	else if(msg == 'exsit')
	      	{
	      		alert("Already Liked This Job");
	      	}
	      	else
	      	{
	      		alert("Something Went Wrong. Please Try Again Once");
	      	}
	      }

	    });
	}
});

$('#v_city').change(function(){
	var stateId = $('#v_state').val();
	var cityId = $(this).val();
	if(stateId != '' && cityId != '')
	{
		$.ajax({
	      type:"POST",
	      url: baseurl+"home/getLocationslist/"+stateId+"/"+cityId,
	      data:"segmentid="+stateId,
	      async:false,
	      success:function(citiesInfo)
	      {
	     
	          var toAppend = '';
				$('#v_location').empty();
				$('#v_location').show();
				if((citiesInfo.length) > 0)
				{
					for(i=0; i<citiesInfo.length; i++) 
					{
						$('#v_location').append("<option value="+citiesInfo[i].location_name+">"+citiesInfo[i].location_name+"</option>");
					}
				}
				else 
				{
					var opts = $('<option value="">Select Location</option>');
					$('#v_location').html(opts);
				}
	      
	      }
	      
	    });
    }
});
$('.pwdshow').click(function(){
	$('#loginpassword').attr('type',"text");
	$('.pwdshow').hide();
	$('.pwdhide').show();
});
$('.pwdhide').click(function(){
	$('#loginpassword').attr('type',"password");
	$('.pwdhide').hide();
	$('.pwdshow').show();
});

$('.student-pwd-hide').click(function(){
	$('#js_password').attr('type',"text");
	$('.student-pwd-hide').hide();
	$('.student-pwd-show').show();
});

$('.student-pwd-show').click(function(){
	$('#js_password').attr('type',"password");
	$('.student-pwd-show').hide();
	$('.student-pwd-hide').show();
});

$('.rec-pwd-hide').click(function(){
	$('#v_password').attr('type',"text");
	$('.rec-pwd-hide').hide();
	$('.rec-pwd-show').show();
});

$('.rec-pwd-show').click(function(){
	$('#v_password').attr('type',"password");
	$('.rec-pwd-show').hide();
	$('.rec-pwd-hide').show();
});

(function($){
	$(window).on("load",function(){
		$(".filters").mCustomScrollbar({
			theme:"dark-3"
		});
	});

$(window).on("load",function(){
	$(".recdet").mCustomScrollbar({
		theme:"dark-3"
	});
});

})(jQuery);
$("#searchcheck").click(function(){
	alert("For Results Please Login Into The Website");
});
<?php 
if(@$jsonObj->searchpage == 1)
{
	if(@$cityInfo != '')
	{	
	?>
		$( "#location" ).autocomplete({
			source:<?php echo @$cityInfo;?>,
			minLength:1
		});
		$('#ui-id-1').on('click', 'li>div', function () {
		    $('#location').val($(this).text());
		    $('.ui-helper-hidden-accessible').html('');
		});
	<?php
	}	
	if(@$catnamesinfo != '')
	{	
	?>
		$( "#skillnames" ).autocomplete({
			source:<?php echo @$catnamesinfo;?>,
			minLength:1
		});
		$('#ui-id-2').on('click', 'li>div', function () {
		    $('#skillnames').val($(this).text());
		    $('.ui-helper-hidden-accessible').html('');
		});
	<?php
	}	
}
?>

$(document).on('click', '.jobdetails', function(){
	var rowId = $(this).attr('id');
	if(rowId != '')
	{
		$.ajax({
			type:"POST",
			url: baseurl+"jobseeker/getJobDetails/"+rowId,
			data:"rowId="+rowId,
			async:false,
			success:function(response)
			{
				$("#jobdetails").modal('show');
				$("#job_details").html('');
				$("#job_details").html(response);
			}

		});
	}
	else
	{
		alert("Please Try Again");
	}
});
$("#buycredits").click(function(){
	alert("For Purchase Credits Please Login Into The Website");
});
$("#buy-credits").click(function(){
	$('#buycrd').show();
});
$("#candpersonalinfo").validate({
    rules:{
       v_name:{
          required:true,  
        },
        mobile:{
			required:true,
			number:true,
			maxlength:10,
			minlength:10,
        },
        user_gender:{
          required:true,
        },
        date_of_birth:{
          required:true,
        },
    },

    messages:{
      js_name:{
        required:"Please Enter Your Name",
      },
      mobile:{
        required:"Please Enter Your Phone Number",
      },
      user_gender:{
        required:"Please Select Gender",
      },
      date_of_birth:{

        required:"Please Select Date Of Birth",
      }, 
     profile_pic:{
        required:"Please Select Profile Picture",
      }, 
    },

    errorClass: "help-inline",

    errorElement: "span",

    highlight:function(element, errorClass, validClass) {

      $(element).parents('.control-group').addClass('error');
    },

    unhighlight: function(element, errorClass, validClass) {

      $(element).parents('.control-group').removeClass('error');
    }, 
}); 

$("#recpersonalinfo").validate({
    rules:{
       v_name:{
          required:true,  
        },
        v_businessname:{
          required:true,  
        },
        mobile:{
          required:true,
          number:true,
          maxlength:10,
          minlength:10,
        },
        user_gender:{
          required:true,
        },
        date_of_birth:{
          required:true,
        },
        v_state:{
          required:true,  
        },
        v_city:{
          required:true,  
        },
        v_location:{
          required:true,  
        },
        v_zipcode:{
          required:true,
          number:true,
          maxlength:6,
          minlength:6,  
        },
        v_address:{
          required:true,  
        },
    },

    messages:{
      js_name:{
        required:"Please Enter Your Name",
      },
      v_businessname:{
        required:"Please Enter Business Name",
      },
      mobile:{
        required:"Please Enter Your Phone Number",
      },
      user_gender:{
        required:"Please Select Gender",
      },
      date_of_birth:{

        required:"Please Select Date Of Birth",
      }, 
     profile_pic:{
        required:"Please Select Profile Picture",
      }, 
      v_state:{
        required:"Please Select State/UN",
      },
       v_city:{
        required:"Please Select City/Town",
      },
       v_location:{
        required:"Please Select Location/Area",
      },
       v_zipcode:{
        required:"Please Enter Pincode",
      },
       v_address:{
        required:"Please Enter Address",
      },
    },

    errorClass: "help-inline",

    errorElement: "span",

    highlight:function(element, errorClass, validClass) {

      $(element).parents('.control-group').addClass('error');
    },

    unhighlight: function(element, errorClass, validClass) {

      $(element).parents('.control-group').removeClass('error');
    }, 
}); 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(function () {
	$("#date_of_birth").datepicker({ 
	    autoclose: true, 
	    format: "mm-dd-yyyy",
	    todayHighlight: true,
	      endDate: '+1d',
	});
});
$(document).on('click', '.deleteConfirm', function(){
	var deleteCnf = confirm("Are You Sure ? Do You Want To Delete This Post ?");
	if(deleteCnf == true)
	{
		return true;
	}
	else
	{
		return false;
	}

});
$(document).on('click', '.deleteLiked', function(){
	var deleteCnf = confirm("Are You Sure ? Do You Want To Unlike The Post ?");
	if(deleteCnf == true)
	{
		return true;
	}
	else
	{
		return false;
	}

});
$(document).on('click', '.editConfirm', function(){
	var deleteCnf = confirm("Are You Sure ? Edit is allowed once per post.");
	if(deleteCnf == true)
	{
		return true;
	}
	else
	{
		return false;
	}

});

$(document).on('click', '.recjobdetails', function(){
	var rowId = $(this).attr('id');
	if(rowId != '')
	{
		$.ajax({
			type:"POST",
			url: baseurl+"recruiter/getCandidateDetails/"+rowId,
			data:"rowId="+rowId,
			async:false,
			success:function(response)
			{
				$("#candjobdetails").modal('show');
				$("#candjob_details").html('');
				$("#candjob_details").html(response);
			}

		});
	}
	else
	{
		alert("Please Try Again");
	}
});

    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.in").each(function(){
        	$(this).siblings(".panel-heading").find(".glyphicon").addClass("rotate");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).parent().find(".glyphicon").addClass("rotate");
        }).on('hide.bs.collapse', function(){
        	$(this).parent().find(".glyphicon").removeClass("rotate");
        });
    });

</script>
<script>
function openNavs() {

	document.getElementById("mySidenav").style.width = "100%";
	document.getElementById("mySidenav").style.height = "500px";
}

function closeNavs() {
	document.getElementById("mySidenav").style.width = "0";
}
if ($('.chosen-container').length > 0) {
      $('.chosen-container').on('touchstart', function(e){
        e.stopPropagation(); e.preventDefault();
        // Trigger the mousedown event.
        $(this).trigger('mousedown');
      });
    }
</script>
 </body>
</html>
 
 
 
 
 
 
 
 
 
 
 
 
 