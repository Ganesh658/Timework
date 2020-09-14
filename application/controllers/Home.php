<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sql');	
	}
	public function index()
	{
		/*Header Coding Starts*/
		$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
		/*Header Coding End*/

		/*index Page Coding Starts*/
		$userid = @$this->session->userdata("userid");
		$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
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
			"userInfo" => @$userInfo,
			"address" => @$address,
			"sociallinks" => @$sociallinks,
			"dashAct" => 'sjobs',
			"homeActive" => 'sjobs',
			"searchpage" => 1,
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$this->load->view('home/header',$data);
		$this->load->view('home/index',$data);
		$this->load->view('home/footer',$data);
	}
	public function register($referralCode=null,$referralEmail=null)
	{
		if(@$this->session->userdata("is_logged_in") =='')
		{
			$this->session->set_userdata(array("referralCode" => '',"referralEmail" => ''));
			$this->session->set_userdata(array("referralCode" => @$referralCode,"referralEmail" => @$referralEmail));
			/*Header Coding Starts*/
			$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$banners = $this->sql->getTableRowDataOrder("banners",array("status"=>1,"page_type"=>1),"id","DESC");
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			/*index Page Coding End*/

			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"seoContent" => @$seoContent,
				"googelCode" => @$googelCode,
				"banners" => @$banners,
				"userInfo" => @$userInfo,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"homeActive" => 'rcpr',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('home/header',$data);
			$this->load->view('home/register-process',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function contact()
	{
		/*Header Coding Starts*/
		$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
		/*Header Coding End*/

		/*index Page Coding Starts*/
		$userid = @$this->session->userdata("userid");
		$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
		$banners = $this->sql->getTableRowDataOrder("banners",array("status"=>1,"page_type"=>1),"id","DESC");
		$totaladdress = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","ASC");
		$addressArray = array();
		if(@sizeOf($totaladdress) > 0)
		{
			for ($a=0; $a < sizeOf($totaladdress); $a++) 
			{ 
				$addressArray[$a] = array(
					"id" => $totaladdress[$a]->id,
					"country_id" => $totaladdress[$a]->country_id,
					"company_address" => $totaladdress[$a]->company_address,
					"company_email" => $totaladdress[$a]->company_email,
					"company_phone" => $totaladdress[$a]->company_phone,
				);
			}
		}
		/*index Page Coding End*/

		/*Footer Coding Starts*/
		$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
		$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
		/*Footer Coding End*/
	
		$json = array(
			"seoContent" => @$seoContent,
			"googelCode" => @$googelCode,
			"banners" => @$banners,
			"userInfo" => @$userInfo,
			"totaladdress" => @$addressArray,
			"address" => @$address,
			"sociallinks" => @$sociallinks,
			"homeActive" => 'home',
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$this->load->view('home/header',$data);
		$this->load->view('home/contact-us',$data);
		$this->load->view('home/footer',$data);
	}
	public function saveContactInfo()
	{
		$cName = $this->input->post("user_name");
		$cMobile = $this->input->post("user_phone");
		$cEmail = $this->input->post("user_email");
		$cSubject = $this->input->post("user_subject");
		$cMessage = $this->input->post("user_msg");
		@date_default_timezone_set("Asia/Kolkata");
		$curDate = @date("Y-m-d H:i:s");
		$params = array(
			"first_name" => @$cName,
			"user_mobile" => @$cMobile,
			"user_email" => @$cEmail,
			"user_subject" => @$cSubject,
			"user_query" => @$cMessage,
			"created_date" => @$curDate,

		);
		$ins = $this->sql->storeItems("enquiries",$params);


		if($ins > 0)
		{
			$address = $this->sql->getTableRowDataOrder("address",array("status" => 1),"id","ASC");
			if(@sizeOf($address)> 0)
			{
				$subject="Enquiry From Timework";
				$body="Dear Admin,<br><br>Feedback From The Timework Website. Please Contact ASAP<br><br><table style='font-family: arial, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Name</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$cName."</th></tr><tr style='background-color: #dddddd;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Email</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$cEmail."</th></tr><tr><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Mobile Number</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$cMobile."</th></tr><tr style='background-color: #dddddd;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Subject</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$cSubject."</th></tr><tr><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Message</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$cMessage."</th></tr><tr style='background-color: #dddddd;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Posted Date</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$curDate."</th></tr></table><br><br>Best Wishes,<br>Timework Team.";
			
				@$from = $cEmail;
				$to = $address[0]->company_email;
				if(@$to != '' && @$from != '')
				{
					$this->load->library('email');
					$config = Array(
						 'mailtype' => 'html', 
						 'charset' => 'utf-8',
						 'wordwrap' => TRUE

					);
					$this->email->initialize($config);
					$recipient ='Time Work';
					$this->email->from($from, $recipient);
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($body);
					$this->email->send();
				}
				$this->session->set_userdata(array("success" => "Your feedback is submitted."));
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed to Submit. Please Try Again Once"));
			}
		}
		else
		{
			$this->session->set_userdata(array("fail" => "Failed to Submit. Please Try Again Once"));
			
		}
		redirect(base_url()."feedback");
	}
	public function faq($page_type)
	{
		/*Header Coding Starts*/
		$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
		/*Header Coding End*/

		/*index Page Coding Starts*/
		$userid = @$this->session->userdata("userid");
		$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
		$banners = $this->sql->getTableRowDataOrder("banners",array("status"=>1,"page_type"=>1),"id","DESC");
		$faqsContent = $this->sql->getTableRowDataOrder("jobportal_cms",array("status"=>1,"page_type"=>$page_type),"id","ASC");
		/*index Page Coding End*/

		/*Footer Coding Starts*/
		$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
		$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
		/*Footer Coding End*/
	
		$json = array(
			"seoContent" => @$seoContent,
			"googelCode" => @$googelCode,
			"banners" => @$banners,
			"userInfo" => @$userInfo,
			"faqsContent" => @$faqsContent,
			"address" => @$address,
			"sociallinks" => @$sociallinks,
			"homeActive" => 'home',
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$this->load->view('home/header',$data);
		$this->load->view('home/faq',$data);
		$this->load->view('home/footer',$data);
	}
	public function getCitieslist($stateId=null)
	{
		extract($_REQUEST);
		$this->load->model('sql','', TRUE);    
        header('Content-Type: application/x-json; charset=utf-8');
       $citiesInfo = $this->sql->getTableRowDataOrder("cities",array("status"=>1,"state_id"=>$stateId),"city_name","ASC");
		$resultarray = array();
		if(@sizeOf($citiesInfo) > 0)
		{
			for($a=0;$a<@sizeOf($citiesInfo);$a++)
			{
				$resultarray[$a]=array(
					'id'=>$citiesInfo[$a]->id,				
					'alias_name'=>$citiesInfo[$a]->alias_name,				
					'city_name'=>ucwords($citiesInfo[$a]->city_name),
				);
			}
		}
		$data['citiesInfo']=$resultarray;
		//print_r($data);
        echo(json_encode($data['citiesInfo']));
	}
	public function getLocationslist($stateId,$cityid)
	{
		extract($_REQUEST);
		$this->load->model('sql','', TRUE);    
        header('Content-Type: application/x-json; charset=utf-8');
       $citiesInfo = $this->sql->getTableRowDataOrder("locations",array("status"=>1,"state_id"=>$stateId,"city_id"=>$cityid),"location_name","ASC");
		$resultarray = array();
		if(@sizeOf($citiesInfo) > 0)
		{
			for($a=0;$a<@sizeOf($citiesInfo);$a++)
			{
				$resultarray[$a]=array(
					'id'=>$citiesInfo[$a]->id,				
					'alias_name'=>$citiesInfo[$a]->alias_name,				
					'location_name'=>ucwords($citiesInfo[$a]->location_name),
				);
			}
		}
		$data['citiesInfo']=$resultarray;
		//print_r($data);
        echo(json_encode($data['citiesInfo']));
	}
	public function pricing()
	{
		/*Header Coding Starts*/
		$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
		/*Header Coding End*/

		/*index Page Coding Starts*/
		$userid = @$this->session->userdata("userid");
		$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
		$banners = $this->sql->getTableRowDataOrder("banners",array("status"=>1,"page_type"=>1),"id","DESC");
		$cmsInfo = $this->sql->getTableRowDataOrder("jobportal_cms",array("status"=>1,"page_type"=>8),"id","ASC");
		$creditAmounts = $this->sql->getTableRowDataOrder("credit_amounts",array("status"=>1),"id","ASC");
		/*index Page Coding End*/

		/*Footer Coding Starts*/
		$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
		$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
		/*Footer Coding End*/
	
		$json = array(
			"seoContent" => @$seoContent,
			"googelCode" => @$googelCode,
			"banners" => @$banners,
			"userInfo" => @$userInfo,
			"cmsInfo" => @$cmsInfo,
			"creditAmounts" => @$creditAmounts,
			"address" => @$address,
			"sociallinks" => @$sociallinks,
			"homeActive" => 'pricing',
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$this->load->view('home/header',$data);
		$this->load->view('home/pricing',$data);
		$this->load->view('home/footer',$data);
	}
	public function search()
	{
		/*Header Coding Starts*/
		$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
		/*Header Coding End*/

		/*index Page Coding Starts*/
		$userid = @$this->session->userdata("userid");
		$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
		$banners = $this->sql->getTableRowDataOrder("banners",array("status"=>1,"page_type"=>1),"id","DESC");
		$skillnames = @$_GET['skillnames'];
		$location = @$_GET['location'];
		$address = $this->sql->getSearchResults($skillnames,$location);
		/*index Page Coding End*/

		/*Footer Coding Starts*/
		$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
		$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
		/*Footer Coding End*/
	
		$json = array(
			"seoContent" => @$seoContent,
			"googelCode" => @$googelCode,
			"banners" => @$banners,
			"userInfo" => @$userInfo,
			"cmsInfo" => @$cmsInfo,
			"address" => @$address,
			"sociallinks" => @$sociallinks,
			"homeActive" => 'pricing',
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$this->load->view('home/header',$data);
		$this->load->view('home/search-details',$data);
		$this->load->view('home/footer',$data);
	}
	public function checkLikedJob($jobId,$page_type)
	{
		if(@$jobId != '' && @$page_type != '')
		{
			if(@$page_type == '1')
			{
				$table = 'portal_jobs';
				$postJobs = $this->sql->getTableRowDataOrder($table,array("id"=>$jobId),"id","DESC");
			}
			else if(@$page_type == '2')
			{
				$table = 'portal_need_jobs';
				$postJobs = $this->sql->getTableRowDataOrder($table,array("id"=>$jobId),"id","DESC");
			}
			if(@sizeOf($postJobs) > 0)
			{
				$userid = @$this->session->userdata("userid");
				$likedJobs = $this->sql->getTableRowDataOrder("liked_jobs",array("user_id" => @$userid,"job_id" => @$jobId,"page_type" => @$page_type),"id","DESC");
				if(@sizeOf($likedJobs) == 0)
				{
					@date_default_timezone_set("Asia/Kolkata");
					$curDate = @date("Y-m-d H:i:s");
					$params = array(
						"user_id" => @$userid,
						"job_id" => @$jobId,
						"page_type" => @$page_type,
						"created_date" => $curDate
					);
					$insert = $this->sql->storeItems('liked_jobs',$params);
					if(@$insert > 0)
					{
						$total_likes = 0;
						$totalLikes = @$results[0]->total_likes+1;
						$params = array(
							"total_likes" => $totalLikes,
						);
						$update = $this->sql->updateItems($table,$params,array("id"=>$jobId));
						echo "success";
					}
					else
					{
						echo "fail";
					}
				}
				else
				{
					echo "exsit";
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
	public function deleteLikedJob($page_type,$jobId)
	{	
		if(@$this->session->userdata("is_logged_in") !='')
		{	
			$userid = @$this->session->userdata("userid");
			$test=$this->sql->removeRowItems("liked_jobs",array("user_id" => @$userid,"job_id" => @$jobId,"page_type" => @$page_type));
			if($test == 1)
			{
				if(@$page_type == '1')
				{
					$table = 'portal_jobs';
					$results = $this->sql->getTableRowDataOrder($table,array("id"=>$jobId),"id","DESC");
				}
				else if(@$page_type == '2')
				{
					$table = 'portal_need_jobs';
					$results = $this->sql->getTableRowDataOrder($table,array("id"=>$jobId),"id","DESC");
				}

				$total_likes = 0;
				if(@$results[0]->total_likes > 0)
				{
					$total_likes = @$results[0]->total_likes-1;
				}
				$params = array(
					"total_likes" => $total_likes,
				);
				$update = $this->sql->updateItems($table,$params,array("id"=>$jobId));

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
			if($page_type == '1')
			{
				redirect(base_url()."index.php/jobseeker/likedjobs");
			}
			else
			{
				redirect(base_url()."index.php/recruiter/likedjobs");
			}
		}	
		else
		{
			redirect(base_url());
		}
	}
	public function credits()
	{
		if(@$this->session->userdata("is_logged_in") !='')
		{
			/*Header Coding Starts*/
			$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
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
				"userInfo" => @$userInfo,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'credits',
				"homeActive" => 'credits',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('home/header',$data);
			$this->load->view('home/credits',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function sharereffalCode()
	{
		if(@$this->session->userdata("is_logged_in") !='')
		{
			$user_email = $this->input->post('user_email');
			if(@$user_email != '')
			{
				$address = $this->sql->getTableRowDataOrder("address",array("status" => 1),"id","ASC");
				if(@sizeOf($address)> 0)
				{
					$userid = @$this->session->userdata("userid");
					$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");

					$referral_code = @$userInfo[0]->referral_code; 
					$email = @$userInfo[0]->email; 
					$emailId = @str_replace("=","_",base64_encode(@$email));
					$referral_url = base_url()."registration-process/".@$referral_code."/".@$emailId;
					$subject="Referral Code From The Time Work Website";
					$body="Hi,<br><br>Greetings of the day...! <br><br>You gets 200 credits on after registration completion. Please Use the below code at the time of registration process<br><br><table style='font-family: arial, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Referral Code:</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>".@$referral_code."</th></tr><tr style='background-color: #dddddd;'><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Website URL</th><th style='border: 1px solid #dddddd;text-align: left;padding: 8px;'><a href=".@$referral_url." target='_blank'>Click Here</a></th></tr></table><br><br>Best Wishes,<br>Time Work Team.";
				
					@$from = $email;
					$to = @$user_email;
					if(@$to != '' && @$from != '')
					{
						$this->load->library('email');
						$config = Array(
							 'mailtype' => 'html', 
							 'charset' => 'utf-8',
							 'wordwrap' => TRUE
						);
						$this->email->initialize($config);
						$recipient ='Time Work';
						$this->email->from($from, $recipient);
						$this->email->to($to);
						$this->email->subject($subject);
						$this->email->message($body);
						$this->email->send();
					}
					$this->session->set_userdata(array("success" => "Thank you for sharing Referral Code for your friend"));
				}
				else
				{
					$this->session->set_userdata(array("fail" => "Failed to Send Email. Please Try Again Once."));
				}
			}
			else
			{
				$this->session->set_userdata(array(
					"fail" => "Failed to Send Email. Please Try Again Once."
				));		
				
			}
			redirect(base_url()."credits");

		}
		else
		{
			redirect(base_url());
		}
	}
	public function buycredits()
	{
		if(@$this->session->userdata("is_logged_in") !='')
		{
			/*Header Coding Starts*/
			$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
			/*Header Coding End*/

			/*index Page Coding Starts*/
			$userid = @$this->session->userdata("userid");
			$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
			$banners = $this->sql->getTableRowDataOrder("banners",array("status"=>1,"page_type"=>1),"id","DESC");
			$creditAmounts = $this->sql->getTableRowDataOrder("credit_amounts",array("status"=>1),"id","ASC");
			/*index Page Coding End*/

			/*Footer Coding Starts*/
			$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
			$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
			/*Footer Coding End*/
		
			$json = array(
				"seoContent" => @$seoContent,
				"googelCode" => @$googelCode,
				"banners" => @$banners,
				"creditAmounts" => @$creditAmounts,
				"userInfo" => @$userInfo,
				"address" => @$address,
				"sociallinks" => @$sociallinks,
				"dashAct" => 'pricing',
				"homeActive" => 'pricing',
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$this->load->view('home/header',$data);
			$this->load->view('home/buy-credits',$data);
			$this->load->view('home/footer',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function checkout($rowId)
	{
		if(@$this->session->userdata("is_logged_in") !='')
		{
			if(@$rowId != '')
			{
				$row_id = @str_replace("_","=",@base64_decode(@$rowId));
				$creditAmounts = $this->sql->getTableRowDataOrder("credit_amounts",array("status"=>1,"id"=>$row_id),"id","ASC");
				if(@sizeOf($creditAmounts) > 0)
				{
					$credit_price = @$creditAmounts[0]->credit_price;
					if(@$credit_price > 0)
					{
						//$gstAmt = ((@$credit_price*18)/100);
						$gstAmt = 0;
						$finalAmount = @$credit_price+@$gstAmt;
						$json = array(
							"amount" => @$finalAmount,
							"firstname" => @$this->session->userdata("username"),
							"email" => @$this->session->userdata("email"),
							"phone" => @$this->session->userdata("mobile"),
							"row_id" => @$row_id,
						);
						$encodeJson = json_encode($json);
						$data["jsonObj"] = $encodeJson;
						$this->load->view('home/payu-money',$data);
					}
					else
					{
						$this->session->set_userdata(array("fail" => "Failed To Purchase Credits. Please Try Again Once."));
						redirect(base_url()."buy-credits");
					}
				}
				else
				{
					$this->session->set_userdata(array("fail" => "Failed To Purchase Credits. Please Try Again Once."));
					redirect(base_url()."buy-credits");
				}
			}
			else
			{
				$this->session->set_userdata(array("fail" => "Failed To Purchase Credits. Please Try Again Once."));
				redirect(base_url()."buy-credits");
			}
		}
	}
	public function success()
	{
	    $set = 0;
		$status = $_REQUEST['status'];
		$expd = @explode("_",$_REQUEST['productinfo']);
		$userid = @$expd[1];
	
		$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");

		if(@$status == 'success' && $userid > 0 && @sizeOf($userInfo) > 0)
		{
			$json = array(
				"payuresponse" => @$_REQUEST,
			);
			$payuresponse = @json_encode($json);
			$unmapped_status = @$_REQUEST['unmappedstatus'];
			$pay_key = @$_REQUEST['key'];
			$txnid = @$_REQUEST['txnid'];
			$mihpayid = @$_REQUEST['mihpayid'];
			$amount = @$_REQUEST['amount'];
		    $credit_id = @$expd[0];
			$payu_money_id = @$_REQUEST['payuMoneyId'];
			$curDate = @$_REQUEST['addedon'];

			$params = array(
				"user_id" => @$userid,
				"payment_status" => @$status,
				"unmapped_status" => @$unmapped_status,
				"pay_key" => @$pay_key,
				"txnid" => @$txnid,
				"mihpayid" => @$mihpayid,
				"amount" => @$amount,
				"credit_id" => @$credit_id,
				"payu_money_id" => @$payu_money_id,
				"payu_response" => @$payuresponse,
				"status" => 1,
				"created_date" => @$curDate
			);
			$insert = $this->sql->storeItems('orders',$params);
			if(@$insert > 0)
			{
			    	$rePage = base_url();
    				if(@$userInfo[0]->usertype == '3')
    				{
    					$rePage = base_url()."jobseeker";
    				}
    				else if(@$userInfo[0]->usertype == '5')
    				{
    
    					$rePage = base_url()."recruiter";
    				}
    			
    				$sessons=array(
    					'userid' => $userInfo[0]->id,
    					'username' => $userInfo[0]->firstname,
    					'email' => $userInfo[0]->email,
    					'mobile' => $userInfo[0]->mobile,
    					'usertype' => $userInfo[0]->usertype,
    					'created_by' => $userInfo[0]->created_by,
    					'userdetails' => $userInfo,
    					'folder' => @$rePage,
    					'is_logged_in' => 1,
    				);
    				$this->session->set_userdata($sessons);
				$credits = 0;
				if(@$credit_id != '')
				{
					$credit_amounts = $this->sql->getTableRowDataOrder('credit_amounts',array("status"=>1,"id"=>$credit_id),"id","DESC");
					if(@sizeOf($credit_amounts) > 0)
					{
						$credits = @$credit_amounts[0]->credits;
						$userInfos = $this->sql->getTableRowDataOrder('users',array("id"=>$userid),"id","DESC");
						if(@sizeOf($userInfos) > 0)
						{
							$credits_amount = @$userInfos[0]->credits_amount+@$credits;
							$mparams = array("credits_amount"=>@$credits_amount);
							$update = $this->sql->updateItems("users",$mparams,array("id" => $userid));
							
							$set = 1;
						}
					}
				}
			}
		}
		if($set == 1){
		    $this->session->set_userdata(array("success" => "Successfully Purchased Credits."));
		   redirect(base_url()."buy-credits");
		}else
		{
		    $this->session->set_userdata(array("fail" => "Failed To Purchase Credits. Please Try Again Once."));
			redirect(base_url()."buy-credits");
		}

	}
	public function failure()
	{
		if(@$this->session->userdata("is_logged_in") !='')
		{

			$this->session->set_userdata(array("fail" => "Failed To Purchase Credits. Please Try Again Once."));
			redirect(base_url()."buy-credits");
		}
	}
	public function cmsinfo($page_type)
	{
		/*Header Coding Starts*/
		$seoContent = $this->sql->getTableRowDataOrder("meta_data",array("page_type"=>1),"id","ASC");
		/*Header Coding End*/

		/*index Page Coding Starts*/
		$userid = @$this->session->userdata("userid");
		$userInfo = $this->sql->getTableRowDataOrder("users",array("id"=>$userid),"id","ASC");
		$banners = $this->sql->getTableRowDataOrder("banners",array("status"=>1,"page_type"=>1),"id","DESC");
		$cmsInfo = $this->sql->getTableRowDataOrder("jobportal_cms",array("status"=>1,"page_type"=>$page_type),"id","ASC");

		/*index Page Coding End*/

		/*Footer Coding Starts*/
		$address = $this->sql->getTableRowDataOrder('address',array("status"=>1),"id","DESC");
		$sociallinks = $this->sql->getTableRowDataOrder('social_links',array("status"=>1),"id","DESC");
		/*Footer Coding End*/
	
		$json = array(
			"seoContent" => @$seoContent,
			"googelCode" => @$googelCode,
			"banners" => @$banners,
			"userInfo" => @$userInfo,
			"cmsInfo" => @$cmsInfo,
			"page_type" => @$page_type,
			"address" => @$address,
			"sociallinks" => @$sociallinks,
			"homeActive" => 'home',
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$this->load->view('home/header',$data);
		$this->load->view('home/cms-info',$data);
		$this->load->view('home/footer',$data);
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
}
