<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jobseeker extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sql');	
	}
	public function index()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
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
				"homeActive" => 'dashboard',
				"searchpage" => 1,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('home/index',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function editprofile()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			$states = $this->sql->getTableRowDataOrder("states",array("status"=>1),"state_name","ASC");
			$citiesInfo = array();
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
			$desiredcities = $this->sql->getTableRowDataOrder("cities",array("status"=>1),"city_name","ASC");
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
				"desiredcities" => @$desiredcities,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'editprofile',
				"homeActive" => 'editprofile',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('jobseeker/edit-profile',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updateProfile()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
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

			if(@$_FILES["user_resume"]["name"] != '')
			{
				$category1 = @explode(".",$_FILES["user_resume"]["name"]);
				$user_resume = "resume-".time().".".end($category1);
			
				$deleteExistimage=$this->sql->removeAdminUploadedImage("users",$userid,'users','user_resume');								
				@move_uploaded_file($_FILES["user_resume"]["tmp_name"],"admin/uploads/users/".$user_resume);						
			}
			else
			{
				$user_resume = $this->input->post("hiddenuser_resume");
			}

			$job_skills = @implode(",", $this->input->post("job_skills"));
			$job_locations = @implode("||", $this->input->post("job_locations"));
			$params = array(
				"firstname" => @$this->input->post('v_name'),
				"mobile" => @$this->input->post('mobile'),
				"user_gender" => @$this->input->post("user_gender"),
				"date_of_birth" => @$this->input->post("date_of_birth"),
				"marital_status" => @$this->input->post("marital_status"),
				"languages_known" => @$this->input->post("languages_known"),
				"job_skills" => @$job_skills,
				"career_objective" => @$this->input->post("career_objective"),
				"roles_info" => @$this->input->post("job_roles"),
				"job_locations" => @$job_locations,
				"state_id" => @$this->input->post("v_state"),
				"city_id" => @$this->input->post("v_city"),
				"area_info" => @$this->input->post("v_location"),
				"city_zipcode" => @$this->input->post("v_zipcode"),
				"address" => @$this->input->post("address"),
				"profile_pic" => @$profile_pic,
				"user_resume" => @$user_resume,
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
			redirect(base_url()."jobseeker/editprofile");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function changepassword()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
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
				"homeActive" => 'chngpwd',
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

	public function myJobs($page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
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
				$results = $this->sql->getTableRowDataOrder("portal_need_jobs",array("country_id" => 1,"user_id"=>$userid,'expire_date <'=>$curDate),"expire_date","ASC");
			}
			else if(@$page_type == 3)
			{
				$results = $this->sql->getTableRowDataOrder("portal_need_jobs",array("country_id" => 1,"user_id"=>$userid,'status'=>0),"id","DESC");
			}
			else
			{
				$results = $this->sql->getTableRowDataOrder("portal_need_jobs",array("country_id" => 1,"user_id"=>$userid,'expire_date >='=>$curDate),"expire_date","ASC");
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
						"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
						"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
						"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
						"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
						/*"joiningInfo" => $this->sql->getTableRowDataOrder("categories",array("status" => 1,"id"=>$results[$r]->joining_type),"id","ASC"),*/
					);
				}
			}
				/*echo "<pre>";print_r($resultsArray);echo "</pre>";die();
		Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"userInfo" => @$userInfo,
				"results" => @$resultsArray,
				"page_type" => @$page_type,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'myJobs',
				"homeActive" => 'myJobs',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('jobseeker/my-jobs',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function jobStatusChange($status,$rowId)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") =='3')
		{
			$params=array(
				"status" => $status,
			);
			//print_r($params);die();
			$userid = @$this->session->userdata("userid");
			$table="portal_need_jobs";
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
			redirect(base_url()."jobseeker/myJobs");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function postjobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			$jobskills = $this->sql->getTableRowDataOrder("job_skills",array("status" => 1),"skill_name","ASC");
			$categories = $this->sql->getTableRowDataOrder("categories",array("parent_id" => 0,"status <" => 2),"cat_position","ASC");
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
				"dashAct" => 'myJobs',
				"homeActive" => 'myJobs',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('jobseeker/need-post-job',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function savePostJobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
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
				"experience" => @$this->input->post("experience"),
				"employment_type" => @$this->input->post("employment_type"),
				"joining_type" => @$this->input->post("joining_type"),
				"preferred_shift" => @$this->input->post("preferred_shift"),
				"description" => @$this->input->post("description"),
				"status" => 0,
				"created_date" => @$curDate,
			);
			$insert = $this->sql->storeItems("portal_need_jobs",$params);
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
			redirect(base_url()."jobseeker/myJobs/3");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function editJobs($rowId)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$results = $this->sql->getTableRowDataOrder("portal_need_jobs",array("country_id" => 1,"user_id"=>$userid,"id"=>$rowId,"update_count"=> 0),"id","DESC");
			if(@sizeOf($results) > 0)
			{
				$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
				$jobskills = $this->sql->getTableRowDataOrder("job_skills",array("status" => 1),"skill_name","ASC");
				$categories = $this->sql->getTableRowDataOrder("categories",array("parent_id" => 0,"status <" => 2),"cat_position","ASC");
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
				$cities = $this->sql->getTableRowDataOrder("cities",array("state_id"=>$results[0]->state_id,"status " => 1),"city_name","ASC");
				/*index Page Coding End*/
				
				/*Footer Coding Starts*/
				$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
				$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
				/*Footer Coding End*/
			
				$json = array(
					"userInfo" => @$userInfo,
					"states" => @$states,
					"cities" => @$cities,
					"rowId" => @$rowId,
					"categories" => @$catArray,
					"results" => @$results,
					"jobskills" => @$jobskills,
					"address" => @$address,
					"sociallinks" => @$sociallinks,
					"dashAct" => 'myJobs',
					"homeActive" => 'myJobs',
				);
				$encodeJson = json_encode($json);
				$data["jsonObj"] = $encodeJson;
				//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
				$this->load->view('jobseeker/edit-post-jobs',$data);
				$this->load->view('home/footer',$data);
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed to Edit Job. Please Try Again Once"));
				redirect(base_url()."jobseeker/myJobs");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function updatePostJobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
		{
			$country_id = '1';
			$userid = @$this->session->userdata("userid");
			@date_default_timezone_set("Asia/Kolkata");
			$curDate = @date("Y-m-d H:i:s");
			$job_skills = @implode(",", $this->input->post("job_skills"));
			$params = array(
				"country_id" => @$country_id,
				"job_title" => @$this->input->post("job_title"),
				"state_id" => @$this->input->post("job_state"),
				"city_id" => @$this->input->post("job_city"),
				"location_id" => @$this->input->post("job_location"),
				"job_skills" => @$job_skills,
				"experience" => @$this->input->post("experience"),
				"employment_type" => @$this->input->post("employment_type"),
				"joining_type" => @$this->input->post("joining_type"),
				"preferred_shift" => @$this->input->post("preferred_shift"),
				"description" => @$this->input->post("description"),
				"update_count" => 1,
			);

			$rowId = @$this->input->post("rowId");
			$insert = $this->sql->updateItems("portal_need_jobs",$params,array("user_id"=>$userid,"id"=>$rowId,"update_count"=> 0));
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
			redirect(base_url()."jobseeker/myJobs");
		}
		else
		{
			redirect(base_url());
		}
	}
	public function deleteJobs($rowId)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") =='3')
		{	
			$userid = @$this->session->userdata("userid");
			$jobslistings = $this->sql->getTableRowDataOrder("portal_need_jobs",array("id"=>$rowId,"user_id" => $userid),"id","ASC");
			if(@sizeOf($jobslistings) > 0)
			{
				$delete = $this->sql->removeRowItems("portal_need_jobs",array("id"=>$rowId,"user_id" => $userid));
				if(@$delete == 1)
				{
					$prms=array(
						'userid' => $userid,
						'nMessage' => "Successfully Deleted The Post. <strong>".@$jobslistings[0]->job_title."</strong>",
						'createDate' => @date("Y-m-d H:i:s"),
						'updateDate' => @date("Y-m-d H:i:s")
					);
					$ins1=$this->sql->storeItems("usernotifications",$prms);
					$this->session->set_userdata(array("success" => "Successfully Deleted Post."));
				}
				else
				{
					$this->session->set_userdata(array("fail" => "Failed to Delete This Post. Please Try Again Once"));
				}
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed to Delete This Post. Please Try Again Once"));
				
			}
			redirect(base_url()."jobseeker/myJobs");
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function search()
	{
		/*if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
		{*/
			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			$skillnames = @$_REQUEST['skillnames'];
			$location = @$_REQUEST['location'];
			$city_id = $state_id = 0;
			$checkCity = $this->sql->getTableRowDataOrder("cities",array("city_name"=>$location),"id","ASC");
			if(@sizeOf($checkCity) > 0)
			{
				$city_id =  $checkCity[0]->id;
				$state_id =  $checkCity[0]->state_id;
			}
			$results = $this->sql->getTotalResults(@$skillnames,$state_id,$city_id);
			$resultsArray = array();
			if(@sizeOf($results) > 0)
			{
				for ($r=0; $r < sizeOf($results); $r++) 
				{ 
					$userData = $this->sql->getTableRowDataOrder("users",array("id"=>$results[$r]->user_id,"status"=>1,"is_online"=>1),"id","ASC");
					if(@sizeOf($results) > 0)
					{
						$resultsArray[$r] = array(
							"id" => $results[$r]->id,
							"update_count" => $results[$r]->update_count,
							"job_title" => $results[$r]->job_title,
							"user_id" => $results[$r]->user_id,
							"country_id" => $results[$r]->country_id,
							"state_id" => $results[$r]->state_id,
							"city_id" => $results[$r]->city_id,
							"job_skills" => $results[$r]->job_skills,
							"no_of_openings" => $results[$r]->no_of_openings,
							"salary" => $results[$r]->salary,
							"experience" => $results[$r]->experience,
							"employment_type" => $results[$r]->employment_type,
							"salary_type" => $results[$r]->salary_type,
							"interview_location" => $results[$r]->interview_location,
							"created_date" => $results[$r]->created_date,
							"joining_type" => $results[$r]->joining_type,
							"userData" => @$userData,
							"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
							"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
							"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
							"salaryInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1,"id"=>$results[$r]->salary),"id","ASC"),
							"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
							"employmentInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
							"likedJobs" => $this->sql->getLikedJobs($results[$r]->id,1,$userid),
							"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
						);
					}
				}
			}
			$empInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1),"id","ASC");
			$experienceInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1),"id","ASC");
			$salaryrangeInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1),"id","ASC");
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
				"states" => @$states,
				"citiesInfo" => @$citiesInfo,
				"results" => @$resultsArray,
				"empInfo" => @$empInfo,
				"experienceInfo" => @$experienceInfo,
				"salaryrangeInfo" => @$salaryrangeInfo,
				"statesInfo" => @$statesInfo,
				"city_id" => @$city_id,
				"state_id" => @$state_id,
				"skillnames" => @$skillnames,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"searchpage" => 1,
				"pagetype"=>0,
				"dashAct" => 'sjobs',
				"homeActive" => 'sjobs',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('home/header',$data);
			$this->load->view('jobseeker/search-results',$data);
			$this->load->view('home/footer',$data);
		/*}
		else
		{
			redirect(base_url());
		}*/
	}
	public function likedjobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
		{
			/*Header Coding Starts*/
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			/*index Page Coding End*/
			$resultsArray = array();
			$likedJobs = $this->sql->getTableRowDataOrder("liked_jobs",array("user_id" => @$userid,"page_type" => 1),"id","DESC");
			if(@sizeOf($likedJobs) > 0)
			{
				for ($i=0; $i < sizeOf($likedJobs); $i++) 
				{ 
					$jobIds[] = $likedJobs[$i]->job_id;
				}
				$jobIds = @array_unique($jobIds);
				if(@sizeOf($likedJobs) > 0)
				{
					$results = $this->sql->getTableRowDataWhereIn("portal_jobs",array("status"=>1),"id",$jobIds);
					
					if(@sizeOf($results) > 0)
					{
						for ($r=0; $r < sizeOf($results); $r++) 
						{ 
							$userData = $this->sql->getTableRowDataOrder("users",array("id"=>$results[$r]->user_id,"status"=>1),"id","ASC");
							if(@sizeOf($results) > 0)
							{
								$resultsArray[$r] = array(
									"id" => $results[$r]->id,
									"update_count" => $results[$r]->update_count,
									"job_title" => $results[$r]->job_title,
									"user_id" => $results[$r]->user_id,
									"country_id" => $results[$r]->country_id,
									"state_id" => $results[$r]->state_id,
									"city_id" => $results[$r]->city_id,
									"job_skills" => $results[$r]->job_skills,
									"no_of_openings" => $results[$r]->no_of_openings,
									"salary" => $results[$r]->salary,
									"experience" => $results[$r]->experience,
									"employment_type" => $results[$r]->employment_type,
									"salary_type" => $results[$r]->salary_type,
									"interview_location" => $results[$r]->interview_location,
									"joining_type" => $results[$r]->joining_type,
									"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
									"userData" => @$userData,
									"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
									"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
									"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
									"salaryInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1,"id"=>$results[$r]->salary),"id","ASC"),
									"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
									"employmentInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
									"likedJobs" => $this->sql->getLikedJobs($results[$r]->id,1,$userid),
								);
							}
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
			$this->load->view('jobseeker/liked-jobs',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function removeimagedata($page_type=1)
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
		{
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			if($page_type == 1)
			{
				$deleteExistimage = $this->sql->removeAdminUploadedImage("users",$userid,'users','user_resume');
				if(@$deleteExistimage > 0)
				{
					$params = array(
						"user_resume" => "",
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
			redirect(base_url()."jobseeker/editprofile");
			
		}
	}
	public function getProductsByAttributes()
	{
		$msg = '';
		/*if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
		{*/
			$userid = @$this->session->userdata("userid");

			$stateslist = @$_REQUEST['stateslist'];

			$citylist = @$_REQUEST['citylist'];

			$emptypelist = @$_REQUEST['emptypelist'];

			$experiencelist = @$_REQUEST['experiencelist'];

			$salarylist = @$_REQUEST['salarylist'];

			$salarytypelist = @$_REQUEST['salarytypelist'];

			$jobfressnesslist = @$_REQUEST['jobfressnesslist'];

			$joiningtypelist = @$_REQUEST['joiningtypelist'];

			$skillnames= '';

			$results = array();
			if(@$pagetype == 1)
			{
				$userid = @$this->session->userdata("userid");
				$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
				$job_skills = $userInfo[0]->job_skills;
				$jobSkills = @explode(",", $job_skills);
				if(@$jobSkills != '')
				{
					$results = $this->sql->getTotalPostsBySkills(@$job_skills,$stateslist,$citylist,$emptypelist,$experiencelist,$salarylist,$salarytypelist,$joiningtypelist,$jobfressnesslist);
				}
			}
			else
			{
				$results = $this->sql->getTotalResults(@$skillnames,$stateslist,$citylist,$emptypelist,$experiencelist,$salarylist,$salarytypelist,$joiningtypelist,$jobfressnesslist);
			}

			
			$resultsArray = array();
			if(@sizeOf($results) > 0)
			{
				for ($r=0; $r < sizeOf($results); $r++) 
				{ 
					$userData = $this->sql->getTableRowDataOrder("users",array("id"=>$results[$r]->user_id,"status"=>1,"is_online"=>1),"id","ASC");
					if(@sizeOf($results) > 0)
					{
						$resultsArray[$r] = array(
							"id" => $results[$r]->id,
							"update_count" => $results[$r]->update_count,
							"job_title" => $results[$r]->job_title,
							"user_id" => $results[$r]->user_id,
							"country_id" => $results[$r]->country_id,
							"state_id" => $results[$r]->state_id,
							"city_id" => $results[$r]->city_id,
							"job_skills" => $results[$r]->job_skills,
							"no_of_openings" => $results[$r]->no_of_openings,
							"salary" => $results[$r]->salary,
							"experience" => $results[$r]->experience,
							"employment_type" => $results[$r]->employment_type,
							"salary_type" => $results[$r]->salary_type,
							"interview_location" => $results[$r]->interview_location,
							"created_date" => $results[$r]->created_date,
							"joining_type" => $results[$r]->joining_type,
							"userData" => @$userData,
							"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
							"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
							"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
							"salaryInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1,"id"=>$results[$r]->salary),"id","ASC"),
							"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
							"employmentInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
							"likedJobs" => $this->sql->getLikedJobs($results[$r]->id,1,$userid),
							"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
						);
					}
				}
			}
			$json = array(
				"results" => @$resultsArray,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('jobseeker/ajax-results',$data);
		/*}*/
	}
	function getCitiesbystate()
	{
		$stateId = @$_REQUEST['stateId'];
		$dataId = @$_REQUEST['dataId'];
		if(@$stateId != '')
		{
			if($dataId == 1)
			{
				$filterproducts = 'recfilter';
			}
			else
			{
				$filterproducts = 'filterproducts';
			}
			$citiesInfo = $this->sql->getTableRowDataOrder("cities",array("status"=>1,"state_id"=>$stateId),"city_name","ASC");
			if(@sizeOf($citiesInfo) > 0)
			{
				for ($c=0; $c < sizeOf($citiesInfo); $c++) 
				{ 
					echo '<div class="checkbox-inner rdbtn"><label class="chkcontainer"><input type="checkbox" value="'.@$citiesInfo[$c]->id.'" class="'.@$filterproducts.'" name="cityType">'.@$citiesInfo[$c]->city_name.'<span class="chkbox"></span></label></div>';
				}
			}
			else
			{
				echo "fail";
			}
		}
		else
		{
			echo "fail";
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
	public function getJobDetails($rowId)
	{
		$resultsArray = array();
		if(@$rowId != '')
		{
			$results = $this->sql->getTableRowDataOrder("portal_jobs",array("id"=>$rowId),"id","ASC");
			
			if(@sizeOf($results) > 0)
			{
				for ($r=0; $r < sizeOf($results); $r++) 
				{ 
					$userData = $this->sql->getTableRowDataOrder("users",array("id"=>$results[$r]->user_id,"status"=>1,"is_online"=>1),"id","ASC");
					if(@sizeOf($results) > 0)
					{
						$resultsArray[$r] = array(
							"id" => $results[$r]->id,
							"update_count" => $results[$r]->update_count,
							"job_title" => $results[$r]->job_title,
							"user_id" => $results[$r]->user_id,
							"country_id" => $results[$r]->country_id,
							"state_id" => $results[$r]->state_id,
							"city_id" => $results[$r]->city_id,
							"job_skills" => $results[$r]->job_skills,
							"no_of_openings" => $results[$r]->no_of_openings,
							"joining_date" => $results[$r]->joining_date,
							"from_time" => $results[$r]->from_time,
							"to_time" => $results[$r]->to_time,
							"notice_peroid" => $results[$r]->notice_peroid,
							"salary" => $results[$r]->salary,
							"experience" => $results[$r]->experience,
							"employment_type" => $results[$r]->employment_type,
							"salary_type" => $results[$r]->salary_type,
							"interview_location" => $results[$r]->interview_location,
							"interview_details" => $results[$r]->interview_details,
							"job_description" => $results[$r]->job_description,
							"created_date" => $results[$r]->created_date,
							"userData" => @$userData,
							"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
							"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
							"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
							"salaryInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1,"id"=>$results[$r]->salary),"id","ASC"),
							"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
							"employmentInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
							"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
						);
					}
				}
				$totalViews = 0;
				$totalViews = @$results[0]->total_views+1;
				$params = array(
					"total_views" => $totalViews,
				);
				$update = $this->sql->updateItems("portal_jobs",$params,array("id"=>$rowId));
			}
		}
		$json = array(
			"results" => @$resultsArray,
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;

		$this->load->view('jobseeker/ajax-job-details',$data);
	}
	public function suggestedjobs()
	{
		if(@$this->session->userdata("is_logged_in") !='' && @$this->session->userdata("usertype") == '3')
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
					$results = $this->sql->getSuggestedJobsBySkills(@$job_skills);
					
					if(@sizeOf($results) > 0)
					{
						for ($r=0; $r < sizeOf($results); $r++) 
						{ 
							$userData = $this->sql->getTableRowDataOrder("users",array("id"=>$results[$r]->user_id,"status"=>1),"id","ASC");
							if(@sizeOf($results) > 0)
							{
								$resultsArray[$r] = array(
									"id" => $results[$r]->id,
									"update_count" => $results[$r]->update_count,
									"job_title" => $results[$r]->job_title,
									"user_id" => $results[$r]->user_id,
									"country_id" => $results[$r]->country_id,
									"state_id" => $results[$r]->state_id,
									"city_id" => $results[$r]->city_id,
									"job_skills" => $results[$r]->job_skills,
									"no_of_openings" => $results[$r]->no_of_openings,
									"salary" => $results[$r]->salary,
									"experience" => $results[$r]->experience,
									"employment_type" => $results[$r]->employment_type,
									"salary_type" => $results[$r]->salary_type,
									"interview_location" => $results[$r]->interview_location,
									"joining_type" => $results[$r]->joining_type,
									"timeago" => $this->get_time_ago(strtotime($results[$r]->created_date)),
									"userData" => @$userData,
									"stateInfo" => $this->sql->getTableRowDataOrder("states",array("country_id" => 1,"status " => 1,"id"=>$results[$r]->state_id),"state_name","ASC"),
									"cityInfo" => $this->sql->getTableRowDataOrder("cities",array("status " => 1,"id"=>$results[$r]->city_id),"city_name","ASC"),
									"locationsInfo" => $this->sql->getTableRowDataOrder("locations",array("status " => 1,"id"=>$results[$r]->location_id),"id","ASC"),
									"salaryInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1,"id"=>$results[$r]->salary),"id","ASC"),
									"expInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1,"id"=>$results[$r]->experience),"id","ASC"),
									"employmentInfo" => $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1,"id"=>$results[$r]->employment_type),"id","ASC"),
									"likedJobs" => $this->sql->getLikedJobs($results[$r]->id,1,$userid),
								);
							}
						}
					}
				}
			}
			else
			{
				redirect(base_url());
			}
			$empInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>6,"status" => 1),"id","ASC");
			$experienceInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>4,"status" =>1),"id","ASC");
			$salaryrangeInfo = $this->sql->getTableRowDataOrder("categories",array("parent_id" =>2,"status" => 1),"id","ASC");
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
				"salaryrangeInfo" => @$salaryrangeInfo,
				"statesInfo" => @$statesInfo,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'dashboard',
				"homeActive" => 'suggestedjobs',
				"pagetype"=>1,
				"searchpage" => 1,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			//$this->load->view('recruiter/dash-header',$data);
			$this->load->view('home/header',$data);
			$this->load->view('jobseeker/search-results',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
}
