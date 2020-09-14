<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruiter extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sql');	
	}
	public function index()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			/*index Page Coding End*/
			
			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"userInfo" => @$userInfo,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'dashboard',
				"homeActive" => 'home',
				"homeActive" => 'home',
				"searchpage" => 1,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('recruiter/index',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function editprofile()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			$states = $this->sql->getTableRowDataOrder("states",array("status"=>1),"state_name","ASC");
			$citiesInfo = $locations = array();
			if(@sizeOf($userInfo) > 0)
			{
				$stat_Id = $userInfo[0]->state_id;
				if($stat_Id != '')
				{
					$citiesInfo = $this->sql->getTableRowDataOrder("cities",array("status"=>1,"state_id"=>$stat_Id),"city_name","ASC");
					if(@$userInfo[0]->city_id != '')
					{
						$locations = $this->sql->getTableRowDataOrder("locations",array("state_id"=>$stat_Id,"status " => 1,"city_id"=>@$userInfo[0]->city_id),"location_name","ASC");
						
					}
				}
			}
			$jobskills = $this->sql->getTableRowDataOrder("job_skills",array("status" => 1),"skill_name","ASC");
			/*index Page Coding End*/
			
			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"userInfo" => @$userInfo,
				"jobskills" => @$jobskills,
				"states" => @$states,
				"citiesInfo" => @$citiesInfo,
				"locations" => @$locations,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'editprofile',
				"homeActive" => 'editprofile',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('recruiter/edit-profile',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updateProfile()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5' ||  @$this->session->userdata("usertype") == '3')
		{
			$userid = @$this->session->userdata("userid");

			if(@$_FILES["profile_pic"]["name"] != '')
			{
				$category=explode(".",$_FILES["profile_pic"]["name"]);
				$profile_pic=time().".".end($category);
			
				$deleteExistimage=$this->sql->removeAdminUploadedImage("users",$userid,'users','profile_pic');								
				@move_uploaded_file($_FILES["profile_pic"]["tmp_name"],"admin/uploads/users/".$profile_pic);						
			}
			else
			{
				$profile_pic=$this->input->post("hiddenprofile_pic");
			}

			if(@$_FILES["business_logo"]["name"] != '')
			{
				$category1 = explode(".",$_FILES["business_logo"]["name"]);
				$business_logo = "blogo-".time().".".end($category1);
			
				$deleteExistimage=$this->sql->removeAdminUploadedImage("users",$userid,'users','business_logo');								
				@move_uploaded_file($_FILES["business_logo"]["tmp_name"],"admin/uploads/users/".$business_logo);						
			}
			else
			{
				$business_logo = $this->input->post("hiddenbusiness_logo");
			}

			$job_skills = @implode(",", $this->input->post("job_skills"));
			$params = array(
				"firstname" => @$this->input->post('v_name'),
				"mobile" => @$this->input->post('mobile'),
				"rec_type" => @$this->input->post("rec_type"),
				"business_name" => @$this->input->post("v_businessname"),
				"address" => @$this->input->post("v_address"),
				"state_id" => @$this->input->post("v_state"),
				"city_id" => @$this->input->post("v_city"),
				"area_info" => @$this->input->post("v_location"),
				"city_zipcode" => @$this->input->post("v_zipcode"),
				"job_skills" => @$job_skills,
				"roles_info" => @$this->input->post("roles_info"),
				"date_of_birth" => @$this->input->post("date_of_birth"),
				"marital_status" => @$this->input->post("marital_status"),
				"languages_known" => @$this->input->post("languages_known"),
				"experience" => @$this->input->post("experience"),
				"about_business" => @$this->input->post("about_business"),
				"business_logo" => @$business_logo,
				"profile_pic" => @$profile_pic,
			);
			$update = $this->sql->updateItems("users",$params,array("id"=>$userid));
			if($update > 0)
			{
				$prms=array(
					'userid' => $userid,
					'nMessage' => "Successfully Updated The Profile",
					'createDate' => @date("Y-m-d H:i:s"),
					'updateDate' => @date("Y-m-d H:i:s")
				);
				$ins1=$this->sql->storeItems("usernotifications",$prms);

				$this->session->set_userdata(array("success" => "Successfully Updated Your Profile."));
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed to Update Your Profile. Please Try Again Once"));
			}
			if(@$this->session->userdata("usertype") == '5')
			{
				redirect(base_url()."recruiter/editprofile");
			}
			if(@$this->session->userdata("usertype") == '3')
			{
				redirect(base_url()."jobseeker/editprofile");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function changepassword()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			/*index Page Coding End*/
			
			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"userInfo" => @$userInfo,
				"states" => @$states,
				"citiesInfo" => @$citiesInfo,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'chngpwd',
				"homeActive" => 'home',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('recruiter/change-password',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updateUserPassword()
	{
		if($this->session->userdata("is_logged_in") == 1)
		{
			$userId=@$this->session->userdata("userid");
			$oldpassword = $this->input->post("oldpassword");
			$password=$this->input->post("upassword");
			$npassword=$this->input->post("npassword");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("shw_pass"=>@$oldpassword,"id"=>$userId),"id","ASC");
			if(@sizeOf($userInfo) > 0)
			{
				if(@$password == @$npassword)
				{
					$params=array(
						"password" => sha1($this->input->post("upassword")),
						"shw_pass" => $this->input->post("upassword"),
					);
					$update=$this->sql->updateItems("users",$params,array("id" => $userId));
					if($update == 1)
					{
						$prms=array(
							'userid' => $userId,
							'nMessage' => "Password has been changed successfully",
							'createDate' => @date("Y-m-d H:i:s"),
							'updateDate' => @date("Y-m-d H:i:s")
						);
						$ins1=$this->sql->storeItems("usernotifications",$prms);

						$this->session->set_userdata(array(
							"success" => "Your password has been changed successfully."
						));
					}
					else
					{
						$this->session->set_userdata(array(
							"fail" => "Failed to change your profile. Please Try Again."
						));
					}
				}
				else
				{
					$this->session->set_userdata(array(
						"fail" => "New password and confirm password is not macthing"
					));
					
				}
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Old Password is wrong. Please Enter Correct Password"
				));
			}
			if(@$this->session->userdata("usertype") == '5')
			{
				redirect(base_url()."recruiter/changepassword");
			}
			if(@$this->session->userdata("usertype") == '3')
			{
				redirect(base_url()."jobseeker/changepassword");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function accountstatus()
	{
		if($this->session->userdata("is_logged_in") == 1)
		{
			$userId=@$this->session->userdata("userid");
			$actpwd = $this->input->post("actpwd");
			$status = $this->input->post("status");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("shw_pass"=>@$actpwd,"id"=>$userId),"id","ASC");
			if(@sizeOf($userInfo) > 0)
			{
				$params=array(
					'is_online' => $status,
				);
				$update = $this->sql->updateItems("users",$params,array("id" => @$userId));
				if($update == 1)
				{
					if($status == 1)
					{
						$this->session->set_userdata(array(
							"success" => "Your Account Activated Successfully."
						));
					}
					else
					{
						$this->session->set_userdata(array(
							"success" => "Your Account Dectivated Successfully."
						));
					}
					
				}
				else
				{
					$this->session->set_userdata(array(
						"fail" => "Failed to change your Account Status. Please Try Again."
					));
				}
				
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Password is wrong. Please Enter Correct Password"
				));
			}
			if(@$this->session->userdata("usertype") == '5')
			{
				redirect(base_url()."recruiter/changepassword");
			}
			if(@$this->session->userdata("usertype") == '3')
			{
				redirect(base_url()."jobseeker/changepassword");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function jobpostings($page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			/*index Page Coding End*/

			@date_default_timezone_set("Asia/Kolkata");
			$curDate = @date("Y-m-d");
			if(@$page_type == 2)
			{
				$results = $this->sql->getTableRowDataOrder("portal_jobs",array("country_id" => 1,"user_id"=>$userid,'expire_date <'=>$curDate),"expire_date","ASC");
			}
			else if(@$page_type == 3)
			{
				$results = $this->sql->getTableRowDataOrder("portal_jobs",array("country_id" => 1,"user_id"=>$userid,'status'=>0),"id","DESC");
			}
			else
			{
				$results = $this->sql->getTableRowDataOrder("portal_jobs",array("country_id" => 1,"user_id"=>$userid,'expire_date >='=>$curDate),"expire_date","ASC");
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
						"joining_type" => $results[$r]->joining_type,
						"from_time" => $results[$r]->from_time,
						"to_time" => $results[$r]->to_time,
						"notice_peroid" => $results[$r]->notice_peroid,
						"web_link" => $results[$r]->web_link,
						"salary" => $results[$r]->salary,
						"experience" => $results[$r]->experience,
						"employment_type" => $results[$r]->employment_type,
						"salary_type" => $results[$r]->salary_type,
						"interview_location" => $results[$r]->interview_location,
						"business_address" => $results[$r]->business_address,
						"business_location" => $results[$r]->business_location,
						"about_business" => $results[$r]->about_business,
						"interview_details" => $results[$r]->interview_details,
						"job_description" => $results[$r]->job_description,
						"status" => $results[$r]->status,
						"expire_date" => $results[$r]->expire_date,
						"total_views" => $results[$r]->total_views,
						"total_likes" => $results[$r]->total_likes,
						"created_date" => $results[$r]->created_date,
						"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
						"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
						"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
						"salaryInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1,"id"=>$results[$r]->salary),"id","ASC"),
						"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
					);
				}
			}
			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"userInfo" => @$userInfo,
				"results" => @$resultsArray,
				"page_type" => @$page_type,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'jobpostings',
				"homeActive" => 'jobpostings',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('recruiter/job-postings',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function jobStatusChange($status,$rowId)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") =='5')
		{
			$params=array(
				"status" => $status,
			);
			//print_r($params);die();
			$userid = @$this->session->userdata("userid");
			$table="portal_jobs";
			$cities=$this->sql->updateItems($table,$params,array("id"=>$rowId,"user_id" => $userid));
			if($cities == 1)
			{
				
				$jobslistings = $this->sql->getTableRowDataOrder($table,array("id"=>$rowId,"user_id" => $userid),"id","ASC");
				if(@sizeOf($jobslistings) > 0)
				{
					$prms=array(
						'userid' => $userid,
						'nMessage' => "Status Changed Successfully. <strong>".@$jobslistings[0]->job_title."</strong>",
						'createDate' => @date("Y-m-d H:i:s"),
						'updateDate' => @date("Y-m-d H:i:s")
					);
					$ins1=$this->sql->storeItems("usernotifications",$prms);
				}
				

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
			redirect(base_url()."recruiter/jobpostings");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function postjobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			$jobskills = $this->sql->getTableRowDataOrder("job_skills",array("status" => 1),"skill_name","ASC");
			$categories = $this->sql->getTableRowDataOrder("categories",array("parent_id" => 0,"status <" => 2),"cat_position","DESC");
			$catArray=array();
			if(@sizeOf($categories) > 0)
			{
				for($c=0;$c<@sizeOf($categories);$c++)
				{
					$catArray[$c]=array(
						"id" => @$categories[$c]->id,
						"cat_name" => @$categories[$c]->cat_name,
						"cat_alias_name" => @$categories[$c]->cat_alias_name,
						"status" => @$categories[$c]->status,
						"subCategories" => $this->sql->getTableRowDataOrder("categories",array("parent_id" => @$categories[$c]->id,"status <" => 2),"id","ASC"),
					);
				}
			}
			$states = $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1),"state_name","ASC");
			/*index Page Coding End*/
			
			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"userInfo" => @$userInfo,
				"states" => @$states,
				"categories" => @$catArray,
				"jobskills" => @$jobskills,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'jobpostings',
				"homeActive" => 'jobpostings',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('recruiter/post-jobs',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savePostJobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			$country_id = '1';
			$userid = @$this->session->userdata("userid");
			@date_default_timezone_set("Asia/Kolkata");
			$curDate = @date("Y-m-d H:i:s");
			$job_skills = @implode(",", $this->input->post("job_skills"));
			$params = array(
				"user_id" => @$userid,
				"country_id" => @$country_id,
				"job_title" => @$this->input->post("job_title"),
				"state_id" => @$this->input->post("job_state"),
				"city_id" => @$this->input->post("job_city"),
				"location_id" => @$this->input->post("job_location"),
				"job_skills" => @$job_skills,
				"no_of_openings" => @$this->input->post("no_of_posts"),
				"joining_type" => @$this->input->post("joining_type"),
				"from_time" => @$this->input->post("from_time"),
				"to_time" => @$this->input->post("to_time"),
				"notice_peroid" => @$this->input->post("notice_period"),
				"web_link" => @$this->input->post("web_link"),
				"salary" => @$this->input->post("job_salary"),
				"experience" => @$this->input->post("experience"),
				"employment_type" => @$this->input->post("employment_type"),
				"salary_type" => @$this->input->post("salary_type"),
				"interview_location" => @$this->input->post("interview_location"),
				"business_address" => @$this->input->post("business_adrs"),
				"business_location" => @$this->input->post("map_locations"),
				"about_business" => @$this->input->post("about_business"),
				"job_description" => @$this->input->post("job_description"),
				"interview_details" => @$this->input->post("interview_details"),
				"status" => 0,
				"created_date" => @$curDate,
			);
			$insert = $this->sql->storeItems("portal_jobs",$params);
			if($insert > 0)
			{
				$prms=array(
					'userid' => $userid,
					'nMessage' => "Successfully Updated The Job Updated. <strong>".@$this->input->post("job_title")."</strong>",
					'createDate' => @date("Y-m-d H:i:s"),
					'updateDate' => @date("Y-m-d H:i:s")
				);
				$ins1=$this->sql->storeItems("usernotifications",$prms);
			

				$this->session->set_userdata(array("success" => "Successfully Updated The Job Details."));
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed to Update Job Details. Please Try Again Once"));
			}
			redirect(base_url()."recruiter/jobpostings/3");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function editJobs($rowId)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$results = $this->sql->getTableRowDataOrder("portal_jobs",array("country_id" => 1,"user_id"=>$userid,"id"=>$rowId,"update_count"=> 0),"id","DESC");
			if(@sizeOf($results) > 0)
			{
				$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
				$jobskills = $this->sql->getTableRowDataOrder("job_skills",array("status" => 1),"skill_name","ASC");
				$categories = $this->sql->getTableRowDataOrder("categories",array("parent_id" => 0,"status <" => 2),"cat_position","DESC");
				$catArray=array();
				if(@sizeOf($categories) > 0)
				{
					for($c=0;$c<@sizeOf($categories);$c++)
					{
						$catArray[$c]=array(
							"id" => @$categories[$c]->id,
							"cat_name" => @$categories[$c]->cat_name,
							"cat_alias_name" => @$categories[$c]->cat_alias_name,
							"status" => @$categories[$c]->status,
							"subCategories" => $this->sql->getTableRowDataOrder("categories",array("parent_id" => @$categories[$c]->id,"status <" => 2),"id","ASC"),
						);
					}
				}
				$states = $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1),"state_name","ASC");
				$cities = $locations = array();
				if(@$results[0]->state_id != '')
				{
					$cities = $this->sql->getTableRowDataOrder("cities",array("state_id"=>$results[0]->state_id,"status " => 1),"city_name","ASC");
					if(@$results[0]->city_id != '')
					{
						$locations = $this->sql->getTableRowDataOrder("locations",array("state_id"=>$results[0]->state_id,"status " => 1,"city_id"=>@$results[0]->city_id),"id","ASC");
						
					}
				}
				
				/*index Page Coding End*/
				
				/*Footer Coding Starts*/
				$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
				$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
				/*Footer Coding End*/
			
				$json = array(
					"userInfo" => @$userInfo,
					"states" => @$states,
					"cities" => @$cities,
					"locations" => @$locations,
					"rowId" => @$rowId,
					"categories" => @$catArray,
					"results" => @$results,
					"jobskills" => @$jobskills,
					"address" => @$address,
					"sociallinks" => @$sociallinks,
					"dashAct" => 'jobpostings',
					"homeActive" => 'jobpostings',
				);
				$encodeJson = json_encode($json);
				$data["jsonObj"] = $encodeJson;
				//$this->load->view('recruiter/dash-header',$data);
				$this->load->view('home/header',$data);
				$this->load->view('recruiter/edit-post-jobs',$data);
				$this->load->view('home/footer',$data);
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed to Edit Job. Please Try Again Once"));
				redirect(base_url()."recruiter/jobpostings");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updatePostJobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			$country_id = '1';
			$userid = @$this->session->userdata("userid");
			@date_default_timezone_set("Asia/Kolkata");
			$curDate = @date("Y-m-d H:i:s");
			$job_skills = @implode(",", $this->input->post("job_skills"));
			$params = array(
				"user_id" => @$userid,
				"country_id" => @$country_id,
				"job_title" => @$this->input->post("job_title"),
				"state_id" => @$this->input->post("job_state"),
				"city_id" => @$this->input->post("job_city"),
				"location_id" => @$this->input->post("job_location"),
				"job_skills" => @$job_skills,
				"no_of_openings" => @$this->input->post("no_of_posts"),
				"joining_type" => @$this->input->post("joining_type"),
				"from_time" => @$this->input->post("from_time"),
				"to_time" => @$this->input->post("to_time"),
				"notice_peroid" => @$this->input->post("notice_period"),
				"web_link" => @$this->input->post("web_link"),
				"salary" => @$this->input->post("job_salary"),
				"experience" => @$this->input->post("experience"),
				"employment_type" => @$this->input->post("employment_type"),
				"salary_type" => @$this->input->post("salary_type"),
				"interview_location" => @$this->input->post("interview_location"),
				"business_address" => @$this->input->post("business_adrs"),
				"business_location" => @$this->input->post("map_locations"),
				"about_business" => @$this->input->post("about_business"),
				"interview_details" => @$this->input->post("interview_details"),
				"job_description" => @$this->input->post("job_description"),
				"update_count" => 1,
				"created_date" => @$curDate,
			);

			$rowId = @$this->input->post("rowId");
			$insert = $this->sql->updateItems("portal_jobs",$params,array("user_id"=>$userid,"id"=>$rowId,"update_count"=> 0));
			if($insert > 0)
			{
				$prms=array(
					'userid' => $userid,
					'nMessage' => "Successfully Created The Job. <strong>".@$this->input->post("job_title")."</strong>",
					'createDate' => @date("Y-m-d H:i:s"),
					'updateDate' => @date("Y-m-d H:i:s")
				);
				$ins1=$this->sql->storeItems("usernotifications",$prms);
			

				$this->session->set_userdata(array("success" => "Successfully Created The Job Content."));
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed to Create Job Content. Please Try Again Once"));
			}
			redirect(base_url()."recruiter/jobpostings");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function deleteJobs($rowId)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") =='5')
		{	
			$userid = @$this->session->userdata("userid");
			$jobslistings = $this->sql->getTableRowDataOrder("portal_jobs",array("id"=>$rowId,"user_id" => $userid),"id","ASC");
			if(@sizeOf($jobslistings) > 0)
			{
				$delete = $this->sql->removeRowItems("portal_jobs",array("id"=>$rowId,"user_id" => $userid));
				if(@$delete == 1)
				{
					$prms=array(
						'userid' => $userid,
						'nMessage' => "Successfully Deleted The Job. <strong>".@$jobslistings[0]->job_title."</strong>",
						'createDate' => @date("Y-m-d H:i:s"),
						'updateDate' => @date("Y-m-d H:i:s")
					);
					$ins1=$this->sql->storeItems("usernotifications",$prms);
					$this->session->set_userdata(array("success" => "Successfully Deleted Job and Job Details"));
				}
				else
				{
					$this->session->set_userdata(array("fail" => "Failed to Delete This Job. Please Try Again Once"));
				}
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed to Delete This Job. Please Try Again Once"));
				
			}
			redirect(base_url()."recruiter/jobpostings");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function search()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");

			$skillnames = @$_REQUEST['skillnames'];

			$location = @$_REQUEST['location'];
			$city_id = $state_id = 0;
			if(@$location != '')
			{
				$checkCity = $this->sql->getTableRowDataOrder("cities",array("city_name"=>$location),"id","ASC");
				if(@sizeOf($checkCity) > 0)
				{
					$city_id =  $checkCity[0]->id;
					$state_id =  $checkCity[0]->state_id;
				}
			}
			$results = $this->sql->getTotalResultsForRec($skillnames,$state_id,$city_id);
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
						"status" => $results[$r]->status,
						"created_date" => $results[$r]->created_date,
						"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
						"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
						"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
						"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
						"employmentInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
						"likedJobs" => $this->sql->getLikedJobs($results[$r]->id,2,$userid),
						"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
					);
				}
			}
			$empInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1),"id","ASC");
			$experienceInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1),"id","ASC");
			$statesInfo = $this->sql->getTableRowDataOrder("states",array("status" => 1),"state_name","ASC");
			if(@$state_id > 0)
			{
				$citiesInfo = $this->sql->getTableRowDataOrder("cities",array("status" => 1,"state_id"=>$state_id),"city_name","ASC");
			}
			
			/*index Page Coding End*/
			
			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"userInfo" => @$userInfo,
				"results" => @$resultsArray,
				"empInfo" => @$empInfo,
				"experienceInfo" => @$experienceInfo,
				"statesInfo" => @$statesInfo,
				"citiesInfo" => @$citiesInfo,
				"city_id" => @$city_id,
				"state_id" => @$state_id,
				"skillnames" => @$skillnames,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"searchpage" => 1,
				"pagetype" => 0,
				"dashAct" => 'dashboard',
				"homeActive" => 'sjobs',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('recruiter/search-results',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function getProductsByAttributes()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			$userid = @$this->session->userdata("userid");

			$stateslist = @$_REQUEST['stateslist'];

			$citylist = @$_REQUEST['citylist'];

			$emptypelist = @$_REQUEST['emptypelist'];

			$experiencelist = @$_REQUEST['experiencelist'];

			$joiningtypelist = @$_REQUEST['joiningtypelist'];

			$shiftlist = @$_REQUEST['shiftlist'];

			$jobfressnesslist = @$_REQUEST['jobfressnesslist'];
			
			$skillnames= '';

			$pagetype = @$_REQUEST['pagetype'];
			$results = array();
			if(@$pagetype == 1)
			{
				$userid = @$this->session->userdata("userid");
				$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
				$job_skills = $userInfo[0]->job_skills;
				$jobSkills = @explode(",", $job_skills);
				if(@$jobSkills != '')
				{
					$results = $this->sql->getResultsBySkills(@$job_skills,$stateslist,$citylist,$emptypelist,$experiencelist,$joiningtypelist,$shiftlist,$jobfressnesslist);
				}
			}
			else
			{
				$results = $this->sql->getTotalResultsForRec(@$skillnames,$stateslist,$citylist,$emptypelist,$experiencelist,$joiningtypelist,$shiftlist,$jobfressnesslist);
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
						"status" => $results[$r]->status,
						"created_date" => $results[$r]->created_date,
						"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
						"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
						"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
						"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
						"employmentInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
						"likedJobs" => $this->sql->getLikedJobs($results[$r]->id,2,$userid),
						"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
					);
				}
			}
			$json = array(
				"results" => @$resultsArray,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('recruiter/ajax-results',$data);
		}
	}
	public function likedjobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			/*index Page Coding End*/
			$resultsArray = array();
			$likedJobs = $this->sql->getTableRowDataOrder("liked_jobs",array("user_id" => @$userid,"page_type" => 2),"id","DESC");
			if(@sizeOf($likedJobs) > 0)
			{
				for ($i=0; $i < sizeOf($likedJobs); $i++) 
				{ 
					$jobIds[] = $likedJobs[$i]->job_id;
				}
				$jobIds = @array_unique($jobIds);
				if(@sizeOf($jobIds) > 0)
				{
					$results = $this->sql->getTableRowDataArrayOrder("portal_need_jobs",array("country_id" => 1,"status"=>1),$jobIds,'id',"id","DESC");
					
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
								"status" => $results[$r]->status,
								"created_date" => $results[$r]->created_date,
								"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
								"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
								"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
								"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
								"employmentInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
								"likedJobs" => $this->sql->getLikedJobs($results[$r]->id,2,$userid),
								"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
							);
						}
					}
				}
			}
			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"userInfo" => @$userInfo,
				"results" => @$resultsArray,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'likedjobs',
				"homeActive" => 'likedjobs',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('recruiter/liked-jobs',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function suggestedjobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			$resultsArray = array();
			if(@sizeOf($userInfo) > 0)
			{
				$job_skills = $userInfo[0]->job_skills;
				$jobSkills = @explode(",", $job_skills);
				if(@$jobSkills != '')
				{
					$results = $this->sql->getTotalResultsBySkills($job_skills);
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
								"status" => $results[$r]->status,
								"created_date" => $results[$r]->created_date,
								"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
								"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
								"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
								"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
								"employmentInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
								"likedJobs" => $this->sql->getLikedJobs($results[$r]->id,2,$userid),
								"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
							);
						}
					}
				}
			}
			$empInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1),"id","ASC");
			$experienceInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1),"id","ASC");
			$statesInfo = $this->sql->getTableRowDataOrder("states",array("status" => 1),"state_name","ASC");
			if(@$state_id > 0)
			{
				$citiesInfo = $this->sql->getTableRowDataOrder("cities",array("status" => 1,"state_id"=>$state_id),"city_name","ASC");
			}
			/*index Page Coding End*/
			
			
			//echo "<pre>";print_r($resultsArray);echo "</pre>";die();
			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"userInfo" => @$userInfo,
				"empInfo" => @$empInfo,
				"experienceInfo" => @$experienceInfo,
				"statesInfo" => @$statesInfo,
				"citiesInfo" => @$citiesInfo,
				"results" => @$resultsArray,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"pagetype" => 1,
				"dashAct" => 'suggestedjobs',
				"homeActive" => 'suggestedjobs',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('recruiter/suggested-jobs',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function removeimagedata($page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			if($page_type == 1)
			{
				$deleteExistimage = $this->sql->removeAdminUploadedImage("users",$userid,'users','business_logo');
				if(@$deleteExistimage > 0)
				{
					$params = array(
						"business_logo" => "",
					);
					$update = $this->sql->updateItems("users",$params,array("id"=>$userid));
					$this->session->set_userdata(array("success" => "Successfully Deleted The Resume."));
				}
				else
				{
					$this->session->set_userdata(array("fail" => "Failed to Delete Resume. Please Try Again Once"));
				}
			}
			else if($page_type == 2)
			{
				$deleteExistimage = $this->sql->removeAdminUploadedImage("users",$userid,'users','profile_pic');
				if(@$deleteExistimage > 0)
				{
					$params = array(
						"profile_pic" => "",
					);
					$update = $this->sql->updateItems("users",$params,array("id"=>$userid));
					$this->session->set_userdata(array("success" => "Successfully Deleted  The Profile Picture."));
				}
				else
				{
					$this->session->set_userdata(array("fail" => "Failed to Delete Profile Picture. Please Try Again Once"));
				}
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed to Delete Profile Picture/Resume. Please Try Again Once"));
			}
			redirect(base_url()."recruiter/editprofile");
			
		}
		else
		{
			redirect(base_url());
		}
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
	public function getCandidateDetails($rowId)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '5')
		{
			@$results = array();
			if(@$rowId != '')
			{
				$results = $this->sql->getTableRowDataOrder("portal_need_jobs",array("country_id" => 1,"id"=>$rowId),"id","ASC");
				if(@sizeOf($results) > 0)
				{
					$candidateId = @$results[0]->user_id;
					if(@$candidateId != "")
					{
						$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$candidateId),"id","ASC");
					}
					$totalViews = 0;
					$totalViews = @$results[0]->total_views+1;
					$params = array(
						"total_views" => $totalViews,
					);
					$update = $this->sql->updateItems("portal_need_jobs",$params,array("id"=>$rowId));
				}

			}
			$json = array(
				"results" => @$results,
				"userInfo" => @$userInfo,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;

			$this->load->view('recruiter/ajax-candidate-details',$data);
			
		}
		else
		{
			redirect(base_url());
		}
	}
}
