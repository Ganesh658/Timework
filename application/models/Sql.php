<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sql extends CI_Model 
{
	public function __construct() 
    {
        parent::__construct(); 

        $this->load->database();
    }
    public function getTotalResults($skillnames=null,$stateslist=null,$citylist=null,$emptypelist=null,$experiencelist=null,$salarylist=null,$salarytypelist=null,$joiningtypelist=null,$jobfressnesslist=null)
    {
    	if($skillnames != '' && $skillnames != '0')
		{
           	$this->db->like("employment_type",$skillnames);
           $this->db->or_like('job_skills', $skillnames);
		}
    	if($stateslist != '' && $stateslist != '0')
		{
           	$this->db->where_in("state_id",$stateslist);
		}
		if($citylist != '' && $citylist != '0')
		{
			$cityIds = explode(",",$citylist);
           	$this->db->where_in("city_id",$cityIds);
		}
    	if($emptypelist != '' && $emptypelist != '0')
		{
			$emptypelistIds = explode(",",$emptypelist);
           	$this->db->where_in("employment_type",$emptypelistIds);
		}

		if($experiencelist != '' && $experiencelist != '0')
		{
			$experienceIds = explode(",",$experiencelist);
           	$this->db->where_in("experience",$experienceIds);
		}

		if($salarylist != '' && $salarylist != '0')
		{
			$this->db->where(array("salary >="=>$salarylist));
		}

		if($salarytypelist != '' && $salarytypelist != '0')
		{
			$salarytypeIds = explode(",",$salarytypelist);
           	$this->db->where_in("salary_type",$salarytypeIds);
		}
		if($joiningtypelist != '' && $joiningtypelist != '0')
		{
			$joiningtypeIds = explode(",",$joiningtypelist);
           	$this->db->where_in("joining_type",$joiningtypeIds);
		}
		if($jobfressnesslist != '' && $jobfressnesslist != '0')
		{
			$fressnessIds = explode(",",$jobfressnesslist);
			$this->db->group_start();
			if(in_array(1, $fressnessIds))
			{
				$this->db->where('DATE(created_date) > (NOW() - INTERVAL 3 DAY)');
			}
			if(in_array(2, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) > (NOW() - INTERVAL 7 DAY)');
			}
			if(in_array(3, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) > (NOW() - INTERVAL 15 DAY)');
			}
			if(in_array(4, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) < (NOW() - INTERVAL 15 DAY)');
			}
			$this->db->group_end();
		}
		else
		{
			$this->db->order_by("created_date","DESC");
		}

		@date_default_timezone_set("Asia/Kolkata");
		$curDate = @date("Y-m-d");
		$this->db->where(array('expire_date >='=>$curDate));

    	$this->db->select("*")->from('portal_jobs')->where(array("status"=>1));

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
    }
    public function getTotalResultsForRec($skillnames=null,$stateslist=null,$citylist=null,$emptypelist=null,$experiencelist=null,$joiningtypelist=null,$shiftlist=null,$jobfressnesslist=null)
    {
    	if($skillnames != '' && $skillnames != '0')
		{
           	$this->db->like("employment_type",$skillnames);
           $this->db->or_like('job_skills', $skillnames);
		}

    	if($stateslist != '' && $stateslist != '0')
		{
           	$this->db->where_in("state_id",$stateslist);
		}
		if($citylist != '' && $citylist != '0')
		{
			$cityIds = explode(",",$citylist);
           	$this->db->where_in("city_id",$cityIds);
		}
		if($emptypelist != '' && $emptypelist != '0')
		{
			$emptypelistIds = explode(",",$emptypelist);
           	$this->db->where_in("employment_type",$emptypelistIds);
		}
		if($experiencelist != '' && $experiencelist != '0')
		{
			$experienceIds = explode(",",$experiencelist);
           	$this->db->where_in("experience",$experienceIds);
		}

		if($joiningtypelist != '' && $joiningtypelist != '0')
		{
			$joiningtypeIds = explode(",",$joiningtypelist);
           	$this->db->where_in("joining_type",$joiningtypeIds);
		}
		if($shiftlist != '' && $shiftlist != '0')
		{
			$shiftlistIds = explode(",",$shiftlist);
           	$this->db->where_in("preferred_shift",$shiftlistIds);
		}

		if($jobfressnesslist != '' && $jobfressnesslist != '0')
		{
			$fressnessIds = explode(",",$jobfressnesslist);
			$this->db->group_start();
			if(in_array(1, $fressnessIds))
			{
				$this->db->where('DATE(created_date) > (NOW() - INTERVAL 3 DAY)');
			}
			if(in_array(2, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) > (NOW() - INTERVAL 7 DAY)');
			}
			if(in_array(3, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) > (NOW() - INTERVAL 15 DAY)');
			}
			if(in_array(4, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) < (NOW() - INTERVAL 15 DAY)');
			}
			$this->db->group_end();
		}
		else
		{
			$this->db->order_by("created_date","DESC");
		}
		@date_default_timezone_set("Asia/Kolkata");
		$curDate = @date("Y-m-d");
		$this->db->where(array('expire_date >='=>$curDate));

    	$this->db->select("*")->from('portal_need_jobs')->where(array("status"=>1))->order_by("created_date","DESC");

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
    }

    public function storeItems($table,$params)
	{
		$query = $this->db->insert($table,$params);
		if($query)
		{
			return $this->db->insert_id();
		}
		else
		{
			return 0;
		}
	}
	public function getLikedJobs($jobId,$page_type,$userid)
	{
		if($userid != '')
		{
			$this->db->select("*")->from('liked_jobs')->where(array("user_id" => @$userid,"job_id" => @$jobId,"page_type" => @$page_type));

			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
    public function getTableAllDataOrder($table,$column,$order)
	{
		$this->db->select("*")->from($table)->order_by($column,$order);

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getSearchResults()
	{
		
	}
	public function getTableRowDataOrder($table,$where,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}

	}
	public function getTableRowDataOrderNotIn($table,$where,$notcolumn,$notarray,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->where_not_in($notcolumn,$notarray)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}

	}
	public function getTableRowDataOrderClmByLimit($table,$where,$column,$order,$clm,$start,$end)
	{
		$this->db->select($clm)->from($table)->where($where)->order_by($column,$order)->limit($end,$start);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataOrderByLimit($table,$where,$column,$order,$start,$end)
	{
		$this->db->select('*')->from($table)->where($where)->order_by($column,$order)->limit($end,$start);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataOrderLimit($table,$where,$limit,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->limit($limit,0)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}

	}
	public function getTableRowDataWhereIn($table,$where,$column,$array)
	{
		if(@sizeOf($array) > 0)
		{
			$this->db->select("*")->from($table)->where($where)->where_in($column,$array);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return array();
			}
		}
		else
		{
			return array();
		}

	}
	public function getTableRowDataOrderClm($table,$where,$column,$order,$clm)
	{
		$this->db->select($clm)->from($table)->where($where)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function getTableRowDataOrderSize($table,$where,$column,$order)
	{
		$this->db->select("*")->from($table)->where($where)->order_by($column,$order);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}

	}
	public function getTableRowDataByGroup($table,$where,$column)
	{
		$this->db->select("*")->from($table)->where($where)->group_by($column);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}

	}
	public function existemail_orNot($email){
		$this->db->select('email')->from('users')->where('email',$email);
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else{
			return 0;
		}

	}
	public function existmobile_orNot($phone){
		$this->db->select('mobile')->from('users')->where('mobile',$phone);
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return 1;
		}
		else{
			return 0;
		}

	}
	public function usercheckLogin($params)
	{
		$query=$this->db->select("*")->from("users")->where(array("email" => $params["email"],"password" => $params["password"], "status" => 1,"emailAct"=>1))->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			$query=$this->db->select("*")->from("users")->where(array("mobile" => $params["email"],"password" => $params["password"], "status" => 1,"emailAct"=>1))->get();
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return array();
			}
		}
	}
	public function updateItems($table,$params,$where)
	{
		$query=$this->db->update($table,$params,$where);
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function getTableRowData($table,$where)
	{
		$this->db->select("*")->from($table)->where($where)->order_by("id","DESC");

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}

	}
	public function removeRowItems($table,$where)
	{
		$query = $this->db->delete($table,$where);
		if($query)
		{
			return 1;
		}

		else
		{
			return 0;
		}
	}
	public function removeUploadedImage($table,$rowId,$folder,$coloumn)
	{
		$this->db->select("*")->from($table)->where(array("id" => $rowId));
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			$result=$query->result();
			$delete=@unlink(FCPATH . 'uploads/'.@$folder.'/' . $result[0]->$coloumn);
			if($delete)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
	}
	public function removeAdminUploadedImage($table,$rowId,$folder,$coloumn)
	{
		$this->db->select("*")->from($table)->where(array("id" => $rowId));
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			
			$result=$query->result();
			//echo FCPATH . 'admin/uploads/'.@$folder.'/' . $result[0]->$coloumn;
			$delete=@unlink(FCPATH . 'admin/uploads/'.@$folder.'/' . $result[0]->$coloumn);
			if($delete)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	public function getTableRowDataByGroupLimit($table,$where,$column,$lmt=null)
	{
		if(@$lmt != '')
		{
			$this->db->limit($lmt,0);
		}
		$this->db->select("*")->from($table)->where($where)->group_by($column);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}

	}
	public function getTableRowDataArrayOrder($table,$where,$array,$column,$ordercol,$orderVal)
	{
		if(@sizeOf($array) > 0)
		{
			$this->db->select("*")->from($table)->where($where)->where_in($column,$array)->order_by($ordercol,$orderVal);

			$query = $this->db->get();

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return array();
			}
		}
		else
		{
			return array();
		}
	}
	public function getTableRowNotIn($table,$where,$array,$column,$ordercol,$orderVal)
	{
		if(@sizeOf($array) > 0)
		{
			$this->db->select("*")->from($table)->where($where)->where_not_in($column,$array)->order_by($ordercol,$orderVal);

			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return array();
			}
		}
		else
		{
			return array();
		}
	}

	
	public function updateViews($jobseeker_id)
    {
       $this->db->select("*")->from('users')->where(array("id"=>$jobseeker_id));
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            $result =  $query->result();
            $cnt = $result[0]->view_cnt+1;
            $params = array(
                'view_cnt'=>$cnt,
            );
            $update = $this->db->update('users',$params,array("id" => $jobseeker_id));
        }
    }

    public function getTotalResultsBySkills($job_skills)
    {
    	@date_default_timezone_set("Asia/Kolkata");
		$curDate = @date("Y-m-d");
		$this->db->where(array('expire_date >='=>$curDate));
		
    	$this->db->select("*")->from('portal_need_jobs')->where(array("status"=>1))->order_by("id","DESC")->group_by("id");
    	$array_like = explode(',', $job_skills);
    	$this->db->group_start();
		foreach($array_like as $key => $value) 
		{
		    if($key == 0) 
		    {
		        $this->db->like('job_skills', $value);
		    } 
		    else 
		    {
		        $this->db->or_like('job_skills', $value);
	    	}
	    }
	    $this->db->group_end();
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
    }
    public function getSuggestedJobsBySkills($job_skills)
    {
    	@date_default_timezone_set("Asia/Kolkata");
		$curDate = @date("Y-m-d");
		$this->db->where(array('expire_date >='=>$curDate));

    	$this->db->select("*")->from('portal_jobs')->where(array("status"=>1))->order_by("id","DESC")->group_by("id");
    	$array_like = explode(',', $job_skills);
    	$this->db->group_start();
		foreach($array_like as $key => $value) 
		{
		    if($key == 0) 
		    {
		        $this->db->like('job_skills', $value);
		    } 
		    else 
		    {
		        $this->db->or_like('job_skills', $value);
	    	}
	    }
	    $this->db->group_end();
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
    }
    public function getResultsBySkills($job_skills=null,$stateslist=null,$citylist=null,$emptypelist=null,$experiencelist=null,$joiningtypelist=null,$shiftlist=null,$jobfressnesslist=null)
    {
    	if(@$job_skills != '')
    	{
    		$array_like = @explode(',', @$job_skills);
    		if(@sizeOf($array_like) > 0)
    		{
				foreach($array_like as $key => $value) 
				{
				    if($key == 0) 
				    {
				        $this->db->like('job_skills', $value);
				    } 
				    else 
				    {
				        $this->db->or_like('job_skills', $value);
			    	}
			    }
			}
    	}

    	if($stateslist != '' && $stateslist != '0')
		{
           	$this->db->where_in("state_id",$stateslist);
		}
		if($citylist != '' && $citylist != '0')
		{
			$cityIds = explode(",",$citylist);
           	$this->db->where_in("city_id",$cityIds);
		}
		if($emptypelist != '' && $emptypelist != '0')
		{
			$emptypelistIds = explode(",",$emptypelist);
           	$this->db->where_in("employment_type",$emptypelistIds);
		}
		if($experiencelist != '' && $experiencelist != '0')
		{
			$experienceIds = explode(",",$experiencelist);
           	$this->db->where_in("experience",$experienceIds);
		}

		if($joiningtypelist != '' && $joiningtypelist != '0')
		{
			$joiningtypeIds = explode(",",$joiningtypelist);
           	$this->db->where_in("joining_type",$joiningtypeIds);
		}
		if($shiftlist != '' && $shiftlist != '0')
		{
			$shiftlistIds = explode(",",$shiftlist);
           	$this->db->where_in("preferred_shift",$shiftlistIds);
		}

		if($jobfressnesslist != '' && $jobfressnesslist != '0')
		{
			$fressnessIds = explode(",",$jobfressnesslist);
			$this->db->group_start();
			if(in_array(1, $fressnessIds))
			{
				$this->db->where('DATE(created_date) > (NOW() - INTERVAL 3 DAY)');
			}
			if(in_array(2, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) > (NOW() - INTERVAL 7 DAY)');
			}
			if(in_array(3, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) > (NOW() - INTERVAL 15 DAY)');
			}
			if(in_array(4, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) < (NOW() - INTERVAL 15 DAY)');
			}
			$this->db->group_end();
		}
		else
		{
			$this->db->order_by("created_date","DESC");
		}
		@date_default_timezone_set("Asia/Kolkata");
		$curDate = @date("Y-m-d");
		$this->db->where(array('expire_date >='=>$curDate));

    	$this->db->select("*")->from('portal_need_jobs')->where(array("status"=>1))->order_by("created_date","DESC");

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
    }
    public function getTotalPostsBySkills($job_skills=null,$stateslist=null,$citylist=null,$emptypelist=null,$experiencelist=null,$salarylist=null,$salarytypelist=null,$joiningtypelist=null,$jobfressnesslist=null)
    {
    	if(@$job_skills != '')
    	{
    		$array_like = @explode(',', @$job_skills);
    		if(@sizeOf($array_like) > 0)
    		{
				foreach($array_like as $key => $value) 
				{
				    if($key == 0) 
				    {
				        $this->db->like('job_skills', $value);
				    } 
				    else 
				    {
				        $this->db->or_like('job_skills', $value);
			    	}
			    }
			}
    	}
    	if($stateslist != '' && $stateslist != '0')
		{
           	$this->db->where_in("state_id",$stateslist);
		}
		if($citylist != '' && $citylist != '0')
		{
			$cityIds = explode(",",$citylist);
           	$this->db->where_in("city_id",$cityIds);
		}
    	if($emptypelist != '' && $emptypelist != '0')
		{
			$emptypelistIds = explode(",",$emptypelist);
           	$this->db->where_in("employment_type",$emptypelistIds);
		}

		if($experiencelist != '' && $experiencelist != '0')
		{
			$experienceIds = explode(",",$experiencelist);
           	$this->db->where_in("experience",$experienceIds);
		}

		if($salarylist != '' && $salarylist != '0')
		{
           	$this->db->where(array("salary >="=>$salarylist));
		}
		if($joiningtypelist != '' && $joiningtypelist != '0')
		{
			$joiningtypeIds = explode(",",$joiningtypelist);
           	$this->db->where_in("joining_type",$joiningtypeIds);
		}
		if($salarytypelist != '' && $salarytypelist != '0')
		{
			$salarytypeIds = explode(",",$salarytypelist);
           	$this->db->where_in("salary_type",$salarytypeIds);
		}

		if($jobfressnesslist != '' && $jobfressnesslist != '0')
		{
			$fressnessIds = explode(",",$jobfressnesslist);
			$this->db->group_start();
			if(in_array(1, $fressnessIds))
			{
				$this->db->where('DATE(created_date) > (NOW() - INTERVAL 3 DAY)');
			}
			if(in_array(2, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) > (NOW() - INTERVAL 7 DAY)');
			}
			if(in_array(3, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) > (NOW() - INTERVAL 15 DAY)');
			}
			if(in_array(4, $fressnessIds))
			{
				$this->db->or_where('DATE(created_date) < (NOW() - INTERVAL 15 DAY)');
			}
			$this->db->group_end();
		}
		else
		{
			$this->db->order_by("created_date","DESC");
		}
		@date_default_timezone_set("Asia/Kolkata");
		$curDate = @date("Y-m-d");
		$this->db->where(array('expire_date >='=>$curDate));
		
    	$this->db->select("*")->from('portal_jobs')->where(array("status"=>1));

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
    }
   
}