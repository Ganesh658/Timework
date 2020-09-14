<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sql');
		@date_default_timezone_set('Asia/Kolkata');
	}
	public function index()
	{
		if(@$this->session->userdata("is_logged_in") =='')
		{
			
			/*Header Coding Starts*/
			$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$banners = $this->sql->getTableRowDataOrder("banners",array("status"=>1,"page_type"=>1),"id","DESC");
					/*index Page Coding End*/

			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
			
			$json = array(
				"seoContent" => @$seoContent,
				"googelCode" => @$googelCode,
				"banners" => @$banners,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"homeActive" => 'rcpr',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('home/header',$data);
			$this->load->view('home/login',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function registration($rcType=null)
	{
		if(@$this->session->userdata("is_logged_in") =='')
		{
			/*Header Coding Starts*/
			$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$states = $this->sql->getTableRowDataOrder("states",array("status"=>1),"state_name","ASC");
			/*index Page Coding End*/

			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
			
			$json = array(
				"seoContent" => @$seoContent,
				"googelCode" => @$googelCode,
				"states" => @$states,
				"rcType" => @$rcType,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"homeActive" => 'rcpr',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('home/header',$data);
			$this->load->view('home/registration',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function forgot()
	{
		if(@$this->session->userdata("is_logged_in") =='')
		{
			$json = array(
				
				"homeActive" => 'home',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('home/header',$data);
			$this->load->view('home/forgot-password',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function generate_random_password($length = 10) {
		//$alphabets = range('A','Z');
		$numbers = range('1','9');
		//$additional_characters = array('_','.');
		$final_array = array_merge($numbers);
			 
		$password = '';
	  
		while($length--) {
		  $key = array_rand($final_array);
		  $password .= $final_array[$key];
		}
	  
		return $password;
	}
	public function saveJobSeekerInfo()
	{
		if(@$this->session->userdata("is_logged_in") =='')
		{
			@$set = $credits_amount = $regamt = $rfrdAmt = 0;
			$table = "users";
			$username = $this->input->post("js_name");
			$email = $this->input->post("js_email");
			$phone = $this->input->post("js_mobile");
			$password = $this->input->post("js_password");
			$usertype = 3;
			@date_default_timezone_set('Asia/Kolkata');
			
			$params=array(
				"firstname" => @$username,
				"email" => @$email,
				"password" => @SHA1($password),
				"shw_pass" => @$password,
				"mobile" => @$phone,
				"usertype" => @$usertype,
				"referral_code" => @$this->getReferralCode(5),
				"status" => 0,
				"emailAct" => 0,
				"is_online" => 1,
				"regDate" => @date("Y-m-d H:i:s"),
			);
			if($username != '' && $email != '' && $phone != '' && $password != '')
			{
				$emailCheck = $this->sql->existemail_orNot($email);

				if($emailCheck != 1)
				{
					$mobileCheck = $this->sql->existmobile_orNot($phone);

					if($mobileCheck != 1)
					{
						$store = $this->sql->storeItems($table,$params);
						
						if($store > 0)
						{
							$js_referralcode = $this->input->post("js_referralcode");
							if(@$js_referralcode != '')
							{
								$checkRefCode = $this->sql->getTableRowDataOrder("users",array("referral_code"=>$js_referralcode),"id","ASC");
								if(@sizeOf($checkRefCode) > 0)
								{
									$rparams=array(
										"main_user_id" => @$checkRefCode[0]->id,
										"userid" => @$store,
										"created_date" => @date("Y-m-d H:i:s"),
									);
									$this->sql->storeItems('users_refer',$rparams);
								}
							}
							$unique_id= $this->generate_random_password(7)."".@$store;
							$paramsUp = array("unique_id"=>$unique_id);
							$update = $this->sql->updateItems("users",$paramsUp,array("id" => $store));

							@$set = 1;
							
							$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
							if(@sizeOf($address)> 0)
							{
								$cEmail = @$address[0]->company_email;
								$eEmail = @str_replace("=","_",@base64_encode(@$email));
								$subject="Welcome to JOB PORTAL!  Activate your account now";
								echo $message = "Dear ".@$username."<br><br>Your Registration is Succesfully Completed. Please Click On Below Link for Activate Your Account<br><br><a href='".base_url()."index.php/login/activation/".@$eEmail."' style='background:#2761AB;color:#fff;padding:5px 10px;margin:10px 0px;text-decoration:none;'>Yes, this is my email address</a><br><br>Please follow the below Login Credentails<br><br>Email Address: <b>".$email."</b><br><br>Password: <b>".$password."</b><br><br><a href=".base_url()." target='_blank'><img src='".base_url()."includes/img/logo.png'></a><br><br><hr><br><br/>Thanks, <br>JOB PORTAL Team.</strong>";
								$headers = "MIME-Version: 1.0" . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

								$headers .= 'From: "'.@$cEmail.'"' . "\r\n";

								$to = @$email;
								if(@$cEmail != '')
								{
									@mail($to,$subject,$message,$headers);
								}
								
								$this->session->set_userdata(array("logsuccess" => "Thank you for register with us. Please Check Your Mail For Activation","log" => 1));
							}
							
						}
						else
						{
							$this->session->set_userdata(array("regfail" => "Registration Failed. Please Try Again Once","regpop" => 1));
						}
					}
					else
					{
						$this->session->set_userdata(array("regfail" => "Mobile Number already Exist. Please use another Mobile Number","regpop" => 1));
					}
				}
				else
				{
					$this->session->set_userdata(array("regfail" => "Email id already Exist. Please use another Email id","regpop" => 1));
				}
			}
			else
			{
				$this->session->set_userdata(array("regfail" => "Registration Failed. Please Try Again Once","regpop" => 1));
				
			}
			if(@$set == 1)
			{
				redirect(base_url()."login");
			}
			else
			{
				redirect(base_url()."candidate-registration");
			}
			
		}
		else
		{
			redirect(base_url());
		}

	}
	public function saveVendorInfo()
	{
		if(@$this->session->userdata("is_logged_in") =='')
		{
			@$set = 0;
			$table = "users";
			$username = $this->input->post("v_name");
			$email = $this->input->post("v_email");
			$phone = $this->input->post("v_mobile");
			$password = $this->input->post("v_password");
			
			@date_default_timezone_set('Asia/Kolkata');
			$params=array(
				"firstname" => @$username,
				"rec_type" => @$this->input->post("rec_type"),
				"business_name" => @$this->input->post("v_businessname"),
				"address" => @$this->input->post("v_address"),
				"state_id" => @$this->input->post("v_state"),
				"city_id" => @$this->input->post("v_city"),
				"area_info" => @$this->input->post("v_area"),
				"city_zipcode" => @$this->input->post("v_zipcode"),
				"referral_code" => @$this->getReferralCode(5),
				"email" => @$email,
				"mobile" => @$phone,
				"password" => @SHA1($password),
				"shw_pass" => @$password,
				"usertype" => 5,
				"status" => 0,
				"emailAct" => 0,
				"is_online" => 1,
				"regDate" => @date("Y-m-d H:i:s"),
			);
			if($username != '' && $email != '' && $phone != '' && $password != '')
			{
				$emailCheck = $this->sql->existemail_orNot($email);

				if($emailCheck != 1)
				{
					$mobileCheck = $this->sql->existmobile_orNot($phone);

					if($mobileCheck != 1)
					{
						$store = $this->sql->storeItems($table,$params);

						if($store > 0)
						{
							$v_referralcode = $this->input->post("v_referralcode");
							if(@$v_referralcode != '')
							{
								$checkRefCode = $this->sql->getTableRowDataOrder("users",array("referral_code"=>$v_referralcode),"id","ASC");
								if(@sizeOf($checkRefCode) > 0)
								{
									$rparams=array(
										"main_user_id" => @$checkRefCode[0]->id,
										"userid" => @$store,
										"created_date" => @date("Y-m-d H:i:s"),
									);
									$this->sql->storeItems('users_refer',$rparams);
								}
							}
							$unique_id= $this->generate_random_password(7)."".@$store;
							$paramsUp = array("unique_id"=>$unique_id);
							$update = $this->sql->updateItems("users",$paramsUp,array("id" => $store));

							@$set = 1;
							$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
							if(@sizeOf($address)> 0)
							{
								$cEmail = @$address[0]->company_email;
								$eEmail = @str_replace("=","_",@base64_encode(@$email));
								$subject="Welcome to JOB PORTAL!  Activate your account now";
								echo $message = "Dear ".@$username."<br><br>Your Registration is Succesfully Completed. Please Click On Below Link for Activate Your Account<br><br><a href='".base_url()."index.php/login/activation/".@$eEmail."' style='background:#2761AB;color:#fff;padding:5px 10px;margin:10px 0px;text-decoration:none;'>Yes, this is my email address</a><br><br>Please follow the below Login Credentails<br><br>Email Address: <b>".$email."</b><br><br>Password: <b>".$password."</b><br><br><a href=".base_url()." target='_blank'><img src='".base_url()."includes/img/logo.png'></a><br><br><hr><br><br/>Thanks, <br>JOB PORTAL Team.</strong>";
								$headers = "MIME-Version: 1.0" . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

								$headers .= 'From: "'.@$cEmail.'"' . "\r\n";

								$to = @$email;
								if(@$cEmail != '')
								{
									@mail($to,$subject,$message,$headers);
								}
								
								$this->session->set_userdata(array("logsuccess" => "Thank you for register with us. Please Check Your Mail For Activation","log" => 1));
							}
							
						}
						else
						{
							$this->session->set_userdata(array("regfail" => "Registration Failed. Please Try Again Once","regpop" => 1));
						}
					}
					else
					{
						$this->session->set_userdata(array("regfail" => "Mobile Number already Exist. Please use another Mobile Number","regpop" => 1));
					}
				}
				else
				{
					$this->session->set_userdata(array("regfail" => "Email id already Exist. Please use another Email id","regpop" => 1));
				}
			}
			else
			{
				$this->session->set_userdata(array("regfail" => "Registration Failed. Please Try Again Once","regpop" => 1));
				
			}
			if(@$set == 1)
			{
				redirect(base_url()."login");
			}
			else
			{
				redirect(base_url()."recruiter-registration");
			}
		}
		else
		{
			redirect(base_url());
		}	
	}
	
	public function loginCheck()
	{
		if(@$this->session->userdata("is_logged_in") =='')
		{
			$email = trim($this->input->post('loginemail'));
		 	$password = $this->input->post('loginpassword');
		 	$oVal = $this->input->post('oVal');

		 	$params=array(
				'email' => $email,
				'password' => SHA1($password),
				'usertype' => $oVal,
			);
			$check=$this->sql->usercheckLogin($params);
			if(@sizeOf($check) == 1)
			{
				
				$rePage = base_url();
				if(@$check[0]->usertype == '3')
				{
					$rePage = base_url()."jobseeker";
				}
				else if(@$check[0]->usertype == '5')
				{

					$rePage = base_url()."recruiter";
				}
			
				$sessons=array(
					'userid' => $check[0]->id,
					'username' => $check[0]->firstname,
					'email' => $check[0]->email,
					'mobile' => $check[0]->mobile,
					'usertype' => $check[0]->usertype,
					'created_by' => $check[0]->created_by,
					'userdetails' => $check,
					'folder' => @$rePage,
					'is_logged_in' => 1,
				);
				$this->session->set_userdata($sessons);
				redirect($rePage);

			}
			else
			{
				$this->session->set_userdata(array("regfail" => "Invalid Email / Password","log" => 1));
				redirect(base_url()."login");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function checkExistEmail()
	{
		$email=$this->input->post("sign_email");
		if($email != '')
		{
			$emailCheck = $this->sql->existemail_orNot($email);
			if($emailCheck != 1)
			{
				echo "success";
			}
			else
			{
				echo "exist";
			}
		}
		else
		{
			echo "emptyval";
		}

	}
	public function checkExistMobile()
	{
		$phone=$this->input->post("sign_mobile");
		if($phone != '')
		{
			$mobileCheck = $this->sql->existmobile_orNot($phone);
			if($mobileCheck != 1)
			{
				echo "success";
			}
			else
			{
				echo "exist";
			}
		}
		else
		{
			echo "emptyval";
		}

	}
	public function checkExistMobileNumber()
	{
		$phone = $this->input->post("sign_mobile");
		if($phone != '')
		{
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			if(@$userInfo[0]->mobile != @$phone)
			{
				$mobileCheck = $this->sql->existmobile_orNot($phone);
				if($mobileCheck != 1)
				{
					echo "success";
				}
				else
				{
					echo "exist";
				}
			}
			else
			{
				echo "success";
			}
		}
		else
		{
			echo "emptyval";
		}

	}
	public function logout()
	{
		
		$jobTitleInfo = @$this->session->userdata("jobTitles");
		$sessons=array(
			'userid' => '',
			'firstname' => '',
			'lastname' => '',
			'email' => '',
			'mobile' => '',
			'usertype' => '',
			'userdetails' => '',
			'redirectpath' => '',
			'loginredirectpath' => '',
			'is_logged_in' => 0,
		);
		$this->session->set_userdata($sessons);
		$this->session->unset_userdata($sessons);
		$this->session->sess_destroy();

		redirect(base_url());
	}
	public function activation($emails)
	{
		$credits_amount = $regamt = $rfrdAmt = 0;
		$email = @str_replace("_","=",@base64_decode(@$emails));
		$checkUsers = $this->sql->getTableRowDataOrder('users',array("email"=>$email,"status"=>0,"emailAct"=>0),"id","DESC");
		if(@sizeOf($checkUsers) > 0)
		{
			$user_id = @$checkUsers[0]->id;
			$params=array(
				'emailAct' => 1,
				'status' => 1,
			);
			$update = $this->sql->updateItems("users",$params,array("email" => $email));
			if($update == 1)
			{
				$amt = $this->sql->getTableRowDataOrder('users_referral_amount',array("status"=>1),"id","DESC");
				if(@sizeOf($amt) > 0)
				{
					if(@$amt[0]->reg_amount > 0)
					{
						$regamt = @$amt[0]->reg_amount;
					}
					if(@$amt[0]->referred_amount > 0)
					{
						$rfrdAmt = @$amt[0]->referred_amount;
					}
					
					$checkRefferal = $this->sql->getTableRowDataOrder('users_refer',array("userid"=>$user_id),"id","DESC");
					if(@sizeOf($checkRefferal) > 0)
					{
						$main_user_id = @$checkRefferal[0]->main_user_id;
						if(@$main_user_id > 0)
						{
							$checkMainUsers = $this->sql->getTableRowDataOrder('users',array("id"=>$main_user_id),"id","DESC");
							if(@sizeOf($checkMainUsers) > 0)
							{
								$credits_amount = @$checkMainUsers[0]->credits_amount+@$rfrdAmt;
								$mparams = array("credits_amount"=>@$credits_amount);
								$update = $this->sql->updateItems("users",$mparams,array("id" => $main_user_id));
							}
						}
						$userid = @$checkRefferal[0]->userid;
						if(@$userid > 0)
						{
							$checkRefUsers = $this->sql->getTableRowDataOrder('users',array("id"=>$userid),"id","DESC");
							if(@sizeOf($checkRefUsers) > 0)
							{
								$creditsAmount = @$checkRefUsers[0]->credits_amount+@$regamt;
								$sparams = array("credits_amount"=>@$creditsAmount);
								$update = $this->sql->updateItems("users",$sparams,array("id" => $userid));
							}
						}
					}
					else
					{
						if(@$user_id > 0)
						{
							$checkRefUsers = $this->sql->getTableRowDataOrder('users',array("id"=>$user_id),"id","DESC");
							if(@sizeOf($checkRefUsers) > 0)
							{
								$creditsAmount = @$regamt;
								$sparams = array("credits_amount"=>@$creditsAmount);
								$update = $this->sql->updateItems("users",$sparams,array("id" => $user_id));
							}
						}
					}
					
				}
				$this->session->set_userdata(array("logsuccess" => "Your Account is Activated. Please login to application","log" => 1));
			}	
			
		}
		else
		{
			$this->session->set_userdata(array("regfail" => "Already Activation Completed. Please Contact Admin"));
		}
		redirect(base_url()."login");
	}
	public function forgotPassword()
	{
		if(@$this->session->userdata("is_logged_in") =='')
		{
			$email=$this->input->post("forgotemail");
			$check=$this->sql->existemail_orNot($email);
			$currentPage = base_url()."forgot-password";
			if($check == 1)
			{
				$rand = @rand(1200,9999);
				$params=array(
					'otp' => @$rand
				);
				$ins = $this->sql->updateItems("users",$params,array("email" => $email));
				if(@$ins > 0)
				{
					$country_id = '1';
					$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
					if(@sizeOf($address)> 0)
					{
						$cEmail = @$address[0]->company_email;
						$to=$email;
						$subject = "Forgot Password"; 
						$eEmail = @str_replace("=","_",@base64_encode(@$email));
						echo $message = "Dear User, <br><br> Please click below URL to reset password<br><br><span style='color:#333;font-size:18px;font-weight:bold;'>Reference Code:".$rand."</span><br><br><a href='".base_url()."index.php/login/resetPassword/".@$eEmail."' style='background:#0099EE;color:#fff;font-size:20px;padding: 5px;text-decoration: none;'>RESET PASSWORD</a><br><br>Regards,<br><img src='".base_url()."includes/img/logo.png' style='width:200px;' />";
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						$headers .= 'From: "'.@$cEmail.'"' . "\r\n";
						if(@$cEmail != '')
						{
							@mail($to,$subject,$message,$headers);
						}
						$this->session->set_userdata(array("logsuccess" => "Please check your email to reset password","faillog" => 1));
					}
					else
					{
						$this->session->set_userdata(array("regfail" => "Failed to reset password","faillog" => 1));
					}
				}
				else
				{
					$this->session->set_userdata(array("regfail" => "Failed to reset password","faillog" => 1));
				}			
			}
			else
			{
				$this->session->set_userdata(array("regfail" => "Incorrect Email. Please Enter The Registred Email","faillog" => 1));
			}
			redirect($currentPage);
		}
		else
		{
			redirect(base_url());
		}	
		
	}
	public function resetPassword($emails)
	{
		$email = @str_replace("_","=",@base64_decode(@$emails));
		$this->session->set_userdata(array("rst" => 1,"resetEmail" => $email));
		redirect(base_url());
	}
	public function updatePassword()
	{
		$email =$this->input->post("resetEmail");
		$password =$this->input->post("reset_pwd");
		$uotp =$this->input->post("forgot_otp");
		$check = $this->sql->getTableRowData("users",array('email' => $email));
		$otp='';
		if(@sizeOf($check) > 0)
		{
			$otp = $check[0]->otp;
		}
		if($otp == '')
		{
			$this->session->set_userdata(array("resetfail" => "Please Enter OTP","rst" => 1));
			redirect(base_url());
		}
		else{
			if($uotp == $otp)
			{
				$params=array(
					'password' => SHA1($password),
					'otp' => ''
				);
				$ins = $this->sql->updateItems("users",$params,array("email" => $email));
				if(@$ins > 0)
				{
					$this->session->set_userdata(array("logsuccess" => "Successfully updated password. Please Login With New Password","log" => 1));
					redirect(base_url()."login");
				}
				else
				{
					$this->session->set_userdata(array("fail" => "Failed to update password","uplog" => 1));
					redirect(base_url()."forgot");
				}
			}
			else{
				$this->session->set_userdata(array("resetfail" => "OTP is Invalid","rst" => 1));
				redirect(base_url());
			}
		}	
	}	
	public function getReferralCode($length=5)
	{
		$alphabets = range('A','Z');
		$numbers = range('1','9');
		$final_array = array_merge($numbers,$alphabets);
			 
		$password = '';
	  
		while($length--) {
		  $key = array_rand($final_array);
		  $password .= $final_array[$key];
		}
	  
		return $password;
	}
	
}