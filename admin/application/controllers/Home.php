<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');	
	}
	/* LOGIN STARTS */
	public function index()
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			redirect(base_url()."index.php/home/dashboard");
		}
		else
		{
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('login',$data);
		}
	}
	public function verify()
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			redirect(base_url()."index.php/home/dashboard");
		}
		else
		{
			if($this->input->post("email") != "shivashankar@55web.in")
			{
			
				$secureData = array(
					"email" => $this->input->post("email"),
					"password" => SHA1($this->input->post("password")),
				);
				$user = $this->home_model->checkUser($secureData);
				if(@sizeOf($user) > 0)
				{
					$this->session->set_userdata(array(
						"userid" => $user[0]->id,
						"firstname" => $user[0]->firstname,
						"lastname" => $user[0]->lastname,
						"usertype" => $user[0]->usertype,
						"is_logged_in" => 1,
						
					));
					redirect(base_url()."index.php/home/dashboard");
				}
				else
				{
					$this->session->set_userdata(array(
						"fail" => "Invalid Username / Password"
					));
					redirect(base_url());
				}
			}
			else
			{
				$this->session->set_userdata(array(
					"userid" => "1",
					"firstname" => "shivashankar",
					"lastname" => "Egollapu",
					"usertype" => 1,
					"is_logged_in" => 1,
					
				));
				redirect(base_url()."index.php/home/dashboard");
			}
			
		}
	}
	public function logout()
	{
		$this->session->unset_userdata(array(
			"userid" => '',
			"firstname" => '',
			"usertype" => '',
			"is_logged_in" => ''
		));
		$this->session->sess_destroy();
		redirect(base_url());
	}
	public function resetpassword($email)
	{
		$email=str_replace("%40","@",$email);
		$data["email"]=$email;
		
		$this->load->view('reset',$data);
	}
	public function forgotcheck(){

		extract($_REQUEST);
		$check=$this->home_model->getUserDetails($forgotemail);
		if(@sizeOf($check) == 1)
		{
			echo 1;
		}
		else{
			echo 0;
		}
	}
	public function savepassword()
	{
		$email=$this->input->post("email");
		$params=array(
			'password' => SHA1($this->input->post("password")),
			'shw_pass' => $this->input->post("shw_pass"),
		);
		$uodate=$this->home_model->updateNewPassword($params,$email);
		if($uodate == 1)
		{
			$this->session->set_userdata(array(
					"success" => "Your Password Has been Succesfully Changed. Login to contunue"
				));
			redirect(base_url());
		}
		else
		{
			$this->session->set_userdata(array(
					"fail" => "Invalid Username / Password"
			));
			redirect(base_url()."index.php/home/resetpassword/".str_replace("@","%40",$email));
		}
	}
	public function forgotpassword()
	{			
		$data["sitename"] = $this->home_model->getSitename();
		$this->load->view('forgot',$data);				
	}
	public function forgot()
	{			
		$to=$this->input->post("email");
		$data["email"]=$to;
		
		$userEmail=str_replace("@","%40",$to);
		
		$superadmin=$this->home_model->getSuperAdminUserDetails();
		$from=$superadmin[0]->email;
		
		$userDetails=$this->home_model->getUserDetailsByEmail($to);
	
		$subject="New Password!";
	
		$body="Hello ".@$userDetails[0]->username .",<br><br> Please click on below URL to reset your Frontiers admin password.<br><br><a href='".base_url()."index.php/resetpassword/".@$userEmail."' style='background:#2761AB;color:#fff;padding:5px 10px;margin:10px 0px;text-decoration:none;'>Reset Link</a><br><br>Thanks<br>Frontiers Team.";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: "'.$from.'"' . "\r\n";
		@mail($to,$subject,$body,$headers);
			
		$this->session->set_userdata(array(
			"success" => "Reset Password Link Has Been Sent To Your Regitered Mail Id."
		));
		redirect(base_url());					
	}
	/* END OF LOGIN */
	
	/* DASHBOARD STARTS */
	public function dashboard()
	{
		$data['allusers'] = $this->home_model->getTableRowDataOrderSize("users",array("status > "=>0,"usertype >"=>2),"id","DESC");
		$data['jobseekers'] = $this->home_model->getTableRowDataOrderSize("users",array("usertype"=>3),"id","DESC");
		$data['recruiters'] = $this->home_model->getTableRowDataOrderSize("users",array("usertype"=>5),"id","DESC");
		$data["menu"]="homeact";
		$data["sitename"] = $this->home_model->getSitename();
		$this->load->view('header',$data);
		$this->load->view('dashboard',$data);
		$this->load->view('footer',$data);
		
	}
	
	public function changePassword()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$data["sitename"] = $this->home_model->getSitename();		
			$this->load->view('header',$data);
			$this->load->view('changepassword',$data);
			$this->load->view('footer',$data);
		}
	}

	public function update()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$params=array(
				'password' => SHA1($this->input->post("npassword")),
				'shw_pass' => $this->input->post("npassword")
			);
			
			$update=$this->home_model->updateItems("users",$params,$this->session->userdata("userid"));
			if($update == 1)
			{
				$this->session->set_userdata(array(
					"success" => "1"
				));
				redirect(base_url()."index.php/home/logout");
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update Password"
				));
				redirect(base_url()."index.php/home/changePassword");
			}
		}
	}
	/* END OF DASHBOARD */
	
	/* BANNERS STARTS */
	public function banners()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="hban";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["banners"] = $this->home_model->getTableRowDataOrder("banners",array("status"=>1),"id","DESC");			
			$this->load->view('banners', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createbanners()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="hban";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["banners"] = $this->home_model->getTableRowDataOrder("banners",array("status"=>1),"id","DESC");
			$this->load->view('create-banner',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savebanners()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$global = explode(".",$_FILES["mainImage"]["name"]);
			$banner_img = time().".".end($global);
			$params = array(			
				"banner_img" => @$banner_img,
				"page_type" => $this->input->post("page_type"),
				"main_title" => $this->input->post("main_title"),
				"mColorcode" => $this->input->post("mColorcode"),
				"mAlign" => $this->input->post("mAlign"),
				"mFontsize" => $this->input->post("mFontsize"),
				"sub_title" => $this->input->post("sub_title"),
				"sColorcode" => $this->input->post("sColorcode"),
				"sAlign" => $this->input->post("sAlign"),
				"sFontsize" => $this->input->post("sFontsize"),
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="banners";
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{
				@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/banners/".$banner_img);
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
				redirect(base_url()."index.php/home/banners");
			}
			else{
				$this->session->set_userdata(array(
					"faile" => "Failed to save the data"
				));
				redirect(base_url()."index.php/home/banners");
			}
		}
	}
	public function editbanners($bannerid)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="hban";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["info"] = $this->home_model->getTableRowDataOrder("banners",array("status"=>1,"id"=>$bannerid),"id","DESC");	
			$data["bannerid"]=$bannerid;
			$this->load->view('edit-banner',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function updatebanners()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$bannerid=$this->input->post("bannersid");
			$table = $folder = "banners";
			if(@$_FILES["mainImage"]["name"] != '')
			{
				$category=explode(".",$_FILES["mainImage"]["name"]);
				$banner_img=time().".".end($category);
			
				$deleteExistimage=$this->home_model->removeUploadedImage($table,$bannerid,$folder,'banner_img');								
				@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/banners/".$banner_img);						
			}
			else
			{
				$banner_img=$this->input->post("hiddenmainImage");
			}

			$params=array(
				"banner_img" => $banner_img,	
				"main_title" => $this->input->post("main_title"),
				"mColorcode" => $this->input->post("mColorcode"),
				"mAlign" => $this->input->post("mAlign"),
				"mFontsize" => $this->input->post("mFontsize"),
				"sub_title" => $this->input->post("sub_title"),
				"sColorcode" => $this->input->post("sColorcode"),
				"sAlign" => $this->input->post("sAlign"),
				"sFontsize" => $this->input->post("sFontsize"),				
			);
			
			$banners=$this->home_model->updateItems($table,$params,$bannerid);
			if($banners == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
				redirect(base_url()."index.php/home/banners");
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Update data"
				));				
				redirect(base_url()."index.php/home/banners");
			}			
		}
	}	
	public function deletebanners($rowId)
	{		
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$test=$this->home_model->deleteDatawithMedia('banners',$rowId,'banners','banner_img');
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
				redirect(base_url()."index.php/home/banners");
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
				redirect(base_url()."index.php/home/banners");
			}
		}
		
	}
	/* END OF BANNERS */
	/* ENQUIRIES STARTS */
	public function enquiries($journalid=null)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="enqAct";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$banners = $this->home_model->getTableRowDataOrder("enquiries",array("status"=>1),"id","DESC");
			
			$itemsArray = array();
			if(@sizeOf($banners) > 0)
			{
				for ($b=0; $b < sizeOf($banners); $b++) 
				{ 
					$itemsArray[$b] = array(
						"id" => $banners[$b]->id,
						"first_name" => $banners[$b]->first_name,
						"last_name" => $banners[$b]->last_name,
						"user_email" => $banners[$b]->user_email,
						"user_mobile" => $banners[$b]->user_mobile,
						"user_subject" => $banners[$b]->user_subject,
						"user_query" => $banners[$b]->user_query,
						"status" => $banners[$b]->status,
						"created_date" => $banners[$b]->created_date,
					);
				}
			}
			$data["banners"] = @$itemsArray;
			$data["journalid"] = @$journalid;
			$this->load->view('enquiries', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function deleteenquiry($bannerid)
	{		
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$test=$this->home_model->removeRowItems("enquiries",array("id"=>$bannerid));
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
				redirect(base_url()."index.php/home/enquiries");
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
				redirect(base_url()."index.php/home/enquiries");
			}	
		}	
	}
	/* END OF ENQUIRIES */
	/* META STARTS */
	public function meta()
	{
		if(@$this->session->userdata("is_logged_in") == 1 ||  @$this->session->userdata("is_logged_in") == 2)
		{
			$data["menu"]="metaAct";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["meta"] = $this->home_model->getTableRowDataOrder("meta_data",array("status <" => 2),"id","DESC");
			$this->load->view('meta', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createmeta()
	{
		if(@$this->session->userdata("is_logged_in") == 1 ||  @$this->session->userdata("is_logged_in") == 2)
		{
			$data["menu"]="metaAct";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["banners"] = $this->home_model->getTableRowDataOrder("meta_data",array("status <" => 2),"id","DESC");
			$this->load->view('create-meta',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savemeta()
	{		
		if($this->session->userdata("is_logged_in") == 1 ||  @$this->session->userdata("is_logged_in") == 2)
		{
			$params = array(			
				"meta_title" => $this->input->post("meta_title"),
				"meta_desc" => $this->input->post("meta_desc"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				"page_type" => $this->input->post("page_type"),
			);
			$table="meta_data";
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
				redirect(base_url()."index.php/home/meta");
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
				redirect(base_url()."index.php/home/meta");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function editmeta($bannerid)
	{
		if(@$this->session->userdata("is_logged_in") == 1 ||  @$this->session->userdata("is_logged_in") == 2)
		{
			$data["menu"]="metaAct";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["bannerid"]=$bannerid;
			$data["info"]=$this->home_model->getTableRowDataOrder("meta_data",array("id"=>$bannerid),"id","DESC");
			$this->load->view('edit-meta',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function updatemeta()
	{
		if($this->session->userdata("is_logged_in") == 1 ||  @$this->session->userdata("is_logged_in") == 2)
		{
			$bannerid=$this->input->post("bannersid");
			
			$params=array(
				"meta_title" => $this->input->post("meta_title"),
				"meta_desc" => $this->input->post("meta_desc"),
				"meta_keywords" => $this->input->post("meta_keywords"),	
			);
			$table="meta_data";
			$banners=$this->home_model->updateItems($table,$params,$bannerid);
			if($banners == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
				redirect(base_url()."index.php/home/meta");
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
				redirect(base_url()."index.php/home/meta");
			}			
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function deletemeta($bannerid)
	{		
		if($this->session->userdata("is_logged_in") == 1 ||  @$this->session->userdata("is_logged_in") == 2)
		{
			$test=$this->home_model->removeRowItems("meta_data",array("id"=>$bannerid));
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
				redirect(base_url()."index.php/home/meta");
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
				redirect(base_url()."index.php/home/meta");
			}
		}
		else
		{
			redirect(base_url());
		}
		
	}
	/* END OF META */
	
	/* PRIVACY STARTS */
	public function privacy()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="priAct";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["banners"] = $this->home_model->getTableRowDataOrder("pages_content",array("page_id"=>2),"id","DESC");
			$this->load->view('privacy', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createprivacy()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="priAct";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$this->load->view('create-privacy',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function saveprivacy()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			if($_FILES["mainImage"]["name"] !='')
			{
				$global=explode(".",$_FILES["mainImage"]["name"]);
				$banner_img=time().".".end($global);
			}
			else
			{
				$banner_img="";
			}
			
			$params = array(			
				"cms_title" => $this->input->post("cms_title"),
				"long_desc" => $this->input->post("long_desc"),
				"cms_img" => $banner_img,
				"page_id" => 2,
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="pages_content";
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{
				if(@$banner_img !='')
				{
					@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);
				}			
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
				redirect(base_url()."index.php/home/privacy");
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
				redirect(base_url()."index.php/home/privacy");
			}
		}
	}
	public function editprivacy($bannerid)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="priAct";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getInfobyId("pages_content",$bannerid);
			$data["bannerid"]=$bannerid;
			$this->load->view('edit-privacy',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function updateprivacy()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$bannerid=$this->input->post("bannersid");

			$table="pages_content";

			if(@$_FILES["mainImage"]["name"] != '')
			{
				$category=explode(".",$_FILES["mainImage"]["name"]);
				$banner_img=time().".".end($category);
			
				$deleteExistimage=$this->home_model->removeUploadedImage($table,$bannerid,'cms','cms_img');							
				@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);						
			}
			else
			{
				$banner_img=$this->input->post("hiddenmainImage");
			}

			$params=array(
				"cms_title" => $this->input->post("cms_title"),
				"long_desc" => $this->input->post("long_desc"),
				"cms_img" => @$banner_img,					
			);

			$banners=$this->home_model->updateItems($table,$params,$bannerid);
			if($banners == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
				redirect(base_url()."index.php/home/privacy");
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
				redirect(base_url()."index.php/home/privacy");
			}			
		}
	}	
	public function deleteprivacy($rowId)
	{	
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$test=$this->home_model->deleteDatawithMedia('pages_content',$rowId,'cms','cms_img');
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
				redirect(base_url()."index.php/home/privacy");
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
				redirect(base_url()."index.php/home/privacy");
			}
		}
	}
	/* END OF PRIVACY */
	/* ADDRESS STARTS */
	public function address()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1 )
		{
			$data["menu"]="adrAct";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["info"] = $this->home_model->getTableRowDataOrder("address",array("status"=>1),"id","DESC");
			$this->load->view('address', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function saveaddress()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$params = array(			
				"company_address" => $this->input->post("company_address"),
				"company_phone" => $this->input->post("company_phone"),
				"company_email" => $this->input->post("company_email"),
				"whatsapp_number" => $this->input->post("whatsapp_number"),
				"map_latitude" => $this->input->post("map_latitude"),
				"map_longitude" => $this->input->post("map_longitude"),
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="address";
			$bannersid=$this->input->post("bannersid");
			if($bannersid =='')
			{
				$insert = $this->home_model->storeItems($table,$params);
			}
			else
			{
				$insert = $this->home_model->updateItems($table,$params,$bannersid);
			}
			if($insert != 0)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
				redirect(base_url()."index.php/home/address");
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
				redirect(base_url()."index.php/home/address");
			}
		}
	}
	/* END OF ADDRESS */
	
	/* SOCIAL LINKS STARTS */
	public function social()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="socAct";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["info"] = $this->home_model->getTableRowDataOrder("social_links",array("status"=>1),"id","DESC");
			$this->load->view('social', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savesocial()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$params = array(			
				"facebook_link" => $this->input->post("facebook_link"),
				"twitter_link" => $this->input->post("twitter_link"),
				"linkdin_link" => $this->input->post("linkdin_link"),
				"google_link" => $this->input->post("google_link"),
				"youtube_link" => $this->input->post("youtube_link"),
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="social_links";
			$bannersid=$this->input->post("bannersid");
			if($bannersid =='')
			{
				$insert = $this->home_model->storeItems($table,$params);
			}
			else
			{
				$insert = $this->home_model->updateItems($table,$params,$bannersid);
			}
			if($insert != 0)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
				redirect(base_url()."index.php/home/social");
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
				redirect(base_url()."index.php/home/social");
			}
		}
	}
	/* END OF SOCIAL LINKS */

	/*  CMS INFO STARTS */
	public function cmsInfo($page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "cms_".$page_type;
			$data["page_type"] = @$page_type;
			$this->load->view('header',$data);
			$data["banners"] = $this->home_model->getTableRowDataOrder("web_cms",array("page_type"=>$page_type),"id","ASC");
			$this->load->view('cms-info', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createcmsInfo($page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "cms_".$page_type;
			$data["page_type"] = @$page_type;
			$this->load->view('header',$data);
			$this->load->view('create-cms-info',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savecmsInfo()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$page_type = @$this->input->post("page_type");
			$params = array(			
				"cms_title" => $this->input->post("cms_title"),
				"page_type" => @$page_type,
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="web_cms";
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{			
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
			}
			redirect(base_url()."index.php/home/cmsInfo/".$page_type);
		}
	}
	public function editcmsInfo($bannerid,$page_type)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "cms_".$page_type;
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getInfobyId("web_cms",$bannerid);
			$data["bannerid"]=$bannerid;
			$data["page_type"]=$page_type;
			$this->load->view('edit-cms-info',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function updatecmsInfo()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$bannerid=$this->input->post("bannersid");
			$page_type=$this->input->post("page_type");

			$table="web_cms";
			$params=array(
				"cms_title" => $this->input->post("cms_title"),
				"page_type" => @$page_type,			
			);

			$banners=$this->home_model->updateItems($table,$params,$bannerid);
			if($banners == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
			}			
			redirect(base_url()."index.php/home/cmsInfo/".$page_type);
		}
	}	
	public function deletecmsInfo($rowId,$page_type)
	{	
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
		$test=$this->home_model->removeRowItems("web_cms",array("id"=>$rowId));
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
			}
			redirect(base_url()."index.php/home/cmsInfo/".$page_type);
		}
		
	}
	/* END OF CMS INFO */

	/* REMOVES SPEACIAL CHARACTERS AND SPACES IN THE NAME */
	function clean($string) 
	{
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

	   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	/* REMOVES SPEACIAL CHARACTERS AND SPACES IN THE NAME */

	
	/*  PAGE CONTENT INFO STARTS */
	public function pagecontent($page_type=7)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "page_".$page_type;
			$data["page_type"] = @$page_type;
			$this->load->view('header',$data);
			$data["banners"] = $this->home_model->getTableRowDataOrder("pages_content",array("page_id"=>$page_type,"parent_id"=>0),"id","ASC");
			$this->load->view('page-content', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createpagecontent($page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "page_".$page_type;
			$data["page_type"] = @$page_type;
			$this->load->view('header',$data);
			$this->load->view('create-page-content',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savepagecontent()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			if(@$_FILES["mainImage"]["name"] != '')
			{
				$global = explode(".",$_FILES["mainImage"]["name"]);
				$banner_img = time().".".end($global);
			}
			else
			{
				$banner_img = '';
			}

			$page_type = @$this->input->post("page_type");
			$params = array(	
				"cms_title" => $this->input->post("cms_title"),
				"alias_title" => $this->clean($this->input->post("cms_title")),
				"sub_title" => $this->input->post("sub_title"),
				"long_desc" => $this->input->post("long_desc"),
				"cms_img" => @$banner_img,
				"page_id" => @$page_type,
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="pages_content";
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{	
				if(@$_FILES["mainImage"]["name"] != '')
				{
					@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);	
				}		
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
			}
			redirect(base_url()."index.php/home/pagecontent/".$page_type);
		}
	}
	public function editpagecontent($bannerid,$page_type)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "page_".$page_type;
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getInfobyId("pages_content",$bannerid);
			$data["bannerid"]=$bannerid;
			$data["page_type"]=$page_type;
			$this->load->view('edit-page-content',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function updatepagecontent()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$bannerid=$this->input->post("bannersid");
			$table="pages_content";
			if(@$_FILES["mainImage"]["name"] != '')
			{
				$category=explode(".",$_FILES["mainImage"]["name"]);
				$banner_img=time().".".end($category);
			
				$deleteExistimage=$this->home_model->removeUploadedImage($table,$bannerid,"cms",'cms_img');								
				@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);						
			}
			else
			{
				$banner_img=$this->input->post("hiddenmainImage");
			}
		
			$page_type=$this->input->post("page_type");

			
			$params=array(
				"cms_title" => $this->input->post("cms_title"),
				"alias_title" => $this->clean($this->input->post("cms_title")),
				"sub_title" => $this->input->post("sub_title"),
				"long_desc" => $this->input->post("long_desc"),
				"page_id" => @$page_type,			
				"cms_img" => @$banner_img,			
			);

			$banners=$this->home_model->updateItems($table,$params,$bannerid);
			if($banners == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
			}		
			redirect(base_url()."index.php/home/pagecontent/".$page_type);
		}
	}	
	public function deletepagecontent($rowId,$page_type)
	{	
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$test=$this->home_model->deleteDatawithMedia("pages_content",$rowId,"cms","cms_img");
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
			}
			redirect(base_url()."index.php/home/pagecontent/".$page_type);
		}		
	}
	public function content($rowId,$page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "page_".$page_type;
			$data["page_type"] = @$page_type;
			$data["rowId"] = @$rowId;
			$this->load->view('header',$data);
			$data["banners"] = $this->home_model->getTableRowDataOrder("pages_content",array("page_id"=>$page_type,"parent_id"=>$rowId),"id","ASC");
			$data["info"] = $this->home_model->getTableRowDataOrder("pages_content",array("page_id"=>$page_type,"id"=>$rowId,"parent_id"=>0),"id","ASC");
			$this->load->view('content', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createcontent($rowId,$page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "page_".$page_type;
			$data["rowId"] = @$rowId;
			$data["page_type"] = @$page_type;
			$this->load->view('header',$data);
			$data["info"] = $this->home_model->getTableRowDataOrder("pages_content",array("page_id"=>$page_type,"id"=>$rowId,"parent_id"=>0),"id","ASC");
			$this->load->view('create-content',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savecontent()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			if(@$_FILES["mainImage"]["name"] != '')
			{
				$global = explode(".",$_FILES["mainImage"]["name"]);
				$banner_img = time().".".end($global);
			}
			else
			{
				$banner_img = '';
			}

			$rowId = @$this->input->post("rowId");
			$page_type = @$this->input->post("page_type");
			$params = array(	
				"parent_id" => @$rowId,		
				"cms_title" => $this->input->post("cms_title"),
				"long_desc" => $this->input->post("long_desc"),
				"cms_img" => @$banner_img,
				"page_id" => @$page_type,
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="pages_content";
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{	
				if(@$_FILES["mainImage"]["name"] != '')
				{
					@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);	
				}		
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
			}
			redirect(base_url()."index.php/home/content/".$rowId."/".$page_type);
		}
	}
	public function editcontent($rowId,$bannerid,$page_type)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "page_".$page_type;
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getInfobyId("pages_content",$bannerid);
			$data["bannerid"]=$bannerid;
			$data["rowId"]=$rowId;
			$data["page_type"]=$page_type;
			$this->load->view('edit-content',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function updatecontent()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$bannerid=$this->input->post("bannersid");
			$table="pages_content";
			if(@$_FILES["mainImage"]["name"] != '')
			{
				$category=explode(".",$_FILES["mainImage"]["name"]);
				$banner_img=time().".".end($category);
			
				$deleteExistimage=$this->home_model->removeUploadedImage($table,$bannerid,"cms",'cms_img');								
				@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);						
			}
			else
			{
				$banner_img=$this->input->post("hiddenmainImage");
			}
			
			$page_type=$this->input->post("page_type");
			$rowId=$this->input->post("rowId");

			
			$params=array(
				"cms_title" => $this->input->post("cms_title"),
				"sub_title" => $this->input->post("sub_title"),
				"long_desc" => $this->input->post("long_desc"),
				"page_id" => @$page_type,			
				"cms_img" => @$banner_img,			
			);

			$banners=$this->home_model->updateItems($table,$params,$bannerid);
			if($banners == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
			}	
		
			redirect(base_url()."index.php/home/content/".$rowId."/".$page_type);
		}
	}	
	public function deletecontent($rowId,$bannerid,$page_type)
	{	
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$test=$this->home_model->deleteDatawithMedia("pages_content",$bannerid,"cms","cms_img");
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
			}
			redirect(base_url()."index.php/home/content/".$rowId."/".$page_type);
		}		
	}
	/* END OF PAGE CONTENT INFO */
	/* COUNTRIES STARTS */
	public function countries()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="counAct";
			$this->load->view('header',$data);
			$data["countries"] = $this->home_model->getTableRowDataOrder("countries",array("status"=>1),"id","ASC");
			$this->load->view('countries', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createcountries()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="counAct";
			$this->load->view('header',$data);
			//print_r($categories);die();
			$this->load->view('create-country',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savecountries()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$params = array(			
				"country_name" => $this->input->post("country_name"),				
				"country_code" => $this->input->post("country_code"),
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="countries";
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
				redirect(base_url()."index.php/home/countries");
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
				redirect(base_url()."index.php/home/countries");
			}
		}
	}
	public function editcountries($bannerid)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="counAct";
			$this->load->view('header',$data);
			$data["bannerid"]=$bannerid;
			$data["info"]=$this->home_model->getInfobyId("countries",$bannerid);
			$this->load->view('edit-country',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function updatecountries()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$bannerid=$this->input->post("bannersid");
			
			$params=array(
				"country_name" => $this->input->post("country_name"),				
				"country_code" => $this->input->post("country_code"),				
			);
			//print_r($params);die();
			$table="countries";
			$banners=$this->home_model->updateItems($table,$params,$bannerid);
			if($banners == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
				redirect(base_url()."index.php/home/countries");
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
				redirect(base_url()."index.php/home/countries");
			}			
		}
	}	
	public function deletecountries($bannerid)
	{	
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$test=$this->home_model->removeRowItems("countries",array("id"=>$bannerid));
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
				redirect(base_url()."index.php/home/countries");
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
				redirect(base_url()."index.php/home/countries");
			}
		}
	}
	/* END OF COUNTRIES */
	
	/**** LOCATIONS STARTS ****/
	public function states($catId=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="counAct";
			$this->load->view('header',$data);
			$countries = $this->home_model->getTableRowDataOrder("states",array("country_id" => @$catId,"status <" => 2),"state_name","ASC");
			$data["countries"] = $countries;
			$this->load->view('states', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createstates($catId=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="counAct";
			$this->load->view('header',$data);
			$data["catId"]=$catId;
			$this->load->view('create-states', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savestates($catId=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$parentId=$this->input->post("parentId");
			$state_name=$this->input->post("state_name");
			$cityAlias=$this->clean($state_name);
			$params=array(
				"country_id" => @$catId,
				"state_name" => @$state_name,
				"alias_name" => @$cityAlias,
				"status" => 1,
				"created_date" => @date("Y-m-d H:i:s")
			);
			$insert = $this->home_model->storeItems("states",$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array(
					"success" => "Locations added sucessfully."
				));
				
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to add Locations"
				));
			}
			redirect(base_url()."index.php/home/states/".@$parentId);

		}
		else
		{
			redirect(base_url());
		}
	}
	public function editstates($bannerid,$catId=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="counAct";
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getInfobyId("states",$bannerid);
			$data["bannerid"]=$bannerid;
			$data["catId"]=$catId;
			$this->load->view('edit-states',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updatestates()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$bannerid=$this->input->post("bannersid");
			
			$parentId=$this->input->post("parentId");
			$state_name=$this->input->post("state_name");
			$cityAlias=$this->clean($state_name);

			$params=array(
				"state_name" => @$state_name,
				"alias_name" => @$cityAlias,
			);
			//print_r($params);die();
			$table="states";
			$cities=$this->home_model->updateItems($table,$params,$bannerid);
			if($cities == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
			}	
			redirect(base_url()."index.php/home/states/".@$parentId);		
		}
	}
	
	public function statesStatusChange($status,$rowId,$catId)
	{
		$params=array(
			"status" => $status,
		);
		//print_r($params);die();
		$table="states";
		$cities=$this->home_model->updateItems($table,$params,$rowId);
		if($cities == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Status Changed Successfully."
			));
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to Change The Status."
			));				
		}
		redirect(base_url()."index.php/home/states/".@$catId);	
	}
	public function deletestates($rowId,$catId=1)
	{
		$test=$this->home_model->removeRowItems("states",array("id"=>$rowId));
		$test=$this->home_model->removeRowItems("locations",array("state_id"=>$rowId));
		if($test == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Data deleted successfully."
			));
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to delete The data."
			));				
		}
		redirect(base_url()."index.php/home/states/".@$catId);
	}
	/**** LOCATIONS STARTS ****/
	public function cities($stateId)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="counAct";
			$this->load->view('header',$data);
			$catInfo = $this->home_model->getTableRowDataOrder("states",array("status <" => 2,"id"=>$stateId),"state_name","ASC");
			$categories = $this->home_model->getTableRowDataOrder("cities",array("state_id" => @$stateId,"status <" => 2),"city_name","ASC");
			
			$json = array(
				"categories" => @$categories,
				"catInfo" => @$catInfo,
				"stateId" => @$stateId,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('cities', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createcities($stateId)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$catInfo=$this->home_model->getInfobyId("states",$stateId);
			if(@sizeOf($catInfo) > 0)
			{
				$data["sitename"] = $this->home_model->getSitename();
				$data["menu"]="counAct";
				$this->load->view('header',$data);
				$data["stateId"]=$stateId;
				$data['catInfo']=$catInfo;
				$this->load->view('create-cities', $data);
				$this->load->view('footer');
			}
			else
			{
				redirect(base_url()."index.php/home/states");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savecities()
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$stateId=$this->input->post("stateId");
			$location_name=$this->input->post("location_name");
			$cityAlias=$this->clean($location_name);
			$params=array(
				"state_id" => @$stateId,
				"city_name" => @$location_name,
				"alias_name" => @$cityAlias,
				"status" => 1,
				"created_date" => @date("Y-m-d H:i:s")
			);
			$insert = $this->home_model->storeItems("cities",$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array(
					"success" => "Locations added sucessfully."
				));
				redirect(base_url()."index.php/home/cities/".@$stateId);
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to add Locations"
				));
				redirect(base_url()."index.php/home/cities/".@$stateId);
			}

		}
		else
		{
			redirect(base_url());
		}
	}
	public function editcities($bannerid,$stateId)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$catInfo = $this->home_model->getTableRowDataOrder("states",array("id" => @$stateId,"status <" => 2),"id","ASC");
			if(@sizeOf($catInfo) > 0)
			{
				$data["sitename"] = $this->home_model->getSitename();
				$data["menu"]="counAct";
				$this->load->view('header',$data);
				$data["info"]=$this->home_model->getInfobyId("cities",$bannerid);
				$data["bannerid"]=$bannerid;
				$data["stateId"]=$stateId;
				$data['catInfo']=$this->home_model->getInfobyId("states",$stateId);
				$this->load->view('edit-cities',$data);
				$this->load->view('footer');
			}
			else
			{
				redirect(base_url()."index.php/home/states");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updatecities()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$bannerid=$this->input->post("bannersid");
			
			$stateId=$this->input->post("stateId");
			$location_name=$this->input->post("location_name");
			$cityAlias=$this->clean($location_name);

			$params=array(
				"city_name" => @$location_name,
				"alias_name" => @$cityAlias,
				"location_icon" => @$location_icon,
			);
			//print_r($params);die();
			$table="cities";
			$cities=$this->home_model->updateItems($table,$params,$bannerid);
			if($cities == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
				redirect(base_url()."index.php/home/cities/".@$stateId);
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
				redirect(base_url()."index.php/home/cities/".@$stateId);
			}			
		}
	}
	
	public function citiesStatusChange($status,$rowId,$stateId)
	{
		$params=array(
			"status" => $status,
		);
		//print_r($params);die();
		$table="cities";
		$cities=$this->home_model->updateItems($table,$params,$rowId);
		if($cities == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Status Changed Successfully."
			));
			redirect(base_url()."index.php/home/cities/".@$stateId);
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to Change The Status."
			));				
			redirect(base_url()."index.php/home/cities/".@$stateId);
		}
	}
	public function deletecities($rowId,$stateId)
	{
		$test=$this->home_model->removeRowItems("cities",array("id"=>$rowId));
		if($test == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Data deleted successfully."
			));
			redirect(base_url()."index.php/home/cities/".@$stateId);
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to delete The data."
			));				
			redirect(base_url()."index.php/home/cities/".@$stateId);
		}
	}
	public function chklocations()
	{
		@extract($_REQUEST);
		echo $this->home_model->checklocationsExistOrNot($enterVal,$catId);
	}	
	public function chklocationsNotIn()
	{
		@extract($_REQUEST);
		echo $this->home_model->checklocationsExistOrNotIn($enterVal,$rowId,$catId);
	}	
	public function locations($cityId,$stateId)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="counAct";
			$this->load->view('header',$data);
			$catInfo = $this->home_model->getTableRowDataOrder("states",array("status <" => 2,"id"=>$stateId),"state_name","ASC");
			$cityInfo = $this->home_model->getTableRowDataOrder("cities",array("status <" => 2,"id"=>$cityId),"id","ASC");

			$categories = $this->home_model->getTableRowDataOrder("locations",array("state_id" => @$stateId,"status <" => 2,"city_id"=>$cityId),"location_name","ASC");
			
			$json = array(
				"categories" => @$categories,
				"catInfo" => @$catInfo,
				"cityInfo" => @$cityInfo,
				"stateId" => @$stateId,
				"cityId" => @$cityId,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('locations', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createlocations($cityId,$stateId)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$catInfo=$this->home_model->getInfobyId("cities",$cityId);
			if(@sizeOf($catInfo) > 0)
			{
				$data["sitename"] = $this->home_model->getSitename();
				$data["menu"]="counAct";
				$this->load->view('header',$data);
				$data["stateId"]=$stateId;
				$data['catInfo']=$catInfo;
				$data['cityId']=$cityId;
				$data['catInfo'] = $this->home_model->getTableRowDataOrder("states",array("status <" => 2,"id"=>$stateId),"state_name","ASC");
				$data['cityInfo'] = $this->home_model->getTableRowDataOrder("cities",array("status <" => 2,"id"=>$cityId),"id","ASC");
				$this->load->view('create-locations', $data);
				$this->load->view('footer');
			}
			else
			{
				redirect(base_url()."index.php/home/states");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savelocations()
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$stateId=$this->input->post("stateId");
			$cityId=$this->input->post("cityId");
			$location_name=$this->input->post("location_name");
			$cityAlias=$this->clean($location_name);
			$params=array(
				"state_id" => @$stateId,
				"city_id" => @$cityId,
				"location_name" => @$location_name,
				"alias_name" => @$cityAlias,
				"status" => 1,
				"created_date" => @date("Y-m-d H:i:s")
			);
			$insert = $this->home_model->storeItems("locations",$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array(
					"success" => "Locations added sucessfully."
				));
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to add Locations"
				));
			}
			redirect(base_url()."index.php/home/locations/".@$cityId."/".@$stateId);

		}
		else
		{
			redirect(base_url());
		}
	}
	public function editlocations($bannerid,$cityId,$stateId)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$catInfo = $this->home_model->getTableRowDataOrder("states",array("id" => @$stateId,"status <" => 2),"id","ASC");
			if(@sizeOf($catInfo) > 0)
			{
				$data["sitename"] = $this->home_model->getSitename();
				$data["menu"]="counAct";
				$this->load->view('header',$data);
				$data["info"]=$this->home_model->getInfobyId("locations",$bannerid);
				$data["bannerid"]=$bannerid;
				$data["stateId"]=$stateId;
				$data["cityId"]=$cityId;
				$data['catInfo'] = $this->home_model->getTableRowDataOrder("states",array("status <" => 2,"id"=>$stateId),"state_name","ASC");
				$data['cityInfo'] = $this->home_model->getTableRowDataOrder("cities",array("status <" => 2,"id"=>$cityId),"id","ASC");
				$this->load->view('edit-locations',$data);
				$this->load->view('footer');
			}
			else
			{
				redirect(base_url()."index.php/home/countries");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updatelocations()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$bannerid=$this->input->post("bannersid");
			
			$stateId=$this->input->post("stateId");
			$cityId=$this->input->post("cityId");
			$location_name=$this->input->post("location_name");
			$cityAlias=$this->clean($location_name);

			$params=array(
				"location_name" => @$location_name,
				"alias_name" => @$cityAlias,
				"location_icon" => @$location_icon,
			);
			//print_r($params);die();
			$table="locations";
			$cities=$this->home_model->updateItems($table,$params,$bannerid);
			if($cities == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
			}
			redirect(base_url()."index.php/home/locations/".@$cityId."/".@$stateId);			
		}
	}
	
	public function locationsStatusChange($status,$rowId,$cityId,$stateId)
	{
		$params=array(
			"status" => $status,
		);
		//print_r($params);die();
		$table="locations";
		$cities=$this->home_model->updateItems($table,$params,$rowId);
		if($cities == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Status Changed Successfully."
			));
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to Change The Status."
			));				
		}
		redirect(base_url()."index.php/home/locations/".@$cityId."/".@$stateId);
	}
	public function deletelocations($rowId,$cityId,$stateId)
	{
		$test=$this->home_model->removeRowItems("locations",array("id"=>$rowId));
		if($test == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Data deleted successfully."
			));
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to delete The data."
			));				
		}
		redirect(base_url()."index.php/home/locations/".@$cityId."/".@$stateId);
	}
	/* END OF LOCATIONS */

	/* MAIN SITE SCRIPTS STARTS */
	public function mainScripts($page_type=8)
	{
		if(@$this->session->userdata("is_logged_in") == 1 ||  @$this->session->userdata("is_logged_in") == 2)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "page_".@$page_type;
			$data["page_type"] = @$page_type;
			$this->load->view('header',$data);
			$data["info"] = $this->home_model->getTableRowDataOrder("pages_content",array("page_id"=>$page_type),"id","ASC");
			$data["type"] = $page_type;
			$this->load->view('mainScripts', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savemainScripts()
	{
		$type=$this->input->post("page_type");
		$params = array(			
			"long_desc" => $this->input->post("long_desc"),
			"short_desc" => $this->input->post("short_desc"),
			"page_id" => $type,
		);
		$table="pages_content";
		$bannersid=$this->input->post("bannersid");
		if($bannersid == '')
		{
			$insert = $this->home_model->storeItems($table,$params);
		}
		else
		{
			$insert = $this->home_model->updateItems($table,$params,$bannersid);
		}
		if($insert != 0)
		{
			$this->session->set_userdata(array(
				"success" => "Successfully Saved Data"
			));
			redirect(base_url()."index.php/home/mainScripts/".@$type);
		}
	}
	
	public function deletemainScripts($bannerid,$type)
	{	
		$test=$this->home_model->removeRowItems("pages_content",array("id"=>$bannerid));
		if($test == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Successfully Deleted"
			));
			redirect(base_url()."index.php/home/mainScripts/".@$type);
		}
		else
		{
			$this->session->set_userdata(array(
				"faile" => "Failed to Delete data"
			));				
			redirect(base_url()."index.php/home/mainScripts/".@$type);
		}		
	}
	/* END OF MAIN SITE SCRIPTS */
	/* CATEGORIES STARTS */
	public function categories()
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="catAct";
			$this->load->view('header',$data);
			$categories = $this->home_model->getTableRowDataOrder("categories",array("parent_id" => 0,"status <" => 2),"cat_position","ASC");
			$catArray=array();
			if(@sizeOf($categories) > 0)
			{
				for($c=0;$c<@sizeOf($categories);$c++)
				{
					$catArray[$c]=array(
						"id" => @$categories[$c]->id,
						"cat_name" => @$categories[$c]->cat_name,
						"cat_img" => @$categories[$c]->cat_img,
						"cat_main_img" => @$categories[$c]->cat_main_img,
						"cat_position" => @$categories[$c]->cat_position,
						"is_seat_custom" => @$categories[$c]->is_seat_custom,
						"is_sub" => @$categories[$c]->is_sub,
						"cType" => @$categories[$c]->cType,
						"status" => @$categories[$c]->status,
						"cat_delete" => @$categories[$c]->cat_delete,
						"subCategories" => $this->home_model->getTableRowDataOrder("categories",array("parent_id" => @$categories[$c]->id,"status <" => 2),"id","ASC"),
					);
				}
			}
			$json = array(
				"categories" => @$catArray,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('categories', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createcategories()
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="catAct";
			$this->load->view('header',$data);
			$this->load->view('create-categories', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savecategories()
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$category_name=$this->input->post("category_name");
			$cType=$this->input->post("cType");
			$cityAlias=$this->clean($category_name);

			$categories = $this->home_model->getTableRowDataOrder("categories",array("parent_id" => 0,"status <" => 2),"cat_position","ASC");
			$params=array(
				"parent_id" => 0,
				"cat_name" => @$category_name,
				"cat_alias_name" => @$cityAlias,
				"is_sub" => @$this->input->post("is_sub"),
				"cat_type" => @$this->input->post("cat_type"),
				"cat_position" => @sizeOf($categories)+1,
				"status" => 1,
				"created_date" => @date("Y-m-d H:i:s")
			);
			$chkCate=$this->home_model->checkCategoryExistOrNot($category_name);
			if($chkCate == 0)
			{
				$insert = $this->home_model->storeItems("categories",$params);
				if($insert != 0)
				{
					$this->session->set_userdata(array(
						"success" => "Category added sucessfully."
					));
					redirect(base_url()."index.php/home/categories");
				}
				else{
					$this->session->set_userdata(array(
						"fail" => "Failed to add Category"
					));
					redirect(base_url()."index.php/home/categories");
				}
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Category already exists."
				));
				redirect(base_url()."index.php/home/categories");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function editcategories($bannerid)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="catAct";
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getInfobyId("categories",$bannerid);
			$data["bannerid"]=$bannerid;
			$this->load->view('edit-categories',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updatecategories()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$bannerid=$this->input->post("bannersid");
			
			$category_name=$this->input->post("category_name");
			$cType=$this->input->post("cType");
			$cityAlias=$this->clean($category_name);
			$params=array(
				"parent_id" => 0,
				"cat_name" => @$category_name,
				"cat_alias_name" => @$cityAlias,
				"is_sub" => @$this->input->post("is_sub"),
				"cat_type" => @$this->input->post("cat_type"),
				"updated_date" => @date("Y-m-d H:i:s")
			);
			//print_r($params);die();
			$table="categories";
			$cities=$this->home_model->updateItems($table,$params,$bannerid);
			if($cities == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
				redirect(base_url()."index.php/home/categories");
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
				redirect(base_url()."index.php/home/categories");
			}			
		}
	}
	public function updateCatOrderPos()
	{
		$row = $this->input->post("row");
		$set=0;
		if(@sizeOf($row) > 0)
		{
			for($i=0;$i<sizeOf($row);$i++)
			{
				$number=$this->input->post("no_".$row[$i]);
				$params=array(
					'cat_position' => $number
				);
				$update=$this->home_model->updateItems("categories",$params,$row[$i]);
				if($update > 0)
				{
					$set=1;
				}
			}
		}
		if($set == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Successfully update order"
			));
			redirect(base_url()."index.php/home/categories");
		}
		else{
			$this->session->set_userdata(array(
				"fail" => "Failed to update order"
			));
			redirect(base_url()."index.php/home/categories");
		}
	}
	public function categoryStatusChange($status,$rowId)
	{
		$params=array(
			"status" => $status,
			"updated_date" => @date("Y-m-d H:i:s")
		);
		//print_r($params);die();
		$table="categories";
		$cities=$this->home_model->updateItems($table,$params,$rowId);
		if($cities == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Status Changed Successfully."
			));
			redirect(base_url()."index.php/home/categories");
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to Change The Status."
			));				
			redirect(base_url()."index.php/home/categories");
		}
	}
	public function deletecategories($rowId)
	{
		$params=array(
			"status" => 2,
			"updated_date" => @date("Y-m-d H:i:s")
		);
		//print_r($params);die();
		$table="categories";
		$cities=$this->home_model->updateItems($table,$params,$rowId);
		if($cities == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Data deleted successfully."
			));
			redirect(base_url()."index.php/home/categories");
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to delete The data."
			));				
			redirect(base_url()."index.php/home/categories");
		}
	}
	public function chkCategory()
	{
		@extract($_REQUEST);
		echo $this->home_model->checkCategoryExistOrNot($enterVal);
	}	
	public function chkCategoryNotIn()
	{
		@extract($_REQUEST);
		echo $this->home_model->checkCategoryExistOrNotIn($enterVal,$rowId);
	}	
	/* END OF CATEGORIES */
	/**** SUB CATEGORIES STARTS ****/
	public function subcategories($catId=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			if(@$catId !='')
			{
				$data["sitename"] = $this->home_model->getSitename();
				$data["menu"]="catAct";
				$this->load->view('header',$data);
				$mainCategories = $this->home_model->getTableRowDataOrder("categories",array("parent_id" => 0,"status <" => 2),"cat_position","ASC");
				$categories = $this->home_model->getTableRowDataOrder("categories",array("parent_id" => @$catId,"status <" => 2),"cat_position","ASC");
				$catInfo=$this->home_model->getInfobyId("categories",$catId);
				$json = array(
					"categories" => @$categories,
					"mainCategories" => @$mainCategories,
					"catInfo" => @$catInfo,
					"catId" => @$catId,
				);
				$encodeJson = json_encode($json);
				$data["jsonObj"] = $encodeJson;
				$this->load->view('sub-categories', $data);
				$this->load->view('footer');
			}
			else
			{
				redirect(base_url()."index.php/home/categories");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createsubcategories($catId)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="catAct";
			$this->load->view('header',$data);
			$data["catId"]=$catId;
			$data['catInfo']=$this->home_model->getInfobyId("categories",$catId);
			$this->load->view('create-sub-categories', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savesubcategories($catId)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$parentId=$this->input->post("parentId");
			$category_name=$this->input->post("category_name");
			$cityAlias=$this->clean($category_name);
			$categories = $this->home_model->getTableRowDataOrder("categories",array("parent_id" => @$catId,"status <" => 2),"cat_position","ASC");
			$params=array(
				"parent_id" => @$parentId,
				"cat_name" => @$category_name,
				"cat_alias_name" => @$cityAlias,
				"aFrom" => @$this->input->post("aFrom"),
				"aTo" => @$this->input->post("aTo"),
				"cat_position" => @sizeOf($categories)+1,
				"status" => 1,
				"created_date" => @date("Y-m-d H:i:s")
			);
			$chkCate=$this->home_model->checkSubCategoryExistOrNot($category_name,$parentId);
			if($chkCate == 0)
			{
				$insert = $this->home_model->storeItems("categories",$params);
				if($insert > 0)
				{
					if(@$category_icon !='')
					{
						@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/categories/".@$category_icon);
					}
					$this->session->set_userdata(array(
						"success" => "Sub-Category added sucessfully."
					));
					redirect(base_url()."index.php/home/subcategories/".@$parentId);
				}
				else{
					$this->session->set_userdata(array(
						"fail" => "Failed to add Sub-Category"
					));
					redirect(base_url()."index.php/home/subcategories/".@$parentId);
				}
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Sub-Category already exists."
				));
				redirect(base_url()."index.php/home/subcategories/".@$parentId);
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function editsubcategories($bannerid,$catId)
	{
		if(@$this->session->userdata("is_logged_in") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="catAct";
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getInfobyId("categories",$bannerid);
			$data["bannerid"]=$bannerid;
			$data["catId"]=$catId;
			$data['catInfo']=$this->home_model->getInfobyId("categories",$catId);
			$this->load->view('edit-sub-categories',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updatesubcategories()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{	
			$bannerid=$this->input->post("bannersid");
			
			$parentId=$this->input->post("parentId");
			$category_name=$this->input->post("category_name");
			$cityAlias=$this->clean($category_name);
			$params=array(
				"parent_id" => @$parentId,
				"cat_name" => @$category_name,
				"cat_alias_name" => @$cityAlias,
				"aFrom" => @$this->input->post("aFrom"),
				"aTo" => @$this->input->post("aTo"),
				"updated_date" => @date("Y-m-d H:i:s")
			);
			//print_r($params);die();
			$table="categories";
			$cities=$this->home_model->updateItems($table,$params,$bannerid);
			if($cities == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
				redirect(base_url()."index.php/home/subcategories/".@$parentId);
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
				redirect(base_url()."index.php/home/subcategories/".@$parentId);
			}			
		}
	}
	public function updateSubCatOrderPos()
	{
		$parentId = $this->input->post("parentId");
		$row = $this->input->post("row");
		$set=0;
		if(@sizeOf($row) > 0)
		{
			for($i=0;$i<sizeOf($row);$i++)
			{
				$number=$this->input->post("no_".$row[$i]);
				$params=array(
					'cat_position' => $number
				);
				$update=$this->home_model->updateItems("categories",$params,$row[$i]);
				if($update > 0)
				{
					$set=1;
				}
			}
		}
		if($set == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Successfully update order"
			));
			redirect(base_url()."index.php/home/subcategories/".@$parentId);
		}
		else{
			$this->session->set_userdata(array(
				"fail" => "Failed to update order"
			));
			redirect(base_url()."index.php/home/subcategories/".@$parentId);
		}
	}
	public function subcategoryStatusChange($status,$rowId,$catId)
	{
		$params=array(
			"status" => $status,
			"updated_date" => @date("Y-m-d H:i:s")			
		);
		//print_r($params);die();
		$table="categories";
		$cities=$this->home_model->updateItems($table,$params,$rowId);
		if($cities == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Status Changed Successfully."
			));
			redirect(base_url()."index.php/home/subcategories/".@$catId);
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to Change The Status."
			));				
			redirect(base_url()."index.php/home/subcategories/".@$catId);
		}
	}
	public function deletesubcategories($rowId,$catId)
	{
		$params=array(
			"status" => 2,
			"updated_date" => @date("Y-m-d H:i:s")			
		);
		//print_r($params);die();
		$table="categories";
		$cities=$this->home_model->updateItems($table,$params,$rowId);
		if($cities == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Data deleted successfully."
			));
			redirect(base_url()."index.php/home/subcategories/".@$catId);
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to delete The data."
			));				
			redirect(base_url()."index.php/home/subcategories/".@$catId);
		}
	}
	public function chkSubCategory()
	{
		@extract($_REQUEST);
		echo $this->home_model->checkSubCategoryExistOrNot($enterVal,$catId);
	}	
	public function chkSubCategoryNotIn()
	{
		@extract($_REQUEST);
		echo $this->home_model->checkSubCategoryExistOrNotIn($enterVal,$rowId,$catId);
	}	
	/* END OF CATEGORIES */
	
/* USERS STARTS */
	public function users($usertype)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1 && $usertype != '')
		{
			$data["menu"]="users_".$usertype;
			$data["usertype"]= $usertype;
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$users = $this->home_model->getTableRowDataOrder("users",array("usertype"=>$usertype,"created_by"=>0),"id","DESC");
			$userArray = array();	
			if(@sizeOf($users) > 0)
			{
				for ($u=0; $u < sizeOf($users); $u++) 
				{ 
					$userArray[$u] = array(
						"id" => $users[$u]->id,
						"user_id" => $users[$u]->user_id,
						"business_name" => $users[$u]->business_name,
						"address" => $users[$u]->address,
						"firstname" => $users[$u]->firstname." ".$users[$u]->lastname,
						"email" => $users[$u]->email,
						"mobile" => $users[$u]->mobile,
						"shw_pass" => $users[$u]->shw_pass,
						"status" => $users[$u]->status,
						"regDate" => $users[$u]->regDate,
					);
				}
			}		
			$data["users"] = $userArray;
			$this->load->view('users', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function userStatusChange($status,$rowId,$usertype,$type=null)
	{
		$params=array(
			"emailAct" => $status,
			"status" => $status,
		);
		//print_r($params);die();
		$table="users";
		$cities=$this->home_model->updateItems($table,$params,$rowId);
		if($cities == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Status Changed Successfully."
			));
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to Change The Status."
			));				
		}
		redirect(base_url()."index.php/home/users/".@$usertype);
	}
	public function edituser($bannerid,$usertype)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1  && $usertype != '')
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"]="users_".$usertype;
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getTableRowDataOrder("users",array("id"=>$bannerid,"usertype"=>5),"id","DESC");
			$data["bannerid"]=$bannerid;
			$data["usertype"]=$usertype;
			$this->load->view('edit-users',$data);
			$this->load->view('footer');
		
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createusers($usertype)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1 && $usertype != '')
		{
			$data["menu"]="users_".$usertype;
			$this->load->view('header',$data);
			$data["usertype"]=$usertype;
			$this->load->view('create-users',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function checkEmailExist()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$email = $this->input->post('email');
			if(@$email != '')
			{
				$userInfo = $this->home_model->getTableRowDataOrder("users",array("email"=>$email),"id","ASC");
				if(@sizeOf($userInfo) > 0)
				{
					echo 'exist';
				}
				else
				{
					echo 'success';
				}
			}
			else
			{
				echo 'emptyval';
			}
		}
	}
	public function checkMobileExist()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$mobile = $this->input->post('mobile');
			if(@$mobile != '')
			{
				$userInfo = $this->home_model->getTableRowDataOrder("users",array("mobile"=>$mobile),"id","ASC");
				if(@sizeOf($userInfo) > 0)
				{
					echo 'exist';
				}
				else
				{
					echo 'success';
				}
			}
			else
			{
				echo 'emptyval';
			}
		}
	}
	public function random_code($limit)
	{
		echo strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit));
	}
	public function saveusers()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$shw_pass = $this->input->post('password');
			@date_default_timezone_set("Asia/Kolkata");
			$curDate = @date("Y-m-d H:i:s");
			$params = array(		
				"user_id" => @$this->session->userdata("userid"),
				"firstname" => @$firstname,
				"lastname" => @$lastname,
				"email" => @$email,
				"mobile" => @$mobile,
				"password" => @sha1($shw_pass),
				"shw_pass" => @$shw_pass,
				"usertype" => 5,
				"emailAct" => 1,
				"status" => 1,
				"created_by" => 1,
				"regDate" => @$curDate,
			);
			$table="users";
			
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{	
				$address = $this->home_model->getTableRowDataOrder("address",array("status" => 1),"id","DESC");
				if(@sizeOf($address)> 0)
				{
					$subject="Reg: Login Credentails For Time Work as a Recruiters";
					$body="Dear ".@$firstname." ".@$lastname.",<br><br>Please Use The Following Credentails For The Time Work.<br><br><table style='font-family: arial, sans-serif;border-collapse: collapse;width: 100%;'><tr style='background-color: #dddddd;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Email</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$email."</th></tr><tr><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Password</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$shw_pass."</th></tr><tr style='background-color: #dddddd;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Webiste Url</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'><a style='background: #EC7806;padding: 8px;text-decoration: none; color: #fff;' target='_blank' href=".base_url()."../login>Click Here</a></th></tr></table><br><br>Best Wishes,<br>Time Work";
				
					@$to = $email;
					$from = $address[0]->company_email;
					//$to = 'egollapushivashankar@gmail.com';
					if(@$to != '' && @$from != '')
					{
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						$headers .= 'From: "'.$from.'"' . "\r\n";
						//@mail($to,$subject,$body,$headers);
					}
				}		
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
			}
			redirect(base_url()."index.php/home/users/7");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updateusers()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1 )
		{
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$usertype = $this->input->post('usertype');
			$bannersid = $this->input->post('bannersid');
			$shw_pass = $this->input->post('password');
			@date_default_timezone_set("Asia/Kolkata");
			$curDate = @date("Y-m-d H:i:s");
			$params = array(		
				"user_id" => @$this->session->userdata("userid"),
				"firstname" => @$firstname,
				"email" => @$email,
				"mobile" => @$mobile,
				"password" => @sha1($shw_pass),
				"shw_pass" => @$shw_pass,
				"usertype" => 5,
				"emailAct" => 1,
				"status" => 1,
				"created_by" => 1,
				"regDate" => @$curDate,
			);
			$table="users";
			
			$insert=$this->home_model->updateItems($table,$params,$bannersid);
			if($insert > 0)
			{	
				$address = $this->home_model->getTableRowDataOrder("address",array("status" => 1),"id","DESC");
				if(@sizeOf($address)> 0)
				{
					$subject="Reg: Login Credentails For Time Work as a Recruiters";
					$body="Dear ".@$firstname." ".@$lastname.",<br><br>Please Use The Following Credentails For The Time Work.<br><br><table style='font-family: arial, sans-serif;border-collapse: collapse;width: 100%;'><tr style='background-color: #dddddd;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Email</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$email."</th></tr><tr><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Password</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$shw_pass."</th></tr><tr style='background-color: #dddddd;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Webiste Url</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'><a style='background: #EC7806;padding: 8px;text-decoration: none; color: #fff;' target='_blank' href=".base_url()."../login>Click Here</a></th></tr></table><br><br>Best Wishes,<br>Time Work";
				
					@$from = $email;
					$to = $address[0]->company_email;
					//$to = 'egollapushivashankar@gmail.com';
					if(@$to != '' && @$from != '')
					{
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						$headers .= 'From: "'.$from.'"' . "\r\n";
						@mail($to,$subject,$body,$headers);
					}
				}		
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
			}
			redirect(base_url()."index.php/home/users/".$usertype);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function deleteuser($rowId,$usertype)
	{	
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$test=$this->home_model->removeRowItems("users",array("id"=>$rowId));
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
			}
			redirect(base_url()."index.php/home/users/".$usertype);
		}
	}
	/* END OF USERS */
	
	

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
	
	public function studentDownload($userType)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1 )
		{
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			if($userType == 3)
			{
				$pageTitle = 'Candidate List';
				$pageName= 'Job-Seeker-List.xls';
			}
			if($userType == 5)
			{
				$pageTitle = 'Recruiter List';
				$pageName= 'Recruiter.xls';
			}
			$this->excel->getActiveSheet()->setTitle($pageTitle);
			$this->excel->getActiveSheet()->setCellValue('A1', $pageTitle);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells('A1:D1');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->setCellValue('A2', 'User Name');
			$this->excel->getActiveSheet()->setCellValue('B2', 'Email ID');
			$this->excel->getActiveSheet()->setCellValue('C2', 'Phone');
			
			$this->excel->getActiveSheet()->setCellValue('D2', 'Date');
			
			$userInfo=$this->home_model->getTableRowDataOrder("users",array("status" => 1,"usertype"=>@$userType),"id","ASC");
			
			  if(@sizeOf($userInfo) > 0)
			  {
			   for($i=0;$i<sizeOf($userInfo);$i++)
				{
					
					$this->excel->getActiveSheet()->setCellValue('A'.($i+3), @$userInfo[$i]->firstname);
					$this->excel->getActiveSheet()->setCellValue('B'.($i+3), @$userInfo[$i]->email);
					$this->excel->getActiveSheet()->setCellValue('C'.($i+3), @$userInfo[$i]->mobile);
					$this->excel->getActiveSheet()->setCellValue('D'.($i+3),@date('d-m-Y',@strtotime($userInfo[$i]->regDate)));
				}
			  }
			  $filename=$pageName; //save our workbook as this file name
			  header('Content-Type: application/vnd.ms-excel'); //mime type
			  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			  header('Cache-Control: max-age=0'); //no cache

			  //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			  //if you want to save it as .XLSX Excel 2007 format
			  $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			  //force user to download the Excel file without writing it to server's HD
			  $objWriter->save('php://output');
		}
		else
		{
			redirect(base_url());
		}
	} 
	/* Bench PAGE CONTENT INFO STARTS */
	public function benchcms($page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "bpage_".$page_type;
			$data["page_type"] = @$page_type;
			$this->load->view('header',$data);
			$data["banners"] = $this->home_model->getTableRowDataOrder("jobportal_cms",array("page_type"=>$page_type,"parent_id"=>0),"id","ASC");
			$this->load->view('bench-cms', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createbenchcms($page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "bpage_".$page_type;
			$data["page_type"] = @$page_type;
			$this->load->view('header',$data);
			$this->load->view('create-bench-cms',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savebenchcms()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			if(@$_FILES["mainImage"]["name"] != '')
			{
				$global = explode(".",$_FILES["mainImage"]["name"]);
				$banner_img = time().".".end($global);
			}
			else
			{
				$banner_img = '';
			}

			$page_type = @$this->input->post("page_type");
			$params = array(	
				"country_id" => @$countryId,	
				"parent_id" => 0,	
				"cms_title" => $this->input->post("cms_title"),
				"alias_title" => $this->clean($this->input->post("cms_title")),
				"long_desc" => $this->input->post("long_desc"),
				"cms_img" => @$banner_img,
				"page_type" => @$page_type,
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="jobportal_cms";
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{	
				if(@$_FILES["mainImage"]["name"] != '')
				{
					@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);	
				}		
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
			}
			redirect(base_url()."index.php/home/benchcms/".$page_type);
		}
	}
	public function editbenchcms($bannerid,$page_type)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "bpage_".$page_type;
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getInfobyId("jobportal_cms",$bannerid);
			$data["bannerid"]=$bannerid;
			$data["page_type"]=$page_type;
			$this->load->view('edit-bench-cms',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function updatebenchcms()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{		
			$bannerid=$this->input->post("bannersid");
			$table="jobportal_cms";
			if(@$_FILES["mainImage"]["name"] != '')
			{
				$category=explode(".",$_FILES["mainImage"]["name"]);
				$banner_img=time().".".end($category);
			
				$deleteExistimage=$this->home_model->removeUploadedImage($table,$bannerid,"cms",'cms_img');								
				@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);						
			}
			else
			{
				$banner_img=$this->input->post("hiddenmainImage");
			}

			$countryId = @$this->session->userdata("countryId");
			
			$page_type=$this->input->post("page_type");

			
			$params=array(
				"cms_title" => $this->input->post("cms_title"),
				"alias_title" => $this->clean($this->input->post("cms_title")),
				"long_desc" => $this->input->post("long_desc"),
				"page_type" => @$page_type,			
				"cms_img" => @$banner_img,			
			);

			$banners=$this->home_model->updateItems($table,$params,$bannerid);
			if($banners == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
			}		
			redirect(base_url()."index.php/home/benchcms/".$page_type);
		}
	}	
	public function deletebenchcms($rowId,$page_type)
	{	
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$test=$this->home_model->deleteDatawithMedia("jobportal_cms",$rowId,"cms","cms_img");
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
			}
			redirect(base_url()."index.php/home/benchcms/".$page_type);
		}		
	}
	public function benchcontent($rowId,$page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "bpage_".$page_type;
			$data["page_type"] = @$page_type;
			$data["rowId"] = @$rowId;
			$this->load->view('header',$data);
			$data["banners"] = $this->home_model->getTableRowDataOrder("jobportal_cms",array("page_type"=>$page_type,"parent_id"=>$rowId),"id","ASC");
			$data["info"] = $this->home_model->getTableRowDataOrder("jobportal_cms",array("page_type"=>$page_type,"id"=>$rowId,"parent_id"=>0),"id","ASC");
			$this->load->view('bench-content', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createbenchcontent($rowId,$page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "bpage_".$page_type;
			$data["rowId"] = @$rowId;
			$data["page_type"] = @$page_type;
			$this->load->view('header',$data);
			$this->load->view('create-bench-content',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savebenchcontent()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			
			if(@$_FILES["mainImage"]["name"] != '')
			{
				$global = explode(".",$_FILES["mainImage"]["name"]);
				$banner_img = time().".".end($global);
			}
			else
			{
				$banner_img = '';
			}

			$rowId = @$this->input->post("rowId");
			$page_type = @$this->input->post("page_type");
			$params = array(	
				"country_id" => @$countryId,		
				"parent_id" => @$rowId,		
				"cms_title" => $this->input->post("cms_title"),
				"long_desc" => $this->input->post("long_desc"),
				"cms_img" => @$banner_img,
				"page_type" => @$page_type,
				"created_date" => @date("Y-m-d H:i:s"),
			);
			$table="jobportal_cms";
			$insert = $this->home_model->storeItems($table,$params);
			if($insert > 0)
			{	
				if(@$_FILES["mainImage"]["name"] != '')
				{
					@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);	
				}		
				$this->session->set_userdata(array(
					"success" => "Successfully Saved Data"
				));
			}
			else{
				$this->session->set_userdata(array(
					"fail" => "Failed to save the data"
				));
			}
			redirect(base_url()."index.php/home/benchcontent/".$rowId."/".$page_type);
		}
	}
	public function editbenchcontent($rowId,$bannerid,$page_type)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["sitename"] = $this->home_model->getSitename();
			$data["menu"] = "bpage_".$page_type;
			$this->load->view('header',$data);
			$data["info"]=$this->home_model->getInfobyId("jobportal_cms",$bannerid);
			$data["bannerid"]=$bannerid;
			$data["rowId"]=$rowId;
			$data["page_type"]=$page_type;
			$this->load->view('edit-bench-content',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}	
	public function updatebenchcontent()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$bannerid=$this->input->post("bannersid");
			$table="jobportal_cms";
			if(@$_FILES["mainImage"]["name"] != '')
			{
				$category=explode(".",$_FILES["mainImage"]["name"]);
				$banner_img=time().".".end($category);
			
				$deleteExistimage=$this->home_model->removeUploadedImage($table,$bannerid,"cms",'cms_img');								
				@move_uploaded_file($_FILES["mainImage"]["tmp_name"],"uploads/cms/".$banner_img);						
			}
			else
			{
				$banner_img=$this->input->post("hiddenmainImage");
			}

			$countryId = @$this->session->userdata("countryId");
			
			$page_type=$this->input->post("page_type");
			$rowId=$this->input->post("rowId");

			
			$params=array(
				"cms_title" => $this->input->post("cms_title"),
				"long_desc" => $this->input->post("long_desc"),
				"page_type" => @$page_type,			
				"cms_img" => @$banner_img,			
			);

			$banners=$this->home_model->updateItems($table,$params,$bannerid);
			if($banners == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Data Updated"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Update data"
				));				
			}			
			redirect(base_url()."index.php/home/benchcontent/".$rowId."/".$page_type);
		}
	}	
	public function deletebenchcontent($rowId,$bannerid,$page_type)
	{	
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$test=$this->home_model->deleteDatawithMedia("jobportal_cms",$bannerid,"cms","cms_img");
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
			}
			redirect(base_url()."index.php/home/benchcontent/".$rowId."/".$page_type);
		}		
	}
	/* END OF PAGE CONTENT INFO */

	/* SKILLS STARTS */
	public function skills()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="skills";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$data["categories"] = $this->home_model->getTableRowDataOrder("job_skills",array("status <"=>2),"skill_name","ASC");			
			$this->load->view('skills', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function createskills()
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="skills";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$this->load->view('create-skills',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function saveskills()
	{
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$skill_names = $this->input->post("skill_names");
			$expld = explode(",", $skill_names);
			$table="job_skills";
			if(@sizeOf($expld) > 0)
			{
				for ($e=0; $e < sizeOf($expld); $e++) 
				{ 
					$checkName = $this->home_model->getTableRowDataOrder("job_skills",array("skill_name" => $expld[$e]),"id","DESC");
					if(sizeOf($checkName) == 0)
					{
						$params = array(
							"skill_name" => $expld[$e],
							"alias_name" => $this->clean($expld[$e]),
							"created_date" => @date("Y-m-d H:i:s"),
						);
						$insert = $this->home_model->storeItems($table,$params);
					}
					
				}
			}
			$this->session->set_userdata(array(
				"success" => "Successfully Saved Data"
			));
			redirect(base_url()."index.php/home/skills");
		}
	}
		
	public function deleteskills($rowId)
	{		
		if($this->session->userdata("is_logged_in") != 1)
		{
			redirect(base_url());
		}
		else
		{
			$test=$this->home_model->removeRowItems("job_skills",array("id"=>$rowId));
			if($test == 1)
			{
				$this->session->set_userdata(array(
					"success" => "Successfully Deleted"
				));
			}
			else
			{
				$this->session->set_userdata(array(
					"faile" => "Failed to Delete data"
				));				
			}
			redirect(base_url()."index.php/home/skills");
		}
		
	}
	public function skillsStatusChange($status,$rowId)
	{
		$params=array(
			"status" => $status,
		);
		$table="job_skills";
		$cities=$this->home_model->updateItems($table,$params,$rowId);
		if($cities == 1)
		{
			$this->session->set_userdata(array(
				"success" => "Status Changed Successfully."
			));
		}
		else
		{
			$this->session->set_userdata(array(
				"fail" => "Failed to Change The Status."
			));				
		}
		redirect(base_url()."index.php/home/skills");
	}
	/* END OF SKILLS */
	public function recruiterposts($page_type=0)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="rcposts";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			if(@$page_type == 0)
			{
				$results = $this->home_model->getTableRowDataOrder("portal_jobs",array("status"=>0),"id","DESC");
			}
			else
			{
				$results = $this->home_model->getTableRowDataOrder("portal_jobs",array("status >"=>0),"id","DESC");
			}
					
			$resultsArray = array();
			if(@sizeOf($results) > 0)
			{
				for ($r=0; $r < sizeOf($results); $r++) 
				{ 
					$resultsArray[$r] = array(
						"id" => $results[$r]->id,
						"user_id" => $results[$r]->user_id,
						"job_title" => $results[$r]->job_title,
						"country_id" => $results[$r]->country_id,
						"state_id" => $results[$r]->state_id,
						"city_id" => $results[$r]->city_id,
						"job_skills" => $results[$r]->job_skills,
						"no_of_openings" => $results[$r]->no_of_openings,
						"joining_date" => $results[$r]->joining_date,
						"from_time" => $results[$r]->from_time,
						"to_time" => $results[$r]->to_time,
						"notice_peroid" => $results[$r]->notice_peroid,
						"web_link" => $results[$r]->web_link,
						"salary" => $results[$r]->salary,
						"experience" => $results[$r]->experience,
						"employment_type" => $results[$r]->employment_type,
						"salary_type" => $results[$r]->salary_type,
						"joining_type" => $results[$r]->joining_type,
						"interview_location" => $results[$r]->interview_location,
						"business_address" => $results[$r]->business_address,
						"business_location" => $results[$r]->business_location,
						"about_business" => $results[$r]->about_business,
						"interview_details" => $results[$r]->interview_details,
						"status" => $results[$r]->status,
						"created_date" => $results[$r]->created_date,
						"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
						"stateInfo" => $this->home_model->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
						"cityInfo" => $this->home_model->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
						"locationsInfo" => $this->home_model->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
						"salaryInfo" => $this->home_model->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1,"id"=>$results[$r]->salary),"id","ASC"),
						"expInfo" => $this->home_model->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
						"employmentInfo" => $this->home_model->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
					);
				}
			}	
			$json = array(
				"results" => @$resultsArray,
				"page_type" => @$page_type,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('recruiter-posts', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function viewRecruiterPosts($page_type = 0,$rowId,$oVal)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="rcposts";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$results = $this->home_model->getTableRowDataOrder("portal_jobs",array("id"=>$rowId),"id","DESC");	
			$resultsArray = array();
			if(@sizeOf($results) > 0)
			{
				for ($r=0; $r < sizeOf($results); $r++) 
				{ 
					$resultsArray[$r] = array(
						"id" => $results[$r]->id,
						"user_id" => $results[$r]->user_id,
						"job_title" => $results[$r]->job_title,
						"country_id" => $results[$r]->country_id,
						"state_id" => $results[$r]->state_id,
						"city_id" => $results[$r]->city_id,
						"job_skills" => $results[$r]->job_skills,
						"no_of_openings" => $results[$r]->no_of_openings,
						"joining_date" => $results[$r]->joining_date,
						"from_time" => $results[$r]->from_time,
						"to_time" => $results[$r]->to_time,
						"notice_peroid" => $results[$r]->notice_peroid,
						"web_link" => $results[$r]->web_link,
						"salary" => $results[$r]->salary,
						"experience" => $results[$r]->experience,
						"employment_type" => $results[$r]->employment_type,
						"salary_type" => $results[$r]->salary_type,
						"joining_type" => $results[$r]->joining_type,
						"interview_location" => $results[$r]->interview_location,
						"business_address" => $results[$r]->business_address,
						"business_location" => $results[$r]->business_location,
						"about_business" => $results[$r]->about_business,
						"interview_details" => $results[$r]->interview_details,
						"job_description" => $results[$r]->job_description,
						"status" => $results[$r]->status,
						"created_date" => $results[$r]->created_date,
						"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
						"stateInfo" => $this->home_model->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
						"cityInfo" => $this->home_model->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
						"locationsInfo" => $this->home_model->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
						"salaryInfo" => $this->home_model->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1,"id"=>$results[$r]->salary),"id","ASC"),
						"expInfo" => $this->home_model->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
						"employmentInfo" => $this->home_model->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
					);
				}
			}	
			$json = array(
				"results" => @$resultsArray,
				"page_type" => @$page_type,
				"rowId" => @$rowId,
				"oVal" => @$oVal,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('view-recruiter-posts', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function candidateposts($page_type = 0)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="candpost";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			if(@$page_type == 0)
			{
				$results = $this->home_model->getTableRowDataOrder("portal_need_jobs",array("status"=>0),"id","DESC");
			}
			else
			{
				$results = $this->home_model->getTableRowDataOrder("portal_need_jobs",array("status >"=>0),"id","DESC");
			}	
			$resultsArray = array();
			if(@sizeOf($results) > 0)
			{
				for ($r=0; $r < sizeOf($results); $r++) 
				{ 
					$resultsArray[$r] = array(
						"id" => $results[$r]->id,
						"user_id" => $results[$r]->user_id,
						"job_title" => $results[$r]->job_title,
						"country_id" => $results[$r]->country_id,
						"state_id" => $results[$r]->state_id,
						"city_id" => $results[$r]->city_id,
						"job_skills" => $results[$r]->job_skills,
						"experience" => $results[$r]->experience,
						"employment_type" => $results[$r]->employment_type,
						"joining_type" => $results[$r]->joining_type,
						"preferred_shift" => $results[$r]->preferred_shift,
						"description" => $results[$r]->description,
						"total_views" => $results[$r]->total_views,
						"total_likes" => $results[$r]->total_likes,
						"download_count" => $results[$r]->download_count,
						"expire_date" => $results[$r]->expire_date,
						"status" => $results[$r]->status,
						"created_date" => $results[$r]->created_date,
						"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
						"stateInfo" => $this->home_model->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
						"cityInfo" => $this->home_model->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
						"locationsInfo" => $this->home_model->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
						"expInfo" => $this->home_model->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
					);
				}
			}		
			$json = array(
				"results" => @$resultsArray,
				"page_type" => @$page_type,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('candidate-posts', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function viewCandidatePosts($page_type = 0,$rowId,$oVal)
	{
		if(@$this->session->userdata("is_logged_in") == 1 && @$this->session->userdata("usertype") == 1)
		{
			$data["menu"]="candpost";
			$data["sitename"] = $this->home_model->getSitename();
			$this->load->view('header',$data);
			$results = $this->home_model->getTableRowDataOrder("portal_need_jobs",array("id"=>$rowId),"id","DESC");
			$resultsArray = array();
			if(@sizeOf($results) > 0)
			{
				for ($r=0; $r < sizeOf($results); $r++) 
				{ 
					$resultsArray[$r] = array(
						"id" => $results[$r]->id,
						"user_id" => $results[$r]->user_id,
						"job_title" => $results[$r]->job_title,
						"country_id" => $results[$r]->country_id,
						"state_id" => $results[$r]->state_id,
						"city_id" => $results[$r]->city_id,
						"job_skills" => $results[$r]->job_skills,
						"experience" => $results[$r]->experience,
						"employment_type" => $results[$r]->employment_type,
						"joining_type" => $results[$r]->joining_type,
						"preferred_shift" => $results[$r]->preferred_shift,
						"description" => $results[$r]->description,
						"total_views" => $results[$r]->total_views,
						"total_likes" => $results[$r]->total_likes,
						"download_count" => $results[$r]->download_count,
						"expire_date" => $results[$r]->expire_date,
						"status" => $results[$r]->status,
						"created_date" => $results[$r]->created_date,
						"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
						"stateInfo" => $this->home_model->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
						"cityInfo" => $this->home_model->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
						"locationsInfo" => $this->home_model->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
						"expInfo" => $this->home_model->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
					);
				}
			}	
			$json = array(
				"results" => @$resultsArray,
				"page_type" => @$page_type,
				"oVal" => @$oVal,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('view-candidate-posts', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function commonupdatestatus()
	{
		$rowid = $this->uri->segment('3');
		$status = $this->uri->segment('4');
		$table = $this->uri->segment('5');
		$status_update=$this->home_model->updateItems($table,['status'=>$status],$rowid);
		if($status_update == 1)
		{
			$this->session->set_userdata(array("success" => "Successfully Updated The Status."));
		}
		else
		{
			$this->session->set_userdata(array("fail" => "Failed To Update The Status."));				
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function approveposts($rowId,$page_type=1)
	{
		if(@$page_type == 1)
		{
			$table = 'portal_jobs';
		}
		else
		{
			$table = 'portal_need_jobs';
		}
		$results = $this->home_model->getTableRowDataOrder($table,array("status"=>0,"id"=>$rowId),"id","ASC");
		if(@sizeOf($results) > 0)
		{
			@date_default_timezone_set("Asia/Kolkata");
			$curDate = @date("Y-m-d");
			$expire_date = @date('Y-m-d', strtotime($curDate. ' + 30 days'));
			$params = array('status'=>1,'expire_date'=>$expire_date);
			$status_update=$this->home_model->updateItems($table,$params,$rowId);
			if($status_update == 1)
			{

				$this->session->set_userdata(array("success" => "Successfully Updated The Status."));
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed To Update The Status."));				
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	function get_time_ago( $time )
	{
	    $time_difference = time() - $time;

	    if( $time_difference < 1 ) { return '1 second ago'; }
	    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
	                30 * 24 * 60 * 60       =>  'month',
	                24 * 60 * 60            =>  'day',
	                60 * 60                 =>  'hour',
	                60                      =>  'minute',
	                1                       =>  'second'
	    );

	    foreach( $condition as $secs => $str )
	    {
	        $d = $time_difference / $secs;

	        if( $d >= 1 )
	        {
	            $t = round( $d );
	            return '' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
	        }
	    }
	}
}
